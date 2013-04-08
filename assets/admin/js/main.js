// Função para manipulação do menu flutuante
$(window).scroll(function(event) {
    var scroll = $(this).scrollTop();

    if (scroll >= 240)
    {
        $('#nav-acoes').addClass("nav-fixed");
    }
    else
    {
        $('#nav-acoes').removeClass("nav-fixed");
    }
});

// Função para manipulação do ToolTip
if ($('.tooltip-link').length) {
    $('.tooltip-link').tooltip();
}

if ($('.textarea').length) {
    $('.textarea').wysihtml5();
}

// Função Jquery para envio de formulário
// Dependencia: jqueryForm
//$(document).ready(function() {
$("#form").submit(function() {
    /**
     *  retorna o valor do atributo Data remote do formulário enviado
     *  @return String
     */
    var dataRemote = $(this).attr("data-remote");

    // Verifa se o formulário será enviado remotamente
    if (dataRemote == "true")
    {
        /**
         * Retorna o caminho para a ação do formulário
         * @return String
         */
        var action = $(this).attr("action");

        /**
         * Retorna o ID da tag que será o foco
         * das mensagens de retorno
         * 
         * @return String
         */
        var focusResponse = $(this).attr("focus-response");

        /**
         * Retorna o Methodo utilizado para o envio do 
         * formulário
         * 
         * @return String
         */
        var method = $(this).attr("method");

        // Funções do jqueryForm
        $(this).ajaxStart(function() {
            $(focusResponse).html("<div class='alert alert-info'>\n\
                                   <button type='button' class='close' data-dismiss='alert'>&times;\n\
                                   </button><h4><strong>Aguarde!</strong></h4> Os dados estão sendo verificados e submetidos.</div>").show();
        });

        // Variáveis
        var options = {
            target: focusResponse,
            url: action,
            type: method,
            success: function(resposta) {
                $(focusResponse).html(resposta).show();
            },
            error: function(xhr, textStatus, errorThrown) {
                $(focusResponse).html(xhr).show();
            }
        }

        $(this).ajaxSubmit(options);

        // Retorna-se false para que o formulário não seja
        // enviado pelo methodo tradicional
        return false;
    }
})
//})