<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
<body>

<?php

$index = isset($_GET['page'])? $_GET['page'] : '';

//récupère le répertoire racine du site
$tab = explode('/',$_SERVER['SCRIPT_FILENAME'],-1);
$root = implode('/',$tab); 


$pagePath  = 'application/views/pages/';
$cachePath = 'application/cache/';
$controllerPath ='application/controllers/';
$templatePath= 'application/views/templates/';

if ($index == ''){

	//formulaire
	echo '<form action="vider.php" method="post">';
	echo '<table border=1>
	<thead><tr><th>fichier</th><th>date de modification du fichier</th><th>cache</th><th>controlleur</th><th>header</th><th>footer</th></tr>
	<tbody>';
	//cache de la page par défaut
	if (
		file_exists($cachePath.'fca739c7c603052947e18ba0b106880c') && (
			filemtime($pagePath.'index.php') > filemtime($cachePath.'fca739c7c603052947e18ba0b106880c') || 
			filemtime($controllerPath.'Pages.php') > filemtime($cachePath.'fca739c7c603052947e18ba0b106880c') ||
			filemtime($templatePath.'header.php') > filemtime($cachePath.'fca739c7c603052947e18ba0b106880c') ||
			filemtime($controllerPath.'footer.php') > filemtime($cachePath.'fca739c7c603052947e18ba0b106880c')	
		)
	){
		echo '<tr><td><input type="checkbox" name="page[]" value="racine" checked="true">racine</td>
		<td>'.date("d F Y H:i:s",filemtime($pagePath.'index.php')).'</td>
		<td>'.date("d F Y H:i:s",filemtime($cachePath.'fca739c7c603052947e18ba0b106880c')).'</td></tr>';
	}

	//parcours le répertoire pages et affiche une checkbox pour chaque page qui a un fichier de cache
	$files = scandir($pagePath);

	foreach ($files as $file){
		if ($file != '.' && $file != '..'){
			$nom = basename($file, ".php");
			$nomCache = uri_md5($nom);
			if (
				file_exists($cachePath.$nomCache) && (
					filemtime($pagePath.$file) > filemtime($cachePath.$nomCache) || 
					filemtime($controllerPath.'Pages.php') > filemtime($cachePath.$nomCache) ||
					filemtime($templatePath.'header.php') > filemtime($cachePath.$nomCache) ||
					filemtime($controllerPath.'footer.php') > filemtime($cachePath.$nomCache)	
				)
			){
				echo '<tr><td><input type="checkbox" name="page[]" value="'.$file.'" checked="true">'.$file.'</td>
				<td>'.date("d F Y H:i:s",filemtime($pagePath.$file)).'</td>
				<td>'.date("d F Y H:i:s",filemtime($cachePath.$nomCache)).'</td>
				<td>'.date("d F Y H:i:s",filemtime($controllerPath.'Pages.php')).'</td>
				<td>'.date("d F Y H:i:s",filemtime($templatePath.'header.php')).'</td>
				<td>'.date("d F Y H:i:s",filemtime($controllerPath.'footer.php')).'</td>
				</tr>';
			}
		}	
	}
	echo '</tbody></table>';
	echo '<input type="submit" value="Effacer">
	</form>';
}
else{
	//efface les fichiers cochés
	foreach ($index as $value){
		if($value == 'racine'){
			unlink('application/cache/fca739c7c603052947e18ba0b106880c');
			echo 'Le cache de la page racine a été effacé<br>';
		}
		else if (unlink('application/cache/'.uri_md5(basename($value, ".php")))){
			echo 'Le cache de la page '.$value.' a été effacé<br>';
		}
		else {
			echo "La page ".$value." n'existe pas en cache<br>";
		}
	}
	echo '<a href="vider.php">retour</a>';
}

function uri_md5($pageName){
	$base_url = 'http://getup-startup.com/';
	$index_page = 'index.php';
	$uri =  $base_url.$index_page.$pageName; 
	return md5($uri);	
}
?>
</body>
</html>