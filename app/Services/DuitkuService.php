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
        // Trim values to avoid hidden space issues from .env
        $this->merchantCode = trim(env('DUITKU_MERCHANT_CODE'));
        $this->apiKey = trim(env('DUITKU_API_KEY'));
        $this->callbackUrl = trim(env('DUITKU_CALLBACK_URL'));
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
        $productDetails = substr($package->name, 0, 50); // Keep it short

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'merchantUserInfo' => $participant->email,
            'customerVaName' => substr($participant->name, 0, 20),
            'email' => $participant->email,
            'phoneNumber' => preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '08123456789'),
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('Duitku Outgoing Request: ', ['url' => $this->checkoutUrl, 'params' => $params]);

            $response = Http::post($this->checkoutUrl, $params);

            Log::info('Duitku Incoming Response: ' . $response->body());

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
                'statusMessage' => $data['statusMessage'] ?? ($data['Message'] ?? 'An error occurred at Duitku side.')
            ];

        } catch (\Exception $e) {
            Log::error('Duitku Connection Error: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => 'Gagal terhubung ke server pembayaran.'];
        }
    }
}
