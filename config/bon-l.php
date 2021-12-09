<?php
include 'db.php' ;
if(isset($_POST['num_bon']) && isset($_POST['submitAddBon'])){
    $num_bon = $_POST['num_bon'];
    $id_fr = $_POST['id_fr'];
    $type_bon = $_POST['type_bon'];
    $query = "INSERT into fsj_bon (num_bon, id_fr,type_bon) VALUES ('$num_bon', '$id_fr', '$type_bon')";
    $result = $db->query($query);  
      header( "Location: /dashboard/bon-l.php?save=ok" );
      exit();
}

// add bon 

if ( isset( $_POST['submitUpdateBon'] ) && isset( $_POST['id_bon'] ) ) {
    
    $id_bon = $_POST['id_bon'];
    $num_bon = $_POST['num_bonU'];
    $id_fr = $_POST['id_frU'];
    $type_bon = $_POST['type_bonU'];
   
    $query = "UPDATE fsj_bon SET num_bon='$num_bon', id_fr='$id_fr' , type_bon='$type_bon' WHERE id_bon='$id_bon'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/bon-l.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un BL
/*
 * get bon ajax by id
 */
if (isset($_POST["Action"]) && $_POST["Action"]=="getAjax") {
    $id =$_POST["id"];
     $query = "SELECT * from fsj_bon where id_bon='$id' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $id_fr = $row[2] ;
     $query2 = "SELECT * from fsj_fournisseurs where id_fr='$id_fr' limit 1";
     $result2 = $db->query($query2);
    $row2=mysqli_fetch_row($result2);
     $nom_fr = $row2[1];
    
     $results = array("id_bon"=>$id,"num_bon"=>$row[1],"id_fr"=>$row[2],"nom_fr"=>$nom_fr,"type_bon"=>$row['3']);
     echo json_encode($results);
}

if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_bon where id_bon='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/bon-l.php?saveD=ok" );
        exit();
    }
}
// fin supprimer BL
