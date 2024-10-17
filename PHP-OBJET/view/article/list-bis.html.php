<div class="w90 m-auto print-area">
    <h1 class="titre">LISTE ARTICLES</h1>
    <div class="line-button">
        <button class="button-action bg-navy" id="refresh" onclick="rafraichir()"><i class="fas fa-arrow-rotate-right mr-2"></i>Rafraichir</button>
        <button class="button-action bg-green" onclick="creer()"><i class="fas fa-folder-plus mr-2"></i>Créer</button>
        <button class="button-action bg-green" onclick="afficher()"><i class="fas fa-eye mr-2"></i>Afficher</button>
        <button class="button-action bg-navy" onclick="modifier()"><i class="fas fa-marker mr-2"></i>Modifier</button>
        <button class="button-action bg-red" onclick="supprimer()"><i class="fas fa-trash mr-2"></i>Supprimer</button>
        <button class="button-action bg-red" onclick="supprimerDefault()"><i class="fas fa-trash mr-2"></i>Supprimer bis</button>
        <button class="button-action bg-navy" onclick="window.print()"><i class="fas fa-print mr-2"></i>Imprimer</button>
        <button class="button-action bg-main-color" onclick="quitter()"><i class="fas fa-house-chimney-user mr-2"></i>Quitter</button>
    </div>
    <div class="red center">
        <?=isset($message)?$message:''?>
    </div>
    <table class="w100 scroll">
        <thead>
            <tr class="bg-main-color">
                <th class='w5'><input type="checkbox"></th>
                <th class="w10">IMAGE</th>
                <th class="w15" >CODE</th>
                <th class="w40">DESIGNATION</th>
                <th class="w15">PU</th>
                <th class="w15">PR</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $html = '';
                $nbre = count($articles);
                foreach($articles as $article) {
                    extract($article);
                    $html.= "
                        <tr>
                            <td class='center w5'><input type='checkbox' id='$id' name='choix' onclick='onlyOne(this)'></td>
                            <td class='center w10'><img src='public/img/$image' width='100%' alt='' class='' ondblclick='agrandir(this)' title='Clicauez deux fois pour agrandir'></td>
                            <td class='center w15'><label for='$id'>$numarticle</label></td>
                            <td class='left w40' style='padding-left:10px;'><label for='$id'>$designation</label></td>
                            <td class='right w15' style='padding-right:5px;'>$prixunitaire €</td>
                            <td class='right w15' style='padding-right:5px;'>$prixrevient €</td>
                        </tr>
                    ";
                }
                echo $html;
            ?>
        </tbody>
        <tfoot>
            <tr class="bg-main-color">
                <th id="tfoot_th_article" colspan="6">Nombre article: <?=$nbre?></th>
            </tr>
        </tfoot>
    </table>



</div>
<script>
// ---------------------------------------CREATION----------------------------------------
    function creer() {
        // document.location.href="article-bis.php?action=create"; //ouverture 'normal' dans l'onglet sans passer par le pop-up
        const url = 'article-bis.php?action=create';
        const title = 'Creation article';
        const w = screen.width*0.70;
        const h = screen.height*0.60;
        popupCenter(url, title, w, h);
    }

// ---------------------------------------AFFICHAGE----------------------------------------
    function afficher() {
        const id = getIdChecked('choix');
        if(id) {
            const url = `article-bis.php?action=show&id=${id}`;
            const title = `Affichage article ${id}`;
            const w = screen.width*0.70;
            const h = screen.height*0.60;
            popupCenter(url, title, w, h);
        } else {
            alert('Veuillez selectionner un article!'); 
        }
    }

// ---------------------------------------MODIFICATION----------------------------------------
    function modifier() {
        const id = getIdChecked('choix');
        if(id == 0) {
            alert('Veuillez selectionner un article!'); 
        } else {
            // document.location.href=`article-bis.php?action=update&id=${id}`;
            const url = `article-bis.php?action=update&id=${id}`;
            const title = `Modification d'article ${id}`;
            const w = screen.width*0.70;
            const h = screen.height*0.60;
            popupCenter(url, title, w, h);
        }
    }

// ---------------------------------------SUPPRESSION----------------------------------------
    function supprimer() {
        const id = getIdChecked('choix');
        if(id == 0) {
            alert('Veuillez selectionner un article!'); 
        } else {
            const confirmation = confirm(`Voulez-vous vraiment supprimer l'article id=${id}?`);
            if(!confirmation) {
                return;
            } else {
                document.location.href=`article-bis.php?action=delete&id=${id}`;
            }
        }
    }
    // suppresion qui redirige vers une page d'erreur
    function supprimerDefault() {
        const id = getIdChecked('choix');
        if(id == 0) {
            alert('Veuillez selectionner un article!'); 
        } else {
            const confirmation = confirm(`Voulez-vous vraiment supprimer l'article id=${id}?`);
            if(!confirmation) {
                return;
            } else {
                document.location.href=`article-bis.php?action=deleteDefault&id=${id}`;
            }
        }
    }
    
// ---------------------------------------SORTIE----------------------------------------
    function quitter() {
        document.location.href = "index.php";
    }

// ---------------------------------------RECHERCHE----------------------------------------
    function chercher() {
        document.location.href=`article-bis.php?action=search&mot=${mot.value}`;
    }

// ---------------------------------------RAFRAICHIR----------------------------------------
    function rafraichir() {
        document.location.href="article-bis.php";
    }

// ---------------------------------------AGRANDIR Image----------------------------------------
    function agrandir(image) {
        image.classList.toggle('zoom');
    }

</script>