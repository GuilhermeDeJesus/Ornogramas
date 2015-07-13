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
                  'url' : 'UnidadesOrganizacionais/delete/' + id,
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
                              'url' : 'UnidadesOrganizacionais/delete_unidade/' + id,
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
                              }
                          });
                      }
                  } // end success
              });
          }

        function confirmar_exclusao(){
            $.ajax({
                'url' : 'UnidadesOrganizacionais/delete_filhos/' + window.id,
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

    <div class="navbar navbar-default" id="subnav">
        <div class="col-md-12">
            <div class="navbar-header">
              
              <a href="index" style="margin-left:540px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown">
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
                    </tr>
                    </thead>
                    <tbody>
                    	<?php foreach ($unidades as $u) { ?>
                            <tr>                         	
                                <td><?=$u->name; ?></td>
                                <td><?php
                                    $val  = $u->cnpj;
                                    $mask = '##.###.###/####-##';
                                    $maskared = '';
                                    $k = 0;
                                    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
                                      if ($mask[$i] == '#') {
                                        if (isset ($val[$k]))
                                          $maskared .= $val[$k++];
                                      } else {
                                        if (isset ($mask[$i]))
                                          $maskared .= $mask[$i];
                                      }
                                    }
                                    ?>
                                    <?=$maskared; ?>
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