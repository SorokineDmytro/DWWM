<div class="w80 m-auto print-area">
    <h1 class="titre">LISTE TIERS</h1>
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
                <th>NOM</th>
                <th class="w30">ADRESSE</th>
            </tr>
        </thead>
        <tbody id="tbody_tiers">

        </tbody>
        <tfoot id="tfoot_tiers">
            <tr class="bg-main-color">
                <th id="tfoot_th_tiers" colspan="4"></th>
            </tr>
        </tfoot>
    </table>
</div>

<div id="form-tiers" class="modal hide">
    <div class="modal-content">
        <h1 class="titre">SAISIE TIERS</h1>
        <div class="line-input">
            <label for="id" class="lab20">ID</label>
            <input type="text" id="id" class="w70" name="id" value=""></input>
        </div>
        <div class="line-input">
            <label for="numTiers" class="lab20">CODE</label>
            <input type="text" id="numTiers" class="w70" name="numTiers" value=""></input>
        </div>
        <div class="line-input">
            <label for="nomTiers" class="lab20">NOM</label>
            <input type="text" id="nomTiers" class="w70" name="nomTiers" value=""></input>
        </div>
        <div class="line-input">
            <label for="adresseTiers" class="lab20">ADRESSE</label>
            <input type="text" id="adresseTiers" class="w70" name="adresseTiers" value=""></input>
        </div>
        <div class="line-button">
            <a href="#" class="button-action bg-red" onclick="fermerModal()"><i class="fas fa-ban mr-2"></i>Annuler</a>
            <a href="#" id="valider" class="button-action bg-green" onclick="enregistrer()"><i class="fas fa-check mr-2"></i>Valider</a>
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
        document.location.href = "#form-tiers";
        viderModal();
        id.value = 0;
        protection(false);
        document.location.href = "#form-tiers";
        ouvrirModal();
    }

    function viderModal() {
        id.value = '';
        numTiers.value = '';
        nomTiers.value = '';
        adresseTiers.value = '';
    }
// ------------------------------------------AFFICHAGE------------------------------------
    function afficher() {
        const tiers_id = getIdChecked('choix');
        getTiers(tiers_id);
        protection(true);
        if (tiers_id !== 0) ouvrirModal();
    }
// -----------------------------------------MODIFICATION--------------------------------------
    function modifier() {
        const tiers_id = getIdChecked('choix');
        getTiers(tiers_id); 
        protection(false);
        if (tiers_id !== 0) ouvrirModal();
    }

    function enregistrer() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'tiers.php?action=update');
        let data = new FormData;
        data.append('id', id.value);
        data.append('numTiers', numTiers.value);
        data.append('nomTiers', nomTiers.value);
        data.append('adresseTiers', adresseTiers.value);
        xhr.send(data);

        xhr.onload = function() {
            let response = xhr.responseText;
            alert(response);
            document.location.href='tiers.php';
        }
    }

// -----------------------------------------SUPPRESSION--------------------------------------
    function supprimer() {
        const tiers_id = getIdChecked('choix');
        if(tiers_id == 0) {
            alert('Veuillez selectionner une ligne!');
            return;
        }
        // confirmation de suppression
        const confirmation = confirm(`Vous êtes bien sûr de supprimer le tiers id = ${tiers_id}`);
        if(!confirmation){
            return;
        }
        // body de la fonctionne départ
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'tiers.php?action=delete');
        let data = new FormData;
        data.append('id', tiers_id);
        xhr.send(data);
        // body de la fonctionne recuperation avec la fonction flechette
        xhr.onload = () => {
            let response = xhr.responseText;
            alert(response);
            document.location.href='tiers.php';
        }
    }

// ---------------------------------------SORTIE----------------------------------------

    function quitter() {
        document.location.href = "index.php";
    }

// ---------------------------------AUTRES FONCTIONS----------------------------------------------
    function getTiers(tiers_id) {
        if(tiers_id == 0) {
            alert('Veuillez selectionner une ligne!');
            return;
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `tiers.php?action=show&id=${tiers_id}`);
        xhr.send();

        xhr.onload = function() {
            let response = xhr.responseText;
            const tiers = JSON.parse(response);
            id.value = tiers.id;
            numTiers.value = tiers.numtiers;
            nomTiers.value = tiers.nomtiers;
            adresseTiers.value = tiers.adressetiers;
            document.location.href = "#form-tiers";
        }
    }

    function protection(etat) {
        id.disabled = true;
        numTiers.disabled = etat;
        nomTiers.disabled = etat;
        adresseTiers.disabled = etat;
        if (etat == true) {
            valider.style.display="none";
        };
    }

    function chercher() {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'tiers.php?action=search');
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
                        <td class='w15 center'><label for='${row.id}'>${row.numtiers}</label></td>
                        <td style='padding-left:10px;'><label for='${row.id}'>${row.nomtiers}</label></td>
                        <td class='w30 left' style='padding-left:10px;'>${row.adressetiers}</td>
                    </tr>`
            })
            tbody_tiers.innerHTML = html;
            tfoot_th_tiers.innerHTML = `Nombre tiers: ${nbre}`;
            mot.value = '';
        }
    }

    function handleClick(event) {
        event.preventDefault('click')
    }

    function ouvrirModal() {
        handleClick(event);
        const modal = document.getElementById('form-tiers');
        modal.classList.remove('hide');
    }

    function fermerModal() {
        handleClick(event);
        const modal = document.getElementById('form-tiers');
        modal.classList.add('hide');
    }
    
</script>
