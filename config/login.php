<?php
include 'db.php' ;
    $identifiant = mysqli_real_escape_string( $db, $_POST['identifiant'] );
    $password = mysqli_real_escape_string( $db, $_POST['password'] );

if ($identifiant != "" && $password != ""){
    
        $sql_query = "select  count(*) as cntUser from fsj_admins where login='".$identifiant."' and password='".$password."'";
    $sql_query2 = "select  * from fsj_admins where login='".$identifiant."' and password='".$password."'";
        $result = mysqli_query( $db, $sql_query );
        $result2 = mysqli_query( $db, $sql_query2 );
        $row2 = mysqli_fetch_array( $result2 );
        $row = mysqli_fetch_array( $result );
        $count = $row['cntUser'];
        if ( $count > 0 ) {
              $_SESSION["authenticated"] = 'true';
               $_SESSION["isadmin"] = 'true';
                $_SESSION["nom"] = $row2['nom'];
                $_SESSION["valueadmin"] = sha1("adminadmin");
               echo 1;
        } else {
            echo 0;
        }
    
}

?>
