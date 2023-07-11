
<div class="background">
    <div class="listloaihang">
        <h2>Quản lí loại hàng</h2>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                <thead>
                    <th></th>
                    <th>Mã loại</th>
                    <th>Tên loại</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($listLoai)){
                            foreach($listLoai as $key=>$item){
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" class="select" name="checkbox[]" value="<?php echo $item["MaLoai"]?>">
                        </td>
                        <td><?php echo $item["MaLoai"]?></td>
                        <td><?php echo $item["TenLoai"]?></td>
                        <td><a href="?act=fixLoai&Maloai=<?php echo $item["MaLoai"]?>" class="sua">Sửa</a></td>
                        <td><a href="?act=DelLoai&Maloai=<?php echo $item["MaLoai"]?>" class="xoa">Xóa</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="btn">
                <input type="button" class="checkAll" name="all" value="Chọn tất cả">
                <input type="button" class="uncheckAll" name="leave" value="Bỏ chọn tất cả">
                <button type="submit" name="btn">Xóa các mục đã chọn</button>
                <a href="danhmuc">Nhập thêm</a>
            </div>
        </form>
    </div>
</div>