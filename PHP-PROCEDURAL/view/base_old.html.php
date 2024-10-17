<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/style_old.css">
  <link rel="stylesheet" href="./public/fontawesome-free-6.5.0-web/css/all.css">
  <title><?=(isset($title))?$title : "Gestion Commerciale"?></title>
</head>
<body>
  <header>
    <h1>GESTION COMMERCIALE</h1>
    <div id="banner" class="center">
      <video src="./public/img/vid3.mp4" autoplay loop muted width="100%"></video>
    </div>
    <nav>
      <div id="menu-burger" class="menu-burger">
        <span id ="burger-elem-top" class="burger-elem-closed"></span>
        <span id ="burger-elem-mid" class="burger-elem-closed"></span>
        <span id ="burger-elem-bot" class="burger-elem-closed"></span>
      </div>
      <ul id="nav-list" class="class-list niveau-h1">
        <li><a href="index.php"><i class="fas fa-house-user mr-2"></i>Accueil</a></li>
        <li><a href="index.php?page=cv"><i class="fas fa-file mr-2"></i>Mon CV</a></li>
        <li><a href="index.php?page=portfolio"><i class="fas fa-image mr-2"></i>Mon Portfolio</a></li>
        <li><a href="article.php"><i class="fas fa-newspaper mr-2"></i>Article-AJAX</a>
        <li><a href="article-bis.php"><i class="fas fa-newspaper mr-2"></i>Article-FORM</a>
        <li><a href="produit.php"><i class="fas fa-box-archive mr-2"></i>Produit</a>
        </li>
        <li><a href="tiers.php"><i class="fas fa-user mr-2"></i>Tiers</a>
        </li>
        <li onclick="sousMenu(this)"><a href="#" id="commande" class="hasChildren"><i class="fas fa-boxes-packing mr-2"></i>Commande</a>
          <ul class="niveau-h2 hide">
            <li><a href="commande.php">Liste</a></li>
            <li><a href="#">Création</a></li>
            <li><a href="#">Statistique</a></li>
            <li><a href="commande.php">Toute commandes</a></li>
          </ul>
        </li>
        <li onclick="sousMenu(this)"><a href="#" id="parametres" class="hasChildren"><i class="fas fa-gear mr-2"></i>Parametres</a>
          <ul class="niveau-h2 hide">
            <li><a href="#">Utilisateur</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">Info</a></li>
            <li><a href="#">Groupe</a></li>
          </ul>
        </li>
      </ul>
      <div class="search-container">
        <input type="search" class="search-bar" placeholder="Mot à chercher" id="mot" name="mot" value="" onkeydown="touche(event)">
        <i class="fab fa-searchengin fa-2x mr-2" onclick="chercher()"></i>
        <a href="login.html" class="white">Se connecter</a>
      </div>
    </nav>
  </header>
<main>
  <aside class="aside-left">
    <div id="logo"></div>
    <div>
      <h2 class="center" id="menu">MENU</h2>
        <ul class="niveau-v1">
          <li><a href="#">Ouerture caisse</a></li>
          <li><a href="#">Fermeture caisse</a></li>
          <li><a href="#">Inventaire</a>
            <span class="fleche-bas white">&#9660</span>
            <ul class="niveau-v2">
              <li><a href="#">Bière</a></li>
              <li><a href="#">Vin</a></li>
              <li><a href="#">Alcool</a></li>
              <li><a href="#">Cigarette</a></li>
            </ul>
          </li>
        </ul>
      </div>
  </aside>
  <section>
    <?=$content?>
  </section>
  <aside class="aside-right">
    <div id="image1" class="image"></div>
    <div id="image2" class="image"></div>
    <div id="image3" class="image"></div>
    <div id="image4" class="image"></div>
  </aside>
</main>
<footer>
  <h3 class="white">Copyright &copy DWWM-2024</h3>
</footer>
<div class="" id="attente">
  <img src="public/img/loader2.gif" alt="">
</div>
<script src="./public/js/myScript.js"></script>
<script>
  function touche(event) {
    if(event.keyCode == 13) {
      chercher();
    }
  }
</script>
</body>
</html>