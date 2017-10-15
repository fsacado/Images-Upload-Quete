<?php

// Système d'upload images MULTIPLES

/*<form enctype=multipart/form-data action="" method="post">
<div>
<label for="upload">Add attachments : </label>
<input id="upload" name="uploads[]" type="file" mulitple="multiple"/>
</div>
<p><input type="submit" name="submit" value="Submit"></p>
*/

// N'accepte que les fichiers de moins de 1 Mo
/*
foreach (uploads as upload) {
if ($_FILES['size'] <= 1000) {
ajouter le fichier aux upload tmp files et tout et tout
}
*/

// N'accepte que les fichiers jpg, png et gif

// Le format obligatoire des fichiers : 'image' . identifiant unique . 'extension'

// Afficher sous forme de vignettes les images déjà uploadées et leur nom (utiliser les fonctions PHP filesystemiterator et scandir)
/*Se servir des thumbnails bootstrap*/

// Chaque vignette contient un bouton DELETE qui supprimera le fichier (avant de le supprimer, bien vérifier qu'il existe, avec la fonction PHP file_exists)

?>

<?php include 'head.php' ?>

<form action="" method="POST" enctype="multipart/form-data">

    <div>
        <label for="upload">Add attachments : </label>
        <input id="upload" name="uploads[]" type="file" multiple="multiple" accept="image/*">
    </div>
    <br/>
    <input type="submit" id="submit" value="Submit">

</form>

<hr>

<div class="container-fluid">
    <div class="row">
        <?php

        foreach ($filesUploaded as $fileUploaded) { // Boucle chaque image du dossier uploads/

            if ($fileUploaded == '.') {
                continue; // Ne prend pas en compte le fichier '.'
            }
            if ($fileUploaded == '..') {
                continue; // Ne prend pas en compte le fichier '..'
            }
            if ($fileUploaded == '.gitignore') {
                continue;
            }

            ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="<?php echo $uploadDir . $fileUploaded ?>" alt="Image">
                    <div class="caption">
                        <h3><?php echo $fileUploaded ?></h3>
                        <p><a href="<?php echo '?delete=' . $uploadDir . $fileUploaded ?>" class="btn btn-danger"
                              role="button">Remove</a></p>
                        <?php // Si on clique sur le bouton Remove alors l'image est effacée
                        if (isset($_GET['delete'])) {
                            unlink($_GET['delete']);
                            header('Location:index.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

</body>

</html>
