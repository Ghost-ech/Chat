			<?php
				session_start();
				if (isset($_SESSION['user'])) {// si le user est connecté
					include "connexion_bdd.php";
					//requête pour afficher mes messages
					$req = mysqli_query($con, "SELECT * FROM messages ORDER BY id_message DESC");
					if (mysqli_num_rows($req) == 0) {
						// s'il y a pas encore de message
						echo "Messagerie vide";
					}else{
						//si oui
						while ($row = mysqli_fetch_assoc($req)) {
							//si c'est vous qui avez envoyé le message on utilise ce format:
							if($row['email'] == $_SESSION['user']){
								?>
									<div class="message your_message">
						                <span>Vous</span>
						                <p><?=$row['msg']?></p>
						                <p class="date"><?=$row['date']?></p>
						            </div>
								<?php
							}else{
								//si vous n'êtes pas l'auteur du message, on affiche ce message sur ce format:
								?>
									<div class="message others_message">
						                <span><?=$row['email']?></span>
						                <p><?=$row['msg']?></p>
						                <p class="date"><?=$row['date']?></p>
						            </div>
								<?php



							}
						}
					}
					
				}
			?>			