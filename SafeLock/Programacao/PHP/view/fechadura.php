<?php 
include_once("../controller/fechadura.controller.php");
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
			<h3>Fechadura</h3><hr>
		<div class="card">
		<div class="card-header"><b>
            Cadastrar Fechadura
        </b> </div>
		<div class="card-body">
		<form method="POST" action="?acao=cadastrar">
				<div class="form-group">
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<div class="form-group">
					<label>PIN:</label>
					<input type="text" name="pin" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Cod Usuario:</label>
					<input type="text" name="cdUser" class="form-control" required>
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
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<div class="form-group">
					<label>PIN:</label>
					<input type="text" name="pin" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Cod Usuario:</label>
					<input type="text" name="cdUser" class="form-control" required>
				</div>
                <div class="form-group">
					<label>Código:</label>
					<input type="text" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Alterar">
			</form>
		</div>
        
		
		<div class="card-header">
            Excluir
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=excluir">
				<div class="form-group">
					<label>Código da Fechadura:</label>
					<input type="text" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Excluir">
			</form>
		</div>
        <div class="card-header">
            Consultar por Nome
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=retorna_nome">
				<div class="form-group">
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Consultar">
			</form>
		</div>
        <div class="card-header">
            Consultar por Código
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=retorna_cod">
				<div class="form-group">
					<label>Código:</label>
					<input type="text" name="codigo" class="form-control" required>
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
            Verificar PIN
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=vPin">
				<div class="form-group">
					<label>PIN:</label>
					<input type="text" name="pin" class="form-control" required>
				</div> 
		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Login">
			</form>
		</div>



		
		<br><br><br>


		<div class="card-header">
            Fechadura
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=fechadura">
				<div class="form-group">
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<div class="form-group">
					<label>PIN:</label>
					<input type="text" name="pin" class="form-control" required>
				</div> 
		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Login">
			</form>
		</div>

		<div class="card-header">
            Consultar fechadura
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=consultar_Fechadura">
				<div class="form-group">
					<label>Cod User:</label>
					<input type="text" name="cdUser" class="form-control" required>
				</div>

		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Login">
			</form>
		</div>





















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
	crossorigin="anonymous"></script>
</body>
</html>