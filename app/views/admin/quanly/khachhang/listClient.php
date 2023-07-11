
<div class="background">
    <div class="listloaihang">
        <h2>Quản lí khách hàng</h2>
        <?php 
            if(!empty($listClient)){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                    <thead>
                        <th></th>
                        <th>Mã KH</th>
                        <th>Họ và Tên</th>
                        <th>Mật khẩu</th>
                        <th>Địa chỉ email</th>
                        <th>Hình ảnh</th>
                        <th>Vai trò</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listClient as $item){
                        ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select" name="checkbox[]" value="<?php echo $item["MaKH"]?>">
                                    </td>
                                    <td><?php echo $item["MaKH"]?></td>
                                    <td><?php echo $item["HoTen"]?></td>
                                    <td><?php echo $item["MK"]?></td>
                                    <td><?php echo $item["Email"]?></td>
                                    <td><img src="<?php echo _WEB_ROOT_."/public/assets/client/images/avatar/".$item['HinhAnh'];?>"></td>
                                    <td><?php if($item["VaiTro"] == 1){echo "khách hàng";}else{echo "Nhân viên";}?></td>
                                    <td><a href="?act=fixClient&IdClient=<?php echo $item["MaKH"]?>" class="sua">Sửa</a></td>
                                    <td><a href="?act=DelClient&IdClient=<?php echo $item["MaKH"]?>" class="xoa">Xóa</a></td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
            </table>
            <div class="btn">
                <input type="button" class="checkAll" name="all" value="Chọn tất cả">
                <input type="button" class="uncheckAll" name="leave" value="Bỏ chọn tất cả">
                <button type="submit" name="btn">Xóa các mục đã chọn</button>
                <a href="khachhang">Nhập thêm</a>
            </div>
        </form>
        <?php
            }else{
                echo "Không có khách hàng nào!";
                echo "<a href='khachhang'>Thêm khách hàng</a>";
            }
        ?>
    </div>
</div>