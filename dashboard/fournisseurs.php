<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='fournisseurs';
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
                <h4 class="titreTabs"><i class="fal fa-users"></i> Nos Fournisseurs </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter un Fournisseurs</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloccentent">

                <table class="table tabledetaillevoyage" id="cart">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Res_soc</th>
                            <th>Contact</th>
                            <th>Adresse</th>
                            <th>Email</th>
                            <th>Responsable</th>
                            <th>Ville</th>
                            <th>Observation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_fournisseurs order by id_fr desc";
                              $fornisseurs = $db->query($query);
                                foreach ($fornisseurs as $fornisseur) {
                                        ?>
                        <tr>
                            <td>
                                <? echo $fornisseur['id_fr'];?>
                            </td>
                            <td>
                                <? 
                              echo $fornisseur['res_soc'];
                            ?>
                            </td>
                            <td>
                                Tél. :
                                <? echo $fornisseur['tel'];?>
                                <br> Fax. :
                                <? if(empty($fornisseur['fax'])){
                                            echo '.. ..............';
                                           }else{
                                            echo $fornisseur['fax'];
                                  }
                                ?>
                            </td>
                            <td>
                                <? echo $fornisseur['adr_four'];?>
                            </td>
                            <td>
                                <? echo $fornisseur['email'];?>
                            </td>
                            <td>
                                <? 
                               echo  $fornisseur['responsable'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $fornisseur['ville'];
                            ?>
                            </td>
                            <td>
                                <? 
                               echo  $fornisseur['observation'];
                            ?>
                            </td>
                            <td class="right">
                                <span class="inlineblock primary" data-toggle="tooltssip" data-placement="top" title="Modifier">
                                    <a class="deletebtn btn btn-primary btn-xs btnUpdateM" data-toggle="modal" data-id="<?php  echo $fornisseur['id_fr']; ?>" data-target="#UpdateM">
                                        <i class="fal fa-edit"></i>
                                    </a>
                                </span>
                                <?
                                    $id_frc=$fornisseur['id_fr'];
                                   $query = "SELECT * from fsj_bon where id_fr='$id_frc'";  
                                    $chekBon = $db->query($query);
                                   if($chekBon->num_rows === 0) { 
                                    ?>
                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-id="<?php  echo $fornisseur['id_fr']; ?>" data-nom="<?php  echo $fornisseur['res_soc']; ?>" data-target="#deleteM">
                                        <i class="fal fa-trash-alt"></i>
                                    </a>
                                </span>
                                <?}?>
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
                    <h5 class="modal-title custom_align text-success"><i class="far fa-plus"></i> Ajouter un fournisseur </h5>
                </div>
                <form class="form-horizontal" method="post" action="../config/fournisseurs.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="res_soc">Res_soc : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="res_soc" name="res_soc" placeholder="Res_soc" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="tel">Tél. : </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="tel" name="tel" placeholder="Tél Fournisseur">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="fax">Fax. : </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="fax" name="fax" placeholder="Fax Fournisseur">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="adr_four">Adresse : </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="adr_four" name="adr_four" placeholder="Adresse fournisseur">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="email">Email : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email Fournisseur">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="responsable">Responsable : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Responsable">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="ville">Ville : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ville" name="ville" placeholder="ville Fournisseur">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="observation">Observation : </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="observation" name="observation" placeholder="Observation">
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="submitAddF"><i class="fal fa-check"></i> Ajouter</button>
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
                <form class="form-horizontal" method="post" action="../config/fournisseurs.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="res_socU">Res_soc : <span class="oblig">*</span></label>
                            <div class="col-sm-8">
                                <input type="hidden" id="idfU" name="idfU">
                                <input type="text" class="form-control" id="res_socU" name="res_socU" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="telU">Tél. : </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="telU" name="telU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="faxU">Fax. : </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="faxU" name="faxU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="adr_fourU">Adresse : </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="adr_fourU" name="adr_fourU">
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="emailU">Email : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="emailU" name="emailU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="responsableU">Responsable : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="responsableU" name="responsableU">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="villeU">Ville : </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="villeU" name="villeU">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="observationU">Observation : </label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" id="observationU" name="observationU">
                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" name="submitUpdateSQ"><i class="fal fa-check"></i> Modifier</button>
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
                    <h4 class="modal-title custom_align text-danger">× Supprimer Fournisseur</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette Fournisseur : <span id="datanom"></span> </div>
                </div>
                <form action="../config/fournisseurs.php" method="post">
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
                alertify.error('Fournisseur supprimé avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('Fournisseur Ajouté avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('Fournisseur bien éte Modifier');
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

            $(".btnadd").click(function() {
                $('#addM').trigger("reset");
                $('#adr_four').html("");
                $('#observation').html("");
            });
            $(".btnUpdateM").click(function() {
                $('#UpdateM').trigger("reset");
                $id_fr = $(this).attr("data-id");
                $datas = {
                    "Action": "getFrAjax",
                    "id_fr": $id_fr
                };
                $.post("../config/fournisseurs.php", $datas, function(datas) {
                    var getdats = $.parseJSON(datas);
                    $("#idfU").val(getdats['id_fr']);
                    $("#res_socU").val(getdats['res_soc']);
                    $("#telU").val(getdats['tel']);
                    $("#faxU").val(getdats['fax']);
                    $("#adr_fourU").val(getdats['adr_four']);
                    $("#emailU").val(getdats['email']);
                    $("#responsableU").val(getdats['responsable']);
                    $("#villeU").val(getdats['ville']);
                    $("#observationU").val(getdats['observation']);
                });

            });
        });

    </script>
</body>


</html>
