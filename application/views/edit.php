<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Unidades Organizacionais</title>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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

            <ul class="nav dropdown-menu">
                <li><a href="#"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Profile</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-dashboard" style="color:#0000aa;"></i> Dashboard</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Pages</a></li>
                <li class="nav-divider"></li>
                <li><a href="#"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-plus"></i> More..</a></li>
            </ul>


            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
    </div>
</div>

<!--main-->
<div class="container" id="main">
    <div class="row">

        <div class="col-md-12 col-sm-12">

            <?php
            if(isset($sucesso) && $sucesso == true){
                ?>

                <div class="alert alert-success" role="alert">Unidade cadastrada com sucesso</div>

            <?php } ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>EDITAR UNIDADE ORGANIZACIONAL</h3>
                </div>
                <div class="panel-body">

                    <form action="create" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" id="exampleInputNome" placeholder="Nome" name="name" disabled="disabled">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCNPJ">CNPJ</label>
                            <input type="text" class="form-control" id="exampleInputCNPJ" placeholder="CNPJ" name="cnpj" disabled="disabled">
                        </div>
                        <button type="submit" class="btn btn-default">EDITAR</button>
                    </form>

                </div>
            </div>
        </div>

    </div><!--/row-->

</div><!--/main-->

</body>
</html>