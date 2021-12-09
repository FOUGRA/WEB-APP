<?php
ini_set('display_errors','on');
error_reporting(E_ALL);
@session_start();
ob_start();
   // echo 'PHP version: ' . phpversion();
include '../config/connectOk.php' ;
include '../config/db.php' ;

$id_bs=$_POST['id_bs'];


if(!isset($id_bs)){
     header( "Location: /dashboard/ts-bon-snc.php" );
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculté des sciences - Gestion du stock</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon/favicon.ico">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap44.min.css">

    <link rel="stylesheet" href="/css/styleprint.css">
    <link rel="stylesheet" type="text/css" href="/css/impression.css" media="print">

</head>

<body>

    <div class="a5">
        <div class="a55">
            <div class="logo">
                <img src="/img/logo.jpg"><br>
                <span>Université chouaib doukkali </span><br>
                <span>Faculté des sciences </span><br>
                <span>El jadida</span><br>
            </div>
            <?
              $querys = "SELECT * FROM fsj_bsnc where id_bsnc='$id_bs'";
                   $result = $db->query($querys);
                     $row=mysqli_fetch_array($result);
            $id_fonctionaire = $row["id_fonctionaire"]; 
             $querysFct = "SELECT * FROM fsj_fonctionnaires where id='$id_fonctionaire'";
                $resultftc = $db->query($querysFct);
                $rowFtc=mysqli_fetch_array($resultftc);
            
            
                $id_artnc = $row["id_artnc"]; 
              $querysArtc = "SELECT * FROM fsj_article_nc where id='$id_artnc'";
                $resultArt = $db->query($querysArtc);
                $rowArt=mysqli_fetch_array($resultArt);
            
            ?>
            <div class="info">
                <h2 class="text-center"><u>N° Bon De Sortie :
                        <? echo 'NC00'.$id_bs ;?>
                    </u></h2>
                <ul>
                    <li><b>Nom Client :</b>

                        <?  
                        echo $rowFtc['nom_fc']
                        
                        ?>

                    </li>
                    <li>
                        <b> Services / Departement</b> :
                        <? echo $rowFtc["service"]; ?>
                    </li>

                </ul>
                <div class="datesortie">
                    <span><b>Date : </b>
                        <? echo substr($row['date_ajout'],0,10) ;?>
                    </span>

                </div>
            </div>
            <div class="tabled">
                <table class="table">
                    <thead>
                        <th>N°</th>
                        <th>Description</th>
                        <th>Unité</th>
                        <th>Categorie </th>
                        <th>N° Inventaire</th>
                    </thead>
                    <tbody>

                        <tr>
                            <td class='text-left'>
                                <? echo $rowArt['id'] ;?>
                            </td>
                            <td class='text-left'>
                                <? echo $rowArt['des_art'] ;?>
                            </td>
                            <td class='text-left'>
                                <? echo $rowArt['unite'] ;?>
                            </td>
                            <td class='text-left'>
                                <? echo $rowArt['categorie'] ;?>
                            </td>
                            <td>
                                <? echo $rowArt['ninventaire'] ;?>
                            </td>

                        </tr>

                    </tbody>
                </table>
                <div class="sig">
                    <span>Signature</span>
                </div>
                <div class="row">
                    <div class="linkbackdiv text-center">
                        <a href="/dashboard/ts-bon-snc.php/" class="linkback btn btn-outline-secondary"><i class="fal fa-hand-point-left"></i> Retour</a>

                        <a href="#" OnClick="javascript:window.print()" class="btn btn-outline-info linkback"><i class="fas fa-print"></i> Imprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
