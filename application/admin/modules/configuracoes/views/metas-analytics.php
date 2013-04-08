<h2 class="page-title">
	<i class="icon-wrench"></i>
	Configurações
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="widget span9">
			<div class="widget-header">
				<h3>Configurações de Metas / Analytics</h3>
			</div>

			<div class="widget-content">
				<p>
					<strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.
				</p>

				<div class="form-horizontal">
					<div class="control-group">
				    	<label class="control-label" for="metatags">Metatags</label>
				    	
				    	<div class="controls">
				      		<textarea placeholder="<!-- Metatags -->" id="metatags" class="span20"></textarea>
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="analytics">Analytics</label>
				    	
				    	<div class="controls">
				      		<textarea placeholder="<!-- Analytics -->" id="analytics" class="span20"></textarea>
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="codigo_rastreio">Código Rastreio</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="00000000" id="codigo_rastreio" class="span20">
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