<?php
/**
 * @title RSA加解密服务层
 * @author 大叔在睡觉
 * @email 390940063@qq.com
 * @date 2024-04-25
 */
namespace Jsonlie\MiniAesTool\Service\Rsa;

class RsaService
{

    /**
     * 加密
     * @param $str
     * @param $public_key
     * @return false|string
     */
    public static function encrypt($str,$public_key){
        try {
            $pub_key = openssl_pkey_get_public($public_key);
            if(empty($pub_key)){
                throw new \Exception('无效公钥');
            }
            $en_str = '';
            $res = openssl_public_encrypt($str, $en_str, $pub_key);
            if(empty($res)){
                throw new \Exception('加密失败');
            }
            return base64_encode($en_str);
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * 解密
     * @param $str
     * @param $private_key
     * @return false|string
     */
    public static function decrypt($str,$private_key){
        try {
            $pri_key = openssl_pkey_get_private($private_key);
            if(empty($pri_key)){
                throw new \Exception('无效私钥');
            }
            $de_str = '';
            $res = openssl_private_decrypt(base64_decode($str), $de_str, $pri_key);
            if(empty($res)){
                throw new \Exception('解密失败');
            }
            return $de_str;
        }catch (\Exception $exception){
            return false;
        }
    }
}