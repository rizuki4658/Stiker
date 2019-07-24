<?php
    require_once 'Core/init.php';

require_once 'Template Dashboard/header.php';
$errors='';
if (Input::get('id_edit') || Input::get('id_edit')!='' || Input::get('id_edit')!=0) {
    $data_users =$user->get_data_id(Input::get('id_edit'));
    if (Input::get('submit')) {
        if (Token::check(Input::get('token'))) {
            if ($user->update_user(array('status'=>Input::get('Status')), Input::get('id_edit'))) {
                Session::set('success_user', 'Data User '.Input::get('Email').' was updated!');
                Redirect::to('Dashboard Customers');
            }else{
                Session::set('error_user', 'Update data User '.Input::get('Email').' failed!');
                Redirect::to('Dashboard Customers');
            }
        }
    }
}elseif(Input::get('id_delete') || Input::get('id_delete')!='' || Input::get('id_delete')!=0){
    $data_users =$user->get_data_id(Input::get('id_delete'));
    if ($user->delete(Input::get('id_delete'))) {
        Session::set('success_user', 'Data User '.Input::get('Email').' deleted!');
        Redirect::to('Dashboard Customers');
    }else{
        Session::set('error_user', 'Deleted data User '.Input::get('Email').' failed!');
        Redirect::to('Dashboard Customers');
    }
}else{
    if (Input::get('submit')) {
        if ( Token::check( Input::get('token') ) ) {
            if( $user->cek_email( Input::get('Email') ) ){
                $errors= "Email ".Input::get('Email')."is already registered";
            }else{
               
                if( Input::get('Password') === Input::get('Password_C') ){

                    if( $user->register_user(array(
                            'id'        => '',
                            'name'      => Input::get('Name'),
                            'email'     => Input::get('Email'),
                            'password'  => password_hash(Input::get('Password'), PASSWORD_DEFAULT),
                            'address'   => '',
                            'phone'     => '',
                            'image'     => 'Assets/img/user.png',
                            'status'    => Input::get('Status')

                        )) ){
                        Session::set('success_user', 'Data User '.Input::get('Email').' added!');
                        Redirect::to('Dashboard Customers');
                    }else{

                        Session::set('error_user', 'Add Data User '.Input::get('Email').' failed!');
                        Redirect::to('Dashboard Customers');

                    }
                    
                }else{
                    
                    $errors='Confirmation Password not the same!';

                }
            } 
        }
    }else{
        $errors='';
    }
}
    
    
?>
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Users & Customers Form</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li class="active"></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                <?php if(Input::get('id_edit')){ ?>
                                    <input type="hidden" name="id" id="id_edit" value="<?= $data_users['id']; ?>">
                                    <input type="hidden" name="token" id="token" value="<?= Token::generate(); ?>">
                                    <div class="form-group">
                                        <label for="Name" class="control-label mb-1">Name</label>
                                        <input id="Name" name="Name" class="form-control" required="" value="<?php if(Input::get('id_edit')){ echo $data_users['name']; }else{ echo'';}?>" <?php if(Input::get('id_edit')){ echo "disabled"; }else{ echo'';}?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="control-label mb-1">Email</label>
                                        <input id="Email" name="Email" type="email" class="form-control" required="" value="<?php if(Input::get('id_edit')){ echo $data_users['email']; }else{ echo'';}?>" <?php if(Input::get('id_edit')){ echo "disabled"; }else{ echo'';}?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="Address" class="control-label mb-1">Address</label>
                                        <textarea id="Address" name="Address" class="form-control" required="" <?php if(Input::get('id_edit')){ echo "disabled"; }else{ echo'';}?> ><?php if(Input::get('id_edit')){ echo $data_users['address']; }else{ echo'';}?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="Phone" class="control-label mb-1">Phone</label>
                                        <input id="Phone" name="Phone" type="text" class="form-control" required="" value="<?php if(Input::get('id_edit')){ echo $data_users['email']; }else{ echo'';}?>" <?php if(Input::get('id_edit')){ echo "disabled"; }else{ echo'';}?> >
                                    </div>
                                    <div class="form-group">
                                        <label for="Status" class="control-label mb-1">Status</label>
                                        <select id="Status" name="Status" class="form-control" required="">
                                            <option <?php if(Input::get('id_edit')){ if ($data_users['status']=='User') {
                                                echo "selected='true'";
                                            } }?> >User</option>
                                            <option <?php if(Input::get('id_edit')){ if ($data_users['status']=='Admin') {
                                                echo "selected='true'";
                                            } }?> >Admin</option>
                                        </select>
                                    </div>

                                <?php }else{ ?>
                                    <?php if(!empty($errors)){ ?>
                                        <p style="color: red;"><?= $errors; ?></p>
                                        <?php $errors=''; ?>
                                    <?php } ?>
                                    <input type="hidden" name="token" id="token" value="<?= Token::generate(); ?>">
                                    <div class="form-group">
                                        <label for="Name" class="control-label mb-1">Name</label>
                                        <input id="Name" name="Name" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email" class="control-label mb-1">Email</label>
                                        <input id="Email" name="Email" type="email" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Password" class="control-label mb-1">Password</label>
                                        <input id="Password" name="Password" type="password" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Password_C" class="control-label mb-1">Confrim Password</label>
                                        <input id="Password_C" name="Password_C" type="password" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="Status" class="control-label mb-1">Status</label>
                                        <select id="Status" name="Status" class="form-control" required="">
                                            <option>User</option>
                                            <option>Admin</option>
                                        </select>
                                    </div>
                                <?php } ?>

                                    <div>
                                        <button name="submit" value="submit" type="submit" class="btn btn-md btn-primary">OK</button>
                                        <button name="reset" value="reset" type="reset" class="btn btn-md btn-danger">Cancel</button>
                                    </div>
                                    <input type="hidden" name="id" id="id">
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php'; ?>
