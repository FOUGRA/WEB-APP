<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='bon-s';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?
        include '../inculde/head.php' ;
    ?>
</head>

<body>
    <header>
        <?
        include '../inculde/header.php' ;
    ?>
    </header>
    <div class="wrapper">
        <?php 
                    include "../inculde/navLeft.php";
                ?>

        <!-- Navigation left -->
        <div class="blocktopheader">
            <?php 
                    include "../inculde/header-navbar.php";
                ?>
            <div class="blocTitle">
                <h4 class="titreTabs"><i class="fal fa-inbox-out"></i> Bon de Sortie Articles Consommable</h4>
            </div>
            <div class="bloccentent">

                <div id="cart_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/dashboard/bon-s.php"><i class="fal fa-person-dolly"></i> Faire un bon de sortie</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/ts-bon-s.php"><i class="fal fa-shipping-fast"></i> Tous les bon de sortie</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="tabledataTS">
                        <form action="../config/bon-s.php" method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="article">Articles : <span class="oblig">*</span></label>
                                        <select class="form-control" name="article" id="article" required>
                                            <option value="" selected disabled>Sélectionner une Article!</option>
                                            <?     
                                            $query = "SELECT * FROM fsj_stocks order by id_s desc";
                                            $stocks = $db->query($query);
                                            foreach ($stocks as $stock) {
                                                    $id_s= $stock['id_s'];                                      
                                                    $id_ar= $stock['id_ar'];                                                                     
                                               $querys = "SELECT * FROM fsj_articles where id_ar='$id_ar'";
                                                $result = $db->query($querys);
                                                $row=mysqli_fetch_row($result);
                                                   $description_article = $row[1];
                                                   $unite_article = $row[2];
                                                   $categorie_article = $row[4];
                                                   $tpa = $row[3];
                                                   $qte_article =  $stock['qte'];
                                    
                                            if ($qte_article>0){ 
                                                ?>
                                            <option value="<? echo $id_s; ?>" data-idar="<? echo $id_ar; ?>" data-unite="<? echo $unite_article; ?>" data-categorie="<? echo  $categorie_article; ?>" data-qte="<? echo  $qte_article; ?>" data-type="<? echo  $categorie_article; ?>">
                                                <? echo $description_article;  ?>
                                            </option>
                                            <?
                                             }
                                            }
                                            
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="unite">Unité :</label>
                                        <input type="text" class="form-control" name="unite" id="unite" placeholder="Unité Article" disabled>
                                        <input type="hidden" name="uniteXR" id="uniteXR">
                                        <input type="hidden" name="id_arXR" id="id_arXR">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="categorie">Catégorie :</label>
                                        <input type="text" class="form-control" name="categorie" id="categorie" placeholder="Catégorie Article" disabled>
                                        <input type="hidden" name="categorieXR" id="categorieXR">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="tpa">Type Article :</label>
                                        <input type="text" class="form-control" id="tpa" name="tpa" value="Type Article" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="qte">Quantité :</label>
                                        <input type="number" min="1" class="form-control" name="qte" id="qte" placeholder="Quantité Article">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btnvalidS btn-success" type="submit" name="submitAddBS"><i class="fal fa-check"></i>&nbsp;Ajouter</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <?
                     $querynbri = "SELECT count(*) as nbrinsert FROM fsj_tempbs";
                             $querynbriR = mysqli_query( $db, $querynbri );
                     $rowCount=mysqli_fetch_array($querynbriR);
                     $countISN = $rowCount['nbrinsert'];
                    if($countISN > 0){ 
                    ?>
                    <div class="tab-content tab-contentcattype tabledataTS padd15" id="tabledetaillevoyage">
                        <table class="tabledetaillevoyage ">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Articles</th>
                                    <th>Unité</th>
                                    <th>Catégorie</th>
                                    <th>Quantité</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?     
                                            $query = "SELECT * FROM fsj_tempbs order by id_bs desc";
                                            $stockTemps = $db->query($query);
                                            foreach ($stockTemps as $stockTemp) {
                                                $id_ar=$stockTemp['id_ar'];
                                                   $queryGetrt = "SELECT * FROM fsj_articles where id_ar='$id_ar'";
                             $queryGetrt = mysqli_query( $db, $queryGetrt );
                     $rowArt=mysqli_fetch_array($queryGetrt);
                                ?>
                                <tr>
                                    <td>
                                        <? echo $stockTemp['id_bs']?>
                                    </td>
                                    <td>
                                        <? echo $rowArt['des_art']?>
                                    </td>
                                    <td>
                                        <? echo $rowArt['unite']?>
                                    </td>
                                    <td>
                                        <? echo $rowArt['categorie']?>
                                    </td>

                                    <td>
                                        <? echo $stockTemp['qte']?>
                                    </td>

                                    <td class="text-center">
                                        <span class="inlineblock" data-toggle="tooltip" data-placement="top" title="" data-original-title="Retirer">
                                            <form action="../config/bon-s.php" method="post">
                                                <input type="hidden" name="id_s" value=" <? echo $stockTemp['id_s']?>">
                                                <input type="hidden" name="id_bs" value=" <? echo $stockTemp['id_bs']?>">
                                                <input type="hidden" name="qte" value=" <? echo $stockTemp['qte']?>">
                                                <button class="deleteVbtn" type="submit" id="deletearcticleSD" name="deletearcticleSD"> <i class="fas fa-minus-octagon"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>
                                <?
                                            }
                                ?>
                            </tbody>
                        </table>

                        <form class="form-horizontal" method="post" action="../config/bon-s.php" enctype="multipart/form-data" name="FormAddCCours">
                            <div class="col-sm-12 chtable_desou">
                                <div class="row">


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="col-form-label" for="fonctionnaire">Nom Fonctionnaire : <span class="oblig">*</span></label>
                                            <select class="form-control" name="fonctionnaire" id="fonctionnaire" required="">
                                                <option value="" selected="" disabled="">Sélectionner un Fonctionnaire!</option>
                                                <?     
                                            $query = "SELECT * FROM fsj_fonctionnaires order by id desc";
                                            $fonctionnaires  = $db->query($query);
                                            foreach ($fonctionnaires as $fonctionnaire) {
                                                $id=$fonctionnaire['id'];
                                                $nom_fc = $fonctionnaire['nom_fc'];
                                                    $service = $fonctionnaire['service'];
                                                    ?>
                                                <option value="<? echo $id;?>" data-service="<? echo $service;?>">
                                                    <? echo $nom_fc;?>
                                                </option>
                                                <?
                                            }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group ">
                                            <label class="col-form-label" for="dataservice">Services :</label>
                                            <input type="text" class="form-control" name="dataservice" id="dataservice" placeholder="Service" disabled>

                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group ">
                                            <label class="col-form-label" for="datesortie">Date Sortie :</label>
                                            <input type="datetime-local" class="form-control" name="datesortie" id="datesortie" required="">

                                        </div>
                                    </div>

                                </div>
                                <div class="chtable_Sdesou">
                                    <div class="row">


                                        <div class="col-sm-12">
                                            <button class="btn btnvalidS btn-success" type="submit" name="submitAddBSF"><i class="fal fa-check"></i>&nbsp;Valider BS</button>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <?
                    }?>
                </div>


            </div>

        </div>
    </div>

    <?
        include '../inculde/js.php' ;
    ?>
    <!--    // <script src="/js/alertify.js"></script>-->
    <?
        if(@$_GET['saveD']=='ok'){
            echo "
              <script>
                alertify.error('Article supprimé avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('Article Ajouté avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('Article bien éte Modifier');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
    
     if(@$_GET['saveBS']=='ok'){
            echo "
              <script>
                alertify.success('BS Ajouté avec Succès');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
    ?>
    <script>
        $(document).ready(function() {

            $("#homeSubmenu2").addClass('show');
            $("#homeSubmenu2 .sidebarC").addClass('active');
            $("#article").change(function() {
                $id_s = $("option:selected", this).val();
                $data_unite = $("option:selected", this).attr("data-unite");
                $data_categorie = $("option:selected", this).attr("data-categorie");
                $data_qte = $("option:selected", this).attr("data-qte");
                $idar = $("option:selected", this).attr("data-idar");
                $tpa = $("option:selected", this).attr("data-type");

                $("#unite").val($data_unite);
                $("#uniteXR").val($data_unite);
                $("#tpa").val($tpa);

                $("#categorie").val($data_categorie);
                $("#categorieXR").val($data_categorie);
                $("#qte").val($data_qte);
                $("#id_arXR").val($idar);

                $("#qte").attr("max", $data_qte);
            });


            $("#fonctionnaire").change(function() {
                $dataservice = $("option:selected", this).attr("data-service");
                $("#dataservice").val($dataservice);

            });
            /*  $("#bonl").change(function() {
                  $datafrNom = $("option:selected", this).attr("data-frNom");
                  $datafrid = $("option:selected", this).attr("data-frid");
                  $typebl = $("option:selected", this).attr("data-type");
                  $("#fournisseur").val($datafrNom);
                  $("#id_frXR").val($datafrid);
                  $("#typebl").val($typebl);

              }); */


            // deleteCours
            $(".btndelete").click(function() {
                $id = $(this).attr("data-id");
                $nom = $(this).attr("data-nom");
                $("#idDM").val($id);
                $("#datanom").text($nom);
            });

            $(".btnUpdateM").click(function() {
                $('#UpdateM').trigger("reset");
                $id = $(this).attr("data-id");
                $datas = {
                    "Action": "getAjax",
                    "id": $id
                };
                $.post("../config/bon-l.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#id_bon").val(getdats['id_bon']);
                    $("#num_bonU").val(getdats['num_bon']);
                    $("#id_frU").val(getdats['id_fr']);
                    $("#nom_frUO").html(getdats['nom_fr']);
                    $("#type_bonU").val(getdats['type_bon']);
                    console.log(getdats['nom_fr']);
                });

            });
        });

    </script>
</body>


</html>
