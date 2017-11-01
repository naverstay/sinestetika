@extends('partial.footer._blank')

@section('footer')
    <div class="footer-services">
        <div class="row">
            @foreach($services as $s)
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-offset-1 col-xs-offset-0">
                    <a href="{{ route('service', $s->name) }}">{{ $s->main_caption }}</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
            <div class="footer-to-main">
                <a href="{{ route('home') }}">На главную</a>
            </div>
        </div>
    </div>
@endsection