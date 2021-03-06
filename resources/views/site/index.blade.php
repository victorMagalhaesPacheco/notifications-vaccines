<!DOCTYPE HTML>
<html>

<head>
    <title>{{ Config::get('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('site/spectral/assets/css/main.css') }}" />
    <noscript>
        <link rel="stylesheet" href="{{ asset('site/spectral/assets/css/noscript.css') }}" />
    </noscript>
</head>

<body class="landing is-preload">
    <!-- Page Wrapper -->
    <div id="page-wrapper">
        <!-- Header -->
        <header id="header" class="alt">
            <h1><img src="{{ asset('img/vaciname.png') }}" alt="" width="80"> </h1>
            <nav id="nav">
                <ul>
                    <li class="special">
                        <a href="#menu" class="menuToggle"><span>Menu</span></a>
                        <div id="menu">
                            <ul>
                                <li><a href="#banner" class="scrolly">Início</a></li>
                                <li><a href="#quemsomos" class="scrolly">Quem somos</a></li>
                                <li><a href="#servico" class="scrolly">Serviços</a></li>
                                <li><a href="#proposito" class="scrolly">Propósito</a></li>
                                <li><a href="#beneficio" class="scrolly">Benefícios</a></li>
                                <li><a href="#alcance" class="scrolly">Alcance</a></li>
                                <li><a href="#cta" class="scrolly">Contato</a></li>
                                <li><a href="{{ route('login') }}">Área restrita</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Banner -->
        <section id="banner">
            <div class="inner">
                <h2>{{ config('app.name') }}</h2>
                <p>Notificações inteligentes</p>
                {{-- <ul class="actions special">
                    <li><a href="#" class="button primary">Activate</a></li>
                </ul> --}}
            </div>
            <a href="#quemsomos" class="more scrolly">Saiba mais</a>
        </section>

        <!-- One -->
        <section id="quemsomos" class="wrapper style1 special">
            <div class="inner">
                <header class="major">
                    <h2>Quem somos</h2>
                    <p><b>Missão</b>: Existimos para favorecer o aumento da cobertura vacinal da população.<br /></p>
                    <p><b>Visão</b>: VacinaMe almeja contribuir com a diminuição da incidência de doenças imunopreveníveis<br /></p>
                    <p><b>Valores</b>: Integridade, Honestidade, Respeito, Responsabilidade e Compromisso Social.<br /></p>
                </header>
            </div>
        </section>

        <!-- Two -->
        <section id="two" class="wrapper alt style2">
            <section class="spotlight" id="servico">
                <div class="image"><img src="{{ asset('site/spectral/images/pic01.jpg') }}" alt="" /></div>
                <div class="content">
                    <h2>Serviços</h2>
                    <p>VacinaMe funciona como uma solução digital para o envio de notificações com alertas para vacinação.</p>
                </div>
            </section>
            <section class="spotlight" id="proposito">
                <div class="image"><img src="{{ asset('site/spectral/images/pic02.jpg') }}" alt="" /></div>
                <div class="content">
                    <h2>Propósito</h2>
                    <p>VacinaMe busca contribuir com o aumento da cobertura vacinal da população através desta ferramenta, dimunuindo assim a incidência de doenças imunopreveníveis.</p>
                </div>
            </section>
            <section class="spotlight" id="beneficio">
                <div class="image"><img src="{{ asset('site/spectral/images/pic03.jpg') }}" alt="" /></div>
                <div class="content">
                    <h2>Benefícios</h2>
                    <p>
                       VacinaMe funciona através de lembretes por mensagens para telefones móveis, que pode alcançar escalabilidade e diminuir
                        o custo por lembrete enviado.<br>
                        As pesquisas atuais indicam que o uso de notificações pode ajudar no aumento da cobertura vacinal.
                    </p>
                </div>
            </section>
        </section>

        <!-- Three -->
        <section id="alcance" class="wrapper style3 special">
            <div class="inner">
                <header class="major">
                    <h2>Alcance</h2>
                    <p>
                       VacinaMe pode se comunicar com qualquer pessoa que possui um telefone móvel, e já em 2019
                        de acordo com o IBGE, mais de 80% das pessoas acima de 10 anos possuia pelo menos um telefone móvel do Brasil.
                    </p>
                </header>
                {{-- <ul class="features">
                    <li class="icon fa-paper-plane">
                        <h3>Arcu accumsan</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                    <li class="icon solid fa-laptop">
                        <h3>Ac Augue Eget</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                    <li class="icon solid fa-code">
                        <h3>Mus Scelerisque</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                    <li class="icon solid fa-headphones-alt">
                        <h3>Mauris Imperdiet</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                    <li class="icon fa-heart">
                        <h3>Aenean Primis</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                    <li class="icon fa-flag">
                        <h3>Tortor Ut</h3>
                        <p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo
                            Aenean ligula consequat consequat.</p>
                    </li>
                </ul> --}}
            </div>
        </section>

        <!-- CTA -->
        <section id="cta" class="wrapper style4">
            <div class="inner">
                <header>
                    <h2>Contato</h2>
                    <p><i class="icon brands fa-telegram"></i> +55 (85) 997042922</p>
                    <p><i class="icon solid fa-envelope"></i> suporte@vaciname.com.br</p>
                </header>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('site/spectral/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/jquery.scrollex.min.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/jquery.scrolly.min.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/browser.min.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/breakpoints.min.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/util.js') }}"></script>
    <script src="{{ asset('site/spectral/assets/js/main.js') }}"></script>

</body>

</html>
