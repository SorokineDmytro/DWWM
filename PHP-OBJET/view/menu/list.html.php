<div class="w80 m-auto">
    <h1 class="titre"><?=strtoupper($title)?></h1>
    <table class="w-100">
        <thead>
            <tr class="bg-success text-light">
                <th class="text-center py-2 w5 border border-light"><input type="checkbox"></th>
                <th class="text-center py-2 w30 border border-light">LBELLE</th>
                <th class="text-center py-2 w30 border border-light">URL</th>
                <th class="text-center py-2 w20 border border-light">ROLE</th>
                <th class="text-center py-2 w15 border border-light">ICONE</th>
            </tr>
        </thead>
        <tbody id="tbody_menu">
            <?=$rows?>
        </tbody>
        <tfoot>
            <tr class="bg-success text-light">
                <th class="text-center py-2" colspan="5">Menu</th>
            </tr>
        </tfoot>
    </table>
</div>

<div id="contextmenu" class="contextmenu">
    <ul>
        <li><a href="javascript:creer()" class="nav-link">Creer</a></li>
        <li><a href="javascript:afficher()" class="nav-link">Afficher</a></li>
        <li><a href="javascript:modifier()" class="nav-link">Modifier</a></li>
        <li><a href="javascript:supprimer()" class="nav-link">Supprimer</a></li>
    </ul>
</div>

<script>

    tbody_menu.addEventListener('contextmenu',(event)=>{
        activerMenuContextuel(event);
    })
    

    function creer() {
        document.location.href=`index.php?url=menu&action=create`;
    }

    function afficher(){
        const id=getIdChecked('choix');
        if(id==0){
            alert("Veuillez selectionner une ligne à afficher!");
            return;
        }
        document.location.href=`index.php?url=menu&action=read&id=${id}`;
    } 

    function modifier(){
        const id=getIdChecked('choix');
        if(id==0){
            alert("Veuillez selectionner une ligne à modifier!");
            return;
        }
        document.location.href=`index.php?url=menu&action=update&id=${id}`;
    } 

    function supprimer(){
        const id=getIdChecked('choix');
        if(id==0){
            alert("Veuillez selectionner une ligne à supprimer!");
            return;
        }
        const response = confirm("Voulez-vou vraiement upprimer cette ligne?");
        if (response) {
            document.location.href=`index.php?url=menu&action=delete&id=${id}`;
        } 
    } 
</script>