<div class="b-projects">
    <div class="row">
        @foreach ($projects as $p)
            <div class="col-sm-6 col-xs-12">
                <a href="{{ route('project', $p->name) }}" class="b-project h-floating">
                    <div class="b-project-container" style="background-image: url('{{ asset($p->photo_m) }}')">
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