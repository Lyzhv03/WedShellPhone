<?php 
    class admin extends controller{
        public $admin_model,$data;

        function __construct()
        {
            $this->admin_model = $this->model("adminModel");
        }

        function index(){
            $this->data["content"] = "admin/TrangChu";
            $this->render("layout/admin_layout",$this->data);
        }

        function addLoai(){
            $act = ["danhsach","fixLoai","DelLoai"];
            $request = new Request();

            $this->data["field"] = $request->getFields();

            $request->rules([
                "TenLoai" => "required|min:4|max:30|unique:loai:TenLoai"
            ]);

            $request->message([
                "TenLoai.required" => "Tên loại không được để trống",
                "TenLoai.min" => "Tên loại phải lớn hơn 4 kí tự",
                "TenLoai.max" => "Tên loại phải nhỏ hơn 30 kí tự",
                "TenLoai.unique" => "Tên loại đã tồn tại"
            ]);

            if(!isset($_GET["act"])){
                if(!empty($_POST["btn"])){
                    $validate = $request->validate();
                    if(!$validate){
                        $this->data["errors"] = $request->errors();
                    }else{
                        $this->data["errors"] = "";
                        unset($this->data["field"]["btn"]);
                        $check = $this->db->table("loai")->insert($this->data["field"]);
                        if($check){
                            $this->data["field"] = "";
                            echo "<script>alert('Thêm mới loại hàng thành công!')</script>";
                        }
                    }
                }
                $this->data["content"] = "admin/quanly/loaihang/addLoai";
                $this->render("layout/admin_layout",$this->data);
            }else{
                $boolean = false;
                foreach($act as $item){
                    if($_GET["act"] == $item){
                        $this->data["listLoai"] = $this->admin_model->listLoai();
                        if(isset($_POST["checkbox"])){
                            $checkboxes = $_POST["checkbox"];
                            foreach($checkboxes as $item){
                                $MaSP = $this->admin_model->ItemData("hanghoa","MaHangHoa","MaLoaiHang",$item);
                                $this->admin_model->deleteField("binhluan","MaSP","=",$MaSP[0]["MaHangHoa"]);
                                $this->admin_model->deleteField("hanghoa","MaLoaiHang","=",$item);
                                $this->admin_model->deleteField("loai","MaLoai","=",$item);
                                header("Location: ?act=danhsach");
                            }
                        }
                        if($_GET["act"] == "fixLoai"){
                            unset($this->data["field"]["act"]);
                            unset($this->data["field"]["Maloai"]);
                            $validate = $request->validate();
                            $this->data["tenloai"] = $this->admin_model->ItemData("loai","TenLoai","MaLoai",$_GET["Maloai"]);
                            if(!empty($this->data["field"]["btn"])){
                                if(!$validate){
                                    $this->data["errors"] = $request->errors();
                                }else{
                                    $this->data["errors"] = "";
                                    unset($this->data["field"]["btn"]);
                                    $check = $this->db->table("loai")->where("MaLoai","=","{$_GET["Maloai"]}")->update($this->data["field"]);
                                    if($check){
                                        header("Location: ?act=danhsach");
                                    }
                                }
                            }
                        }elseif($_GET["act"] == "DelLoai"){
                            // $MaSP = $this->db->table("hanghoa")->select("MaHangHoa")->where("MaLoaiHang","=",$_GET["Maloai"])->get()[0];
                            // $this->db->table("binhluan")->where("MaSP","=",$MaSP["MaHangHoa"])->delete();
                            // $this->db->table("hanghoa")->where("MaLoaiHang","=","{$_GET["Maloai"]}")->delete();
                            // $this->db->table("loai")->where("MaLoai","=","{$_GET["Maloai"]}")->delete();
                            $MaSP = $this->admin_model->ItemData("hanghoa","MaHangHoa","MaLoaiHang",$_GET["Maloai"]);
                            $this->admin_model->deleteField("binhluan","MaSP","=",$MaSP[0]["MaHangHoa"]);
                            $this->admin_model->deleteField("hanghoa","MaLoaiHang","=",$_GET["Maloai"]);
                            $this->admin_model->deleteField("loai","MaLoai","=",$_GET["Maloai"]);
                            header("Location: ?act=danhsach");
                        }
                        $this->data["content"] = "admin/quanly/loaihang/$item";
                        $this->render("layout/admin_layout",$this->data);
                        $boolean = true;
                        break;
                    }
                }
                if($boolean == false){
                    require_once "./app/error/404.php";
                }
            }
        }

        function khachhang(){
            $act = ["listClient","fixClient","DelClient"];
            $request = new Request();
            $this->data["field"] = $request->getFields();

            $request->message([
                "HoTen.required" => "Họ Tên không được để trống",
                "HoTen.min" => "Họ Tên phải trên 4 kí tự",
                "MK.required" => "Mật khẩu không được để trống",
                "MK.min" => "Mật khẩu phải trên 5 kí tự",
                "rmk.required" => "Nhập lại mật khẩu không được để trống",
                "rmk.min" => "Nhập lại mật khẩu phải trên 5 kí tự",
                "rmk.match" => "Nhập lại mật khẩu không khớp",
                "HinhAnh.checkfile" => "Hình ảnh không được để trống",
                "Email.required" => "Email không được để trống",
                "Email.min" => "Email phải trên 13 kí tự",
                "Email.email" => "Định dạng Email không hợp lệ",
                "KichHoat.required" => "Kích hoạt không được để trống",
                "VaiTro.required" => "Vai trò không được để trống"
            ]);
            if(!isset($_GET["act"])){
                $request->rules([
                    "HoTen" => "required|min:4",
                    "MK" => "required|min:5",
                    "rmk" => "required|min:5|match:MK",
                    "HinhAnh" => "checkfile",
                    "Email" => "required|email|min:13",
                    "KichHoat" => "required",
                    "VaiTro" => "required",
                ]);
                if(!empty($_POST["btn"])){
                    $validate = $request->validate();
                    if(!$validate){
                        $this->data["errors"] = $request->errors();
                    }else{
                        $this->data["errors"] = "";
                        unset($this->data["field"]["btn"]);
                        unset($this->data["field"]["rmk"]);
                        $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                        $check = $this->db->table("khachhang")->insert($this->data["field"]);
                        if($check){
                            $this->data["field"] = "";
                            echo "<script>alert('Thêm mới dữ liệu thành công!')</script>";
                        }
                    }
                }
                $this->data["content"] = "admin/quanly/khachhang/khachhang";
                $this->render("layout/admin_layout",$this->data);
            }else{
                $boolean = false;
                $request->rules([
                    "HoTen" => "required|min:4",
                    "MK" => "required|min:5",
                    "HinhAnh" => "checkfile",
                    "Email" => "required|email|min:13",
                    "KichHoat" => "required",
                    "VaiTro" => "required",
                ]);

                foreach($act as $item){
                    if($_GET["act"] == $item){
                        $this->data["listClient"] = $this->admin_model->ListData("khachhang");
                        if(isset($_POST["checkbox"])){
                            $checkboxes = $_POST["checkbox"];
                            foreach($checkboxes as $item){
                                $this->admin_model->deleteField("giohang","MKH","=",$item);
                                $this->admin_model->deleteField("khachhang","MaKH","=",$item);
                                header("Location: ?act=listClient");
                            }
                        }
                        if($_GET["act"] == "fixClient"){
                            $this->data["itemClient"] = $this->admin_model->ItemData("khachhang","*","MaKH",$_GET["IdClient"]);
                            if(!empty($_POST["btn"])){
                                if(empty($_FILES["HinhAnh"]["name"])){
                                    $this->data["field"]["HinhAnh"] = $this->data["itemClient"][0]["HinhAnh"];
                                }else{
                                    $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                                }
                                $validate = $request->validate();

                                if(!$validate){
                                    $this->data["errors"] = $request->errors();
                                }else{
                                    unset($this->data["field"]["btn"]);
                                    unset($this->data["field"]["rmk"]);
                                    unset($this->data["field"]["act"]);
                                    unset($this->data["field"]["IdClient"]);
                                    $this->data["errors"] = "";
                                    
                                    $check = $this->db->table("khachhang")->where("MaKH","=",$_GET["IdClient"])->update($this->data["field"]);
                                    if($check){
                                        $this->data["field"] = "";
                                        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],_DIR_ROOT_."\public\assets\client\images\avatar"."\\".$_FILES["HinhAnh"]["name"]);
                                        header("Location: ?act=listClient");
                                    }
                                }
                            }
                        }elseif($_GET["act"] == "DelClient"){
                            $this->admin_model->deleteField("giohang","MKH","=",$_GET["IdClient"]);
                            $this->admin_model->deleteField("khachhang","MaKH","=",$_GET["IdClient"]);
                            header("Location: ?act=listClient");
                        }
                        $this->data["listClient"] = $this->admin_model->ListData("khachhang");
                        $this->data["content"] = "admin/quanly/khachhang/$item";
                        $this->render("layout/admin_layout",$this->data);
                        $boolean = true;
                        break;
                    }
                }
                if($boolean == false){
                    require_once "./app/error/404.php";
                }
            }
        }

        function addproduct(){
            $act = ["listProduct","fixProduct","DelProduct"];

            $request = new Request();

            $this->data["field"] = $request->getFields();
            $this->data["listLoai"] = $this->db->table("loai")->get();

            $request->message([
                "TenHangHoa.required" => "Tên hàng hóa không được để trống",
                "TenHangHoa.min" => "Tên hàng hóa phải lớn hơn 5 kí tự",
                "TenHangHoa.max" => "Tên hàng hóa phải nhỏ hơn 30 kí tự",
                "DonGia.required" => "Đơn giá không được để trống",
                "DonGia.min" => "Đơn giá phải trên 3 số",
                "MucGiamGia.required" => "Mức giảm giá không được để trống",
                "HinhAnh.checkfile" => "Hình ảnh không được để trống",
                "MaLoaiHang.required" => "Mã loại hàng không được để trống",
                "DacBiet.required" => "Hàng đặc biệt không được để trống",
                "NgayNhap.required" => "Ngày nhập không được để trống",
                "MoTa.required" => "Mô tả không được để trống",
                "MoTa.min" => "Mô tả phải lớn hơn 5 kí tự",
            ]);
            if(!isset($_GET["act"])){
                $request->rules([
                    "TenHangHoa" => "required|min:5|max:30",
                    "DonGia" => "required|min:3",
                    "HinhAnh" => "checkfile",
                    "MaLoaiHang" => "required",
                    "DacBiet" => "required",
                    "MucGiamGia" => "required",
                    "NgayNhap" => "required",
                    "MoTa" => "required|min:5",
                ]);
                if(isset($_POST["btn"])){
                    $validate = $request->validate();
                    if(!$validate){
                        $this->data["errors"] = $request->errors();
                    }else{
                        $this->data["errors"] = "";
                        unset($this->data["field"]["btn"]);
                        $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                        $check = $this->db->table("hanghoa")->insert($this->data["field"]);
                        if($check){
                            $this->data["field"] = "";
                            move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],_DIR_ROOT_."\public\assets\client\images\products"."\\".$_FILES["HinhAnh"]["name"]);
                            echo "<script>alert('Thêm mới loại hàng thành công!')</script>";
                        }
                    }
                }
                $this->data["content"] = "admin/quanly/hanghoa/addProduct";
                $this->render("layout/admin_layout",$this->data);
            }else{
                $boolean = false;
                
                $request->rules([
                    "TenHangHoa" => "required|min:5|max:30",
                    "DonGia" => "required|min:3",
                    "MaLoaiHang" => "required",
                    "DacBiet" => "required",
                    "MucGiamGia" => "required",
                    "NgayNhap" => "required",
                    "MoTa" => "required|min:5",
                ]);
                foreach($act as $item){
                    if($_GET["act"] == $item){
                        $this->data["listProduct"] = $this->admin_model->ListData("hanghoa");
                        if(isset($_POST["checkbox"])){
                            $checkboxes = $_POST["checkbox"];
                            foreach($checkboxes as $item){
                                $this->admin_model->deleteField("giohang","MaHangHoa","=",$item);
                                $this->admin_model->deleteField("binhluan","MaSP","=",$item);
                                $this->admin_model->deleteField("hanghoa","MaHangHoa","=",$item);
                                header("Location: ?act=listProduct");
                            }
                        }
                        if($_GET["act"] == "fixProduct"){
                            $this->data["itemProduct"] = $this->admin_model->ItemData("hanghoa","*","MaHangHoa",$_GET["IdProduct"]);
                            if(isset($_POST["btn"])){
                                if(empty($_FILES["HinhAnh"]["name"])){
                                    $this->data["field"]["HinhAnh"] = $this->data["itemProduct"][0]["HinhAnh"];
                                }else{
                                    $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                                }

                                $validate = $request->validate();
                                if(!$validate){
                                    $this->data["errors"] = $request->errors();
                                }else{
                                    $this->data["errors"] = "";
                                    unset($this->data["field"]["btn"]);
                                    unset($this->data["field"]["act"]);
                                    unset($this->data["field"]["IdProduct"]);
                                    $check = $this->db->table("hanghoa")->where("MaHangHoa","=","{$_GET["IdProduct"]}")->update($this->data["field"]);
                                    if($check){
                                        $this->data["field"] = "";
                                        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],_DIR_ROOT_."\public\assets\client\images\products"."\\".$_FILES["HinhAnh"]["name"]);
                                        header("Location: ?act=listProduct");
                                    }
                                }
                            }
                        }elseif($_GET["act"] == "DelProduct"){
                            $this->admin_model->deleteField("giohang","MaHangHoa","=",$_GET["IdProduct"]);
                            $this->admin_model->deleteField("binhluan","MaSP","=",$_GET["IdProduct"]);
                            $this->admin_model->deleteField("hanghoa","MaHangHoa","=",$_GET["IdProduct"]);
                            header("Location: ?act=listProduct");
                        }

                        $this->data["content"] = "admin/quanly/hanghoa/$item";
                        $this->render("layout/admin_layout",$this->data);
                        $boolean = true;
                        break;
                    }
                }
                if($boolean == false){
                    require_once "./app/error/404.php";
                }
            }
        }

        function binhluan(){
            if(!isset($_GET["act"])){
                $this->data["listBL"] = $this->admin_model->TongHopBL();
                $this->data["content"] = "admin/quanly/binhluan/binhluan";
                if(isset($_POST["checkbox"])){
                    $checkboxes = $_POST["checkbox"];
                    foreach($checkboxes as $item){
                        $this->admin_model->deleteField("binhluan","MaSP","=",$item);
                    }
                    header("Location: binhluan");
                }
                $this->render("layout/admin_layout",$this->data);
            }else{
                $boolean = false;
                if($_GET["act"] == "binhluanct"){
                    $this->data["listBL"] = $this->admin_model->ChiTietBL();
                    $this->data["content"] = "admin/quanly/binhluan/binhluanct";
                    if(isset($_POST["checkbox"])){
                        $checkboxes = $_POST["checkbox"];
                        foreach($checkboxes as $item){
                            $this->admin_model->deleteField("binhluan","MaBL","=",$item);
                        }
                        header("Location: binhluan");
                    }
                    $this->render("layout/admin_layout",$this->data);
                    $boolean = true;
                }elseif($_GET["act"] == "xoabinhluan"){
                    $this->db->table("binhluan")->where("MaBL","=",$_GET["IdBL"])->delete();
                    header("Location: binhluan");
                }
                if($boolean == false){
                    require_once "./app/error/404.php";
                }
            }
        }

        function thongke(){
            $this->data["thongke"] = $this->admin_model->ThongKeHH();
           if(!isset($_GET["act"])){
                $this->data["content"] = "admin/quanly/thongke/thongke";
                $this->render("layout/admin_layout",$this->data);
           }elseif($_GET["act"] == "bieudo"){
                $this->data["chart"] = "";
                foreach($this->data["thongke"] as $item){
                    $this->data["chart"] .= "['".$item["TenLoai"]."', ".$item["SL"]."]".",";
                }
                $this->data["chart"] = trim($this->data["chart"],",");
                $this->data["content"] = "admin/quanly/thongke/bieudo";
                $this->render("layout/admin_layout",$this->data);
           }
        }

        function dshoadon(){
            if(!isset($_GET["act"])){
                $this->data["dshoadon"] = $this->admin_model->ListData("hoadon");
                if(isset($_POST["checkbox"])){
                    $checkboxes = $_POST["checkbox"];
                    foreach($checkboxes as $item){
                        $this->admin_model->deleteField("dathang","MHD","=",$item);
                        $this->admin_model->deleteField("hoadon","MHD","=",$item);
                    }
                    header("Location: dshoadon");
                }
                 $this->data["content"] = "admin/quanly/hoadon/dshoadon";
                 $this->render("layout/admin_layout",$this->data);
            }elseif($_GET["act"] == "cthoadon"){
                $this->data["giohang"] = $this->admin_model->listJoin("hanghoa","dathang.MHD",$_GET["MHD"],"HinhAnh,TenHangHoa,
                DonGia,SLSP","dathang","hanghoa.MaHangHoa = dathang.MHH","MHH","INNER","DESC");
                $this->data["content"] = "admin/quanly/hoadon/cthoadon";
                 $this->render("layout/admin_layout",$this->data);
            }elseif($_GET["act"] == "DelHoaDon"){
                $this->admin_model->deleteField("dathang","MHD","=",$_GET["MHD"]);
                $this->admin_model->deleteField("hoadon","MHD","=",$_GET["MHD"]);
                header("Location: dshoadon");
            }
        }
    }
?>