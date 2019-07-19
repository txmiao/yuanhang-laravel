<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthRecordByYsePay extends Model
{
    protected $table = 'auth_record_by_yse_pays';
    protected $guarded = ['_token'];
    protected $casts = [
        'request_data' => 'array',
        'response_data' => 'array',
    ];

    /**
     * 校验真实性
     * @param Authentication $authentication
     * @return array
     * @throws \Exception
     */
    public function verify_facticity(Authentication $authentication)
    {
        //订单号
        $outTradeNo = date('Ymd') . $authentication->id . str_random(8);

        //构建请求数据
        $requestParams = $this->build_request_params($outTradeNo, $authentication);
        $requestParams['sign'] = $this->get_signature($requestParams);

//        dd($requestParams);
        $res = curlRequest(config('yse_pay.yse_pay_auth_url'), null, $requestParams);
        $res = json_decode($res, true);
//        dd($res);

        //银盛支付实名认证记录
        $authData = [
            'out_trade_no' => $outTradeNo,
            'authentication_id' => $authentication->id,
            'order_status' => (isset($res[config('yse_pay.yse_pay_auth_response_name')]['sub_code'])
                && isset($res[config('yse_pay.yse_pay_auth_response_name')]['sub_msg'])) ? 'failure' : 'success',
            'request_data' => $authentication->toArray(),
            'response_data' => $res
        ];

        return compact('authData', 'res');
    }

    /**
     * 构建请求数据
     * @param string $outTradeNo
     * @param Authentication $authentication
     * @return array
     */
    private function build_request_params(string $outTradeNo, Authentication $authentication): array
    {
        $businessData = [
            'out_trade_no' => $outTradeNo,
            'shopdate' => date('Ymd', time()),
            'bank_account_name' => $authentication->real_name,
            'bank_account_no' => $authentication->account_number,
            'id_card' => $authentication->id_card_number,
        ];
        $authentication->bank_mobile && array_merge($businessData, [
            'bank_mobile' => $authentication->bank_mobile
        ]);

        return [
            'method' => config('yse_pay.yse_pay_auth_method'),
            'partner_id' => config('yse_pay.yse_pay_auth_partner_id'),
            'timestamp' => date('Y-m-d H:i:s', time()),
            'charset' => config('yse_pay.yse_pay_auth_charset'),
            'sign_type' => 'RSA',
            'version' => config('yse_pay.yse_pay_auth_version'),
            'biz_content' => json_encode($businessData, JSON_UNESCAPED_UNICODE)
        ];
    }

    /**
     * 获取签名
     * @param array $data
     * @return string
     */
    private function get_signature(array $data): string
    {
        $signature = '';
        ksort($data);
        $signStr = '';
        foreach ($data as $key => $val) {
            $signStr .= $key . '=' . $val . '&';
        }
        $signStr = rtrim($signStr, '&');
        $pkcs12 = file_get_contents(public_path('certs/' . config('yse_pay.yse_pay_auth_partner_id') . '.pfx')); //私钥
        if (openssl_pkcs12_read($pkcs12, $certs, config('yse_pay.yse_pay_pfxpassword'))) {
            if (openssl_sign($signStr, $signature, $certs['pkey'], OPENSSL_ALGO_SHA1)) {
                $signature = base64_encode($signature);
            }
        }

        return $signature;
    }

    /**
     * 检验签名
     * @param $sign
     * @param $data
     * @return int
     */
    public function sign_check($sign, $data)
    {
        $certificateCAcerContent = file_get_contents(public_path("certs/businessgate.cer"));
        $certificateCApemContent = '-----BEGIN CERTIFICATE-----' . PHP_EOL . chunk_split(base64_encode($certificateCAcerContent), 64, PHP_EOL) . '-----END CERTIFICATE-----' . PHP_EOL;
        \Log::info("验签密钥" . $certificateCApemContent);
        // 签名验证
        $success = openssl_verify($data, base64_decode($sign), openssl_get_publickey($certificateCApemContent), OPENSSL_ALGO_SHA1);
        \Log::info($success);

        return $success;
    }
}
