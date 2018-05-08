<?php
include("cambia.php");
include("Utility/PHPHelper.php");
$helper = new PHPHelper();
$_SESSION['pagina']="mail";
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Area Amministrazione - Mail</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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
    <div id="wrapper">
        
            <?php include("header.php");?>
                
        <div id="page-wrapper">
        
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Creazione Liste</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Liste
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="glyphicon glyphicon-hand-right"></i>      <strong><u><?php echo ($helper->GetUser()['Nome'] . "</u> <u>" . $helper->GetUser()['Cognome']); ?></u></strong><a href="#" class="alert-link"></a></a>
                        </div>
                        <?php 
                        if ($_SESSION['success_creation']){
                        echo("<div class=\"alert alert-success alert-dismissable\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                            <strong>Benvenuto <u>Lista di Email - Associate a link creata con successo!</u></strong><a href=\"#\" class=\"alert-link\"></a></a>
                        </div>");
                        $_SESSION['success_creation']=FALSE;
                        }
                        
                        
                        ?>
                    </div>
                </div><div class='col-lg-4' style='width:100%'>
                        <div class='panel panel-default'><div class='panel-body'>
                                <div class='list-group'>
                <table width="50%" class="table table-striped" border="1">
                    <tr>
                        <td>
                            <b>E-Mail</b>
                        </td>
                        <td>
                            <b>Link del Sondaggio</b>
                        </td>
                    </tr>
<?php 
    $sondaggio = $_REQUEST['sondaggio'];
    $listaEmail = $_REQUEST['emails'];
    $array_email = explode(",",$listaEmail);
     foreach($array_email as $email)
     {
        if(!$helper->matchesEmail($email))
        {
            continue;
        }
     $stringa = RandomString();
     mysql_query("INSERT INTO codici (codice, questionario, fatto) VALUES ('".$stringa."', '".$sondaggio."', '0');");
     echo '<tr>';
     echo '<td>'.$email.'</td><td><a href="https://sitoscuola-dz191.c9users.io/questionario.php?codice='.$stringa.'">Link</a></td>';
     echo '</tr>';
     }
     
function RandomString()
{
    $characters = "abcdefghijklmnopqrstuvwxyz";
    $randstring = '';
    for ($i = 0; $i < 6; $i++) {
        $randstring = $randstring.$characters[rand(0, strlen($characters))];
    }
    return $randstring;
}


?>
</table></div></div></div></div>
    </div>
</div>
<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
</body>
</html>