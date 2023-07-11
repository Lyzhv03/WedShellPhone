
    <?php 
        if(isset($contentDef)){
            $this->render($contentDef,$data);
        }else{
            $this->render("user/block/header",$data);
            if(count($data) > 1){
                $this->render($content,$data);
            }else {
                $this->render($content);

            }
        }
        
        $this->render("user/block/footer");
    ?>

