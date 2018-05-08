<?php 
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="newadmin.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sondaggi - Inserimento Ammistratore</title>
    
    <link rel="shortcut icon" type="image/png" href="images/favicon2.ico" />
    
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
    <script>
    var password;
    var confirm_password;
    function validatePassword() {
    var password = document.getElementById("password"),
    confirm_password = document.getElementById("conferma_password");
    if (password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Le password non coincidono!");
    } else {
    confirm_password.setCustomValidity('');
     }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;</script>
    
</head>

<body>
     <div id="wrapper">
        <?php include("header.php"); ?>


        <div id="page-wrapper" >
            <div class="container-fluid">
                
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nuovo Amministratore
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Nuovo Amministratore
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <!-- Login form -->
             <div class="panel panel-green" style="margin:0 1% 0 2%">
                            <div class="panel-heading">
                                <h3 class="panel-title">Form di aggiunta Amministratore</h3>
                            </div>
                            
                            <div class="panel-body">
                                <?php //controllo validità query
                                if ($_SESSION['newadmininsert']){
                                     echo ("<div class=\"alert alert-danger\" role=\"alert\">
                                            <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
                                            <span class=\"sr-only\">Errore:</span>
                                            Username gi&agrave; esistente!
                                            </div>");
                                    $_SESSION['newadmininsert']= false;
                                } ?>
                                <div class="alert alert-info">
                                    <strong>Nuovo</strong> Amministratore.
                                </div>
                                
                                <form action="newadmininsert.php" method="post">
                                    <a class="glyphicon glyphicon-user"></a>   Username   
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input type="text" name="username" maxlength="255" class="form-control" placeholder="Username" required aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-asterisk"></a>   Password                                 
                                    <br>
                                    <div class="input-group" style="width:49%;">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input type="password" id="password" name="password" maxlength="255" class="form-control" required placeholder="Password" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-asterisk"></a>   Conferma Password                                
                                    <br>
                                    <div class="input-group" style="width:49%;">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input id="conferma_password" type="password" onblur="validatePassword()"; class="form-control" maxlength="255" placeholder="Conferma Password" id="confirm_password" aria-describedby="basic-addon1" required>
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-hand-right"></a>   Nome
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input type="text" name="nome" class="form-control" maxlength="255" required placeholder="Thomas" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-hand-right"></a>   Cognome
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input type="text" name="cognome" class="form-control" maxlength="255" required placeholder="Anderson" aria-describedby="basic-addon1">
                                    </div>
                                    <br>
                                    <a class="glyphicon glyphicon-envelope"></a>   E-mail
                                    <br>
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1"></span>
                                      <input type="text" name="email" autocomplete="on" maxlength="255" class="form-control" placeholder="thomasanderson@matrix.wo" aria-describedby="basic-addon1">
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
    </div>
    <br><br><br>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
