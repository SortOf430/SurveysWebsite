        <!-- Navigation -->
<?php
include_once("cambia.php");
include_once("Utility/PHPHelper.php");
$helper = new PHPHelper();
?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php
            
            $username=$helper->GetUser()['username'];
            $query="SELECT * FROM pm WHERE user2read='0' AND user2='".$username."';";
            
                        
                        $ris=mysql_query($query);
                        
                        if (!$ris) {
	                        die("Errore nella query $query: " . mysql_error());
                        }
                        
                $riga = mysql_fetch_array($ris);
                $iconchange=""; $l=0;
                while($riga){$l++; $riga = mysql_fetch_array($ris); }
                 
                if ($l==0) {
                    $iconchange="";
                }
                if ($l!=0) {
                    $iconchange="color:#F67A44;";
                }
            
            ?>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Area Amministrazione</a>
            </div>
            <!-- Top Menu Items -->
            
            <!--                     MSGs                            --->
            
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                <a href='#' class="dropdown-toggle" data-toggle="dropdown">
                <span style='<?php echo ($iconchange);?> font-family:'';'><?php echo ($l." ");?></span><i class="fa fa-envelope" style='<?php echo ($iconchange);?>' ></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php 
                        $query="SELECT * FROM pm WHERE user2read='0' AND user2='".$helper->GetUser()['username']."';";
                        $ris=mysql_query($query);
                        $riga = mysql_fetch_array($ris);
                        
                        
                        $i=0;
                        while($riga){
                        echo ("<li class='message-preview'>
                            <a href='inboxMessages.php#".$i."'>
                                <div class='media'>
                                    <span class='pull-left'>
                                        <img class='media-object' src='http://placehold.it/50x50' alt=''>
                                    </span>
                                    <div class='media-body'>
                                        <h5 class='media-heading'><strong>".$riga['user1']."</strong>
                                        </h5>
                                        <p class='small text-muted'><i class='fa fa-clock-o'></i> ".$riga['timestamp']."</p>
                                        <p><b>".$riga['title']."</b></p><p>".$riga['message']."</p>
                                    </div>
                                </div>
                            </a>
                        </li>"); 
                         $i++; $riga = mysql_fetch_array($ris); }
                        
                        if (mysql_fetch_array($ris)=='' AND $i==0) {
                            echo ("<li class='message'>
                            <i><a href='#'>Nessun nuovo messaggio</a></i></li>");
                        }
                        ?>
                        
                        <li class="message-footer" style="margin-left:10%">
                            <u></p><a href="inboxMessages.php">Leggi tutti i messaggi</a></u>
                        </li>
                    </ul>
                </li>
                
                <!--                     Alerts                            --->
                <?php
                            $query="SELECT * FROM alert ";
                            $ris=mysql_query($query);
                            
                            if (!$ris) {
	                        die("Errore nella query $query: " . mysql_error()); }
	                        
                            $riga = mysql_fetch_array($ris);
                            $tipo=$riga['tipo'];
                            $creatore=$riga['alerter'];
                            $data_alert=$riga['timestamp'];
                            $ricalert=$riga['ricalert'];
                            $ricalert2=explode("," ,$ricalert);
                            
                            $user=$helper->GetUser()['username'];
                            
                            $l=0; $c=0; 
                            
                            //controllo notifica presente per mantenere struttura cambio icona invariata
                            while($riga && $c<sizeof($ricalert2)){
                            if($ricalert2[$c]==$user)
                                {$l++; $riga = mysql_fetch_array($ris); $ricalert=$riga['ricalert']; $ricalert2=explode("," ,$ricalert); $c=0;}
                                $c++;
                                if($c==sizeof($ricalert2) ){
                            $riga = mysql_fetch_array($ris); $c=0; $ricalert=$riga['ricalert']; $ricalert2=explode("," ,$ricalert); }
                            } 

                            //cambio icona
                            $iconchange="";
                            if ($l==0) {
                            $iconchange="";
                            }
                            if ($l!=0) {
                            $iconchange="color:#F67A44;";
                            } ?>
                            
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style='<?php echo ($iconchange);?> font-family:'';'><?php echo ($l." ");?></span><i class="fa fa-bell" style='<?php echo ($iconchange);?>'></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php
                        
                        $query="SELECT * FROM alert ";
                        $ris=mysql_query($query);
                        $riga = mysql_fetch_array($ris);
                    
                        $ricalert=$riga['ricalert'];
                        $ricalert2=explode("," ,$ricalert); 
                        
                        $i=0; $c=0; $l=0;
                        //NASTASE GENIO PER QUESTA WHILE!!! GRASSIE
                        while($riga && $c<sizeof($ricalert2)){
                            if($ricalert2[$c]==$user)
                        {echo("<li class='message-preview'>
                            <a href='inboxAlerts.php#".$i."'> 
                                <div class='media'>
                                    <div class='media-body'>");
                                    if ($riga['tipo']=='sondaggio'){$tipoalert="label label-primary";}
                                    if ($riga['tipo']=='admin'){$tipoalert="label label-success";}
                                       echo ("<span class='".$tipoalert."'>Nuovo ".$riga['tipo']."</span>
                                        <p></p><h5 class='media-heading'><i>L'admin <strong>".$riga['alerter']."</strong></i>
                                        </h5>
                                        <p class='small text-muted'>ha creato un nuovo <b>".$riga['tipo']."</b> in data <br><i class='fa fa-clock-o'></i> ".$riga['timestamp']."
                                    </div>
                                </div>
                            </a>
                            </li>"); 
                            $replace=str_replace(",".$user, "", $ricalert); 
                            mysql_query("UPDATE alert SET ricalert = '".$replace."' WHERE alert.idal = '".$riga['idal']."'");
                            $riga = mysql_fetch_array($ris); $i++; 
                            $ricalert=$riga['ricalert']; $ricalert2=explode("," ,$ricalert); $c=0; $l++; 
                       }
                        $c++; 
                            if($c==(sizeof($ricalert2) )){
                            $replace=str_replace(",".$user, "", $ricalert); 
                            mysql_query("UPDATE alert SET ricalert = '".$replace."' WHERE alert.idal = '".$riga['idal']."'");
                            $riga = mysql_fetch_array($ris); $c=0; $ricalert=$riga['ricalert']; $ricalert2=explode("," ,$ricalert); }
                        }   
                        if ($l==0){echo ("<li class='message'>
                            <i><a href='#'>Nessuna nuova notifica</a></i></li>");}
                            echo ("</li>");
                            ?>
                        
                        <!--- Altri tipi di alert. Servono dopo!
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li> --->
                        <li class="divider"></li>
                        <li class="message-footer" style="margin-left:10%">
                            <u></p><a href="inboxAlerts.php">Vedi tutte le notifiche</a></u>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" ></i> <?php echo ($helper->GetUser()['Nome'] . " " . $helper->GetUser()['Cognome']); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="visualizza_sondaggi.php"><i class="fa fa-fw fa-user"></i> Gestione Sondaggi</a>
                        </li>
                        <li><!--link pagina creazione sondaggio-->
                            <a href="creazione_sondaggio.php"><i class="fa fa-fw fa-edit"></i> Creazione Sondaggio</a>
                        </li>
                        <li>
                            <a href="inboxMessages.php"><i class="fa fa-fw fa-envelope"></i> Messaggi</a>
                        </li>
                        <li>
                            <a href="newadmin.php"><i class="fa fa-fw fa-gear"></i> Aggiungi Amministratori</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="Utility/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    
                    <li <?php if ($_SESSION['pagina']=="index.php"){echo "class=\"active\"";}?>>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <!--<li <?php if ($_SESSION['pagina']=="statistiche.php"){echo "class=\"active\"";}?>>
                        <a href="statistiche.php"><i class="fa fa-fw fa-bar-chart-o"></i> Statistiche</a>
                    </li>-->
                    <li <?php if ($_SESSION['pagina']=="newadmin.php"){echo "class=\"active\"";}?>>
                        <a href="newadmin.php"><i class="glyphicon glyphicon-user"></i> Aggiungi Admin</a>
                    </li>
                    <!-- <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li> -->
                    <li <?php if ($_SESSION['pagina']=="creazione_sondaggio.php"){echo "class=\"active\"";}?>>
                        <a href="creazione_sondaggio.php"><i class="glyphicon glyphicon-pencil"></i> Crea sondaggio</a>
                    </li>
                    <li <?php if ($_SESSION['pagina']=="somministraSondaggio.php"){echo "class=\"active\"";}?>>
                        <a href="somministraSondaggio.php"><i class="glyphicon glyphicon-plane"></i> Somministra sondaggio</a>
                    </li>
                    <li <?php if ($_SESSION['pagina']=="visualizza_sondaggi.php"){echo "class=\"active\"";}?>>
                        <a href="visualizza_sondaggi.php"><i class="glyphicon glyphicon-list-alt"></i> Visualizza sondaggi</a>
                    </li>
                    
                    <li <?php if ($_SESSION['pagina']=="new_message.php"||$_SESSION['pagina']=="inboxMessages.php"||$_SESSION['pagina']=="sentMessages.php"){echo "class=\"active\"";}?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-edit"></i> Messaggi <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="new_message.php"><i class="glyphicon glyphicon-envelope"></i> Nuovo</a>
                            </li>
                            <li>
                                <a href="inboxMessages.php"><i class="glyphicon glyphicon-inbox"></i> Ricevuti</a>
                            </li>
                            <li>
                                <a href="sentMessages.php"><i class="glyphicon glyphicon-share-alt"></i> Inviati</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="Utility/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
