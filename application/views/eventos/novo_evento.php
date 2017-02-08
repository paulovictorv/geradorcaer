			<div id="page-wrapper">
		        <div class="container-fluid">
		        	<div class="page-header">
						<div class="form-group col-md-offset-4">
							<h4> Criar Evento </h4> <br>
						</div>
					</div>
					<form method="POST" action="<?= site_url('criar-evento'); ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3 col-md-offset-4">
								<?php if($this->session->flashdata("success")): ?>
									<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>			
								<?php endif ?>
								<?php if($this->session->flashdata("danger")): ?>
									<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")?>  </p>
								<?php endif ?>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="nome">Nome do Evento</label>
								<input placeholder="Ex: 5º Feira da Ulbra" class="form-control" type="text" id="nome" name="evento[nome_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="carga_horaria">Carga Horária</label>
								<input placeholder="Ex: 10" class="form-control" maxlength="2" onkeyup="somenteNumeros(this);" type="text" id="carga_horaria" name="evento[carga_horaria_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="data_evento">Data do Evento</label>
								<input class="form-control" type="text" id="data_evento" name="evento[data_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label  for="data_evento">Local do Evento</label>
								<input placeholder="Ex: Ginásio da Ulbra" class="form-control" type="text" id="local_evento" name="evento[local_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="tipo_usuario">Responsavel</label>
								<select class="form-control" name="evento[id_responsavel_evento]" required>
									<?php 
										foreach ($responsaveis as $responsavel) {
											if($responsavel['id_usuario_criador'] == $usuario['id_usuario']){
									?>
										 <option  value="<?= $responsavel['id_responsavel_evento']; ?>"><?= $responsavel['nome_responsavel_evento']; ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="layout_evento">Layout do Evento</label>
								<input class="form-control" type="file" id="layout_evento" name="layout_evento" required>
							</div>
						</div>
						<div class="row">
							<input class="form-control" type="hidden" id="id_usuario" name="evento[id_usuario]" value= "<?= $usuario['id_usuario']; ?>">
						</div>
						<div class="row">
						 	<div class="form-group col-md-offset-4 col-md-2">
			                    <a href="<?= site_url('index'); ?>" class="btn btn-primary">Voltar</a>
			                </div>
			                <div class="form-group col-md-2">
								<button type="submit" class="btn btn-success">Criar</button>
							</div>
						</div>
					</form>
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
		<script>
		    function somenteNumeros(num) {
		        var er = /[^0-9.]/;
		        er.lastIndex = 0;
		        var campo = num;
		        if (er.test(campo.value)) {
		          campo.value = "";
		        }
		    }
 		</script>
	</body>
</html>