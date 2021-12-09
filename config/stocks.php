<?php
include 'db.php' ;

if ( isset( $_POST['submitAddS'] ) && isset( $_POST['articles'] ) ) {

    $id_ar = $_POST['articles'];
    $qte = $_POST['qte'];

    $query = "INSERT into fsj_stocks (id_ar, qte)
    VALUES ('$id_ar', '$qte')";
    $result = mysqli_query( $db, $query );

    if ( $result ) {
        header( "Location: /dashboard/stocks.php?save=ok" );
        exit();
    } else {
        var_dump( $_POST );
    }

}
// fin add article with stock

if ( isset( $_POST['submitUpdateS'] ) && isset( $_POST['id_sU'] ) ) {
    $id_sU = $_POST['id_sU'];
    $qteU = $_POST['qteU'];
    $query = "UPDATE fsj_stocks SET qte='$qteU' WHERE id_s='$id_sU'";
    $result = mysqli_query( $db, $query );
    if ( $result ) {
        header( "Location: /dashboard/stocks.php?saveU=ok" );
        exit();
    }
}
// fin Modifier Stocks

if ( isset( $_POST['submitDM'] ) && isset( $_POST['idDM'] ) ) {
    $idDM = $_POST['idDM'];
    $query = "DELETE FROM fsj_stocks where id_s='$idDM'";
    $result = $db->query( $query );

    if ( $result ) {
        header( "Location: /dashboard/stocks.php?saveD=ok" );
        exit();
    }
}
// fin supprimer une aticle

if ( isset( $_POST["Action"] ) && $_POST["Action"] == "getArticlesSAjax" ) {
    $id_s = $_POST["id_s"];
    $GetSById = "SELECT * from fsj_stocks where id_s='$id_s' limit 1";
    $result = $db->query( $GetSById );
    $row = mysqli_fetch_row( $result );
    $id_ar = $row[1];
    $GetAById = "SELECT * from fsj_articles where id_ar='$id_ar' limit 1";
    $result = $db->query( $GetAById );
    $row2 = mysqli_fetch_row( $result );
    $desctAr = $row2[1];
    $results = array( "id_sU"=>$id_s, "desctAr"=>$desctAr, "qte"=>$row[2] );
    echo json_encode( $results );
}
// fin get article with ajax
