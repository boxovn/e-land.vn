<?php

namespace Custom;

/**
 * Created by PhpStorm.
 * User: Hieu
 * Date: 16/09/2014
 * Time: 09:18
 */
//CẤU HÌNH TÀI KHOẢN (Configure account)
define('EMAIL_BUSINESS', 'webxanhdotcom@gmail.com'); //Email Bảo kim
define('MERCHANT_ID', '18062');                // Mã website tích hợp
define('SECURE_PASS', '7d5ae6967b1a054e');   // Mật khẩu
// Cấu hình tài khoản tích hợp
define('API_USER', 'webxanhdotcom@gmail.com');  //API USER
define('API_PWD', '1kHOpy3h8zRFV464NnLT2QqB0GZW3');       //API PASSWORD
define('PRIVATE_KEY_BAOKIM', '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC6AsQapwtDFKce
EUUPcyRDqMB4y9e+9kCGwYkManme525l2GZ7Vl0BIaw7Nh1NvWo9GlRGPSkMhMtO
aFm8rn9K4EOR5b30ZUwiT5isSYdHIES0neEQ7bJVCsj3w8srWIjcG06I+LlVoSFR
EigOolu0Cq+CXFJQuRyxpFtSwnFqvz/Iz7KYwAjzKKsXpdR7W/MGpIj4iGBZpFci
VH9hX8h+/zdvWJL5/6Ye75kg6EAl+Hdvn0zgwoSZ9wakQTh15HY2qzY752TckGgK
aiI/1PN6IRuxMGWRxQ94g0vKsGBGvxmykTA4/w+d6myMuCJEbpsI5yGxfFUH93Da
Ic+AJXCLAgMBAAECggEAPFMFUjd2WYzrHb8wDHClBCRIN2S0VUP7bTh6v8IQK06W
6QSjR8CcbO+Esbc9DacuOx680gKnu12dqZIB+EUHFztf7oL5dbccV8xEkStPaeu3
HHRPN3Q+74GN53xh+W6/A9L/R0CSqoiVC3u97fENmHgWr0pNj8xY1+ubil1w9tL9
jLmLthlzH7m1UbnN2X5tioySfQyy/CPqqVJSP5Zg5rmnnXwJu2zlobSVjdICsbGJ
HiuA0GiDHsbQ8deMcSAM184ABr753m0D12bZT60lJ/izEbvbBVIcDmnQRCYPag3p
0VbeqnCRI/5KD5xWT4Vpi4R1TU5db5y977rrke78EQKBgQDniN084OmaPFsDZh6O
Oj8ScewtSfCP1AquwyiV6GmztP0+oerO0VrWXOeRC/DcHlCjEhhdf413FYKivAMU
fIc7NVHMeyfYw7WgkuDkVJXkGv81B6OrX9da1xCUlJR+SYils6WdwiODhAk5JOK5
1l33s9ZlJSzM47c5IIpPpNT0lQKBgQDNqnVC0jOk+UfTKGvLF79lsC5P9HZtC76H
eX1XCHSR2VJtT19GFJHQ9IVCFbG91uU/ix8GXLwUoeSULL9gsiAXbTyB9DcxW9x2
VAUNwe1cu+EKEZsHBtGTks2fH0rKWxkQu0re1ipNGZ8fVxYpY6M11Xyl4fQBrH/X
/L5EnDFonwKBgEJZ4XTZy3gMxdRCho0hugNyLEmKP+sny+vrN41GLkx2mIBDbIPa
URrPQvk5H8wkz9z7iYn5zLOMsYQrNwK+8Q4RqKBdxryC0WDz1oj4iH/3EJ3E061/
6Lo6maDKt4c9UXCS++oqwXyl8PK0VFkHSqR6n/0aWy1YMKCpZ5mNVg3FAoGBAJ94
2h3rIfJ8/K2F/TdofZea6f5DX4Skg6NGl+LhgooJCjoKPqT3lC2DPMUGT2EVfYMt
G+xyAcC526TtoaOX2vxvTmix9g4G3ca+1YBaa/PpFtEY362uItmcDmag+/w2cRQh
NifdxsUr5c+GVn/Xa5l1pYZ20x5tJGBU8TAAMOufAoGAY6Pf/483/7dmq0fEaflZ
aeFQvdWSJzqCZ4ufQps8EdF1SMtFro4/yKSxS6VqH/9XAk86Xxo1FTJ+f1LRWsNO
2/UCElG6iuvfK1/Qc6WwjRPvP6iM9GmJwrdu+tKmDiARfK1RIIPtf+NU6d51ihyg
34+xQpGfJVzabcaTRodWJ2k=
-----END PRIVATE KEY-----');

define('BAOKIM_API_SELLER_INFO', '/payment/rest/payment_pro_api/get_seller_info');
define('BAOKIM_API_PAY_BY_CARD', '/payment/rest/payment_pro_api/pay_by_card');
define('BAOKIM_API_PAYMENT', '/payment/order/version11');
define('BAOKIM_API_INFO',' /payment/order/queryTransaction');

define('BAOKIM_URL', 'https://www.baokim.vn');
//define('BAOKIM_URL','http://kiemthu.baokim.vn');
//Phương thức thanh toán bằng thẻ nội địa
define('PAYMENT_METHOD_TYPE_LOCAL_CARD', 1);
//Phương thức thanh toán bằng thẻ tín dụng quốc tế
define('PAYMENT_METHOD_TYPE_CREDIT_CARD', 2);
//Dịch vụ chuyển khoản online của các ngân hàng
define('PAYMENT_METHOD_TYPE_INTERNET_BANKING', 3);
//Dịch vụ chuyển khoản ATM
define('PAYMENT_METHOD_TYPE_ATM_TRANSFER', 4);
//Dịch vụ chuyển khoản truyền thống giữa các ngân hàng
define('PAYMENT_METHOD_TYPE_BANK_TRANSFER', 5);

class Payment {

    public $url_success;
    public $url_cancel;
    public $vnd;

    /**
     * Call API GET_SELLER_INFO
     *  + Create bank list show to frontend
     *
     * @internal param $method_code
     * @return string
     */
    public function get_seller_info() {
        $param = array(
            'business' => EMAIL_BUSINESS,
        );
        $call_API = $this->call_API("GET", $param, BAOKIM_API_SELLER_INFO);
        if (is_array($call_API)) {
            if (isset($call_API['error'])) {
                return "<strong style='color:red'>call_API" . json_encode($call_API['error']) . "- code:" . $call_API['status'] . "</strong> - " . "System error. Please contact to administrator";
            }
        }

        $seller_info = json_decode($call_API, true);
        if (!empty($seller_info['error'])) {
            return "<strong style='color:red'>eller_info" . json_encode($seller_info['error']) . "</strong> - " . "System error. Please contact to administrator";
        }

        $banks = $seller_info['bank_payment_methods'];

        return $banks;
    }

    /**
     * Call API PAY_BY_CARD
     *  + Get Order info
     *  + Sent order, action payment
     *
     * @param $orderid
     * @return mixed
     */
    public function pay_by_card($data) {
        $base_url = "http://" . $_SERVER['SERVER_NAME'];
        $url_success = $base_url . '/success';
        $url_cancel = $base_url . '/cancel';
        $order_id = $data['order_id'];
        $total_amount = str_replace('.', '', $data['total_amount']);

        $params['business'] = strval(EMAIL_BUSINESS);
        $params['bank_payment_method_id'] = intval($data['bank_payment_method_id']);
        $params['transaction_mode_id'] = '1'; // 2- trực tiếp
        $params['escrow_timeout'] = 3;

        $params['order_id'] = $order_id;
        $params['total_amount'] = $total_amount * $this->vnd;
        $params['shipping_fee'] = '0';
        $params['tax_fee'] = '0';
        $params['currency_code'] = 'VND'; // USD

        $params['url_success'] = $this->url_success;
        $params['url_cancel'] = $this->url_cancel;
        $params['url_detail'] = '';

        $params['order_description'] = 'Thanh toán đơn hàng từ Website ' . $base_url . ' với mã đơn hàng ' . $order_id;
        $params['payer_name'] = $data['name'];
        $params['payer_email'] = $data['email'];
        $params['payer_phone_no'] = $data["phone"];
        $params['payer_address'] = "12 dien bien phu";


        $result = json_decode($this->call_API("POST", $params, BAOKIM_API_PAY_BY_CARD), true);

        //echo "<pre>";print_r($result);die; 
        if (!empty($result['error'])) {
            echo '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">' . $result['error'];
            return false;
        }
        $baokim_url = isset($result['redirect_url']) ? $result['redirect_url'] : $result['guide_url'];

        return ['url' => $baokim_url, 'id' => $result['rvid']];
    }

    /**
     * tao image cho ngan hang
     * @param type $banks
     * @param type $payment_method_type
     * @return string
     */
    public function generateBankImage($banks, $payment_method_type) {
        $html = '';

        foreach ($banks as $bank) {
            if ($bank['payment_method_type'] == $payment_method_type) {
                $html .= '<li><img class="img-bank"   id="' . $bank['id'] . '" src="' . $bank['logo_url'] . '" title="' . $bank['name'] . '"/></li>';
            }
        }
        return $html;
    }

    /**
     * Gọi API Bảo Kim thực hiện thanh toán với thẻ ngân hàng
     *
     * @param $method Sử dụng phương thức GET, POST cho với từng API
     * @param $data Dữ liệu gửi đên Bảo Kim
     * @param $api API được gọi sang Bảo Kim
     * @param $object WC_Gateway_Baokim_Pro
     * @var $object WC_Gateway_Baokim_Pro
     * @return mixed
     */
    function call_API($method, $data, $api) {
        $business = EMAIL_BUSINESS;
        $username = API_USER;
        $password = API_PWD;
        $private_key = PRIVATE_KEY_BAOKIM;
        $server = BAOKIM_URL;

        $arrayPost = array();
        $arrayGet = array();

        ksort($data);
        if ($method == 'GET') {
            $arrayGet = $data;
        } else {
            $arrayPost = $data;
        }

        $signature = $this->makeBaoKimAPISignature($method, $api, $arrayGet, $arrayPost, $private_key);
        $url = $server . $api . '?' . 'signature=' . $signature . (($method == "GET") ? $this->createRequestUrl($data) : '');
        $curl = curl_init($url);
        //	Form
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST | CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        if ($method == 'POST') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->httpBuildQuery($arrayPost));
        }

        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        if (empty($result)) {
            return array(
                'status' => $status,
                'error' => $error
            );
        }
        return $result;
    }

    /**
     * Hàm thực hiện việc tạo chữ ký với dữ liệu gửi đến Bảo Kim
     *
     * @param $method
     * @param $url
     * @param array $getArgs
     * @param array $postArgs
     * @param $priKeyFile
     * @return string
     */
    private function makeBaoKimAPISignature($method, $url, $getArgs = array(), $postArgs = array(), $priKeyFile) {
        if (strpos($url, '?') !== false) {
            list($url, $get) = explode('?', $url);
            parse_str($get, $get);
            $getArgs = array_merge($get, $getArgs);
        }
        ksort($getArgs);
        ksort($postArgs);
        $method = strtoupper($method);

        $data = $method . '&' . urlencode($url) . '&' . urlencode(http_build_query($getArgs)) . '&' . urlencode(http_build_query($postArgs));

        $priKey = openssl_get_privatekey($priKeyFile);
        assert('$priKey !== false');

        $x = openssl_sign($data, $signature, $priKey, OPENSSL_ALGO_SHA1);
        assert('$x !== false');
        return urlencode(base64_encode($signature));
    }

    /**
     * 
     * @param type $formData
     * @param type $numericPrefix
     * @param type $argSeparator
     * @param type $arrName
     * @return type
     */
    private function httpBuildQuery($formData, $numericPrefix = '', $argSeparator = '&', $arrName = '') {
        $query = array();
        foreach ($formData as $k => $v) {
            if (is_int($k))
                $k = $numericPrefix . $k;
            if (is_array($v))
                $query[] = httpBuildQuery($v, $numericPrefix, $argSeparator, $k);
            else
                $query[] = rawurlencode(empty($arrName) ? $k : ($arrName . '[' . $k . ']')) . '=' . rawurlencode($v);
        }

        return implode($argSeparator, $query);
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    private function createRequestUrl($data) {
        $params = $data;
        ksort($params);
        $url_params = '';
        foreach ($params as $key => $value) {
            if ($url_params == '')
                $url_params .= $key . '=' . urlencode($value);
            else
                $url_params .= '&' . $key . '=' . urlencode($value);
        }
        return "&" . $url_params;
    }

    /**
     * Hàm thực hiện xác minh tính chính xác thông tin trả về từ BaoKim.vn
     * @param $url_params chứa tham số trả về trên url
     * @return true nếu thông tin là chính xác, false nếu thông tin không chính xác
     */
    public function verifyResponseUrl($url_params = array()) {
       
        if (!isset($url_params['checksum'])) {
            //echo "invalid parameters: checksum is missing";
            return FALSE;
        }

        $checksum = $url_params['checksum'];
        unset($url_params['checksum']);

        ksort($url_params);

        if (strcasecmp($checksum, hash_hmac('SHA1', implode('', $url_params), SECURE_PASS)) === 0)
            return TRUE;
        else
            return FALSE;
    }
    
    /**
     * 
     */
    public function checkOrder($order_id,$transaction_id){
        $data = array(
            'order_id' => $order_id,
            'transaction_id' => transaction_id,
            'merchant_id' => MERCHANT_ID
        );
        ksort($data);
        $data['checksum'] = hash_hmac('SHA1', implode('', $data), SECURE_PASS);
        $result = $this->call_API("GET", $data, BAOKIM_API_INFO);
        echo "<pre>";var_dump($result);die;
    }

}
