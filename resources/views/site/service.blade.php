@extends('layouts.site')

@section('content')
        <div class="p-service-intro blueSection blue-bg">
            <div class="p-service-intro-body_ p-project-intro-body container container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12">
                        <h1 class="p-service-title_ p-project-title">{!! $service->html_caption !!}</h1>
                    </div>
                </div>
            </div>
            <div class="container container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="p-service-tags_ p-project-tags b-tags">
                            @foreach ($service->sections as $section)
                                @foreach ($section->tags as $tag)
                                    <a href="#{{ $tag->name }}" class="b-tags-item scrollTo"><span>{{ $tag->caption }}</span></a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <span class="intro-arrow hidden-xs_" data-target="#service-section"><span></span></span>
        </div>
        <div class="container container-fluid" id="service-section">
            @if ($service->descr)
                <div class="p-service-descr">
                    {!! $service->descr !!}
                </div>
            @endif

            <div class="p-service-sections {{ ($service->sections->count() == 1 ? '__single' : '') }}">
                @foreach($service->sections as $section)
                    <div class="p-service-section" {!! ($section->tags->count() ? 'id="' . $section->tags->first()->name . '"' : '') !!}>
                        <h2 class="p-service-section-title h-floating">{{ $section->caption }}</h2>
                        <div class="p-service-section-content h-floating">
                            {!! $section->descr !!}
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($projects->count())
                <div class="p-service-projects">
                    <h2 class="line-heading h-floating">Проекты</h2>

                    @include('partial.projects', ['projects'=>$projects])
                </div>
            @endif
        </div>

        @include('partial.footer.services')
@endsection
