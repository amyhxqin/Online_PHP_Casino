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
<title>La grotte d'Etrep</title>

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
	
.messageBienvenue {
	margin-left:auto;
	margin-right:auto;
	width:900px;
	height:200px;
	background-image:url(Images/burnt%20paper.jpg);
	background-size:900px 200px;
	}

.messageBienvenueTexte {
	margin-left:0px;
	margin-top:0px;
	width:850px;
	padding-left:30px;
	padding-top:2px;
	color:#000;
	}
	
.caverne {
	background-image:url(Images/cavevrai.png);
	background-size:900px 600px;
	height:600px;
	width:900px;
	position:absolute;
	left:500px;
	top:250px;
	overflow: hidden;
	}

.symboleUn {
	position:absolute;
	left:355px;
	bottom:155px;
	
	}

.symboleDeux {
	position:absolute;
	left:310px;
	bottom:50px;
	
	}
	
.symboleTrois {
	position:absolute;
	left:400px;
	bottom:50px;
	
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
    
        <div class="messageBienvenue">
            <div class="messageBienvenueTexte">
            <h1 align="center">La grotte d'Etrep</h1>
            <p align="justify">Au centre de la Terre, se trouve une grotte mystérieuse. Selon les légendes, des centaines d'oeufs de dragons se cachent au fond de la caverne. La plupart des aventuriers sortent mains vides, mais certains ont la chance de se faire bénir par les esprits. Êtes-vous l'heureux(se) élu(e)? Tentez votre chance pour découvrir... Le ou la gagnante sera celui ou celle qui trouve <strong>trois oeufs de même couleurs</strong>.</p>
            </div>
        </div>
    
    
    
        <div class="caverne">
        <br/>
        <form method="post" action="#">
        
        <input type="submit" name="submit" value="Aventurer dans la grotte...: coût de 5 N." /> 
        <input type="submit" name="replay" value="Recommencer le jeu" /><br/>
        
		<?php
        if(isset($_POST['submit'])){
        
		if($donnees['argent']<5) {
		
		echo '<br/><p align=justify>Vous êtes en problème financier. Ne pensez-vous pas que vous devrez vous trouver un travail au lieu de jouer à des jeux de chance? Revenez quand vous pourrez payer le billet d\'entrée qui coûte 5 N.</p>';
		
		}
		
		else {
		/*Les variables*/
		
        $premierSymbole=rand(1,5);
        $deuxiemeSymbole=rand(1,5);
        $troisiemeSymbole=rand(1,5);
		
        $pay=$donnees['argent']-5;
	
	$requete2 = 'UPDATE inscription SET argent="'.$pay.'" WHERE pseudo="Yma" ';
	$query2 = mysqli_query($bdd,$requete2);
	
		/*Les symboles*/
		
        echo'<img class="symboleUn" src="Images/symbol'.$premierSymbole.'vrai.png" width="100" height="129" /><img class="symboleDeux" src="Images/symbol'.$deuxiemeSymbole.'vrai.png" width="100" height="129" /> <img class="symboleTrois" src="Images/symbol'.$troisiemeSymbole.'vrai.png" width="100" height="129" />';
        
		/*Si le joueur gagne*/   
		
        if($premierSymbole==$deuxiemeSymbole&&$deuxiemeSymbole==$troisiemeSymbole){
         
            echo'<br/><p align=justify>Après trois jours et trois nuits sans sommeil (temps indiqué par votre cellulaire), vous arrivez finalement au fond de la grotte. Vos yeux s\'agrandissent devant tant de merveilles et de richesses. Des larmes de joie coulent sur vos joues. Pris d\'un bonheur indicible, vous criez de joie et embrassez le premier oeuf que vous trouviez. Vous sortez (presque) sain et sauf de la grotte d\'Etrep. </p><p align=justify>Bravo, vous avez trouvé un oeuf de dragon. Vous recevez une récompense de 100 N.</p>';
            
			$win=$donnees['argent']+100;
	
	$requete2 = 'UPDATE inscription SET argent="'.$win.'" WHERE pseudo="Yma" ';
	$query2 = mysqli_query($bdd,$requete2);
	
            }
        
		/*Messages d'encouragement (de découragement)*/  
		
            elseif($premierSymbole==$deuxiemeSymbole||$deuxiemeSymbole==$troisiemeSymbole){
                
                echo'<br/><p align=justify>Après mille et un périls, vous arrivez finalement au fond de la caverne. Vous tendez votre main pour prendre un des nombreux oeufs. Soudain, vous entendez un grognement venu du loin. Vous remarquez qu\'une paire d\'yeux rouges vous fixe. Effrayé, vous vous enfuyez, les mains vides. </p><p align=center>DÉFAITE</p>';
                
                }
            
            elseif($premierSymbole==$troisiemeSymbole){
                
                echo'<br/><p align=justify>Vous avancez dans l\'obscurité. La route que vous empruntez est mouillée par un liquide visqueux. Soudain, vous glissez sur la pente rocheuse et tombez vers le fond de la caverne. Vous tentez de vous agripper à une racine de plante, mais remarquez avec horreur qu\'il s\'agit d\'un serpent venimeux. Vous lâchez prise et chutez. Au moment où vous croyez que vous allez devenir de la viande ratatinée, vous ouvrez vos yeux et réalisez que tout s\'agissait d\'un cauchemar. Curieux, vous partez à la recherche de la véritable grotte d\'Etrep. </p><p align=center>DÉFAITE</p>';
                
                }	
        
            else{
                
                echo'<br/><p align=justify>Vous tentez votre chance. Au moment sublime que vous croyez que vous allez gagner, des griffes pointues transpercent votre coeur. Mourant, vous regrettez d\'avoir essayé. Heureusement, un vieux magicien vous retrouve et vous soigne avec sa potion magique. Vous décidez de vous enfuir... ou de retourner à la grotte. </p><p align=center>DÉFAITE</p>' ;
                
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
        </div>
    
        <a href="../accueil/accueil.php"><div class="boutonAccueil"></div></a>
        
        <div class="liens"><a href="../accueil/accueil.php">Accueil</a> - <a href="../Machine a sous/machine.php">La grotte d'Etrep</a> - <a href="../des/de.php">La Taverne ignée</a> - <a href="../jeu3/jeu3.html">Jeu à venir</a></div>
    
    </div>
</body>
</html>
