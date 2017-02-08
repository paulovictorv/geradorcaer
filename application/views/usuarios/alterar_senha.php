			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="page-header">
						<h4 style="text-align: center">Alterar Senha </h4> <br>
					</div>
							        <div class="row">
										<div class="col-md-4 col-md-offset-4">
											<?php if($this->session->flashdata("success")): ?>
												<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>
											<?php endif ?>
											<?php if($this->session->flashdata("danger")): ?>
												<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")?>  </p>
											<?php endif ?>
										</div>
									</div>
					<form method="POST" action="<?= site_url('atualizar-senha'); ?>">
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="id">Senha Atual</label>
								<input placeholder="Senha Atual" class="form-control" type="password" name="senha_atual" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="nome">Nova Senha</label>
								<input placeholder="Nova Senha" class="form-control" type="password" name="nova_senha" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-4">
								<label for="nome">Cofirme Nova Senha</label>
								<input placeholder="Confirme Nova Senha" class="form-control" type="password" name="confirmacao_nova_senha" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-4 col-md-1">
								<a href="<?= site_url('visualizar-perfil'); ?>" class="btn btn-primary">Voltar</a>
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
		<!-- Scripts template
		<script src="<?php echo site_url('assets/js/plugins/morris/raphael.min.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/plugins/morris/morris.min.js'); ?>"></script>
		-->
	</body>
</html>