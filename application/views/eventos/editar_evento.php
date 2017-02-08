			<div id="page-wrapper">
		        <div class="container-fluid">
					<div class="page-header">
						<h4 style="text-align: center">Editar Evento</h4> <br>
					</div>
					<form method="POST" action="<?= site_url('atualizar-evento'); ?>" enctype="multipart/form-data">
						<div class="row">
							<input type="hidden" class="form-control" type="text" value="<?= $evento[0]['id_evento']; ?>" id="nome" name="evento[id_evento]" readonly>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="nome">Nome do Evento</label>
								<input class="form-control" type="text" value="<?= $evento[0]['nome_evento']; ?>" id="nome" name="evento[nome_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="carga_horaria">Carga Horária</label>
								<input class="form-control" onkeyup="somenteNumeros(this);" maxlength="2" value="<?= $evento[0]['carga_horaria_evento']; ?>" id="carga_horaria" name="evento[carga_horaria_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="data_evento">Data do Evento</label>
								<input class="form-control" type="date" value="<?= $evento[0]['data_evento']; ?>" id="data_evento" name="evento[data_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="data_evento">Local do Evento</label>
								<input class="form-control" type="text" id="local_evento" value="<?= $evento[0]['local_evento']; ?>" name="evento[local_evento]" required>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-offset-3 col-md-5">
								<label for="tipo_usuario">Responsavel</label>
								<select class="form-control" name="evento[id_responsavel_evento]" required>
									<option  value="<?= $evento[0]['id_responsavel_evento']; ?>"><?= $evento[0]['nome_responsavel_evento']; ?></option>
									<?php 
										foreach ($evento[1] as $responsavel) {
											if($responsavel['id_usuario_criador'] == $usuario['id_usuario']){
												if($responsavel['id_responsavel_evento'] != $evento[0]['id_responsavel_evento']){

									?>
										 <option  value="<?= $responsavel['id_responsavel_evento']; ?>"><?= $responsavel['nome_responsavel_evento']; ?></option>
									<?php
												}
											}
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group col-md-offset-3 col-md-2">
							<a type="button" class="btn btn-primary" onclick="sendPost('<?= site_url('detalhar-evento')?>', {id_evento: '<?= $evento[0]['id_evento'] ?>'});"> Voltar </a>
						</div>
						<div class="form-group col-md-2">
							<button type="submit" class="btn btn-success">Salvar</button>
						</div>
					</form>
					</br></br></br></br>
				</div>
			</div>
		</div>
		<script src="<?php echo site_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>	
		<script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
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