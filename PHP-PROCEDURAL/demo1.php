<?php
    // instruction sur switch
    $x = 3;
    switch ($x) {
        case 1:
            $y = 'Lundi';
            break;
        
        case 2:
            $y = 'Mardi';
            break;
        
        case 3:
            $y = 'Mercredi';
            break;
        
        case 4:
            $y = 'Jeudi';
            break;
        
        case 5:
            $y = 'Vendredi';
            break;
        
        case 6:
            $y = 'Samedi';
            break;
        
        case 7:
            $y = 'Dimanche';
            break;
        
        default:
            $y = 'Jour inconnu';
            break;
    }
    echo $y;
die;
    // utilisation de la fonction custom printr()
    $militaires = [
        ['nom' => 'Dupont', 'prenom' => 'Paul', 'grade' => 'Sergent',  'regiment' => '2REI'],
        ['nom' => 'Marie', 'prenom' => 'Brigitte', 'grade' => 'Adjudante',  'regiment' => '2REI'],
        ['nom' => 'Norbert', 'prenom' => 'Pierre', 'grade' => 'Sergent-Chef',  'regiment' => '2REI'],
        ['nom' => 'Claude', 'prenom' => 'Georges', 'grade' => '1ére Classe',  'regiment' => '2REI'],
        ['nom' => 'Mohamed', 'prenom' => 'Roger', 'grade' => 'Sergent',  'regiment' => '2REI'],
    ];
    printr($militaires);
die;
    // afficher un tableau pour verification
    $militaires = [
        ['nom' => 'Dupont', 'prenom' => 'Paul', 'grade' => 'Sergent',  'regiment' => '2REI'],
        ['nom' => 'Marie', 'prenom' => 'Brigitte', 'grade' => 'Adjudante',  'regiment' => '2REI'],
        ['nom' => 'Norbert', 'prenom' => 'Pierre', 'grade' => 'Sergent-Chef',  'regiment' => '2REI'],
        ['nom' => 'Claude', 'prenom' => 'Georges', 'grade' => '1ére Classe',  'regiment' => '2REI'],
        ['nom' => 'Mohamed', 'prenom' => 'Roger', 'grade' => 'Sergent',  'regiment' => '2REI'],
    ];
    var_dump($militaires);
    echo "<br>";
    echo "<br>";
    print_r($militaires);
    echo "<br>";
    echo "<br>";
    echo "<pre>";
    print_r($militaires);
die;
    // tableau aui contient des tableaux
    $militaires = [
        ['nom' => 'Dupont', 'prenom' => 'Paul', 'grade' => 'Sergent',  'regiment' => '2REI'],
        ['nom' => 'Marie', 'prenom' => 'Brigitte', 'grade' => 'Adjudante',  'regiment' => '2REI'],
        ['nom' => 'Norbert', 'prenom' => 'Pierre', 'grade' => 'Sergent-Chef',  'regiment' => '2REI'],
        ['nom' => 'Claude', 'prenom' => 'Georges', 'grade' => '1ére Classe',  'regiment' => '2REI'],
        ['nom' => 'Mohamed', 'prenom' => 'Roger', 'grade' => 'Sergent',  'regiment' => '2REI'],
    ];
    $html = "
        <table>
            <tr>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>GRADE</th>
                <th>REGIMENT</th>
            </tr>
    ";
    foreach($militaires as $militaire) {
        // $nom = $militaire['nom'];
        // $prenom = $militaire['prenom'];
        // $grade = $militaire['grade'];
        // $regiment = $militaire['regiment'];
        extract($militaire); // 2éme facone plus simple d'écrir 
        $html = $html."
        <tr>
            <td>$nom</td>
            <td>$prenom</td>
            <td>$grade</td>
            <td>$regiment</td>
        </tr>";
    }
    $html.="</table>";
    echo $html;

die;
    // parcourir un tableau en tennnt com;pe de ses indices
    $salarie = [
        'nom' => 'RAKOTO',
        'prenom' => 'Paul',
        'grade' => 'Capitaine',
        'regiment' => '2REI',
    ];
    foreach($salarie as $key => $valeur) {
        echo "<b>$key:</b> $valeur <br>";
    }
die;
    // parcourir un tableau
    $salarie = [
        'nom' => 'RAKOTO',
        'prenom' => 'Paul',
        'grade' => 'Capitaine',
        'regiment' => '2REI',
    ];
    foreach($salarie as $valeur) {
        echo "$valeur <br>";
    }
die;
    // Autre exemple de tableau associative
    $salarie = [
        'nom' => 'RAKOTO',
        'prenom' => 'Paul',
        'grade' => 'Capitaine',
        'regiment' => '2REI',
    ];
    // creation de variables a partir de ce tableu
    extract($salarie);

    echo "Le $grade $nom $prenom est au regiment $regiment";
die;
    // tableau assoiative
    $jours = [
        1 => "Lundi", 
        2 => "Mardi", 
        3 => "Mercredi", 
        4 => "Jeudi", 
        5 => "Vendredi", 
        6 => "Samedi", 
        7 => "Dimanche"
    ];
    echo "$jours[4] $jours[5]";
die;
    // variables tableau ou array
    $jours = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
    echo $jours[4];
die;
    //boucle do while
    $x = 4;
    $i = 0;
    do {
       $z = $i * $x; 
       echo "$i x $x = $z <br>";
       $i++;
    } while ($i <= 10);

die;
    // boucl while
    $x = 2;
    $i = 1;
    while ($i <= 10) {
        $z = $i * $x;
        echo "$i fois $x = $z <br>";
        echo $i. " fois " . $x . " = ". $z. '<br>';
        $i++;
    }
die;
    // boucle for
    $x = 2;
    for ($i = 1; $i <= 10; $i++) {
        $z = $i * $x;
        echo "$i x $x = $z <br>";
    };
die;
    // test if
    $x = 10;
    $y = 20;
    if ($x >= $y) {
        $z = $x;
    } else {
        $z = $y;
    };
    echo $z;
die;
    $x = "Formation en DWWM";
    $y = "Année 2024-2025";
    $lieu = "CMFP Fontenay le-Comte";
    $z = $x." ".$y; // Concatenetion par le caractere "."
    $formation = "$x $y $lieu"; // Conatenation par les variables entourés dans le guillemets " "
    $test = '$x $y $lieu'; // apostroph ne sert pas à concatenation 
    echo $z;
    echo "<br>";
    echo $formation;
    echo "<br>";
    echo $test;

    // Fonction qui va preformater le texte
function printr($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
?>

<h1>Initiation au language PHP</h1>
<label for="">Designation Formation</label>
<input type="text" id="x" name="x" value="<?=$x?>">

<h2><?=$formation?></h2>
<h2><?=$x.$y?></h2>