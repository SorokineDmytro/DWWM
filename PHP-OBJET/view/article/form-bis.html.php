<div class="w70 m-auto">
    <h1 class="titre">SAISIE ARTICLE</h1>
    <form action="article-bis.php?action=save" method="POST" enctype="multipart/form-data">
        <div class="flex">
            <div class="w60 ph-4">
                <div class="line-input hide">
                    <label for="id" class="lab30">ID</label>
                <input type="text" id="id" name="id" value="<?=$article['id']?>" <?=$disabled?> class="<?=$color?>">
                </div>
                <div class="line-input">
                    <label for="numarticle" class="lab30 obligatoire">CODE</label>
                    <input type="text" id="numarticle" name="numarticle" value="<?=$article['numarticle']?>" <?=$disabled?> class="w70 <?=$color?>" required>
                </div>
                <div class="line-input">
                    <label for="designation" class="lab30 obligatoire" required>DESIGNATION</label>
                    <input type="text" id="designation" name="designation" value="<?=$article['designation']?>" <?=$disabled?> class="w70 <?=$color?>" required>
                </div>
                <div class="line-input">
                    <label for="prixunitaire" class="lab30">PU</label>
                    <input type="text" id="prixunitaire" name="prixunitaire" value="<?=$article['prixunitaire']?>" <?=$disabled?> class="w30 right <?=$color?>">
                </div>
                <div class="line-input">
                    <label for="prixrevient" class="lab30">PR</label>
                    <input type="text" id="prixrevient" name="prixrevient" value="<?=$article['prixrevient']?>" <?=$disabled?> class="w30 right <?=$color?>">
                </div>
            </div>
            <div class="w40 ph-4">
                <div class="line-input" style="flex-direction: column; flex-wrap:wrap; align-items:center;">
                    <img src="public/img/<?=$article['image']?>" alt="" width="50%" id="view_image">
                    <input type="file" name="file" id="file" onchange="previewImage(this, 'view_image')" <?=$disabled?> class="hide">
                    <a href="javascript:choisirImage()" <?=$disabled?> class="button-large bg-green">Choisir une image</a>
                </div>
            </div>
        </div>  
        <div class='line-button'>
            <button type="reset" class="button-action bg-red">Annuler</button>
            <button type="submit" id="valider" <?=$disabled?> class="button-action bg-green">Valider</button>
        </div>
    </form>

</div>
<script>
    function choisirImage() {
        file.click();
    }

const submitted = "<?=$submitted?>";
if(submitted==1) {
    window.close();
    window.opener.refresh.click();
}
    
</script>