
<div class="profile">
    <div class="infor">
        <div class="avatar">
            <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/avatar/".$_SESSION["Login"]["user"]["HinhAnh"]?>" alt="">
            <p><?php echo $_SESSION["Login"]["user"]["HoTen"]?></p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="HinhAnh" class="file-input" hidden>
            <label for="">
                <h4>Email:</h4>
                <input type="email" name="Email" id="" value="<?php echo $_SESSION["Login"]["user"]["Email"]?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("Email",$errors))?$errors["Email"]:false;?></p>
            </label>
            <label for="">
                <h4>Mật khẩu:</h4>
                <input type="password" name="MK" id="" value="<?php echo $_SESSION["Login"]["user"]["MK"]?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("MK",$errors))?$errors["MK"]:false;?></p>
            </label>
            <input type="submit" class="capnhat" name="btn" value="Cập nhật">
        </form>
    </div>
</div>

<script>
    var avatar = document.querySelector(".infor .avatar img");
    var fileip = document.querySelector(".file-input");
    avatar.addEventListener("click",()=>{
        fileip.click();
    });
</script>