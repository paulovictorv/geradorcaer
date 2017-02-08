			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="col s12">
						<div class="page-header">
							<h4 style="text-align: center"> Responsáveis Cadastrados </h4> <br>
						</div>
						<form class="navbar-form navbar-right" role="search" method="POST" action="<?= site_url('pesquisar-responsavel'); ?>">
						  <div class="form-group">
						    <input type="text" class="form-control" name="nome_informado" placeholder="Pesquise aqui..">
						  </div>
						  <button type="submit" class="btn btn-primary">Pesquisar</button>
						</form>
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
						<div class="row">
							<div class="col-md-5">
								<a type="button" class="btn btn-success" href="<?= site_url('novo-responsavel'); ?>"> <span class="glyphicon glyphicon-plus"> </span></a>
							</div>
						</div>	
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nome</th>
									<th>Cargo</th>
									<th colspan="2">Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php
							if(count($responsaveis)>=1){//verifica se existe pelo menos um responsavel no array
								foreach($responsaveis as $responsavel){
									if($responsavel['id_usuario_criador'] == $usuario['id_usuario']){ // verifica se o responsavel foi criador por quem esta logado
							?> 
								<tr>
									<td><?= $responsavel['id_responsavel_evento'];?> </td>
									<td><?= $responsavel['nome_responsavel_evento']; ?></td>
									<td><?= $responsavel['cargo_responsavel_evento']; ?></td>
									<td>
										<a type="button" class="editar btn btn-warning"> <span class="glyphicon glyphicon-edit"> </span></a>
										<a type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="acao btn btn-danger"> <span class="glyphicon glyphicon-trash"> </a>
									</td>
								</tr>
							<?php 
									}//fim do if 
								} //fim do foreach
							}//fim do primeiro if
							?>
							</tbody>
						</table>
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
					          		<div>Deseja realmente excluir este usuário ?</div>
					        	</div>
					      		<div class="modal-footer">
					       	 		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					        		<a class="excluir btn btn-success">Confirmar</a>
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
				$(".acao").click(function(){
					var link = $(this); // pega a instancia do link
					var tr = link.parent().parent();
					id = tr.children().eq(0).text();
					console.log(id);
				});

				$(".excluir").click(function(){
		                //Define o formulário
		                var myForm = document.createElement("form");
		                myForm.action = 'excluir-responsavel';
		                myForm.method = "post";
		 					
						var input = document.createElement("input");
						input.type = "text";
						input.value = id;
						input.name = "id_responsavel_evento";
						myForm.appendChild(input);

			            //Adiciona o form ao corpo do documento
			            document.body.appendChild(myForm);
			            //Envia o formulário
			            myForm.submit();
				});

				$(".editar").click(function(){
						var link = $(this); // pega a instancia do link
						var tr = link.parent().parent();
						id = tr.children().eq(0).text();
		                //Define o formulário
		                var myForm = document.createElement("form");
		                myForm.action = 'editar-responsavel';
		                myForm.method = "post";
		 					
						var input = document.createElement("input");
						input.type = "text";
						input.value = id;
						input.name = "responsaveis_evento[id_responsavel_evento]";
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