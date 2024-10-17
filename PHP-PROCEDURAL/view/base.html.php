<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./public/fontawesome-free-6.5.0-web/css/all.css">
  <link rel="stylesheet" href="./public/css/style.css">
  <title><?=isset($title)?$title:'Gestion commercial'?></title>
</head>
<body>
  <div class="container-fluid p-0">
    <header>
      <h1 class="text-center bg-dark text-light mb-0">GESTION COMMERCIAL</h1>
      <div id="banner">
        <video autoplay muted loop src="./public/img/vid3.mp4" width="100%"></video>
      </div>
      <nav class="navbar navbar-expand-md bg-dark text-light my-0">
        <a href="#" class="text-light mx-2"><i class="fa fa-laptop fa-2x"></i></a>
        <a href="#nav" class="btn bg-light text-dark mx-2 navbar-toggler" data-bs-toggle="collapse"><i class="fa fa-bars"></i></a>
        <div class="collapse navbar-collapse justify-content-between" id="nav">
          <ul class="nav navbar-nav">
            <li class="nav-item mx-2"><a href="" class="nav-link text-light fs-5"><i class="fas fa-house-user me-2"></i>Accueil</a></li>
            <li class="nav-item mx-2"><a href="" class="nav-link text-light fs-5"><i class="fas fa-newspaper me-2"></i>Article</a></li>
            <li class="nav-item mx-2"><a href="" class="nav-link text-light fs-5"><i class="fas fa-users me-2"></i>Tiers</a></li>
            <li class="nav-item mx-2 dropdown"><a href="" class="nav-link text-light fs-5 dropdown-toggle" 
              data-bs-toggle="dropdown"
              data-bs-auto-close="outside"><i class="fas fas fa-boxes-packing me-2"></i>Commande</a>
              <ul class="dropdown-menu bg-dark border-light">
                <li class="dropend nav-item mx-2"><a href="" class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown">Vente</a>
                  <ul class="dropdown-menu ms-2 bg-dark border-light">
                    <li class="nav-item mx-2"><a href="" class="nav-link text-light">Au comptant</a></li>
                    <li class="nav-item mx-2"><a href="" class="nav-link text-light">Á crédit</a></li>
                    <li class="nav-item mx-2"><a href="" class="nav-link text-light">Offerte</a></li>
                  </ul>
                </li>
                <li class="nav-item mx-2"><a href="" class="nav-link text-light">Appro</a></li>
                <li class="nav-item mx-2"><a href="" class="nav-link text-light">Interne</a></li>
              </ul>
            </li>
            <li class="nav-item mx-2"><a href="" class="nav-link text-light fs-5"><i class="fas fas fa-gear me-2"></i>Parametre</a></li>
          </ul>
          <div class="d-flex position-relative">
            <a href="" class="nav-link text-light dropdown-toggle fs-5 my-1 mx-2" 
            data-bs-toggle="dropdown"><i class="fa fa-bell"></i><sup id="id_nonLu"></sup></a>
            <ul class="dropdown-menu w100">
              <li class="nav-item w100">
                <table class="w100 scroll-sm">
                  <thead>
                    <tr class="bg-success text-light">
                      <th class="border border-white w20 text-center">Auteur</th>
                      <th class="border border-white w30 text-center">Message</th>
                      <th class="border border-white w20 text-center">File</th>
                      <th class="border border-white w20 text-center">Date</th>
                      <th class="border border-white w10 text-center">Lu<input type="checkbox" id="allCheck" name="allCheck" class="mx-2"></th>
                    </tr>
                  </thead>
                  <tbody id="tbody_message">
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="w20"><input type="text" id="auteur" name="auteur" class="form-control mx-1" onkeydown="touche1(event)"></td>
                      <td class="w30"><input type="text" id="message" name="message" class="form-control mx-2" autocomplete="off" onkeydown="touche2(event)"></td>
                      <td colspan="2" class="w20"><input type="file" id="file" name="file" class="form-control mx-2"></td>
                      <td class="w10 text-center"><button class="btn btn-sm btn-primary w70" onclick="envoyerMessage()"><i class="fa fa-paper-plane"></i></button></td>
                    </tr>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
              </li>
            </ul>
            <button id="etat" class="border-0" onclick="changerEtat()"></button>
            <div class="input-group">
              <input type="search" onkeydown="touche(event)" id="mot" name="mot" class="form-control" autocomplete="off" placeholder="Mot à chercher">
              <button class="btn bg-white" onclick="chercher(event)"><i class="fa fa-search text-dark"></i></button>
              <a href="" class="nav-link text-light fs-5 mx-3 my-1"><i class="fa fa-user mx-2"></i>Se connecter</a>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <main class="container-fluid p-0">
      <div class="row w-100">
        <aside class="col-md-2 px-0 bg-light px-auto">
          <div class="logo text-center my-5 mx-auto">
            <img src="./public/img/afpa.png" alt="" class="w-75 h-75">
          </div>

          <div class="accordion ms-4" id="accordionExample">
            <div class="accordion-item mx-auto text-center">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button ps-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  MENU
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body border-bottom">
                  <a href="#">Ouverture caisse</a>
                </div>
                <div class="accordion-body border-bottom">
                  <a href="#">Fermeture caisse</a>
                </div>
                <div class="accordion-body">
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item text-center">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChild" aria-expanded="true" aria-controls="collapseChild">
                          Inventaire
                        </button>
                      </h2>
                      <div id="collapseChild" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#headingOne">
                        <div class="accordion-body">
                          <a href="#">Biere</a>
                        </div>
                        <div class="accordion-body">
                          <a href="#">Vin</a>
                        </div>
                        <div class="accordion-body">
                          <a href="#">Alcool</a>
                        </div>
                        <div class="accordion-body">
                          <a href="#">Sigarette</a>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>

        </aside>
        <section class="col-md-8 bg-light">
          <?=$content?>
        </section>
      
        <aside class="col-md-2 px-0 bg-light">
          <div class="gallery w-100 text-center">
            <img src="./public/img/worker1.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker2.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker3.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker4.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker5.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker6.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker7.jpg" alt="" class=".img-fluid rounded mt-5 w90">
            <img src="./public/img/worker8.jpg" alt="" class=".img-fluid rounded mt-5 w90">
          </div>
        </aside>
      </div>
    </main>
    <footer class="bg-dark text-light d-flex justify-content-center align-items-center">
      <h2  class="fs-6">Copyright &copy DWWM-2024</h2>
    </footer>
  </div>
  <div id="attente">
    <img src="./public/img/loader2.gif" alt="">
  </div>

  <script src="./public/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
  <script src="./public/js/myScript.js"></script>
  <script>

    function touche1(event) {
      if(event.keyCode==13){
        message.focus();
      }
    }

    function touche2(event) {
      if(event.keyCode==13){
        envoyerMessage();
      }
    }

    function getMessage() {
      fetch("index.php?url=accueil&page=message_read")
      .then(response => response.json())
      .then(response => {
        let html = '';
        const nonLu = response.nonLu;
        let messages = response.messages;
        messages = messages.reverse(); //inverser l'ordre de tableau
        messages.forEach(message => {
          const fichier = (message.file)?`<a href="./public/file/${message.file}" download><i class="fas fa-paperclip"></i></a>`:'';
          let color = (!message.lu)?'text-danger':'';
          html += `
            <tr class="${color}">
              <td class="w20 ps-2">${message.auteur}</td>
              <td class="w30 ps-2">${message.message}</td>
              <td class="w20 ps-2 text-center">${fichier}</td>
              <td class="w20 ps-2 text-center date">${message.reception}</td>
              <td class="w10 text-center"><input type="checkbox" id=${message.id} name="lu"></td>
            </tr>
          `
        });
        if(nonLu != 0) {
          id_nonLu.innerHTML = `(${nonLu})`;
        } else {
          id_nonLu.innerHTML = '';
        }
        tbody_message.innerHTML = html;
        tbody_message.scrollTop = tbody_message.scrollHeight;
        hideLoader();
      })
    }
    getMessage();
    window.setInterval(verifierEtat,5000);

    function verifierEtat() {
      if(etat.classList.contains('bg-success')){
        getMessage();
      }
    }

    function envoyerMessage() {
      showLoader();
      let lus = [];
      let elements = document.getElementsByName('lu');
      elements.forEach((element) => {
        if(element.checked == true) {
          lus.push(element.id);
        } 
      })
      let data = new FormData();
      data.append('auteur', auteur.value);
      data.append('message', message.value);
      data.append('file', file.files[0]);
      data.append('lus', JSON.stringify(lus));
      fetch("index.php?url=accueil&page=message_write", {
        method : "POST",
        body : data
      })
      .then(response => response.text())
      .then(response => {
        message.value = '';
        getMessage();
    })
      .catch(function(error) {
        console.log(error);
        alert("Il existe une erreur!");
      })
    }

    function changerEtat() {
      etat.classList.toggle("bg-success");
    }

    allCheck.addEventListener('change', function() {
    let checkboxes = document.getElementsByName('lu');
    checkboxes.forEach((checkbox) => checkbox.checked = this.checked);
    });

  </script>
</body>
</html>