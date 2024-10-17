<div class="w80 m-auto print-area">
    <div id="entete" class="flex space-between align-items-center bg-main-color">
        <h2 class="sous-titre mh-4">LISTE COMMANDES</h2>
        <select name="categorie" id="categorie" class="form-select w40" onchange="choisirCategorie()">
            <?php
                $html = '';
                foreach($categories as $key=>$categorie) {
                    $selected = ($key==$code)?"selected":"";
                    $html.="
                        <option value='$key' $selected>$categorie</option>
                    ";
                }
                echo $html;
            ?>
        </select>
    </div>
    <div class="w40 flex space-between align-items-center">
            <div class="line-input">
                <label for="debut">Du</label>
                <input type="date" id="debut" class="mh-4" name="debut" value="<?=$debut?>">
            </div>
            <div class="line-input">
                <label for="fin">Au</label>
                <input type="date" id="fin" class="mh-4" name="fin" value="<?=$fin?>">
            </div>
            <button class="button-action bg-green" onclick="validerDates()"><i class="fas fa-check mr-2"></i>Valider</button>
    </div>
    <div class="line-button">
    <button class="button-action bg-green" onclick="creer()"><i class="fas fa-folder-plus mr-2"></i>Créer</button>
        <button class="button-action bg-green" onclick="afficher()"><i class="fas fa-eye mr-2"></i>Afficher</button>
        <button class="button-action bg-navy" onclick="modifier()"><i class="fas fa-marker mr-2"></i>Modifier</button>
        <button class="button-action bg-red" onclick="supprimer()"><i class="fas fa-trash mr-2"></i>Supprimer</button>
        <button class="button-action bg-navy" onclick="window.print()"><i class="fas fa-print mr-2"></i>Imprimer</button>
        <button class="button-action bg-main-color" onclick="quitter()"><i class="fas fa-house-chimney-user mr-2"></i>Quitter</button>
    </div>
    <div>
        <table class="w100 scroll">
            <thead>
                <tr class="bg-main-color">
                    <th class="w5"><input type="checkbox"></th>
                    <th class="w5">ID</th>
                    <th class="w15">NUM COMMANDE</th>
                    <th class="w20">DATE COMMANDE</th>
                    <th class="w10">NUM CLIENT</th>
                    <th class="w15">NOM CLIENT</th>
                    <th class="w15">ADRESSE CLIENT</th>
                    <th class="w15">MONTANT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $html = '';
                    $montantTotal = 0;
                    $nbre = count($commandes);
                    foreach($commandes as $commande) {
                        extract($commande);
                        $datecommande=dateFrs($datecommande);
                        $montant = ($montant) ? $montant : 0;
                        $montantTotal += $montant;
                        $montant = number_format($montant,2,'.',' ');
                        $montant = "$montant €";
                        $html.="
                            <tr>
                                <td class='w5 ph-2 center'><input type='checkbox' id='$id' name='choix' onclick='onlyOne(this)'></td>
                                <td class='w5 ph-2 center'><label for='$id'>$id</label></td>
                                <td class='w15 ph-2 center'><label for='$id'>$numcommande</label></td>
                                <td class='w20 ph-2 center'><label for='$id'>$datecommande</label></td>
                                <td class='w10 ph-2 center'><label for='$id'>$numtiers</label></td>
                                <td class='w15 ph-2 left'><label for='$id'>$nomtiers</label></td>
                                <td class='w15 ph-2 left'><label for='$id'>$adressetiers</label></td>
                                <td class='w15 ph-2 right'><label for='$id'>$montant</label></td>
                            </tr>
                        ";
                    }
                    $montantTotal = number_format($montantTotal,2,"."," ");
                    $montantTotal = "$montantTotal €";
                    echo $html;
                ?>
            </tbody>
            <tfoot>
                <tr class="bg-main-color">
                    <th id="tfoot_th_article" colspan="6">Nombre commandes: <?=count($commandes)?></th>
                    <th class='w15 ph-2 center'>Total</th>
                    <th class='w15 ph-2 right'><?=$montantTotal?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    // ---------------------------------------SORTIE----------------------------------------
    function quitter() {
        document.location.href = "index.php";
    }

// ----------------------------------------RECHERCHE----------------------------------------
    function chercher() {
        document.location.href=`commande.php?action=list&mot=${mot.value}&code=<?=$code?>&debut=<?=$debut?>&fin=<?=$fin?>`;
    }

// -----------------------------------------SELECT-----------------------------------------
    function choisirCategorie() {
        document.location.href=`commande.php?action=list&code=${categorie.value}&mot=<?=$mot?>&debut=<?=$debut?>&fin=<?=$fin?>`;
    }

// --------------------------------------VALIDER DATES--------------------------------------
    function validerDates() {
        showLoader();
        document.location.href=`commande.php?action=list&mot=<?=$mot?>&code=<?=$code?>&debut=${debut.value}&fin=${fin.value}`;
        hideLoader();
    }

</script>