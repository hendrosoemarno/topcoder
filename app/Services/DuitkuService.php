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

        // Use createInvoice endpoint for redirection checkout
        $this->checkoutUrl = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/createInvoice'
            : 'https://passport.duitku.com/webapi/api/merchant/createInvoice';
    }

    public function createInvoice($transaction, $participant, $package)
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = $package->name;

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        // Clean phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '08123456789');
        if (!str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '0' . $phoneNumber;
        }

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => substr($participant->name, 0, 20),
            'email' => $participant->email,
            'phoneNumber' => $phoneNumber,
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('=== DUITKU REQUEST ===');
            Log::info('URL: ' . $this->checkoutUrl);
            Log::info('Params: ', $params);

            $response = Http::asForm()->post($this->checkoutUrl, $params);

            $responseBody = $response->body();
            Log::info('=== DUITKU RESPONSE ===');
            Log::info('Status Code: ' . $response->status());
            Log::info('Body: ' . $responseBody);

            $data = $response->json();

            if (isset($data['paymentUrl'])) {
                Log::info('SUCCESS: Payment URL received');
                return [
                    'success' => true,
                    'paymentUrl' => $data['paymentUrl'],
                    'reference' => $data['reference'] ?? null
                ];
            }

            Log::error('FAILED: No paymentUrl in response');

            return [
                'success' => false,
                'statusMessage' => $data['statusMessage'] ?? ($data['Message'] ?? 'Response: ' . substr($responseBody, 0, 200))
            ];

        } catch (\Exception $e) {
            Log::error('EXCEPTION: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => 'Error: ' . $e->getMessage()];
        }
    }
}
