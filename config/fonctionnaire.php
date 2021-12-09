<?
include 'db.php' ;

if(isset($_POST['submitAddFC']) && isset($_POST['nom_fc'])){
    $nom_fc = $_POST['nom_fc'];
    $tel = $_POST['tel'];
    $service = $_POST['service'];
    $query = "INSERT into fsj_fonctionnaires (nom_fc, tel,service) VALUES ('$nom_fc', '$tel', '$service')";
    $result = $db->query($query);  
      header( "Location: /dashboard/fonctionnaire.php?save=ok" );
      exit();
    
}
// ajouter fonctionnaire

/*
 * get Fourniseeur ajax by id
 */
if (isset($_POST["Action"]) && $_POST["Action"]=="getFCAjax") {
    $id =$_POST["id"];
     $query = "SELECT * from fsj_fonctionnaires where id='$id' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id"=>$id,"nom_fc"=>$row[1], "tel"=>$row[2], "service"=>$row[3]);
     echo json_encode($results);
}

if ( isset( $_POST['submitUpdateFC'] ) && isset( $_POST['idFC'] ) ) {
    $id = $_POST['idFC'];
    $nom_fc = $_POST['nom_fcU'];
    $tel = $_POST['telU'];
    $service = $_POST['serviceU'];
    $query = "UPDATE fsj_fonctionnaires SET nom_fc='$nom_fc', tel='$tel', service='$service' WHERE id='$id'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/fonctionnaire.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un fournisseur

if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_fonctionnaires where id='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/fonctionnaire.php?saveD=ok" );
        exit();
    }
}
// fin supprimer fonctionnaire
