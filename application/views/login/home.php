	         <!-- CORPO PAGINA -->
	        <div id="page-wrapper">

	            <div class="container-fluid">

	                <!-- Page Heading -->
	                <div class="row">
	                    <div class="col-lg-12">
	                        <h1 class="page-header">
	                        	<?php if($usuario["tipo_usuario"] == 1 || $usuario["tipo_usuario"] == 2): ?>
	                            	Meus Eventos <small>em andamento</small>
	                            <?php endif ?>
	                            <?php if($usuario["tipo_usuario"] == 3): ?>
	                            	Certificados <small>disponíveis</small>
	                            <?php endif ?>
	                        </h1>
	      
	                    </div>
	                </div>
	                   <?php
							if(count($eventos)>=1){
								foreach($eventos as $evento){
						?> 
							<div class="col-md-4">
				                <div class="panel panel-default">
				                    <div class="panel-heading">
				                        <h4><i class="fa fa-fw fa-check"></i> <?= $evento['nome_evento']; ?> </h4>
				                    </div>
				                    <div class="panel-body">
				                        <p>Data: <?= $evento['data_evento']; ?></p>
				                        <p>Local: <?= $evento['local_evento']; ?></p>
				                        <?php if($usuario["tipo_usuario"] == 1 || $usuario["tipo_usuario"] == 2): ?>
					                        <form method="POST" action= "<?= site_url('detalhar-evento'); ?>">
					                        	<input type="text" hidden value="<?= $evento['id_evento']; ?>" name="evento[id_evento]">
					                        	<button type="submit" class="btn btn-default">Detalhes</button>
					                        </form>
						                <?php endif ?>
				                        <?php if($usuario["tipo_usuario"] == 3): ?>
				                        	 <form method="POST" action= "<?= site_url('emitir-certificado'); ?>">
					                        	<input type="text" hidden value="<?= $evento['id_evento']; ?>" name="evento[id_evento]">
					                        	<input type="text" hidden value="<?= $evento['nome_evento']; ?>" name="evento[nome_evento]">
					                        	<input type="text" hidden value="<?= $evento['carga_horaria_evento']; ?>" name="evento[carga_horaria_evento]">
					                        	<input type="text" hidden value="<?= $evento['data_evento']; ?>" name="evento[data_evento]">
					                        	<input type="text" hidden value="<?= $evento['local_evento']; ?>" name="evento[local_evento]">
					                        	<input type="text" hidden value="<?= $evento['nome_responsavel_evento']; ?>" name="evento[responsavel_evento]">
					                        	<input type="text" hidden value="<?= $evento['cargo_responsavel_evento']; ?>" name="evento[cargo_responsavel_evento]">
					                        	<input type="text" hidden value="<?= $evento['assinatura_responsavel_evento']; ?>" name="evento[assinatura_responsavel_evento]">
					                        	<input type="text" hidden value="<?= $evento['tipo_participacao']; ?>" name="evento[tipo_participacao]">
					                        	<button type="submit" class="btn btn-default">Visualizar</button>
					                        </form>
				                        <?php endif ?>
				                    </div>
				                </div>
			            	</div>
						<?php 
								} 
							}else{
						?>		
								<div class="row">
					                <div class="col-lg-12">
					                    <div class="alert alert-info alert-dismissable">
					                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                        <?php if($usuario["tipo_usuario"] == 1 || $usuario["tipo_usuario"] == 2): ?>
					                            <i class="fa fa-info-circle"></i>  <strong>Sem eventos para gerenciar?</strong> <a href=<?= site_url('novo-evento'); ?> class="alert-link">Clique aqui</a> para criar!
					                        <?php endif ?>
					                        <?php if($usuario["tipo_usuario"] == 3): ?>
				                            	<i class="fa fa-info-circle"></i>  <strong>Você ainda não possui nenhum certificado disponível</strong>
				                            <?php endif ?>
					                    </div>
					                </div>
					            </div>
						<?php
							}
						?>

	                </div>
	                <!-- /.row -->
	            </div>
	        </div>
     	</div>
     	<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>    
        <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
	</body>
</html>