{{-- main_url --}}
@extends('layouts.main')

@section('header-section')
    {{ $page->app->name }}
@endsection

@section('main-section')
    @php
        //logger(json_encode($page->app, JSON_UNESCAPED_UNICODE));
        $hasDevloperOtherItems = $page->DeveloperOther->count() > 0;
    @endphp


    @include('main.modals.modal_screen_shot')

    {{-- Хлебные крошки --}}
    <div class="bread-crumps-wrapper">
        <div class="bread-crumps">
            <a href="/" class="home_link">
                <svg 
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    id="Capa_1"
                    x="0px" y="0px"
                    width="36px" height="20px"
                    viewBox="0 0 486.988 486.988"
                    style="enable-background:new 0 0 486.988 486.988;"
                    xml:space="preserve"
                >
                    <path d="M16.822,284.968h39.667v158.667c0,9.35,7.65,17,17,17h116.167c9.35,0,17-7.65,17-17V327.468h70.833v116.167 c0,9.35,7.65,17,17,17h110.5c9.35,0,17-7.65,17-17V284.968h48.167c6.8,0,13.033-4.25,15.583-10.483 c2.55-6.233,1.133-13.6-3.683-18.417L260.489,31.385c-6.517-6.517-17.283-6.8-23.8-0.283L5.206,255.785 c-5.1,4.817-6.517,12.183-3.967,18.7C3.789,281.001,10.022,284.968,16.822,284.968z M248.022,67.368l181.333,183.6h-24.367 c-9.35,0-17,7.65-17,17v158.667h-76.5V310.468c0-9.35-7.65-17-17-17H189.656c-9.35,0-17,7.65-17,17v116.167H90.489V267.968 c0-9.35-7.65-17-17-17H58.756L248.022,67.368z">
                    </path>
                </svg>
            </a>
            
            <a href="/{{ $page->category->main_url }}" class="category_link">{{ $page->category->mainCategory }}</a>
            <span class="link_arrow">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    width="16" height="15" 
                    viewBox="0 0 16 15" 
                    fill="none"
                > 
                    <line x1="8.29188" y1="0.551354" x2="15.297" y2="7.68774" stroke="#5A5A5A"></line>
                    <line x1="7.6474" y1="14.625" x2="14.7181" y2="7.55353" stroke="#5A5A5A"></line>
                </svg>
            </span>
            
            <a href="/{{ $page->category->main_url }}/{{ $page->category->url }}" class="category_link">{{ $page->category->category }}</a>
        </div>
    </div>

    <section class="app-card section-container">
        {{-- Картинка с надписью --}}
        <div class="app-card-title section-container-wrapper">
            <div class="app-card-title-image">
                <img src="https://files.107igr.ru{{ $page->app->icon }}" alt="{{ $page->app->name }}">
            </div>
            <div class="app-card-title-label">
                <h1>{{ $page->app->name }}</h1>
                <p>Бесплатное приложение</p>
            </div>
        </div>

        {{-- Кнопка скачать --}}
        <div class="section-container-wrapper">
            <a 
                href="/download/{{ $page->app->url }}" 
                class="app-card-button"
            >
                <div>Скачать бесплатно</div>
                <img src="/images/Group_28.svg" style="width: 26px; height: 26px; margin-left: 30px; margin-right: -30px;">
            </a>
        </div>

        {{-- Описание под кнопкой --}}
        <div class="section-container-wrapper">
            <div class="description">
                <div class="description__card">
                <div class="description__title">
                    4,3
                    <img class="star" src="/images/game/Star 1.svg" alt="star">
                </div>
                <p class="description__subtitle">4 млн отзывов</p>
                </div>
                <div class="description__line"></div>
        
                <div class="description__card">
                <div class="description__title">
                    <img class="download-images" src="/images/game/download.svg" alt="download">
                </div>
                <p class="description__subtitle">{{ $page->app->size }}</p>
                </div>
                <div class="description__line"></div>
        
                <div class="description__card">
                <div class="description__title">
                    <img class="children" src="/images/game/children.svg" alt="children">
                </div>
                <p class="description__subtitle">{{ $page->app->limits }}</p>
                </div>
                <div class="description__line"></div>
        
                <div class="description__card">
                <div class="description__title">{{ $page->app->downloads }}</div>
                <p class="description__subtitle">Скачиваний</p>
                </div>
            </div>
        </div>

        @include ('main.includes.yandex-block')
        {{-- Скриншоты --}}
        @include('main.includes.screen-shots', ['title' => 'Скриншоты', 'list' => $page->screenShots])

    </section>

    {{-- Текстовое описание --}}
    @include ('main.includes.app-description', ['app' => $page->app, 'hasDevloperOtherItems' => $hasDevloperOtherItems])

    {{-- Видео --}}
    @if ($page->app->video != '')
        <div class="app-video">
            <h2>Видео</h2>
            <iframe
                src="{{ $page->app->video }}?autoplay=1&mute=1"
                title="{{ $page->app->name }} video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            >
            </iframe>
        </div>
    @endif

    {{-- Версии --}}
    {{-- <div class="app-versions">
        Версии
    </div> --}}

    {{-- Вопросы и ответы --}}
    @php
        $questionAndAnswersList = ActionsSystem::Action('AppQuestionsAndAnswersList', ['app_id' => $page->app->id]);
    @endphp

    @if (count($questionAndAnswersList) > 0)
        <div class="app-question-and-answers-wrapper">
            <h2 class="question-and-answers-title">
                Вопросы и ответы
            </h2>
            
            <div class="question-and-answer-items">
                @foreach ($questionAndAnswersList as $item)
                    <div class="question-and-answer-item">
                        <div class="item-question">
                            <div class="item-question-title">Вопрос:</div>
                            <div>{{ $item->qa_q }}</div>
                        </div>
                        <div class="item-answer">
                            <div class="item-answer-title">Ответ:</div>
                            <div>{{ $item->qa_a }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Комментарии --}}
    @php
        [ 
            'hierarchy' => $comments, 
            'count'     => $commentsCount,
        ] = ActionsSystem::Action('AppsCommentsList', ['app_id' => $page->app->id]);
    @endphp

    @include('main.modals.modal_comment_send', [ 'app' => $page->app ])

    <div class="app-comments-wrapper">
        <div class="app-comments">

            <div class="comments-title">
                Комментарии<span class="ms-2">{{$commentsCount}}</span>

                <div class="comments-writer-wrapper">
                    <div class="comments-writer-image">
                        <img src="/uploads/icon_5dcfcea708196_11.png" alt="User avatar icon">
                    </div>
                    <div class="comments-writer-inputs">
                        <textarea type="text" class="comment-input" oninput="$emit('comments-writer-inputs-text-changed', this)" placeholder="Сообщение"></textarea>
                        
                        <div class="comment-button-cancel" title="Очистить" onclick="$emit('comments-writer-inputs-text-clear')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                            </svg>
                        </div>

                        <div class="comments-writer-inputs-forms">
                            <input type="text" class="comment-author" placeholder="Имя">
                            <input type="email" class="comment-mail" placeholder="Емейл">
                            <div 
                                class="comment-button-send" 
                                app-id="{{ $page->app->id }}" 
                                onclick="$emit('comments-send-main', '{{ $page->app->id }}')"
                            >
                                Отправить
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @each('partials.comment', $comments, 'comment', 'partials.comments-none')
        </div>
    </div>

    {{-- Другие приложений разработчика --}}
    @if ($hasDevloperOtherItems)
        {{-- Анкор для приложений разработчика --}}
        <div><a name="developer" style="position:absolute; margin-top: -60px;"></a></div>

        @include ('main.includes.horisontal-apps-list', [
            'list'  => $page->DeveloperOther,
            'title' => "Другие приложения {$page->app->developer}",
        ])
    @endif

    {{-- Похожие приложения в данной категории --}}
    @include ('main.includes.vertical-apps-list', [
        'list'  => $page->LikeInCategory,
        'title' => 'Похожие',
    ])

    <div class="line-margin mt-4"></div>

    {{-- Популярные приложения в данной категории --}}
    @include ('main.includes.horisontal-apps-list', [
        'list'  => $page->PopularInCategory,
        'title' => 'Топ популярных',
    ])

    {{-- Блоги --}}
    {{-- @include ('main.includes.blogs-list', ['PopularBlogs' => $page->PopularBlogs]) --}}

@endsection

@section('js-section')
    @vite(['resources/js/main/main.js'])
@endsection
