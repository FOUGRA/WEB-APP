<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='stocks';
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
                <h4 class="titreTabs"><i class="fad fa-layer-group"></i> Gestion du Stocks </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter Article au Stocks</button>
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
                            <th>Quantité</th>
                            <th>Unité</th>
                            <th>Type Article</th>
                            <th>Catégorie</th>
                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_stocks order by id_s desc";
                              $Stocks = $db->query($query);
                                foreach ($Stocks as $Stock) {
                                   
                                    $id_ar =  $Stock['id_ar'];
                              $queryA = "SELECT * FROM fsj_articles where id_ar='$id_ar'";
                              $articles = $db->query($queryA);
                                   $article= mysqli_fetch_array($articles);
                            $alert= $article['alert'];
                            $qte= $Stock['qte'];
                                        ?>


                        <tr <? if($qte <=$alert ){ echo "class='alerttr';" ; } ?>>
                            <td>
                                <? 
                              echo $Stock['id_s'];
                            ?>
                            </td>

                            <td>
                                <? 
                              echo $article['des_art'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $Stock['qte'];
                            ?>
                            </td>

                            <td>
                                <? 
                              echo $article['unite'];
                            ?>
                            </td>

                            <td>
                                <? 
                               echo  $article['type_art'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $article['categorie'];
                            ?>
                            </td>

                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $Stock['id_s']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>
                                <?


                                ?>
                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-nom="<?php  echo $article['des_art']; ?>" data-id="<?php  echo $Stock['id_s']; ?>" data-target="#deleteM">
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
                    <h5 class="modal-title custom_align text-success"><i class="far fa-plus"></i> Ajouter un Article au stocks</h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/stocks.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="articles">Articles : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="articles" id="articles" required>
                                    <option value="" selected disabled>Sélectionner l'Articles</option>
                                    <?
                                        $query = "SELECT * FROM fsj_articles";
                                        $articles = $db->query($query);
                                        foreach ($articles as $article) {
                                    ?>
                                    <option value="<? echo $article['id_ar'];?>">
                                        <? echo $article['des_art'];?>
                                    </option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="qte">Quantité : <span class="oblig">*</span></label>
                            <div class="col-sm-8">

                                <input type="number" min="1" class="form-control" id="qte" name="qte" placeholder="Quantité" required>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddS"><i class="fal fa-check"></i> Ajouter</button>
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
                    <h5 class="modal-title custom_align text-primary"><i class="fal fa-edit"></i> Modifier Stocks </h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/stocks.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="desctAr">Articles : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="hidden" class="form-control" id="id_sU" name="id_sU">
                                <input type="text" class="form-control" id="desctAr" name="desctAr" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="qteU">Quantité : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control" id="qteU" name="qteU" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateS"><i class="fal fa-check"></i> Modifier</button>
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
                <form action="../config/stocks.php" method="post">
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
    <!--    // <script src="/js/alertify.js"></script>-->
    <?

    
        if(@$_GET['saveD']=='ok'){
            echo "
              <script>
                alertify.error('Article supprimé au stocks');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('Article Ajouté avec Succès au Stocks ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
       if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.log('Stocks bien éte Modifier');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
    ?>
    <script>
        $(document).ready(function() {
            // deleteCours
            $(".btndelete").click(function() {
                $id = $(this).attr("data-id");
                $nom = $(this).attr("data-nom");
                $("#idDM").val($id);
                $("#datanom").text($nom);
            });
            // change option
            $("#unite").change(function() {
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

            $(".btnUpdateM").click(function() {
                $('#UpdateM').trigger("reset");
                $id_arU = $(this).attr("data-id");
                $datas = {
                    "Action": "getArticlesSAjax",
                    "id_s": $id_arU
                };
                $.post("../config/stocks.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#id_sU").val(getdats['id_sU']);
                    $("#desctAr").val(getdats['desctAr']);
                    $("#qteU").val(getdats['qte']);


                });

            });
        });

    </script>
</body>


</html>
