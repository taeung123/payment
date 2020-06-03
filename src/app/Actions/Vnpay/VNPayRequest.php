<?php

namespace VCComponent\Laravel\Payment\Actions\Vnpay;

use VCComponent\Laravel\Payment\Traits\Helpers;
use VCComponent\Laravel\Payment\Contracts\PaymentRequest;
use VCComponent\Laravel\Payment\Contracts\PaymentRequestEloquent as BaseRequest;

class VNPayRequest extends BaseRequest implements PaymentRequest
{
    use Helpers;

    public function excute(array $data)
    {
        $config = $this->configVnpay();

        $vnp_TmnCode    = $config['vnp_TmnCode'];
        $vnp_HashSecret = $config['vnp_HashSecret'];
        $vnp_Url        = $config['vnp_Url'];
        $vnp_ReturnUrl  = $config['vnp_ReturnUrl'];

        $inputData = array(
            "vnp_Version"    => "2.0.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $this->getTotal($data) * 100,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $this->getUserId($data),
            "vnp_Locale"     => 'vn',
            "vnp_OrderInfo"  => $this->getNote($data),
            "vnp_ReturnUrl"  => $vnp_ReturnUrl,
            "vnp_TxnRef"     => $this->getOrderId($data),
        );

        ksort($inputData);
        $query    = "";
        $i        = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash               = hash('sha256', $vnp_HashSecret . $hashdata);
            $inputData['vnp_SecureHash'] = $vnpSecureHash;
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);

    }
}
