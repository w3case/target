<h2 class="page-title">
    <i class="icon-refresh"></i>
    Atualizações					
</h2>

<div id="mensagem"></div>

<div class="widget">
    <div class="widget-header">
        <h3>Existem atualizações disponíveis</h3>
    </div>

    <div class="widget-content">
        <p>
            Algumas atualizações foram lançadas para corrigir possíveis problemas ou realizar melhorias no Target. <strong>Atualize-se!</strong>
        </p>

        <p>
        <ol>
            <li>Clique no botão "Atualizar o Sistema" abaixo e aguarde.</li>
            <li>Saia do sistema (clique em sair, no canto superior direito).</li>
            <li>Entre novamente no sistema. <strong>Pronto</strong>, já estará utilizando a última versão do Target.</li>
        </ol>
        </p>
        <form data-remote="true" 
              focus-response="#mensagem" 
              id="form" method="post" 
              action="index.php/atualizacoes/atualizarSistema">
            <input type="submit" class="btn btn-success" value="Atualizar o sistema">
        </form>
    </div>
</div>