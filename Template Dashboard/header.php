<?php
if ($user->Logging()) {
    if (Session::get('user_status')!='Admin') {
       Redirect::to('index');
    }
}else{
    Redirect::to('login');
}

    $show       =$transaction->get_badges_admin();
    $rows       =mysqli_num_rows($show);

?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nine Production Official | Dashboard</title>
    <link href="Assets/img/Logo.png" rel="shortcut icon">

    <link rel="stylesheet" href="Dashboard/assets/css/normalize.css">
    <link rel="stylesheet" href="Dashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Dashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="Dashboard/assets/css/themify-icons.css">
    <link rel="stylesheet" href="Dashboard/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="Dashboard/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="Dashboard/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="Dashboard/assets/scss/style.css">
    <link href="Dashboard/assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">


    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <style type="text/css">
        @font-face{
            font-family: "Raleway";
            src: url('Vendor/Fonts/Raleway-Regular.ttf');
        }
        *{
            font-family: "Raleway";
        }
        body{
            font-family: "Raleway";
            background-image: url('Dashboard/images/bg.png');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .navbar .navbar-nav li > a, .navbar .menu-title{
            font-family: "Raleway";
        }
        .menutoggle {
            background: rgb(220, 7, 53);
        }
        #welcome-dashboard{
            display: none;
        }
        #modallogout{
            position: fixed;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 100;
            display: none;
        }
        #modallogout .logout-body{
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0%;
            height: 0%;
            padding: 5%;
            transform: translate(-50%, -50%);
            background-color: rgb(255, 255, 255, 1);
            border-radius: 1%;
        }
        #modallogout .logout-body h5, #modallogout .logout-body h1{
            display: none;
        }
        #yes_logout, #no_logout{
            display: none;
        }
        #setting_form, #password_form, #picture_form{
            display: none;
        }
    </style>
</head>
<body>
<div id="modallogout">
    <div class="logout-body">
        <div class="text-center">
            <h5 id="reminder">Reminder Logout!</h5>
            <h1 id="question">Are sure want to lougout?</h1>
        </div>
        <div class="text-center">
            <a href="logout.php?submit_logout=yes" id="yes_logout" class="btn btn-danger btn-md" style="border-radius: 5%;">Yes</a>
            <a href="#" id="no_logout" class="btn btn-primary btn-md" style="border-radius: 5%;">No</a>
        </div>
    </div>
</div>
	<!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="Dashboard.php"><img src="Dashboard/images/logo2.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="Dashboard.php"><img src="Dashboard/images/logo.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="Dashboard.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">User Interface</h3><!-- /.menu-title -->
                    <li>
                        <a href="Dashboard Slide Shows.php" title="Slide Shows"> 
                            <i class="menu-icon fa fa-picture-o"></i>
                            Slide Shows
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Portofolio.php" title="Portofolio"> 
                            <i class="menu-icon fa fa-paperclip"></i>
                            Portofolio
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Company.php" title="Company Profile"> 
                            <i class="menu-icon fa fa-building"></i>
                            Company Profile
                        </a>
                    </li>

                    <h3 class="menu-title">TRANSACTION</h3><!-- /.menu-title -->
                    <li>
                        <a href="Dashboard Transaction.php" title="Table Transaction"> 
                            <i class="menu-icon fa fa-table"></i>
                            Transaction
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Customers.php" title="Users & Customers"> 
                            <i class="menu-icon fa fa-users"></i>
                            Users
                        </a>
                    </li>

                    <h3 class="menu-title">REPORTS</h3><!-- /.menu-title -->
                    <li>
                        <a href="Dashboard Month.php" title="Month Report"> 
                            <i class="menu-icon fa fa-line-chart"></i>
                            Months
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Quarter.php" title="Quarter Report"> 
                            <i class="menu-icon fa fa-pie-chart"></i>
                            Quarter
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Semester.php" title="Semester Report"> 
                            <i class="menu-icon fa fa-area-chart"></i>
                            Semester
                        </a>
                    </li>
                    <li>
                        <a href="Dashboard Years.php" title="Year Report"> 
                            <i class="menu-icon fa fa-calendar"></i>
                            Year
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->


    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>

                        

                            <span class="count bg-primary"><?= $rows ?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have <?= $rows ?> Notification</p>

                        <?php if($rows > 0){ ?>
                            <?php $no=1; while ($data=mysqli_fetch_assoc($show)) { ?>

                            <a class="dropdown-item media bg-flat-color-<?php if($no >= 6 ){ echo '1'; }else{ echo $no++; }?>" href="Dashboard Transaction Form.php?id_edit=<?= $data['id']; ?>">
                                <span class="photo media-left">
                                    <?php $users=$user->get_data_id($data['user_code']); ?>
                                    <img alt="avatar" src="<?= $users['image']; ?>">
                                </span>
                                <span class="message media-body">
                                    <span class="name float-left"><?= $data['name']; ?> (<?= $data['category']; ?>)</span>
                                    <span class="time float-right"><?= date('d M y',strtotime($data['date'])); ?></span>
                                        <p><?= substr($data['explaining_user'], 0, 20); ?>...</p>
                                </span>
                            </a>

                            <?php } ?>
                        <?php } ?>

                          </div>


                        </div>
                    </div>         
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php $foto=$user->get_data_id(Session::get('id_user')); ?>
                            <img class="user-avatar rounded-circle" src="<?= $foto['image'];?>" alt="Admin Profile" width="50" height="30">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="Dashboard Profil.php"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#" id="btn_logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <a href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                            <i class="flag-icon flag-icon-id"></i>
                        </a>
                    </div>

                </div>

            </div>
        </header><!-- /header -->
        <!-- Header-->