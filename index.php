<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        if(isset($_POST['button_con'])){
            //si le formulaire est envoyé
            //se connecter à ma bd
            include "connexion_bdd.php";
            //extraire les infos du form
            extract($_POST);
            //verifions si les champs sont vides
            if (isset($email) && isset($mdp1) &&  $email != "" && $mdp1 != ""){
                //verifions si les identifiants sont correctes
                $req = mysqli_query($con, "SELECT * FROM user WHERE email = '$email' AND mdp = '$mdp1'");
                if (mysqli_num_rows($req) > 0){
                    //si les ids sont correctes
                    //création d'une session qui contien l'email
                    $_SESSION['user'] = $email;
                    //redirection vers la page chat
                    header("location:chat.php");
                    //detruire la variable du message d'inscription
                    unset($_SESSION['message']);
                }else{
                    $error = "Email ou mdp erronés!!";
                }
            }else{
                $error = "Veuillez remplir tous les champs!";
            }
        }
    ?>
    <form action="" method="POST" class="form_connexion_inscription">
        <h1>CONNEXION</h1>
        <?php
            //affichins le message qui dit qu'un compte a été créer
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>
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
        <input type="password" name="mdp1" id="">
        <input type="submit" name="button_con" id="" value="connexion">
        <p class="link">Vous n'avez pas un compte ? <a href="inscription.php">Créer un compte</a></p>
    </form>

    <script src="script.js"></script>
</body>
</html>