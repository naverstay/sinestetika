<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index, follow" />
    <meta name="name" content="Брендинговое агентство Sinestetika"/>
    <meta name="description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов."/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:url" content="http://sinestetika.com" />
    <meta property="og:title" content="Брендинговое агентство Sinestetika" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:description" content="Создаем системы визуальных и вербальных коммуникаций, необходимые для роста и развития, а также для запуска новых продуктов." />
    <meta name="format-detection" content="telephone=no">
    <meta name="theme-color" content="#00f">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>{{ (isset($page_title) ? 'Sinestetika - ' . $page_title : 'Брендинговое агентство Sinestetika') }}</title>

    @if (!is_ajax())
        @include('partial.css')
    @endif
</head>
<body class="{{ ((\Request::route()->getName() == 'contacts') ? 'viewport_height ' : '') }}{{ \Request::route()->getName() }} __intro">
    <div class="navbar-circle">
        <svg viewBox="0 0 360 360" class="svg-icon logo" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink">
            <filter height="200%" id="Blur10" width="200%" x="-20%" y="-20%">
                <feGaussianBlur stdDeviation="10"></feGaussianBlur>
            </filter>
            <g filter="url(#Blur10)" class="logo-circle logo-circle-blur" id="Page-1" stroke="none" stroke-width="1"
               fill="none" fill-rule="evenodd">
                <circle cx="180" cy="180" r="90" fill-rule="nonzero" fill="#0000fe"></circle>
            </g>
        </svg>
    </div>
    <div class="navbar navbar-custom" role="navigation">
        <div class="container container-fluid">
            <div class="row">
                <div class="navbar-header">
                    <a href="{{ route('home') }}" class="navbar-brand page-scroll">
                        @svg('logo', 'logo')
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
            <div class="b-menu-container viewport_height">
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
    <div class="s-page">
        @if (\Request::route()->getName() == 'home')
            @include('partial.intro')
        @endif

        @yield('content')
    </div>
    @if (!is_ajax())
        @include('partial.js')
    @endif
</body>
</html>
