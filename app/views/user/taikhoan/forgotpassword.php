

<div class="formForgot">
    <h2>Quên mật khẩu</h2>
    <form action="" method="POST" class="form">
        <label for="">
            <span>Email:</span>
            <div>
                <input type="email" name="Email" id="" placeholder="Email...">
                <p class="err"><?php echo (!empty($errors) && array_key_exists("Email",$errors))?$errors["Email"]:false;?></p>
            </div>
            <input class="sendpass" name="sendpass" type="submit" value="Send">
        </label>
    </form>
</div>