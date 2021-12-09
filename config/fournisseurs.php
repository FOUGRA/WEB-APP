<?php
include 'db.php' ;

if ( isset( $_POST['submitAddF'] ) && isset( $_POST['res_soc'] ) ) {
    $res_soc = $_POST['res_soc'];
    $tel = $_POST['tel'];
    $fax = $_POST['fax'];
    $adr_four = $_POST['adr_four'];
    $email = $_POST['email'];
    $responsable = $_POST['responsable'];
    $ville = $_POST['ville'];
    $observation = $_POST['observation'];
    $query = "INSERT into fsj_fournisseurs (res_soc, tel,fax,adr_four,email,responsable, ville, observation)
VALUES ('$res_soc', '$tel', '$fax', '$adr_four','$email','$responsable','$ville','$observation')";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/fournisseurs.php?save=ok" );
        exit();
    }
}
// fin ajouter un fournisseur

if ( isset( $_POST['submitUpdateSQ'] ) && isset( $_POST['idfU'] ) ) {
    
    $idfU = $_POST['idfU'];
    $res_socU = $_POST['res_socU'];
    $telU = $_POST['telU'];
    $faxU = $_POST['faxU'];
    $adr_fourU = $_POST['adr_fourU'];
    $emailU = $_POST['emailU'];
    $responsableU = $_POST['responsableU'];
    $villeU = $_POST['villeU'];
    $observationU = $_POST['observationU'];
    $query = "UPDATE fsj_fournisseurs SET res_soc='$res_socU', tel='$telU', fax='$faxU', adr_four='$adr_fourU', email='$emailU', responsable='$responsableU', ville='$villeU', observation='$observationU' WHERE id_fr='$idfU'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/fournisseurs.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un fournisseur

if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_fournisseurs where id_fr='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/fournisseurs.php?saveD=ok" );
        exit();
    }
}
// fin supprimer un fournisseur


/*
 * get Fourniseeur ajax by id
 */
if (isset($_POST["Action"]) && $_POST["Action"]=="getFrAjax") {
    $id_fr =$_POST["id_fr"];
     $query = "SELECT * from fsj_fournisseurs where id_fr='$id_fr' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id_fr"=>$id_fr,"res_soc"=>$row[1], "tel"=>$row[2], "fax"=>$row[3],"adr_four"=>$row[4],"email"=>$row[5],"responsable"=>$row[6],"ville"=>$row[7],"observation"=>$row[8]);
     echo json_encode($results);
}
