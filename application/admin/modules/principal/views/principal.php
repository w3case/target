<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <title>Target - O seu gerenciador de conteúdo digital</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">    

        <link href="../assets/admin/css/bootstrap.css" rel="stylesheet">
        <link href="../assets/admin/css/bootstrap-responsive.css" rel="stylesheet">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
        <link href="../assets/admin/css/font-awesome.css" rel="stylesheet">

        <link href="../assets/admin/css/styles.css" rel="stylesheet"> 

        <link href="../assets/admin/css/bootstrap-wysihtml5.css" rel="stylesheet">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->	
    </head>

    <body>
        <header id="header" class="contant">
            <div class="container">
                <div id="user" class="span8">
                    <span id="user-avatar"><img src="../assets/admin/img/avatar.jpg" alt="Avatar"></span>
                    <span id="user-name">Gabriel Medina - Administrador</span>
                </div>

                <div class="span4">
                    <ul id="header-nav">
                        <li>
                            <a href="#" class="btn btn-small btn-link">
                                <i class="icon-user"></i>
                                Perfil			
                            </a>
                        </li>

                        <li>
                            <a href="#" class="btn btn-small btn-link">
                                <i class="icon-cog"></i>
                                Módulos			
                            </a>
                        </li>

                        <li>
                            <a href="#" class="btn btn-small btn-link">
                                <i class="icon-off"></i>
                                Sair			
                            </a>
                        </li>
                    </ul>

                </div>
            </div> <!-- /container -->
        </header> <!-- /header -->

        <div id="content">		
            <div class="container">			
                <div class="row">			
                    <div class="span3">
                        <h1>					
                            <a href="" id="logo-link">
                                <img src="../assets/admin/img/target.png" alt="Target">
                            </a>
                        </h1>

                        <hr>

                        <ul id="side-nav" class="nav nav-collapse">						
                            <li class="active">
                                <a href="">
                                    <i class="icon-home"></i>
                                    Página Inicial 		
                                </a>
                            </li>

                            <li>
                                <a href="atualizacoes">
                                    <i class="icon-refresh"></i>
                                    Atualizações	
                                </a>
                            </li>

                            <li>
                                <a href="configuracoes">
                                    <i class="icon-wrench"></i>
                                    Configurações 		
                                </a>
                            </li>

                            <li>
                                <a href="usuarios">
                                    <i class="icon-user"></i>
                                    Usuários
                                </a>
                            </li>

                            <li>
                                <a href="textos">
                                    <i class="icon-align-left"></i>
                                    Textos e Imagens
                                </a>
                            </li>

                            <li>
                                <a href="noticias">
                                    <i class="icon-edit"></i>
                                    Notícias	
                                </a>
                            </li>

                            <li>
                                <a href="comentarios">
                                    <i class="icon-comment"></i>
                                    Comentários	
                                </a>
                            </li>

                            <li>
                                <a href="enquetes">
                                    <i class="icon-question-sign"></i>
                                    Enquetes
                                </a>
                            </li>

                            <li>
                                <a href="arquivos">
                                    <i class="icon-file"></i>
                                    Arquivos	
                                </a>
                            </li>

                            <li>
                                <a href="recados">
                                    <i class="icon-align-left"></i>
                                    Mural de Recados	
                                </a>
                            </li>

                            <li>
                                <a href="publicidades">
                                    <i class="icon-eye-open"></i>
                                    Publicidades	
                                </a>
                            </li>

                            <li>
                                <a href="fotos">
                                    <i class="icon-camera"></i>
                                    Galeria de Fotos	
                                </a>
                            </li>

                            <li>
                                <a href="videos">
                                    <i class="icon-film"></i>
                                    Galeria de Vídeos	
                                </a>
                            </li>

                            <li>
                                <a href="agenda">
                                    <i class="icon-calendar"></i>
                                    Agenda de Eventos					
                                </a>
                            </li>

                            <li>
                                <a href="produtos">
                                    <i class="icon-shopping-cart"></i>
                                    Produtos	
                                </a>
                            </li>

                            <li>
                                <a href="canais">
                                    <i class="icon-globe"></i>
                                    Canais	
                                </a>
                            </li>

                            <li>
                                <a href="radio">
                                    <i class="icon-music"></i>
                                    Rádio	
                                </a>
                            </li>

                            <li>
                                <a href="aniversariantes">
                                    <i class="icon-calendar"></i>
                                    Aniversáriantes	
                                </a>
                            </li>

                            <li>
                                <a href="membros">
                                    <i class="icon-user"></i>
                                    Cadastros de Membros
                                </a>
                            </li>
                        </ul>
                    </div> <!-- /span3 -->

                    <main id="main" class="span9">
                        <?php $this->load->view($pagina) ?>
                    </main> <!-- /span9 -->				

                </div> <!-- /row -->		
            </div> <!-- /container -->
        </div> <!-- /content -->


        <footer id="footer">		
            <div class="container">				
                <hr>
                <p>Target - Sua melhor solução em manutenção para seu website. Um produto da Agência W3Case &reg;</p>
            </div>	
        </footer> <!-- /footer -->

        <script src="../assets/admin/js/jquery-1.7.2.min.js"></script>
        <script src="../assets/admin/js/bootstrap.js"></script>
        <script src="../assets/admin/js/jqform.js"></script>
        <script src="../assets/admin/js/bootstrap-wysihtml5.js"></script>

        <script src="../assets/admin/js/main.js"></script>
    </body>
</html>