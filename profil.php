<?php
require_once 'Core/init.php';
$_SESSION['page']="Profil";
$error="";
$success=0;
$error_pass="";
$success_pass=0;
$error_image="";
$success_image=0;
if ($user->Logging()) {
    if(Session::get('user_status')){
        
        if (Input::get('update')){
            if (Token::check( Input::get('token') )) {
                if (Session::exists('id_user')) {
                    if( $user->cek_email( Input::get('email') ) ){
                        $error="This Email is already use";
                        if ($user->update_user(array(
                            'name'      => Input::get('name'),
                            'address'   => Input::get('address'),
                            'phone'     => Input::get('phone')
                        ), Input::get('id_personal') ) ) {
                            $success=1;
                            if ($user_data = $user->get_data( Input::get('email') ) ){
                                Session::set('user_email', $user_data['email']);
                                Session::set('user_name', $user_data['name']);
                                Session::set('user_image', $user_data['image']);
                                Session::set('user_address', $user_data['address']);
                                Session::set('user_phone', $user_data['phone']);
                                Session::set('user_status', $user_data['status']);
                                Session::set('user_password', $user_data['password']);
                                Session::set('id_user', $user_data['id']);
                            }
                        }else{
                            $error="Error update personal data";
                        }
                    }else{
                        if ($user->update_user(array(
                            'name'      => Input::get('name'),
                            'email'     => Input::get('email'),
                            'address'   => Input::get('address'),
                            'phone'     => Input::get('phone')
                        ), Input::get('id_personal') ) ) {
                            $success=1;
                            if ($user_data = $user->get_data( Input::get('email') ) ){
                                Session::set('user_email', $user_data['email']);
                                Session::set('user_name', $user_data['name']);
                                Session::set('user_image', $user_data['image']);
                                Session::set('user_address', $user_data['address']);
                                Session::set('user_phone', $user_data['phone']);
                                Session::set('user_status', $user_data['status']);
                                Session::set('user_password', $user_data['password']);
                                Session::set('id_user', $user_data['id']);
                            }

                        }else{
                            $error="Error update personal data";
                        }
                    }
                }else{
                    $error="You must be login fisrt!";
                }
            }
        }else{
            $error='';
            $success=0;
        }

        if(Input::get('update_pass')){
            if (Token::check2( Input::get('token_pass') )) {
                if(password_verify(Input::get('password0'), Session::get('user_password'))){
                    if (Input::get('password2')===Input::get('password1')) {
                        if (Input::get('password0')===Input::get('password1')) {
                            $error_pass="Your new password must different from old password!";
                        }else{
                            if($user->update_user(array(
                                    'password' => password_hash(Input::get('password2'), PASSWORD_DEFAULT)

                                ), Session::get('id_user') ) ){
                                $success_pass=1;
                                if ($user_data = $user->get_data_id( Session::get('id_user') ) ){
                                    Session::set('user_password', $user_data['password']);
                                }
                            }else{
                                 $error_pass="Change password is fail!";
                            }
                        }
                    }else{
                        $error_pass="Your confirmation password is wrong!";
                    }
                }else{
                    $error_pass="Your old password is wrong!";
                }
            }
        }else{
            $error_pass="";
            $success_pass=0;
        }

        if (Input::get('update_image')) {
            if (Token::check3( Input::get('token_image') )) {
                $nama=$_FILES['gambar']['name'];
                $lokasi=$_FILES['gambar']['tmp_name'];
                $gagal=$_FILES['gambar']['error'];
                $ukuran=$_FILES['gambar']['size'];
                $format=$_FILES['gambar']['type'];
                $nama_tujuan='';
                if($gagal==0){
                    if ($format =='image/jpeg'){
                        if ($ukuran < 1000000) {
                            $nama_tujuan = str_replace(".jpg", "", $nama);
                            $nama_tujuan = "Assets/upload/".Session::get('user_name')."_".Session::get('user_email').".jpg";
                            if($user->update_user(array(
                                'image' => $nama_tujuan), Session::get('id_user') ) ){
                                
                                $success_image=1;
                                $up=move_uploaded_file($lokasi, $nama_tujuan);
                                if ($user_data = $user->get_data_id( Session::get('id_user') ) ){
                                    Session::set('user_image', $user_data['image']);
                                }
                                Redirect::to('Support/upload_support');
                            }else{
                                $error_image="Change image is fail!";
                            }
                        }else{
                            $error_image="Image size not valid(size rule: more than less 1MB)3";
                        }
                    }elseif($format=='image/png') {
                        if ($ukuran < 1000000) {
                            $nama_tujuan = str_replace(".png", "", $nama);
                            $nama_tujuan = "Assets/upload/".Session::get('user_name')."_".Session::get('user_email').".jpg";
                            if($user->update_user(array(
                                'image' => $nama_tujuan), Session::get('id_user') ) ){
                                
                                $success_image=1;
                                $up=move_uploaded_file($lokasi, $nama_tujuan);
                                if ($user_data = $user->get_data_id( Session::get('id_user') ) ){
                                    Session::set('user_image', $user_data['image']);
                                }
                            }else{
                                $error_image="Change image is fail!";
                            }
                        }else{
                            $error_image="Image size not valid(size rule: more than less 1MB)3";
                        }
                    }else{
                        $error_image="Image format not valid(format rule: jpeg, jpg, png)";
                    }
                }else{
                    $error_image="Change image is fail!";
                }
            }
        }else{
            $error_image="";
            $success_image=0;
        }

        if (Input::get('update_table')) {
            if (Input::get('edit_price')) {
                if ($transaction->update(array(
                        'category'          =>Input::get('edit_category'),
                        'name'              =>Input::get('edit_name'),
                        'title'             =>Input::get('edit_title'),
                        'email'             =>Input::get('edit_email'),
                        'phone'             =>Input::get('edit_phone'),
                        'explaining_user'   =>Input::get('edit_explain'),
                        'price_deal'        =>Input::get('edit_price'),
                        'read_admin'        =>0,
                        'read_user'         =>1,
                        'date'              =>date('Y-m-d')
                        ), Input::get('id_table') ) ) {            
                }
            }else{
                if ($transaction->update(array(
                        'category'          =>Input::get('edit_category'),
                        'name'              =>Input::get('edit_name'),
                        'title'             =>Input::get('edit_title'),
                        'email'             =>Input::get('edit_email'),
                        'phone'             =>Input::get('edit_phone'),
                        'explaining_user'   =>Input::get('edit_explain'),
                        'read_admin'        =>0,
                        'read_user'         =>1,
                        'date'              =>date('Y-m-d')
                        ), Input::get('id_table') ) ) {            
                }
            }
        }

        if (Input::get('delete_table')) {
            if ($transaction->delete( Input::get('id_table2') ) ) {
            }
        }

        
    }
}else{
    Redirect::to('index');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nine Production Official | Profil</title>
	<link href="Assets/img/Logo.png" rel="shortcut icon">
	<link rel="stylesheet" type="text/css" href="Vendor/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Vendor/Font Awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="Vendor/Font Awesome/css/themify-icons.css">
    <link rel="stylesheet" href="Vendor/Font Awesome/css/flag-icon.min.css">
    <link rel="stylesheet" href="Vendor/Bootstrap/css custom/profil.css">
    <style type="text/css">
        
        .box-profil-img{
            background-image: url('<?php if(file_exists(Session::get('user_image'))) echo Session::get('user_image'); else echo "Assets/img/user.png"; ?>');
        }
    </style>
</head>
<body>
	<?php require_once 'Template/header.php'; ?>

	<section>
        <div class="container-fluids slide-shows">
            <div class="container text-center" style="">
                <h5>Hello!</h5>
                <h1><?php echo Session::get('user_name'); ?></h1>
            </div>
        </div>

        <div class="container-fluids">
            <div class="container mt-5">
                <div class="rounded-circle box-profil-img"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 col-xl-4" style="margin-right: auto; margin-left: auto;">
                <?php if(!empty($error_image)){ ?>    
                    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>Error!</strong> <?= $error_image; ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }elseif ($success_image!=0) { ?>
                    <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                        <strong>Success!</strong> Update Image success.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_image" id="id_image" value="<?php echo Session::get('id_user'); ?>">
                        <input type="hidden" name="token_image" value="<?php echo Token::generate3();?>">
                        <input type="file" name="gambar" class="form-control mt-2 mb-2" required="">
                        <input type="submit" name="update_image" class="btn btn-md btn-default" value="Edit Photo">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container-fluids mt-5 mb-5">
            <div class="container">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-md btn-info rounded-pill" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Personal Data <i class="fa fa-user"></i>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <?php if(!empty($error) & $success!=0){ ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Warning!</strong> <?= $error; ?> but another data has been update.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php }elseif(!empty($error)){ ?>    
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> <?= $error; ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php }elseif ($success!=0) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> Update personal data success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id_personal" id="id_personal" value="<?php echo Session::get('id_user'); ?>">
                                    <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 mb-2">
                                        <div class="row">
                                            <div class="col-md-2">Name</div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-3">
                                                <input type="text" name="name" value="<?php echo Session::get('user_name'); ?>" placeholder="Name" class="form-control" style="text-transform: uppercase;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 mb-2">
                                        <div class="row">
                                            <div class="col-md-2">Email</div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-3">
                                                <input type="email" name="email" value="<?php echo Session::get('user_email'); ?>" placeholder="Email" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 mb-2">
                                        <div class="row">
                                            <div class="col-md-2">Address</div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-3">
                                                <textarea name="address" placeholder="Address" class="form-control" required><?php echo Session::get('user_address'); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 mb-2">
                                        <div class="row">
                                            <div class="col-md-2">Phone</div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-3">
                                                <input type="text" name="phone" id="phone" value="<?php echo Session::get('user_phone'); ?>" placeholder="Phone" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 mb-2">
                                        <input value="update" type="submit" name="update" class="btn btn-sm btn-primary rounded-pill">
                                        <input value="cancel" type="reset" name="reset" class="btn btn-sm btn-danger rounded-pill">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                        <?php
                            $show_badge   =$transaction->get_badges_user(Session::get('id_user'));
                            $rows_badge   =mysqli_num_rows($show_badge);
                        ?>    
                            <button class="btn btn-md btn-success rounded-pill text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Transaction <i class="fa fa-bell"></i>
                                <?php if ($rows>0){ ?>
                                    <span class="badge badge-danger" style="border-radius: 100%;"><?= $rows_badge; ?></span>
                                <?php } ?>
                            </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body" style="overflow-x: scroll;">
                        
                                <table class="table table-bordered" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Explain</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Deal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $no     =1; 
                                        $show   =$transaction->get_transaction_user(Session::get('id_user'));
                                        $rows   =mysqli_num_rows($show);
                                        if ($rows >0) {
                                            while($data = mysqli_fetch_assoc($show)){ ?>
                                        <tr>
                                            <td>
                                                <?= $no++;?>
                                                <?php if($data['read_user']==0){ ?>
                                                <span class="badge badge-danger">New</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d-M-Y', strtotime($data['date']));?></td>
                                            <td style="text-transform: capitalize;">
                                                <?= $data['category']; ?>
                                            </td>
                                            <td>
                                                <?= $data['explaining_user']; ?>
                                            </td>
                                            <td><?= $data['status']; ?></td>
                                            <td><?= number_format($data['price']);?></td>
                                            <td><?= number_format($data['price_deal']);?></td>
                                            <td>
                                                <?php if($data['status']=='Negotiation'){ ?>
                                                <a href="#" data-toggle="modal" data-target="#edittable<?=$data['id'];?>" class="btn btn-sm btn-light text-primary px-0 py-0" title="Edit">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <?php }else{ ?> 
                                                <a href="#" data-toggle="modal" data-target="#hapustable<?=$data['id'];?>" class="btn btn-sm btn-light text-danger px-0 py-0" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-md btn-warning rounded-pill collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Settings <i class="fa fa-gears"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                            <?php if(!empty($error_pass)){ ?>    
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> <?= $error_pass; ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php }elseif ($success_pass!=0) { ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> Change password is success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id_pass" id="id_pass" value="<?php echo Session::get('id_user'); ?>">
                                    <input type="hidden" name="token_pass" value="<?php echo Token::generate2();?>">
                                    <label for="password0">Old password</label>
                                    <input type="password" name="password0" id="password0" value="" class="form-control mb-2 w-25" required="">
                                    <label for="password1">New password</label>
                                    <input type="password" name="password1" id="password1" value="" class="form-control mb-2 w-25" required="">
                                    <label for="password2">Confirm password</label>
                                    <input type="password" name="password2" id="password2" value="" class="form-control mb-2 w-25" required="">
                                    <input value="Change Password" type="submit" name="update_pass" class="btn btn-sm btn-success rounded-pill">
                                    <input value="Cancel" type="reset" name="cancel_pass" class="btn btn-sm btn-danger rounded-pill">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </section>
    
    <br>
    <br>
    <br>
    
    <?php require_once 'Template/footer.php'; ?>
    
<?php
    $show2   =$transaction->get_transaction_user(Session::get('id_user'));
    $rows2   =mysqli_num_rows($show2);
    if ($rows2 >0) {
        while($data2 = mysqli_fetch_assoc($show2)){ ?>    
    
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="edittable<?= $data2['id'];?>" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>EDIT REQUEST</h5>
                    <h1><?= $data2['category']; ?></h1>
                    <h1><?= $data2['title']; ?></h1>
                    <form action="" method="post" class="text-left">
                        <input type="hidden" name="id_table" id="id_table" value="<?= $data2['id'];?>">
                        <label>Name</label>
                        <input type="text" name="edit_name" value="<?= $data2['name'];?>" class="form-control mb-2" required>
                        <label>Title</label>
                        <input type="text" name="edit_title" value="<?= $data2['title'];?>" class="form-control mb-2" required>
                        <label>Email</label>
                        <input type="email" name="edit_email" value="<?= $data2['email'];?>" class="form-control mb-2" required>
                        <label>Phone</label>
                        <input type="text" name="edit_phone" value="<?= $data2['phone'];?>" class="form-control mb-2" required>
                        <label>Product Type</label>
                        <select name="edit_category" class="form-control mb-2" required>
                        <?php if($data2['category']=='Neon Box'){ ?>
                                <option selected="">Neon Box</option>
                                <option>Billboard</option>
                                <option>Car Branding</option>
                        <?php }elseif($data2['category']=='Billboard'){ ?>
                                <option>Neon Box</option>
                                <option selected="">Billboard</option>
                                <option>Car Branding</option>
                        <?php }elseif($data2['category']=='Car Branding'){ ?>
                                <option>Neon Box</option>
                                <option>Billboard</option>
                                <option selected="">Car Branding</option>
                        <?php } ?>
                        </select>
                        <label>Design Explain</label>
                        <textarea name="edit_explain" class="form-control mb-2" placeholder="Explain Your Design" required><?= $data2['explaining_user']; ?></textarea>
                    <?php if ($data2['price']<=0) { ?>
                    
                    <?php }else{ ?>
                        <label>Negotiation Price</label>
                        <input type="text" name="edit_price" class="form-control mb-2" placeholder="Price" required value="<?= $data2['price_deal'];?>">
                    <?php } ?>

                        <input type="submit" name="update_table" class="btn btn-sm btn-info" value="Submit">
                        <input type="reset" class="btn btn-sm btn-danger" value="Cancel">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php   }   ?>
<?php } ?>


<?php
    $show3   =$transaction->get_transaction_user(Session::get('id_user'));
    $rows3   =mysqli_num_rows($show3);
    if ($rows3 >0) {
        while($data3 = mysqli_fetch_assoc($show3)){ ?>    
    
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="hapustable<?= $data3['id'];?>" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h5>DELETE REQUEST</h5>
                    <h1><?= $data3['category']; ?></h1>
                    <h1><?= $data3['title']; ?></h1>
                    <form action="" method="post" class="text-center">
                        <input type="hidden" name="id_table2" id="id_table2" value="<?= $data3['id'];?>">
                    <p>
                        Are you sure! Delete this?
                    </p>
                        <input type="submit" name="delete_table" class="btn btn-sm btn-danger" value="Hapus">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php   }   ?>
<?php } ?>

<?php if($user->Logging()){ ?>
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modallogout" style="background-color: rgba(255, 255, 255, 0.95);">
        <div class="modal-dialog modal-md">
            <div class="modal-content text-center" style="border-radius: 0px; border: 0px; background-color: transparent;">
                <div class="modal-header" style="border-bottom: 0px;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true"><i class="ti-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Reminder logout!</h5>
                    <h1>Are you sure want to logout?</h1>
                    <a href="logout.php?submit_logout=yes" class="btn btn-md rounded-pill btn-danger">Yes</a>
                    <a href="#" data-dismiss="modal" aria-label="Close" class="btn btn-md btn-primary rounded-pill">No</a>
                </div>
            </div>
        </div>
    </div>
 <?php } ?>
    <script type="text/javascript" src="Vendor/Bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="Vendor/Bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#body').fadeIn(2000);
        $(window).scroll(function() {
            var scroll  = $(window).scrollTop();
            var width   = $(window).width();
            
            if (scroll > 100) {
                $('.bg-custom').css({
                    "backgroundColor": '#fff',
                    'border-bottom':'1px solid rgb(159, 159, 159)',
                    'transition':'all 0.6s ease'
                });
                $('.navbar-light .nav-item .nav-link').css({
                    'color':'rgb(220, 7 ,53)',
                    'transition':'all 0.6s ease'
                });
                $('.navbar-light .nav-item .nav-link').mouseover(function(){
                    $(this).css({
                        'color':'rgb(0, 142 ,238)',
                        'transition':'all 0.6s ease'
                    });
                });
                $('.navbar-light .nav-item .nav-link').mouseleave(function(){
                    $(this).css({
                        'color':'rgb(220, 7, 53)',
                        'transition':'all 0.6s ease'
                    });
                });
            }else{
                $('.bg-custom').css({
                    "backgroundColor": 'transparent',
                    'border-bottom':'1px solid transparent'
                });
                $('.navbar-light .nav-item .nav-link').css({
                    'color':'rgb(255, 255, 255)'
                });
                $('.navbar-light .nav-item .nav-link').mouseover(function(){
                    $(this).css({
                        'color':'rgb(220, 7, 53)',
                        'transition':'all 0.6s ease'
                    });
                });
                $('.navbar-light .nav-item .nav-link').mouseleave(function(){
                    $(this).css({
                        'color':'rgb(255, 255, 255)',
                        'transition':'all 0.6s ease'
                    });
                });
            }
            return false;
        });
    });
</script>