<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Unidades Organizacionais</title>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <script type="text/javascript">

        function deletar(id){
              $.ajax({
                  'url' : 'delete/' + id,
                  'type' : 'POST', //the way you want to send data to your URL
                  'error': function(){
                      alert('Não foi possível excluir esta unidade');
                  },
                  'success' : function(data){ //probably this request will return anything, it'll be put in var "data"

                      if(data > 0){
                             $("#confirmacao").modal('show');
                              window.id = id;
                         }else if(data == 0){
                          $.ajax({
                              'url' : 'delete_unidade/' + id,
                              'type' : 'POST', //the way you want to send data to your URL
                              'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                                  $("#sucesso").modal('show');
                                  $("#ok").click(function(){
                                      window.location.reload(true);
                                  });
                                  // window.location.reload(true);
                              },
                              'error': function(){
                                  alert('Não foi possível excluir esta unidade');
                                  alert(id);
                              }
                          });
                      }
                  } // end success
              });
          }

        function confirmar_exclusao(){
            $.ajax({
                'url' : 'delete_filhos/' + window.id,
                'type' : 'POST', //the way you want to send data to your URL
                'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                    $("#confirmacao").modal('hide');
                },
                'error': function(){
                    alert("Erro ao excluir unidades filhas");
                    $("#confirmacao").modal('hide');
                    window.location.reload(true);
                }
            });
        }

        // acho que não presto -- naamm :[-]
        function download(){
            $("#download").modal('show');
        }        

    </script>

</head>
	<body>
    <div id="confirmacao" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmação</h4>
                </div>
                <div class="modal-body">
                    <p>Já existe unidades subordinadas a esta entidade, você deseja realmente excluir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary" id="confirmado_exclusao" onclick="confirmar_exclusao();">Sim</button>
                </div>
            </div>
        </div>
    </div>
    <div id="sucesso" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Confirmação</h4>
                </div>
                <div class="modal-body">
                    <p>Unidade excluída com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="ok">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <div id="download" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Realizando download, por favor, aguarde!</p>
                </div>
            </div>
        </div>
    </div>
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
   <div class="col-md-12 col-sm-12">
    <h3>UNIDADES ORGANIZACIONAIS</h3>
    <div class="pull-right btn-group">
    </div>
   	        <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Unidade</th>
                        <th>CNPJ</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($unidades as $u) { ?>
                            <tr>
                                <td><?=$u->name; ?></td>
                                <td><?=$u->cnpj; ?></td>
                                <td>        
                                  <a href="editar/<?=$u->id;?>" class="btn btn-success" title="Nova Unidade"><i class="glyphicon glyphicon-pencil"></i></a>
                                  <button class="btn btn-danger" type="button" id="deletar" onclick="deletar(<?=$u->id;?>);" ><i class="glyphicon glyphicon-trash"></i></button>
                                </td>
                                <td>
                                  <form action="download_unidades/<?=$u->id;?>" >
                                  <button type="submit" id="download" class="btn btn-warning"><i class="glyphicon glyphicon-download-alt"></i></button>
                                </form>
                                </td> 
                            </tr>
					           <?php } ?>
                    </tbody>
                </table>
            </div>
	</div>
  </div><!--/row-->
</div><!--/main-->

	</body>
</html>