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
                <h4 class="titreTabs"><i class="fal fa-shipping-fast"></i> Tous les bon de sortie</h4>
                >
            </div>
            <div class="bloccentent">
                <div id="cart_wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="/dashboard/bon-s.php"><i class="fal fa-person-dolly"></i> Faire un bon de sortie</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/dashboard/ts-bon-s.php"><i class="fal fa-shipping-fast"></i> Tous les bon de sortie</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <table class="table tabledetaillevoyage" id="cart">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Fonctionaire</th>
                            <th>Date Ajout</th>
                            <th class="right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                              $query = "SELECT * FROM fsj_bs order by id_bs desc";
                              $bss = $db->query($query);
                                foreach ($bss as $bs) {
                                   $id_fcs= $bs['id_fonctionaire'];
                                     $querys = "SELECT * FROM fsj_fonctionnaires where id='$id_fcs'";
                                                $result = $db->query($querys);
                                                $row=mysqli_fetch_array($result);
                                        ?>
                        <tr>

                            <td>
                                <? 
                              echo $bs['id_bs'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $row['nom_fc'];
                            ?>
                            </td>
                            <td>
                                <? 
                              echo $bs['date_ajout'];
                            ?>
                            </td>
                            <td class="right">


                                <span class="inlineblock primary" data-toggle="tooltip" data-placement="top" title="Afficher">
                                    <form action="/dashboard/bs-print.php" method="post">
                                        <input type="hidden" name="id_bs" value="<?php  echo $bs['id_bs']; ?>">
                                        <button class="deletebtn btn btn-warning btn-xs btnUpdateM" type="submit" name="afficherBS"><i class="fal fa-eye"></i>
                                        </button>
                                    </form>
                                </span>


                                <span class="inlineblock" data-toggle="tooltsip" data-placement="top" title="Supprimer">
                                    <a class="deletebtn btn btn-danger btn-xs btndelete" data-toggle="modal" data-id="<?php  echo $bs['id_bs']; ?>" data-target="#deleteM">
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
    <div class="modal fade" id="deleteM" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align text-danger">× Supprimer Bon de Sortie</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fal fa-exclamation-circle"></i> Voulez-vous vraiment supprimer cette Bon de Sortie N°: <span id="datanom"></span> </div>
                </div>
                <form action="../config/bon-s.php" method="post">
                    <div class="modal-footer">
                        <input type="hidden" name="idDM" id="idDM">
                        <button type="submit" name="submitDM" class="btn btn-danger"><i class="fal fa-check"></i> Oui</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fal fa-times"></i> Non</button>
                    </div>
                </form>
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
                alertify.error('BS supprimé avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
        if(@$_GET['save']=='ok'){
            echo "
              <script>
                alertify.success('BS Ajouté avec Succès ');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
     if(@$_GET['saveU']=='ok'){
            echo "
              <script>
                alertify.success('BS bien éte Modifier');
                alertify.set({ delay: 2000 });
              </script>
            ";
        }
    ?>
    <script>
        $(document).ready(function() {

            $("#homeSubmenu2").addClass('show');
            $("#homeSubmenu2 .sidebarC").addClass('active');

            // deleteCours
            $(".btndelete").click(function() {
                $id = $(this).attr("data-id");

                $("#idDM").val($id);
                $("#datanom").text($id);
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
