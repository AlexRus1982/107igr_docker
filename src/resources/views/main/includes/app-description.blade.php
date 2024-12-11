{{-- need on enter app --}}
@php
    $is_short = isset($short) ? true : false;
    $is_developers = isset($hasDevloperOtherItems) ? $hasDevloperOtherItems : false;

    $category = $app->category;
    $descArray = [
        [ 'label' => 'Разработчик',      'db_row' => 'developer', 'url' => '#developer' ],
        [ 'label' => 'Категории',        'db_row' => '', 'data' => $category->category, 'url' => "/{$category->main_url}/{$category->url}" ],
        [ 'label' => 'Версия Android',   'db_row' => 'android version' ],
        [ 'label' => 'Обновлено',        'db_row' => 'update' ],
        [ 'label' => 'Отзывов',          'db_row' => '', 'data' => '4 млн' ],
        [ 'label' => 'Размер',           'db_row' => 'size' ],
        [ 'label' => 'Ограничения',      'db_row' => 'limits' ],
        [ 'label' => 'Скачиваний',       'db_row' => 'downloads' ],
    ];

    // $pluses = trim($app->pluses) == '' ? [] : explode(';', trim($app->pluses));
    // $minuses = trim($app->minuses) == '' ? [] : explode(';', trim($app->minuses));

    $pluses = json_decode($app->pluses_JSON);
    $minuses = json_decode($app->minuses_JSON);

    $description_section = '';
    if ($app->gen_desc != null){
        $description_section = trim($app->gen_desc);
    } else {
        $description_section = trim($app->description);
    }

    // logger('Gen description');
    // logger(json_encode($app, JSON_UNESCAPED_UNICODE));

    if ($is_short || !$is_developers) {
        unset($descArray[0]['url']);
    }

@endphp

<div class="app-description">
    <h2 class="app-description-title">Характеристики</h2>
    <div class="app-description-wrapper">
        @foreach ($descArray as $item)
            @php
                $itemData = ($item['db_row'] == '') ? $item['data'] : $app->{"{$item['db_row']}"};
                if (isset($item['url'])) {
                    $itemData = "<a href='{$item['url']}'>{$itemData}</a>";
                }
                // echo(json_encode($itemData, JSON_UNESCAPED_UNICODE));
            @endphp
            <div class="app-description-item">
                <div>{{ $item['label'] }}</div>
                <div>{!! $itemData !!}</div>
            </div>
        @endforeach
        
        @if (!$is_short)
            <div class="pluses-and-minuses">
                @if (count($pluses) > 0)
                    <div class="pluses-column">
                        <h2 class="pluses-column-title">Плюсы</h2>
                        @foreach ($pluses as $pluse)
                            <div class="pluses-column-item">{{ $pluse }}</div>
                        @endforeach
                    </div>
                @endif

                @if (count($minuses) > 0)
                    <div class="minuses-column">
                        <h2 class="minuses-column-title">Минусы</h2>
                        @foreach ($minuses as $minus)
                            <div class="minuses-column-item">{{ $minus }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

            @if ($description_section != '')
                <div class="app-description-text">
                    <h2 style="font-size: 22px !important;">Описание</h2>
                    {!! $description_section !!}
                </div>
            @endif
        @endif

    </div>
</div>
