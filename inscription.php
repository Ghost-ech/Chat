<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | chat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        if (isset($_POST['button_inscription'])) {
            //si le formulaire est envoyé
            //se connecter à ma bd
            include "connexion_bdd.php";
            //extraire les infos du form
            extract($_POST);
            //verifions si les champs sont vides
            if (isset($email) && isset($mdp1) &&  $email != "" && $mdp1 != "" && isset($mdp2) &&  $mdp2 != ""){
                //verifions que les mots de passes soont conformes
                if ($mdp2 != $mdp1) {
                    $error = "Les Mots de passes sont différents !";
                }else{
                    //vérifions si l'email existe
                    $req = mysqli_query($con, "SELECT * FROM user WHERE email = '$email'");
                    if (mysqli_num_rows($req)==0) {
                        //si ça n'existe pas, creons le compte
                        $req = mysqli_query($con, "INSERT INTO user VALUES ('$id', '$email', '$mdp1')");
                        if($req){
                            //si le compte a été créer, créons une variable pour un message dans la apge de connexion
                            $_SESSION['message'] = "<p class='message_inscription'>Votre compte a été créer avec succès!</p>";
                            //redirection vers la page de connexion
                            header("location:index.php");

                        }else{
                            $error = "Inscription Echoué!";
                        }
                    }else{
                        //si ça existe
                        $error = "cet email existe déjà!";
                    }
                }
            }else{
                $error = "Veuillez remplir tous les champs !";
            }
        }
    ?>
    <form action="" method="POST" class="form_connexion_inscription">
        <h1>INSCRIPTION</h1>
        <p class="message_error">
            <?php
                //affichons l'erreur
                if (isset($error)) {
                    echo $error;
                }
            ?>
        </p>
        <label for="">Adresse Mail</label>
        <input type="email" name="email" id="">
        <label for="">Mots de passe</label>
        <input type="password" name="mdp1" class="mdp1">
        <label for="">Confirmer mot de passe</label>
        <input type="password" name="mdp2" class="mdp2">
        <input type="submit" value="Inscription" name="button_inscription">
        <p class="link">Vous avez un compte ? <a href="index.php">Connectez vous!</a></p>
    </form>
    <script src="script.js"></script>
</body>
</html>