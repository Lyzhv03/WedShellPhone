
<div class="background">
    <div class="listloaihang">
        <h2>Quản lí hóa đơn</h2>
        <?php 
            if(!empty($dshoadon)){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                <thead>
                    <th></th>
                    <th>Mã hóa đơn</th>
                    <th>khách hàng</th>
                    <th>Số lượng hàng</th>
                    <th>Tổng tiền</th>
                    <th>Thanh toán</th>
                    <th>Tình trạng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($dshoadon as $item){
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="select" name="checkbox[]" value="<?php echo $item["MHD"]?>">
                            </td>
                            <td><?php echo $item["MHD"]?></td>
                            <td>
                                <p>Họ tên: <?php echo $item["HoTen"]?></p>
                                <p>SDT: <?php echo $item["SDT"]?></p>
                                <p>Địa chỉ: <?php echo $item["DiaChi"]?></p>
                            </td>
                            <td><a href="?act=cthoadon&MHD=<?php echo $item["MHD"]?>" class="cthoadon"><?php echo $item["SLSP"]?></a></td>
                            <td><?php echo $item["TongTien"]?>$</td>
                            <td><?php if($item["PTTT"] == 0){echo "Trực tiếp";}else{echo "Online";}?></td>
                            <td><?php if($item["TinhTrang"] == 0){echo "Đơn hàng mới";}?></td>
                            <td><?php echo $item["NgayDatHang"]?></td>
                            <td><a href="?act=DelHoaDon&MHD=<?php echo $item["MHD"]?>" class="xoa">Xóa</a></td>
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
            </div>
        </form>
        <?php
            }else{
                echo "<h2>Không có hóa đơn nào</h2>";
            }
        ?>
    </div>
</div>