<?
include 'db.php' ;

if(isset($_POST['submitAddUnite']) && isset($_POST['descUnite'])){
    
    $description = $_POST['descUnite'];
    $query = "INSERT into fsj_unites (description) VALUES ('$description')";
    $result = $db->query($query);  
      header( "Location: /dashboard/unites.php?save=ok" );
      exit();
    
}
// ajouter Unite

/*
 * get Unite ajax by id
 */
if (isset($_POST["Action"]) && $_POST["Action"]=="getCatAjax") {
    $id =$_POST["id"];
     $query = "SELECT * from fsj_unites where id='$id' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id"=>$id,"description"=>$row[1]);
     echo json_encode($results);
}

if ( isset( $_POST['submitUpdateUnite'] ) && isset( $_POST['idUnite'] ) ) {
    
    $id = $_POST['idUnite'];
    $description = $_POST['descUniteU'];
   
    $query = "UPDATE fsj_unites SET description='$description' WHERE id='$id'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/unites.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un Unite
if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_unites where id='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/unites.php?saveD=ok" );
        exit();
    }
}
// fin supprimer Unite
