
<div class="background">
    <div class="listloaihang">
        <h2>Sản phẩm đã đặt</h2>
        <?php 
            if(!empty($giohang)){
        ?>
        <form action="" method="POST" class="boxProduct">
            <table border="1">
                    <thead>
                        <th>Hình ảnh</th>
                        <th>Tên SP</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                    </thead>
                    <tbody>
                        <?php
                            $tong = 0;
                            foreach($giohang as $item){
                                $tong += $item["DonGia"] * $item["SLSP"];
                        ?>
                                <tr>
                                    <td><img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$item['HinhAnh'];?>"></td>
                                    <td><?php echo $item["TenHangHoa"]?></td>
                                    <td><?php echo $item["SLSP"]?></td>
                                    <td><?php echo $item["DonGia"]?></td>
                                </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td colspan="3">Tổng</td>
                            <td><?php echo $tong?></td>
                        </tr>
                    </tbody>
            </table>
            <div class="btn">
                <a href="dshoadon">Danh sách hóa đơn</a>
            </div>
        </form>
        <?php
            }
        ?>
    </div>
</div>