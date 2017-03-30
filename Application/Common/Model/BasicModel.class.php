<?php
namespace Common\Model;
use Think\Model;

/**
 * @mouse.feng
 */
class BasicModel extends Model
{

    private $_db;

    public function __construct()
    {

    }

    /**
     * @param array $data
     * @return mixed
     * 静态缓存
     */
    public function save($data = array()){
        if (!$data){
            throw_exception('没有提交数据');
        }
        $Id = F('basic_web_config',$data);
        return $Id;
    }

    public function select(){
        return F('basic_web_config');
    }

}