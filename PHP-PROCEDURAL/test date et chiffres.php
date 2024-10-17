<?php
//-----------Affichage de chifres------------
    $x = 12532434.128;
    $x = number_format($x,2,'.',' ');
    echo "<h1>$x</h1>";
    die;

    //-----------Difference entre 2 dates----------
    $date1 = "2024-01-12 10:25:14";
    $date2 = "2024-05-15 13:15:21";

    $date1 = new DateTime($date1); // transformation du text en date
    $date2 = new DateTime($date2);

    $h = $date1->diff($date2)->h;
    $j = $date1->diff($date2)->d;
    $m = $date1->diff($date2)->m;

    echo "<h1> h=$h j=$j m=$m </h1>";
    die;

    //-----------Debut et fin de mois-----------
    $date = "2024-02-20";
    $date = new DateTime($date);
    $debutMois = $date->format('01-m-Y');
    $finMois = $date->format('t-m-Y');
    echo "Debut = $debutMois ";
    echo "Fin = $finMois";
    die;
    $date1 = "2024-01-12";
    $date2 = "2014-01-15";
    
    //-----Creation de date objet à partir d'un text
    $date1 = new DateTime($date1); // transformation du text en date
    $date2 = new DateTime($date2);
    printr($date1);
    printr($date2);
    die;

    //------Format d'affichage d'une date
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('Europe/Paris')); 
    echo $date->format("d/m/Y H:i:s"); // transformation de la date en texte
    printr($date);
    die;
