<?php
/**
 * @title RSA加解密类
 * @author 大叔在睡觉
 * @email 390940063@qq.com
 * @date 2024-04-25
 */
namespace Jsonlie\MiniAesTool;

use Jsonlie\MiniAesTool\Api\Base;
use Jsonlie\MiniAesTool\Service\Rsa\RsaService;

class Rsa implements Base
{
    //待加解密数据
    protected $pending;
    //加解密公钥
    protected $public_key;
    //加解密私钥
    protected $private_key;

    /**
     * 设置参数
     * @param $params
     * @return void
     */
    public function setParams($params){
        if(is_array($params) && !empty($params)){
            foreach($params as $key => $param){
                $this->$key = $param;
            }
        }
    }

    /**
     * 加密
     * @return false|mixed|string
     */
    public function encrypt()
    {
        return RsaService::encrypt($this->pending,$this->public_key);
    }

    /**
     * 解密
     * @return false|mixed|string
     */
    public function decrypt()
    {
        return RsaService::decrypt($this->pending,$this->private_key);
    }
}