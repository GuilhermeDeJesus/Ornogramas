<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css" />

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	
	</style>

</head>
<body>

	<div id="container">
		<h1>Fabricante!</h1>

		<div id="body">
			<pre>

        	<?php for($i=0; $i < count($fabricante); ++$i){ ?>
        	
        		<?php echo form_open("Fabricante/update/".$fabricante[$i]->codigo); ?>
        		<?php echo form_label("Descricao"); ?>
        		<?php echo form_textarea(array("id" => "descricao", "name" => "descricao", "value" => $fabricante[$i]->descricao)); ?>
        		<?php echo form_submit(array("id" => "submit", "value" => "Editar")); ?>
        		<?php echo form_close(); ?>
        	
        	<?php } ?>
	
		</div>
	</div>

</body>
</html>