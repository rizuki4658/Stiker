<?php
require_once 'Core/init.php';


require_once 'Template Dashboard/header.php';
        
        if (Input::get('submit_profil')){
            if (Token::check( Input::get('token1') )) {
                if (Session::exists('id_user')) {
                    if( $user->cek_email( Input::get('Email') ) ){
                        if ($user->update_user(array(
                            'name'      => Input::get('Name'),
                            'address'   => Input::get('Address'),
                            'phone'     => Input::get('Phone')
                        ), Input::get('id_personal') ) ) {
                            Session::set('success_profil','Name, Address and Phone number updated but, your email not updated because this email is already used.');
                        }else{
                            Session::set('error_profil','Error update personal data');
                        }
                    }else{
                        if ($user->update_user(array(
                            'name'      => Input::get('Name'),
                            'email'     => Input::get('Email'),
                            'address'   => Input::get('Address'),
                            'phone'     => Input::get('Phone')
                        ), Input::get('id_personal') ) ) {
                            Session::set('success_profil','Your profile was updated!');

                        }else{
                            Session::set('error_profil','Error update personal data');
                        }
                    }
                }else{
                    Session::set('error_profil','You must be login fisrt!');
                }
            }
        }

        if (Input::get('submit_password')){
            if (Token::check2( Input::get('token2') )) {
                if (Session::exists('id_user')) {
                    $passwod_users=$user->get_data_id(Session::get('id_user'));
                    if(password_verify(Input::get('Password_O'), $passwod_users['password'])){
                        
                        if (Input::get('Password_C')===Input::get('Password_N')) {
                            
                            if (Input::get('Password_O')===Input::get('Password_C')) {
                                Session::set('error_profil','Your new password must different from old password!');
                            }else{
                                if($user->update_user(array(
                                        'password' => password_hash(Input::get('Password_C'), PASSWORD_DEFAULT)

                                    ), Session::get('id_user') ) ){
                                    Session::set('success_profil','Your password has been change');
                                }else{
                                     Session::set('error_profil', 'Change password is fail!');
                                }
                            }

                        }else{
                            Session::set('error_profil', 'Your confirmation password is wrong!');
                        }

                    }else{
                       Session::set('error_profil', 'Your old password is wrong!');
                    }

                }else{
                    Session::set('error_profil','You must be login fisrt!');
                }
            }
        }

        if (Input::get('submit_picture')) {
            if (Token::check3( Input::get('token3') )) {
                $nama=$_FILES['Picture']['name'];
                $lokasi=$_FILES['Picture']['tmp_name'];
                $gagal=$_FILES['Picture']['error'];
                $ukuran=$_FILES['Picture']['size'];
                $format=$_FILES['Picture']['type'];
                $nama_tujuan='';
                if($gagal==0){
                    if ($format =='image/jpeg'){
                        if ($ukuran < 1000000) {
                            $nama_tujuan = str_replace(".jpg", "", $nama);
                            $nama_tujuan = "Assets/upload/".Session::get('user_name')."_".Session::get('user_email').".jpg";
                            if($user->update_user(array(
                                'image' => $nama_tujuan), Session::get('id_user') ) ){
                                
                                Session::set('success_profil', 'Your profile picture updated!');
                                $up=move_uploaded_file($lokasi, $nama_tujuan);
                                Redirect::to('Support/upload_support_dashboard.php');
                            }else{
                                Session::set('error_profil', 'Change image is fail!');
                            }
                        }else{
                            Session::set('error_profil', 'Image size not valid(size rule: more than less 1MB)');
                        }
                    }elseif($format=='image/png') {
                        if ($ukuran < 1000000) {
                            $nama_tujuan = str_replace(".png", "", $nama);
                            $nama_tujuan = "Assets/upload/".Session::get('user_name')."_".Session::get('user_email').".jpg";
                            if($user->update_user(array(
                                'image' => $nama_tujuan), Session::get('id_user') ) ){
                                
                                Session::set('success_profil', 'Your profile picture updated!');
                                $up=move_uploaded_file($lokasi, $nama_tujuan);
                                Redirect::to('Support/upload_support_dashboard.php');
                            }else{
                                Session::set('error_profil', 'Change image is fail!');
                            }
                        }else{
                            Session::set('error_profil', 'Image size not valid(size rule: more than less 1MB)');
                        }
                    }else{
                        Session::set('error_profil', 'Image format not valid(format rule: jpeg, jpg, png)');
                    }
                }else{
                    Session::set('error_profil', 'Change image is fail!');
                }
            }
        }
?>
        
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="animated fadeIn">
                    <div class="row">

                        <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title mb-3">Profile</strong>
                                </div>
                                <div class="card-body">
                            <?php if(Session::exists('error_profil') || Session::exists('success_profil')){ ?>
                                <div class="sufee-alert alert with-close <?php if(Session::exists('error_profil')) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(Session::exists('error_profil')) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(Session::exists('error_profil')) echo "Fail"; else echo "Success"; ?></span>
                                        <?php 
                                            if(Session::exists('error_profil')){ 
                                                echo Session::get('error_profil');
                                            }else{
                                                echo Session::get('success_profil');
                                            }
                                        ?>.
                                        <?php
                                            if(Session::exists('error_profil')){
                                                Session::delete('error_profil');
                                            }elseif(Session::exists('success_profil')){
                                                Session::delete('success_profil');
                                            }elseif(Session::exists('error_profil') & Session::exists('success_profil')){
                                                Session::delete('error_profil');
                                                Session::delete('success_profil');
                                            }
                                        ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <?php $users=$user->get_data_id(Session::get('id_user')); ?>
                                    <div class="mx-auto d-block">
                                        <img class="rounded-circle mx-auto d-block" src="<?= $users['image'];?>" alt="Card image cap" width="200" height="200">
                                        <h5 class="text-sm-center mt-2 mb-1"><?php If($users['name']!='') echo $users['name']; else echo 'unknown';?></h5>
                                        <div class="location text-sm-center"><i class="fa fa-map-marker"></i> <?php If($users['address']!='') echo $users['address']; else echo 'unknown';?> </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <a href="#"> <i class="fa fa-envelope-o"></i> <?php If($users['email']!='') echo $users['email']; else echo 'unknown';?> </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#"> <i class="fa fa-phone"></i> <?php If($users['phone']!='') echo $users['phone']; else echo 'unknown';?> </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#" id="setting-profil" class="mr-4"> <i class="fa fa-gear" title="Setting Profil"></i> </a>
                                            <a href="#" id="setting-password" class="mr-4" title="Setting Password"> <i class="fa fa-key"></i> </a>
                                            <a href="#" id="setting-picture" class="mr-4" title="Setting Picture"> <i class="fa fa-picture-o"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="setting_form" style="margin-left: auto; margin-right: auto;">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title mb-3">Setting Profile</strong>
                                    <span class="pull-right">
                                        <button type="button" class="btn btn-sm btn-light" id="close_setting">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                <?php $profil_form=$user->get_data_id(Session::get('id_user')); ?>    
                                        <input type="hidden" name="id_personal" id="id_personal" value="<?= $profil_form['id'];?>">
                                        <input type="hidden" name="token1" id="token1" value="<?= Token::generate();?>">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input class="form-control" type="text" name="Name" id="Name" value="<?= $profil_form['name'];?>" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input class="form-control" type="text" name="Email" id="Email" value="<?= $profil_form['email'];?>" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea class="form-control" type="text" name="Address" id="Address" required=""><?= $profil_form['address'];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input class="form-control" type="text" name="Phone" id="Phone" value="<?= $profil_form['phone'];?>" required="">
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-info" name="submit_profil" id="submit_profil" value="submit" type="submit">OK</button>
                                            <button class="btn btn-sm btn-danger" name="cancel_profil" id="cancel_profil" value="reset" type="reset">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="password_form" style="margin-left: auto; margin-right: auto;">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title mb-3">Change Password</strong>
                                    <span class="pull-right">
                                        <button type="button" class="btn btn-sm btn-light" id="close_password">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                    <?php $password_form=$user->get_data_id(Session::get('id_user')); ?>
                                        <input type="hidden" name="id_personal" id="id_personal" value="<?= $password_form['id'];?>">
                                        <input type="hidden" name="token2" id="token2" value="<?= Token::generate2();?>">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Old Password</label>
                                            <input class="form-control" type="password" name="Password_O" id="Password_O" value="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">New Password</label>
                                            <input class="form-control" type="password" name="Password_N" id="Password_N" value="" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Confrim Password</label>
                                            <input class="form-control" type="password" name="Password_C" id="Password_C" value="" required="">
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-info" name="submit_password" id="submit_password" value="submit" type="submit">OK</button>
                                            <button class="btn btn-sm btn-danger" name="cancel_password" id="cancel_password" value="reset" type="reset">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="picture_form" style="margin-left: auto; margin-right: auto;">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title mb-3">Change Picture</strong>
                                    <span class="pull-right">
                                        <button type="button" class="btn btn-sm btn-light" id="close_picture">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="card-body">
                                    <form action="" enctype="multipart/form-data" method="post">
                                    <?php $picture_form=$user->get_data_id(Session::get('id_user')); ?>
                                        <input type="hidden" name="id_personal" id="id_personal" value="<?= $picture_form['id'];?>">
                                        <input type="hidden" name="token3" id="token3" value="<?= Token::generate3();?>">
                                        <div class="form-group">
                                            <label class="control-label mb-1"> Picture </label>
                                            <input class="form-control" type="file" name="Picture" id="Picture" value="" required="">
                                        </div>
                                        <div>
                                            <button class="btn btn-sm btn-info" name="submit_picture" id="submit_picture" value="submit" type="submit">OK</button>
                                            <button class="btn btn-sm btn-danger" name="cancel_picture" id="cancel_picture" value="reset" type="reset">Cancel</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    </div>
                </div><!-- .animated -->
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php';?>
