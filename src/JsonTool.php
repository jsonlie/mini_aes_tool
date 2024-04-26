<?php
/**
 * @title 加解密工具
 * @author 大叔在睡觉
 * @email 390940063@qq.com
 * @date 2024-04-25
 */
namespace Jsonlie\MiniAesTool;

class JsonTool
{

    private static $instance = null;

    private function __construct(){}

    /**
     * 获取单例对象
     */
    public static function getInstance($config)
    {
        if(!is_array($config)){
            throw new \Exception('配置错误');
        }
        if(empty($config['method'])){
            throw new \Exception('配置参数 method 错误');
        }
        $method = strtolower($config['method']);

        if (null == self::$instance[$method]) {
            switch ($method){
                case 'aes':
                    self::$instance[$method] = new Aes();
                    break;
                case 'rsa':
                    self::$instance[$method] = new Rsa();
                    break;
            }
            self::$instance[$method]->setParams($config);
        }
        return self::$instance[$method];
    }



}