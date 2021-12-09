<?php
include 'db.php' ;

if ( isset( $_POST['article'] ) && isset( $_POST['submitAddBSNC'] ) ) {
        $article =  $_POST['article'];
        $fonctionnaire = $_POST['fonctionnaire'];
        $datesortie = $_POST['datesortie'];
        
          $querybsAdd = "INSERT into fsj_bsnc (id_artnc,id_fonctionaire,date_ajout) VALUES ('$article', '$fonctionnaire', '$datesortie')";
    mysqli_query( $db, $querybsAdd );

    if ( $querybsAdd ) {
        $tTemps = "Update fsj_article_nc set qte=0 where id='$article'" ;
        mysqli_query( $db, $tTemps );
        header( "Location: /dashboard/bon-snc.php?saveBS=ok" );
        exit();
    }
}



// supprimer BS nc
if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_bsnc where id_bsnc='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/ts-bon-snc.php?saveD=ok" );
        exit();
    }
}
