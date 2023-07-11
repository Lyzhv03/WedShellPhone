<?php 
    class clientModel extends Model{

        private $_table = "hoanghoa";

        function tableFill()
        {
            return $this->_table;
        }

        function fieldFill()
        {
            return "";
        }

        function listData($table,$field){
            return $this->db->table($table)->select($field)->get();
        }

        function Top10($table,$field,$orderBy="",$type="",$start="",$end=""){
            return $this->db->table($table)->where($field,">",0)->orderBy($orderBy,$type)->limit($start,$end)->get();
        }

        function detailData($table,$select,$field,$value,$orderBy="",$type=""){
            if($orderBy != "" && $type != ""){
                return $this->db->table($table)->select($select)->where($field,"=",$value)->orderBy($orderBy,$type)->get();
            }else{
                return $this->db->table($table)->select($select)->where($field,"=",$value)->get();
            }
        }

        function searchSP($key){
            return $this->db->table("hanghoa")->whereLike("TenHangHoa",$key)->get();
        }

        function updateView($data,$Id){
            return $this->db->table("hanghoa")->where("MaHangHoa","=",$Id)->update($data);
        }

        function updateSL($data,$Id,$Id1){
            return $this->db->table("giohang")->where("MaHangHoa","=",$Id)->where("MKH","=",$Id1)->update($data);
        }

        function listJoin($table,$id,$value,$field,$table1,$relationship,$field1,$type,$type1="ASC"){
            return $this->db->table($table)->select($field)->join($type,$table1,$relationship)->where($id,"=",$value)->orderBy($field1,$type1)->get();
        }

        function insertData($table, $data)
        {
            return $this->db->table($table)->insert($data);
        }
        
        function deleteField($table,$field,$compare,$value)
        {
            return $this->db->table($table)->where($field,$compare,$value)->delete();
        }

        function updateField($table, $field,$compare,$value,$data){
            return $this->db->table($table)->where($field,$compare,$value)->update($data);
        }

        function existPR($table,$select,$field,$value,$field1,$value1){
            return $this->db->table($table)->select($select)->where($field,"=",$value)->where($field1,"=",$value1)->get();
        }
    }
?>