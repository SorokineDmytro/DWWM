<div class="w90 m-auto form-container">
    <h1 class="titre"><?=$title?></h1>
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
                <th class="text-center py-2 w5 border border-light">ID</th>
                <th class="text-center py-2 w40 border border-light">CODE</th>
                <th class="text-center py-2 w50 border border-light">LIBELLE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($roles as $role) : ?>
                <tr>
                    <td class="px-2 w5 text-center"><input type="checkbox" id="<?=$role->getId()?>" name="choix" onclick="onlyOne(this)"></td>    
                    <td class="px-2 w5 text-center"><?=$role->getId()?></td>
                    <td class="px-2 w40 text-center"><?=$role->getCode()?></td>
                    <td class="px-2 w50 text-start"><?=$role->getLibelle()?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="bg-success text-light">
                <th class="text-center py-2" colspan="4">Nombre de roles : <?=count($roles)?></th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="public/js/myScript.js"></script>
<script>
    function creer() {
        document.location.href="index.php?url=role&action=create";
    }

    function afficher() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à afficher");
            return;
        }
        const url = `index.php?url=role&action=read&id=${id}`;
        const w = screen.width*0.60;
        const h = screen.height*0.60;
        popupCenter(url, `Affichage de la role id = ${id}`, w, h);
    }
    
    function modifier() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à modifier");
            return;
        }
        document.location.href=`index.php?url=role&action=update&id=${id}`;
    }

    function supprimer() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à supprimer");
            return;
        }
        const response = confirm("Voulez-vous vraiment supprimer cette ligne?");
        if(response) {
            document.location.href=`index.php?url=role&action=delete&id=${id}`;
        }
    }
</script>