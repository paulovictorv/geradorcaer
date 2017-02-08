			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="col s12">
						
						<?php
							/*
							if(count($eventos)==0){
						?>	
							<br><br>
							<div class="row">
					            <div class="col-lg-12">
					                <div class="alert alert-info alert-dismissable">
					                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				                        <i class="fa fa-info-circle"></i> <strong>Nenhum evento foi encerrado ainda!</strong>
					               </div>
					            </div>
					        </div>
					    <?php
							}else{
							*/	
						?> 
						
						<div class="page-header">
							<h4 style="text-align: center"> Eventos Encerrados </h4> <br>
						</div>
						<form class="navbar-form navbar-right" role="search" method="POST" action="<?= site_url('pesquisar-evento'); ?>">
							<div class="form-group">
							 	<input type="text" class="form-control" name="nome_informado" placeholder="Pesquise aqui..">
							</div>
						  	<button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Data</th>
									<th>Local</th>
									<th>Responsável</th>
									<th>Participantes</th>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($eventos as $evento){
							?> 
								<tr>
									<td><?= $evento['nome_evento']; ?></td>
									<td><?= $evento['data_evento']; ?></td>
									<td><?= $evento['local_evento']; ?></td>
									<td><?= $evento['nome_responsavel_evento']; ?></td>
									<td><?= $evento['num_participantes']; ?></td>
								</tr>
							
							<?php 
							
								} 
							//}
							?>
							
							</tbody>
						</table>
					</div>
					</br></br></br></br>
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