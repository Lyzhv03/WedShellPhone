
<div class="background">
    <div class="listloaihang">
        <h2>Hóa đơn</h2>
        <?php 
            if(!empty($hoadon) && isset($_SESSION["Login"]["user"])){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                    <thead>
                        <th>Mã hóa đơn</th>
                        <th>Ngày đặt</th>
                        <th>Số lượng SP</th>
                        <th>Thành tiền</th>
                        <th>Thanh Toán</th>
                        <th>Tình trạng</th>
                    </thead>
                    <tbody>
                        <?php
                            $tong = 0;
                            foreach($hoadon as $item){
                        ?>
                                <tr>
                                    <td>MHD<?php echo $item["MHD"]?></td>
                                    <td><?php echo $item["NgayDatHang"]?></td>
                                    <td><a href="?act=cthoadon&MHD=<?php echo $item["MHD"]?>" class="cthoadon"><?php echo $item["SLSP"]?></a></td>
                                    <td><?php echo $item["TongTien"]?></td>
                                    <td><?php if($item["PTTT"] == 0){echo "Trực tiếp";}else{echo "Online";}?></td>
                                    <td><?php if($item["TinhTrang"] == 0){echo "Đơn hàng mới";}?></td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
            </table>
        </form>
        <?php
            }else{
                echo "Bạn chưa có hóa đơn nào!";
                echo "<a href='Trang-Chu'>Quay lại trang chủ</a>";
            }
        ?>
    </div>
</div>