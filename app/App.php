<?php 
    class App{
        private $__controller,$__action,$__params,$__routes,$__db;

        static $app;

        function __construct()
        {
            global $routes;
            self::$app = $this;
            if(!empty($routes["default_controller"])){
                $this->__controller = $routes["default_controller"];
            }
            $this->__action = "index";
            $this->__params = [];
            $this->__routes = new routes();
            if(class_exists("DB")){
                $dbObject = new DB();
                $this->__db = $dbObject->db;
            }

            $this->handleUrl();
        }

        function getUrl(){
            if(!empty($_SERVER["PATH_INFO"])){
                $url = $_SERVER["PATH_INFO"];
            }else{
                $url = "/";
            }
            return $url;
        }


        function handleUrl(){
            //xu ly controller
            $url = $this->getUrl();
            $url = $this->__routes->HandleRoute($url);
            $arr = array_filter(explode("/",$url));
            $urlcheck = $this->__routes->CheckFile($arr);
            
            $arr = array_values($arr);
            if(!empty($arr[0])){
                $this->__controller = $arr[0];
            }else{
                $urlcheck = $this->__controller;
            }

            $path = "./app/controller/".$urlcheck.".php";
            
            if(file_exists($path)){
                require $path;
                if(class_exists($this->__controller)){
                    $this->__controller = new $this->__controller();
                    unset($arr[0]);
                    if(!empty($this->__db)){
                        $this->__controller->db = $this->__db;
                    }
                }
            }else{
                $this->LoadErr();
            }

            //xu ly action
            if(!empty($arr[1])){
                $this->__action = $arr[1];
                unset($arr[1]);
            }
            


            //xu ly param
            $this->__params = array_values($arr);

            if(method_exists($this->__controller,$this->__action)){
                call_user_func_array([$this->__controller,$this->__action],$this->__params);
            }else{
                $this->LoadErr();
            }

        }

        public function LoadErr($name="404",$data=[]){
            extract($data);
            require "./app/error/".$name.".php";
        }

    }
?>