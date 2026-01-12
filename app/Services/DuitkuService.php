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

    public function __construct()
    {
        $this->merchantCode = trim(env('DUITKU_MERCHANT_CODE'));
        $this->apiKey = trim(env('DUITKU_API_KEY'));
        $this->callbackUrl = trim(env('DUITKU_CALLBACK_URL'));
        $this->isSandbox = (bool) env('DUITKU_SANDBOX', true);
    }

    private function getInquiryUrl()
    {
        return $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
            : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
    }

    public function createInvoice($transaction, $participant, $package, $paymentMethod = 'SP')
    {
        $paymentAmount = (int) $transaction->amount;
        $merchantOrderId = $transaction->order_id;
        $productDetails = substr($package->name, 0, 50);

        // Signature: merchantCode + merchantOrderId + paymentAmount + apiKey
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        // Clean phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $participant->whatsapp ?? '');
        if (empty($phoneNumber) || strlen($phoneNumber) < 10) {
            $phoneNumber = '081234567890';
        }
        if (!str_starts_with($phoneNumber, '0')) {
            $phoneNumber = '0' . $phoneNumber;
        }

        // Clean customer name
        $firstName = preg_replace('/[^a-zA-Z ]/', '', $participant->name);
        $firstName = substr($firstName, 0, 20);

        // Build address
        $address = [
            'firstName' => $firstName,
            'lastName' => '',
            'address' => $participant->address ?? 'Jakarta',
            'city' => $participant->city ?? 'Jakarta',
            'postalCode' => $participant->postal_code ?? '10110',
            'phone' => $phoneNumber,
            'countryCode' => 'ID'
        ];

        // Build customer detail
        $customerDetail = [
            'firstName' => $firstName,
            'lastName' => '',
            'email' => $participant->email,
            'phoneNumber' => $phoneNumber,
            'billingAddress' => $address,
            'shippingAddress' => $address
        ];

        // Build item details
        $itemDetails = [
            [
                'name' => substr($package->name, 0, 50),
                'price' => $paymentAmount,
                'quantity' => 1
            ]
        ];

        $params = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod, // REQUIRED!
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => $productDetails,
            'additionalParam' => '',
            'merchantUserInfo' => $participant->email,
            'customerVaName' => $firstName,
            'email' => $participant->email,
            'phoneNumber' => $phoneNumber,
            'itemDetails' => $itemDetails,
            'customerDetail' => $customerDetail,
            'callbackUrl' => $this->callbackUrl,
            'returnUrl' => route('dashboard'),
            'expiryPeriod' => 60,
            'signature' => $signature
        ];

        try {
            Log::info('=== DUITKU V2 INQUIRY REQUEST ===');
            Log::info('URL: ' . $this->getInquiryUrl());
            Log::info('Payment Method: ' . $paymentMethod);
            Log::info('Full Params: ', $params);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->getInquiryUrl(), $params);

            $responseBody = $response->body();
            Log::info('=== DUITKU RESPONSE ===');
            Log::info('Status Code: ' . $response->status());
            Log::info('Body: ' . $responseBody);

            if ($response->status() == 200) {
                $data = $response->json();

                if (isset($data['paymentUrl'])) {
                    Log::info('SUCCESS: Payment URL received');
                    return [
                        'success' => true,
                        'paymentUrl' => $data['paymentUrl'],
                        'reference' => $data['reference'] ?? null,
                        'vaNumber' => $data['vaNumber'] ?? null
                    ];
                }
            }

            $data = $response->json();
            $errorMsg = $data['statusMessage'] ?? ($data['Message'] ?? 'Unknown error from Duitku');

            Log::error('FAILED: ' . $errorMsg);

            return [
                'success' => false,
                'statusMessage' => $errorMsg
            ];

        } catch (\Exception $e) {
            Log::error('EXCEPTION: ' . $e->getMessage());
            return ['success' => false, 'statusMessage' => 'Connection error: ' . $e->getMessage()];
        }
    }

    public function getPaymentMethods($amount)
    {
        $amount = (int) $amount; // Force integer for signature
        $datetime = date('Y-m-d H:i:s');
        $signature = hash('sha256', $this->merchantCode . $amount . $datetime . $this->apiKey);

        $url = $this->isSandbox
            ? 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'
            : 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';

        try {
            Log::info('=== GET PAYMENT METHODS REQUEST ===');
            Log::info('URL: ' . $url);
            Log::info('Merchant Code: ' . $this->merchantCode);
            Log::info('Amount: ' . $amount);
            Log::info('Datetime: ' . $datetime);
            Log::info('Signature: ' . $signature);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, [
                        'merchantcode' => $this->merchantCode,
                        'amount' => (int) $amount,
                        'datetime' => $datetime,
                        'signature' => $signature
                    ]);

            Log::info('=== GET PAYMENT METHODS RESPONSE ===');
            Log::info('Status Code: ' . $response->status());
            Log::info('Body: ' . $response->body());

            if ($response->successful()) {
                $data = $response->json();
                Log::info('Payment Methods Found: ' . count($data['paymentFee'] ?? []));
                return $data['paymentFee'] ?? [];
            }

            Log::error('Failed to get payment methods - Status: ' . $response->status());
            return [];
        } catch (\Exception $e) {
            Log::error('Get Payment Methods Error: ' . $e->getMessage());
            return [];
        }
    }
}
