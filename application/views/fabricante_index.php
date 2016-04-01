<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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

	<div id="body">	<pre>

		<table border="0">
			<tr>
				<td>Id</td> <td>Descricao</td> <td>Acoes</td>
			</tr>
			<?php 
			for($i=0; $i < count($fabricantes); ++$i) { ?>
			<tr>
				<td><?=($i+1)?> </td>
				<td><h3><?=$fabricantes[$i]->descricao;?> </h3></td>
				<td><a href="<?php echo base_url(). "index.php/Fabricante/edit/". $fabricantes[$i]->codigo?>" >Editar</a></td>
			</tr>
			<?php } ?>			
		</table>
		
		<?php echo form_open("Fabricante/insert"); ?>
		<?php echo form_label("Descricao"); ?>
		<?php echo form_input(array("id" => "descricao", "name" => "descricao")); ?><br>
		<?php echo form_submit(array("id" => "submit", "value" => "Submit")); ?>
		<?php echo form_close(); ?>
	</div>
</div>

</body>
</html>