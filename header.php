<?php 

    include 'connection.php'; 
	
    if($user->isLoggedIn() == false) {
        $user->redirect('login.php?connection=success');
    }
	
?>

<!doctype html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>RumahSewa &middot; Dashboard </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!--<link rel="shortcut icon" href="/favicon.ico">-->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/veneto-admin.min.css">
        <link rel="stylesheet" href="demo/css/demo.css">
        <link rel="stylesheet" href="dist/assets/font-awesome/css/font-awesome.css">

        <link rel="stylesheet" href="dist/css/plugins/jquery-dataTables.min.css">
        <link rel="stylesheet" href="dist/css/plugins/jquery-select2.min.css">
        <link rel="stylesheet" href="dist/css/plugins/jquery-selectBoxIt.min.css">
        <link rel="stylesheet" href="dist/css/plugins/jquery-chosen.min.css">
        <link rel="stylesheet" href="dist/css/plugins/bootstrap-tagsinput.min.css">
        <link rel="stylesheet" href="dist/css/plugins/bootstrap-switch.min.css">
        <link rel="stylesheet" href="dist/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" href="dist/assets/plugins/jquery-icheck/skins/all.css">
        <link rel="stylesheet" href="dist/css/plugins/jquery-icheck.min.css">
        

        <!--[if lt IE 9]>
        <script src="dist/assets/libs/html5shiv/html5shiv.min.js"></script>
        <script src="dist/assets/libs/respond/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="">
        <header>
            <nav class="navbar navbar-default navbar-static-top no-margin" role="navigation">
                <div class="navbar-brand-group">
                    <a class="navbar-sidebar-toggle navbar-link" data-sidebar-toggle>
                        <i class="fa fa-lg fa-fw fa-bars"></i>
                    </a>
                    <a class="navbar-brand hidden-xxs" href="index.php">
                        <span class="sc-visible">
                            V
                        </span>
                        <span class="sc-hidden">
                            <span class="bold">RumahSewa</span>
                            
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-nav-expanded pull-right margin-md-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                            <i class="glyphicon glyphicon-globe"></i>
                            <span class="badge badge-up badge-danger badge-small">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-notifications pull-right">
                            <li class="dropdown-title bg-inverse">Notifications (3)</li>
                            <li>
                                <a href="javascript:;" class="notification">
                                    <div class="notification-thumb pull-left">
                                        <i class="fa fa-clock-o fa-2x text-info"></i>
                                    </div>
                                    <div class="notification-body">
                                        <strong>Call with John</strong><br>
                                        <small class="text-muted">8 minutes ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="notification">
                                    <div class="notification-thumb pull-left">
                                        <i class="fa fa-life-ring fa-2x text-warning"></i>
                                    </div>
                                    <div class="notification-body">
                                        <strong>New support ticket</strong><br>
                                        <small class="text-muted">21 hours ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="notification">
                                    <div class="notification-thumb pull-left">
                                        <i class="fa fa-exclamation fa-2x text-danger"></i>
                                    </div>
                                    <div class="notification-body">
                                        <strong>Running low on space</strong><br>
                                        <small class="text-muted">3 days ago</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="notification">
                                    <div class="notification-thumb pull-left">
                                        <i class="fa fa-user fa-2x text-muted"></i>
                                    </div>
                                    <div class="notification-body">
                                        New customer registered<br>
                                        <small class="text-muted">06/18/2014 12:31 am</small>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-footer">
                                <a href="javascript:;"><i class="fa fa-share"></i> See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle navbar-user" href="javascript:;">
                            <img class="img-circle" src="demo/images/profile.jpg">
                            <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right-xs">
                            <li class="arrow"></li>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="javascript:;">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                
            </nav>
        </header>
        <div class="page-wrapper">
            <aside class="sidebar sidebar-default">
                <div class="sidebar-profile">
                    <img class="img-circle profile-image" src="demo/images/profile.jpg">

                    <div class="profile-body">
                        <h4><?php echo $_SESSION['name']; ?></h4>

                        <div class="sidebar-user-links">
                            <a class="btn btn-link btn-xs" href="profile.php" data-placement="bottom" data-toggle="tooltip" data-original-title="Profile"><i class="fa fa-user"></i></a>
                            <a class="btn btn-link btn-xs" href="javascript:;"       data-placement="bottom" data-toggle="tooltip" data-original-title="Settings"><i class="fa fa-cog"></i></a>
                            <a class="btn btn-link btn-xs" href="logout.php" data-placement="bottom" data-toggle="tooltip" data-original-title="Logout"><i class="fa fa-sign-out"></i></a>
                        </div>
                    </div>
                </div>
                <nav>
                    <h5 class="sidebar-header">Navigation</h5>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="nav <?php if ($title == 'index') { echo 'active'; } ?>">
                            <a href="index.php" title="Dashboards">
                                <i class="fa fa-lg fa-fw fa-money"></i> Advance
                            </a>
                        </li>
                        <li class="nav-dropdown <?php if ($title == 'debtors' || $title == 'creditors') { echo 'active open'; } ?>">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-info-circle"></i> Status
                            </a>
                            <ul class="nav-sub">
                                <li class="<?php if ($title == 'debtors') { echo 'active open'; } ?>">
                                    <a href="debtors.php" title="Inbox">
                                        <i class="fa fa-fw fa-caret-right"></i> Debtors
                                    </a>
                                </li>
                                <li class="<?php if ($title == 'creditors') { echo 'active open'; } ?>">
                                    <a href="creditors.php" title="Message">
                                        <i class="fa fa-fw fa-caret-right"></i> Creditors
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-dropdown <?php if ($title == 'h-debtors' || $title == 'h-creditors') { echo 'active open'; } ?>">
                            <a href="#" title="Users">
                                <i class="fa fa-lg fa-fw fa-history"></i> History
                            </a>
                            <ul class="nav-sub">
                                <li class="<?php if ($title == 'h-debtors') { echo 'active open'; } ?>">
                                    <a href="history-debtors.php" title="Inbox">
                                        <i class="fa fa-fw fa-caret-right"></i> Debtors
                                    </a>
                                </li>
                                <li class="<?php if ($title == 'h-creditors') { echo 'active open'; } ?>">
                                    <a href="history-creditors.php" title="Message">
                                        <i class="fa fa-fw fa-caret-right"></i> Creditors
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>                    
              	</nav>
            </aside>

            <div class="page-content">
<!--
                <div class="page-subheading page-subheading-md">
				    <ol class="breadcrumb">
				        <li class="active"><a href="javascript:;"></a></li>
				    </ol>
				</div>
-->