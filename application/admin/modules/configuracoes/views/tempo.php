<h2 class="page-title">
	<i class="icon-wrench"></i>
	Configurações
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="widget span9">
			<div class="widget-header">
				<h3>Configurações do Clima Tempo</h3>
			</div>

			<div class="widget-content">
				<p>
					<strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.
				</p>

				<div class="form-horizontal">
					<div class="control-group">
				    	<label class="control-label" for="clima_tempo">Clima Tempo</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="0000,0000,0000,0000" id="clima_tempo" class="span20">
				      		<span class="help-block">Separe os códigos por vírgula.</span>
				    	</div>
				  	</div>
				</div>
			</div>
		</div><!-- .widget -->

		<div id="nav-acoes" class="span3">
			<div class="widget-header">
				<h3>Ações</h3>
			</div>

			<div class="widget-content">
				<p>
					Escolha a ação desejada.
				</p>

				<div class="form-actions">
					<input type="submit" value="Atualizar" class="btn btn-success btn-block">
				</div>
			</div>
		</div>
	</form>
</div><!-- .row-fluid -->