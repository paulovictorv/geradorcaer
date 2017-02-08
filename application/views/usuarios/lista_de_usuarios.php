			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="col s12">
						<div class="page-header">
							<h4 style="text-align: center"> Usuários Ativos </h4> <br>
						</div>
						<form class="navbar-form navbar-right" role="search" method="POST" action="<?= site_url('pesquisar-usuario'); ?>">
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
						<?php   if($usuario["tipo_usuario"] == 1){ ?>
						<div class="row">
							<div class="col-md-5">
								<a type="button" class="btn btn-success" href="<?= site_url('novo-usuario'); ?>"> <span class="glyphicon glyphicon-plus"> </span></a>
							</div>
						</div>
						<?php 	}?>		
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nome</th>
									<th>Email</th>
									<th>Cpf</th>
									<th colspan="2">Ações</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(count($usuarios)>=1){
								foreach($usuarios as $usuario){
							?> 
								<tr>
									<td><?= $usuario['id_usuario'];?> </td>
									<td hidden><?= $usuario['tipo_usuario'];?></td>
									<td><?= $usuario['nome_usuario']; ?></td>
									<td><?= $usuario['email_usuario']; ?></td>
									<td><?= $usuario['cpf_usuario']; ?></td>
									<td>
										<a type="button" class="editar btn btn-warning"> <span class="glyphicon glyphicon-edit"> </span></a>
										<a type="button" data-toggle="modal" data-target=".bs-example-modal-sm" class="acao btn btn-danger"> <span class="glyphicon glyphicon-trash"> </a>
									</td>
								</tr>
							<?php 
								} 
							}
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
					tipo_usuario = tr.children().eq(1).text();
					console.log(id);
				});

				$(".excluir").click(function(){
						console.log("id: "+id);
						console.log("id: "+tipo_usuario);
		                //Define o formulário
		                var myForm = document.createElement("form");
		                myForm.action = 'excluir-usuario';
		                myForm.method = "post";
		 					
						var input = document.createElement("input");
						input.type = "text";
						input.value = id;
						input.name = "usuario[id_usuario]";
						myForm.appendChild(input);

						var input = document.createElement("input");
						input.type = "text";
						input.value = tipo_usuario;
						input.name = "usuario[tipo_usuario]";
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
		                myForm.action = 'editar-usuario';
		                myForm.method = "post";
		 					
						var input = document.createElement("input");
						input.type = "text";
						input.value = id;
						input.name = "usuario[id_usuario]";
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