<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='bon-l';
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
                <h4 class="titreTabs"><i class="fal fa-file-alt"></i> Bon de Laivraison </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter un Bon de Laivraison</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloccentent">

                <table class="table tabledetaillevoyage" id="cart">
                    <thead>
                        <tr>
                            <th>N° Bon</th>
                            <th>Fournisseur</th>
                            <th>Type Bon</th>
                            <th>Date Ajout</th>
                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_bon order by id_bon desc";
                              $bons = $db->query($query);
                                foreach ($bons as $bon) {
                                        ?>
                        <tr>

                            <td>
                                <? 
                              echo $bon['num_bon'];
                            ?>
                            </td>
                            <td>
                                <? 
                                   $id_fr = $bon['id_fr'];
                                    $queryf = "SELECT * from fsj_fournisseurs where id_fr='$id_fr' limit 1";
                                    $FourniseursbyId = $db->query($queryf);
                                    $FbyId=mysqli_fetch_row($FourniseursbyId);
                                    echo $FbyId[1];
                                ?>
                            </td>
                            <td>
                                <? 
                                  echo $bon['type_bon'];
                                ?>
                            </td>
                            <td>
                                <? 
                               echo  $bon['date_ajout'];
                            ?>
                            </td>
                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $bon['id_bon']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>
                                <?


                                ?>
                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-id="<?php  echo $bon['id_bon']; ?>" data-nom='<?php  echo $bon['num_bon']; ?>' data-target="#deleteM">
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
                <form class="form-horizontal" method="post" action="../config/bon-l.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="num_bon">N° de Bon : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="num_bon" name="num_bon" placeholder="Numero de bon" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="id_fr">Fournisseurs : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="id_fr" id="id_fr" required>
                                    <option value="" selected disabled>Sélectionner le Fournisseurs</option>
                                    <?
                                  $queryGF = "SELECT * FROM fsj_fournisseurs order by id_fr desc";
                                  $Fourniseurs = $db->query($queryGF);
                                    foreach ($Fourniseurs as $Fourniseur) {
                                        ?>
                                    <option value="<? echo $Fourniseur['id_fr']; ?>">
                                        <? echo $Fourniseur['res_soc']; ?>
                                    </option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="type_bon">Type Bon : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="type_bon" id="type_bon" required>
                                    <option value="" selected disabled>Sélectionner le Type</option>
                                    <option>Bon de Commande</option>
                                    <option>Marché</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddBon"><i class="fal fa-check"></i> Ajouter</button>
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
                    <h5 class="modal-title custom_align text-primary"><i class="fal fa-edit"></i> Modifier cette BL </h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/bon-l.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="num_bonU">N° de Bon : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="num_bonU" name="num_bonU" required>
                                <input type="hidden" id="id_bon" name="id_bon">
                                <input type="hidden" id="id_frU" name="id_frU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="nom_frU">Fournisseurs : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="nom_frU" id="nom_frU" required>
                                    <option id="nom_frUO" selected></option>
                                    <?
                                  $queryGF = "SELECT * FROM fsj_fournisseurs order by id_fr desc";
                                  $Fourniseurs = $db->query($queryGF);
                                    foreach ($Fourniseurs as $Fourniseur) {
                                        ?>
                                    <option value="<? echo $Fourniseur['id_fr']; ?>">
                                        <? echo $Fourniseur['res_soc']; ?>
                                    </option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="type_bonU">Type Bon : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="type_bonU" id="type_bonU" required>
                                    <option value="" selected disabled>Sélectionner le Type</option>
                                    <option>Bon de Commande</option>
                                    <option>Marché</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateBon"><i class="fal fa-check"></i> Modifier</button>
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
                    <h4 class="modal-title custom_align text-danger">× Supprimer BL</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette BL : <span id="datanom"></span> </div>
                </div>
                <form action="../config/bon-l.php" method="post">
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
                alertify.error('BL supprimé avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('BL Ajouté avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('BL bien éte Modifier');
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
