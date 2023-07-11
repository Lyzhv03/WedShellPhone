

<div class="background">
    <div class="danhmuc">
        <h2>Quản lý loại hàng</h2>
        <form action="" method="POST">
            <label for="">
                <h4>Mã loại</h4>
                <input type="text" disabled placeholder="Auto number">
            </label>
            <label for="">
                <h4>Tên loại</h4>
                <input type="text" name="TenLoai" id="" value="<?php if(!empty($data["field"]["TenLoai"])){echo $data["field"]["TenLoai"];}?>">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("TenLoai",$errors))?$errors["TenLoai"]:false;?></p>
            </label>
            <div class="add">
                <input type="submit" name="btn" value="Thêm mới">
                <a href="?act=danhsach">Danh sách</a>
            </div>
        </form>
    </div>
</div>