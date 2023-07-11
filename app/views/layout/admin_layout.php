<?php 
    session_start();
    if(isset($_SESSION["Login"]["admin"])){
        $this->render("admin/block/header");
        if(count($data) > 1){
            $this->render($content,$data);
        } else {
            $this->render($content);
        }
        $this->render("admin/block/footer");
    }else{
        $response = new Response();
        $response->redirect("Trang-Chu");
    }
?>