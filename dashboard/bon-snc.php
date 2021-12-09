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
                <h4 class="titreTabs"><i class="fal fa-inbox-out"></i> Bon de Sortie Articles Non Consommable</h4>
            </div>
            <div class="bloccentent">

                <div id="cart_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/dashboard/bon-snc.php"><i class="fal fa-person-dolly"></i> Faire un bon de sortie</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard/ts-bon-snc.php"><i class="fal fa-shipping-fast"></i> Tous les bon de sortie</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="tabledataTS">
                        <form action="../config/bon-snc.php" method="post">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label" for="article">Articles : <span class="oblig">*</span></label>
                                        <select class="form-control" name="article" id="article" required>
                                            <option value="" selected disabled>Sélectionner Article!</option>
                                            <?     
                                            $query = "SELECT * FROM fsj_article_nc order by id desc";
                                            $stock = $db->query($query);
                                           
                                                   
                                     foreach ($stock as $stocks) {
                                         $id_art  = $stocks['id'];
                                           $description_article = $stocks['des_art'];
                                                   $unite_article = $stocks['unite'];
                                                   $categorie_article = $stocks['categorie'];
                                                   $ninventaire = $stocks['ninventaire'];
                                                ?>
                                            <option value="<? echo $id_art; ?>" data-unite="<? echo $unite_article; ?>" data-categorie="<? echo  $categorie_article; ?>" data-type="<? echo  $categorie_article; ?>" data-ni="<? echo  $ninventaire; ?>">
                                                <? echo $description_article;  ?>
                                            </option>

                                            <?
                                     }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group ">
                                        <label class="col-form-label" for="unite">Unité :</label>
                                        <input type="text" class="form-control" name="unite" id="unite" placeholder="Unité Article" disabled>
                                        <input type="hidden" name="uniteXR" id="uniteXR">
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
                                        <label class="col-form-label" for="ninventaire">N° Inventaire :</label>
                                        <input type="text" class="form-control" name="ninventaire" id="ninventaire" placeholder="N° Inventaire" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
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


                                <div class="chtable_Sdesou">
                                    <div class="row">


                                        <div class="col-sm-12">
                                            <button class="btn btnvalidS btn-success" type="submit" name="submitAddBSNC"><i class="fal fa-check"></i>&nbsp;Valider BS</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
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
                $("#homeSubmenu2 .sidebarNC").addClass('active');

                $("#article").change(function() {
                    $id_s = $("option:selected", this).val();
                    $data_unite = $("option:selected", this).attr("data-unite");
                    $data_categorie = $("option:selected", this).attr("data-categorie");
                    $data_qte = $("option:selected", this).attr("data-qte");
                    $idar = $("option:selected", this).attr("data-idar");
                    $ninventaire = $("option:selected", this).attr("data-ni");
                    $tpa = $("option:selected", this).attr("data-type");

                    $("#unite").val($data_unite);
                    $("#uniteXR").val($data_unite);
                    $("#tpa").val($tpa);

                    $("#categorie").val($data_categorie);
                    $("#categorieXR").val($data_categorie);
                    $("#qte").val($data_qte);
                    $("#ninventaire").val($ninventaire);

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
