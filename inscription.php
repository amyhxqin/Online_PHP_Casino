<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Inscription</title>
</head>

<body>

    <form method="post" action="#">
    <br />
    Votre pseudo: <input type="text" name="pseudo" /> <br /> <br />
    Votre mot de passe: <input type="password" name="mdp"/> <br /><br />
    <input type="submit" name="valider" value="M'inscrire" />
    
		<?php
        if(isset($_POST['valider'])) {
			$pseudo=$_POST['pseudo'];
			$mdp=$_POST['mdp'];
			
			
			$bdd=mysqli_connect('cinfo.cje.qc.ca','4Amy','123','4amy');
			
			if(!$bdd){
				echo'<br />problème de connection à la base de données';
				}
				
			$requete='INSERT INTO inscription (pseudo, mdp) VALUES ("'.$pseudo.'", "'.$mdp.'")';
			$query=mysqli_query($bdd,$requete);
			
			if(!$query){
				echo'<br />problème de requête';
				}
			
			}
        
        
        ?>
        
    
    
    
    </form>

</body>
</html>
