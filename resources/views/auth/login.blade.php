@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="description" content="Descrição">
    <meta name="keywords" content="palavras chave, separadas por virgula">
    <meta name="author" content="JuCamillo Web Co.">
    <meta name="viewport" content="width=device-width">
    <meta name="revisit-after" content="1 days">
    <title>Plena Natura - Cosméticos Naturais</title>

    <!--CSS geral-->
    <link rel="stylesheet" href="css/geral.css"/>
    <link rel="stylesheet" href="css/font-awesome.css"/>

    <!--CSS por seção ou plugin-->

    <!--CSS / END-->

    <!-- favicon -->
    <link rel="icon" href="images/favicon.png" >

    <!-- JS bibliotecas -->
    <script src="javascripts/jquery-1.10.1.min.js"></script>

    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>


    <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="owl-carousel/owl.theme.css">
    <script src="owl-carousel/owl.carousel.js"></script>
</head>

<body>
    <!--CONTEUDO -->

        <ul class="social-fixed">
            <li>
                <a href="#" target="_blank" title="Facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>    
            </li>
            <li>
                <a href="#" target="_blank" title="Twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" title="Instagram">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" target="_blank" title="Wordpress">
                    <i class="fa fa-wordpress" aria-hidden="true"></i>
                </a>
            </li>
        </ul>

        <div class="cover-all">
            <div class="login t1" id="t1">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>

                <strong>
                    Use uma das opções para confirmar a sua identidade
                </strong>
                <ul>
                    <li>
                        <a href="#t2" class="inside" title="Receber chave de acesso por e-mail">
                            Receber chave de acesso por e-mail
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Entrar com Facebook">
                            Entrar com Facebook
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Entrar com Google Plus">
                            Entrar com Google Plus
                            <i class="fa fa-google" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#t4" class="inside" title="Entrar com E-mail e Senha">
                            Entrar com E-mail e Senha
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="login t2" id="t2">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>

                <strong>
                    <i class="fa fa-envelope" aria-hidden="true"></i> Por favor informe seu e-mail
                </strong>
                <form>
                    <label>
                        <span>
                            E-mail
                        </span>
                        <input type="text" placeholder="seu@email.com">
                    </label>

                    <div class="btns-down">
                        <a href="#t1" class="inside" title="Voltar">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Voltar
                        </a>
                        <button>
                            Continuar
                        </button>
                    </div>
                </form>
            </div>

            <div class="login t3" id="t3">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>

                <strong>
                    <i class="fa fa-key" aria-hidden="true"></i> Informar chave de acesso
                </strong>
                <form>
                    <label>
                        <span>
                            Agora é só informar o codigo recebido em: <br>
                            <strong>seuemail@email.com</strong>
                        </span>
                        <input type="password">
                    </label>

                    <div class="btns-down">
                        <a href="#t2" class="inside" title="Voltar">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Voltar
                        </a>
                        <button>
                            Entrar
                        </button>
                    </div>
                </form>
            </div>

            <div class="login t4" id="t4">
                <div class="close">
                    <i class="fa fa-window-close-o" aria-hidden="true"></i>
                </div>

                <strong>
                    <i class="fa fa-lock" aria-hidden="true"></i> Entrar com E-mail e Senha
                </strong>
                <form>
                    <label>
                        <span>
                            E-mail
                        </span>
                        <input type="text" placeholder="seu@email.com">
                    </label>
                    <label>
                        <span>
                            Senha
                        </span>
                        <input type="password" placeholder="seu@email.com">
                    </label>

                    <div class="btns-log">
                        <a href="#t2" class="inside" title="Esqueci minha senha">
                            Esqueci minha senha
                        </a>

                        <a href="#t2" class="inside" title="Não tem uma senha? Cadastre-se">
                            Não tem uma senha? Cadastre-se
                        </a>
                    </div>

                    <div class="btns-down">
                        <a href="#t1" class="inside" title="Voltar">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Voltar
                        </a>
                        <button>
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MIOLO -->

        <section class="container-miolo margin-top user-area">
            <div class="wrapper">

                <aside class="user-area-menu">
                    <strong>
                        Olá, Nome do cliente<br>
                        <em>
                            email@docliente.com
                        </em>
                    </strong>
                    <a href="#" class="logout" title="Sair">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="meus-pedidos.html" title="Meus Pedidos">
                                <i class="fa fa-truck" aria-hidden="true"></i>&nbsp;&nbsp;Meus Pedidos
                            </a>
                        </li>
                        <li>
                            <a href="meus-enderecos.html" title="Meus Endereços">
                                <i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp;Meus Endereços
                            </a>
                        </li>
                        <li>
                            <a href="dados-pessoais.html" title="Dados Pessoais">
                                <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Dados Pessoais
                            </a>
                        </li>
                        <li>
                            <a href="dados-cadastrais.html" class="active" title="Dados Cadastrais">
                                <i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Dados Cadastrais
                            </a>
                        </li>
                        <li>
                            <a href="minhas-avaliacoes.html" title="Minhas Avaliações">
                                <i class="fa fa-star" aria-hidden="true"></i>&nbsp;&nbsp;Minhas Avaliações
                            </a>
                        </li>
                        <li>
                            <a href="meus-vales.html" title="Meus Vales">
                                <i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;&nbsp;Meus Vales
                            </a>
                        </li>
                    </ul>
                </aside>

                <article>
                    <div class="dados-cadastrais">
                        <h2>
                            <i class="fa fa-lock" aria-hidden="true"></i>Dados Cadastrais
                        </h2>

                        <form>
                            <label>
                                <span>
                                    E-mail Cadastrado
                                </span>
                                <input type="text">
                            </label>
                            <label>
                                <span>
                                    Novo e-mail
                                </span>
                                <input type="text">
                            </label>
                            <label>
                                <span>
                                    Nova senha
                                </span>
                                <input type="password">
                            </label>
                            <label>
                                <span>
                                    Confirmar nova senha
                                </span>
                                <input type="password">
                            </label>
                            <label class="rt">
                                <span>
                                    Senha Atual*
                                </span>
                                <input type="password">
                            </label>
                            <div class="full">
                                <button>
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>

                </article>

            </div>
        </section>

        <!-- JS PLUGINS -->

        <script type="text/javascript" src="javascripts/custom.js">
        </script>



        <!-- SCRIPTS / END -->


        <!-- GOOGLE ANALYTICS -->


        <!--GOOGLE ANALYTICS / END-->


    <!--CONTEUDO / END -->

</body>

@endsection


