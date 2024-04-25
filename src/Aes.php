<?php
/**
 * @title AES加解密类
 * @author 大叔在睡觉
 * @email 390940063@qq.com
 * @date 2024-04-25
 */
namespace Jsonlie\MiniAesTool;

use Jsonlie\MiniAesTool\Api\Base;
use Jsonlie\MiniAesTool\Service\Aes\AesService;

class Aes implements Base
{
    //待加解密数据
    protected $pending;
    //加解密向量
    protected $iv;

    /**
     * 设置参数
     * @param $params
     * @return $this
     */
    public function setParams($params){
        if(is_array($params) && !empty($params)){
            foreach($params as $key => $param){
                $this->$key = $param;
            }
        }
        return $this;
    }

    /**
     * 加密
     * @return bool|mixed|string
     */
    public function encrypt()
    {
        return AesService::encrypt($this->pending,$this->iv);
    }

    /**
     * 解密
     * @return bool|mixed|string
     */
    public function decrypt()
    {
        return AesService::decrypt($this->pending,$this->iv);
    }
}