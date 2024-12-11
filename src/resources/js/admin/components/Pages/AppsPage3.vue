<template>
    <div class="apps-page">

        <!-- preloader -->
        <div class="apps-loader">
            <v-progress-circular color="blue" indeterminate :size="75" :width="9"></v-progress-circular>
        </div>

        <!-- Модалка сортировки -->
        <sort-modal :isShownObject="sortDialogShow" @sortChanged="onSortOrFilterChanged"/>

        <!-- Модалка фильтрации -->
        <filter-modal :isShownObject="filterDialogShow" @filterChanged="onSortOrFilterChanged"/>

        <div class="apps-list">
            <div class="title-wrapper">
                <div class="title">
                    <div v-for="item in titleLabels" class="cw-bold" :class="item.labelClass">
                        {{ item.labelName }}
                    </div>
                </div>

                <!-- <div class="icon-panel" @click.stop>

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
                        </select>
                    </div>
                </div> -->
            </div>

            <div v-if="appsList?.data?.length > 0" class="item" v-for="app in appsList.data">
                <table-line-col v-for="item in titleLabels" :appObject="app" :columnItem="item" />
            </div>

            <div v-if="appsList?.data?.length == 0" class="empty-list">Список пуст</div>

            <div class="paggination-wrapper pt-2 pe-2">
                <div class="search mt-1">
                    <div class="clear-search mx-3" title="Очистить" @click="clearSearch()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-trash3" viewBox="0 0 16 16">
                            <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z">
                            </path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Строка для поиска"
                        style="outline: none; box-shadow: 0px 0px 1px; padding: 5px 10px; width: 100%;">
                    <button class="ms-3 px-5 bg-gradient rounded"
                        style="background: #2196F3; padding:0px 5px; color: #FFF; border: none;"
                        @click="makeSearch">Искать</button>
                </div>

                <v-pagination v-if="appsList.last_page > 1" v-model="page" :length="appsList.last_page"
                    next-icon="mdi-menu-right" prev-icon="mdi-menu-left" rounded="3" variant="elevated"
                    active-color="blue" :total-visible="5" @update:model-value="onChangePage">
                </v-pagination>

                <div v-else class="mb-2" style="height: 65px;"></div>

                <div class="sort-filter mt-1 ms-7">
                    <div class="icon-filter me-1" title="Фильтр" @click="filterDialogShow.isShown = true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-filter-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </div>

                    <div ref="sortBtn" class="icon-sort mx-2" title="Сортировка" @click="sortDialogShow.isShown = true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z" />
                            <path
                                d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<style lang="scss">
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
        height: calc(100vh - 50px);
        overflow-y: auto;
        // min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 0px 0px 0px;
        margin-top: -10px;

        &::-webkit-scrollbar {
            width: 5px;
            /* ширина scrollbar */
            height: 5px;
        }
    
        &::-webkit-scrollbar-track {
            background: #0000;
            /* цвет дорожки */
        }
    
        &::-webkit-scrollbar-thumb {
            border-radius: 5px;
            /* закругления плашки */
            border: 3px solid #29FF;
            /* padding вокруг плашки */
        }

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

            .cw {
                min-width: 100px;
            }

            .cw-bold {
                font-weight: bold;
            }

            .cw-60 {
                width: 60px;
                min-width: 60px;
            }

            .cw-240 {
                width: 240px;
                min-width: 240px;
            }

            .cmw-240 {
                min-width: 240px;
            }

            .cw-center {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .cw-center-vertical {
                display: flex;
                justify-content: start;
                align-items: center;
            }

            .cw-fit {
                width: fit-content;
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
            position: sticky;
            bottom: 0px;
            background-color: rgb(248, 247, 250);
            justify-content: flex-end;

            .search {
                width: 100%;
                display: flex;
                height: 48px;

                .clear-search {
                    height: 48px;
                    min-height: 48px;
                    width: 48px;
                    min-width: 48px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 4px;
                    box-shadow: 0px 0px 1px #000;
                    background-color: #29F;
                    color: #FFF;
                    cursor: pointer;
                }
            }

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

            .sort-filter {
                display: flex;
                flex-direction: row;

                .icon-filter, 
                .icon-sort {
                    height: 48px;
                    min-height: 48px;
                    width: 48px;
                    min-width: 48px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 4px;
                    box-shadow: 0px 0px 1px #000;
                    background-color: #29F;
                    color: #FFF;
                    cursor: pointer;
                }
            }
        }

    }
</style>

<script lang="ts">
    import $ from 'jquery'
    import {ref} from 'vue'
    import AppsPageTableLineCol from '../Elements/AppsPageTableLineCol.vue'
    import AppsPageSortModal from '../Elements/AppsPageSortModal.vue'
    import AppsPageFilterModal from '../Elements/AppsPageFilterModal.vue'

    export default {
        name: "AppsPage",

        components: {
            'table-line-col' : AppsPageTableLineCol,
            'sort-modal'     : AppsPageSortModal,
            'filter-modal'   : AppsPageFilterModal,
        },

        setup() {
            const titleLabels = [
                {
                    labelName     : '',       // аватарка
                    labelClass    : 'cw-60',
                    labelContent  : 'icon',
                },
                {
                    labelName     : 'Название',
                    labelClass    : 'w-100 cmw-240 cw-center-vertical',
                    labelContent  : 'name',
                },
                {
                    labelName     : 'Категория',
                    labelClass    : 'cw-240 cw-center-vertical',
                    labelContent  : 'category',
                },
                {
                    labelName     : 'Посещений',
                    labelClass    : 'cw cw-center',
                    labelContent  : 'visited',
                },
                {
                    labelName     : 'Переход',
                    labelClass    : 'cw cw-center',
                    labelContent  : 'go-to',
                },
                {
                    labelName     : 'Редирект',
                    labelClass    : 'cw cw-center',
                    labelContent  : 'redirect',
                },
                {
                    labelName     : 'Активно',
                    labelClass    : 'cw cw-center',
                    labelContent  : 'activity',
                },
                {
                    labelName     : 'Удалить',
                    labelClass    : 'cw cw-center',
                    labelContent  : 'delete',
                },
            ]

            const sortDialogShow = ref({
                isShown : false,
            })
            
            const filterDialogShow = ref({
                isShown : false,
            })
            // const ResourcesLocation = window.GlobalVars.ResourcesLocation;

            const url = new URL(`${window.location}`);
            const searchParam = url.searchParams.get('search');
            const sortParam = url.searchParams.get('sort');
            const filterParam = url.searchParams.get('filter');
            const pageParam = url.searchParams.get('page');
            const params = {searchParam, sortParam, filterParam};

            const page = ref(pageParam ? Number(pageParam) : 1);

            const appsList = ref(<any>[]);

            function getList() {
                $('.apps-page').removeClass('loaded');
                const url = new URL(`${window.location}`);

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
                        list.data.forEach(element => {
                            element['activity_loading'] = false
                        });

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
                const pageParam = url.searchParams.get('page')
                this.page = pageParam ? Number(pageParam) : 1;

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
                
                if (inputText   != '' && inputText) {
                    url.searchParams.set('search', `${inputText}`);
                } else {
                    url.searchParams.delete('search');
                }

                if (orderBy     != '' && orderBy) {
                    url.searchParams.set('sort', `${orderBy}`);
                } else {
                    url.searchParams.delete('sort');
                }

                if (filterValue != '' && filterValue) {
                    url.searchParams.set('filter', `${filterValue}`);
                } else {
                    url.searchParams.delete('filter');
                }

                console.debug(url);
                window.history.pushState({}, '', url);

                getList();
            }

            return {
                sortDialogShow,
                filterDialogShow,
                titleLabels,
                page,
                // ResourcesLocation,
                params,
                appsList,

                togglePanel,
                makeSearch,
                clearSearch,
                sortSelected,
                filterSelected,
            }
        },

        mounted() {
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

            onSortOrFilterChanged() {
                $('.apps-page').removeClass('loaded');
                const url = new URL(`${window.location}`);

                let params = url.searchParams.toString();
                params = (params != '') ? '?' + params : '';
                console.debug(params);
                
                const pageParam = url.searchParams.get('page')
                this.page = pageParam ? Number(pageParam) : 1;

                fetch(`../api/apps${params}`)
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'list' : list
                    }) => {
                        list.data.forEach(element => {
                            element['activity_loading'] = false
                        });

                        this.appsList = list

                        $('.apps-page').addClass('loaded');
                    }
                )
            },
        },

    }
</script>