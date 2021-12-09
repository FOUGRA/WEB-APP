<?php
include 'db.php' ;

if ( isset( $_POST['article'] ) && isset( $_POST['submitAddBS'] ) ) {
    $id_s = $_POST['article'];
    $id_ar = $_POST['id_arXR'];
    $qte = $_POST['qte'];
    $query = "INSERT into fsj_tempbs (id_s, id_ar,qte) VALUES ('$id_s', '$id_ar', '$qte')";
    $result = $db->query( $query );

    $querys = "select * from fsj_stocks where id_s='$id_s'";
    $results =   mysqli_query( $db, $querys );
    $rows = mysqli_fetch_array( $results );
    $qteInitial = $rows['qte'];
    $qteReste = $qteInitial - $qte;

    $queryUp = "UPDATE fsj_stocks set qte='$qteReste' where id_s='$id_s'";
    mysqli_query( $db, $queryUp );

    header( "Location: /dashboard/bon-s.php?save=ok" );
    exit();

}

if ( isset( $_POST['id_s'] ) && isset( $_POST['deletearcticleSD'] ) ) {
    $id_bs = $_POST['id_bs'];
    $id_s = $_POST['id_s'];
    $qte = $_POST['qte'];
    $queryD = "DELETE FROM fsj_tempbs where id_bs='$id_bs'";
    mysqli_query( $db, $queryD );
    $queryS = "select * FROM fsj_stocks where id_s='$id_s'";
    $results =   mysqli_query( $db, $queryS );
    $rows = mysqli_fetch_array( $results );
    $qteinitial = $rows['qte'];
    $qteCalculer = $qteinitial + $qte;

    $queryUD = "UPDATE fsj_stocks set qte='$qteCalculer' where id_s='$id_s'";
    mysqli_query( $db, $queryUD );

    header( "Location: /dashboard/bon-s.php?saveD=ok" );
    exit();

}

if ( isset( $_POST['fonctionnaire'] ) && isset( $_POST['submitAddBSF'] ) ) {

    $fonctionnaire = $_POST['fonctionnaire'];
    $datesortie = $_POST['datesortie'];
    $des_arts = "";
    $unites = "";
    $categories = "";
    $qtes = "";
    $id_arts = "";

    $queryS = "select * FROM fsj_tempbs";
    $resultIds  = $db->query( $queryS );
    foreach ( $resultIds as $resultId ) {
        $id_ar = $resultId['id_ar'];
        
        $queryid_ar = "select * FROM fsj_articles where id_ar='$id_ar'";
        $resultIds  = $db->query( $queryid_ar );
        $qte = '<span>'.$resultId['qte'] ;

        $qtes .= $qte.'</span></br>' ;
        
            $id_arts .= '<span>'.$id_ar.'</span></br>' ;
        
        foreach ( $resultIds as $resultId ) {
            
            
            $des_art = $resultId['des_art'] ;
            $des_arts .= '<span>'.$des_art.'</span></br>' ;
            $unite = $resultId['unite'] ;
            $unites .= '<span>'.$unite.'</span></br>' ;
            $categorie = $resultId['categorie'] ;
            $categories .= '<span>'.$categorie.'</span></br>' ;
            
          
        }
    }

    $querybsAdd = "INSERT into fsj_bs (id_fonctionaire,id_art,desc_art,unite,categorie,qte,date_ajout) VALUES ('$fonctionnaire','$id_arts', '$des_arts', '$unites', '$categories', '$qtes', '$datesortie')";
    mysqli_query( $db, $querybsAdd );

    if ( $querybsAdd ) {
        $tTemps = "TRUNCATE fsj_tempbs";
        mysqli_query( $db, $tTemps );
        header( "Location: /dashboard/bon-s.php?saveBS=ok" );
        exit();
    }

    /*  echo $des_arts;
    echo $unites;
    echo $categories;
    echo $qtes;

    echo "<pre>";
    var_dump( $_POST );
    echo "</pre>";

    */
}



// afficher BS


if ( isset( $_POST['afficherBS'] ) && isset( $_POST['id_bs'] ) ) {

    
    echo "<pre>";
    var_dump( $_POST );
    echo "</pre>";
    
}

// supprimer BS
if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_bs where id_bs='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/ts-bon-s.php?saveD=ok" );
        exit();
    }
}
