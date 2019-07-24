<?php
require_once 'Core/init.php';

    $porto      =$dashboard_porto->get_rows_porto();
    $baris_porto=mysqli_num_rows($porto);

require_once 'Template Dashboard/header.php';
?>
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Portofolio</h1>
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
                                <?php if($baris_porto <= 12){ ?>
                                    <a href="Dashboard Portofolio Form.php" class="btn btn-sm btn-info">Add Portofolio</a>
                                <?php } ?>
                                </strong>
                            </div>
                            <div class="card-body">
                            <?php if(Session::exists('error_porto') || Session::exists('success_porto')){ ?>
                                <div class="sufee-alert alert with-close <?php if(Session::exists('error_porto')) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(Session::exists('error_porto')) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(Session::exists('error_porto')) echo "Fail"; else echo "Success"; ?></span>
                                        <?php 
                                            if(Session::exists('error_porto')){ 
                                                echo Session::get('error_porto');
                                            }else{
                                                echo Session::get('success_porto');
                                            }
                                        ?>.
                                        <?php
                                            if(Session::exists('error_porto')){
                                                Session::delete('error_porto');
                                            }elseif(Session::exists('success_porto')){
                                                Session::delete('success_porto');
                                            }elseif(Session::exists('error_porto') & Session::exists('success_porto')){
                                                Session::delete('error_porto');
                                                Session::delete('success_porto');
                                            }
                                        ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Product Name</th>
                                            <th>Customer</th>
                                            <th>Path</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            <?php $no=1; while($data_porto=mysqli_fetch_assoc($porto)){ ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data_porto['name']; ?></td>
                                            <td><?= $data_porto['company']; ?></td>
                                            <td>/<?= substr($data_porto['path'], -21); ?></td>
                                            <td>
                                                <a href="Dashboard Portofolio Form.php?id_edit=<?= $data_porto['id'];?>" class="btn btn-sm btn-light text-info"><i class="fa fa-eye"></i></a>
                                                &nbsp;
                                                <a href="Dashboard Portofolio Form.php?id_delete=<?= $data_porto['id'];?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Delete this data <?= $data_porto['name']." ".$data_porto['company']; ?> ?')"> <i class="fa fa-trash"></i></a>
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
