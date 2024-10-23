<?php 
    $date = new DateTime("2024-10-20");
    $jour = jourSemaine($date);
    echo $jour; die;

    function jourSemaine($date) {
        $njs = $date->format('N'); // format ('l') - jour de la smaine en anglais
        $jour = '';
        switch ($njs) {
            case 1:
                $jour = 'Lundi';
                break;
            case 2:
                $jour = 'Mardi';
                break;
            case 3:
                $jour = 'Mercredi';
                break;
            case 4:
                $jour = 'Jeudi';
                break;
            case 5:
                $jour = 'Vendredi';
                break;
            case 6:
                $jour = 'Samedi';
                break;
            case 7:
                $jour = 'Dimanche';
                break;
            default:
                $jour = 'Inconnu';
                break;
        }
        return $jour;
    }