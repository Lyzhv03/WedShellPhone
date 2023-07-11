<h2 style="text-align: center;">Error Page</h2>
<h2 style="text-align: center;"><?php 
    if(isset($err)){
        echo $err;
    }else{
        echo "Lỗi Page";
    }
?></h2>