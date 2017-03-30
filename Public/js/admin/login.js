/**
 * 前端登录业务类
 * @author FWW
 */
var login = {
    check : function() {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        console.log(data);
        if(!username) {
            return dialog.error('用户名不能为空');
        }
        if(!password) {
            dialog.error('密码不能为空');
        }


        /**
         *
         * login不是类，类似JSON数据访问形式,login.check
         */

        var url = "/thinkp/index.php?m=admin&c=login&a=check";
        var data = {'username':username,'password':password};
        if(!password) {
            dialog.error('密码不能为空');
        }
        // 执行异步请求  $.post
        $.post(url,data,function(result){
            if(result.status == 0) {
                return dialog.error(result.message);
            }
            if(result.status == 1) {
                return dialog.success(result.message, '/thinkp/index.php?m=admin&c=index');
            }

        },'JSON');

    }
}