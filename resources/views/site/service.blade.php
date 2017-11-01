@extends('layouts.site')

@section('content')
        <div class="p-service-intro blue-bg">
            <div class="p-service-intro-body container container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12">
                        <h1 class="p-service-title">{!! $service->html_caption !!}</h1>
                    </div>
                </div>
            </div>
            <div class="container container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="p-service-tags b-tags">
                            @foreach ($service->sections as $section)
                                @foreach ($section->tags as $tag)
                                    <a href="#{{ $tag->name }}" class="b-tags-item"><span>{{ $tag->caption }}</span></a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="intro-arrow hidden-xs"><span></span></a>
        </div>
        <div class="container container-fluid">
            @if ($service->descr)
                <div class="p-service-descr">
                    {!! $service->descr !!}
                </div>
            @endif

            <div class="p-service-sections {{ ($service->sections->count() == 1 ? '__single' : '') }}">
                @foreach($service->sections as $section)
                    <div class="p-service-section" {!! ($section->tags->count() ? 'id="' . $section->tags->first()->name . '"' : '') !!}>
                        <h2 class="p-service-section-title h-floating">{{ $section->caption }}</h2>
                        <div class="p-service-section-content">
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