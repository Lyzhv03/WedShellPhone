<?php 
    class routes{
        function HandleRoute($url){ 
            global $routes;
            unset($routes["default_controller"]);
            $url = trim($url,"/");
            foreach($routes as $key=>$value){
                if(preg_match("~".$key."~is",$url)){
                    $url = preg_replace("~".$key."~is",$value,$url);
                }
            }
            return $url;
        }

        function CheckFile(&$url){
            $urlcheck = "";
            foreach($url as $key=>$value){
                $urlcheck .= $value."/";
                $path = rtrim($urlcheck,"/");
                if(!empty($url[$key-1])){
                    unset($url[$key-1]);
                }
                if(file_exists("./app/controller/".$path.".php")){
                    return $path;
                }
            }
        }
    }
?>