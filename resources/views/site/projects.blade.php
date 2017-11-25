@extends('layouts.site')

@section('content')
    <div class="p-projects">
        <div class="p-projects-intro blueSection blue-bg">
            <div class="container container-fluid">
                <p>Преодолеваем разрыв между стратегией и воплощением благодаря комплексным решениям</p>
            </div>
        </div>
        <div class="container container-fluid">
            <div class="p-projects-filter hidden-xs">
                <ul class="p-projects-filter-groups collapse-xs">
                    <li class="__all __mobile">
                        <a href="javascript:void(0)">
                            {{
                                (sizeof($selected_groups) > 0
                                    ?
                                        (sizeof($selected_groups) == 1 ? 'выбрана' : 'выбрано') . ' ' . sizeof($selected_groups) . ' ' .
                                        \Lang::choice('услуга|услуги|услуг', sizeof($selected_groups), [], 'ru')
                                    :
                                        'ничего не выбрано'
                                )
                            }}
                        </a>
                    </li>
                    <li class="__all{{ (sizeof($selected_groups) <= 0 ? ' active' : '') }}"><a class="filterLink" href="{{ route('projects') }}">Показать все</a></li>

                    @foreach ($groups as $gr)
                        <li class="{{ ($gr->active ? 'active' : '') }}"><a class="filterLink" href="{{ $gr->href }}">{{ $gr->caption }}</a></li>
                    @endforeach
                </ul>
            </div>

            @include('partial.projects', ['projects'=>$projects])
        </div>
    </div>

    @include('partial.footer.contacts')
@endsection
