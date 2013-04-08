<h2 class="page-title">
	<i class="icon-align-left"></i>
	Textos e Imagens
</h2>

<?php $this->load->view("nav") ?>

<div class="widget">
	<div class="widget-header">
		<h3>Gerenciar Usuários</h3>
	</div>

	<div class="widget-content">
		<p>
			Abaixo se encontram os últimos registros cadastrados no sistema. 
			Se você deseja localizar um registro específico, utilize o campo "Busca" abaixo.
		</p>

		<div class="search-box clearfix">
			<form class="form-horizontal">
				<input type="search" id="search" name="search" class="input-xlarge" placeholder="" required>
				<input type="submit" class="btn" value="Buscar">
			</form>
		</div>

		<table class="table table-bordered table-hover">
		  	<thead>
		    	<tr>
		      		<th>ID</th>
		      		<th>Usuário</th>
		      		<th>Último acesso</th>
		      		<th>Tipo</th>
		      		<th class="span2">Ações</th>
		    	</tr>
		  	</thead>

		  	<tbody>
		    	<tr>
		      		<td class="text-center">1</td>
		      		<td>Suporte W3Case</td>
		      		<td>06/04/2013 às 08:14:52</td>
		      		<td>Master</td>
		      		
		      		<td class="table-acoes">
		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Editar o cadastro">
		      				<i class="icon-pencil"></i>
		      			</a>

		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Desativar/Ativar o cadstro">
		      				<i class="icon-ok"></i>
		      			</a>

		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Deletar o cadastro">
		      				<i class="icon-trash"></i>
		      			</a>
		      		</td>
		    	</tr>

		    	<tr>
		      		<td class="text-center">2</td>
		      		<td>Usuário com o nome completo do fulano</td>
		      		<td>06/04/2013 às 08:14:52</td>
		      		<td>Administrador</td>
		      		
		      		<td class="table-acoes">
		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Editar o cadastro">
		      				<i class="icon-pencil"></i>
		      			</a>

		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Desativar/Ativar o cadstro">
		      				<i class="icon-ok"></i>
		      			</a>

		      			<a href="#" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Deletar o cadastro">
		      				<i class="icon-trash"></i>
		      			</a>
		      		</td>
		    	</tr>
		  	</tbody>
		</table>

		<div class="pagination pagination-centered">
			<ul>
				<li class="disabled"><a href="#">&laquo;</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</div>
	</div>
</div><!-- .widget -->