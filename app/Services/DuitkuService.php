<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DuitkuService
{
    protected $merchantCode;
    protected $apiKey;
    protected $callbackUrl;
    protected $baseUrl;

    public function __construct()
    {
        $this->merchantCode = env('DUITKU_MERCHANT_CODE');
        $this->apiKey = env('DUITKU_API_KEY');
        $this->callbackUrl = env('DUITKU_CALLBACK_URL');
        $this->baseUrl = env('DUITKU_SANDBOX', true)
            ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
            : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
    }

    public function createInvoice($transaction, $participant, $package)
    {
        $paymentAmount = (int) $transaction->amount; // Ensure integer
        $merchantOrderId = $transaction->order_id;
        $productDetails = $package->name . ' - Batch ' . $package->batch_number;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => 'VC', // Default to Credit Card (VC) for Sandbox Test or let blank if allowed. Error said mandatory so let's try 'VC' or 'BK'
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
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Content-Length' => strlen(json_encode($params))
            ])->post($this->baseUrl, $params);

            // Log response for debugging
            if (!$response->successful()) {
                \Illuminate\Support\Facades\Log::error('Duitku API Error: ' . $response->body());
            }

            return $response->json();

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Duitku Connection Error: ' . $e->getMessage());
            return ['statusCode' => '500', 'statusMessage' => $e->getMessage()];
        }
    }
}
