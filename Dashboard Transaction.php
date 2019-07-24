<?php
require_once 'Core/init.php';
 

require_once 'Template Dashboard/header.php';   

    $transaction      =$dashboard_trans->get_trans_admin();
    $baris_transaction=mysqli_num_rows($transaction);


?>      

        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Data Transactions</h1>
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
                                   <!---header title-->
                                </strong>
                            </div>
                            <div class="card-body">
                            <?php if(Session::exists('error_trans') || Session::exists('success_trans')){ ?>
                                <div class="sufee-alert alert with-close <?php if(Session::exists('error_trans')) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(Session::exists('error_trans')) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(Session::exists('error_trans')) echo "Fail"; else echo "Success"; ?></span>
                                        <?php 
                                            if(Session::exists('error_trans')){ 
                                                echo Session::get('error_trans');
                                            }else{
                                                echo Session::get('success_trans');
                                            }
                                        ?>.
                                        <?php
                                            if(Session::exists('error_trans')){
                                                Session::delete('error_trans');
                                            }elseif(Session::exists('success_trans')){
                                                Session::delete('success_trans');
                                            }elseif(Session::exists('error_trans') & Session::exists('success_trans')){
                                                Session::delete('error_trans');
                                                Session::delete('success_trans');
                                            }
                                        ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead style="font-size: 12px;">
                                        <tr>
                                            <th>No</th>
                                            <th>Category</th>
                                            <th>Customer</th>
                                            <th>Title</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Explain</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Price Deal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="font-size: 12px;">
                                    <?php $no=1; while($data=mysqli_fetch_assoc($transaction)){ ?>
                                        <tr>
                                            <td><?= $no++; ?> <?php if($data['read_admin']==0){ ?><span class="badge badge-danger">New</span><?php }else{ echo ""; } ?></td>
                                            <td><?= $data['category'];?></td>
                                            <td><?= $data['name'];?></td>
                                            <td><?= $data['title'];?></td>
                                            <td><?= $data['email']?></td>
                                            <td><?= $data['phone'];?></td>
                                            <td><?= substr($data['explaining_user'], 0, 10);?>...</td>
                                            <td><a href="#" class="btn btn-sm 
                                                <?php if($data['status']=='Negotiation'){
                                                    echo "btn-primary";
                                                }elseif($data['status']=='Deal'){
                                                    echo "btn-success";
                                                }elseif($data['status']=='Cancel'){
                                                    echo "btn-danger";
                                                } ?>" style="font-size: 12px; border-radius: 25%;"><?= $data['status'];?></a></td>
                                            <td class="text-right"><?= "Rp. ".number_format($data['price']); ?></td>
                                            <td class="text-right"><?= "Rp. ".number_format($data['price_deal']); ?></td>
                                            <td style="padding: 0;">
                                                <a href="Dashboard Transaction Form.php?id_edit=<?= $data['id']; ?>" class="btn btn-sm btn-light text-info"><i class="fa fa-eye"></i></a>
                                                &nbsp;
                                                <a href="Dashboard Transaction Form.php?id_delete=<?= $data['id']; ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Delete this data <?= $data['name']." with Title ".$data['title']; ?> ?')"><i class="fa fa-trash"></i></a>
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
