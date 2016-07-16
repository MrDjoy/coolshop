<?php
require_once '../include.php';
$username = $_POST['username'];
$password = md5($_POST['password']);
$verify = $_POST['verify'];//用户提交表单的验证码
$verify1 = $_SESSION['verify'];//后台也就是 image.fun.php中随机设置的验证码
echo "{$verify}";
echo "{$verify1}";
$autoFlag=$_POST['autoFlag'];
if ($verify == $verify1) {//判断验证码是否正确
    $sql = "select * from coolshop_admin where username = '{$username}' and password = '{$password}' ";
    $res = checkAdmin($sql);//查询coolshop_admin表中是否有表单提交的username和password对应值,有输出结果集，没有输出NULL
    if ($res) {
        //如果选了一周内自动登陆
        if($autoFlag){
            setcookie("adminId",$res['id'],time()+7*24*3600);
            setcookie("adminName",$res['username'],time()+7*24*3600);
        }
        $_SESSION['adminName']=$res['username'];//获取用户名用于后台显示
        $_SESSION['adminId']=$res['id'];//获取用户ID检查用户是否已经登录
        alertMes("登陆成功","index.php");
    } else {
        alertMes("登陆失败","login.php");
    }
} else {
    alertMes("验证码错误","login.php");
}

?>