<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='articles';
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
                <h4 class="titreTabs"><i class="fal fa-cart-arrow-down"></i> Articles Non Consommable </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter Article</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloccentent">

                <table class="table tabledetaillevoyage" id="cart">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Description</th>
                            <th>N° D'inventaire</th>
                            <th>Unité</th>
                            <th>Catégorie</th>
                            <th>Type Article</th>

                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_article_nc where qte<>0 order by id desc";
                              $articles = $db->query($query);
                                foreach ($articles as $article) {
                                        ?>
                        <tr>
                            <td>
                                <? 
                              echo $article['id'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $article['des_art'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $article['ninventaire'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $article['unite'];
                            ?>
                            </td>


                            <td>
                                <? 
                               echo  $article['categorie'];
                            ?>
                            </td>

                            <td>
                                Non Consommable
                            </td>

                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $article['id']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>

                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-nom="<?php  echo $article['des_art']; ?>" data-id="<?php  echo $article['id']; ?>" data-target="#deleteM">
                                        <i class="fal fa-trash-alt"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        <?  }  ?>


                    </tbody>

                </table>



            </div>

        </div>
    </div>

    <!-- model add Fournisseur -->
    <div class="modal fade" id="addM" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pdd-t0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title custom_align text-success"><i class="far fa-plus"></i> Ajouter un Article</h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/articles-n.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="num_bon">Description : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="des_art" name="des_art" placeholder="Description Article" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="unite">Unité : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="unite" id="unite" required>
                                    <option value="" selected disabled>Sélectionner l'Unités</option>
                                    <?
                                  $queryGF = "SELECT * FROM fsj_unites order by description asc";
                                  $unites = $db->query($queryGF);
                                    foreach ($unites as $unite) {
                                        ?>
                                    <option>
                                        <? echo $unite['description']; ?>
                                    </option>
                                    <? } ?>
                                </select>

                                <input class="form-control" type="text" id="TAutres" name="TAutres" placeholder="Ajouter Autre Unité">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="type_art">Type Article : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="Non Consommable" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="categorie">Categorie : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="categorie" id="categorie" required>
                                    <option value="" selected disabled>Sélectionner une Categorie</option>
                                    <?
                                  $queryGF = "SELECT * FROM fsj_categories where type='Non Consommable' order by description asc";
                                  $Categories = $db->query($queryGF);
                                    foreach ($Categories as $Categorie) {
                                        ?>
                                    <option>
                                        <? echo $Categorie['description']; ?>
                                    </option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="ninventaire">N° D'inventaire : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control ninventaire" placeholder="0000-AA-YYYY" id="ninventaire" name="ninventaire" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddArt"><i class="fal fa-check"></i> Ajouter</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- fin model add -->
    <!-- model add Fournisseur -->
    <div class="modal fade" id="UpdateM" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pdd-t0">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title custom_align text-primary"><i class="fal fa-edit"></i> Modifier cette Article </h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/articles-n.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="num_bon">Description : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="hidden" id="id_arU" name="id_arU">
                                <input type="text" class="form-control" id="des_artU" name="des_artU" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="uniteU">Unité : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="uniteU" id="uniteU" required>
                                    <option id="uniteUO"></option>
                                    <?
                                    foreach ($unites as $unite) {
                                        ?>
                                    <option>
                                        <? echo $unite['description']; ?>
                                    </option>
                                    <? } ?>


                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="type_artU">Type Article : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="Non Consommable" disabled>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="categorieU">Categorie : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="categorieU" id="categorieU" required>
                                    <option id="categorieUO"></option>
                                    <?
                                    foreach ($Categories as $Categorie) {
                                        ?>
                                    <option>
                                        <? echo $Categorie['description']; ?>
                                    </option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="ninventaireU">N° D'inventaire : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control ninventaire" placeholder="0000-AA-YYYY" id="ninventaireU" name="ninventaireU" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateAU"><i class="fal fa-check"></i> Modifier</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- fin model add -->
    <!--delete Fournisseur-->
    <div class="modal fade" id="deleteM" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align text-danger">× Supprimer Article</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette Article : <span id="datanom"></span> </div>
                </div>
                <form action="../config/articles-n.php" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="idDM" id="idDM">
                        <button type="submit" name="submitDM" class="btn btn-danger"><i class="fal fa-check"></i> Oui</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Non</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- fin model delete Fournisseur-->
    <?
        include '../inculde/js.php' ;
    ?>
    <script src="/js/jquery.mask.js"></script>
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
                alertify.log('Article bien éte Modifier');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
    ?>
    <script>
        $(document).ready(function() {
            $('.ninventaire').mask('AAAA-SS-YYYY', {
                'translation': {
                    A: {
                        pattern: /[0-9]/
                    },
                    S: {
                        pattern: /[A-Za-z]/
                    },
                    Y: {
                        pattern: /[0-9]/
                    }
                }
            });



            // deleteCours
            $(".btndelete").click(function() {
                $id = $(this).attr("data-id");
                $nom = $(this).attr("data-nom");
                $("#idDM").val($id);
                $("#datanom").text($nom);
            });
            // change option
            /* $("#unite").change(function() {
                if ($("#unite").val() == 'Autres') {
                    $("#TAutres").show(150);
                } else {
                    $("#TAutres").hide(150);
                    $("#AValO").hide();
                }
            });
            $("#TAutres").change(function() {
                $VAutres = $(this).val();
                $("#AValO").show();
                $("#AValO").val($VAutres);
                $('#AValO').attr('selected', 'selected');
            });
   */
            $("#homeSubmenu").addClass('show');
            $("#homeSubmenu .sidebarNC").addClass('active');

            $(".btnUpdateM").click(function() {
                $('#UpdateM').trigger("reset");
                $id_arU = $(this).attr("data-id");
                $datas = {
                    "Action": "getArticlesAjax",
                    "id_arU": $id_arU
                };
                $.post("../config/articles-n.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#id_arU").val(getdats['id']);
                    $("#des_artU").val(getdats['des_art']);
                    $("#uniteUO").html(getdats['unite']);
                    $("#categorieUO").html(getdats['categorie']);
                    $("#ninventaireU").val(getdats['ninventaire']);
                });

            });
        });

    </script>
</body>


</html>
