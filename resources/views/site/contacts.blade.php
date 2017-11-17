@extends('layouts.site')

@section('content')
    <div class="p-contacts">
        <div class="p-contacts-intro blueSection blue-bg">
            <div class="communication container container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="email"><span>mail@sinestetika.com</span></div>
                        <div class="hidden-touch">
                            <div class="phone"><span>+7 499 589 25 69</span></div>
                        </div>
                        <div class="visible-touch">
                            <a class="phone" href="tel:+74995892569"><span>+7 499 589 25 69</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="addr container container-fluid h-floating h-floating-d-0-4">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Москва, <br/>Лужнецкая набережная, <br/>д. 2/4, стр. 17, офис 305 <br/>(бизнес-парк «Союз»)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
