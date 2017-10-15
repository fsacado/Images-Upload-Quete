<?php

$uploadDir = 'uploads/'; // Dossier contenant les images uploadées (DONC CREER CE DOSSIER POUR QUE LES IMAGES AILLENT BIEN DEDANS :) )
$filesUploaded = scandir($uploadDir); // Tableau contenant les fichiers bien uploadés

if (!empty($_FILES)) { // Si une ou des images ont été envoyées

    $uploads = $_FILES['uploads']; // Raccourci
    $uploadsName = $uploads['name']; // Raccourci
    $sizeMax = 1048576; // Taille max = 1Mo = 1048576 octets
    $validFormats = ['jpg', 'png', 'gif']; // Formats acceptés

    for ($i = 0; $i < sizeof($uploadsName); $i++) {

        $folderSize = filesize($uploads['tmp_name'][$i]); // Taille de mon image

        if ($folderSize > $sizeMax || $folderSize == 0) { // Si la taille de l'image dépasse 1Mo ou est égale à 0

            echo 'The size of your file ' . $uploadsName[$i] . ' is invalid !<br/>';

        } elseif (!in_array(pathinfo($uploadsName[$i], PATHINFO_EXTENSION), $validFormats)) { // Si l'extension du fichier n'est pas dans le tableau $validFormats

            echo 'The extension of your file ' . $uploadsName[$i] . ' is not valid !<br/>';

        } elseif (0 !== strpos($uploadsName[$i], 'image')) { // Si le fichier ne commence pas par 'image'

            echo 'The name of your file ' . $uploadsName[$i] . ' must start with \'image\' !<br/>';

        } else {

            $fileLocation = $uploadDir . basename($uploadsName[$i]); // Emplacement de mon image

            echo '<pre>';

            if (move_uploaded_file($uploads['tmp_name'][$i], $fileLocation)) { // Si l'image est bien déplacée dans le dossier de destination

                echo 'The folder ' . $uploadsName[$i] . ' is valid and has been uploaded with success ! <br/>Please refresh the page to see your image.';

            } else {

                echo 'Potential attack by uploading your folder. More informations :<br/>';
                print_r($_FILES);
            }

            echo '</pre>';
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Upload de fichiers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
