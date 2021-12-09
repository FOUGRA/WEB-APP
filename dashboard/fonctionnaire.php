<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='fonctionnaire';
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
                <h4 class="titreTabs"><i class="fad fa-home"></i> Fonctionnaires </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter Fonctionnaire</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloccentent">

                <table class="table tabledetaillevoyage" id="cart">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Tél.</th>
                            <th>Services</th>
                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_fonctionnaires order by id desc";
                              $fonctionnaires = $db->query($query);
                                foreach ($fonctionnaires as $fonctionnaire) {
                                        ?>
                        <tr>

                            <td>
                                <? 
                              echo $fonctionnaire['id'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $fonctionnaire['nom_fc'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $fonctionnaire['tel'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $fonctionnaire['service'];
                            ?>
                            </td>
                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $fonctionnaire['id']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>
                                <?
                                ?>
                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-id="<?php  echo $fonctionnaire['id']; ?>" data-nom="<?php  echo $fonctionnaire['nom_fc']; ?>" data-target="#deleteM">
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
                    <h5 class="modal-title custom_align text-success"><i class="far fa-plus"></i> Ajouter un Bon de Laivraison</h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/fonctionnaire.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="nom_fc">Nom : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nom_fc" name="nom_fc" placeholder="Nom Fonctionnaire" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="tel">Tél : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="tel" name="tel" placeholder="Tél Fonctionnaire" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="nom_fc">Service : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="service" name="service" placeholder="Service Fonctionnaire" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddFC"><i class="fal fa-check"></i> Ajouter</button>
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
                    <h5 class="modal-title custom_align text-primary"><i class="fal fa-edit"></i> Modifier cette Fournisseur </h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/fonctionnaire.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="nom_fcU">Nom : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nom_fcU" name="nom_fcU" required>
                                <input type="hidden" id="idFC" name="idFC" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="telU">Tél : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="telU" name="telU" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="serviceU">Service : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="serviceU" name="serviceU" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateFC"><i class="fal fa-check"></i> Modifier</button>
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
                    <h4 class="modal-title custom_align text-danger">× Supprimer Fonctionnaires</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette Fonctionnaire : <span id="datanom"></span> </div>
                </div>
                <form action="../config/fonctionnaire.php" method="post">
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
                alertify.error('Fonctionnaires supprimé');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('Fonctionnaires Ajouté');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('Fonctionnaires Modifier');
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
                    "Action": "getFCAjax",
                    "id": $id_fr
                };
                $.post("../config/fonctionnaire.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#idFC").val(getdats['id']);
                    $("#nom_fcU").val(getdats['nom_fc']);
                    $("#telU").val(getdats['tel']);
                    $("#serviceU").val(getdats['service']);

                });

            });
        });

    </script>
</body>


</html>
