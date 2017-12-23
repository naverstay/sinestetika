<div class="b-projects">
    <div class="row{{ ($isotop ? ' boardGrid' : '') }}">
        @foreach ($projects as $p)
        <div class="col-sm-6 col-xs-12{{ ($isotop ? ' gridItem' : '') }}">
            <a href="{{ route('project', $p->name) }}" data-surf-animation=".b-project-info-loader"
               class="b-project h-floating surfAnimate skipStartLogo">
                <div class="b-project-container">
                    <div class="b-project-image">
                        <img class="bsOnLoad orderLoader" data-src="{{ asset($p->photo_m) }}" onLoad="consecutiveLoader(this)" data-next=".orderLoader" alt=""/>
                    </div>
                    <div class="b-project-info-loader"></div>
                    <div class="b-project-info">
                        <div class="b-project-info-container">
                            <h3 class="b-project-caption"><span>{{ $p->caption }}</span></h3>
                            <div class="b-project-descr">{!! $p->short_descr !!}</div>
                            <div class="b-project-tags">
                                {{ $p->tags->implode('caption', ' / ') }}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
