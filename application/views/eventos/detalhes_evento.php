			<div id="page-wrapper">
				<div class="col-lg-12">
					<br> <br>
		            <div class="panel panel-default">
		           		<div class="panel-body">
		                    <h3 style="text-align: center">Dados Evento</h3>
		                    <br><br>
		                    <div class="row ">
		                        <div class="col-md-offset-4 col-md-2"> Nome </div>
		                        <div class="col-md-4"><?= $evento['nome_evento'] ?></div>
		                     </div> <br>
		                     <div class="row ">
		                        <div class="col-md-offset-4 col-md-2"> Local </div>
		                        <div class="col-md-4"><?= $evento['local_evento'] ?></div>
		                     </div> <br>
		                    <div class="row">
		                        <div class="col-md-offset-4 col-md-2"> Responsável </div>
		                        <div class="col-md-4"><?= $evento['nome_responsavel_evento'] ?></div>
		                    </div> <br>
		                    <div class="row">
		                        <div class="col-md-offset-4 col-md-2"> Cargo Responsável </div>
		                        <div class="col-md-4"><?= $evento['cargo_responsavel_evento'] ?></div>
		                    </div> <br>
		                    <div class="row ">
		                        <div class="col-md-offset-4 col-md-2"> Data </div>
		                        <div class="col-md-4"><?= $evento['data_evento'] ?></div>
		                    </div> <br> 
		                    <div class="row">
		                        <div class="col-md-offset-4 col-md-2"> Participantes </div>
		                        <div class="col-md-1"> <?= $evento['num_participantes'] ?></div>
		                        <?php 
		                        	if($evento['num_participantes'] > 0 && $evento['is_finalizado'] == 0){
		                        ?>
		                        <div class="col-md-1"> 
		                        	<a class="btn btn-info" onclick="sendPost('<?= site_url('listar-participantes')?>', {id_evento: '<?= $evento['id_evento'] ?>'});"><span class="glyphicon glyphicon-eye-open"></span></a>
		                        </div>
		                        <?php
		                        	}
		                        ?>
		                    </div> <br><br>
		                    <?php 
		                    	if($evento['is_finalizado'] == 0){
		                    ?>
		                    <form action="<?=base_url('upar-planilha')?>" method="POST" enctype="multipart/form-data">
			                    <div class="row ">
			                        <div class="form-group col-md-offset-3 col-md-5">		
										<label>Selecione a Planilha</label>
										<input class="form-control" type="file" accept=".xlsx" name="planilha"/>
										<input type="hidden" name="id_evento" value= "<?= $evento['id_evento']; ?>">
									</div>
									<div class="form-group col-md-1">
										<br>
										<input class="btn btn-success" type="submit" value="Processar" />
									</div>	    
								</div>
							</form>	
							<?php 
		                    	}
		                    ?>
		                     <br> <br>
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
		                        <div class="form-group col-md-offset-3 col-md-2">
		                        	<a href="<?= site_url('index'); ?>" class="btn btn-primary">Voltar</a>
		                        </div>
		                        <?php 
		                        	if($evento['is_finalizado'] == 0){
		                        ?>
		                        <div class="form-group col-md-2">
		                        	<form action="<?=base_url('editar-evento')?>" method="POST">
		                        		<input type="hidden" name="evento[id_evento]" value= "<?= $evento['id_evento']; ?>">
		                        		<input class="btn btn-warning" type="submit" value="Alterar Dados" />
		                        	</form>
		                        </div>
		                        <div class="form-group col-md-2">
		                        	<input type="hidden" name="evento[id_evento]" value= "<?= $evento['id_evento']; ?>">
		                        	<input class="btn btn-danger" type="submit" data-toggle="modal" data-target=".bs-example-modal-sm" value="Encerrar Evento" />
		                        </div>
		                      	<?php 
		                        	}
		                        ?>
		                    </div> <br>
		                </div>
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
				          		<div>Deseja realmente encerrar esse evento?</div>
				        	</div>
				      		<div class="modal-footer">
				       	 		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				        		<a class="btn btn-success" onclick="sendPost('<?= site_url('encerrar-evento')?>', {id_evento: '<?= $evento['id_evento'] ?>'});"> Confirmar </a>
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
		<script>
        if(!window.sendPost){
            window.sendPost = function(url, obj){
                //Define o formulário
                var myForm = document.createElement("form");
                myForm.action = url;
                myForm.method = "post";
 
	        for(var key in obj) {
			    var input = document.createElement("input");
			    input.type = "text";
			    input.value = obj[key];
			    input.name = "evento["+key+"]";
			    myForm.appendChild(input);			
	        }
            console.log(obj);
            //Adiciona o form ao corpo do documento
            document.body.appendChild(myForm);
            //Envia o formulário
            myForm.submit();
            }    
        }  
    </script>
	</body>
</html>