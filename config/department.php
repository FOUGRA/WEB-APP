<?php
include 'db.php' ;
if(isset($_POST['num_bon']) && isset($_POST['submitAddBon'])){
    
    $num_bon = $_POST['num_bon'];
    $id_fr = $_POST['id_fr'];
    $query = "INSERT into fsj_bon (num_bon, id_fr) VALUES ('$num_bon', '$id_fr')";
    $result = $db->query($query);  
      header( "Location: /dashboard/bon-l.php" );
      exit();
    
}
