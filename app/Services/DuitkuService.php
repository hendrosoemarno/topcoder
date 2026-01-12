<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
        $productDetails = $package->name . ' - Batch ' . $package->batch_number;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => $participant->name,
            'email' => $participant->email,
            'phoneNumber' => $participant->whatsapp,
            'itemDetails' => [
                [
                    'name' => $package->name,
                    'price' => $paymentAmount,
                    'quantity' => 1
                ]
            ],
            'customerDetail' => [
                'firstName' => $participant->name,
                'email' => $participant->email,
                'phoneNumber' => $participant->whatsapp,
            ],
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            $response = Http::post($this->checkoutUrl, $params);

            \Illuminate\Support\Facades\Log::info('Duitku Checkout Response: ' . $response->body());

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
                'statusMessage' => $data['statusMessage'] ?? ($data['Message'] ?? 'Unknown Error from Duitku')
            ];

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Duitku Checkout Connection Error: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => $e->getMessage()];
        }
    }
}
