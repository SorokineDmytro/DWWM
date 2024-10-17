<div class="w80 m-auto print-area">
    <h1 class="titre">LISTE ARTICLES</h1>
    <div class="line-button">
        <button class="w10 button-action bg-green" onclick="creer()"><i class="fas fa-folder-plus mr-2"></i>Créer</button>
        <button class="w10 button-action bg-green" onclick="afficher()"><i class="fas fa-eye mr-2"></i>Afficher</button>
        <button class="w10 button-action bg-navy" onclick="modifier()"><i class="fas fa-marker mr-2"></i>Modifier</button>
        <button class="w10 button-action bg-red" onclick="supprimer()"><i class="fas fa-trash mr-2"></i>Supprimer</button>
        <button class="w10 button-action bg-navy" onclick="window.print()"><i class="fas fa-print mr-2"></i>Imprimer</button>
        <button class="w10 button-action bg-main-color" onclick="quitter()"><i class="fas fa-house-chimney-user mr-2"></i>Quitter</button>
    </div>
    <table class="w100">
        <thead id="thead">
            <tr class="bg-main-color">
                <th class="w10"><input type="checkbox"></th>
                <th class="w15">CODE</th>
                <th>DESIGNATION</th>
                <th class="w10">PU</th>
                <th class="w10">PR</th>
            </tr>
        </thead>
        <tbody id="tbody_article">
           
        </tbody>
        <tfoot id="tfoot_article">
            <tr class="bg-main-color">
                <th id="tfoot_th_article" colspan="5"></th>
            </tr>
        </tfoot>
    </table>
</div>

<div id="form-article" class="modal hide">
    <div class="modal-content">
        <h1 class="titre">SAISIE ARTICLE</h1>
        <div class="line-input">
            <label for="id" class="lab20">ID</label>
            <input type="text" id="id" class="w70" name="id" value=""></input>
        </div>
        <div class="line-input">
            <label for="numArticle" class="lab20">CODE</label>
            <input type="text" id="numArticle" class="w70" name="numArticle" value=""></input>
        </div>
        <div class="line-input">
            <label for="designation" class="lab20">DESIGNATION</label>
            <input type="text" id="designation" class="w70" name="designation" value=""></input>
        </div>
        <div class="line-input">
            <label for="prixUnitaire" class="lab20">PU</label>
            <input type="text" id="prixUnitaire" class="w70" name="prixUnitaire" value=""></input>
        </div>
        <div class="line-input">
            <label for="prixRevient" class="lab20">PR</label>
            <input type="text" id="prixRevient" class="w70" name="prixRevient" value=""></input>
        </div>
        <div class="line-button">
            <a href="" class="button-action bg-red" onclick="fermerModal()"><i class="fas fa-ban mr-2"></i>Annuler</a>
            <a href="javascript:enregistrer()" id="valider" class="button-action bg-green"><i class="fas fa-check mr-2"></i>Valider</a>
        </div>
        <a href="" id="modal-close" onclick="fermerModal()">&times</a>
    </div>
</div>

<script>
document.body.onload=()=>{ // document.body.onload
        mot.value="";
        chercher();
    }
// -------------------------------------CREATION------------------------------------------
    function creer() {
        document.location.href = "#form-article";
        viderModal();
        id.value = 0;
        protection(false);
        document.location.href = "#form-article";
        ouvrirModal();
    }

    function viderModal() {
        id.value = '';
        numArticle.value = '';
        designation.value = '';
        prixUnitaire.value = 0.00;
        prixRevient.value = 0.00;
    }
// ------------------------------------------AFFICHAGE------------------------------------
    function afficher() {
        const article_id = getIdChecked('choix');
        getArticle(article_id);
        protection(true);
        ouvrirModal();
    }
// -----------------------------------------MODIFICATION--------------------------------------
    function modifier() {
        const article_id = getIdChecked('choix');
        getArticle(article_id); 
        protection(false);
        ouvrirModal();
    }

    function enregistrer() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'article.php?action=update');
        let data = new FormData;
        data.append('id', id.value);
        data.append('numArticle', numArticle.value);
        data.append('designation', designation.value);
        data.append('prixUnitaire', prixUnitaire.value);
        data.append('prixRevient', prixRevient.value);
        xhr.send(data);

        xhr.onload = function() {
            let response = xhr.responseText;
            alert(response);
            document.location.href='article.php';
        }
    }

// -----------------------------------------SUPPRESSION--------------------------------------
    function supprimer() {
        const article_id = getIdChecked('choix');
        if(article_id == 0) {
            alert('Veuillez selectionner une ligne!');
            return;
        }
        // confirmation de suppression
        const confirmation = confirm(`Vous êtes bien sûr de supprimer l'article id = ${article_id}`);
        if(!confirmation){
            return;
        }
        // body de la fonctionne départ
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'article.php?action=delete');
        let data = new FormData;
        data.append('id', article_id);
        xhr.send(data);
        // body de la fonctionne recuperation avec la fonction flechette
        xhr.onload = () => {
            let response = xhr.responseText;
            alert(response);
            document.location.href='article.php';
        }
    }

// ---------------------------------------SORTIE----------------------------------------

    function quitter() {
        document.location.href = "index.php";
    }

// ---------------------------------AUTRES FONCTIONS----------------------------------------------
    function getArticle(article_id) {
        if(article_id == 0) {
            alert('Veuillez selectionner une ligne!');
            return;
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `article.php?action=show&id=${article_id}`);
        xhr.send();

        xhr.onload = function() {
            let response = xhr.responseText;
            const article = JSON.parse(response);
            id.value = article.id;
            numArticle.value = article.numarticle;
            designation.value = article.designation;
            prixUnitaire.value = article.prixunitaire;
            prixRevient.value = article.prixrevient;
            document.location.href = "#form-article";
        }
    }

    function protection(etat) {
        id.disabled = true;
        numArticle.disabled = etat;
        designation.disabled = etat;
        prixUnitaire.disabled = etat;
        prixRevient.disabled = etat;
        if (etat == true) {
            valider.style.display="none";
        };
    }

    function chercher() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'article.php?action=search');
        let data = new FormData();
        data.append('mot', mot.value);
        xhr.send(data);

        xhr.onload = () => {
            const response = xhr.responseText;
            const rows = JSON.parse(response);
            const nbre = rows.length;
            let html = '';
            rows.forEach((row) => {
                html += `
                    <tr>
                        <td class='w10 center'><input type='checkbox' id='${row.id}' name='choix' onclick='onlyOne(this)'></td>
                        <td class='w15 center'><label for='${row.id}'>${row.numarticle}</label></td>
                        <td style='padding-left:10px;'><label for='${row.id}'>${row.designation}</label></td>
                        <td class='w10 right' style='padding-right:5px;'>${row.prixunitaire}</td>
                        <td class='w10 right' style='padding-right:5px;'>${row.prixrevient}</td>
                    </tr>`
            })
            tbody_article.innerHTML = html;
            tfoot_th_article.innerHTML = `Nombre articles: ${nbre}`;
            mot.value = '';
        }
    }
    function handleClick(event) {
        event.preventDefault('click')
    }

    function ouvrirModal() {
        handleClick(event);
        const modal = document.getElementById('form-article');
        modal.classList.remove('hide');
    }

    function fermerModal() {
        handleClick(event);
        const modal = document.getElementById('form-article');
        modal.classList.add('hide');
    }
    
</script>
