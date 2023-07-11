


<div class="background">
    <div class="danhmuc">
        <h2>Quản lý loại hàng</h2>
        <form action="" method="POST">
            <label for="">
                <h4>Tên loại</h4>
                <input type="text" name="TenLoai" value="<?php echo $tenloai[0]["TenLoai"]?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("TenLoai",$errors))?$errors["TenLoai"]:false;?></p>
            </label>
            <div class="add">
                <input type="submit" name="btn" value="Sửa">
                <a href="?act=danhsach">Danh sách</a>
            </div>
        </form>
    </div>
</div>