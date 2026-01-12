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
        $this->merchantCode = trim(env('DUITKU_MERCHANT_CODE'));
        $this->apiKey = trim(env('DUITKU_API_KEY'));
        $this->callbackUrl = trim(env('DUITKU_CALLBACK_URL'));
        $this->isSandbox = (bool) env('DUITKU_SANDBOX', true);

        // Redirection Checkout URL
        $this->checkoutUrl = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
            : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
    }

    public function createInvoice($transaction, $participant, $package)
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = $package->name;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => substr($participant->name, 0, 20),
            'email' => $participant->email,
            'phoneNumber' => preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '08123456789'),
            'itemDetails' => [
                [
                    'name' => $package->name,
                    'price' => $paymentAmount,
                    'quantity' => 1
                ]
            ],
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('Duitku Header Request: ', ['url' => $this->checkoutUrl]);

            $response = Http::post($this->checkoutUrl, $params);

            $rawBody = $response->body();
            Log::info('Duitku Raw Response: ' . $rawBody);

            $data = $response->json();

            if (isset($data['paymentUrl'])) {
                return [
                    'success' => true,
                    'paymentUrl' => $data['paymentUrl'],
                    'reference' => $data['reference'] ?? null
                ];
            }

            // Return full response for debugging
            return [
                'success' => false,
                'statusMessage' => $data['statusMessage'] ?? ($data['Message'] ?? 'Duitku Raw: ' . $rawBody)
            ];

        } catch (\Exception $e) {
            return ['success' => false, 'statusMessage' => 'Connection Error: ' . $e->getMessage()];
        }
    }
}
