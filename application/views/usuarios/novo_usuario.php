			
			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="page-header">
						<h4 style="text-align: center"> Novo Usuário </h4> <br>
					</div>
					<form method="POST" action="<?= site_url('criar-usuario'); ?>">
						<div class="row">
							<div class="col-md-3 col-md-offset-4">
								<?php if($this->session->flashdata("success")): ?>
									<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>			
								<?php endif ?>
								<?php if($this->session->flashdata("danger")): ?>
									<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")  ?>  </p>
								<?php endif ?>
								<?php $arvore = "tres"; ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="nome">Nome Completo</label>
								<input placeholder="Ex: João da Silva" class="form-control" type="text" id="nome" name="usuario[nome_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="email">Email</label>
								<input placeholder="Ex: joao@silva.com" class="form-control" type="email" id="email" name="usuario[email_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="cpf">CPF</label>
								<input placeholder="Ex: 000.000.000-00" class="form-control" type="text" id="cpf" name="usuario[cpf_usuario]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="tipo_usuario">Tipo de Usuário</label>
								<select class="form-control" name="usuario[tipo_usuario]" id="teste">
									  <option  value="3">Participante</option>
									  <option  value="2">Coordenação</option>
									  <option  value="1">Administrador</option>
								</select>
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
		<script src="<?php echo site_url('assets/js/jquery.maskedinput.js'); ?>"></script>

		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){	
				$("#cpf").mask("999.999.999-99");
			});
		</script>

	</body>
</html>