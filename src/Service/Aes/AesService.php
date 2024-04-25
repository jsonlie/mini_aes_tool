<?php
/**
 * @title AES加解密服务层
 * @author 大叔在睡觉
 * @email 390940063@qq.com
 * @date 2024-04-25
 */
namespace Jsonlie\MiniAesTool\Service\Aes;

class AesService
{
    /**
     * 加密方法
     * @param string $str
     * @return string|bool
     */
    public static function encrypt($str, $screct_key)
    {
        try {
            //AES, 128 模式加密数据 CBC
            $screct_key = base64_decode($screct_key);
            $str = trim($str);
            $str = self::addPKCS7Padding($str);

            //设置全0的IV
            $iv = str_repeat("\0", 16);
            $encrypt_str = openssl_encrypt($str, 'aes-128-cbc', $screct_key, OPENSSL_NO_PADDING, $iv);
            return base64_encode($encrypt_str);
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * 解密方法
     * @param string $str
     * @return string|bool
     */
    public static function decrypt($str, $screct_key)
    {
        try {
            //AES, 128 模式加密数据 CBC
            $str = base64_decode($str);
            $screct_key = base64_decode($screct_key);

            //设置全0的IV
            $iv = str_repeat("\0", 16);
            $decrypt_str = openssl_decrypt($str, 'aes-128-cbc', $screct_key, OPENSSL_NO_PADDING, $iv);
            return self::stripPKSC7Padding($decrypt_str);
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * 填充算法
     * @param string $source
     * @return string
     */
    public static function addPKCS7Padding($source)
    {
        $source = trim($source);
        $block = 16;

        $pad = $block - (strlen($source) % $block);
        if ($pad <= $block) {
            $char = chr($pad);
            $source .= str_repeat($char, $pad);
        }
        return $source;
    }

    /**
     * 移去填充算法
     * @param string $source
     * @return string
     */
    public static function stripPKSC7Padding($source)
    {
        $char = substr($source, -1);
        $num = ord($char);
        if ($num == 62) return $source;
        return substr($source, 0, -$num);
    }
}