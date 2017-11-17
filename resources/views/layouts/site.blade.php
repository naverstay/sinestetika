<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow" />
    <meta name="name" content="Брендинговое агентство Sinestetika"/>
    <meta name="description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов."/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:url" content="http://sinestetika.com" />
    <meta property="og:title" content="Брендинговое агентство Sinestetika" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов." />
    <meta name="format-detection" content="telephone=no">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>{{ (isset($page_title) ? 'Sinestetika - ' . $page_title : 'Брендинговое агентство Sinestetika') }}</title>

    @if (!is_ajax())
        @include('partial.css')
    @endif
</head>
<body class="{{ \Request::route()->getName() }} __intro">
    <div class="s-page">
        @if (\Request::route()->getName() == 'home')
            @include('partial.intro')
        @endif

        <div class="navbar navbar-custom" role="navigation">
            <div class="container container-fluid">
                <div class="row">
                    <div class="navbar-header">
                        <a href="{{ route('home') }}" class="navbar-brand page-scroll">
                            @svg('logo', 'logo')
                            <span></span>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <div class="navbar-toggle">
                            <div class="navbar-toggle-icon">
                                <span></span><span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="b-menu-overlay"></div>
            <div class="b-menu">
                <div class="b-menu-container">
                    <div class="b-menu-body">
                        <ul class="b-menu-list b-menu-services">
                            @foreach ($all_services as $s)
                                <li><a href="{{ route('service', $s->name) }}" class="page-scroll">{{ $s->main_caption }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <ul class="b-menu-list b-menu-main">
                        <li><a href="{{ route('projects') }}" class="nav-experts page-scroll">Проекты</a></li>
                        <li><a href="{{ route('contacts') }}" class="nav-contacts page-scroll">Контакты</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    @if (!is_ajax())
        @include('partial.js')
    @endif
</body>
</html>
