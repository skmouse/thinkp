<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */
class CommonController extends Controller
{
    public function __construct()
    {

        parent::__construct(); //父类的构造方法实创办现模板功能等
        $this->_init();
    }

    /**
     * 初始化
     * @return
     */
    private function _init()
    {
        // 如果已经登录
        $isLogin = $this->isLogin();   //true

        //$isLogin = true;         //$isLogin判断用户是否登陆
        if (!$isLogin) {
            // 跳转到登录页面
            $this->redirect('/index.php?m=admin&c=login');
        }
    }

    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser()
    {
        return session("adminUser");
    }

    /**
     * 判定是否登录
     * @return boolean
     */
    public function isLogin()
    {
        $user = $this->getLoginUser();
        if ($user && is_array($user)) {
            return true;
        }

        return false;
    }
}