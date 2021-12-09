<?php
include 'db.php' ;

if ( isset( $_POST['submitAddArt'] ) && isset( $_POST['des_art'] ) ) {
    
    $des_art = $_POST['des_art'];
    $unite = $_POST['unite'];
    $type_art = "Consommable";
    $categorie = $_POST['categorie'];
    $alert = $_POST['alert'];
    
    $query = "INSERT into fsj_articles (des_art, unite,type_art,categorie,alert)
VALUES ('$des_art', '$unite', '$type_art', '$categorie','$alert')";
    $result = mysqli_query( $db, $query );
    
   if ( $result ) {
        header( "Location: /dashboard/articles.php?save=ok" );
        exit();
    } else {
       var_dump($_POST);
   }
    
}
// fin ajouter un article
if ( isset( $_POST['submitUpdateSQ'] ) && isset( $_POST['id_arU'] ) ) {
    
    $id_ar = $_POST['id_arU'];
    $des_art = $_POST['des_artU'];
    $unite = $_POST['uniteU'];
    $type_art = "Consommable";
    $categorie = $_POST['categorieU'];
    $alert = $_POST['alertU'];
    
    $query = "UPDATE fsj_articles SET des_art='$des_art', unite='$unite', type_art='$type_art', categorie='$categorie', alert='$alert' WHERE id_ar='$id_ar'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/articles.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un articles

if ( isset($_POST['submitDM']) && isset($_POST['idDM']) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_articles where id_ar='$idDM'";
    $result = $db->query($query);
    if ($result) {
        header("Location: /dashboard/articles.php?saveD=ok");
        exit();
    }
}
// fin supprimer une aticle


if (isset($_POST["Action"]) && $_POST["Action"]=="getArticlesAjax") {
    $id_arU =$_POST["id_arU"];
     $query = "SELECT * from fsj_articles where id_ar='$id_arU' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id_ar"=>$id_arU,"des_art"=>$row[1], "unite"=>$row[2], "categorie"=>$row[4],"alert"=>$row[5]);
     echo json_encode($results);
}
 // fin get article with ajax

?>
