<?php
    require_once 'Core/init.php';

require_once 'Template Dashboard/header.php';

    $company      =$dashboard_comp->get_rows_comp();
    $baris_company=mysqli_num_rows($company);

?>
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Company Profile</h1>
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
                                    <!--<a href="Dashboard Company Form.php" class="btn btn-sm btn-info">Add Company Profile</a>-->
                                </strong>
                            </div>
                            <div class="card-body">
                            <?php if(Session::exists('error_comp') || Session::exists('success_comp')){ ?>
                                <div class="sufee-alert alert with-close <?php if(Session::exists('error_comp')) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(Session::exists('error_comp')) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(Session::exists('error_comp')) echo "Fail"; else echo "Success"; ?></span>
                                        <?php 
                                            if(Session::exists('error_del')){ 
                                                echo Session::get('error_comp');
                                            }else{
                                                echo Session::get('success_comp');
                                            }
                                        ?>.
                                        <?php
                                            if(Session::exists('error_comp')){
                                                Session::delete('error_comp');
                                            }elseif(Session::exists('success_comp')){
                                                Session::delete('success_comp');
                                            }elseif(Session::exists('error_comp') & Session::exists('success_comp')){
                                                Session::delete('error_comp');
                                                Session::delete('success_comp');
                                            }
                                        ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <table class="table table-striped table-bordered" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Address</th>
                                            <th>Post Code</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                            <?php while($data_company=mysqli_fetch_assoc($company)){ ?>
                                        <tr>
                                            <td><?= $data_company['name']; ?></td>
                                            <td><?= $data_company['address']; ?></td>
                                            <td><?= $data_company['zip_code'];?></td>
                                            <td><?= $data_company['phone'];?></td>
                                            <td><?= $data_company['email']; ?></td>
                                            <td style="font-size: 18px;">
                                                <a href="Dashboard Company Form.php?id_edit=<?= $data_company['id'];?>" class="btn btn-sm btn-light text-info"><i class="fa fa-eye"></i></a>
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

<?php require_once 'Template Dashboard/footer.php'; ?>
