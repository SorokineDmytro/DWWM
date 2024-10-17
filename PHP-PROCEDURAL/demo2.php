<?php
    require_once("service/myFct.php");
    // tableau a partir d'une base de donnée

    $connexion = getConnexion();

    $sql = "select * from article where numArticle like ? or designation like ? order by id"; // sql a lancer
    $requete = $connexion->prepare($sql);  // preparation requete pour eviter les ataques en sql (injection sql)
    $requete->execute(["%BB%", "%a%"]); // execution de la requete   
    $articles=$requete->fetchAll(PDO::FETCH_ASSOC); // recuperation des données correspondantes a la requete sql

    $html = "
        <table>
            <tr>
                <th>ID</th>
                <th>CODE</th>
                <th>DESIGNATION</th>
                <th>PU</th>
                <th>PR</th>
            </tr>
    ";
    forEach($articles as $article) {
        extract($article);
        $html.="
            <tr>
                <td>$id</td>
                <td>$numarticle</td>
                <td>$designation</td>
                <td>$prixunitaire</td>
                <td>$prixrevient</td>
            </tr>";
    }
    $html.="</table>";

    printr($html);

    $listeTiers = "select * from tiers";
    $requeteTiers = $connexion->prepare($listeTiers);
    $requeteTiers->execute();
    $tiers=$requeteTiers->fetchAll(PDO::FETCH_ASSOC);

    $html = "
    <table>
        <tr>
            <th>ID</th>
            <th>CODE</th>
            <th>NOM</th>
            <th>ADRESSE</th>
        </tr>
    ";
    forEach($tiers as $tier) {
        extract($tier);
        $html.="
            <tr>
                <td>$id</td>
                <td>$numtiers</td>
                <td>$nomtiers</td>
                <td>$adressetiers</td>
            </tr>";
    }
    $html.="</table>";

    printr($html);