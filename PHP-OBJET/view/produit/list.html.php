<div class="w90 m-auto form-container">
    <h1 class="titre"><?=$title?></h1>
    <select name="categorie_id" id="categorie_id" onchange="showCategorie(event)" class="form-select w-100">
        <option value="0">Toute categories</option>
        <?php foreach($categories as $categorie) :?>
            <?php if($categorie_id==$categorie->getId()) :?>
                <option value="<?=$categorie->getLibelle()?>" selected ><?=$categorie->getLibelle()?></option>
            <?php else :?>
                <option value="<?=$categorie->getId()?>"><?=$categorie->getLibelle()?></option>
            <?php endif ?>
        <?php endforeach?>
    </select>
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
                <th class="text-center py-2 w10 border border-light">IMAGE</th>
                <th class="text-center py-2 w10 border border-light">CODE</th>
                <th class="text-center py-2 w45 border border-light">DESIGNATION</th>
                <th class="text-center py-2 w10 border border-light">PRIX UNITAIRE</th>
                <th class="text-center py-2 w10 border border-light">PRIX REVIENT</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produits as $produit) : ?>
                <tr>
                    <td class="px-2 w5 text-center"><input type="checkbox" id="<?=$produit->getId()?>" name="choix" onclick="onlyOne(this)"></td>    
                    <td class="px-2 w10 text-center"><?=$produit->getId()?></td>
                    <td class="px-2 w10 text-center"><img src="public/img/<?=$produit->getImage()?>" alt="" class="img-fluid"></td>
                    <td class="px-2 w10 text-center"><?=$produit->getNumProduit()?></td>
                    <td class="px-2 w45 text-start"><?=$produit->getDesignation()?></td>
                    <td class="px-2 w10 text-end"><?=$produit->getPrixUnitaire()?></td>
                    <td class="px-2 w10 text-center"><?=$produit->getPrixRevient()?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="bg-success text-light">
                <th class="text-center py-2" colspan="7">Page : <?=$page?> / <?=$np?> <br>
                Nombre de produit : <?=count($produits)?></th>
            </tr>
        </tfoot>
    </table>
    <div class="line-button d-flex justify-content-center align-items-center my-2">
        <?php for($i=1; $i<=$np; $i++) :?>
            <button class="btn btn-sm btn-primary mx-2" id="<?=$i?>" onclick="showPage(event)"><?=$i?></button>
        <?php endfor?>
    </div>
</div>

<script>

    function showPage(event) {
        const page = event.target.id;
        document.location.href=`index.php?url=produit&action=list&page=${page}&categorie_id=<?=$categorie_id?>&mot=<?=$mot?>`;
    }
    
    function chercher(event){
        document.location.href=`index.php?url=produit&action=list&page=1&categorie_id=<?=$categorie_id?>&mot=${mot.value}`;
    }

    function showCategorie(event){
        const categorie_id=event.target.value;
        document.location.href=`index.php?url=produit&action=list&page=1&categorie_id=${categorie_id}&mot=<?=$mot?>`;
        
    } 

    function quitter() {
        document.location.href="index.php?url=accueil";
    }

    function imprimer() {
        window.print();
    }
    
    function creer() {
        document.location.href="index.php?url=produit&action=create";
    }

    function afficher() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à afficher");
            return;
        }
        const url = `index.php?url=produit&action=read&id=${id}`;
        const w = screen.width*0.60;
        const h = screen.height*0.60;
        popupCenter(url, `Affichage de la produit id = ${id}`, w, h);
    }
    
    function modifier() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à modifier");
            return;
        }
        document.location.href=`index.php?url=produit&action=update&id=${id}`;
    }

    function supprimer() {
        const id = getIdChecked("choix");
        if(id == 0 ) {
            alert("Veuillez choisir une ligne à supprimer");
            return;
        }
        const response = confirm("Voulez-vous vraiment supprimer cette ligne?");
        if(response) {
            document.location.href=`index.php?url=produit&action=delete&id=${id}`;
        }
    }

</script>