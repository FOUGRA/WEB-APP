<?php

@session_start();
ob_start();

/*	
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

    $now = time();
     if ($now > $_SESSION['expireGS']) {
                session_destroy();
                header('Location: /stock199219');
                exit();
      } 
 */
     if(isset($_SESSION["isadmin"]) && ($_SESSION["valueadmin"]==sha1("adminadmin")))
     { 
         
     }else{
        header('Location: /');
        exit();
     }


?>
