<?php
    require_once 'Core/init.php';

require_once 'Template Dashboard/header.php';
    
    $name       ='';
    $address    ='';
    $zip        ='';
    $phone      ='';
    $mail       ='';
    $gmaps      ='';
    $id         ='';
if (Input::get('id_edit')) {
    $company_id      =$dashboard_comp->get_rows_comp_id(Input::get('id_edit'));
    $baris_company_id=mysqli_num_rows($company_id);
    while($data=mysqli_fetch_assoc($company_id)){
        $id         =$data['id'];
        $name       =$data['name'];
        $address    =$data['address'];
        $zip        =$data['zip_code'];
        $phone      =$data['phone'];
        $mail       =$data['email'];
        $gmaps      =$data['gmaps_link'];
    }
    if (Input::get('submit')) {
        
        if (Token::check(Input::get('token'))) {
            if($dashboard_comp->update(array(
                    'name'      =>Input::get('Name'),
                    'address'   =>Input::get('Address'),
                    'zip_code'  =>Input::get('Zip'),
                    'phone'     =>Input::get('Phone'),
                    'email'     =>Input::get('Email'),
                    'gmaps_link'=>Input::get('Gmaps')
                ),Input::get('id'))){
                Session::set('success_comp','Company Profile has been updated!');
                Redirect::to('Dashboard Company');
            }else{
                Session::set('error_comp','Update Company Profile is failed!');
                Redirect::to('Dashboard Company');
            }
        }
    }
}else{
    Redirect::to('Dashboard Company');
}

?>
        
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="breadcrumbs">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Company Profile Form</h1>
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
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id" id="id" value="<?= $id; ?>">
                                            <input type="hidden" name="token" id="token" value="<?= Token::generate();?>">
                                            <div class="form-group">
                                                <label for="Name" class="control-label mb-1">Company Name</label>
                                                <input id="Name" name="Name" type="text" class="form-control" required="" placeholder="Company Name" value="<?= $name; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="Address" class="control-label mb-1">Address</label>
                                                <textarea id="Address" name="Address" class="form-control" required="" placeholder="Company Address"><?= $address; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="Zip" class="control-label mb-1">Zip Code</label>
                                                <input id="Zip" name="Zip" type="text" class="form-control" required="" placeholder="Zip/Post Code" value="<?= $zip; ?>">
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="Phone" class="control-label mb-1">Phone</label>
                                            <input id="Phone" name="Phone" type="text" class="form-control" required="" placeholder="Phone Number" value="<?= $phone;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="control-label mb-1">Email</label>
                                            <input id="Email" name="Email" type="email" class="form-control" required="" placeholder="Email" value="<?= $mail;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Gmaps" class="control-label mb-1">Gmaps Link</label>
                                            <textarea id="Gmaps" name="Gmaps" type="text" class="form-control" required="" placeholder="Google maps links"><?= $gmaps;?></textarea>
                                        </div>
                                        </div>
                                    </div>                                    
                                    <div>
                                        <button name="submit" value="submit" type="submit" class="btn btn-md btn-primary">Edit</button>
                                        <button name="cancel" value="cancel" type="reset" class="btn btn-md btn-danger">Cancel</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- Content -->


<?php require_once 'Template Dashboard/footer.php';?>
