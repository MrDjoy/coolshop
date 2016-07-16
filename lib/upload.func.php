<?php 
/**
 * 构建上传文件信息
 * @return array
 */
function buildInfo(){
    if(!$_FILES){//超全局变量常量，是一个包含上传的单文件信息的二维数组 ，多文件是三维数组
        // //多个单文件
        // array(
        //  'myfile1' =>array(
        //          'name'=>'001.jpg',
        //          'type'=>'image/jpeg',
        //          'tmp_name'=>path
        //          'error'=>0//(错误代码)
        //          'size'=>500//(文件大小b)
        //      ), 
        //  'myfile2'=>array(
        //          //内容形式相同'name'
        //      ),
        //  'myfile3'=>..,
        //  );
        // //多文件
        // array(
        //  'myfile'=>array(
                // 'name'=>array(
                //      [0]=>'001.jpg',
                //      [1]=>'002.jpg',
                //      [2]=>'003.jpg'
                //  ),
                // 'type'=>array(
                //      [0]=>'image/jpeg',
                //      [1]=>'image/jpeg',
                //      [2]=>'image/jpeg'
                //  ),
                // 'tmp_name'=>
        //  ...)
        // );
        return ;
    }
    $i=0;
    foreach($_FILES as $v){
        //单文件
        if(is_string($v['name'])){//如果'name'是字符串$_FILES是单文件
            $files[$i]=$v;//将每个单文件信息传给数组$files[]
            $i++;
        }else{
            //多文件，将多文件三维数组信息转换为多个单文件的二维形式
            foreach($v['name'] as $key=>$val){
                $files[$i]['name']=$val;
                $files[$i]['size']=$v['size'][$key];
                $files[$i]['tmp_name']=$v['tmp_name'][$key];
                $files[$i]['error']=$v['error'][$key];
                $files[$i]['type']=$v['type'][$key];
                $i++;
            }
        }
    }
    return $files;
}

function uploadFile($path="uploads",$allowExt=array("gif","jpeg","png","jpg","wbmp"),$maxSize=2097152,$imgFlag=true){
    if(!file_exists($path)){//如果目录不存在
        mkdir($path,0777,true);//创建目录
    }
    $i=0;
    $files=buildInfo();
    if(!($files&&is_array($files))){
        return ;
    }
    foreach($files as $file){
        if($file['error']===UPLOAD_ERR_OK){
            $ext=getExt($file['name']);//获取文件扩展名
            //检测文件的扩展名
            if(!in_array($ext,$allowExt)){
                exit("非法文件类型");
            }
            //校验是否是一个真正的图片类型
            if($imgFlag){
                if(!getimagesize($file['tmp_name'])){
                    exit("不是真正的图片类型");
                }
            }
            //上传文件的大小
            if($file['size']>$maxSize){
                exit("上传文件过大");
            }
            if(!is_uploaded_file($file['tmp_name'])){
                exit("不是通过HTTP POST方式上传上来的");
            }
            $filename=getUniName().".".$ext;//文件名.扩展名
            $destination=$path."/".$filename;//完整路径
            if(move_uploaded_file($file['tmp_name'], $destination)){//将上传的文件移动到新位置
                $file['name']=$filename;
                unset($file['tmp_name'],$file['size'],$file['type']);//不需要的文件信息删掉
                $uploadedFiles[$i]=$file;//将$file这个一维数组赋值给uploadedFiles以数字为下标的二维数组
                $i++;
            }
        }else{
            switch($file['error']){
                    case 1:
                        $mes="超过了配置文件上传文件的大小";//UPLOAD_ERR_INI_SIZE
                        break;
                    case 2:
                        $mes="超过了表单设置上传文件的大小";//UPLOAD_ERR_FORM_SIZE
                        break;
                    case 3:
                        $mes="文件部分被上传";//UPLOAD_ERR_PARTIAL
                        break;
                    case 4:
                        $mes="没有文件被上传";//UPLOAD_ERR_NO_FILE
                        break;
                    case 6:
                        $mes="没有找到临时目录";//UPLOAD_ERR_NO_TMP_DIR
                        break;
                    case 7:
                        $mes="文件不可写";//UPLOAD_ERR_CANT_WRITE;
                        break;
                    case 8:
                        $mes="由于PHP的扩展程序中断了文件上传";//UPLOAD_ERR_EXTENSION
                        break;
                }
                echo $mes;
            }
    }
    return $uploadedFiles;
    /*返回一个存储多个单文件'name'信息的二维数组
    Array
    (
        [0] => Array
            (
                [name] => 4a6d3c90fa6cae0fd3e23de17e562877.jpg
            )

        [1] => Array
            (
                [name] => f197853bf8f7a5de6f0d8cafb141abd5.jpg
            )
    )
     */
}
//php.ini 关于文件上传配置
//1》file_upload=On,支持通过HTTP POST方式上传文件
//2》upload_tmp_dir = 临时文件保存目录
//3》upload_max_filesize = 2M默认值是2M，上传文件的最大大小2M
//4》post_max_size=8M 表单以POST方式发送数据的最大值
//客户端配置
//<input type = "hidden" name ="MAX_FILE_SIZE" value="1024"/>
//<input type = "file" name = "myFile" accept = "文件MIME类型"/>
?>