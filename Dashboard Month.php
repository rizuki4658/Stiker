<?php
    require_once 'Core/init.php';

    require_once 'Template Dashboard/header.php';
?>
        <!-- Content -->
        <div class="content mt-3">
            
            <div class="col-lg-12 col-md-12" id="welcome-dashboard">
                <div class="animated fadeIn">
                    <div class="row">

                    <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title mb-3">Month Reports</strong>
                            </div>
                            <div class="card-body">
                            <?php if( Session::exists('error_report') ){ ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">
                                        <i class="ti-face-sad"></i>
                                    </span>
                                    <?= Session::get('error_report');?>    
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php Session::delete('error_report');?>
                            <?php } ?>
                                <form action="Dashboard Report.php" method="post">
                                    <input type="hidden" name="category" id="category" value="Month">
                                    <div class="form-group">
                                        <label for="Month" class="control-label mb-1"> Month </label>
                                        <select class="form-control" id="Month" name="Month" required="">
                                            <option value="">Months</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Years" class="control-label mb-1"> Years </label>
                                        <input type="number" class="form-control" id="Years" name="Years" min="2017" max="2025" value="2019" required="">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-md btn-info">View</button>
                                        <button type="reset" class="btn btn-md btn-default">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    </div>
                </div><!-- .animated -->
            </div>

        </div> <!-- Content -->

<?php require_once 'Template Dashboard/footer.php'; ?>
