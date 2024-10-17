<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/style.css">
  <link rel="stylesheet" href="./public/fontawesome-free-6.5.0-web/css/all.css">
  <link rel="stylesheet" href="./public/bootstrap-5.3.3-dist/css/bootstrap.css">
  <title><?=(isset($title))?$title : "Gestion Commerciale"?></title>
</head>
<body>
<main class="w100">
  <section class="w100">
    <?=$content?>
  </section>
</main>
<script src="./public/js/myScript.js"></script>
<script src="./public/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script>
  function touche(event) {
    if(event.keyCode == 13) {
      chercher();
    }
  }
</script>
</body>
</html>