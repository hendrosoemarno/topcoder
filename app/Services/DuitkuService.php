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

        // Use lowercase createinvoice endpoint
        $this->checkoutUrl = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/createinvoice'
            : 'https://passport.duitku.com/webapi/api/merchant/createinvoice';
    }

    public function createInvoice($transaction, $participant, $package)
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = substr($package->name, 0, 50); // Limit length

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        // Clean and validate phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '');
        if (empty($phoneNumber) || strlen($phoneNumber) < 10) {
            $phoneNumber = '081234567890'; // Fallback valid number
        }
        if (!str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '0' . $phoneNumber;
        }

        // Clean customer name - remove spaces and special chars
        $customerName = preg_replace('/[^a-zA-Z0-9]/', '', $participant->name);
        $customerName = substr($customerName, 0, 20);

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => $customerName,
            'email' => $participant->email,
            'phoneNumber' => $phoneNumber,
            'itemDetails' => [
                [
                    'name' => substr($package->name, 0, 50),
                    'price' => $paymentAmount,
                    'quantity' => 1
                ]
            ],
            'customerDetail' => [
                'firstName' => $customerName,
                'email' => $participant->email,
            ],
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('=== DUITKU REQUEST ===');
            Log::info('URL: ' . $this->checkoutUrl);
            Log::info('Merchant: ' . $this->merchantCode);
            Log::info('Order ID: ' . $merchantOrderId);
            Log::info('Amount: ' . $paymentAmount);
            Log::info('Signature: ' . $signature);
            Log::info('Full Params: ', $params);

            $response = Http::post($this->checkoutUrl, $params);

            $responseBody = $response->body();
            Log::info('=== DUITKU RESPONSE ===');
            Log::info('Status Code: ' . $response->status());
            Log::info('Body: ' . $responseBody);

            $data = $response->json();

            if (isset($data['paymentUrl'])) {
                Log::info('SUCCESS: Payment URL received - ' . $data['paymentUrl']);
                return [
                    'success' => true,
                    'paymentUrl' => $data['paymentUrl'],
                    'reference' => $data['reference'] ?? null
                ];
            }

            Log::error('FAILED: No paymentUrl in response');

            $errorMsg = $data['statusMessage'] ?? ($data['Message'] ?? 'Unknown error');

            return [
                'success' => false,
                'statusMessage' => $errorMsg . ' (Check logs for details)'
            ];

        } catch (\Exception $e) {
            Log::error('EXCEPTION: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return ['success' => false, 'statusMessage' => 'Connection error: ' . $e->getMessage()];
        }
    }
}
