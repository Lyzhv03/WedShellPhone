<?php 
    $TenLoai = new adminModel();
?>

<div class="background">
    <div class="listloaihang">
        <h2>Quản lí hàng hóa</h2>
        <?php 
            if(!empty($listProduct)){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                <thead>
                    <th></th>
                    <th>Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th>Tên loại hoàng</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Giảm giá</th>
                    <th>Lượt xem</th>
                    <th>Ngày nhập</th>
                    <th>Trạng thái</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($listProduct as $item){
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="select" name="checkbox[]" value="<?php echo $item["MaHangHoa"]?>">
                            </td>
                            <td><?php echo $item["MaHangHoa"]?></td>
                            <td><?php echo $item["TenHangHoa"]?></td>
                            <td><?php echo $TenLoai->getListTenLoai($item["MaLoaiHang"])[0]["TenLoai"]?></td>
                            <td><img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$item['HinhAnh']?>" alt=""></td>
                            <td><?php echo $item["DonGia"]?></td>
                            <td><?php echo $item["MucGiamGia"]?>%</td>
                            <td><?php echo $item["SoLuotXem"]?></td>
                            <td><?php echo $item["NgayNhap"]?></td>
                            <td><?php if($item["DacBiet"] == 1){echo "Bình thường";}else{echo "Đặc biệt";}?></td>
                            <td><a href="?act=fixProduct&IdProduct=<?php echo $item["MaHangHoa"]?>" class="sua">Sửa</a></td>
                            <td><a href="?act=DelProduct&IdProduct=<?php echo $item["MaHangHoa"]?>" class="xoa">Xóa</a></td>
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
                <a href="hanghoa">Nhập thêm</a>
            </div>
        </form>
        <?php
            }else{
                echo "<h2>Không có hàng hóa nào</h2>";
                echo "
                    <div class='btn'>
                        <a href='hanghoa'>Thêm hàng hóa</a>
                    </div>
                ";
            }
        ?>
    </div>
</div>