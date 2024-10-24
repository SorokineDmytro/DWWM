<div class="w80 m-auto form-container">
    <h1 class="titre  shadow p-2 mb-5 rounded"><?=$title?></h1>
    <form action="index.php?url=security&action=save" method="POST" class="w100">
        <div class="line-input hide shadow p-2 my-3 rounded">
            <label for="id" class="lab30" >ID:</label>
            <input type="text" id="id" name="id" value="<?=$user->getId()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="username" class="lab30 obligatoire">IDENTIFIANT:</label>
            <input required type="text" id="username" name="username" value="<?=$user->getUsername()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="password" class="lab30">MOT DE PASSE:</label>
            <input type="password" placeholder="Ne rien saisir pour garder l'ancienne valeur" id="password" name="password" value="" class="form-control w70" <?=$disabled?> >
        </div>

        <div class="line-input shadow p-2 my-3 rounded <?=isset($hide)?$hide:''?>">
            <label for="roles" class="lab30 obligatoire">ROLES</label>
            <ul class="w70 d-flex flex-column">
                <?php
                    $html = "";
                    foreach($roles as $role){
                        $id=$role->getId();
                        $code=$role->getCode();
                        $user_roles=$user->getRoles();
                        $checked=(in_array($code,$user_roles))?"checked":"";
                        $html.="<li class='mh-10 checkbox-container d-flex align-items-center content-center'><input type='checkbox' class='mx-2' id='$id' name='roles[]' value='$code' $checked>$code</option>";
                    }
                    echo $html;
                ?>
            </ul>
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
        document.location.href = "index.php?url=security";
    }
</script>