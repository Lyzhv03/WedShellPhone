

<div class="background">
    <div class="listloaihang">
        <h2>Chi tiết bình luận</h2>
        <?php 
            if(!empty($listBL)){
        ?>
            <form action="" method="POST" class="boxProduct">
                <table border="1">
                    <thead>
                        <th></th>
                        <th>Nội dung</th>
                        <th>Ngày BL</th>
                        <th>Người BL</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listBL as $item){
                        ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select" value="<?php echo $item["MaBL"]?>" name="checkbox[]">
                                    </td>
                                    <td><?php echo $item["NoiDung"]?></td>
                                    <td><?php echo $item["ThoiGianGui"]?></td>
                                    <td><?php echo $item["HoTen"]?></td>
                                    <td><a href="?act=xoabinhluan&IdBL=<?php echo $item["MaBL"]?>" class="xoa">Xóa</a></td>
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
                    <a href="binhluan">Tổng hợp BL</a>
                </div>
            </form>
        <?php
            }else{
                echo "Không có bình luận nào!";
                echo "<a href='TrangChu'>Quay lại trang chủ</a>";
            }
        ?>
    </div>
</div>