<template>
    <div class="tags-page">
        
        <!-- preloader -->
        <div class="tags-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <!-- tags -->
        <div 
            class="tags-group"
        >
            <div class="tags-title">
                <div class="col-1">Тэг</div>
                <div class="col-2">Статьи</div>
                <div class="col-3">Приложения</div>
                <div class="col-4"></div>
            </div>

            <div class="tags-items pt-2">
                <div 
                    class="tags-item"
                    v-for="item in tagsList"
                    :key="item.tag.id"
                    :item-id="item.tag.id"
                >
                    <div class="tags-item-header" @click="onHeaderClick(item.tag.id)">
                        <div class="col-1">{{ item.tag.tag_name }}</div>
                        <div class="col-2">{{ item.tag_links_blogs.length }}</div>
                        <div class="col-3">{{ item.tag_links_apps.length }}</div>
                    </div>

                    <div class="tags-item-links collapsed">
                        <div class="header pt-3 mb-2" v-if="item.tag_links_blogs.length > 0">Связанные статьи</div>
                        <div class="link-blogs" v-for="link in item.tag_links_blogs">{{ link.title }}</div>
                        <div class="list-devider mt-2 mb-3" v-if="item.tag_links_blogs.length > 0"></div>
                        <div class="header mb-2" v-if="item.tag_links_apps.length > 0">Связанные приложения</div>
                        <div class="link-apps" v-for="link in item.tag_links_apps">{{ link.name }}</div>
                        <div class="list-devider mt-2" v-if="item.tag_links_apps.length > 0"></div>
                    </div>

                </div>
            </div>

            <div class="tags-add-item" title="Добавить тэг">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    $max-item-width : 600px;
    
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .tags-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 0px;

        &.loaded {
            .tags-group {
                display: flex;
            }
            
            .tags-loader {
                display: none;
            }
        }

        .tags-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: tags-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }

        @keyframes tags-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }

        .tags-group {
            display: none;
            flex-direction: column;
            align-items: flex-end;
            width: 100%;
            max-width: $max-item-width;

            .tags-title {
                display: flex;
                flex-direction: row;
                position: sticky;
                top: 0px;
                z-index: 1000;
                width: 100%;
                padding: 20px;
                background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                background-color: #E84;
                @include no-select();
            }

            .col-1 {
                width: 200px;
                text-wrap:nowrap;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
            .col-2 {
                display: flex;
                justify-content: center;
                width: 150px;
            }
            .col-3 {
                display: flex;
                justify-content: center;
                width: 150px;
            }

            .col-4 {
                width: fit-content;
            }

            .tags-items {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                // max-height: 100%;
                transition: 0.3s;
                gap: 10px;

                .tags-item {
                    width: 100%;
                    transition: 0.3s;

                    &:hover {

                        .tags-item-header {
                            cursor: pointer;
                            box-shadow: 0px 0px 16px #E84;

                            color: #E84;
                            filter: brightness(130%);
                        }
                    }

                    .tags-item-header {
                        transition: 0.3s;
                        overflow: hidden;
                        padding: 20px;
                        width: 100%;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                        background-color: #FFF4;
                        @include no-select();

                        &:hover {
                            cursor: pointer;
                        }
                    }

                    .tags-item-links {
                        width: 100%;
                        overflow: hidden;

                        &.collapsed {
                            height: 0;
                        }

                        .header {
                            padding: 5px 0px;
                            padding-left: 10px;
                            font-weight: 600;
                            color: #E84;
                            filter: brightness(130%);
                            width: 100%;
                            border-bottom: 1px solid #FFF4;
                        }

                        .link-blogs,
                        .link-apps {
                            padding-left: 10px;
                        }

                        .list-devider {
                            width: 100%;
                            height: 1px;
                            background: #FFF4;
                        }

                    }
                }
            }

            .tags-add-item {
                margin-top: 10px;
                margin-left: auto;
                transition: 0.3s;

                &:hover {
                    cursor: pointer;
                    transform: rotateZ(180deg);
                }

            }
        }
    }
</style>

<script lang="ts">
    import {ref} from 'vue';
    import $ from 'jquery';
    
    export default {
        name: "TagsPage",
        
        setup() {
            const tagsList = ref(<any>[]);

            fetch('../api/tags')
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list' : list
                }) => {
                    tagsList.value = list;
                    console.debug(tagsList.value);
                    $('.tags-page').addClass('loaded');
                }
            )

            function onHeaderClick(elementId) {
                console.debug(elementId);
                const html_element = $(`.tags-item[item-id="${elementId}"] .tags-item-links`);
                const html_element_collapsed = html_element.hasClass('collapsed');
                
                $('.tags-item-links').slideUp(300);
                $('.tags-item-links').addClass('collapsed');


                if (html_element_collapsed) {
                    html_element.removeClass('collapsed');
                    html_element.slideDown(300);
                }
            }

            return {
                tagsList,

                onHeaderClick,
            }
        },
    }
</script>