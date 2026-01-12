<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DuitkuService
{
    protected $merchantCode;
    protected $apiKey;
    protected $callbackUrl;
    protected $isSandbox;
    protected $checkoutUrl;

    public function __construct()
    {
        $this->merchantCode = env('DUITKU_MERCHANT_CODE');
        $this->apiKey = env('DUITKU_API_KEY');
        $this->callbackUrl = env('DUITKU_CALLBACK_URL');
        $this->isSandbox = (bool) env('DUITKU_SANDBOX', true);

        // Redirection Checkout URL
        $this->checkoutUrl = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/createinvoice'
            : 'https://passport.duitku.com/webapi/api/merchant/createinvoice';
    }

    public function createInvoice($transaction, $participant, $package)
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = $package->name;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        // Basic Sanitization
        $email = $participant->email;
        $phoneNumber = preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '08123456789');
        $customerName = substr($participant->name, 0, 20);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'merchantUserInfo' => $email,
            'customerVaName' => $customerName,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('Duitku Sending Request: ', $params);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->checkoutUrl, $params);

            Log::info('Duitku Response Raw: ' . $response->body());

            $data = $response->json();

            if (isset($data['paymentUrl'])) {
                return [
                    'success' => true,
                    'paymentUrl' => $data['paymentUrl'],
                    'reference' => $data['reference'] ?? null
                ];
            }

            return [
                'success' => false,
                'statusMessage' => $data['statusMessage'] ?? ($data['Message'] ?? 'Terjadi kesalahan pada sistem Duitku (An error has occurred)')
            ];

        } catch (\Exception $e) {
            Log::error('Duitku Checkout Connection Error: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => 'Gagal terhubung ke server pembayaran.'];
        }
    }
}
