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

        // Redirection Checkout URL (This endpoint allows user to choose payment method on Duitku site)
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

        // Standard flat parameters for Redirection API
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
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('Duitku Redirect Request: ', $params);

            // Use asForm() for the redirection endpoint as it historically expects form data
            $response = Http::asJson()->post($this->checkoutUrl, $params);

            Log::info('Duitku Redirect Response Raw: ' . $response->body());

            $data = $response->json();

            if (isset($data['paymentUrl'])) {
                return [
                    'success' => true,
                    'paymentUrl' => $data['paymentUrl'],
                    'reference' => $data['reference'] ?? null
                ];
            }

            // Fallback: If not JSON or error, try to get specific message
            $errorMsg = $data['statusMessage'] ?? ($data['Message'] ?? 'An error occurred at Duitku side.');

            return [
                'success' => false,
                'statusMessage' => $errorMsg
            ];

        } catch (\Exception $e) {
            Log::error('Duitku Redirect Connection Error: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => 'Gagal terhubung ke server pembayaran: ' . $e->getMessage()];
        }
    }
}
