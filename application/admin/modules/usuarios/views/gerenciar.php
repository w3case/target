<h2 class="page-title">
    <i class="icon-user"></i>
    Usuários
</h2>

<?php $this->load->view("nav") ?>

<div id="mensagem">
    <?php echo $this->session->userdata('mensagem'); $this->session->set_userdata(array("mensagem"=>"")); ?>
</div>

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
            <form class="form-horizontal" method="post" action="usuarios/gerenciar">
                <input type="search" id="search" name="busca" class="input-xlarge" placeholder="">
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
                <?php foreach ($dadosbusca as $dados):?>
                <tr>
                    <td class="text-center"><?php echo $dados->id; ?></td>
                    <td><?php echo $dados->nome; ?></td>
                    <td><?php echo $dados->dataAcesso; ?></td>
                    <td>
                        <?php if ($dados->tipo == 1){echo "Master";} ?>
                        <?php if ($dados->tipo == 2){echo "Administrador";} ?>
                        <?php if ($dados->tipo == 3){echo "Usuário";} ?>
                    </td>

                    <td class="table-acoes">
                        <a href="usuarios/editar/<?php echo $dados->id; ?>" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Editar o cadastro">
                            <i class="icon-pencil"></i>
                        </a>
                        
                        <?php if ($dados->status == 1){ ?>
                        <a href="usuarios/status/<?php echo $dados->id; ?>/1" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Desativar/Ativar o cadastro">
                            <i class="icon-plus"></i>
                        </a>
                        <?php } else { ?>
                        <a href="usuarios/status/<?php echo $dados->id; ?>/2" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Desativar/Ativar o cadastro">
                            <i class="icon-minus"></i>
                        </a>
                        <?php } ?>

                        <a href="usuarios/excluir/<?php echo $dados->id; ?>" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Deletar o cadastro">
                            <i class="icon-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php echo $paginacao; ?>
    </div>
</div><!-- .widget -->