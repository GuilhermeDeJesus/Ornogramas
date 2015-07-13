<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Unidades Organizacionais</title>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

</head>
	<body>
<nav class="navbar navbar-fixed-top header">
 	<div class="col-md-12">
        <div class="navbar-header">
          
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1">
          <i class="glyphicon glyphicon-search"></i>
          </button>
      
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse1">
          <ul class="nav navbar-nav navbar-right">
             <li><a href="http://www.bootply.com" target="_ext">Bootply+</a></li>
             <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><span class="badge pull-right">40</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">2</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">0</span>Link</a></li>
                  <li><a href="#"><span class="label label-info pull-right">1</span>Link</a></li>
                  <li><a href="#"><span class="badge pull-right">13</span>Link</a></li>
                </ul>
             </li>
             <li><a href="#" id="btnToggle"><i class="glyphicon glyphicon-th-large"></i></a></li>
             <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
           </ul>
        </div>	
     </div>	
</nav>
<div class="navbar navbar-default" id="subnav">
    <div class="col-md-12">
        <div class="navbar-header">     
              <a href="index" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Unidades Organizacionais</a>                   
        </div>
     </div>	
</div>

<!--main-->
<div class="container" id="main">
   <div class="row">
      <!-- search -->
   <div class="col-md-12 col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <?php 
          $id_pai = array();
          foreach ($unidade as $u) { array_push($id_pai, $u->id); ?>
            <h5><b>Nome</b>: <?=$u->name;?>    <b>CNPJ</b>: <?=$u->cnpj;?> </h5>
            <?php } ?>
        </div>
        <div class="panel-body">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>Unidade Subordinada</th>
                              <th>CNPJ</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                            if(count($unidades) == 0){
                                $nda = "Nenhum resultado encontrado";
                            ?>
                                  <tr>                             
                                      <td><?php if(isset($nda)){echo $nda;} ?></td>
                                  <tr>
                            <?php } ?>

                             <?php 
                             $uniths = array();
                             foreach ($unidades as $u) { array_push($uniths, $u->id); ?>
                                  <tr>                 
                                      <td><?=$u->name; ?></td>
                                      <td><?=$u->cnpj; ?></td>                                   
                                  </tr>
                            <?php } ?>
                          </tbody>
                      </table>
                  </div>
        </div>
      </div>

      <div class="panel panel-info">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <h5>ADICIONAR MAIS UMA UNIDADE A ESTA ORGANIZAÇÃO</h5>
        </div>
        <div class="panel-body">
                  <form action="../insert_nova_estrutura" method="post" >
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nome</label>
                          <select class="form-control chosen-select" name="id_filho">
                            <?php foreach ($all_unidades as $value) { 
                                if(!in_array($value->id, $uniths)) {
                                  if(!in_array($value->id, $id_pai)){ ?>
                                  <option value="<?=$value->id;?>"><?=$value->name;?></option>
                            <?php }}} ?>
                          </select>
                           <?php foreach ($unidade as $u) { ?>
                           <input type="hidden" name="id_pai" value="<?=$u->id;?>"/>
                           <?php } ?>
                    </div>
                    <button type="submit" class=" btn btn-default">CADASTRAR</button>
                  </form>
        </div>
      </div>
  	</div>
    </div><!--/row-->
  </div><!--/main-->


	</body>
</html>