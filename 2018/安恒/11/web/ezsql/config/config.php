<?php
$config = unserialize(base64_decode($config));
if(isset($_GET['p'])){
    $p=$_GET['p'];
    $config->$p;
}
class Config{
    private $config;
    private $path;
    public $filter;
    public function __construct($config=""){
        $this->config = $config;
        echo 123;
    }
    public function getConfig(){
        if($this->config == ""){
            $config = isset($_POST['config'])?$_POST['config']:"";
        }
    }
    public function SetFilter($value){
//        echo $value;
	$value=waf_exec($value); 
        var_dump($value);
	if($this->filter){
            foreach($this->filter as $filter){

                
                $array = is_array($value)?array_map($filter,$value):call_user_func($filter,$value);
            }
            $this->filter = array();
        }else{
            return false;
        }
        return true;
    }
    public function __get($key){
        //var_dump($key);
	$this->SetFilter($key);
        die("");
    }
}
