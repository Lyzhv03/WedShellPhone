

<div class="addClient">
    <h2>Quản lý khách hàng</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="formClient">
            <label for="">
                <h4>Mã khách hàng</h4>
                <input type="text" name="MaKH" disabled placeholder="Auto number" value="<?php if(!empty($data["field"]["MaKH"])){echo $data["field"]["MaKH"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MaKH",$errors))?$errors["MaKH"]:false;?></p>
            </label>
            <label for="">
                <h4>Họ và Tên</h4>
                <input type="text" name="HoTen" value="<?php if(!empty($data["field"]["HoTen"])){echo $data["field"]["HoTen"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HoTen",$errors))?$errors["HoTen"]:false;?></p>
            </label>
            <label for="">
                <h4>Mật khẩu</h4>
                <input type="password" name="MK">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MK",$errors))?$errors["MK"]:false;?></p>
            </label>
            <label for="">
                <h4>Xác nhận mật khẩu</h4>
                <input type="password" name="rmk">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("rmk",$errors))?$errors["rmk"]:false;?></p>
            </label>
            <label for="">
                <h4>Địa chỉ email</h4>
                <input type="email" name="Email" value="<?php if(!empty($data["field"]["Email"])){echo $data["field"]["Email"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("Email",$errors))?$errors["Email"]:false;?></p>
            </label>
            <label for="">
                <h4>Hình ảnh</h4>
                <input type="file" name="HinhAnh" id="">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HinhAnh",$errors))?$errors["HinhAnh"]:false;?></p>
            </label>
            <label for="">
                <h4>Kích hoạt</h4>
                <div class="border">
                    <label for="db">
                            <input type="radio" name="KichHoat" value="1" <?php if(isset($field["KichHoat"]) && $field["KichHoat"] == 1){echo "checked";}?>> Chưa kích hoạt
                    </label>
                    <label for="bt">
                        <input type="radio" name="KichHoat" value="2"  <?php if(isset($field["KichHoat"]) && $field["KichHoat"] == 2){echo "checked";}?>> Kích hoạt
                    </label>
                </div>
                <p class="err"><?php echo (!empty($errors) && array_key_exists("KichHoat",$errors))?$errors["KichHoat"]:false;?></p>
            </label>
            <label for="">
                <h4>Vai trò</h4>
                <div class="border">
                    <label for="db">
                        <input type="radio" name="VaiTro" value="1" <?php if(isset($field["VaiTro"]) && $field["VaiTro"] == 1){echo "checked";}?>> Khách hàng
                    </label>
                    <label for="bt">
                        <input type="radio" name="VaiTro" value="2" <?php if(isset($field["VaiTro"]) && $field["VaiTro"] == 2){echo "checked";}?>> Nhân viên
                    </label>
                </div>
                <p class="err"><?php echo (!empty($errors) && array_key_exists("VaiTro",$errors))?$errors["VaiTro"]:false;?></p>
            </label>
        </div>
        <div class="btn">
            <input type="submit" name="btn" value="Thêm mới">
            <a href="?act=listClient">Danh sách</a>
        </div>
    </form>
</div>