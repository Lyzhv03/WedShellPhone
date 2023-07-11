<?php 
    class home extends controller{
        public $model_home,$data;

        function __construct()
        {
            session_start();
            $this->model_home = $this->model("clientModel");
            $this->data["danhmuc"] = $this->model_home->listData("loai","*");
            $this->data["SPLove"] = $this->model_home->Top10("hanghoa","SoLuotXem","SoLuotXem","DESC",0,10);
            $this->data["SL"] = $this->SoLuongSP();
        }
        
        function index(){
            $this->data["content"] = "user/TrangChu";
            $this->data["listProduct"] = $this->model_home->listData("hanghoa","*");
            $this->render("layout/client_layout",$this->data);
        }

        function Register(){
            $request = new Request();

            $this->data["field"] = $request->getFields();

        
            $request->rules([
                "HoTen" => "required|min:5|max:30|unique:khachhang:HoTen",
                "Email" => "required|email|min:6|unique:khachhang:Email",
                "MK" => "required|min:5",
                "confirm_password" => "required|min:5|match:MK",
            ]);

            $request->message([
                "HoTen.required" => "Họ tên không được để trống",
                "HoTen.min" => "Họ tên phải lớn hơn 5 kí tự",
                "HoTen.max" => "Họ tên phải nhỏ hơn 30 kí tự",
                "HoTen.unique" => "Họ tên đã tồn tại",
                "Email.required" => "Email không được để trống",
                "Email.email" => "Định dạng email không hợp lệ",
                "Email.min" => "Email phải lớn hơn 6 kí tự",
                "Email.unique" => "Email đã tồn tại",
                "HinhAnh.checkfile" => "Hình ảnh không được để trống",
                "MK.required" => "Mật khẩu không được để trống",
                "MK.min" => "Mật khẩu phải lớn hơn 5 kí tự",
                "confirm_password.required" => "Nhập lại mật khẩu không được để trống",
                "confirm_password.min" => "Nhập lại mật khẩu phải lớn hơn 5 kí tư",
                "confirm_password.match" => "Mật khẩu nhập lại không khớp",
            ]);

            if(!empty($_POST["btn"])){
                    $validate = $request->validate();
                if(!$validate){
                    $this->data["errors"] = $request->errors();
                }else{
                    $this->data["errors"] = "";
                    unset($this->data["field"]["confirm_password"]);
                    unset($this->data["field"]["btn"]);
                    $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                    $check = $this->db->table("khachhang")->insert($this->data["field"]);
                    if($check){
                        $this->data["field"] = "";
                        echo "<script>alert('Đăng ký thành công!')</script>";
                    }
                }
            }
            $this->data["content"] = "user/taikhoan/register";
            $this->render("layout/client_layout",$this->data);
        }

        function Login(){
            $request = new Request();

            $this->data["field"] = $request->getFields();

            $request->rules([
                "HoTen" => "required|min:5|max:30|",
                "MK" => "required|min:5",
            ]);

            $request->message([
                "HoTen.required" => "Họ tên không được để trống",
                "HoTen.min" => "Họ tên phải lớn hơn 5 kí tự",
                "HoTen.max" => "Họ tên phải nhỏ hơn 30 kí tự",
                "MK.required" => "Mật khẩu không được để trống",
                "MK.min" => "Mật khẩu phải lớn hơn 5 kí tự",
            ]);

            if(!empty($_POST["btn"])){
                $validate = $request->validate();
                if(!$validate){
                    $this->data["errors"] = $request->errors();
                }else{
                    $this->data["errors"] = "";
                    $data = $request->getFields();
                    unset($data["confirm_password"]);
                    if(!empty($this->data["field"])){
                        $check = $this->db->table("khachhang")->where("HoTen","=",$this->data["field"]["HoTen"])
                        ->where("MK","=",$this->data["field"]["MK"])->get();
                        if(!$check){
                            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!')</script>";
                        }else{
                            $response = new Response();
                            if(isset($_POST["ghinho"])){
                                setcookie("user",$this->data["field"]["HoTen"],time()+86400);
                                setcookie("password",$this->data["field"]["MK"],time()+86400);
                            }
                            if($check[0]["VaiTro"] == 2){
                                $_SESSION["Login"]["admin"] = $check[0];
                                if(isset($_SESSION["Login"]["admin"])){
                                    $response->redirect("TrangChu");
                                }
                            }else{
                                $_SESSION["Login"]["user"] = $check[0];
                                if(isset($_SESSION["Login"]["user"])){
                                    $response->redirect("Welcome");
                                }
                            }
                        }
                    }

                }
            }
            $this->data["content"] = "user/taikhoan/login";
            $this->render("layout/client_layout",$this->data);
        }

        function Welcome(){
            if(isset($_SESSION["Login"]["user"])){
                $this->data["content"] = "user/Welcome";
                $this->data["user"] = $_SESSION["Login"]["user"];
                $this->render("layout/client_layout",$this->data);
            }
        }

        function LogOut(){
            session_unset();
            session_destroy();
            $response = new Response();
            $response->redirect("Trang-Chu");
        }

        function ForgotPassword(){
            $request = new Request();

            $this->data["field"] = $request->getFields();
        
            $request->rules([
                "Email" => "required|email|min:6|notexist:khachhang:Email",
            ]);

            $request->message([
                "Email.required" => "Email không được để trống",
                "Email.email" => "Định dạng email không hợp lệ",
                "Email.min" => "Email phải lớn hơn 6 kí tự",
                "Email.notexist" => "Email không tồn tại",
            ]);

            if(!empty($_POST["sendpass"])){
                $validate = $request->validate();
                if(!$validate){
                    $this->data["errors"] = $request->errors();
                }else{
                    $this->data["errors"] = "";
                    unset($this->data["field"]["confirm_password"]);
                    $pass = $this->data["pass"] = $this->model_home->detailData("khachhang","MK","Email",$this->data["field"]["Email"]);
                    if(!empty($pass)){
                        $this->data["field"] = "";
                        echo "<script>alert('Mật khẩu của bạn là: ".$pass[0]["MK"]."')</script>";
                    }
                    
                }
            }

            $this->data["content"] = "user/taikhoan/forgotpassword";
            $this->render("layout/client_layout",$this->data);
        }

        function Products(){
            if(!empty($_GET["IdProduct"])){
                $this->data["detailProduct"] = $this->model_home->detailData("hanghoa","*","MaHangHoa",$_GET["IdProduct"]);
                $this->data["SPCL"] = $this->model_home->detailData("hanghoa","*","MaLoaiHang",$this->data["detailProduct"][0]["MaLoaiHang"]);
                for($i = 0; $i < count($this->data["SPCL"]); $i++){
                    if($this->data["SPCL"][$i]["MaHangHoa"] == $_GET["IdProduct"]){
                        unset($this->data["SPCL"][$i]);
                        break;
                    };
                }
                $view = $this->model_home->detailData("hanghoa","SoLuotXem","MaHangHoa",$_GET["IdProduct"]);
                $views = [
                    "SoLuotXem" => $view[0]["SoLuotXem"] + 1
                ];
                $this->model_home->updateView($views,$_GET["IdProduct"]);
                // $this->data["db"] = "";
            }
            $this->data["content"] = "user/detailProduct/Products";
            $this->render("layout/client_layout",$this->data);
        }

        function listdm(){
            if(!empty($_GET["Iddm"])){
                $this->data["listProduct"] = $this->model_home->detailData("hanghoa","*","MaLoaiHang",$_GET["Iddm"]);
                $this->data["TenLoai"] = $this->model_home->detailData("loai","TenLoai","MaLoai",$_GET["Iddm"]);
            }elseif(isset($_GET["key"])){
                $this->data["listProduct"] = $this->model_home->searchSP($_GET["key"]);
            }
            $this->data["content"] = "user/detailProduct/danhmuc";
            $this->render("layout/client_layout",$this->data);
        }

        function SearchSP(){
            if(isset($_GET["key"])){
                $this->data["listProduct"] = $this->model_home->searchSP($_GET["key"]);
                $this->data["content"] = "user/danhmuc";
                $this->render("layout/client_layout",$this->data);
            }
        }

        function formComment(){
            $this->data["contentDef"] = "user/detailProduct/formComment";
            if(!empty($_POST["send"])){
                if(isset($_SESSION["Login"]["user"])){
                    if(!empty($_POST["NoiDung"])){
                        date_default_timezone_set("Asia/Ho_Chi_Minh");
                        $this->data["field"]["MaKH"] = $_SESSION["Login"]["user"]["MaKH"];
                        $this->data["field"]["MaSP"] = $_GET["IdProduct"];
                        $this->data["field"]["ThoiGianGui"] = date("y/m/d h:i:s");
                        $this->data["field"]["NoiDung"] = $_POST["NoiDung"];
                        $this->db->table("binhluan")->insert($this->data["field"]);
                    }
                }else{
                    echo "<script>alert('Bạn cần đăng nhập để bình luận')</script>";
                }
            }
            $this->data["listBL"] = $this->model_home->listJoin("binhluan","MaSP",$_GET["IdProduct"],"*","khachhang","binhluan.MaKH = khachhang.MaKH","MaBL","INNER","DESC");
            $this->render("layout/client_layout",$this->data);
        }

        function capnhattk(){
            $request = new Request();

            $this->data["field"] = $request->getFields();

        
            $request->rules([
                "Email" => "required|email|min:6",
                "MK" => "required|min:5",
            ]);

            $request->message([
                "Email.required" => "Email không được để trống",
                "Email.email" => "Định dạng email không hợp lệ",
                "Email.min" => "Email phải lớn hơn 6 kí tự",
                "HinhAnh.checkfile" => "Hình ảnh không được để trống",
                "MK.required" => "Mật khẩu không được để trống",
                "MK.min" => "Mật khẩu phải lớn hơn 5 kí tự",
            ]);

            if(!empty($_POST["btn"])){
                if(empty($_FILES["HinhAnh"]["name"])){
                    $this->data["field"]["HinhAnh"] = $_SESSION["Login"]["user"]["HinhAnh"];
                }else{
                    $this->data["field"]["HinhAnh"] = $_FILES["HinhAnh"]["name"];
                }

                $validate = $request->validate();
                
                if(!$validate){
                    $this->data["errors"] = $request->errors();
                }else{
                    unset($this->data["field"]["btn"]);
                    $this->data["errors"] = "";
                    $check = $this->db->table("khachhang")->where("MaKH","=",$_SESSION["Login"]["user"]["MaKH"])->update($this->data["field"]);
                    if($check){
                        $this->data["field"] = "";
                        $person = $this->model_home->detailData("khachhang","*","MaKH",$_SESSION["Login"]["user"]["MaKH"]);
                        $_SESSION["Login"]["user"] = $person[0];
                        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"],_DIR_ROOT_."\public\assets\client\images\avatar"."\\".$_FILES["HinhAnh"]["name"]);
                        header("Location: CapNhat?act=account");
                    }
                }
            }
            $this->data["content"] = "user/taikhoan/capnhattk";
            $this->render("layout/client_layout",$this->data);
        }

        function addToCart(){
            $response = new Response();
            if(isset($_SESSION["Login"]["user"])){
                $count = $this->model_home->existPR("giohang","COUNT(*) as sl","MaHangHoa",$_GET["IdProduct"],"MKH",$_SESSION["Login"]["user"]["MaKH"])[0];
                if($count["sl"] == 1){
                    $soluong = $this->model_home->existPR("giohang","SoLuong","MaHangHoa",$_GET["IdProduct"],"MKH",$_SESSION["Login"]["user"]["MaKH"])[0];
                    $soluongSP = [
                        "SoLuong" => $soluong["SoLuong"] + $_POST["SoLuong"]
                    ];
                    $this->model_home->updateSL($soluongSP,$_GET["IdProduct"],$_SESSION["Login"]["user"]["MaKH"]);
                    $response->redirect("Trang-Chu");
                }else{
                    $this->data["field"] = $this->model_home->detailData("hanghoa","MaHangHoa","MaHangHoa",$_GET["IdProduct"])[0];
                    $this->data["field"]["SoLuong"] = $_POST["SoLuong"];
                    $this->data["field"]["MKH"] = $_SESSION["Login"]["user"]["MaKH"];
                    $check = $this->model_home->insertData("giohang",$this->data["field"]);
                    if($check){
                        $response->redirect("Trang-Chu");
                    }
                }
            }else{
                $response->redirect("Login");
            }
        }

        function addToCartSP(){
            $response = new Response();
            if(isset($_SESSION["Login"]["user"])){
                $count = $this->model_home->existPR("giohang","COUNT(*) as sl","MaHangHoa",$_GET["IdProduct"],"MKH",$_SESSION["Login"]["user"]["MaKH"])[0];
                if($count["sl"] == 1){
                    $soluong = $this->model_home->existPR("giohang","SoLuong","MaHangHoa",$_GET["IdProduct"],"MKH",$_SESSION["Login"]["user"]["MaKH"])[0];
                    $soluongSP = [
                        "SoLuong" => $soluong["SoLuong"] + 1
                    ];
                    $this->model_home->updateSL($soluongSP,$_GET["IdProduct"],$_SESSION["Login"]["user"]["MaKH"]);
                    $response->redirect("SanPham?IdProduct=".$_GET["IdProduct"]);
                    $response->redirect("Trang-Chu");
                }else{
                    $this->data["field"] = $this->model_home->detailData("hanghoa","MaHangHoa","MaHangHoa",$_GET["IdProduct"])[0];
                    $this->data["field"]["SoLuong"] = 1;
                    $this->data["field"]["MKH"] = $_SESSION["Login"]["user"]["MaKH"];
                    $check = $this->model_home->insertData("giohang",$this->data["field"]);
                    if($check){
                        $response->redirect("SanPham?IdProduct=".$_GET["IdProduct"]);
                    }
                }
            }else{
                $response->redirect("Login");
            }
        }

        function GioHang(){
            if(isset($_SESSION["Login"]["user"])){
                if(!isset($_GET["act"])){
                    $this->data["giohang"] = $this->model_home->listJoin("giohang","MKH",$_SESSION["Login"]["user"]["MaKH"],"MaGioHang,HinhAnh,TenHangHoa,
                    DonGia,SoLuong","hanghoa","giohang.MaHangHoa = hanghoa.MaHangHoa","MaGioHang","INNER","DESC");
                }elseif($_GET["act"] == "DelCart"){
                    $this->db->table("giohang")->where("MaGioHang","=",$_GET["MaGH"])->delete();
                    header("Location: GioHang");
                }
                if(isset($_POST["checkbox"])){
                    $checkboxes = $_POST["checkbox"];
                    foreach($checkboxes as $item){
                        $this->model_home->deleteField("giohang","MaGioHang","=",$item);
                        header("Location: GioHang");
                    }
                }
            }
            $this->data["content"] = "user/giohang/giohang";
            $this->render("layout/client_layout",$this->data);
        }

        function SoLuongSP(){
            if(isset($_SESSION["Login"]["user"])){
                $this->data["giohang"] = $this->model_home->listJoin("giohang","MKH",$_SESSION["Login"]["user"]["MaKH"],"MaGioHang,HinhAnh,TenHangHoa,
                DonGia,SoLuong","hanghoa","giohang.MaHangHoa = hanghoa.MaHangHoa","MaGioHang","INNER","DESC");
                $soluong = 0;
                if(!empty($this->data["giohang"])){
                    foreach($this->data["giohang"] as $item){
                        $soluong += $item["SoLuong"];
                    }
                }
                return $soluong;
            }
        }

        function gioithieu(){
            $this->data["content"] = "user/gt/gioithieu";
            $this->render("layout/client_layout",$this->data);
        }

        function dathang(){
            $request = new Request();
            $this->data["field"] = $request->getFields();
            $request->rules([
                "HoTen" => "required|min:5|max:30",
                "DiaChi" => "required",
                "SDT" => "required|min:10",
            ]);

            $request->message([
                "HoTen.required" => "Họ tên không được để trống",
                "HoTen.min" => "Họ tên phải lớn hơn 5 kí tự",
                "HoTen.max" => "Họ tên phải nhỏ hơn 30 kí tự",
                "DiaChi.required" => "Địa chỉ không được để trống",
                "SDT.required" => "Số điện thoại không được để trống",
                "SDT.min" => "Số điện thoại phải tối thiểu 10 số",
            ]);

            if(!empty($_POST["btn"])){
                    $validate = $request->validate();
                if(!$validate){
                    $this->data["errors"] = $request->errors();
                }else{
                    $this->data["errors"] = "";
                    unset($this->data["field"]["btn"]);
                    $this->data["field"]["MKH"] = $_SESSION["Login"]["user"]["MaKH"];
                    $this->data["field"]["NgayDatHang"] = date("Y/m/d h:i:s");
                    $this->data["field"]["SLSP"] = $this->data["SL"];
                    $giohang = $this->model_home->listJoin("giohang","MKH",$_SESSION["Login"]["user"]["MaKH"],"MaGioHang,HinhAnh,
                    DonGia,SoLuong,giohang.MaHangHoa","hanghoa","giohang.MaHangHoa = hanghoa.MaHangHoa","MaGioHang","INNER","DESC");
                    $tong = 0;
                    foreach($giohang as $item){
                        $tong += $item["DonGia"] * $item["SoLuong"];
                    }
                    $this->data["field"]["TongTien"] = $tong;
                    $check = $this->model_home->insertData("hoadon",$this->data["field"]);
                    if($check){
                        $dathang = $this->model_home->detailData("hoadon","MHD","MKH",$_SESSION["Login"]["user"]["MaKH"],"MHD","DESC");
                        $this->data["dathang"]["MHD"] = $dathang[0]["MHD"];
                        foreach($giohang as $item){
                            $this->data["dathang"]["MHH"] = $item["MaHangHoa"];
                            $this->data["dathang"]["SLSP"] = $item["SoLuong"];
                            $this->model_home->insertData("dathang",$this->data["dathang"]);
                        }
                        $this->model_home->deleteField("giohang","MKH","=",$_SESSION["Login"]["user"]["MaKH"]);
                        header("Location: Donhang");
                    }
                }
            }

            $this->data["content"] = "user/dathang/dathang";
            $this->render("layout/client_layout",$this->data);
        }

        function donhang(){
            if(isset($_SESSION["Login"]["user"])){
                if(empty($_GET["act"])){
                    $this->data["hoadon"] = $this->model_home->detailData("hoadon","MHD,NgayDatHang,SLSP,TongTien,PTTT,TinhTrang","MKH",$_SESSION["Login"]["user"]["MaKH"]);
                }elseif($_GET["act"] == "cthoadon"){
                    $this->data["giohang"] = $this->model_home->listJoin("hanghoa","dathang.MHD",$_GET["MHD"],"HinhAnh,TenHangHoa,
                    DonGia,SLSP","dathang","hanghoa.MaHangHoa = dathang.MHH","MHH","INNER","DESC");
                    $this->data["content"] = "user/dathang/cthoadon";
                    $this->render("layout/client_layout",$this->data);
                }
            }
            $this->data["content"] = "user/dathang/hoadon";
            $this->render("layout/client_layout",$this->data);
        }
    }
?>