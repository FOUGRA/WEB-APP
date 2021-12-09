<!DOCTYPE html>
<html class="no-js" lang="fr">

<head>
    <?
        include 'inculde/head.php' ;
    ?>
    <link rel="stylesheet" href="/css/logincss.css">
</head>

<body>
    <div id="spinnerA"></div>
    <div class="container">
        <div class="card card-container"> <img id="profile-img" class="profile-img-card" width="100" src="/img/favicon/logo.png" alt="logo fsj" />
            <h4><i class="fad fa-layer-group"></i> Gestion du stock</h4>
            <div id="message" class="none">
                <div class="alert alert-danger"> <i class="fal fa-exclamation-square"></i> Identifiant ou Mot de passe incorrect !! </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fal fa-user-crown"></i></span> </div>
                <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Identifiant" required autofocus>


            </div>
            <div id="loginempty" class="none red"><i class="fad fa-exclamation-circle"></i> Ajouter un identifiant ! </div>
            <div class="input-group">
                <div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1"><i class="fal fa-key"></i></span> </div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
            </div>
            <div id="passwordempty" class="none red"><i class="fad fa-exclamation-circle"></i> Ajouter un Mot de passe ! </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" id="submitLogin" name="submitLogin">Connexion</button>
            <!-- /form -->
        </div>
        <!-- /card-container -->
    </div>
    <!-- /container -->

    <script src="/js/jquery-1.11.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#submitLogin").click(function() {
                $identifiant = $("#identifiant").val().trim();
                $password = $("#password").val().trim();
                /* ******** Test Identifiant Empty ******* */
                if ($identifiant == "") {
                    $("#identifiant").addClass('error');
                    $("#loginempty").show(200);
                } else {
                    $("#identifiant").removeClass('error');
                    $("#loginempty").hide(200);
                }
                /* ******** Test Password Empty ******* */
                if ($password == "") {
                    $("#password").addClass('error');
                    $("#passwordempty").show(200);
                } else {
                    $("#password").removeClass('error');
                    $("#passwordempty").hide(200);
                }
                /* ******** Test chel auth admin ******* */
                if ($identifiant != "" && $password != "") {
                    $.ajax({
                        url: 'LPABD_FOUGRA_SAADOUN/config/login.php',
                        type: 'post',
                        data: {
                            identifiant: $identifiant,
                            password: $password
                        },
                        success: function(response) {
                            $msg = "";
                            if (response == 1) {
                                window.location = "LPABD_FOUGRA_SAADOUN/dashboard";
                            } else {
                                $msg = "Invalid <b>username</b> and password ! ";
                                $("#message").show(200);
                                $("#identifiant").addClass('error');
                                $("#password").addClass('error');
                            }
                        }
                    });
                }
            });
            /* load */
            $(window).load(function() {
                $("#spinner").fadeOut("slow");
            });
        });

    </script>
</body>

</html>
