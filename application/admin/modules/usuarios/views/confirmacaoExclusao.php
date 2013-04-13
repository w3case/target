<h2 class="page-title">
    <i class="icon-user"></i>
    Usuários
</h2>

<?php $this->load->view("nav") ?>

<div id="mensagem"></div>

<div class="widget">
    <div class="widget-header">
        <h3>Alerta de Exclusão</h3>
    </div>

    <div class="widget-content">
        <form data-remote="true" 
          focus-response="#mensagem" 
          id="form" method="post" 
          action="index.php/usuarios/enviarLixiera">
            <div class="alert alert-error">
                <h4>Alerta de Exclusão!</h4>
                <p>Deseja realmente deletar os dados desta usuário. Ao gerar a exclusão o mesmo não terá mais acesso ao sistema.</p>
                <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
                <input class="input-xlarge" name="senha" type="password" placeholder="Redigite sua senha">
                <p>
                    <input class="btn btn-large btn-danger" value="Sim, desejo excluir" type="submit">
                    <button class="btn btn-large" type="button" onClick="history.go(-1)">Cancelar</button>
                </p>
            </div>
        </form>
    </div>
</div><!-- .widget -->