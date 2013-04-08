<h2 class="page-title">
	<i class="icon-wrench"></i>
	Configurações
</h2>

<?php $this->load->view("nav") ?>

<div class="row-fluid">
	<form>
		<div class="widget span9">
			<div class="widget-header">
				<h3>Configurações de E-mails</h3>
			</div>

			<div class="widget-content">
				<p>
					<strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.
				</p>

				<div class="form-horizontal">
					<div class="control-group">
				    	<label class="control-label" for="smtp">SMTP</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="mail.w3case.com.br" id="smtp" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="porta">Porta</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="587" id="porta" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="usuario">Usuário</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="formularios@w3case.com.br" id="usuario" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="senha">Senha</label>
				    	
				    	<div class="controls">
				      		<input type="password" placeholder="Senha do usuário" id="senha" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_de_envio">E-mail de envio</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="administrador@w3case.com.br" id="email_de_envio" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="titulo_do_email">Título do e-mail</label>
				    	
				    	<div class="controls">
				      		<input type="text" placeholder="Sistema Administrativo W3Case" id="titulo_do_email" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_destino">E-mail destino</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="administrador@w3case.com.br" id="email_destino" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_comentarios">E-mail comentários</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="administrador@w3case.com.br" id="email_comentarios" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_mural">E-mail mural</label>
				    	
				    	<div class="controls">
				      		<input type="email" placeholder="administrador@w3case.com.br" id="email_mural" class="span20">
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_mural">Enviar notificações?</label>
				    	
				    	<div class="controls">
				    		<div class="radio">
					      		<input type="radio" name="radio" id="radio1" value="1" checked>
					      		<label for="radio1">Sim</label>
					      	</div>

					      	<div class="radio">
					      		<input type="radio" name="radio" id="radio2" value="2">
	  							<label for="radio2">Não</label>
					      	</div>  							
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_mural">Ativar via e-mail</label>
				    	
				    	<div class="controls">
				    		<div class="radio">
					      		<input type="radio" name="radio2" id="radio1" value="1" checked>
					      		<label for="radio1">Sim</label>
					      	</div>

					      	<div class="radio">
					      		<input type="radio" name="radio2" id="radio2" value="2">
	  							<label for="radio2">Não</label>
					      	</div>  							
				    	</div>
				  	</div>

				  	<div class="control-group">
				    	<label class="control-label" for="email_mural">Lista de e-mails</label>
				    	
				    	<div class="controls">
				      		<button class="btn btn-link">Baixar lista de e-mails</button>
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