		<div id="page-wrapper">
		    <div class="container-fluid">
					<div class="row">
		                <div class="col-lg-12">
		                	<br> <br>
		                    <div class="panel panel-default">
		                        <div class="panel-body">
		                            <h3 style="text-align: center">Solicitação de Alteração de Dados</h3>
		                            <br><br>
		                            <form method="POST" action="<?= site_url('enviar-solicitacao'); ?>">
			                            <div class="row">
											<div class="form-group col-md-offset-3 col-md-6">
												<textarea placeholder="Escreva aqui sua solicitação .." class="form-control" rows="6" name="solicitacao" required></textarea>
											</div>
										</div>
			                            <div class="row">
				                            <div class="form-group col-md-offset-4 col-md-1">
				                        		<a href="<?= site_url('visualizar-perfil'); ?>" class="btn btn-primary">Voltar</a>
				                        	</div>
				                        	<div class="form-group col-md-offset-1 col-md-3">
												<button type="submit" class="btn btn-success">Enviar</button>
											</div>
										</div>
									</form>
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