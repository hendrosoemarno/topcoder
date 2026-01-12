<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\PaymentLog;
use App\Services\DuitkuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $duitku;

    public function __construct(DuitkuService $duitku)
    {
        $this->duitku = $duitku;
    }

    public function pay(Request $request, Transaction $transaction)
    {
        // Security check (Relaxed type check for DB compatibility)
        if ($transaction->participant_id != Auth::guard('participant')->id()) {
            Log::warning('Payment Access Denied', [
                'transaction_id' => $transaction->id,
                'trans_participant_id' => $transaction->participant_id,
                'auth_id' => Auth::guard('participant')->id()
            ]);
            abort(403);
        }

        if ($transaction->status === 'paid') {
            return redirect()->route('dashboard');
        }

        // Initiate Duitku Redirection Checkout
        $result = $this->duitku->createInvoice(
            $transaction,
            $transaction->participant,
            $transaction->package
        );

        if (isset($result['success']) && $result['success']) {
            $transaction->update([
                'payment_url' => $result['paymentUrl'],
                'reference' => $result['reference'] ?? null
            ]);
            return redirect($result['paymentUrl']);
        }

        return redirect()->route('dashboard')
            ->with('error', 'Gagal memproses pembayaran: ' . ($result['statusMessage'] ?? 'Unknown error'));
    }

    public function callback(Request $request)
    {
        // Log Callback
        PaymentLog::create([
            'raw_response' => json_encode($request->all()),
            'event' => 'callback'
        ]);

        $merchantCode = env('DUITKU_MERCHANT_CODE');
        $apiKey = env('DUITKU_API_KEY');

        // Extract params
        $merchantCodeReceived = $request->merchantCode;
        $amount = (int) $request->amount; // Cast to int to match signature logic
        $merchantOrderId = $request->merchantOrderId;
        $signatureReceived = $request->signature;
        $resultCode = $request->resultCode; // 00 = Success, 01 = Failure
        $reference = $request->reference;

        // Validate Signature
        // Duitku Callback Signature: md5(merchantCode + amount + merchantOrderId + apiKey)
        $calcSignature = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

        if ($signatureReceived !== $calcSignature) {
            Log::warning('Duitku Invalid Signature Callback', [
                'received' => $signatureReceived,
                'calculated' => $calcSignature,
                'payload' => $request->all()
            ]);
            return response()->json(['message' => 'Invalid Signature'], 400);
        }

        // Find Transaction
        $transaction = Transaction::where('order_id', $merchantOrderId)->first();
        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        if ($resultCode == '00') {
            $transaction->update([
                'status' => 'paid',
                'reference' => $reference,
                'payment_method' => $request->paymentMethod ?? $transaction->payment_method
            ]);
        } else {
            $transaction->update(['status' => 'failed']);
        }

        return response()->json(['message' => 'Callback Success']);
    }
}
