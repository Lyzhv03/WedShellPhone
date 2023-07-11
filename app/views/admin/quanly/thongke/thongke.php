
<div class="background">
    <div class="listloaihang">
        <h2>Thống kê hàng hóa từng loại</h2>
        <?php 
            if(!empty($thongke)){
        ?>
            <table border="1">
                <thead>
                    <th></th>
                    <th>Loại hàng</th>
                    <th>Số lượng</th>
                    <th>Giá cao nhất</th>
                    <th>Giá thấp nhất</th>
                    <th>Giá trung bình</th>
                </thead>
                <?php
                    foreach($thongke as $item){
                ?>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                            </td>
                            <td><?php echo $item["TenLoai"]?></td>
                            <td><?php echo $item["SL"]?></td>
                            <td><?php echo $item["MAX"]?></td>
                            <td><?php echo $item["MIN"]?></td>
                            <td><?php echo $item["AVG"]?></td>
                        </tr>
                    </tbody>
                <?php
                    }
                ?>
        </table>
        <div class="btn">
            <input type="button" name="all" value="Chon tat ca">
            <input type="button" name="leave" value="Bo chon tat ca">
            <input type="button" name="del" value="Xoa cac muc da chon">
            <a href="?act=bieudo">Biểu đồ</a>
        </div>
        <?php
            }else{
                echo "Không có thống kê nào!";
                echo "<a href='TrangChu'>Quay lại trang chủ</a>";
            }
        ?>
    </div>
</div>