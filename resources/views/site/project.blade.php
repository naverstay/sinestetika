@extends('layouts.site')

@section('content')
    <div class="p-project-intro-wrapper">
        <div class="p-project-intro-bg blue-bg"></div>
        <div class="p-project-intro">
            <div class="p-project-intro-body container container-fluid">
                <div class="row">
                    <div class="col-md-8 col-sm-10 col-xs-12">
                        <h1 class="p-project-title">{{ $project->caption }}</h1>
                    </div>
                </div>
            </div>
            <div class="container container-fluid hidden-xs">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                        <div class="p-project-tags b-tags">
                            @foreach ($project->tags as $tag)
                                <div class="b-tags-item"><span>{{ $tag->caption }}</span></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-project-photo container container-fluid">
                <img src="{{ asset($project->photo) }}" />
            </div>
        </div>
    </div>
        <div class="container container-fluid">
            @if ($project->descr)
                <div class="p-project-descr">
                    {!! $project->descr !!}
                </div>
            @endif

            <div class="p-project-sections">
                <div class="row row-eq-height">
                @foreach ($project->sections as $s)
                    <div class="p-project-section p-project-section__{{ $s->type }} col-xs-12 {{ ($s->small_format == 1 ? 'col-sm-6' : 'col-sm-12') }} h-floating"
                            {!! ($s->clear ? ' style="clear:left"' : '') !!}>
                        <div class="p-project-section-body">
                            @if ($s->type == 'content')
                                {!! $s->content !!}
                            @elseif ($s->type == 'video')
                                    <video poster="{{ $s->video_preview }}" controls="false">
                                        <source src="{{ asset($s->video) }}">
                                    </video>
                                    <div class="v-btn-play-big">
                                        <span class="v-btn-play"></span>
                                    </div>
                                    <div class="v-controls hidden">
                                        <div class="v-timeline"><div class="v-timeline-target"></div><div class="v-timeline-current"></div></div>
                                        <div class="v-controls-bar">
                                            <div class="v-btn-play"></div>
                                            <div class="v-volume">
                                                @svg('volume', 'v-btn-volume')
                                                <div class="v-volume-bar"><div class="v-volume-bar-target"></div><div class="v-volume-bar-current"></div></div>
                                            </div>
                                            <div class="v-time">
                                                <div class="v-time-current">0:00</div>
                                                <div class="v-time-sep">/</div>
                                                <div class="v-time-total">0:00</div>
                                            </div>
                                            <svg class="v-btn-fullscreen" version="1.1" viewBox="10 10 16 16"><g class="ytp-fullscreen-button-corner-0"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-49"></use><path class="ytp-svg-fill" d="m 10,16 2,0 0,-4 4,0 0,-2 L 10,10 l 0,6 0,0 z" id="ytp-id-49"></path></g><g class="ytp-fullscreen-button-corner-1"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-50"></use><path class="ytp-svg-fill" d="m 20,10 0,2 4,0 0,4 2,0 L 26,10 l -6,0 0,0 z" id="ytp-id-50"></path></g><g class="ytp-fullscreen-button-corner-2"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-51"></use><path class="ytp-svg-fill" d="m 24,24 -4,0 0,2 L 26,26 l 0,-6 -2,0 0,4 0,0 z" id="ytp-id-51"></path></g><g class="ytp-fullscreen-button-corner-3"><use class="ytp-svg-shadow" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ytp-id-52"></use><path class="ytp-svg-fill" d="M 12,20 10,20 10,26 l 6,0 0,-2 -4,0 0,-4 0,0 z" id="ytp-id-52"></path></g></svg>
                                        </div>
                                    </div>
                            @elseif ($s->type == 'image')
                                @if(sizeof($s->images) > 1)
                                    <div class="p-project-section-slider">
                                        @foreach($s->images as $img)
                                            <div class="p-project-section-slider-item"><img data-lazy="{{ asset($img['main']) }}" /></div>
                                        @endforeach
                                    </div>
                                @else
                                    <img src="{{ asset(@$s->images[0]['main']) }}" />
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>


    <a class="p-project-next" href="{{ route('project', $next_project->name) }}">
        <div class="p-project-intro-wrapper __next">
            <div class="p-project-intro-bg blue-bg"></div>
            <div class="p-project-intro">
                <div class="p-project-intro-body container container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-sm-10 col-xs-12">
                            <p class="p-project-next-title">Следующий проект</p>
                            <p class="p-project-title">{{ $next_project->caption }}</p>
                        </div>
                    </div>
                </div>
                <div class="container container-fluid hidden-xs">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                            <div class="p-project-tags b-tags">
                                @foreach ($next_project->tags as $tag)
                                    <div class="b-tags-item"><span>{{ $tag->caption }}</span></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-project-photo container container-fluid">
                    <img src="{{ asset($next_project->photo) }}" />
                </div>
            </div>
        </div>
    </a>
@endsection
