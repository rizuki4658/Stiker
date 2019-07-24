<?php
    require_once 'Core/init.php';

    $porto      =$dashboard_porto->get_rows_porto();
    $baris_porto=mysqli_num_rows($porto);

require_once 'Template Dashboard/header.php';
    $name_id       ='';
    $company_id    ='';
if(Input::get('id_edit')){
    $porto_id      =$dashboard_porto->get_rows_porto_id(Input::get('id_edit'));
    $baris_porto_id=mysqli_num_rows($porto_id);
    while($data=mysqli_fetch_assoc($porto_id)){
        $name_id=$data['name'];
        $company_id=$data['company'];
    }
}elseif(Input::get('id_delete')){
    if ($dashboard_porto->delete(Input::get('id_delete'))) {
        Session::set('success_porto', 'Data was Deleted');
        Redirect::to('Dashboard Portofolio');
    }else{
        Session::set('error_porto', 'Delete data slide');
        Redirect::to('Dashboard Portofolio');
    }
}else{
    if ($baris_porto>=12) {
        Redirect::to('Dashboard Portofolio');
    }
}

if (Input::get('Add')) {
    if (Input::get('id_edit')) {
        if (Token::check(Input::get('token'))) {
            if (!empty($_FILES['Path']['tmp_name'])) {
                $unik=time();
                $nama=$_FILES['Path']['name'];
                $lokasi=$_FILES['Path']['tmp_name'];
                $gagal=$_FILES['Path']['error'];
                $ukuran=$_FILES['Path']['size'];
                $format=$_FILES['Path']['type'];
                $nama_tujuan='Assets/upload/portofolio/'.$nama;
                if ($gagal==0) {
                    if ($format =='image/jpeg'){
                        if ($ukuran <= 1000000) {
                            if (file_exists($nama_tujuan)) {
                                $nama_tujuan=str_replace(".jpg", "", $nama_tujuan);
                                $nama_tujuan=$nama_tujuan."_".$unik.".jpg";
                                if ($dashboard_porto->update(array(
                                        'name'=>Input::get('Name'),
                                        'company'=>Input::get('Customer'),
                                        'path'=>$nama_tujuan,
                                    ), Input::get('id_edit') )) {
                                    if(move_uploaded_file($lokasi, $nama_tujuan)){
                                        Session::set('success_porto','Upload success!');
                                        Redirect::to('Dashboard Portofolio');
                                    }else{
                                        Session::set('error_porto', 'Error Upload (Error code:004) Can not update into disk!');
                                        Redirect::to('Dashboard Portofolio');
                                    }   
                                }else{
                                   Session::set('error_porto', 'Error Upload (Error code:003) Can not update into database!');
                                   Redirect::to('Dashboard Portofolio');
                                }
                            }else{
                                if ($dashboard_porto->update(array(
                                        'name'=>Input::get('Name'),
                                        'company'=>Input::get('Customer'),
                                        'path'=>$nama_tujuan,
                                    ), Input::get('id_edit') )) {
                                    if(move_uploaded_file($lokasi, $nama_tujuan)){
                                        Session::set('success_porto','Upload success!');
                                        Redirect::to('Dashboard Portofolio');
                                    }else{
                                        Session::set('error_porto', 'Error Upload (Error code:004) Can not update into disk!');
                                        Redirect::to('Dashboard Portofolio');
                                    }   
                                }else{
                                   Session::set('error_porto', 'Error Upload (Error code:003) Can not update into database!');
                                   Redirect::to('Dashboard Portofolio');
                                }
                            }
                        }else{
                           Session::set('error_porto', 'Error Upload (Error code:002) File size is too large');
                           Redirect::to('Dashboard Portofolio');
                        }
                    }else{
                        Session::set('error_porto', 'Error Upload (Error code:001) Format file is not valid');
                        Redirect::to('Dashboard Portofolio');
                    }
                }else{
                    Session::set('error_porto', 'Error Upload (Error code:000)');
                    Redirect::to('Dashboard Portofolio');
                }
            }else{
                if ($dashboard_porto->update(array(
                        'name'=>Input::get('Name'),
                        'company'=>Input::get('Customer')
                    ), Input::get('id_edit') )) {
                        Session::set('success_porto', 'Upload success!');
                        Redirect::to('Dashboard Portofolio');
                }else{
                    Session::set('error_porto', 'Error Edit (Error code:100) Can not update into database!');
                    Redirect::to('Dashboard Portofolio');
                }               
            }   
        }
    }else{
        if (Token::check(Input::get('token'))) {
            $unik=time();
            $nama=$_FILES['Path']['name'];
            $lokasi=$_FILES['Path']['tmp_name'];
            $gagal=$_FILES['Path']['error'];
            $ukuran=$_FILES['Path']['size'];
            $format=$_FILES['Path']['type'];
            $nama_tujuan='Assets/upload/portofolio/'.$nama;
            if ($gagal==0) {
                if ($format =='image/jpeg'){
                    if ($ukuran <= 1000000) {
                        if (file_exists($nama_tujuan)) {
                            $nama_tujuan=str_replace(".jpg", "", $nama_tujuan);
                            $nama_tujuan=$nama_tujuan."_".$unik.".jpg";
                            if ($dashboard_porto->insert(array(
                                    'id'=>'',
                                    'name'=>Input::get('Name'),
                                    'company'=>Input::get('Customer'),
                                    'path'=>$nama_tujuan,
                                ))) {
                                if(move_uploaded_file($lokasi, $nama_tujuan)){
                                    Session::set('success_porto', 'Upload success!');
                                    Redirect::to('Dashboard Portofolio');
                                }else{
                                   Session::set('error_porto', 'Error Upload (Error code:004) Can not insert into disk!');
                                   Redirect::to('Dashboard Portofolio');
                                }   
                            }else{
                                Session::set('error_porto', 'Error Upload (Error code:003) Can not insert into database!');
                                Redirect::to('Dashboard Portofolio');
                            }
                        }else{
                            if ($dashboard_porto->insert(array(
                                    'id'=>'',
                                    'name'=>Input::get('Name'),
                                    'company'=>Input::get('Customer'),
                                    'path'=>$nama_tujuan,
                                ))) {
                                if(move_uploaded_file($lokasi, $nama_tujuan)){
                                    Session::set('success_porto', 'Upload success!');
                                    Redirect::to('Dashboard Portofolio');
                                }else{
                                    Session::set('error_porto', 'Error Upload (Error code:004) Can not insert into disk!');
                                    Redirect::to('Dashboard Portofolio');
                                }   
                            }else{
                                Session::set('error_porto', 'Error Upload (Error code:003) Can not insert into database!');
                                Redirect::to('Dashboard Portofolio');
                            }
                        }
                    }else{
                        Session::set('error_porto', 'Error Upload (Error code:002) File size is too large');
                        Redirect::to('Dashboard Portofolio');
                    }
                }else{
                    Session::set('error_porto', 'Error Upload (Error code:001) Format file is not valid');
                    Redirect::to('Dashboard Portofolio');
                }
            }else{
                Session::set('error_porto', 'Error Upload (Error code:000)');
                Redirect::to('Dashboard Portofolio');
            }    
        }
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
                                <h1>Portofolio Form</h1>
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
                                <form action="" enctype="multipart/form-data" method="post">
                                    <?php if(Input::get('id_edit')){ ?>

                                    <input type="hidden" name="id_val" id="id_val" value="<?= Input::get('id_edit'); ?>">
                                    <?php } ?>
                                    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
                                    <div class="form-group">
                                        <label for="Name" class="control-label mb-1">Product Name</label>
                                        <input id="Name" name="Name" type="text" class="form-control" required="" value="<?php if(Input::get('id_edit')){
                                                echo $name_id;
                                            }else{ echo "";}?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Customer" class="control-label mb-1">Customer Name</label>
                                        <input id="Customer" name="Customer" type="text" class="form-control" required="" value="<?php if(Input::get('id_edit')){
                                                echo $company_id;
                                            }else{ echo "";}?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Path" class="control-label mb-1">Path</label>
                                        <input id="Path" name="Path" type="file" class="form-control" <?php if(Input::get('id_edit')){ echo ""; }else{?>required=""<?php } ?>>
                                    </div>
                                    <div>
                                        <input name="Add" type="submit" class="btn btn-md btn-primary" value="<?php if(Input::get('id_edit')) echo 'Edit'; else echo 'Add';?>">
                                        <input name="Cancel" type="reset" class="btn btn-md btn-danger" value="Cancel">
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php'; ?>
