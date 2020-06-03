<?php

namespace VCComponent\Laravel\Payment\Http\Response;

use Illuminate\Http\Request;
use VCComponent\Laravel\Payment\Contracts\PaymentResponse;
use VCComponent\Laravel\Payment\Traits\Helpers;

class VnpayResponse {
    use Helpers;

    public function __construct(PaymentResponse $response) {
        $this->response = $response;
    }

    public function __invoke(Request $request) {
        if ($request->all() == []) {
            return redirect('/');
        }

        $config = $this->configVnpay();

        $vnp_TmnCode    = $config['vnp_TmnCode'];
        $vnp_HashSecret = $config['vnp_HashSecret'];
        $vnp_Url        = $config['vnp_Url'];
        $vnp_Returnurl  = $config['vnp_ReturnUrl'];

        $inputData  = array();
        $returnData = array();
        $data       = $request->all();

        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;

            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i        = 0;
        $hashData = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i        = 1;
            }
        }

        $vnpTranId    = $inputData['vnp_TransactionNo'];
        $vnp_BankCode = $inputData['vnp_BankCode'];
        $secureHash   = hash('sha256', $vnp_HashSecret . $hashData);

        if ($inputData['vnp_ResponseCode'] == '00') {
            $messages = [
                'status'        => true,
                'notifications' => "Success",
            ];
        } else {
            $messages = [
                'status'        => false,
                'notifications' => "Error",
            ];
        }

        try {
            if ($secureHash == $vnp_SecureHash) {
                $returnData = [
                    'cart_id'   => $inputData['vnp_TxnRef'],
                    'messages'  => $messages,
                    'bank_code' => $inputData['vnp_BankCode'],
                    'vnp_code'  => $inputData['vnp_TransactionNo'],
                ];
            } else {
                $returnData['messages'] = [
                    'status'        => false,
                    'notifications' => "Sai chữ kí !",
                ];
            }
        } catch (Exception $e) {
             $returnData['messages'] = [
                    'status'        => false,
                    'notifications' => "Unknown errors !",
                ];
        }

        return $this->response->excute($returnData);
    }
}
