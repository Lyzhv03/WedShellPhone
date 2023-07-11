<?php 
    class Response{
        public function redirect($url = ""){
            $url = _WEB_ROOT_."/".$url;
            header("Location: ".$url);
            exit;
        }
    }
?>