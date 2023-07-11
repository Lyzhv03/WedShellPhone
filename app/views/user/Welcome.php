
<?php 
    if(isset($_SESSION["Login"]["user"])){
?>
    <div class="welcome">
    <?php 
        echo "<h1 class='heading'>Chào mừng bạn <span>".$user['HoTen']."</span> đến với X-Shop</h1 class='heading'>";
    ?>
    <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/banner/welcome.jpg"?>" alt="">
    </div>
<?php
    }else{
        $response = new Response();
        $response->redirect("Trang-Chu");
    }
?>