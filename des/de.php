<?php

$bdd = mysqli_connect('cinfo.cje.qc.ca','4Amy','123','4amy');

	if(!$bdd){
		echo'Problème de connexion';
		
		}
		
$requete = 'SELECT * FROM inscription WHERE pseudo="Yma" ';

$query = mysqli_query($bdd, $requete);
$donnees = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>La Taverne ignée</title>

<link href='http://fonts.googleapis.com/css?family=Metal+Mania' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Butcherman' rel='stylesheet' type='text/css'>

<style type="text/css">

h1 {
	font-family: 'Metal Mania', cursive;
	}

body {
	background-color:#000;
	color:#F00;
	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
	}
	
.wrap {
	margin-left:auto;
	margin-right:auto;
	width:900px;
	}

.chimera {
	position:absolute;
	right:100px;
	top:100px;
	}	

.messsageChimera {
	width:900px;
	}

.boutonAccueil {
	position:absolute;
	bottom:40px;
	left:40px;
	background-image:url(Images/feu.png);
	width:144px;
	height:223px;
	}
	
.boutonAccueil:hover {
	position:absolute;
	bottom:40px;
	left:40px;
	background-image:url(Images/feu_hover.png);
	width:144px;
	height:223px;
	}

.liens {
	position:fixed;
	bottom:0px;
	left:550px;
}

a{
	color:#B70105;
	text-decoration:none;
	font-family: 'Butcherman', cursive;
	font-size:24px;
	}
	
a:hover {
	color:#FF3521;
	text-decoration:none;
	font-family: 'Butcherman', cursive;
	font-size:36px;
	}

.joueur {
	float:left;
	padding-left:10px;
	padding-top:3px;
	}
	
.joueurPseudo {
	color:#F60;
	text-decoration:underline;
	font-size:36px;
	font-family: 'Butcherman', cursive;
	}
	
.joueurInfos {
	font-family:"Times New Roman", Times, serif;
	font-size:18px;
	color:#F60;
	}

</style>

</head>

<body>

<div class="joueur">
<div class="joueurPseudo"><?php echo $donnees['pseudo']; ?></div>
<div class="joueurInfos">Vous avez actuellement <?php echo $donnees['argent']; ?> N.</div>
</div>

<div class="wrap">

<div class="messsageChimera">
<h1 align="center">Bienvenue dans ma Taverne ignée.</h1>
<p align="center">Je suis Chimère, l'esprit du feu.</p>
<p align="center">Je m'ennuie et je vous demande, oh voyageur(se) imprudent(e), de jouer avec moi.</p>
<p align="center">En guise de remerciement, je vous offrirez des trésors typiques du royaume...</p>
<p align="center">... seulement si vous gagnez.</p>
<p align="center"><strong>Le jeu est simple: vous devez choisir un nombre entre 2 et 12 inclusivement, puis lancer les Dés.</strong></p>
<p align="center"><strong>Si le nombre que vous avez choisi équivaut à la valeur des Dés, vous avez gagné.</strong></p>
<p align="center"><strong>Sinon, vous devez comprendre...</strong></p>
</div>

<div class="chimera"><img src="images/Chimeravrai.png" width="442" height="546" /></div>

<form method="post" action="#">
<input type="number" min="2" max="12" step="1" name="choix" />
    <input type="submit" name="submit" value="Lancer les Dés ignés: coût de 10 N" /> <input type="submit" name="replay" value="Recommencer le jeu" /><br/><br/>
    

    
<?php
	
	/*Les résultats*/
	
	if(isset($_POST['submit'])) {
		
		if($donnees['argent']<10) {
		
		echo '<br/><p align=justify>Vous êtes en problème financier. Ne pensez-vous pas que vous devrez vous trouver un travail au lieu de jouer à des jeux de chance? </p>';
		
		}
		
		else{

/*Les variables*/
	$date = date("d-m-Y");
	$heure = date("H:i:s");
	$valeurDe = rand(1,6); 
	$valeurDe2 = rand(1,6);
	$choix=$_POST['choix'];

	$pay=$donnees['argent']-10;

	
		if($choix>=2&&$choix<=12){

			
$requete2 = 'UPDATE inscription SET argent="'.$pay.'" WHERE pseudo="Yma" ';
	$query2 = mysqli_query($bdd,$requete2);
	
			
		echo'Vos dés: <br/> <img src="images/de'.$valeurDe.'.png" width="200" height="200" />'; 
			
			echo' <img src="images/de'.$valeurDe2.'.png" width="200" height="200" />'; 
			
		
			/*Si le joueur gagne*/
			
		if($choix==$valeurDe+$valeurDe2) {
			
			
			echo'<br/>Bravo, mais vous ne serez pas aussi chanceux(se) la prochaine fois. Vous avez gagné 500 N.';
			
			$win=$donnees['argent']+500;
	
	$requete2 = 'UPDATE inscription SET argent="'.$win.'" WHERE pseudo="Yma" ';
	$query2 = mysqli_query($bdd,$requete2);
	
			
			}
		
		/*Si le joueur perd*/
		
		else{
			
			
			
			echo'<br/>Malheureusement, vous avez perdu (et vous ne gagnez rien). Mouhahahahaaaaaaaa!';
			
			
			}
		
		/*Temps du dernier essai*/
		
		echo'<br/><br/>Vous avez tenté votre chance à '.$heure.', le '.$date.'. <br/>';
		
		}
		
			/*Si le joueur triche*/
			
		else{
			
			
			echo'<br/>N\'essayez pas! Tricher dans la Taverne ignée équivaut à dix ans de captivité dans les Donjons de Noisuf. Vous avez de la chance que je suis gentil avec vous pour cette fois-ci.';
			
			}
	}
	
	}
	
	if(isset($_POST['replay'])) {
		
		if($donnees['argent']>0) {
		
		echo'Vous n\'êtes pas assez pauvre pour recommencer le jeu. Vous devez avoir 0 N pour abandonner.';
			
		}
	
	else{
	$replay=300;
	$requete2 = 'UPDATE inscription SET argent="'.$replay.'" WHERE pseudo="Yma" ';
	$query2 = mysqli_query($bdd,$requete2);
	
	}
	
		
	}
	
?>
</form>

<a href="../accueil/accueil.php"><div class="boutonAccueil"></div></a>

<div class="liens"><a href="../accueil/accueil.php">Accueil</a> - <a href="../Machine a sous/machine.php">La grotte d'Etrep</a> - <a href="de.php">La Taverne ignée</a> - <a href="../jeu3/jeu3.html">Jeu à venir</a></div>

</div>
</body>
</html>
