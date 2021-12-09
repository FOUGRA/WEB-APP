<!DOCTYPE html>
<html class="no-js" lang="fr">
<? 
  include "../config/connectOk.php";
?>

<head>
    <meta charset="UTF-8">
    <title>Faculté des sciences - Gestion du stock</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/favicon/favicon.ico">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <link rel="stylesheet" href="/css/stylenav.css">
</head>

<body>
    <div id="spinner"></div>
    <div class="container text-center">
        <div class="logoNav text-center">
            <img src="/img/favicon/logo.png" width="140" alt="logo sfj">
            <h4><i class="fad fa-layer-group"></i> Gestion de stock</h4>
        </div>
        <nav class="menu-navigation-icons">
            <a href="/dashboard/fournisseurs.php"><i class="fal fa-users"></i><span> Fournisseurs</span></a>
            <a href="/dashboard/bon-l.php"><i class="fal fa-file-alt"></i><span> Bon de Laivraison</span></a>
            <a href="/dashboard/articles.php"><i class="fal fa-cart-arrow-down"></i><span> Article</span></a>
            <a href="/dashboard/stocks.php"><i class="fad fa-layer-group"></i><span> Stocks</span></a>
            <a href="/dashboard/categories.php"><i class="far fa-cubes"></i><span> Categories</span></a>
            <a href="/dashboard/unites.php"><i class="fab fa-uniregistry"></i><span>Unites</span></a>
            <a href="/dashboard/fonctionnaire.php"><i class="fad fa-home"></i><span>Fonctionnaire</span></a>
            <a href="/dashboard/bon-s.php"><i class="fal fa-shipping-fast"></i><span> Bon de Sortie</span></a>
            <a href="/dashboard/admins.php"><i class="fal fa-user-lock"></i><span> Admins</span></a>
            <a href="/config/logout.php"><i class="far fa-power-off"></i><span> Déconnexion</span></a>
        </nav>
    </div>
    <div class="text-center" id="realiserPar">
        <span>Réaliser Par : <b>FOUGRA Mohamed</b>
            & <b>SAADOUNE Najib</b></span><br>
        <span><b><u>LP-ABD</u></b></span>
    </div>
    <script src="/js/jquery-1.11.0.min.js"></script>
    <script>
        $(window).load(function() {
            $("#spinner").fadeOut("slow");
        });

    </script>
</body>

</html>
