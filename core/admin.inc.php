<?php
/**
 * 检查是否有管理员
 * @param  [type] $sql [description]
 * @return [type]      [description]
 */
function checkAdmin($sql){
    return fetchOne($sql); //用到封装的数据库查询操作
}

/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
    if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
        alertMes("请先登陆","login.php");
    }
}

/**
 * 注销管理员
 * @return [type] [description]
 */
/**
 * 注销管理员
 */
function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie("adminId","",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie("adminName","",time()-1);
    }
    session_destroy();
    header("location:login.php");
}
/**
 * 添加管理员
 */
function addAdmin(){
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    if (empty($_POST['username'])) {
        $mes = "请输入管理员名称！<br/><a href='addAdmin.php'>重新添加</a>";
    } elseif (empty($_POST['password'])) {
        $mes = "请输入管理员密码！<br/><a href='addAdmin.php'>重新添加</a>";
    } elseif (empty($_POST['email'])) {
        $mes = "请输入管理员邮箱！<br/><a href='addAdmin.php'>重新添加</a>";
    } elseif (!insert("coolshop_admin",$arr)){
        $mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    }else{
         $mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    }
    return $mes;
}
/**
 * 得到所有管理员信息
 * @return [type] [description]
 */
function getAllAdmin(){
    $sql="select id,username,email from coolshop_admin ";
    $rows=fetchAll($sql);
    return $rows;
}
/**
 * 编辑管理员
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function editAdmin($id){
    $arr = $_POST;
    $arr['password'] = md5($_POST['password']);
    $where = "id = {$id}";
    // if(empty($_POST['username']&&empty($_POST['password'])&&empty($_POST['email']))){
    //     $mes = "编辑失败1!<br/><a href='addAdmin.php'>重新编辑</a>";
    // }
    if(update("coolshop_admin",$arr,$where)){
        $mes = "编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    } else {
        //$mes = '编辑失败!<br/><a href="editAdmin.php?id = $id">请重新修改</a>';
        $mes = "编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";//此处没有跳转editAdmin.php无法获正在取修改的id
    }
    return $mes;
}
/**
 * 删除管理员
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function delAdmin($id){
    if(delete("coolshop_admin","id = $id")){
        $mes = "删除成功！<br/><a href='listAdmin.php'>查看管理员列表</a>";
    } else {
        $mes = "删除失败！<br/><a href='listAdmin.php'>请重新删除</a>";
    }
    return $mes;
}
/**
 * 添加用户的操作
 * @param int $id
 * @return string
 */
function addUser(){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile=uploadFile("../uploads");
    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "添加失败<a href='addUser.php'>重新添加</a>";
    }
    if(insert("coolshop_user", $arr)){
        $mes="添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看列表</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="添加失败!<br/><a href='addUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
    }
    return $mes;
}
/**
 * 删除用户的操作
 * @param int $id
 * @return string
 */
function delUser($id){
    $sql="select face from coolshop_user where id=".$id;
    $row=fetchOne($sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if(delete("coolshop_user","id={$id}")){
        $mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
    }
    return $mes;
}
/**
 * 编辑用户的操作
 * @param int $id
 * @return string
 */
function editUser($id){
    $arr=$_POST;
    $arr['password']=md5($_POST['password']);
    if(update("coolshop_user", $arr,"id={$id}")){
        $mes="编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
    }
    return $mes;
}

?>