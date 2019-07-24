<?php
    require_once 'Core/init.php';


require_once 'Template Dashboard/header.php';

    $transaction      =$dashboard_trans->get_trans_admin();
    $baris_transaction=mysqli_num_rows($transaction);
$user_ids='';
    $transaction_id      ='';
    $baris_transaction_id='';
if(Input::get('id_edit')){
    if($dashboard_trans->update(array('read_admin'=>1), Input::get('id_edit'))) {
        $transaction_id      =$dashboard_trans->get_trans_admin_id(Input::get('id_edit'));
        $baris_transaction_id=mysqli_num_rows($transaction);
        if (Input::get('submit')) {
            if (Token::check(Input::get('token'))) {
                if($dashboard_trans->update1(array(
                    'status'    =>Input::get('Status'),
                    'price'     =>str_replace(".", "", Input::get('Price')),
                    'price_deal'=>str_replace(".", "", Input::get('Deal_Price')),
                    'read_user' =>0,
                    'date'      =>date('Y-m-d')
                ), Input::get('id_edit'))){
                    Session::set('success_trans', 'Data Transaction was updated!');
                    Redirect::to('Dashboard Transaction');
                }else{
                    Session::set('error_trans', 'Update data transaction fail!');
                    Redirect::to('Dashboard Transaction');
                }
            }
        }   
    }
}elseif (Input::get('id_delete')) {
    $transaction_id      =$dashboard_trans->get_trans_admin_id(Input::get('id_delete'));
    $baris_transaction_id=mysqli_num_rows($transaction);
    if($dashboard_trans->delete(Input::get('id_delete'))){
        Session::set('success_trans', 'Data Transaction was deleted!');
        Redirect::to('Dashboard Transaction');
    }else{
        Session::set('error_trans', 'Delete data transaction fail!');
        Redirect::to('Dashboard Transaction');
    }
}else{
    Redirect::to('Dashboard Transaction');
}
    

?>
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Transaction Form</h1>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                <?php while($data=mysqli_fetch_assoc($transaction_id)){ ?>
                                    <div class="col-md-6">
                                        <form action="" method="post">
                                        <input type="hidden" name="id" id="id" value="<?= $data['id']; ?>">
                                            <input type="hidden" name="token" id="token" value="<?= Token::generate();?>">
                                            <div class="form-group">
                                                <label for="Status" class="control-label mb-1">Status</label>
                                                <select id="Status" name="Status" class="form-control" required="">
                                                    <option <?php if($data['status']=='Cancel') echo "selected='true'"; ?> >Cancel</option>
                                                    <option <?php if($data['status']=='Negotiation') echo "selected='true'"; ?> >Negotiation</option>
                                                    <option <?php if($data['status']=='Deal') echo "selected='true'"; ?> >Deal</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="Price" class="control-label mb-1">Price</label>
                                                <input id="Price" name="Price" type="text" class="form-control text-right" required="" value="<?= number_format($data['price']);?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                            <div class="form-group">
                                                <label for="Deal_Price" class="control-label mb-1">Deal Price</label>
                                                <input id="Deal_Price" name="Deal_Price" type="text" class="form-control text-right" required="" value="<?php echo number_format($data['price_deal']); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                            <div>
                                                <button name="submit" value="submit" type="submit" class="btn btn-md btn-primary">OK</button>
                                                <button name="reset" value="reset" type="reset" class="btn btn-md btn-danger">Cancel</button>
                                            </div>
                                            <input type="hidden" name="id" id="id">
                                        </form> 
                                    </div>

                                    <div class="col-md-6">
                                        <?php $users=$user->get_data_id($data['user_code']); ?>
                                        <div class="card-header user-header alt bg-dark">
                                            <div class="media">
                                                <a href="#">
                                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px; <?php if($data['status']=='Negotiation'){ echo "border-color: blue;"; }elseif($data['status']=='Cancel'){ echo "border-color: red"; }else{ echo "green;"; } ?>" alt="" src="<?= $users['image'];?>">
                                                </a>
                                                <div class="media-body">
                                                    <h2 class="text-light display-6"><?= $users['name'];?></h2>
                                                    <p><?= $users['email']; ?></p>
                                                </div>
                                            </div>
                                        </div>


                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <a href="#"> <i class="fa fa-list"></i> Category <span class="pull-right"><?= $data['category'];?></span></a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="#"> <i class="fa fa-paperclip"></i> Title <span class="pull-right"><?= $data['title'];?></span></a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="#"> <i class="fa fa-phone"></i> Phone <span class="pull-right"><?= $data['phone'];?></span></a>
                                            </li>
                                            <li class="list-group-item">
                                                <p>Explaining Design</p>
                                                <a href="#"> <?= $data['explaining_user']; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                <?php } ?>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Content -->


<?php require_once 'Template Dashboard/footer.php';?>
<?php require('Vendor/angka.php'); ?>
