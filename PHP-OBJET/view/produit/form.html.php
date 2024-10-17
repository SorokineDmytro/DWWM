<div class="w80 m-auto">
    <h1 class="titre  shadow p-2 mb-5 rounded"><?=$title?></h1>
    <form action="index.php?url=produit&action=save" method="POST" enctype="multipart/form-data" class="w100">
        <div class="d-flex justify-content-between align-items-center gap-5 form-wrapper">
            <div class="w70 form-inputs">
                <div class="line-input hide shadow p-2 my-3 rounded">
                    <label for="id" class="lab30" >ID:</label>
                    <input type="text" id="id" name="id" value="<?=$produit->getId()?>" class="form-control w70" <?=$disabled?> >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="categorie_id" class="lab30 obligatoire" >CATEGORIE:</label>
                    <?php 
                        $html = "<select name='categorie_id' id='categorie_id' class='form-select w70' required $disabled>";
                        $html .= "<option value=''></option>";
                        foreach($categories as $categorie) {
                            $id = $categorie->getId();
                            $prefixe = $categorie->getPrefixe();
                            $libelle = $categorie->getLibelle();
                            $selected = ($id == $produit->getCategorie_id()) ? "selected" : "";
                            $html .= "<option value='$id' $selected>$prefixe - $libelle</option>";
                        }
                        $html .= "</select>";
                        echo $html;
                    ?>
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="numproduit" class="lab30 obligatoire">CODE:</label>
                    <input required type="text" id="numproduit" name="numproduit" value="<?=$produit->getNumProduit()?>" class="form-control w70" placeholder="Géré automatiquement" disabled >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="designation" class="lab30 obligatoire" >DESIGNATION:</label>
                    <input required type="text" id="designation" name="designation" value="<?=$produit->getDesignation()?>" class="form-control w70" <?=$disabled?> >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="prixunitaire" class="lab30 obligatoire" >PRIX UNITAIRE:</label>
                    <input required type="text" id="prixunitaire" name="prixunitaire" value="<?=$produit->getPrixUnitaire()?>" class="form-control w70" <?=$disabled?> >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="prixrevient" class="lab30" >PRIX REVIENT:</label>
                    <input type="text" id="prixrevient" name="prixrevient" value="<?=$produit->getPrixRevient()?>" class="form-control w70" <?=$disabled?> >
                </div>
            </div>
            <div class="w30 form-image">
                <img src="./public/img/<?=$produit->getImage()?>" alt="" width="100%" id="view_image_id" class="rounded">
                <input type="file" name="image" id="image" onchange="previewImage(this, 'view_image_id')" class="invisible">
                <button class="btn btn-medium btn-info w100" onclick="choisirImage()" <?=$disabled?>>Selectionner une image</button>
            </div>
        </div> 
        <div class="line-button w100">
        <button type="reset" class="btn btn-md btn-primary shadow py-2 px-3 my-3r border w30" onclick="retour()">Retourner</button>
            <button type="reset" class="btn btn-md btn-danger shadow py-2 px-3 my-3r border w30" <?=$disabled?>>Annuler</button>
            <button type="submit" class="btn btn-md btn-success shadow py-2 px-3 my-3 border w30" <?=$disabled?>>Valider</button>
        </div>
    </form>
</div>

<script>
    function retour() {
        event.preventDefault();
        document.location.href = "index.php?url=produit";
    }

    function choisirImage() {
        event.preventDefault();
        image.click()
    }
</script>