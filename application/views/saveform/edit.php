<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="/assets/css/docs.css">
		<link rel="stylesheet" href="/assets/css/codemirror.css">
		
		<script src="/assets/js/codemirror.js"></script>
		<script src="/assets/js/matchbrackets.js"></script>
		<script src="/assets/js/htmlmixed.js"></script>
		<script src="/assets/js/xml.js"></script>
		<script src="/assets/js/javascript.js"></script>
		<script src="/assets/js/css.js"></script>
		<script src="/assets/js/clike.js"></script>
		<script src="/assets/js/php.js"></script>

	</head>
	<body>

<?php echo validation_errors(); ?>
<?php
	if ($save == true){
		echo '<div class="alert alert-success" style="margin:10px;width:300px;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Fichier enregistré avec succès.
</div>';
	}
		
?>
<?php //echo form_open('pages/edit'); 
echo '<form action="'.$page.'" method="post" accept-charset="utf-8">';?>

<?php echo $filePath;?>

    <textarea name="code" id="code">
<?php echo file_get_contents($filePath);?>
	</textarea>
	<br />
    <input type="submit" name="submit" value="Enregistrer" />

</form>

<script>
			var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
				lineNumbers: true,
				matchBrackets: true,
				mode: "application/x-httpd-php",
				indentUnit: 4,
				indentWithTabs: true
			 });
		</script>

				<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>