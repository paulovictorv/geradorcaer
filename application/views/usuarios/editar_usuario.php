			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="page-header">
						<h4 style="text-align: center">Alterar Dados </h4> <br>
					</div>
					<form method="POST" action="<?= site_url('atualizar-usuario'); ?>">
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<?php if($this->session->flashdata("success")): ?>
									<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>			
								<?php endif ?>
								<?php if($this->session->flashdata("danger")): ?>
									<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")?>  </p>
								<?php endif ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="id">ID</label>
								<input class="form-control" type="text" readonly value="<?= $user['id_usuario']; ?>" name="usuario[id_usuario]">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="nome">NOME</label>
								<input class="form-control" type="text" value="<?= $user['nome_usuario'] ?> " id="nome" name="usuario[nome_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="email">EMAIL</label>
								<input class="form-control" type="email" value="<?= $user['email_usuario']; ?>" id="email" name="usuario[email_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="cpf">CPF</label>
								<input class="form-control" type="text" value="<?= $user['cpf_usuario']; ?>" id="cpf" name="usuario[cpf_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-1">
								<a href="<?= site_url('listar-usuarios'); ?>" class="btn btn-primary">Voltar</a>
							</div>
							<div class="col left">
								<button type="submit" class="btn btn-success">Salvar</button>
							</div>
						</div>
					</form>
					</br></br></br></br></br></br></br>
				</div>
			</div>
		</div>
		<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>	
		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.maskedinput.js'); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){	
				$("#cpf").mask("999.999.999-99");
			});
		</script>
	</body>
</html>