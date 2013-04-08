<h2 class="page-title">
	<i class="icon-wrench"></i>
	Configurações
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="widget span9">
			<div class="widget-header">
				<h3>Configurações de Menutenção</h3>
			</div>

			<div class="widget-content">
				<p>
					<strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.<br>
				</p>

				<p>
					Certifique-se que todos os usuários estejam deslogados.<br>
					O tempo para realização desta ação vai variar de acordo com o tamanho do seu banco de dados.
				</p>

				<div class="form-horizontal">
					<div class="control-group">
				    	<label class="control-label" for="backup">Backup</label>
				    	
				    	<div class="controls">
				    		<label class="checkbox">
				      			<input type="checkbox" id="backup"> Gerar backup do banco de dados
				      		</label>
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
					<input type="submit" value="Executar" class="btn btn-success btn-block">
				</div>
			</div>
		</div>
	</form>
</div><!-- .row-fluid -->