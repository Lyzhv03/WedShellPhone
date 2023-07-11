<?php 
    class database{
        private $__conn;

        use QueryBuilder;

        function __construct()
        {
            global $config;
            $this->__conn = Connection::getInstance($config["database"]);
        }

        function query($sql){
            try {
                $statament = $this->__conn->prepare($sql);
                $statament->execute();
                return $statament->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $th) {
                $error["err"] = $th->getMessage();
                App::$app->LoadErr("404",$error);
                die();
            }
        }

        function insertData($table,$data){
            if(!empty($data)){
                $fieldStr = "";
                $valueStr = "";
                foreach($data as $key=>$value){
                    $fieldStr.=$key.",";
                    $valueStr.="'".$value."',";
                }
                $fieldStr = rtrim($fieldStr,',');
                $valueStr = rtrim($valueStr,',');
                $sql = "INSERT INTO $table($fieldStr) VALUES ($valueStr)";
                $status = $this->query($sql);
                if(empty($status)){
                    return true;
                }
                return false;
            }
        }

        function updateData($table,$data,$condition=''){
            if(!empty($data)){
                $updateStr = "";
                foreach($data as $key=>$value){
                    $updateStr.="$key='$value',";
                }
                $updateStr = rtrim($updateStr,',');
                if(!empty($condition)){
                    $sql = "UPDATE $table SET $updateStr WHERE $condition";
                }else{
                    $sql = "UPDATE $table SET $updateStr";
                }
                $status = $this->query($sql);
                if(empty($status)){
                    return true;
                }
                return false;
            }
        }

        function deleteData($table,$condition){
            if(!empty($condition)){
                $sql = "DELETE FROM ".$table." WHERE ".$condition;
            }else{
                $sql = "DELETE FROM ".$table;
            }

            $status = $this->query($sql);
            if($status){
                return true;
            }
            return false;
        }
    }
?>