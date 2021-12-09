<?php
   // echo 'PHP version: ' . phpversion();
    include '../config/connectOk.php' ;
    include '../config/db.php' ;
    $navleft='admins';
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
                <h4 class="titreTabs"><i class="fal fa-user-lock"></i> Gestion des Admins </h4>
                <div class="blocksearch">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="btn btnadd" type="button" data-toggle="modal" data-target="#addM"><i class="far fa-plus"></i> Ajouter admin</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloccentent">
                <div id="cart_wrapper">
                    <div class="col-sm-12">
                        <table class="tablep tabledetaillevoyage" id="cart">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom</th>
                                    <th>Login</th>
                                    <th>password</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                              $query = "SELECT * FROM fsj_admins order by id desc";
                              $admins = $db->query($query);
                                foreach ($admins as $admin) {
                                        ?>
                                <tr>

                                    <td>
                                        <? 
                              echo $admin['id'];
                            ?>
                                    </td>
                                    <td>
                                        <? 
                              echo $admin['nom'];
                            ?>
                                    </td>
                                    <td>
                                        <? 
                              echo $admin['login'];
                            ?>
                                    </td>
                                    <td>
                                        *********
                                    </td>

                                </tr>
                                <?  }  ?>


                            </tbody>

                        </table>



                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- model add Fournisseur -->
    <div class="modal fade" id="addM" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

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
    <!-- fin model delete Fournisseur-->
    <?
        include '../inculde/js.php' ;
    ?>
    <!--    // <script src="/js/alertify.js"></script>-->

    <script>
        $(document).ready(function() {

        });

    </script>
</body>


</html>
