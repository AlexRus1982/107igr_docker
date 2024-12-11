<template>
    <div class="apps-page">

        <!-- preloader -->
        <div class="apps-loader">
            <v-progress-circular color="blue" indeterminate :size="75" :width="9"></v-progress-circular>
        </div>

        <div class="apps-list">
            <div class="title-wrapper">
                <div class="title">
                    <div class="col-1">Название</div>
                    <div class="col-2" title="Скачали">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-download" viewBox="0 0 16 16">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                    </div>
                    <div class="col-3" title="Посещено">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path
                                d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                            <path
                                d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
                        </svg>
                    </div>
                    <div class="col-4" title="Активно">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-power" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z" />
                            <path
                                d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
                        </svg>
                    </div>
                    <div class="col-5" title="Редирект">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-signpost" viewBox="0 0 16 16">
                            <path
                                d="M7 1.414V4H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h5v6h2v-6h3.532a1 1 0 0 0 .768-.36l1.933-2.32a.5.5 0 0 0 0-.64L13.3 4.36a1 1 0 0 0-.768-.36H9V1.414a1 1 0 0 0-2 0zM12.532 5l1.666 2-1.666 2H2V5h10.532z" />
                        </svg>
                    </div>
                    <div class="col-6" title="Тэги">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-share" viewBox="0 0 16 16">
                            <path
                                d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5zm-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z" />
                        </svg>
                    </div>
                    <div class="col-7">
                        <div class="icon icon-search ms-3" title="Поиск" @click="togglePanel($event, 'search')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </div>

                        <div class="icon icon-filter" title="Фильтр" @click="togglePanel($event, 'filter')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-filter-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </div>

                        <div class="icon icon-sort" title="Сортировка" @click="togglePanel($event, 'sort')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z" />
                                <path
                                    d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="icon-panel" @click.stop>
                    <div class="search show">
                        <div style="height: 100%; margin-right: auto; display: flex; align-items: center;">Поиск</div>
                        <div class="clear-search" title="Очистить" @click="clearSearch()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z">
                                </path>
                            </svg>
                        </div>
                        <input type="text" placeholder="Строка для поиска" style="outline: none; box-shadow: 0px 0px 1px;">
                        <button class="ms-2 bg-gradient rounded" style="background: #2196F3; padding:0px 5px; color: #FFF; border: none;"
                            @click="makeSearch">Искать</button>
                    </div>
                    <div class="filter">
                        <div style="height: 100%; margin-right: auto; display: flex; align-items: center;">
                            Фильтр</div>
                        <select class="category_select" @change="filterSelected()" style="box-shadow: 0px 0px 1px;">
                            <option value="" :selected="params.filterParam == '' ? true : false">Все</option>
                            <option value="games" :selected="params.filterParam == 'games' ? true : false">Игры</option>

                            <option v-for="item in categoriesList.filter(item => item.main_url == 'games')"
                                :value="item.id" :selected="params.filterParam == item.id ? true : false">
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ item.category }}
                            </option>

                            <option value="apps" :selected="params.filterParam == 'apps' ? true : false">Приложения
                            </option>
                            <option v-for="item in categoriesList.filter(item => item.main_url == 'apps')"
                                :value="item.id" :selected="params.filterParam == item.id ? true : false">
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ item.category }}
                            </option>
                            <!-- <option value="games" class="option-games">Игры</option><option value="Аркады">&nbsp;&nbsp;&nbsp;&nbsp;Аркады</option><option value="Викторины">&nbsp;&nbsp;&nbsp;&nbsp;Викторины</option><option value="Головоломки">&nbsp;&nbsp;&nbsp;&nbsp;Головоломки</option><option value="Гонки">&nbsp;&nbsp;&nbsp;&nbsp;Гонки</option><option value="Казино">&nbsp;&nbsp;&nbsp;&nbsp;Казино</option><option value="Казуальные">&nbsp;&nbsp;&nbsp;&nbsp;Казуальные</option><option value="Карточные">&nbsp;&nbsp;&nbsp;&nbsp;Карточные</option><option value="Музыкальные игры">&nbsp;&nbsp;&nbsp;&nbsp;Музыкальные игры</option><option value="Настольные игры">&nbsp;&nbsp;&nbsp;&nbsp;Настольные игры</option><option value="Обучающие">&nbsp;&nbsp;&nbsp;&nbsp;Обучающие</option><option value="Приключения">&nbsp;&nbsp;&nbsp;&nbsp;Приключения</option><option value="Ролевые">&nbsp;&nbsp;&nbsp;&nbsp;Ролевые</option><option value="Симуляторы">&nbsp;&nbsp;&nbsp;&nbsp;Симуляторы</option><option value="Словесные игры">&nbsp;&nbsp;&nbsp;&nbsp;Словесные игры</option><option value="Спортивные игры">&nbsp;&nbsp;&nbsp;&nbsp;Спортивные игры</option><option value="Стратегии">&nbsp;&nbsp;&nbsp;&nbsp;Стратегии</option><option value="Экшен">&nbsp;&nbsp;&nbsp;&nbsp;Экшен</option><option value="Музыка">&nbsp;&nbsp;&nbsp;&nbsp;Музыка</option>
                            <option value="apps" class="option-apps">Приложения</option><option value="Автомобили и транспорт">&nbsp;&nbsp;&nbsp;&nbsp;Автомобили и транспорт</option><option value="Бизнес">&nbsp;&nbsp;&nbsp;&nbsp;Бизнес</option><option value="Видеоплееры и редакторы">&nbsp;&nbsp;&nbsp;&nbsp;Видеоплееры и редакторы</option><option value="Еда и напитки">&nbsp;&nbsp;&nbsp;&nbsp;Еда и напитки</option><option value="Жилье и дом">&nbsp;&nbsp;&nbsp;&nbsp;Жилье и дом</option><option value="Здоровье и фитнес">&nbsp;&nbsp;&nbsp;&nbsp;Здоровье и фитнес</option><option value="Знакомства">&nbsp;&nbsp;&nbsp;&nbsp;Знакомства</option><option value="Инструменты">&nbsp;&nbsp;&nbsp;&nbsp;Инструменты</option><option value="Искусство и дизайн">&nbsp;&nbsp;&nbsp;&nbsp;Искусство и дизайн</option><option value="Карты и навигация">&nbsp;&nbsp;&nbsp;&nbsp;Карты и навигация</option><option value="Книги и справочники">&nbsp;&nbsp;&nbsp;&nbsp;Книги и справочники</option><option value="Комиксы">&nbsp;&nbsp;&nbsp;&nbsp;Комиксы</option><option value="Красота">&nbsp;&nbsp;&nbsp;&nbsp;Красота</option><option value="Материнство и детство">&nbsp;&nbsp;&nbsp;&nbsp;Материнство и детство</option><option value="Медицина">&nbsp;&nbsp;&nbsp;&nbsp;Медицина</option><option value="Мероприятия">&nbsp;&nbsp;&nbsp;&nbsp;Мероприятия</option><option value="Музыка и аудио">&nbsp;&nbsp;&nbsp;&nbsp;Музыка и аудио</option><option value="Новости и журналы">&nbsp;&nbsp;&nbsp;&nbsp;Новости и журналы</option><option value="Образование">&nbsp;&nbsp;&nbsp;&nbsp;Образование</option><option value="Персонализация">&nbsp;&nbsp;&nbsp;&nbsp;Персонализация</option><option value="Погода">&nbsp;&nbsp;&nbsp;&nbsp;Погода</option><option value="Покупки">&nbsp;&nbsp;&nbsp;&nbsp;Покупки</option><option value="Путешествия">&nbsp;&nbsp;&nbsp;&nbsp;Путешествия</option><option value="Работа">&nbsp;&nbsp;&nbsp;&nbsp;Работа</option><option value="Развлечения">&nbsp;&nbsp;&nbsp;&nbsp;Развлечения</option><option value="Разное">&nbsp;&nbsp;&nbsp;&nbsp;Разное</option><option value="Связь">&nbsp;&nbsp;&nbsp;&nbsp;Связь</option><option value="Социальные">&nbsp;&nbsp;&nbsp;&nbsp;Социальные</option><option value="Спорт">&nbsp;&nbsp;&nbsp;&nbsp;Спорт</option><option value="Стиль жизни">&nbsp;&nbsp;&nbsp;&nbsp;Стиль жизни</option><option value="Финансы">&nbsp;&nbsp;&nbsp;&nbsp;Финансы</option><option value="Фотография">&nbsp;&nbsp;&nbsp;&nbsp;Фотография</option><option value="Аудиокниги">&nbsp;&nbsp;&nbsp;&nbsp;Аудиокниги</option> -->
                            <!-- <option value="popular" class="option-popular">Популярные</option> -->
                        </select>
                    </div>
                    <div class="sort">
                        <div style="height: 100%; margin-right: auto; display: flex; align-items: center;">
                            Сортировка</div>
                        <select class="sort_select" @change="sortSelected()" style="box-shadow: 0px 0px 1px;">
                            <option value="" :selected="params.sortParam == '' ? true : false">Без сортировки</option>
                            <option value="downloads,desc"
                                :selected="params.sortParam == 'downloads,desc' ? true : false">Самые скачиваемые
                            </option>
                            <option value="downloads,asc"
                                :selected="params.sortParam == 'downloads,asc' ? true : false">Мало скачиваемые</option>
                            <option value="visited,desc" :selected="params.sortParam == 'visited,desc' ? true : false">
                                Самые посещаемы</option>
                            <option value="visited,asc" :selected="params.sortParam == 'visited,asc' ? true : false">
                                Мало посещаемые</option>
                        </select>
                    </div>
                </div>
            </div>

            <div v-if="appsList?.data?.length > 0" class="item" v-for="app in appsList.data">
                <div class="col-1 d-flex flex-row" :title="app.name">
                    <img :src="app.icon">
                    <div class="label">{{ app.name }}</div>
                </div>
                <div class="col-2">{{ app.downloads }}</div>
                <div class="col-3">{{ app.visited }}</div>
                <div class="col-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" :app-id="app.id" type="checkbox" role="switch"
                            :checked="app.activity == 1 ? true : false" @input="setActivity(app.id)">
                    </div>
                </div>
                <div class="col-5" :title="(app.redirect_url != '' && app.redirect_url) ? app.redirect_url : ''">
                    <svg v-if="app.redirect_url != '' && app.redirect_url" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path v-if="app.redirect == 1"
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                </div>
                <div class="col-6">{{ app.tags_count }}</div>
                <div class="col-7">
                    <div class="link" title="Переход" @click="linkApp($event, app)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-reply" viewBox="0 0 16 16">
                            <path
                                d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                        </svg>
                    </div>

                    <div class="edit" title="Редактирование" @click="editApp($event, app)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pencil" viewBox="0 0 16 16">
                            <path
                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                        </svg>
                    </div>

                    <div class="delete" title="Удалить" @click="deleteApp($event, app)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash3" viewBox="0 0 16 16">
                            <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div v-if="appsList?.data?.length == 0" class="empty-list">Список пуст</div>

            <div class="paggination-wrapper">
                <v-pagination v-if="appsList.last_page > 1"
                    v-model="page" 
                    :length="appsList.last_page"
                    next-icon="mdi-menu-right"
                    prev-icon="mdi-menu-left"
                    rounded="3"
                    variant="elevated"
                    active-color="blue"
                    :total-visible="10"
                    @update:model-value="onChangePage"
                >
                </v-pagination>
                <div v-else class="mb-2"></div>
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
    $max-item-width : 1200px;
    
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .apps-page {
        width: 100%;
        height: calc(100vh - 64px);
        overflow-y: auto;
        // min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 0px 0px 0px;

        &.loaded {
            .apps-list {
                display: flex;
            }
            
            .apps-loader {
                display: none;
            }
        }
    
        .apps-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: apps-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }
    
        @keyframes apps-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }

        .apps-list {
            display: none;
            width: 100%;
            flex-direction: column;
            max-width: $max-item-width;
            gap: 10px;

            .col-1 {
                width: 300px;
                text-wrap:nowrap;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
                align-items: center
            }

            .col-2 {
                display: flex;
                justify-content: center;
                width: 75px;
                align-items: center;
            }

            .col-3 {
                display: flex;
                justify-content: center;
                width: 75px;
                align-items: center
            }

            .col-4 {
                display: flex;
                justify-content: center;
                width: 75px;
                align-items: center
            }

            .col-5 {
                display: flex;
                justify-content: center;
                width: 75px;
                align-items: center
            }

            .col-6 {
                display: flex;
                justify-content: center;
                width: 75px;
                align-items: center
            }

            .col-7 {
                display: flex;
                flex-direction: row;
                width: fit-content;
                align-items: center;

                .link {
                    transition: 0.3s;
                    margin-left: 10px;
                    transform: scaleX(-1);
                    &:hover {
                        cursor: pointer;
                        transform: scaleX(-1.5) scaleY(1.5);
                        color: #06F;
                        filter: drop-shadow(0px 0px 1px #FFF);
                    }
                }

                .edit {
                    transition: 0.3s;
                    margin: 0px 10px;
                    &:hover {
                        cursor: pointer;
                        transform: scale(1.5);
                        color: #6F0;
                        filter: drop-shadow(0px 0px 1px #FFF);
                    }
                }

                .delete {
                    transition: 0.3s;
                    &:hover {
                        cursor: pointer;
                        transform: scale(1.5);
                        color: #F60;
                        filter: drop-shadow(0px 0px 1px #FFF);
                    }
                }
            }

            .title-wrapper {
                position: sticky;
                top: -24px;
                z-index: 1000;
                box-shadow: 0px 0px 8px #0007;

                .title {
                    display: flex;
                    flex-direction: row;
                    width: 100%;
                    padding: 20px;
                    background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                    background-color: #2196F3;
                    color: #FFF;
                    @include no-select();
    
                    .col-7 .icon {
                        margin-right: 10px;
                        transition: 0.3s;
                        color: #444;

                        &.highlighted {
                            color: #FFF;
                        }
    
                        &:hover {
                            cursor: pointer;
                            transform: scale(1.2);
                            filter: drop-shadow(0px 0px 2px #0007);
                        }
                    }
                }
    
                .icon-panel {
                    width: 100%;
                    text-align: end;

                    div {
                        height: 0px;
                        overflow: hidden;
                        transition: 0.3s;
                        background: #FFF;

                        &.show {
                            height: 40px;
                        }
                    }

                    .search {
                        display: flex;
                        justify-content: flex-end;
                        padding: 0px;
                        
                        &.show {
                            padding: 5px 20px;
                        }

                        input {
                            padding: 2px 4px;
                            width: 300px;
                        }

                        .clear-search {
                            margin-right: 5px;
                            transition: 0.3s;
                            color: #2196F3;
                            width: fit-content;
                            height: fit-content;

                            &:hover {
                                color: #F00;
                                cursor: pointer;
                            }
                        }
                    }

                    .filter {
                        display: flex;
                        justify-content: flex-end;
                        padding: 0px;
                        
                        &.show {
                            padding: 5px 20px;
                        }

                        select {
                            padding: 2px 4px;
                            min-width: 300px;
                            outline: none;
                        }
                    }

                    .sort {
                        display: flex;
                        justify-content: flex-end;
                        padding: 0px;
                        
                        &.show {
                            padding: 5px 20px;
                        }

                        select {
                            padding: 2px 4px;
                            width: 300px;
                            outline: none;
                        }
                    }
                }

            }

            .item {
                display: flex;
                border: 1px solid #FFF4;
                background-color: #FFF;
                box-shadow: 0px 0px 4px #0004;
                padding: 0px 20px;
                transition: 0.3s;

                img {
                    margin: 10px;
                    margin-left: 2px;
                    margin-right: 10px;
                    height: 50px;
                    width: 50px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 8px #FFF7;
                }

                .col-4 input:hover {
                    cursor: pointer;
                }

                .label {
                    display: block;
                    margin-top: auto;
                    margin-bottom: auto;
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    @include no-select();
                }

                .form-switch {
                    padding-left: 3rem;
                }

                &:hover {
                    box-shadow: 0px 0px 16px #2196F3;
                    color: #2196F3;
                    // filter: brightness(130%);
                }

            }

            .empty-list {
                margin-left: 20px;
            }
        }
    
        .paggination-wrapper {
            display: flex;
            // justify-content: space-between;
            flex-direction: row;
            gap: 10px;

            a {
                text-decoration: none;
                padding: 5px;
                min-width: 30px;
                text-align: center;
                color: #FFF;
                transition: 0.3s;

                &.active:not(.dots, .arrow) {
                    background: #E84;
                }

                &:not(.dots, .arrow) {
                    background: #FFF4;
                    background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                    border: 1px solid #FFF4;
                }

                &.hide {
                    display: none;
                }

                &:hover:not(.dots, .arrow, .active) {
                    box-shadow: 0px 0px 16px #E84;
                    color: #E84;
                    filter: brightness(130%);
                }

                &.arrow:hover {
                    color: #E84;
                    filter: drop-shadow(0px 0px 4px #E84);
                    transform: scale(1.5);
                }

            }
        }

    }
</style>

<script lang="ts">
    import $ from 'jquery'
    import {ref} from 'vue'

    export default {
        name: "AppsPage",

        setup() {
            // const ResourcesLocation = window.GlobalVars.ResourcesLocation;

            const url = new URL(`${window.location}`);
            const searchParam = url.searchParams.get('search');
            const sortParam = url.searchParams.get('sort');
            const filterParam = url.searchParams.get('filter');
            const pageParam = url.searchParams.get('page');
            const params = {searchParam, sortParam, filterParam};

            const page = ref(pageParam ? Number(pageParam) : 1);

            const appsList = ref(<any>[]);

            const categoriesList = ref(<any>[]);
            fetch('../api/categories/simple')
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list' : list
                }) => {
                    list.forEach(element => {
                        element['dragClass'] = "";
                    });
                    categoriesList.value = list;
                    console.debug(categoriesList.value);
                }
            )

            function getList() {
                $('.apps-page').removeClass('loaded');
                const url = new URL(`${window.location}`);
                // console.debug(url);
                // console.debug(url.searchParams.toString());
                // console.debug(url.searchParams.get('filter'));

                // const route = useRouter()
                // console.debug(route.currentRoute.value.query);
                // let {
                //     'page'   : page,
                //     'filter' : filter,
                //     'sort'   : sort,
                // } = route.currentRoute.value.query;

                let params = url.searchParams.toString();
                params = (params != '') ? '?' + params : '';
                console.debug(params);

                fetch(`../api/apps${params}`)
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'list' : list
                    }) => {
                        console.debug(list);

                        appsList.value = list

                        $('.apps-page').addClass('loaded');
                    }
                )
            }
            getList();

            function togglePanel(event:Event, panelClass:String) {
                const target = $(`.apps-page .apps-list .icon-panel .${panelClass}`);
                const target_visible = target.hasClass('show');

                $(`.apps-page .apps-list .icon-panel div`).removeClass('show');
                if (target_visible) {
                    target.removeClass('show');
                    $(`.apps-page .apps-list .icon-panel .search`).addClass('show');
                } else {
                    $('.main-panel-body').off('scroll');
                    
                    target.addClass('show');

                    setTimeout(() => {
                        $('.main-panel-body').on('scroll', () => {
                            $(`.apps-page .apps-list .icon-panel div`).removeClass('show');
                            console.debug('scroll');
                        });
                    }, 500);
                }
                event.stopPropagation();
            }

            let searchTimeOut;
            function makeSearch() {

                const inputText:string = $('.apps-page .search input').val() + '';
                if (inputText.length > 0) {
                    $('.apps-page .icon-search').addClass('highlighted');
                }
                else {
                    $('.apps-page .icon-search').removeClass('highlighted');
                }

                const url = new URL(`${window.location}`);
                url.searchParams.delete('page');
                window.history.pushState({}, '', url);

                updateList();

                // clearTimeout(searchTimeOut);
                // searchTimeOut = setTimeout(() => {
                //     updateList();
                // }, 500);
            }

            function clearSearch() {
                $('.apps-page .search input').val('');
            }

            function sortSelected() {
                const orderBy = $('.apps-page .sort select').val();
                if (orderBy != '') {
                    $('.apps-page .icon-sort').addClass('highlighted');
                }
                else {
                    $('.apps-page .icon-sort').removeClass('highlighted');
                }
                updateList();
            }

            function filterSelected() {
                const filterValue = $('.apps-page .filter select').val();
                if (filterValue != '') {
                    $('.apps-page .icon-filter').addClass('highlighted');
                }
                else {
                    $('.apps-page .icon-filter').removeClass('highlighted');
                }

                const url = new URL(`${window.location}`);
                url.searchParams.delete('page');
                window.history.pushState({}, '', url);

                updateList();
            }

            function updateList() {
                const inputText:string = $('.apps-page .search input').val() + '';
                console.debug(`search - ${inputText}`);

                const orderBy = $('.apps-page .sort select').val();
                console.debug(`sort - ${orderBy}`);

                const filterValue = $('.apps-page .filter select').val();
                console.debug(`filter - ${filterValue}`);

                const url = new URL(`${window.location}`);
                
                if (inputText   != '') {
                    url.searchParams.set('search', `${inputText}`);
                } else {
                    url.searchParams.delete('search');
                }

                if (orderBy     != '') {
                    url.searchParams.set('sort', `${orderBy}`);
                } else {
                    url.searchParams.delete('sort');
                }

                if (filterValue != '') {
                    url.searchParams.set('filter', `${filterValue}`);
                } else {
                    url.searchParams.delete('filter');
                }

                console.debug(url);
                window.history.pushState({}, '', url);

                getList();
            }

            function setActivity(itemId) {
                fetch(`../api/apps/activity`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'id'       : itemId,
                        'activity' : $(`input[app-id="${itemId}"]`).prop('checked') ? '1' : '0',
                    })
                })
                .catch(error => console.log("request failed", error));
            }

            function linkApp(event, app) {
                const appUrl = `../${app.main_url}/${app.url}`;

                if (event.ctrlKey) {
                    window.open(appUrl, '_blank');
                } else {
                    window.location.href = appUrl;
                }
            }

            function editApp(event, app) {
                const appUrl = `/admin-panel/apps/edit?id=${app.id}`;

                if (event.ctrlKey) {
                    window.open(appUrl, '_blank');
                } else {
                    window.location.href = appUrl;
                }
            }

            function deleteApp(event, app) {
                if (!confirm('Удалить приложение?')) return;
                fetch(`../api/apps/delete`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'app_id'        : app.id,
                    })
                })
                .then(() => {
                    //location.reload();
                    $(event.target).closest('.item').remove();
                })
                .catch(error => console.log("request failed", error));
            }

            return {
                page,
                // ResourcesLocation,
                params,
                appsList,
                categoriesList,

                togglePanel,
                makeSearch,
                clearSearch,
                sortSelected,
                filterSelected,
                setActivity,
                linkApp,
                editApp,
                deleteApp,
            }
        },

        mounted() {
            document.addEventListener('click', () => {
                $(`.apps-page .apps-list .icon-panel div`).removeClass('show');
                $(`.apps-page .apps-list .icon-panel .search`).addClass('show');
            });

            function iconPanelSetup() {
                const url = new URL(`${window.location}`);
                const searchParam = url.searchParams.get('search');
                const sortParam = url.searchParams.get('sort');
                const filterParam = url.searchParams.get('filter');

                $('.apps-page .icon-search').removeClass('highlighted');
                if (searchParam && searchParam != '') {
                    $('.apps-page .icon-search').addClass('highlighted');
                    $('.apps-page .search input').val(searchParam);
                }

                $('.apps-page .icon-sort').removeClass('highlighted');
                if (sortParam && sortParam != '') {
                    // $(`.apps-page .sort select`).val(sortParam);
                    $('.apps-page .icon-sort').addClass('highlighted');
                }

                $('.apps-page .icon-filter').removeClass('highlighted');
                console.debug(`filter param - ${filterParam}`);
                if (filterParam && filterParam != '') {
                    // $(`.apps-page .filter select`).val(filterParam);
                    $('.apps-page .icon-filter').addClass('highlighted');
                }
            }

            iconPanelSetup();

            // $('.main-panel-body').on('scroll', () => {
            //     $(`.apps-page .apps-list .icon-panel div`).removeClass('show');
            //     console.debug('scroll');
            // });
        },
        
        methods : {
            onChangePage(newPage) {
                const url = new URL(`${window.location}`);
                const searchParam = url.searchParams.get('search');
                const sortParam = url.searchParams.get('sort');
                const filterParam = url.searchParams.get('filter');
                const pageParam = url.searchParams.get('page');
                
                const params = {
                    'page'      : newPage,
                    'search'    : searchParam,
                    'sort'      : sortParam,
                    'filter'    : filterParam,
                }
                
                let newHref = `${url.pathname}`
                let paramsStr = ''
                for (const key in params) {
                    const value = params[key];
                    if (value) {
                        paramsStr += `&${key}=${value}`
                    }
                }
                if (paramsStr) {
                    paramsStr = `?${paramsStr.slice(1)}`
                }
                // console.debug(newHref, paramsStr)
                
                window.location.href = `${newHref}${paramsStr}`
            },
        },

        // watch : {
        //     page : function (newPage) {
        //         console.debug(newPage)
        //     },
        // },

    }
</script>