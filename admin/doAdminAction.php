<?php
require_once '../include.php';
checkLogined();
//后台操作结果信息展示页面
$act=$_REQUEST['act'];
$id=$_REQUEST['id'];
if($act=="logout"){
    logout();
}elseif ($act=="addAdmin") {
    $mes = addAdmin();
}elseif ($act=="editAdmin") {
    $mes = editAdmin($id);
}elseif ($act=="delAdmin") {
    $mes = delAdmin($id);
}elseif ($act=="addCate") {
    $mes = addCate();
}elseif ($act=="delCate") {
    $mes = delCate($id);
}elseif ($act=="editCate") {
    $mes = editCate($id);
}elseif ($act=="addPro") {
    $mes = addPro();
}elseif ($act=="editPro") {
    $mes = editPro($id);
}elseif ($act=="delPro") {
    $mes = delPro($id);
}elseif ($act=="addUser") {
    $mes = addUser();
}elseif ($act=="editUser") {
    $mes = editUser($id);
}elseif ($act=="delUser") {
    $mes = delUser($id);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
    if($mes){
        echo $mes;
    }
?>
</body>
</html>