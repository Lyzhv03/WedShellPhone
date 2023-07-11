<?php 
    abstract class Model extends database{
        protected $db;
        function __construct()
        {
           $this->db = new database();
        }

        abstract function tableFill();

        abstract function fieldFill();

        function all(){
            $tableName = $this->tableFill();
            $fieldSelect = $this->fieldFill();
            if(empty($fieldSelect)){
                $fieldSelect = "*";
            }
            $sql = "SELECT $fieldSelect FROM $tableName";
            $query = $this->db->query($sql);
            if(!empty($query)){
                return $query;
            }
        }

    }
?>