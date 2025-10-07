<?php 
include_once("../controller/usuario.controller.php");
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
			<h3>Usuário</h3><hr>
		<div class="card">
		<div class="card-header"><b>
            Cadastrar Usuario
        </b> </div>
		<div class="card-body">
		<form method="POST" action="?acao=cadastrar">
				<div class="form-group">
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<div class="form-group">
					<label>CPF:</label>
					<input type="text" name="cpf" class="form-control" required>
					
				</div>
					 <div class="form-group">
					<label>Senha:</label>
					<input type="text" name="sen" class="form-control" required>
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
					<label>CPF:</label>
					<input type="text" name="cpf" class="form-control" required>
				</div>
                <div class="form-group">
					<label>Senha:</label>
					<input type="text" name="sen" class="form-control" required>
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
					<label>Código do Usuario:</label>
					<input type="text" name="codigo" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" value="Excluir">
			</form>
		</div>
        <div class="card-header">
            Consultar por nome
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
            Consultar por código
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


		<br><br><br>


		<div class="card-header">
            Login
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=login">
				<div class="form-group">
					<label>Nome:</label>
					<input type="text" name="nom" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Senha:</label>
					<input type="text" name="sen" class="form-control" required>
				</div> 
		<div class="card-body">
		<form method="POST" action="?acao=consultar_json">
				<input type="submit" class="btn btn-primary" value="Login">
			</form>
		</div>



		<div class="card-header">
            Verificar CPF
        </div>
		<div class="card-body">
		<form method="POST" action="?acao=vCpf">
				<div class="form-group">
					<label>CPF:</label>
					<input type="text" name="cpf" class="form-control" required>
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