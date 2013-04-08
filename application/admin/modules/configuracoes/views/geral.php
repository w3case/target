<h2 class="page-title">
	<i class="icon-wrench"></i>
	Configurações
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="widget span9">
			<div class="widget-header">
				<h3>Configurações Gerais</h3>
			</div>

			<div class="widget-content">
				<p>
					<strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.
				</p>

				<div class="form-horizontal">
					<div class="control-group">
				    	<label class="control-label" for="path">Path</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="/home/nome_do_site/public_html/arquivos/" id="path" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="path_raiz">Path Raiz</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="/home/nome_do_site/public_html/" id="path_raiz" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="path_modulos_sistema">Path Módulos Sistema</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="/home/nome_do_site/public_html/application/admin/modules/" id="path_modulos_sistema" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="path_modulos_public">Path Módulos Public</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="/home/nome_do_site/public_html/application/public/modules/" id="path_modulos_public" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="path_public">Path Public</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="/public_html/" id="path_public" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="time_zone_mysql">Time Zone MySQL</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="-01:00" id="time_zone_mysql" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="time_zone">Time Zone</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="America/Campo_Grande" id="time_zone" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="retorno_de_registros">Retorno de Registros</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="100" id="retorno_de_registros" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="sistema_atualizacoes">Sistema Atualizações</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="3" id="sistema_atualizacoes" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="editor_de_texto">Editor de Texto</label>
				    	
				    	<div class="controls">
				      		<select id="editor_de_texto">
							  <option>Simples (recomendado)</option>
							  <option>Completo</option>
							</select>
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