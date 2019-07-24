<?php 
    require_once 'Core/init.php';
 $errors="";
 
 if ($user->Logging()) {
     Redirect::to('index');
 }else{
    if (Input::get('submit')) {
        
        if ( Token::check( Input::get('token') ) ) {
          
            if( $user->cek_email( Input::get('email') ) ){
                
                if ( $user->Login_User( Input::get('email'), Input::get('password') ) ){

                    if ($user_data = $user->get_data( Input::get('email') ) ){
                        Session::set('user_email', $user_data['email']);
                        Session::set('user_name', $user_data['name']);
                        Session::set('user_image', $user_data['image']);
                        Session::set('user_address', $user_data['address']);
                        Session::set('user_phone', $user_data['phone']);
                        Session::set('user_status', $user_data['status']);
                        Session::set('user_password', $user_data['password']);
                        Session::set('id_user', $user_data['id']);
                        if ($user_data['status']=='Admin') {
                            Redirect::to('Dashboard');
                        }else{
                            Redirect::to('index');
                        }
                    }else{
                        $errors= "Your email is not registered";
                    }

                }else{
                    $errors= "Sorry there is problem! ";
                }
                
            }else{
                $errors= "Your email is not registered";
            }
        }
    }else{
        $errors='';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nine Production Official | Login</title>
	<link href="Assets/img/Logo.png" rel="shortcut icon">
	<link rel="stylesheet" type="text/css" href="Vendor/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Vendor/Font Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="Vendor/Font Awesome/css/themify-icons.css">
    <link rel="stylesheet" href="Vendor/Font Awesome/css/flag-icon.min.css">
    <link rel="stylesheet" href="Vendor/Bootstrap/css custom/login.css">
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
                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                    </div>
                    <input type="email" name="email" id="email" autocomplete="on" placeholder="email" class="form-control" required="">
                </div>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-eye-slash"></i></div>
                    </div>
                    <input type="password" name="password" id="password" autocomplete="on" placeholder="password" class="form-control" required>
                </div>

            <?php if (!empty($errors)) { ?>
                <p>
                    <b style="color: red;"><?php echo $errors; ?></b>
                </p>
            <?php } ?>

                <div class="input-group mb-4">
                    <input type="submit" name="submit" id="submit" class="btn btn-block rounded-pill btn-success" value="sign-in">
                </div>
            </form>
            <p>
                don't have account! sign-up <a href="register.php">here </a> or back<a href="index.php"> home</a>.
            </p>
        </div>
    </div>
	<script type="text/javascript" src="Vendor/Bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="Vendor/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Vendor/Bootstrap/js custom/login.js"></script>
</body>
</html>