<div class="w80 m-auto">
    <h1 class="titre"><?=strtoupper($title)?></h1>
    <form action="index.php?url=menu&action=save" method="POST" class="w100">
        <div class="line-input hide shadow p-2 my-3 rounded">
            <label for="id" class="lab30" >ID:</label>
            <input type="text" id="id" name="id" value="<?=$menu->getId()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="libelle" class="lab30 obligatoire">LIBELLE:</label>
            <input required type="text" id="libelle" name="libelle" value="<?=$menu->getLibelle()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="parent_id" class="lab30 ">PARENT:</label>
            <select  type="select" id="parent_id" name="parent_id" value="<?=$menu->getLibelle()?>" class="form-select w70" <?=$disabled?> >
                <?php 
                    $html = "<option value=''></option>";
                    foreach($parents as $parent){
                        $parent_id=$parent->getId();
                        $parent_libelle=$parent->getLibelle();
                        $selected=($parent_id==$menu->getParent_id())?"selected":"";
                        $html.="<option value='$parent_id' $selected >$parent_libelle</option>";
                    }
                    echo $html;
                ?>
            </select>
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="url" class="lab30 obligatoire" >URL:</label>
            <input required type="text" id="url" name="url" value="<?=$menu->getUrl()?>" class="form-control w70" <?=$disabled?> >
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="role" class="lab30 obligatoire" >ROLE:</label>
            <select required type="select" id="role" name="role" value="<?=$menu->getRole()?>" class="form-select w70" <?=$disabled?> >
                <?php 
                    $html = "<option value=''></option>";
                    foreach ($roles as $role) {
                        $role_id = $role->getId();
                        $role_code = $role->getCode();
                        $selected = ($role_id = $menu->getRole()) ? "selected" : "";
                        $html .= "<option value='$role_code' $selected>$role_code</option>";
                    }
                    echo $html;
                ?>
            </select>
        </div>
        <div class="line-input shadow p-2 my-3 rounded">
            <label for="icone" class="lab30 " >ICONE:</label>
            <input  type="text" id="icone" name="icone" value="<?=$menu->getIcone()?>" class="form-control w70" <?=$disabled?> >
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
        document.location.href = "index.php?url=menu";
    }
</script>