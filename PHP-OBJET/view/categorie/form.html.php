<div class="w70 m-auto">
    <h1 class="titre  shadow p-2 mb-5 rounded"><?=$title?></h1>
    <form action="index.php?url=categorie&action=save" method="POST">
        <div class="line-input hide shadow p-2 my-3 rounded">
            <label for="id" class="lab30" >ID:</label>
            <input type="text" id="id" name="id" value="<?=$categorie->getId()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="prefixe" class="lab30 obligatoire" >PREFIXE:</label>
            <input required type="text" id="prefixe" name="prefixe" value="<?=$categorie->getPrefixe()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="libelle" class="lab30" >LIBELLE:</label>
            <input type="text" id="libelle" name="libelle" value="<?=$categorie->getLibelle()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="numeroinitial" class="lab30 obligatoire" >N° INITIAL:</label>
            <input reauired type="text" id="numeroinitial" name="numeroinitial" value="<?=$categorie->getNumeroInitial()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="format" class="lab30" >FORMAT:</label>
            <input type="text" id="format" name="format" value="<?=$categorie->getFormat()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-button">
            <button type="reset" class="btn btn-md btn-danger shadow py-2 px-3 my-3r border">Annuler</button>
            <button type="submit" class="btn btn-md btn-success shadow py-2 px-3 my-3 border">Valider</button>
        </div>
    </form> 
</div>