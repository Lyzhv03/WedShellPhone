

<div class="FormLogin">
    <h2>Tài khoản</h2>
    <form class="form"  method="POST">
        <label for="">
            <span>Tên đăng nhập:</span>
            <div class="boxForm">
                <input type="text" name="HoTen" placeholder="Tên đăng nhập...." value="<?php if(!empty($data["field"]["HoTen"])){echo $data["field"]["HoTen"];}elseif(isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HoTen",$errors))?$errors["HoTen"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Mật khẩu:</span>
            <div class="boxForm">
                <input type="password" class="password" name="MK" placeholder="*****" value="<?php if(isset($_COOKIE["password"])){echo $_COOKIE["password"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MK",$errors))?$errors["MK"]:false;?></p>
            </div>
        </label>
        <div class="ghinho">
            <input type="checkbox" name="ghinho" id="">
            <span>Lưu đăng nhập</span>
        </div>
        <span class="forgot"><a href="ForgotPassword">Quên mật khẩu?</a></span>
        <input type="submit" name="btn" value="Đăng nhập">
    </form>
</div>