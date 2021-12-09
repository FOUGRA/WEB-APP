<?php
include 'db.php' ;

if ( isset( $_POST['submitAddArt'] ) && isset( $_POST['des_art'] ) ) {
    
    $des_art = $_POST['des_art'];
    $unite = $_POST['unite'];
    $type_art = "Non Consommable";
    $categorie = $_POST['categorie'];
    $ninventaire = $_POST['ninventaire'];
    
    $query = "INSERT into fsj_article_nc (des_art, unite,type_art,categorie,ninventaire)
VALUES ('$des_art', '$unite', '$type_art', '$categorie','$ninventaire')";
    $result = mysqli_query( $db, $query );
    
   if ( $result ) {
        header( "Location: /dashboard/articles-nc.php?save=ok" );
        exit();
    } else {
       var_dump($_POST);
   }
    
}
// fin ajouter un article
if ( isset( $_POST['submitUpdateAU'] ) && isset( $_POST['id_arU'] ) ) {
    
    $id_ar = $_POST['id_arU'];
    $des_art = $_POST['des_artU'];
    $unite = $_POST['uniteU'];
    $type_art = "Non Consommable";
    $categorie = $_POST['categorieU'];
    $ninventaire = $_POST['ninventaireU'];
    
    $query = "UPDATE fsj_article_nc SET des_art='$des_art', unite='$unite', type_art='$type_art', categorie='$categorie', ninventaire='$ninventaire' WHERE id='$id_ar'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/articles-nc.php?saveU=ok" );
        exit();
    }
}
// fin Modifier un articles

if ( isset($_POST['submitDM']) && isset($_POST['idDM']) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_article_nc where id='$idDM'";
    $result = $db->query($query);
    if ($result) {
        header("Location: /dashboard/articles-nc.php?saveD=ok");
        exit();
    }
}
// fin supprimer une aticle


if (isset($_POST["Action"]) && $_POST["Action"]=="getArticlesAjax") {
    $id_arU =$_POST["id_arU"];
     $query = "SELECT * from fsj_article_nc where id='$id_arU' limit 1";
     $result = $db->query($query);
     $row=mysqli_fetch_row($result);
     $results = array("id"=>$id_arU,"des_art"=>$row[1], "unite"=>$row[2], "categorie"=>$row[4],"ninventaire"=>$row[5]);
     echo json_encode($results);
}
 // fin get article with ajax

?>
