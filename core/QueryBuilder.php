<?php 
    trait QueryBuilder{
        public $tableName = "",$where = "",$operator = "", 
        $selectField = "*",$innerJoin= "",$orderBy="", $groupBy = "",
        $limit = "";

        public function table($tableName){
            $this->tableName = $tableName;
            return $this;
        }

        public function where($field,$compare,$value){
            if(empty($this->where)){
                $this->operator = ' WHERE';
            }else{
                $this->operator = ' AND';
            }
            $this->where .= "$this->operator $field $compare '$value'";
            return $this;
        }

        public function orWhere($field,$compare,$value){
            if(empty($this->where)){
                $this->operator = ' WHERE';
            }else{
                $this->operator = ' OR';
            }
            $this->where .= "$this->operator $field $compare '$value'";
            return $this;
        }

        public function whereLike($field,$value){
            if(empty($this->where)){
                $this->operator = ' WHERE';
            }else{
                $this->operator = ' AND';
            }
            $this->where .= "$this->operator $field LIKE '%$value%'";
            return $this;
        }

        public function join($type,$tableName,$relationship){
            $this->innerJoin .= $type.' JOIN '.$tableName.' ON '.$relationship.' ';
            return $this;
        }

        public function insert($data){
            $tableName = $this->tableName;
            $insertStatus = $this->insertData($tableName,$data);
            return $insertStatus;
        }

        public function update($data){
            $whereUpdate = str_replace("WHERE","",$this->where);
            $whereUpdate = trim($whereUpdate);
            $tableName = $this->tableName;
            $statusUpdate = $this->updateData($tableName,$data,$whereUpdate);
            return $statusUpdate;
        }

        public function delete(){
            $whereDelete = str_replace("WHERE","",$this->where);
            $whereDelete = trim($whereDelete);
            $tableName = $this->tableName;
            $statusDelete = $this->deleteData($tableName,$whereDelete);
            $this->resetQuery();
            return $statusDelete;
        }

        public function select($field = "*"){
            $this->selectField = $field;
            return $this;
        }

        public function orderBy($field,$type="ASC"){
            $fieldArr = array_filter(explode(",",$field));
            if(!empty($fieldArr) && count($fieldArr) >= 2){
                $this->orderBy = "ORDER BY ".implode(", ",$fieldArr)." ".$type;
            }else{
                $this->orderBy = "ORDER BY ".$field." ".$type;
            }
            return $this;
        }

        public function limit($start,$end){
            $this->limit = "LIMIT $start,$end";
            return $this;
        }

        public function groupBy($field){
            if(!empty($field)){
                $this->groupBy = " GROUP BY $field";
            }
            return $this;
        }

        public function get(){
            $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where 
            $this->groupBy $this->orderBy $this->limit";
            $sqlQuery = trim($sqlQuery);
            $sql = $this->query($sqlQuery);

            $this->resetQuery();
            // echo $sqlQuery."<br>";
            $sqlQuery = "";
            if(!empty($sql)){
                return $sql;
            }
            return false;
        }

        public function first(){
            $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->where";
            $sql = $this->query($sqlQuery);

           $this->resetQuery();

            if(!empty($sql)){
                return $sql;
            }
            return false;
        }

        public function resetQuery(){
            $this->tableName = "";
            $this->where = "";
            $this->operator = ""; 
            $this->orderBy = ""; 
            $this->innerJoin = ""; 
            $this->groupBy = "";
            $this->limit = "";
            $this->selectField = "*";
        }
    }
?>