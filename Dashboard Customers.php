<?php
    require_once 'Core/init.php';
require_once 'Template Dashboard/header.php';

    $data_users      =$user->get_users();
    $baris_users=mysqli_num_rows($data_users);

?>
      <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Users & Customers</h1>
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
                <div class="animated fadeIn">
                    <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">
                                   <a href="Dashboard Customers Form.php" class="btn btn-sm btn-info">Add User</a>
                                </strong>
                            </div>
                            <div class="card-body">
                            <?php if(Session::exists('error_user') || Session::exists('success_user')){ ?>
                                <div class="sufee-alert alert with-close <?php if(Session::exists('error_user')) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(Session::exists('error_user')) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(Session::exists('error_user')) echo "Fail"; else echo "Success"; ?></span>
                                        <?php 
                                            if(Session::exists('error_user')){ 
                                                echo Session::get('error_user');
                                            }else{
                                                echo Session::get('success_user');
                                            }
                                        ?>.
                                        <?php
                                            if(Session::exists('error_user')){
                                                Session::delete('error_user');
                                            }elseif(Session::exists('success_user')){
                                                Session::delete('success_user');
                                            }elseif(Session::exists('error_user') & Session::exists('success_user')){
                                                Session::delete('error_user');
                                                Session::delete('success_user');
                                            }
                                        ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead style="font-size: 12px; text-align: center;">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;">
                                <?php $no=1; while($data=mysqli_fetch_assoc($data_users)){ ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data['name'];?></td>
                                            <td><?= $data['email'];?></td>
                                            <td><?php if($data['address']!=''){ ?><?= $data['address'];?> <?php }else{ echo 'unknown'; } ?></td>
                                            <td><?php if($data['phone']!=''){ ?><?= $data['phone'];?> <?php }else{ echo 'unknown'; } ?></td>
                                            <td class="text-center"><img src="<?= $data['image']; ?>" width="30" height="30"></td>
                                            <td class="text-center">
                                                <?php if ($data['status']=='Admin') {?>
                                                    <a class="btn btn-sm btn-success" style="border-radius: 100%;" title="ADMIN"><i class="fa fa-android"></i></a> ADMIN
                                                <?php }elseif($data['status']=='User'){ ?>
                                                    <a class="btn btn-sm btn-info" style="border-radius: 100%;" title="USER"><i class="fa fa-github-alt"></i></a> USER
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="Dashboard Customers Form.php?id_edit=<?= $data['id']; ?>" class="btn btn-sm btn-light text-info"><i class="fa fa-eye"></i></a>
                                                &nbsp;
                                                <a href="Dashboard Customers Form.php?id_delete=<?= $data['id'] ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Delete this User <?= $data['name']." with email ".$data['email']; ?> ?')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    </div>
                </div><!-- .animated -->
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php';?>
