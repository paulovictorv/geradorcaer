			
			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="page-header">
						<div class="form-group col-md-offset-4">
							<h4> Novo Responsavel </h4> <br>
						</div>
					</div>
					<form method="POST" action="<?= site_url('criar-responsavel'); ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3 col-md-offset-4">
								<?php if($this->session->flashdata("success")): ?>
									<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>			
								<?php endif ?>
								<?php if($this->session->flashdata("danger")): ?>
									<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")  ?>  </p>
								<?php endif ?>
								<?php $id = $this->session->userdata('usuario_logado')['usuario']['id_usuario']; ?>
							</div>
						</div>
						<div class="row">
							<input value="<?= $id ?>"  type="text"  name="responsaveis_evento[id_usuario_criador]" hidden>
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="nome">Nome Completo</label>
								<input placeholder="Ex: João da Silva" class="form-control" type="text" id="nome" name="responsaveis_evento[nome_responsavel_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="email">Cargo</label>
								<input placeholder="Ex: Coordenador de Medicina" class="form-control" type="text" id="cargo_responsavel_evento" name="responsaveis_evento[cargo_responsavel_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="responsavel_evento">Assinatura Responsável</label>
								<input class="form-control" type="file" id="assinatura_responsavel_evento" name="assinatura_responsavel_evento" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-1">
								<a href="<?= site_url('listar-responsaveis'); ?>" class="btn btn-primary">Voltar</a>
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

	</body>
</html>