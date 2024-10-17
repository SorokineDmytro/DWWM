<div class="w90 m-auto form-container">
    <h1 class="titre"><?=strtoupper($title)?></h1>
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
                <th class="text-center py-2 w30 border border-light">USERNAME</th>
                <th class="text-center py-2 w20 border border-light">PASSWORD</th>
                <th class="text-center py-2 w35 border border-light">ROLES</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $html = "";
                foreach($users as $user) {
                    $id = $user->getId();
                    $username = $user->getUsername();
                    $password = '******';
                    $roles = $user->getRoles();
                    $json_roles = $user->getJsonRoles();
                    $role_select = "<select class='form-select my-2'>";
                    foreach($roles as $role) {
                        $role_select .= "<option>$role</option>";
                    }
                    $role_select.="</select>";
                    $html.="<tr>";
                        $html.="<td class='px-2 w5 text-center'><input type='checkbox' id='$id' name='choix' onclick='onlyOne(this)'> </td>";
                        $html.="<td class='px-2 w10 text-center'>$id</td>";
                        $html.="<td <td class='px-2 w30 text-center'>$username</td>";
                        $html.="<td  class='px-2 w20 text-center'>$password</td>";
                        $html.="<td class='px-2 w35 text-start'>$role_select</td>";
                    $html.="</tr>";
                }
                echo $html;
            ?>
        </tbody>
        <tfoot>
            <tr class="bg-success text-light">
                <th class="text-center py-2" colspan="5">Nombre de users : <?=count($users)?></th>
            </tr>
        </tfoot>
    </table>
</div>
<script src="public/js/myScript.js"></script>
<script>
    function chercher() {
        document.location.href=`index.php?url=security&action=list&mot=${mot.value}`;
    }

    function creer() {
        document.location.href="index.php?url=security&action=create";
    }

    function afficher() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à afficher");
            return;
        }
        const url = `index.php?url=security&action=read&id=${id}`;
        const w = screen.width*0.60;
        const h = screen.height*0.60;
        popupCenter(url, `Affichage de la security id = ${id}`, w, h);
    }
    
    function modifier() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à modifier");
            return;
        }
        document.location.href=`index.php?url=security&action=update&id=${id}`;
    }

    function supprimer() {
        const id = getIdChecked("choix");
        if(id == 0) {
            alert("Veuillez choisir une ligne à supprimer");
            return;
        }
        const response = confirm("Voulez-vous vraiment supprimer cette ligne?");
        if(response) {
            document.location.href=`index.php?url=security&action=delete&id=${id}`;
        }
    }
</script>