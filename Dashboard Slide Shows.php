<?php
require_once 'Core/init.php';

$slide      =$dashboard_slide->get_rows_slide();
$baris_slide=mysqli_num_rows($slide);

$success_del="";
$error_del="";
if(Input::get('delete')){
    if (Input::get('id_delete')) {
        if (Input::get('token')) {
            if ($dashboard_slide->delete(Input::get('id_delete'))) {
                header("Refresh:0; Dashboard Slide Shows.php");
                $success_del="Data slide was deleted";
            }else{
                header("Refresh:0; Dashboard Slide Shows.php");
                $error_del="Delete data slide ";
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
                                <h1>Slide Shows</h1>
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
                                <?php if ($baris_slide < 6) { ?>
                                    <a href="Dashboard Slide Shows Form.php" class="btn btn-sm btn-info">Add Picture</a>
                                <?php }else{ echo ''; } ?>
                                </strong>
                            </div>
                            <div class="card-body">
                            <?php if(!empty($error_del) || !empty($success_del)){ ?>
                                <div class="sufee-alert alert with-close <?php if(!empty($error_del)) echo 'alert-danger'; else echo 'alert-success'; ?> alert-dismissible fade show">
                                    <span class="badge badge-pill <?php if(!empty($error_del)) echo 'badge-danger'; else echo 'badge-success'; ?>"><?php if(!empty($error_del)) echo "Fail"; else echo "Success"; ?></span>
                                        <?php if(!empty($error_del)) echo $error_del; else echo $success_del; ?>.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($baris_slide <= 6) { $no=1; ?>

                                        <?php while($data_slide=mysqli_fetch_assoc($slide)){ ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data_slide['name']; ?></td>
                                            <td>
                                               <a href="Dashboard Slide Shows Form.php?id_edit=<?= $data_slide['id'] ?>" class="btn btn-sm btn-light text-info">
                                                   <i class="fa fa-eye"></i>
                                               </a>    
                                                <form action="" method="post" style="display: inline;">
                                                    <input type="hidden" name="id_delete" value="<?= $data_slide['id']; ?>">
                                                    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
                                                    <button type="submit" name="delete" value="Delete" class="btn btn-sm btn-light text-danger" onclick="return confirm('Delete this slide ?')"> <i class="fa fa-trash"></i></button>   
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        <?php }} ?>
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
