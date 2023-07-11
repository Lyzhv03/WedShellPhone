
<div class="background">
    <div class="listloaihang">
        <h2>Giỏ hàng</h2>
        <?php 
            if(!empty($giohang) && isset($_SESSION["Login"]["user"])){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                    <thead>
                        <th></th>
                        <th>Hình ảnh</th>
                        <th>Tên SP</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $tong = 0;
                            foreach($giohang as $item){
                                $tong += $item["DonGia"] * $item["SoLuong"];
                        ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select" value="<?php echo $item["MaGioHang"]?>" name="checkbox[]" id="">
                                    </td>
                                    <td><img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$item['HinhAnh'];?>"></td>
                                    <td><?php echo $item["TenHangHoa"]?></td>
                                    <td><?php echo $item["SoLuong"]?></td>
                                    <td><?php echo $item["DonGia"]?></td>
                                    <td><a href="?act=DelCart&MaGH=<?php echo $item["MaGioHang"]?>" class="xoa">Xóa</a></td>
                                </tr>
                                <?php
                            }
                        ?>
                        <tr>
                            <td colspan="4">Tổng</td>
                            <td><?php echo $tong?></td>
                        </tr>
                    </tbody>
            </table>
            <div class="btnCart">
                <input type="button" class="checkAll" name="all" value="Chọn tất cả">
                <input type="button" class="uncheckAll" name="leave" value="Bỏ chọn tất cả">
                <button type="submit" name="btn">Xóa các mục đã chọn</button>
                <a href="Dathang" class="dathang">Đặt hàng</a>
            </div>
        </form>
        <?php
            }else{
                echo "Không có giỏ hàng nào!";
                echo "<a href='Trang-Chu'>Quay lại trang chủ</a>";
            }
        ?>
    </div>
</div>