<?php 
include_once("../controller/relacao.controller.php");

$dia = date('dd');
$mes = date('mm');
$ano = date('Y');

$data = $dia."/".$mes."/".$ano

?>      
<!DOCTYPE html>
<html>
<head>
	<title>Tela PHP</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<br>
		<div class="col-12">
			<h3>Relação</h3><hr>
		<div class="card">
		<div class="card-header"><b>
            Cadastrar Relação
        </b> </div>
		<div class="card-body">
		<form method="POST" action="?acao=cadastrar">
				<div class="form-group">
					<label>Cod Usuário:</label>
					<input type="number" name="cdUser" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Cod Fechadura:</label>
					<input type="number" name="cdFecha" class="form-control" required>
					
				</div>
					 <div class="form-group">
					<label>Estado:</label>
						<select name="slEstado">
							<option value="0">Fechado</option>
							<option value="1">Aberto</option>
						</select>


				</div>
				<input type="submit" class="btn btn-primary" value="Cadastrar">
			</form>
		
		
		</div>
        <div class="card-header">
            Alterar
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=atualizar">

        <div class="form-group">
					<label>Cod Usuário:</label>
					<input type="number" name="cdUser" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Cod Fechadura:</label>
					<input type="number" name="cdFecha" class="form-control" required>
					
				</div>
					 <div class="form-group">
					<label>Estado:</label>
					<input type="number" name="est" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Código da Relação:</label>
					<input type="number" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Alterar">
			</form>
		</div>
        
         <div class="card-header">
            Alterar
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=atualizar">

        <div class="form-group">
					<label>Cod Usuário:</label>
					<input type="number" name="cdUser" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Cod Fechadura:</label>
					<input type="number" name="cdFecha" class="form-control" required>
					
				</div>
					 <div class="form-group">
					<label>Estado:</label>
					<input type="number" name="est" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Código da Relação:</label>
					<input type="number" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Alterar">
			</form>
		</div>

        <div class="card-header">
            Consultar Estado Fechadura
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=retorna_ultimo_estado">
				<div class="form-group">
					<label>Código:</label>
					<input type="number" name="cdFecha" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>
        <div class="card-header">
            Consultar
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

		
		<div class="card-header">
            Excluir
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=excluir">
				<div class="form-group">
					<label>Código da Relação:</label>
					<input type="number" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Excluir">
			</form>
		</div>
        <div class="card-header">
            Consultar por Código da Relação
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=retorna_cod">
				<div class="form-group">
					<label>Código:</label>
					<input type="number" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>
        <div class="card-header">
            Consultar
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>

		Consultar Relacao
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=consultar_Relacao">
				<div class="form-group">
					<label>Cod Fechadura:</label>
					<input type="text" name="cdFecha" class="form-control" required>
				</div>
				<div class="card-body">
			<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>


		<br><br><br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
	crossorigin="anonymous"></script>
</body>
</html>