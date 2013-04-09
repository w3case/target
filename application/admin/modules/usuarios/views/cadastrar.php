<h2 class="page-title">
    <i class="icon-user"></i>
    Usuários
</h2>

<?php $this->load->view("nav") ?>

<div id="mensagem"></div>

<div class="row-fluid">
    <form data-remote="true" 
          focus-response="#mensagem" 
          id="form" method="post" 
          action="index.php/usuarios/setDados">

        <div class="span9">
            <div class="widget">
                <div class="widget-header">
                    <h3>Cadastrar Usuário</h3>
                </div>

                <div class="widget-content">
                    <p>
                        Preenchar o formulário abaixo para realizar o cadastro de novos usuários.
                    </p>

                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="nome">Nome</label>

                            <div class="controls">
                                <input type="text" name="nome" placeholder="Digite o nome do usuário" id="nome" class="span20">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="senha">Senha</label>

                            <div class="controls">
                                <input type="password" name="senha" placeholder="Digite a senha do usuário" id="senha" class="span20">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="repitir_senha">Repitir Senha</label>

                            <div class="controls">
                                <input type="password" name="repetirSenha" placeholder="Digite a senha do usuário novamente" id="repitir_senha" class="span20">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail</label>

                            <div class="controls">
                                <input type="email" name="email" placeholder="Digite o e-mail do usuário" id="email" class="span20">
                                <span class="help-block">Insira um e-mail válido, pois o mesmo será utilizado para efetuar o login no sistema.</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="cpf">CPF</label>

                            <div class="controls">
                                <input type="text" name="cpf" placeholder="Digite o CPF do usuário" id="cpf" class="span20">
                                <span class="help-block">O CPF será utilizado durante o processo de recuperação de senha.</span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="tipo">Tipo</label>

                            <div class="controls">
                                <select id="tipo" name="nivel">
                                    <option value="1">Master</option>
                                    <option value="2">Administrador</option>
                                    <option value="3">Usuário</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .widget -->

            <div class="widget">
                <div class="widget-header">
                    <h3>Permissões de acesso</h3>
                </div>

                <div class="widget-content">
                    <p>
                        <strong>Atenção!</strong> Marque somente as permissões que o usuário possuirá. 
                        Essas permissões lhe darão acesso aos módulos existentes no sistema.
                    </p>
                    
                    <div class="form-horizontal accordion" id="accordionOne">
                        <?php foreach ($qtdMenus as $qtdMenu): ?>
                        <fieldset class="control-group accordion-group">
                            <div class="accordion-heading">
                                <label class="checkbox">
                                    <input type="checkbox" name="configuracoes" class="accordion-toggle" data-toggle="collapse" data-target="#<?php echo $qtdMenu->menuNome; ?>"> 
                                    <?php echo utf8_decode($qtdMenu->menuNome); ?>
                                </label>
                            </div>

                            <div id="<?php echo $qtdMenu->menuNome; ?>" class="accordion-body collapse out">
                                <div class="accordion-body-inner">
                                    <?php foreach ($menus as $menu):?>
                                    <?php if ($menu->menuReferencia == $qtdMenu->menuReferencia && $menu->menuNome != $qtdMenu->menuNome):?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="geral" checked> <?php echo $menu->menuNome; ?>
                                    </label>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </fieldset>
                        <?php endforeach; ?>
                    </div><!-- form-horizontal -->
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