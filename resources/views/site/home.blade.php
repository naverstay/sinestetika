@extends('layouts.site')

@section('content')
    <div class="section intro-expertise">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-7 col-xs-12">
                    <p class="text">Sinestetika — независимая междисциплинарная команда с сильной экспертизой в области брендинга, дизайна, цифровых технологий и бизнеса.</p>
                    <p class="text">Мы создаем системы визуальных и вербальных коммуникаций, необходимые для запуска и развития продуктов.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="section expertise">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <h2 class="line-heading h-floating">Экспертиза</h2>
                </div>
                <div class="col-sm-8 col-xs-12 home-services">
                    @foreach ($all_services as $s)
                        <div class="row home-services-row">
                            <div class="col-sm-4 col-xs-12 home-services-caption h-floating">
                                <a href="{{ route('service', $s->name) }}">
                                    {{ ($s->main_caption ? $s->main_caption : $s->caption) }}
                                    <span></span>
                                </a>
                            </div>
                            <div class="col-sm-6 col-sm-offset-2 home-services-descr hidden-xs">
                                {!! ($s->main_descr ? $s->main_descr : $s->short_descr) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="section service-tags">
        <div class="container container-fluid">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <h4 class="service-tags-caption h-floating">Все услуги</h4>
                </div>
                <div class="col-sm-9">
                    <ul class="row service-tags-list">
                    <li class="col-xs-12 col-sm-4">
                        @foreach ($service_tags as $stg)
                            <a href="{{ route('service', $stg->service->name) . ($stg->section && $stg->section->tags->count()>0 ? '#'.$stg->section->tags->first()->name : '') }}">{{ $stg->caption }}</a>
                            @if($loop->iteration%4 == 0)
                                </li><li class="col-xs-12 col-sm-4">
                            @endif
                        @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="section projects">
        <div class="container container-fluid">
            <h2 class="line-heading h-floating">Проекты</h2>
            @include('partial.projects', ['projects'=>$projects])
            <div>
                <a href="{{ route('projects') }}" class="all-projects-link">Все проекты</a>
            </div>
        </div>
    </div>

    @include('partial.footer.contacts')
@endsection
