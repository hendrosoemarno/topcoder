<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DuitkuService
{
    protected $merchantCode;
    protected $apiKey;
    protected $callbackUrl;
    protected $baseUrl;
    protected $isSandbox;

    public function __construct()
    {
        $this->merchantCode = env('DUITKU_MERCHANT_CODE');
        $this->apiKey = env('DUITKU_API_KEY');
        $this->callbackUrl = env('DUITKU_CALLBACK_URL');
        $this->isSandbox = (bool) env('DUITKU_SANDBOX', true);
        $this->baseUrl = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
            : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
    }

    public function getPaymentMethods($amount)
    {
        $datetime = date('Y-m-d H:i:s');
        $signature = hash('sha256', $this->merchantCode . $amount . $datetime . $this->apiKey);

        $url = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getlist'
            : 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getlist';

        try {
            $response = Http::post($url, [
                'merchantCode' => $this->merchantCode,
                'amount' => (int) $amount,
                'datetime' => $datetime,
                'signature' => $signature
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return ['paymentFee' => []];
        }
    }

    public function createInvoice($transaction, $participant, $package, $paymentMethod)
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = $package->name . ' - Batch ' . $package->batch_number;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => $participant->name,
            'email' => $participant->email,
            'phoneNumber' => $participant->whatsapp,
            'customerDetail' => [
                'firstName' => $participant->name,
                'email' => $participant->email,
                'phoneNumber' => $participant->whatsapp,
                'billingAddress' => [
                    'firstName' => $participant->name,
                    'address' => $participant->address,
                    'city' => $participant->city,
                    'postalCode' => $participant->postal_code,
                    'phone' => $participant->whatsapp,
                    'countryCode' => 'ID'
                ]
            ],
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            $response = Http::post($this->baseUrl, $params);

            \Illuminate\Support\Facades\Log::info('Duitku Response Raw: ' . $response->body());

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
            \Illuminate\Support\Facades\Log::error('Duitku Connection Error: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => $e->getMessage()];
        }
    }
}
