
 
<div class="addProduct">
    <h2>Quản lý hàng hóa</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="formProduct">
            <label for="">
                <h4>Mã hàng hóa</h4>
                <input type="text" name="mahanghoa" disabled placeholder="<?php echo $itemProduct[0]["MaHangHoa"]?>">
            </label>
            <label for="">
                <h4>Tên hàng hóa</h4>
                <input type="text" name="TenHangHoa" value="<?php if(!empty($data["field"]["TenHangHoa"])){echo $data["field"]["TenHangHoa"];}else{echo $itemProduct[0]["TenHangHoa"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("TenHangHoa",$errors))?$errors["TenHangHoa"]:false;?></p>
            </label>
            <label for="">
                <h4>Đơn giá</h4>
                <input type="text" name="DonGia" value="<?php if(!empty($data["field"]["DonGia"])){echo $data["field"]["DonGia"];}else{echo $itemProduct[0]["DonGia"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("DonGia",$errors))?$errors["DonGia"]:false;?></p>
            </label>
            <label for="">
                <h4>Giảm giá</h4>
                <input type="text" name="MucGiamGia"  value="<?php if(!empty($data["field"]["MucGiamGia"])){echo $data["field"]["MucGiamGia"];}else{echo $itemProduct[0]["MucGiamGia"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MucGiamGia",$errors))?$errors["MucGiamGia"]:false;?></p>
            </label>
            <label for="">
                <h4>Hình ảnh</h4>
                <input type="file" name="HinhAnh" id="">
            </label>
            <label for="">
                <h4>Loại hàng</h4>
                <select name="MaLoaiHang" id="loaihang">
                    <option value="" selected disabled>Chon</option>
                    <?php 
                        foreach($listLoai as $key=>$item){
                    ?>
                        <option value="<?php echo $item["MaLoai"]?>" <?php if(isset($field["MaLoaiHang"]) && $field["MaLoaiHang"] == $item["MaLoai"] || $itemProduct[0]["MaLoaiHang"] == $item["MaLoai"]){echo "selected";}?>><?php echo $item["TenLoai"]?></option>
                    <?php
                        }
                    ?>
                </select>
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MaLoaiHang",$errors))?$errors["MaLoaiHang"]:false;?></p>
            </label>
            <label for="">
                <h4>Hàng?</h4>
                <div class="border">
                    <label for="db">
                        <input type="radio" name="DacBiet" value="2" <?php if(isset($field["DacBiet"]) && $field["DacBiet"] == 2 || $itemProduct[0]["DacBiet"] == 2){echo "checked";}?>> Đặc biệt
                    </label>
                    <label for="bt">
                        <input type="radio" name="DacBiet" value="1" <?php if(isset($field["DacBiet"]) && $field["DacBiet"] == 1 || $itemProduct[0]["DacBiet"] == 1){echo "checked";}?>> Bình thường
                    </label>
                </div>
                <p class="err"><?php echo (!empty($errors) && array_key_exists("DacBiet",$errors))?$errors["DacBiet"]:false;?></p>
            </label>
            <label for="">
                <h4>Ngày nhập</h4>
                <input type="date" name="NgayNhap" value="<?php if(!empty($data["field"]["NgayNhap"])){echo $data["field"]["NgayNhap"];}else{echo $itemProduct[0]["NgayNhap"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("NgayNhap",$errors))?$errors["NgayNhap"]:false;?></p>
            </label>
            <label for="">
                <h4>Số lượt xem</h4>
                <input type="text" name="SoLuotXem" disabled placeholder="0"> 
            </label>
        </div>
        <label for="">
            <h4>Mô tả</h4>
            <textarea name="MoTa" id="" cols="103" rows="10" value="akaka"><?php echo $itemProduct[0]["MoTa"]?></textarea>
            <p class="err"><?php echo (!empty($errors) && array_key_exists("MoTa",$errors))?$errors["MoTa"]:false;?></p>
        </label>
        <div class="btn">
            <input type="submit" name="btn" value="Sửa">
            <a href="?act=listProduct">Danh sách</a>
        </div>
    </form>
</div>