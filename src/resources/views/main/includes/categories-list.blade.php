{{-- need on enter categoriesList, categoriesTitle --}}
{{-- @php
    echo(json_encode($categoriesList, JSON_UNESCAPED_UNICODE));
@endphp --}}

@php
    $hasItems = count((array)$categoriesList) > 0;
@endphp

@if ($hasItems)
    <div class="categories-list-wrapper">
        <div class="categories-title-wrapper">
            <a href="{{ $categoriesTitleUrl }}" class="categories-title">{{ $categoriesTitle }}</a>
        </div>

        <div class="categories-list">
            @foreach ($categoriesList as $category)
                <a href="{{ $categoriesTitleUrl }}/{{ $category['category_url'] }}" class="category">
                    <img class="category-image" src="https://files.107igr.ru{{ $category['category_image'] }}" alt="Иконка - {{ $category['category_name'] }}">
                    <div class="category-name">{{ $category['category_name'] }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endif
