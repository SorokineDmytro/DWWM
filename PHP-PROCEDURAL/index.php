<?php
    require_once("./service/myFct.php");

    $page = "accueil";
    extract($_GET);
    switch($page) {
        case 'accueil' : $file = 'view/accueil/accueil.html.php';
            $variables = [];
            generatePage($file);
            break;
        case 'cv' : $file = 'view/accueil/cv.html.php';
            $variables = [];
            generatePage($file);
            break;
        case 'portfolio' : $file = 'view/accueil/portfolio.html.php';
            $variables = [];
            generatePage($file);
            break;
        case 'message_write' : 
            $data = $_POST;
            $files = $_FILES;
            extract($data);
            $lus = json_decode($lus);
            $lus = implode(',',$lus);
            $lus = "($lus)";
            if($message){
                saveMessage($data, $files);
            }
            updateMessageLus($lus);
            $response = json_encode($data); 
            echo $response;
            break;
        case 'message_read' :
            $rows = getMessages();
            $nonLu = 0;
            $messages = [];
            foreach($rows as $row){
                $row['reception'] = dateHeureFrs($row['reception']);
                if($row['lu'] == false) {
                    $nonLu++;
                }
                $messages[] = $row;
            }
            $response = [
                'nonLu' => $nonLu,
                'messages' => $messages,
            ];
            $response = json_encode($response);
            echo $response;
            break;
    }
    function saveMessage($data, $files) {
        $connexion = getConnexion();
        extract($data);
        if($files){
            $name = $files['file']['name'];
            $tmp_name = $files['file']['tmp_name'];
            $destination = "./public/file/$name";
            $sql = "insert into message(auteur, message, file) values (?,?,?)";
            $values = [$auteur, $message, $name];
            move_uploaded_file($tmp_name, $destination);
        } else {
            $sql = "insert into message(auteur, message) values (?,?)";
            $values = [$auteur, $message];
        }
        $stmt = $connexion->prepare($sql);
        $stmt->execute($values);
    }

    function getMessages(){
        $connexion=getConnexion();
        $sql="select * from message order by id desc limit 1000 offset 0";
        $stmt=$connexion->prepare($sql);
        $stmt->execute();
        $messages=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    } 

    function updateMessageLus($lus) {
        $connexion = getConnexion();
        $sql = "update message set lu = true where id in $lus";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
    }
