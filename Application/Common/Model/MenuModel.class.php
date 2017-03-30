<?php
namespace Common\Model;
use Think\Model;

/**
 * 菜单类操作
 */
class MenuModel extends  Model{

    private $_db = '';
    public function __construct()
    {
        $this->_db = M('Menu');
    }
    //添加菜单才做
    public function insert($data){
        if (!$data){
            return false;
        }
        $res = $this->_db->where('name="'.$data['name'].'"')->find();
            if ($res){
                return false;
            }else {
                return $this->_db->where($data)->save();
            }
    }

    /**
     * 分页操作
     */
    public function getMenus($data, $page, $pageSize = 10)
    {
        $data['status'] = array('neq',-1);
        $offset = ($page-1) *$pageSize;
        return $this->_db->where($data)->order('listorder desc,menu_id desc')->limit($offset,$pageSize)->select();

    }
    //分页的总数据
    public function getMenusCount($data = array())
    {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    //获取记录的结果值
   public function find($id){
       if (!$id){
           return array();
       }
       return $this->_db->where('menu_id='.$id)->find();
   }
    /*
     * 更新,删除操作status = -1
     */
    public function updateMenuById($id, $data)
    {
        if (!$id) {
            return throw_exception('id不合法');
        }
        if (!$data || !is_array($data)) {
            return throw_exception('数据不合法');
        }
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * 删除操作
     */
    public function updateStatusById($id, $status)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if (!$status || !is_numeric($status)) {
            throw_exception('状态不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    /*
     * 获取后台菜单名
     */
    public function getAdminMenus(){
        $data['status'] = array('neq',-1);
        $data['type']=1;
        return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();

    }
    /**
     * 前台菜单名
     */
     public function getBarMenus(){
         $data = array(
             'status'=>array('neq',-1),
             'type' =>0,
         );
       return  $res = $this->_db->where($data)->order('menu_id')->select();
     }

    public function updateMenuListorderById($id, $listorder) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }

        $data = array(
            'listorder' => intval($listorder),
        );

        return $this->_db->where('menu_id='.$id)->save($data);
    }



}