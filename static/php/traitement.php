<?php
    // echo "Script executé";
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Initialiser un tableau pour stocker les erreurs

        // Récupérer et valider les données
        $civilite = htmlspecialchars($_POST['choix']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $permis = isset($_POST['permis']) ? 1 : 0;
        $vehicule = isset($_POST['vehicule']) ? 1 : 0;
        $certification = isset($_POST['certification']) ? 1 : 0;
        $majeur = isset($_POST['majeur']) && $_POST['majeur'] === 'Oui' ? 1 : 0;
        $message = htmlspecialchars($_POST['message']);
        $cv = $_FILES['cv_uploads'];

        // Validation du nom
        if (empty($nom)) {
            $errors[] = "Le nom est obligatoire.";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nom)) {
            $errors[] = "Le nom ne doit contenir que des lettres et des espaces.";
        }

        // Validation du prénom
        if (empty($prenom)) {
            $errors[] = "Le prénom est obligatoire.";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $prenom)) {
            $errors[] = "Le prénom ne doit contenir que des lettres et des espaces.";
        }

        // Validation de l'email
        if (empty($email)) {
            $errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
        }

        // Validation du message
        if (empty($message)) {
            $errors[] = "Le message est obligatoire.";
        }

        if ($cv['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $cv['tmp_name'];
            $fileName = htmlspecialchars($cv['name']);
            $fileSize = $cv['size'];
            $fileType = $cv['type'];
            
            $maxFileSize = 2 * 1024 * 1024; // taille maximale en octets (2 Mo)
            $allowedMimeType = 'application/pdf'; // type MIME accepté
            
            // Vérifier le type
            if ($fileType !== $allowedMimeType) {
                $errors[] = "Erreur : Seuls les fichiers PDF sont autorisés.";
                exit;
            }
            
            // Vérifier la taille du fichier
            if ($fileSize > $maxFileSize) {
                $errors[] = "Erreur : La taille du fichier ne doit pas dépasser 2 Mo.";
                exit;
            }
            
        }

        // Si aucune erreur, traiter les données
        if (empty($errors)) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($cv['name']);
            if (move_uploaded_file($cv['tmp_name'], $uploadFile)) {
                echo "Le fichier a été téléchargé avec succès.";
            } else {
                echo "Une erreur s'est produite lors du téléchargement du fichier.";
            }

            // Redirection ou affichage d'un message de succès
            header("Location: http://dev-web.local/offres.php?success=0");
            exit();
        } else {
            foreach ($errors as $error) {
                echo $error.'<br>';
            }
            header("Location: http://dev-web.local/offres.php?error=".count($errors));
            exit();
        }
    } else {
        // Redirection si le formulaire n'a pas été soumis
        header("Location: http://dev-web.local/index.php");
        exit();
    }
?>
