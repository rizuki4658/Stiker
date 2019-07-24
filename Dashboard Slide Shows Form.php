<?php
    require_once 'Core/init.php';

    $slide      =$dashboard_slide->get_rows_slide();
    $baris_slide=mysqli_num_rows($slide);
    
    $error_slide='';
    $success_slide='';

    $slide_id      ='';
    $baris_slide_id='';

if(Input::get('id_edit')){
    $slide_id      =$dashboard_slide->get_rows_slide_id(Input::get('id_edit'));
    $baris_slide_id=mysqli_num_rows($slide_id);
}else{
    if ($baris_slide>=6) {
        Redirect::to('Dashboard Slide Shows');
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
                $nama_tujuan='Assets/upload/slide shows/'.$nama;
                if ($gagal==0) {
                    if ($format =='image/jpeg'){
                        if ($ukuran <= 1000000) {
                            if (file_exists($nama_tujuan)) {
                                $nama_tujuan=str_replace(".jpg", "", $nama_tujuan);
                                $nama_tujuan=$nama_tujuan."_".$unik.".jpg";
                                if ($dashboard_slide->update(array(
                                        'name'=>Input::get('Name'),
                                        'path'=>$nama_tujuan,
                                    ), Input::get('id_edit') )) {
                                    if(move_uploaded_file($lokasi, $nama_tujuan)){
                                        $success_slide='Upload success!';
                                    }else{
                                        $error_slide='Error Upload (Error code:004) Can not update into disk!';
                                    }   
                                }else{
                                    $error_slide='Error Upload (Error code:003) Can not update into database!';
                                }
                            }else{
                                if ($dashboard_slide->update(array(
                                        'name'=>Input::get('Name'),
                                        'path'=>$nama_tujuan,
                                    ), Input::get('id_edit') )) {
                                    if(move_uploaded_file($lokasi, $nama_tujuan)){
                                        $success_slide='Upload success!';
                                    }else{
                                        $error_slide='Error Upload (Error code:004) Can not update into disk!';
                                    }   
                                }else{
                                    $error_slide='Error Upload (Error code:003) Can not update into database!';
                                }
                            }
                        }else{
                            $error_slide='Error Upload (Error code:002) File size is too large';
                        }
                    }else{
                        $error_slide='Error Upload (Error code:001) Format file is not valid';
                    }
                }else{
                    $error_slide='Error Upload (Error code:000)';
                }
            }else{
                if ($dashboard_slide->update(array(
                        'name'=>Input::get('Name'),
                    ), Input::get('id_edit') )) {
                        $success_slide='Upload success!';
                }else{
                    $error_slide='Error Edit (Error code:100) Can not update into database!';
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
            $nama_tujuan='Assets/upload/slide shows/'.$nama;
            if ($gagal==0) {
                if ($format =='image/jpeg'){
                    if ($ukuran <= 1000000) {
                        if (file_exists($nama_tujuan)) {
                            $nama_tujuan=str_replace(".jpg", "", $nama_tujuan);
                            $nama_tujuan=$nama_tujuan."_".$unik.".jpg";
                            if ($dashboard_slide->insert(array(
                                    'id'=>'',
                                    'name'=>Input::get('Name'),
                                    'path'=>$nama_tujuan,
                                ))) {
                                if(move_uploaded_file($lokasi, $nama_tujuan)){
                                    $success_slide='Upload success!';
                                }else{
                                    $error_slide='Error Upload (Error code:004) Can not insert into disk!';
                                }   
                            }else{
                                $error_slide='Error Upload (Error code:003) Can not insert into database!';
                            }
                        }else{
                            if ($dashboard_slide->insert(array(
                                    'id'=>'',
                                    'name'=>Input::get('Name'),
                                    'path'=>$nama_tujuan,
                                ))) {
                                if(move_uploaded_file($lokasi, $nama_tujuan)){
                                    $success_slide='Upload success!';
                                }else{
                                    $error_slide='Error Upload (Error code:004) Can not insert into disk!';
                                }   
                            }else{
                                $error_slide='Error Upload (Error code:003) Can not insert into database!';
                            }
                        }
                    }else{
                        $error_slide='Error Upload (Error code:002) File size is too large';
                    }
                }else{
                    $error_slide='Error Upload (Error code:001) Format file is not valid';
                }
            }else{
                $error_slide='Error Upload (Error code:000)';
            }    
        }
    }
}

require_once 'Template Dashboard/header.php';
?>
  
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Slide Shows Form</h1>
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
                                        <label for="Name" class="control-label mb-1">Name Picture</label>
                                        <input id="Name" name="Name" type="text" class="form-control" required="" value="<?php if(Input::get('id_edit')){
                                                while($data=mysqli_fetch_assoc($slide_id)){
                                                    echo $data['name'];
                                                }
                                            }else{ echo "";}?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="Path" class="control-label mb-1">Path</label>
                                        <input id="Path" name="Path" type="file" class="form-control" <?php if(Input::get('id_edit')){ echo ""; }else{?>required=""<?php } ?>>
                                    </div>
                                    <div>
                                        <input value="<?php if(Input::get('id_edit')) echo 'Edit'; else echo 'Add';?>" name="Add" type="submit" class="btn btn-md btn-primary">
                                        <input value="Cancel" name="Cancel" type="reset" class="btn btn-md btn-danger">
                                    </div>
                                    <input type="hidden" name="id" id="id">
                                </form>

                        <?php if(!empty($success_slide) || !empty($error_slide)){ ?>
                            <?php if (!empty($success_slide)) { ?>
                                <div class="alert alert-success alert-dismissible fade show mt-2 mb-2" role="alert">
                                    <?= $success_slide; ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php }elseif(!empty($error_slide)){ ?>
                                <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
                                    <?= $error_slide; ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php';?>
