

<div class="container">
  <h1 class="heading">Các sản phẩm <?php if(!empty($TenLoai[0]["TenLoai"])){echo $TenLoai[0]["TenLoai"];}?> của <span>X-Shop</span></h1>
  <section id="Iphone">
    <div class="box-product">
      <?php 
        if(!empty($listProduct)){
          foreach($listProduct as $item){
      ?>
        <div class="box-item">
          <span class="sale">-<?php echo $item["MucGiamGia"]?>%</span>
          <div class="icons">
            <a href="#" class="fas fa-heart"></a>
            <a href="#" class="fas fa-share"></a>
            <a href="SanPham?IdProduct=<?php echo $item["MaHangHoa"]?>" class="fas fa-eye"></a>
          </div>
          <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/products/".$item["HinhAnh"]?>" alt="">
          <div class="inforSP">
            <h3><?php echo $item["TenHangHoa"]?></h3>
            <div class="price"><?php echo $item["DonGia"]-($item["DonGia"]*($item["MucGiamGia"]/100))?>$<span><?php echo $item["DonGia"]?>$</span></div>
            <div class="quantity">
                <form action="addToCart?IdProduct=<?php echo $item["MaHangHoa"]?>" method="POST">
                  <span>quantity: </span>
                  <input type="number" class="soluong" name="SoLuong" min="1" max="1000" value="1">
                  <input type="submit" class="btn" name="btn" value="Thêm vào giỏ hàng">
                </form>
            </div>
          </div>
        </div>
      <?php
          }
        }else{
            if(isset($_GET["key"])){
                echo "<h3>Không có sản phẩm nào có tên là ".$_GET["key"]."</h3>";
            }
        }
      ?>
    </div>
  </section>
</div>
<div class="contact" id="contact">
  <h2>Liên hệ với chúng tôi</h2>
  <form action="">
    <div class="contactForm">
      <div class="formInfor">
        <label for="">
          <h4>TÊN</h4>
          <input type="text" name="" placeholder="Enter your name..." required>
        </label>
        <label for="">
          <h4>VẤN ĐỀ</h4>
          <input type="text" name="" placeholder="Enter subject..." required>
        </label>
      </div>
      <div class="formInfor">
        <label for="">
          <h4>ĐỊA CHỈ EMAIL</h4>
          <input type="text" name="" placeholder="Enter your email address..." required>
        </label>
        <label for="">
          <h4>Yêu cầu loại</h4>
          <input type="text" name="" placeholder="Avertising...">
        </label>
      </div>
    </div>
    <label for="">
      <h4>Tin nhắn</h4>
      <textarea class="message" name="" id="" cols="30" rows="10" placeholder="Enter your messages..." required></textarea>
    </label>
    <input class="sendContact" type="submit" value="Submit">
  </form>
</div>
<!-- <br> -->

<!-- The dots/circles -->