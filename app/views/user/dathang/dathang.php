

<div class="FormLogin">
    <h2>Thông tin đặt hàng:</h2>
    <form class="form"  method="POST">
        <label for="">
            <span>Họ và Tên:</span>
            <div class="boxForm">
                <input type="text" name="HoTen" placeholder="Tên đăng nhập...." value="<?php if(!empty($data["field"]["HoTen"])){echo $data["field"]["HoTen"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("HoTen",$errors))?$errors["HoTen"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Địa chỉ:</span>
            <div class="boxForm">
                <input type="text" name="DiaChi" placeholder="Địa chỉ...." value="<?php if(!empty($data["field"]["DiaChi"])){echo $data["field"]["DiaChi"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("DiaChi",$errors))?$errors["DiaChi"]:false;?></p>
            </div>
        </label>
        <label for="">
            <span>Số điện thoại:</span>
            <div class="boxForm">
                <input type="text" name="SDT" placeholder="Số điện thoại..." value="<?php if(!empty($data["field"]["SDT"])){echo $data["field"]["SDT"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("SDT",$errors))?$errors["SDT"]:false;?></p>
            </div>
        </label>
        <div class="phuongthuc">
            <span>Phương thức thanh toán:</span>
            <div class="by">
                <input type="radio" name="PTTT" value="0" checked> Trực tiếp
                <input type="radio" name="PTTT" value="1"> Online
            </div>
        </div>
        <input type="submit" name="btn" value="Đặt hàng">
    </form>
</div>