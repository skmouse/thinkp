<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * User:FWW
 * Date: 2017/2/5
 * Time: 18:14
 * @处理验证登录类
 */
class LoginController extends Controller{

    public function index(){ //判断sesson是否存在
        if (session('adminUser')){
            $this->redirect('/thinkp/index.php?m=admin&c=index');
        }else{
            $this->display();
        }
        
    }
    //ajax进行判断
    public function check(){
        $username = $_POST['username'];
        $password = $_POST['password'];
                //验证是否为空，为了方便可以直接去掉
               /* if(!trim($username)) {
                    return show(0,'用户名不能为空');
                }
                if(!trim($password)) {
                    return show(0,'密码不能为空');
                }*/
        $ret = D('Admin')->getAdminByUsername($username);
        if (!$ret){
            return show(0,'该用户不存在');
        }
        if ($ret['password']!=getMd5Password($password)){
            return show(0,'密码错误');
        }
        //D("Admin")->updateByAdminId($ret['admin_id'],array('lastlogintime'=>time()));
        session('adminUser',$ret);
        return show(1,'登录成功');
    }

    public function loginout(){
        session('adminUser',null);
        $this->redirect('/thinkp/index.php?m=admin&c=login');
    }
}