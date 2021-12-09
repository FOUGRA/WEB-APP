<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='unites';
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
                <h4 class="titreTabs"><i class="fab fa-uniregistry"></i> Gestion des unites </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter unité</button>
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
                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_unites order by id desc";
                              $unites = $db->query($query);
                                foreach ($unites as $unite) {
                                        ?>
                        <tr>

                            <td>
                                <? 
                              echo $unite['id'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $unite['description'];
                            ?>
                            </td>
                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $unite['id']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>
                                <?


                                ?>
                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-id="<?php  echo $unite['id']; ?>" data-nom="<?php  echo $unite['description']; ?>" data-target="#deleteM">
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
                    <h5 class="modal-title custom_align text-success"><i class="far fa-plus"></i> Ajouter Unité</h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/unite.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="descUnite">Description : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="descUnite" name="descUnite" placeholder="Description Categorie" required>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddUnite"><i class="fal fa-check"></i> Ajouter</button>
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
                    <h5 class="modal-title custom_align text-primary"><i class="fal fa-edit"></i> Modifier Unité</h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/unite.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="descUniteU">Description : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="descUniteU" name="descUniteU" required>
                                <input type="hidden" value="" id="idUnite" name="idUnite">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateUnite"><i class="fal fa-check"></i> Modifier</button>
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
                    <h4 class="modal-title custom_align text-danger">× Supprimer Unité</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette Unité : <span id="datanom"></span> </div>
                </div>
                <form action="../config/unite.php" method="post">
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
                alertify.error('Categorie supprimé avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('Categorie Ajouté avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('Categorie bien éte Modifier');
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

            $(".btnUpdateM").click(function() {
                $('#UpdateM').trigger("reset");
                $id_fr = $(this).attr("data-id");
                $datas = {
                    "Action": "getCatAjax",
                    "id": $id_fr
                };
                $.post("../config/unite.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#idUnite").val(getdats['id']);
                    $("#descUniteU").val(getdats['description']);
                });

            });
        });

    </script>
</body>


</html>
