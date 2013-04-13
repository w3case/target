<h2 class="page-title">
    <i class="icon-wrench"></i>
    Configurações
</h2>

<?php $this->load->view("nav") ?>

<div id="mensagem"></div>

<div class="row-fluid">
    <form data-remote="true" 
          focus-response="#mensagem" 
          id="form" method="post" 
          action="index.php/configuracao/atualizarDados">
        <div class="widget span9">
            <div class="widget-header">
                <h3>Configurações do Clima Tempo</h3>
            </div>

            <div class="widget-content">
                <p>
                    <strong>Atenção!</strong> Não modifique as configurações sem o auxílio do suporte técnico.
                </p>

                <div class="form-horizontal">
                    <?php foreach ($configs as $config): ?>
                        <div class="control-group">
                            <label class="control-label" for="<?php echo $config->configuracao; ?>"><?php echo $config->configuracao; ?></label>
                            <div class="controls">
                                <input type="<?php echo $config->tipoCampo; ?>" id="<?php echo $config->configuracao; ?>" value="<?php echo $config->parametros; ?>" class="span20">
                            </div>
                        </div>
                    <?php endforeach; ?>
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