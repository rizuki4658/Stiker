<?php 
    require_once 'Core/init.php';
 $errors="";
 $success=0;
 if ($user->Logging()) {
     Redirect::to('index');
 }else{
    if (Input::get('submit')) {
        if( Input::get('password') === Input::get('re_password') ){
            if ( Token::check( Input::get('token') ) ) {
              
                if( $user->cek_email( Input::get('email') ) ){

                    $errors= "Your email is already registered";
                
                }else{
                    
                    if( $user->register_user(array(
                            'id'        => '',
                            'name'      => Input::get('name'),
                            'email'     => Input::get('email'),
                            'password'  => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                            'address'   => '',
                            'phone'     => '',
                            'image'     => 'Assets/img/user.png',
                            'status'    => 'User'

                        )) ){
                        $success=1;
                    }else{

                        $errors="Your registration is fail!";

                    }

                }
            }
        }else{
            $errors='Confirmation Password not the same!';
        }
    }else{
        $errors='';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Nine Production Official | Register</title>
    <link href="Assets/img/Logo.png" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="Vendor/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Vendor/Font Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="Vendor/Font Awesome/css/themify-icons.css">
    <link rel="stylesheet" href="Vendor/Font Awesome/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="Vendor/Bootstrap/css custom/register.css">
</head>
<body>
    <div class="box">
        <div class="content mb-5 mt-5">
            <img src="Assets/img/Logo 2.png" class="image">
        </div>
        <div class="content">
            <form action="" method="post">
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-user py-2"></i></div>
                    </div>
                    <input type="text" name="name" id="name" autocomplete="off" placeholder="your name" class="form-control" required="">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input type="email" name="email" id="email" autocomplete="off" placeholder="email" class="form-control" required="">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-eye-slash"></i></div>
                    </div>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="password" class="form-control" required>
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-key"></i></div>
                    </div>
                    <input type="password" name="re_password" id="re_password" autocomplete="off" placeholder="confirm password" data-rule-password="true" data-rule-equalTo="#password" class="form-control" required="">
                </div>

                <?php if (!empty($errors)) { ?>
                    <p>
                        <b style="color: red;"><?php echo $errors; ?></b>
                    </p>
                <?php }elseif($success != 0){ ?>

                    <p><b style="color:rgb(0, 143, 238);"><?php echo "Your registration is success! please login now"; ?></b></p>

                <?php } ?>
                <div class="input-group mb-4">
                    <input type="submit" name="submit" id="submit" class="btn btn-block rounded-pill btn-success" value="sign-up">
                </div>
            </form>
            <p>
                already have account! sign-in <a href="login.php">here</a> or back<a href="index.php"> home</a>.
            </p>
        </div>
    </div>
    <script type="text/javascript" src="Vendor/Bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="Vendor/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Vendor/Bootstrap/js custom/register.js"></script>
</body>
</html>