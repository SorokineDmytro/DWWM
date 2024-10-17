<div class="w80 m-auto print-area">
    <h1 class="titre">LISTE DES PRODUITS</h1>
    <div class="line-button">
        <button class="button-action bg-navy" id="refresh" onclick="rafraichir()"><i class="fas fa-arrow-rotate-right mr-2"></i>Rafraichir</button>
        <button class="button-action bg-green" onclick="creer()"><i class="fas fa-folder-plus mr-2"></i>Créer</button>
        <button class="button-action bg-green" onclick="afficher()"><i class="fas fa-eye mr-2"></i>Afficher</button>
        <button class="button-action bg-navy" onclick="modifier()"><i class="fas fa-marker mr-2"></i>Modifier</button>
        <button class="button-action bg-red" onclick="supprimer()"><i class="fas fa-trash mr-2"></i>Supprimer</button>
        <button class="button-action bg-navy" onclick="window.print()"><i class="fas fa-print mr-2"></i>Imprimer</button>
        <button class="button-action bg-main-color" onclick="quitter()"><i class="fas fa-house-chimney-user mr-2"></i>Quitter</button>
    </div>
    <table class="scroll w100">
        <thead>
            <tr class="bg-main-color">
                <th class="w10"><input type="checkbox"></th>
                <th class="w10">ID</th>
                <th class="w10">CODE</th>
                <th class="w40">DESIGNATION</th>
                <th class="w15">PRIX UNITAIRE</th>
                <th class="w15">PRIX REVIENT</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $html = '';
                foreach($produits as $produit) {
                    extract($produit);
                    $html .= "
                        <tr>
                            <td class='w10 ph-2 center'><input type='checkbox' id='$id' name='choix' onclick='onlyOne(this)'></td>
                            <td class='w10 ph-2 center'>$id</td>
                            <td class='w10 ph-2 center'>$numarticle</td>
                            <td class='w40 ph-2'>$designation</td>
                            <td class='w15 ph-2 right'>$prixunitaire €</td>
                            <td class='w15 ph-2 right'>$prixrevient €</td>
                        </tr>
                    ";
                }
                echo $html;
            ?>
        </tbody>
        <tfoot>
            <tr class="bg-main-color">
                <th colspan="6">Nombre produits: <?=count($produits)?></th>
            </tr>
        </tfoot>
        
    </table>
    <div id="container_page">
        <?php
            $btn_page="";
            for($i=1;$i<=$np;$i++){
                if($i==$page){
                    $active='bg-main-color';
                }else{
                    $active='bg-white';
                }
                $btn_page.="
                    <button class='page $active' onclick='showPage($i)'>$i</button>
                ";
            }
            echo $btn_page;
        ?>
    </div> 
</div>
<script>
    // ---------------------------------------RAFRAICHIR----------------------------------------
    function rafraichir() {
        document.location.href="produit.php";
    }

    // ---------------------------------------RECHERCHE----------------------------------------
    function chercher() {
        document.location.href=`produit-bis.php?action=search&mot=${mot.value}`;
    }

    // ---------------------------------------SORTIE----------------------------------------
    function quitter() {
            document.location.href = "index.php";
        }
    
    // ---------------------------------------PAGGINATION----------------------------------------
    function showPage(page) {
            document.location.href=`produit.php?action=list&page=${page}&mot=<?=$mot?>`;
        }



</script>