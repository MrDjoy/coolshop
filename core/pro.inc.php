<?php 
/**
 * 添加商品
 * @return string
 */
function addPro(){
    $arr=$_POST;
    $arr['pubTime']=time();
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if(is_array($uploadFiles)&&$uploadFiles){//如果图片上传成功
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
        }
    }
    $res=insert("coolshop_pro",$arr);
    $pid=getInsertId();//获得添加商品的ID
    if($res&&$pid){
        foreach($uploadFiles as $uploadFile){
            $arr1['pid']=$pid;
            $arr1['albumPath']=$uploadFile['name'];
            addAlbum($arr1);//将商品的图片添加到相册表中
        }
        $mes="<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
        foreach($uploadFiles as $uploadFile){
            if(file_exists("../image_800/".$uploadFile['name'])){
                unlink("../image_800/".$uploadFile['name']);
            }
            if(file_exists("../image_50/".$uploadFile['name'])){
                unlink("../image_50/".$uploadFile['name']);
            }
            if(file_exists("../image_220/".$uploadFile['name'])){
                unlink("../image_220/".$uploadFile['name']);
            }
            if(file_exists("../image_350/".$uploadFile['name'])){
                unlink("../image_350/".$uploadFile['name']);
            }
        }
        $mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
        
    }
    return $mes;
}
/**
 *编辑商品
 * @param int $id
 * @return string
 */
function editPro($id){
    $arr=$_POST;
    $path="./uploads";
    $uploadFiles=uploadFile($path);
    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $key=>$uploadFile){
            thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
            thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
            thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
            thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
        }
    }
    $where="id={$id}";
    $res=update("coolshop_pro",$arr,$where);
    $pid=$id;
    if($res&&$pid){
        if($uploadFiles &&is_array($uploadFiles)){
            foreach($uploadFiles as $uploadFile){
                $arr1['pid']=$pid;
                $arr1['albumPath']=$uploadFile['name'];
                addAlbum($arr1);
            }
        }
        $mes="<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
    if(is_array($uploadFiles)&&$uploadFiles){
        foreach($uploadFiles as $uploadFile){
            if(file_exists("../image_800/".$uploadFile['name'])){
                unlink("../image_800/".$uploadFile['name']);
            }
            if(file_exists("../image_50/".$uploadFile['name'])){
                unlink("../image_50/".$uploadFile['name']);
            }
            if(file_exists("../image_220/".$uploadFile['name'])){
                unlink("../image_220/".$uploadFile['name']);
            }
            if(file_exists("../image_350/".$uploadFile['name'])){
                unlink("../image_350/".$uploadFile['name']);
            }
        }
    }
        $mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";
        
    }
    return $mes;
}

function delPro($id){
    $where="id=$id";
    $res=delete("coolshop_pro",$where);
    $proImgs=getAllImgByProId($id);
    if($proImgs&&is_array($proImgs)){
        foreach($proImgs as $proImg){
            if(file_exists("uploads/".$proImg['albumPath'])){
                unlink("uploads/".$proImg['albumPath']);
            }
            if(file_exists("../image_50/".$proImg['albumPath'])){
                unlink("../image_50/".$proImg['albumPath']);
            }
            if(file_exists("../image_220/".$proImg['albumPath'])){
                unlink("../image_220/".$proImg['albumPath']);
            }
            if(file_exists("../image_350/".$proImg['albumPath'])){
                unlink("../image_350/".$proImg['albumPath']);
            }
            if(file_exists("../image_800/".$proImg['albumPath'])){
                unlink("../image_800/".$proImg['albumPath']);
            }
            
        }
    }
    $where1="pid={$id}";
    $res1=delete("imooc_album",$where1);
    if($res&&$res1){
        $mes="删除成功!<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
    }
    return $mes;
}


/**
 * 得到商品的所有信息
 * @return array
 */
function getAllProByAdmin(){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from coolshop_pro as p join coolshop_cate c on p.cId=c.id";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 *根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getAllImgByProId($id){
    $sql="select a.albumPath from coolshop_album a where pid={$id}";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 根据id得到某个商品的详细信息
 * @param int $id
 * @return array
 */
function getProById($id){
        $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from coolshop_pro as p join coolshop_cate c on p.cId=c.id where p.id={$id}";//关联coolshop_pro和coolshop_cate表，以coolshop_pro表的cId（商品
        //分类id）和coolshop_cate表的主键id信息相关联，通过where p.id={$id}找到具体的哪个商品，
        //整个$sql语句实际上给某个商品添加了cName(商品分类字段)
        $row=fetchOne($sql);
        return $row;
}
/**
 * 检查分类下是否有产品
 * @param int $cid
 * @return array
 */
function checkProExist($cid){
    $sql="select * from coolshop_pro where cId={$cid}";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 得到所有商品
 * @return array
 */
function getAllPros(){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from coolshop_pro as p join coolshop_cate c on p.cId=c.id ";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 *根据cid得到4条产品，用于前端显示商品
 * @param int $cid
 * @return Array
 */
function getProsByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from coolshop_pro as p join coolshop_cate c on p.cId=c.id where p.cId={$cid} limit 4";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 * 得到下4条产品
 * @param int $cid
 * @return array
 */
function getSmallProsByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from coolshop_pro as p join coolshop_cate c on p.cId=c.id where p.cId={$cid} limit 0,4";
    $rows=fetchAll($sql);
    return $rows;
}

/**
 *得到商品ID和商品名称
 * @return array
 */
function getProInfo(){
    $sql="select id,pName from coolshop_pro order by id asc";
    $rows=fetchAll($sql);
    return $rows;
}

?>