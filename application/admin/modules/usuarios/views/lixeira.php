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
        <h3>Lixeira de Usuários</h3>
    </div>

    <div class="widget-content">
        <p>
            Abaixo se encontram os últimos registros excluídos no sistema. 
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
                        <a href="usuarios/restaurarDados/<?php echo $dados->id; ?>" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Restaurar o registro">
                            <i class="icon-arrow-up"></i>
                        </a>

                        <a href="usuarios/excluirPermanente/<?php echo $dados->id; ?>" class="btn tooltip-link" data-toggle="tooltip" data-placement="top" title="Deletar o cadastro">
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