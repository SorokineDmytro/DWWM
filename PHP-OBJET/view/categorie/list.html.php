<div class="w90 m-auto form-container">
    <h1 class="titre bg-dark">LISTE DES CATEGORIE</h1>
    <div class="line-button d-print-none">
        <button class="btn btn-md btn-primary" onclick="creer()">Créer</button>
        <button class="btn btn-md btn-success" onclick="afficher()">Afficher</button>
        <button class="btn btn-md btn-primary" onclick="modifier()">Modifier</button>
        <button class="btn btn-md btn-danger" onclick="supprimer()">Supprimer</button>
        <button class="btn btn-md btn-primary" onclick="imprimer()">Imprimer</button>
        <button class="btn btn-md btn-primary" onclick="quitter()">Quitter</button>
    </div>
    <table class="w-100 scroll">
        <thead>
            <tr class="bg-success text-light">
                <th class="text-center py-2 w5 border border-light"><input type="checkbox"></th>
                <th class="text-center py-2 w10 border border-light">ID</th>
                <th class="text-center py-2 w15 border border-light">PREFIXE</th>
                <th class="text-center py-2 w40 border border-light">LIBELLE</th>
                <th class="text-center py-2 w15 border border-light">NUMERO INITIAL</th>
                <th class="text-center py-2 w15  border border-light">FORMAT</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $categorie) : ?>
                <tr>
                    <td class="px-2 w5 text-center"><input type="checkbox" id="<?=$categorie->getId()?>" name="choix" onclick="onlyOne(this)"></td>    
                    <td class="px-2 w10 text-center"><?=$categorie->getId()?></td>
                    <td class="px-2 w15 text-center"><?=$categorie->getPrefixe()?></td>
                    <td class="px-2 w40 text-start"><?=$categorie->getLibelle()?></td>
                    <td class="px-2 w15 text-end"><?=$categorie->getNumeroInitial()?></td>
                    <td class="px-2 w15  text-center"><?=$categorie->getFormat()?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="bg-success text-light">
                <th class="text-center py-2" colspan="6">Nombre de categorie: <?=count($categories)?> </th>
            </tr>
        </tfoot>
    </table>
</div>

<script>
    function chercher() {
        document.location.href=`index.php?url=categorie&action=search&mot=${mot.value}`;
    }

    function quitter() {
        document.location.href="index.php?url=accueil";
    }

    function imprimer() {
        window.print();
    }

    function supprimer() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à supprimer");
            return;
        }
        const response = confirm("Voulez-vous vraiment supprimer cette ligne?");
        if(response) {
            document.location.href=`index.php?url=categorie&action=delete&id=${id}`;
        }
    }

    function afficher() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à afficher");
            return;
        }
        const url = `index.php?url=categorie&action=read&id=${id}`;
        const w = screen.width*0.60;
        const h = screen.height*0.60;
        popupCenter(url, `Affichage de la categorie id = ${id}`, w, h);
    }

    function creer() {
        document.location.href="index.php?url=categorie&action=create";
    }

    function modifier() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à modifier");
            return;
        }
        document.location.href=`index.php?url=categorie&action=update&id=${id}`;
    }
</script>