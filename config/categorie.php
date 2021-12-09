<?
include 'db.php' ;

if(isset($_POST['submitAddCat']) && isset($_POST['descCat'])){
    
    $description = $_POST['descCat'];
    $type = $_POST['typrcat'];
    $query = "INSERT into fsj_categories (description, type) VALUES ('$description', '$type')";
    $result = $db->query($query);  
      header( "Location: /dashboard/categories.php?save=ok" );
      exit();
    
}
// ajouter cat

/*
 * get Fourniseeur ajax by id
 */
if (isset($_POST["Action"]) && $_POST["Action"]=="getCatAjax") {
    $id =$_POST["id"];
     $query = "SELECT * from fsj_categories where id='$id' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id"=>$id,"description"=>$row[1], "type"=>$row[2]);
     echo json_encode($results);
}

if ( isset( $_POST['submitUpdateCat'] ) && isset( $_POST['idCAt'] ) ) {
    
    $id = $_POST['idCAt'];
    $description = $_POST['descCatU'];
    $type = $_POST['typrcatU'];
   
    $query = "UPDATE fsj_categories SET description='$description', type='$type' WHERE id='$id'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/categories.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un fournisseur
if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_categories where id='$idDM'";
      $result = $db->query($query);
    if ( $result ) {
        header( "Location: /dashboard/categories.php?saveD=ok" );
        exit();
    }
}
// fin supprimer categories
