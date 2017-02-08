
	
<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="<?php echo site_url('img/certificate-icon');?>" />
		<title> Meu Certificado </title>
		<link rel="stylesheet" href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
	</head>
	
	<body>
		<br><br>
		<h1 align = "center"> Meu Certificado </h1>
		<br><br><br>


		<div class="container">

			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php if($this->session->flashdata("success")): ?>
					<p class="alert alert-success" style="text-align: center"> <?=  $this->session->flashdata("success") ?>  </p>	
					<?php endif ?>

					<?php if($this->session->flashdata("danger")): ?>
					<p class="alert alert-danger" style="text-align: center"> <?=  $this->session->flashdata("danger")?>  </p>
					<?php endif ?>
				</div>
			</div>
			<!-- Mensagens de validação de login.
			 -->
			<div class="row">
	            <div class="col-md-4 col-md-offset-4">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading">
	                        <h3 class="panel-title">Bem-vindo</h3>
	                    </div>
	                    <div class="panel-body">
	                        <form role="form" method="POST" action= "<?= site_url('valida-login'); ?>">
	                            <fieldset>
	                                <div class="form-group">
	                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
	                                </div>
	                                <div class="form-group">
	                                    <input class="form-control" placeholder="Senha" name="senha" type="password" >
	                                </div>
	                                 <!-- 
	                                <div class="checkbox">
	                                    <label>
	                                        <input name="remember" type="checkbox" value="Remember Me">Lembra-me
	                                    </label>
	                                </div>
	                                 -->
	                                <button type="submit" class="btn btn-lg btn-success btn-block">Entrar</button>
	                            </fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
		</div>
		<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>	
		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>	
	</body>

</html>