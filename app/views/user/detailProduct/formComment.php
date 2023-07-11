
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Nunito", sans-serif;
        transition: all 0.2s linear;
    }

    ::-webkit-scrollbar{
        width: 0;
    }

    .boxBL {
        padding: 10px;
    }

    .boxBL textarea {
        width: 100%;
        border: 2px solid gray;
        outline: none;
        padding: 10px;
    }

    .boxBL form .send {
        background-color: lightseagreen;
        cursor: pointer;
        padding: 10px 20px;
        border: 1px solid gray;
        border-radius: 5px;
        margin-top: 10px;
    }

    .comment {
        display: flex;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .comment .avarta img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
    }

    .noidung {
        padding: 0 10px;
        margin-top: 1.5rem;
    }

    .contentComment {
        background-color: #7e7878;
        padding: 10px;
        border-radius: 10px;
    }

    .contentComment .name {
        font-weight: bold;
        cursor: default;
    }

    .boxComment small{
        font-weight: bold;
    }
    </style>
</head>
<body>
    


<div class="boxBL">
    <h4>Viết bình luận...</h4>
    <form action="" method="POST">
        <textarea name="NoiDung" rows="7" placeholder="Nội dung..."></textarea>
        <input type="submit" class="send" name="send" value="Gửi">
    </form>
    <div class="noidung">
        <?php 
            if(!empty($listBL)){
                foreach($listBL as $item){
        ?>
            <div class="comment">
                <div class="avarta">
                    <img src="<?php echo _WEB_ROOT_."/public/assets/client/images/avatar/".$item["HinhAnh"]?>" alt="">
                </div>
                <div class="boxComment">
                    <div class="contentComment">
                        <p class="name"><?php echo $item["HoTen"]?></p>
                        <p class="para"><?php echo $item["NoiDung"]?></p>
                    </div>
                    <small><?php echo $item["ThoiGianGui"]?></small>
                </div>
            </div>
        <?php
                }
            }
        ?>
        
    </div>
</div>

</body>
</html>