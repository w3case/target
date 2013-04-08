<h2 class="page-title">
	<i class="icon-align-left"></i>
	Textos e Imagens
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="span9">
			<div class="widget">
				<div class="widget-header">
					<h3>Cadastrar Página (Textos e Imagens)</h3>
				</div>

				<div class="widget-content">
					<p>
						Preenchar o formulário abaixo para realizar o cadastro de uma nova página.
					</p>

					<div class="form-horizontal">
						<div class="control-group">
					    	<label class="control-label" for="titulo">Título da página</label>
					    	
					    	<div class="controls">
					      		<input type="text" placeholder="O título será utilizado no texto" id="titulo" class="span20">
					    	</div>
					  	</div>

					  	<div class="control-group">
					    	<label class="control-label" for="pagina_vinculada">Página vinculada</label>
					    	
					    	<div class="controls">
					      		<input type="text" placeholder="Link da página" id="pagina_vinculada" class="span20">
					    	</div>
					  	</div>

					  	<div class="control-group">
					    	<label class="control-label" for="adicionar_midias">Adicionar mídias</label>
					    	
					    	<div class="controls">
					      		<a class="btn btn-medium tooltip-link" data-toggle="tooltip" data-placement="top" title="Adicionar imagem" href="#">
					      			<i class="icon-camera"></i>
					      		</a>

					      		<a class="btn btn-medium tooltip-link" data-toggle="tooltip" data-placement="top" title="Adicionar vídeo" href="#">
					      			<i class="icon-film"></i>
					      		</a>

					      		<a class="btn btn-medium tooltip-link" data-toggle="tooltip" data-placement="top" title="Adicionar arquivo" href="#">
					      			<i class="icon-file"></i>
					      		</a>
					    	</div>
					  	</div>

					  	<div class="control-group">
					    	<label class="control-label" for="posicao_imagem">Posição da imagem</label>
					    	
					    	<div class="controls">
				      			<label class="radio btn btn-medium btn-radio tooltip-link" data-toggle="tooltip" data-placement="top" title="Alinhar imagens na esquerda">
							    	<input type="radio" id="posicao_imagem" name="posicao_imagem" checked> <i class="icon-align-left"></i>
							    </label>

							    <label class="radio btn btn-medium btn-radio tooltip-link" data-toggle="tooltip" data-placement="top" title="Alinhar imagens no centro">
							    	<input type="radio" id="posicao_imagem" name="posicao_imagem"> <i class="icon-align-center"></i>
							    </label>

							    <label class="radio btn btn-medium btn-radio tooltip-link" data-toggle="tooltip" data-placement="top" title="Alinhar imagens na direita">
							    	<input type="radio" id="posicao_imagem" name="posicao_imagem"> <i class="icon-align-right"></i>
							    </label>
					    	</div>
					  	</div>

					  	<div class="control-group">
					    	<label class="control-label" for="adicionar_midias">Adicionar mídias</label>
					    	
					    	<div class="controls">
					      		<textarea class="textarea" placeholder="Enter text ..."></textarea>
					    	</div>
					  	</div>
					</div>
				</div>
			</div><!-- .widget -->
		</div><!-- .span9 -->

		<div id="nav-acoes" class="span3">
			<div class="widget-header">
				<h3>Ações</h3>
			</div>

			<div class="widget-content">
				<p>
					Escolha a ação desejada.
				</p>

				<div class="form-actions">
					<input type="submit" value="Cadastrar" class="btn btn-success btn-block">
				</div>
			</div>
		</div>
	</form>
</div><!-- .row-fluid -->