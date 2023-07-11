<?php 
    class adminModel extends Model{
        private $_table = "loai";

        function tableFill()
        {
            return $this->_table;
        }

        function fieldFill()
        {
            return "";
        }

        function listLoai(){
            return $this->all();
        }

        function ListData($table,$select="*"){
            return $this->db->table($table)->select($select)->get();
        }


        function ItemData($table,$select,$field,$value){
                return $this->db->table($table)->select($select)->where($field,"=",$value)->get();
        }
        
        function getListTenLoai($maloai){
            return $this->db->table("loai")->select("TenLoai")->where("MaLoai","=",$maloai)->get();
        }

        function listJoin($table,$id,$value,$field,$table1,$relationship,$field1,$type,$type1="ASC"){
            return $this->db->table($table)->select($field)->join($type,$table1,$relationship)->where($id,"=",$value)->orderBy($field1,$type1)->get();
        }

        function insertData($table, $data)
        {
            return $this->db->table($table)->insert($data);
        }

        function deleteField($table, $field,$compare,$value)
        {
            return $this->db->table($table)->where($field,$compare,$value)->delete();
        }

        function updateField($table, $field,$compare,$value,$data){
            return $this->db->table($table)->where($field,$compare,$value)->update($data);
        }

        function TongHopBL(){
            return $this->db->table("hanghoa")->select("hanghoa.MaHangHoa as MaSP,hanghoa.TenHangHoa,COUNT(binhluan.MaBL) as SoBL,MIN(binhluan.ThoiGianGui) as MIN,MAX(binhluan.ThoiGianGui) as MAX")
            ->join("INNER","binhluan","binhluan.MaSP = hanghoa.MaHangHoa")->groupBy("hanghoa.MaHangHoa")->get();
        }

        function ChiTietBL(){
            return $this->db->table("binhluan")->select("binhluan.NoiDung,binhluan.ThoiGianGui,khachhang.HoTen,binhluan.MaBL")
            ->join("INNER","khachhang","binhluan.MaKH = khachhang.MaKH")->where("binhluan.MaSP","=",$_GET["IdProduct"])->get();
        }

        function ThongKeHH(){
            return $this->db->table("hanghoa")->select("loai.MaLoai,loai.TenLoai, COUNT(hanghoa.MaHangHoa) as SL,MIN(hanghoa.DonGia) as MIN,MAX(hanghoa.DonGia) as MAX,AVG(hanghoa.DonGia) as AVG")
            ->join("LEFT","loai","hanghoa.MaLoaiHang = loai.MaLoai")->groupBy("loai.MaLoai")->orderBy("loai.MaLoai","DESC")->get();
        }
    }
?>