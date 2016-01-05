<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $title; ?> - GetUP!</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<!--ajoute un point de cassure supplémentaire à bootstrap : ms (min-width: 480px) and (max-width: 767px) pour les smartphones-->
	<link rel="stylesheet" href="assets/css/bootstrap_ms.css" />
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="author" href="/humans.txt" />
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php
	
	function print_menu($data){
		foreach ($data as $intitule => $url){
			if($intitule == 'rang'){
				$rang = $url;
			}
			else{
				switch($rang){
					case 1 : echo('<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$intitule.'<b class="caret"></b> </a>');	
						if (is_array($url)){
							sous_menu($url);
						}
						else {
							echo('</li>');
						}
						break;
					case 2 : if (is_array($url)){
							echo'<li class="dropdown-submenu"><a tabindex="-1" href="'.$url['url'].'">'.$intitule.'</a>';
						}
						else{
							echo'<li><a href="'.$url.'">'.$intitule.'</a></li>';
						}
						if (is_array($url)){
							sous_menu($url);
						}
						break;
					case 3 : echo '<li><a href="'.$url.'">'.$intitule.'</a></li>'; 
				}
				
			}
		}
	}
	
	function sous_menu($url){
		echo('<ul class="dropdown-menu">');
		print_menu($url);
		echo('</ul>');
	}

  ?>
  <div class="navbar navbar-custom navbar-fixed-top">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.html">GetUP!</a>
        <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          
		  <?php
		  print_menu($menu);
		  ?>

		  </ul>
      </div>
    </div>
