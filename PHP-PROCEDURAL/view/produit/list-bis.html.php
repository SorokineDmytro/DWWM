<div class="w80 m-auto">
    <div id="entete" class="center bg-main-color pv-4 flex space-between">
        <h2 class="sous-titre mh-4">LISTE DES PRODUITS</h2>
        <select name="categorie" id="categorie" class="w30 form-select mh-4" onchange="choisirCategorie()">
            <?php
                $option = '';
                foreach($categories as $key=>$categorie) {
                    $selected = ($key==$code)?"selected":"";
                    $option.="
                        <option value='$key' $selected>$categorie</option>
                    ";
                }
                echo $option;
            ?>
        </select>
    </div>
    <div class="line-button">
        <button class="button-action bg-navy" id="refresh" onclick="rafraichir()"><i class="fas fa-arrow-rotate-right mr-2"></i>Rafraichir</button>
        <button class="button-action bg-green" onclick="creer()"><i class="fas fa-folder-plus mr-2"></i>Créer</button>
        <button class="button-action bg-green" onclick="afficher()"><i class="fas fa-eye mr-2"></i>Afficher</button>
        <button class="button-action bg-navy" onclick="modifier()"><i class="fas fa-marker mr-2"></i>Modifier</button>
        <button class="button-action bg-red" onclick="supprimer()"><i class="fas fa-trash mr-2"></i>Supprimer</button>
        <button class="button-action bg-navy" onclick="window.print()"><i class="fas fa-print mr-2"></i>Imprimer</button>
        <button class="button-action bg-main-color" onclick="quitter()"><i class="fas fa-house-chimney-user mr-2"></i>Quitter</button>
    </div>
    <table class="w100 scroll">
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
                $html ='';
                foreach($produits as $produit) {
                    extract($produit);
                    $html .= "
                        <tr>
                            <td class='w10 ph-2 center'><input type='checkbox' id='$id' name='choix' onclick='onlyOne(this)'></td>
                            <td class='w10 ph-2 center'><label for='$id'>$id</label></td>
                            <td class='w10 ph-2 center'><label for='$id'>$numarticle</label></td>
                            <td class='w40 ph-2 left'><label for='$id'>$designation</label></td>
                            <td class='w15 ph-2 right'>$prixunitaire</td>
                            <td class='w15 ph-2 right'>$prixrevient</td>
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
        <button class="page" id="left" onclick="prevPage()"><</button>
        <div id="page_content">
            <div id="content">
                <?php
                    $html = "";
                    for($i=1; $i<=$np; $i++) {
                        $active = ($i==$page)?"bg-main-color":"";
                        $html .= "
                            <button class='page $active' onclick='showPage($i)'>$i</button>
                        ";
                    }
                    echo $html;
                ?> 
            </div>
        </div>
        <button class="page" id="right" onclick="nextPage()">></button>
        
    </div>
</div>
<script>
    // ------------------------------------------SELECT------------------------------------------
    function choisirCategorie() {
        document.location.href = `produit-bis.php?action=list&code=${categorie.value}`;
        }
    // ---------------------------------------PAGGINATION----------------------------------------
    function showPage(page) {
        document.location.href=`produit-bis.php?action=list&page=${page}&mot=<?=$mot?>&code=<?=$code?>`;
    }

    // ----------------------------------------RECHERCHE-----------------------------------------
    function chercher() {
        document.location.href=`produit-bis.php?action=list&mot=${mot.value}&code=<?=$code?>`;
    }
    
    // ---------------------------------------RAFRAICHIR----------------------------------------
    function rafraichir() {
        document.location.href="produit-bis.php";
    }

    // ------------------------------------------SORTIE-----------------------------------------
    function quitter() {
            document.location.href = "index.php";
        }

    // ------------------------------------------CAROUSSEL-----------------------------------------
    const shift = 50;
    let counter = 0;
    
    function prevPage() {
            counter += shift;
            console.log(counter);
            content.style.left = `${counter}px`;
            return counter;
    }

    function nextPage() {
            counter -= shift;
            console.log(counter);
            content.style.left = `${counter}px`;
            return counter;
    }
 
    
</script>