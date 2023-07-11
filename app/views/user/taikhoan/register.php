

<div class="FormRegister">
    <h2>Đăng ký tài khoản</h2>
    <form class="form" method="POST" enctype="multipart/form-data">
        <label for="">
            <span>Tên đăng nhập:</span>
            <div class="boxForm">
                <input type="text" name="HoTen" placeholder="Tên đăng nhập...." value="<?php if(!empty($data["field"]["HoTen"])){echo $data["field"]["HoTen"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HoTen",$errors))?$errors["HoTen"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Email:</span>
            <div class="boxForm">
                <input type="text" name="Email" placeholder="Email...." value="<?php if(!empty($data["field"]["Email"])){echo $data["field"]["Email"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("Email",$errors))?$errors["Email"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Mật khẩu:</span>
            <div class="boxForm">
                <input type="password" class="password" name="MK" placeholder="*****">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MK",$errors))?$errors["MK"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Xác nhận Mật khẩu:</span>
            <div class="boxForm">
                <input type="password" class="password" name="confirm_password" placeholder="*****">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("confirm_password",$errors))?$errors["confirm_password"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Hình ảnh:</span>
            <div class="boxForm">
                <input type="file" name="HinhAnh" id="">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HinhAnh",$errors))?$errors["HinhAnh"]:false;?></p>
            </div>
        </label>
        <input type="submit" name="btn" value="Đăng ký">
    </form>
</div>