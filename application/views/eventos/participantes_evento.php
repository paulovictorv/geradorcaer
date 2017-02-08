			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="col s12">
						<?php 
							if($participantes==null){ 
								redirect("home");
							}
						?>
						<div class="page-header">
							<h4 style="text-align: center"> Participantes do evento <?= $participantes[0]['nome_evento']?></h4> <br>
						</div>
						<div class="row">
							<div class="col-md-5 col-md-offset-3">
								<?php if($this->session->flashdata("success")): ?>
									<p class="alert alert-success">  <?=  $this->session->flashdata("success") ?>  </p>			
								<?php endif ?>
								<?php if($this->session->flashdata("danger")): ?>
									<p class="alert alert-danger">  <?=  $this->session->flashdata("danger")?>  </p>
								<?php endif ?>
							</div>
						</div>
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>ID no Evento</th>
									<th>Nome</th>
									<th>Tipo Participação</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(count($participantes)>=1){
								foreach($participantes as $participante){
							?> 
								<tr>
									<td><?= $participante['id_evento_participante']; ?></td>
									<td hidden><?= $participante['id_evento']; ?></td>
									<td><?= $participante['nome_usuario']; ?></td>
									<td><?= $participante['tipo_participacao']; ?></td>
									<td> <a type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="acao btn btn-danger"> <span class="glyphicon glyphicon-trash"> </a> </td>
								</tr>
							<?php 
								} 
							}
							?>
							</tbody>
						</table>
						<br>
						<div class="row">
		                    <div class="form-group col-md-offset-0 col-md-2">
		                 		<form method="POST" action= "<?= site_url('detalhar-evento'); ?>">
					    			<input type="text" hidden value="<?= $participante['id_evento']; ?>" name="evento[id_evento]">
					        		<button type="submit" class="btn btn-primary">Voltar</button>
					    		</form>
		                    </div>
		                </div> <br>
					</div>
					<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
					  	<div class="modal-dialog modal-sm" role="document">
					    	<div class="modal-content">
					      		<div class="modal-header">
					        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        			<span aria-hidden="true">&times;</span>
					        		</button>
				        			<h4 class="modal-title" id="gridSystemModalLabel">Atenção</h4>
				      			</div>
					      		<div class="modal-body">
					          		<div>Deseja realmente remover esse participante do evento <?= $participantes[0]['nome_evento']?> ?</div>
					        	</div>
					      		<div class="modal-footer">
					       	 		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					        		<a class="excluir btn btn-success"> Confirmar </a>
					      		</div>
					    	</div>
					  	</div>
					</div>
				</div>
			</div>
		<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>	
		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script>
	      	var inicializar = function(){
	      		var id;
	      		var id_evento
				$(".acao").click(function(){
					var link = $(this); // pega a instancia do link
					var tr = link.parent().parent();
					id = tr.children().eq(0).text();
					id_evento = tr.children().eq(1).text();
				});

				$(".excluir").click(function(){
		                //Define o formulário
		                var myForm = document.createElement("form");
		                myForm.action = 'remover-participante';
		                myForm.method = "post";
		 					
						var input = document.createElement("input");
						input.type = "text";
						input.value = id;
						input.name = "evento[id_participante]";
						myForm.appendChild(input);

						var input = document.createElement("input");
						input.type = "text";
						input.value = id_evento;
						input.name = "evento[id_evento]";
						myForm.appendChild(input);
			            //Adiciona o form ao corpo do documento
			            document.body.appendChild(myForm);
			            //Envia o formulário
			            myForm.submit();
				});
			}

			$(inicializar);  
    	</script>
	</body>
</html>