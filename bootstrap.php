<?php 
    define("_DIR_ROOT_",__DIR__);
    if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
        $web_root = "https://".$_SERVER["HTTP_HOST"];
    }else{
        $web_root = "http://".$_SERVER["HTTP_HOST"];
    }
    $dirRoot = str_replace("\\","/",_DIR_ROOT_);
    $dcm = $_SERVER["DOCUMENT_ROOT"];
    $folder = str_replace($dcm,"",$dirRoot);
    $web_root = $web_root.$folder;
    define("_WEB_ROOT_",$web_root);
    $file = scandir("config");
    if(!empty($file)){
        foreach($file as $item){
            if($item != "." && $item != ".." && file_exists("./config/".$item)){
                require_once "./config/".$item;
            }
        }
    }
    require_once "./core/routes.php";
    require_once "./app/App.php";


    if(!empty($config)){
        $db_config = array_filter($config["database"]);
        if(!empty($db_config)){
            require_once "./core/connection.php";
            require_once "./core/QueryBuilder.php";
            require_once "./core/database.php";
            require_once "./core/DB.php";
        }
    }

    require_once "./core/Model.php";

    require_once "./core/controller.php";

    require_once "./core/Request.php";

    require_once "./core/Response.php";
?>