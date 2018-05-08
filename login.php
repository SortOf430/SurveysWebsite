<?php
include("cambia.php");
$_SESSION['ref'] = $_SERVER["HTTP_REFERER"];

if($_SESSION['loggato'])
{
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sondaggi - Login Amministratore</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand">Login Amministrazione</a>
            </div>
        </nav>

        <div id="page-wrapper" style="width:70%; margin-left: auto; margin-right: auto;">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Login
                            <small>Effettua il login</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Login
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <!-- Login form -->
             <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form di Login</h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                    if($_SESSION['errore'])
                                    {
                                        echo '<div class="alert alert-danger">
                                                    <strong>Errore:</strong> Username e/o password errati!
                                              </div>';
                                        $_SESSION['errore'] = false;
                                    }
                                ?>
                                <div class="alert alert-info">
                                    <strong>Login:</strong> Introduci username e password nel form sottostante (Amministratori).
                                </div>
                                
                                <form action="login_effettua.php" method="post">
                                    <a class="glyphicon glyphicon-user"></a> Username
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">ID</span>
                                      <input type="text" name="username" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-user"></a> Password                                    
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">PW</span>
                                      <input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <center>
                                        <input type="submit" class="btn btn-sm btn-primary">
                                    </center>
                                </form>
                            </div>
                        </div>
                        <center>Made with ♥</center>
        </div>
        <!-- /#page-wrapper -->

    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
