//confirmation du mot de passe
//vérifions si le mot de passe et la confirmation sont conformes
var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');
mdp2.onkeyup = function(){
    //evenement lorsqu'on écrit dans le champs
    message_error = document.querySelector('.message_error');
    if(mdp1.value != mdp2.value){
        //s'ils sont différent un message d'eerur s'affiche
        message_error.innerText = "Les mots de passes sont différents";

    }else{
        message_error.innerText = "";
    }
}