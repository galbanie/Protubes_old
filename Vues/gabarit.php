<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="<?= $realpath ?>Ressources/Images/favicon.ico">
        <link rel="icon" type="image/gif" href="<?= $realpath ?>Ressources/Images/animated_favicon1.gif">
        
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/base.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/style.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/header.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/main.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/pagination.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/Base/footer.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= $realpath ?>css/protubes-theme/jquery-ui-1.10.3.custom.min.css" media="all"/>
        
        <script src="<?= $realpath ?>js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="<?= $realpath ?>js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="<?= $realpath ?>js/protubes-jquery.js" type="text/javascript"></script>
        <script src="<?= $realpath ?>js/protubes.js" type="text/javascript"></script>
        <!--script type="text/javascript" src="Scripts/upload.js"></script-->
        <title><?= $titrePage ?></title>
    </head>
    <body>
        <header>
            <!-- Logo-->
            <div id="logo">
                <a href="index.php">
                    <img alt="Protubes." src="<?= $realpath ?>Ressources/Images/Logo/Logo-Protubes.png" />
                </a>
            </div>
            
            <div id="barreRecherche">
                <form method="get" action="">
                    <input type="search" name="search_query" />
                    <input id="btnSearchBarreRecherche" type="submit" value=""/>
                </form>
            </div>
            
            <div id="btn-uploadVideo">
                <form method="get" action="">
                    <input type="hidden" name="page" value="upload" />
                    <input type="submit" value="<?= $langBtn['upload'] ?>" />
                </form>
            </div>
            
            <div id="btn-espaceMembre">
                <?= $btnMembre ?>
            </div>
        </header>
        <div id="global">
            <div id="principal">
               <?php if(isset($gauche)) echo $gauche; ?>
               <?php if(isset($centre)) echo $centre; ?>
               <?php if(isset($droite)) echo $droite; ?>
               <hr class="clearfloatBoth" />
            </div>
        </div>
        <footer>
            <div id="div-langue">
                <form method="post" action="">
                    <input type="hidden" name="lang" value="fr" />
                    <input class="btn-lang-fr" type="submit" value="<?= $langBtn['fr'] ?>"/>
                </form>
                <form method="post" action="">
                    <input type="hidden" name="lang" value="en" />
                    <input class="btn-lang-en" type="submit" value="<?= $langBtn['en'] ?>"/>
                </form>
            </div>
            <div class="footer-div">
                <p id="footercopy">
                    <!--a href="http://www.galbaniestudios.com">Galbanie Studios</a--> <?= $langTexte['copydroit'] ?>.
                </p>
            </div>
        </footer>
    </body>
</html>
