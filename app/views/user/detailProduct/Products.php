
<div class="content">
    <div class="contentSP">
        <h3>Chi tiết sản phẩm</h3>
        <div class="boxSP">
            <div class="view">
                <span><?php echo $detailProduct[0]["SoLuotXem"]?></span>
                <i class="fa-solid fa-eye"></i>
            </div>
            <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$detailProduct[0]["HinhAnh"]?>" alt="">
            <div class="detail">
                <h4>Tên sản phẩm: <span><?php echo $detailProduct[0]["TenHangHoa"]?></span></h4>
                <h4>
                    <span>Đơn giá: <?php echo $detailProduct[0]["DonGia"]?>$</span> |
                    <span class="discount">Giảm giá: <?php echo $detailProduct[0]["DonGia"]-($detailProduct[0]["DonGia"]*($detailProduct[0]["MucGiamGia"]/100))?>$</span>
                </h4>
                <h4>Ngày nhập: <span><?php echo $detailProduct[0]["NgayNhap"]?></span></h4>
                <h4>Mô tả: <span><?php echo $detailProduct[0]["MoTa"]?></span></h4>
                <a href="addSPCT?IdProduct=<?php echo $_GET["IdProduct"]?>" class="cart">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>
    <div class="contentSP">
        <h3>Bình luận</h3>
        <iframe src="formcomment?IdProduct=<?php echo $_GET["IdProduct"];?>" frameborder="0" width="100%" height="400px"></iframe>
    </div>
    <div class="contentSP">
        <h3>Sản phẩm cùng loại</h3>
        <div class="SPCL">
            <ul>
                <?php 
                    foreach($SPCL as $item){
                ?>
                    <li><a href="SanPham?IdProduct=<?php echo $item["MaHangHoa"]?>"><?php echo $item["TenHangHoa"]?></a></li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>