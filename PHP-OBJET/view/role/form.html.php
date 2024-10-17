<div class="w80 m-auto form-container">
    <h1 class="titre  shadow p-2 mb-5 rounded"><?=$title?></h1>
    <form action="index.php?url=role&action=save" method="POST" class="w100">

                <div class="line-input hide shadow p-2 my-3 rounded">
                    <label for="id" class="lab30" >ID:</label>
                    <input type="text" id="id" name="id" value="<?=$role->getId()?>" class="form-control w70" <?=$disabled?> >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="code" class="lab30 obligatoire">CODE:</label>
                    <input required type="text" id="code" name="code" value="<?=$role->getCode()?>" class="form-control w70" <?=$disabled?> >
                </div>
                <div class="line-input shadow p-2 my-3 rounded">
                    <label for="libelle" class="lab30 obligatoire" >LIBELLE:</label>
                    <input required type="text" id="libelle" name="libelle" value="<?=$role->getLibelle()?>" class="form-control w70" <?=$disabled?> >
                </div>
        <div class="line-button w100">
            <button type="reset" class="btn btn-md btn-primary shadow py-2 px-3 my-3 border w30" onclick="retour()">Retourner</button>
            <button type="reset" class="btn btn-md btn-danger shadow py-2 px-3 my-3 border w30" <?=$disabled?>>Annuler</button>
            <button type="submit" class="btn btn-md btn-success shadow py-2 px-3 my-3 border w30" <?=$disabled?>>Valider</button>
        </div>
    </form>
</div>

<script>
    function retour() {
        event.preventDefault();
        document.location.href = "index.php?url=role";
    }
</script>