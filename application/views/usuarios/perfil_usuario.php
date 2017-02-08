		<div id="page-wrapper">
		    <div class="container-fluid">
					<div class="row">
		                <div class="col-lg-12">
		                	<br> <br>
		                    <div class="panel panel-default">
		                        <div class="panel-body">
		                            <h3 style="text-align: center">Meus Dados</h3>
		                            <br><br>
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
		                            <div class="row ">
		                                <div class="col-md-offset-4 col-md-1"> Nome </div>
		                                <div class="col-md-4"><?= $usuario['nome_usuario'] ?></div>
		                            </div> <br>
		                            <div class="row">
		                                <div class="col-md-offset-4 col-md-1"> Email </div>
		                                <div class="col-md-4"><?= $usuario['email_usuario'] ?></div>
		                            </div> <br>
		                            <div class="row ">
		                                <div class="col-md-offset-4 col-md-1"> CPF </div>
		                                <div class="col-md-4"><?= $usuario['cpf_usuario'] ?></div>
		                            </div> <br> <br>
		                            <div class="row">
			                            <div class="form-group col-md-offset-4 col-md-1">
			                        		<a href="<?= site_url('home'); ?>" class="btn btn-primary">Voltar</a>
			                        	</div>
			                        	<?php if($usuario["tipo_usuario"] == 1 || $usuario["tipo_usuario"] == 2){ ?>
											<div class="form-group col-md-2">
												<a href="<?= site_url('editar-perfil'); ?>" class="btn btn-success">Alterar Dados</a>
											</div>
										<?php }else{ ?>
											<div class="form-group col-md-3">
												<a href="<?= site_url('solicitar-alteracao'); ?>" class="btn btn-success">Solicitar Alteração de Dados</a>
											</div>

										<?php } ?>
										<div class="form-group col-md-2">
											<a href="<?= site_url('alterar-senha'); ?>" class="btn btn-danger">Alterar Senha</a>
										</div>
									</div>
		                        </div>
		                    </div>
		                </div>
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