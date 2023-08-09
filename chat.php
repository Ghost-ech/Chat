<?php
    //démarrer la session
    session_start();
    if (!isset($_SESSION['user'])) {
        // si le user n'est pas connecté
        // redirection vers la page connexion
        header("location:index.php");
    }
    $user = $_SESSION['user'] // email de l'utilisateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$user?> | CHAT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="chat">
        <div class="button-email">
            <span> <?=$user?> </span>
            <a href="deconnexion.php" class="Deconnexion_btn">Déconnexion</a>
        </div>
        <!--message-->
        <div class="messages_box">Chargement ...</div>
        <!--fin message-->

        <?php
            //envoi des messages
            if (isset($_POST['send'])) {
                // recupérons le message
                $message = $_POST['message'];
                //connexion à la base de donnée
                include "connexion_bdd.php";
                //verifions si le champs n'est pas vide
                if(isset($message) && $message != ""){
                    //inserer le message dans la base de données
                    $req = mysqli_query($con, "INSERT INTO messages VALUES ('$id_m', '$user', '$message', NOW())");
                    //on actualise la page
                    header('location:chat.php');
                }else{
                    //si le message est vide, on actualise la page
                    header('location:chat.php');
                }
            }
        ?>

        <form action="" class="send_message" method="POST">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>
            <input type="submit" value="Envoyé" name="send">
        </form>
    </div>


    <script>
        //on actualise automatiquement le chat en utilisant AJAX
        var message_box = document.querySelector('.messages_box');
        setInterval(function(){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    message_box.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET","messages.php", true); // récupération de la page message
            xhttp.send()
        },500) // Actualiser le chat tous les 500millisecondes
    </script>
</body>
</html>
