<?php
class mysql{

    private  $host;
    private  $port;
    private  $username ;
    private  $passwd ;
    private  $charset ;
    private  $dbname;
    
    private $resource;
    private static $link = NULL;

    private function __construct($config){
        $this->host = isset($config['host'])?$config['host']:'localhost';  //考虑空值情况用默认值代替
        $this->port = isset($config['port'])?$config['port']:'3306';
        $this->user = isset($config['user'])?$config['user']:'root';
        $this->passwd = isset($config['passwd'])?$config['passwd']:'1023747194';
        $this->charset = isset($config['charset'])?$config['charset']:'utf8';
        $this->dbname = isset($config['dbname'])?$config['dbname']:'db1';

        $this->connect();

        $this->setCharset($this->charset);

        $this->selectDB($this->dbname);
       

    }
    public static function getInstance($config){
        if (!(self::$link instanceof mysql)) {
            self::$link = new self($config);
        }
        return self::$link;
    }
    private function __clone(){

    }
    // private function connect($config){
    //     $this->resource = mysql_connect("{$config['host']}:{$config['port']}","{$config['username']}","{$config['passwd']}")or die("连接失败！".mysql_errno().":".mysql_error()."/n"); 
    // }
    private function connect(){
        $this->resource = @mysql_connect("{$this->host}:{$this->port}","$this->user","$this->passwd" )
        or die("连接失败！".mysql_errno().":".mysql_error()."\n");
    }
    //可以设定要使用要连接的编码
    public function setCharset($charset){
        mysql_query("set names $charset");
    }
    //可以设定要使用的数据库
    public function selectDB($dbname){
        mysql_query("use $dbname");
    }
    //可关闭连接
    public function closeDB(){
        mysql_close($this->resource);
    }
    //传入的sql语句是任何基本的sql语句，如果错误返回错误信息,成功返回结果集
    public function exec($sql){
        $result  = mysql_query($sql);
        if ($result===false) {
            echo "<br/>sql语句执行失败";
            echo "<br/>错误代号".mysql_errno();
            echo "<br/>错误信息".mysql_error();
            echo "<br/>错误语句".$sql;
            die();
        }
        return $result;
    }
    //传入的sql语句查询表的一行信息例如 select *from tab where id = xxx
    //返回数组 数组下标是表的字段
    public function getOnerow($sql){
        // $result = mysql_query($sql);
        // if ($result===false) {
        //     echo "<br/>sql语句执行失败";
        //     echo "<br/>错误代号".mysql_errno();
        //     echo "<br/>错误信息".mysql_error();
        //     echo "<br/>错误语句".$sql;
        //     die();
        // }
        $result = $this->exec($sql);
        $tmp = mysql_fetch_assoc($result);//只取出一行数据
        mysql_free_result($result);//提前释放资源销毁结果集
        return $tmp;
    }
    //传入的sql语句查询表的多行数据例如查询整张表 select *from tab
    //返回 二维数组
    public function getRows($sql){
        $result = $this->exec($sql);
        $arr = array();
        while ($tmp = mysql_fetch_assoc($result)) {
            $arr[] = $tmp;//取得的每行数据依次赋给空数组$arr
        }
        mysql_free_result($result);
        return $arr;
    }
    //传入的sql语句查询表的一个数据，比如select count(*) as c from user_list
    function getOneData($sql){
        $result = $this->exec($sql);
        //如果没有出错，开始处理数据，返回一个数据
        $rec = mysql_fetch_row($result);//此处必须为取一列！
        if($rec === false){
            return false;
        }
        mysql_free_result($result);
        return $rec[0];
         
    }
}

  
?>