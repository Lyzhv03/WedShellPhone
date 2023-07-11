

<div class="background">
    <div class="listloaihang">
        <h2>Quản lí bình luận</h2>
        <?php 
            if(!empty($listBL)){
        ?>
           <form action="" method="POST" class="boxProduct">
            <table border="1">
                 <thead>
                     <th></th>
                     <th>Hàng Hóa</th>
                     <th>Số bình luận</th>
                     <th>Mới nhất</th>
                     <th>Cũ nhất</th>
                     <th>Action</th>
                 </thead>
                 <tbody>
                     <?php
                         foreach($listBL as $item){
                     ?>
                             <tr>
                                 <td>
                                     <input type="checkbox" class="select" value="<?php echo $item["MaSP"]?>" name="checkbox[]">
                                 </td>
                                 <td><?php echo $item["TenHangHoa"]?></td>
                                 <td><?php echo $item["SoBL"]?></td>
                                 <td><?php echo $item["MAX"]?></td>
                                 <td><?php echo $item["MIN"]?></td>
                                 <td><a href="?act=binhluanct&IdProduct=<?php echo $item["MaSP"]?>" class="sua">Chi tiết</a></td>
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
                echo "Không có bình luận nào!";
                echo "<a href='TrangChu'>Quay lại trang chủ</a>";
            }
        ?>
    </div>
</div>