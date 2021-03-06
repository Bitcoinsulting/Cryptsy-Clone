<?php
session_start();
session_regenerate_id();
require_once($_SERVER['DOCUMENT_ROOT']."/classes/BaseDonnee.class.php");
$bdd = BaseDonnee::connexion();
include_once($_SERVER['DOCUMENT_ROOT']."/includes/verifications.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>
   Crypto Maniac - Account Balances</title>    
   <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/header.inc.php"); ?>
 </head>
 <body>
  <!-- Fixed navbar -->
  <?php
      //Affiche une barre différente si l'user est connecté
  if(!isset($_SESSION["pseudo"])){
    header("Location: /index.php");
    exit();
  }else{
   include($_SERVER['DOCUMENT_ROOT']."/includes/member_navbar.inc.php");
 }
 ?>

 <div id="wrap" class="container ">
  <div class="row maincontents">

    <!-- Sidebar start -->
    <?php
    include($_SERVER['DOCUMENT_ROOT']."/includes/sidebar.inc.php");
    ?>
    <!-- Sidebar end -->


    <!-- Content start -->
    <div class="page" id="content" role="main">



      <div class="working-contents">
        <div class="working-contents">




          <div class="page page-dashboard" style="float:left;">
            <br />
            <div class="panel panel-default panel-account-balances" style="width:748px;">
              <div class="panel-heading"> 
                <span class="glyphicon glyphicon-balances"></span> Your Top Account Balances
                <button type="button" class="btn btn-default pull-right" onclick="location.href='/users/balances.php'">View All <span class="glyphicon glyphicon-rarr"></span></button>
              </div>
              <div class="panel-body">
                <?php 
                $topbalance = BaseDonnee::execQuery($bdd, "SELECT * FROM balances WHERE Account = '$username' ORDER BY Amount DESC LIMIT 8");
                echo '<div class="row">';
                for ($i = 0; $i < 4; $i++){
                  if(empty($topbalance[$i])) continue;
                  $b = $topbalance[$i];
                  $acr = $b["Coin"];
                  $name = BaseDonnee::execQuery($bdd, "SELECT Name From Wallets WHERE Acronymn = '$acr'")[0]["Name"];
                  echo '<div class="col-xs-3">
                  <span class="big">'.number_format(floatval($b["Amount"]), 3, '.', '').'</span>
                  <hr class="separator">
                  <p class="name"><a href="/users/balances.php">'.$name.'</a></p>
                  </div>';
                }
                echo '</div>';
                echo '<div class="row">';
                for ($i = 4; $i < 8; $i++){
                  if(empty($topbalance[$i])) continue;
                  $b = $topbalance[$i];
                  $acr = $b["Coin"];
                  $name = BaseDonnee::execQuery($bdd, "SELECT Name From Wallets WHERE Acronymn = '$acr'")[0]["Name"];
                  echo '<div class="col-xs-3">
                  <span class="big">'.number_format(floatval($b["Amount"]), 3, '.', '').'</span>
                  <hr class="separator">
                  <p class="name"><a href="/users/balances.php">'.$name.'</a></p>
                  </div>';
                }
                echo '</div>';
                ?>
                





              </div>  
            </div><!--/panel account balances-->

            <div class="box">      
              <div class="box-container">
                <div id="news-list">

                  <style type="text/css">
                  #twitter-widget-0{width:751px;}
                  </style>
                  <a class="twitter-timeline" width="720" href="https://twitter.com/_cryptomaniac"  data-widget-id="423246077890805760">Tweets by @_cryptomaniac</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


                </div>
                <span class="clearFix">&nbsp;</span>
              </div><!-- end of div.box-container -->
            </div><!-- end of div.box -->
            <script type="text/javascript">

            $(document).ready(function() {
              $('.menu').dropit();
            });

            </script>



            <div class="clearfix"></div>


          </div><!--/end working-contents--> 
        </div><!--/content-->


      </div><!--/row/maincontents-->


    </div> <!-- /container -->

    <div class="clearfix"></div>

    <div id="chat_div"></div>
    <!-- Footer Start --><?php   include($_SERVER['DOCUMENT_ROOT']."/includes/footer.inc.php");   ?><!-- Footer end -->

    <script>$('.dropdown-toggle').dropdown();</script>
    <div id="pseudo" style="display:none"><?php echo $_SESSION["pseudo"]; ?></div>
    <!-- CHATBOX -->
    <script type="text/javascript" src="/js/myChatbox.js?rev=<?php echo time(); ?>"></script>

    <!-- VIEWNOTIFS -->
    <?php   include($_SERVER['DOCUMENT_ROOT']."/includes/viewNotif.inc.php");   ?>



    <script type="text/javascript">$('.dropdown-toggle').dropdown();</script> 
  </body>
  <!-- web7 -->
  </html>
