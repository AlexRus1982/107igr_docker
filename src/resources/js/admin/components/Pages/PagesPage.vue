<template>
    <div class="pages-page">

        <!-- preloader -->
        <div class="pages-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <div class="pages-list">
            <div 
                class="item"
                v-for="page in pagesList"
            >
                <img :src="imageUrl" :alt=page.name>
                <div class="title">{{ page.name }}</div>

                <div class="edit ms-auto" title="Редактирование" @click="editPage($event, page.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </div>

                <div class="delete ps-3" title="Удалить" @click="deletePage($event, page.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </div>
            </div>

            <div class="pages-add-item" title="Добавить страницу">
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

    .pages-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 0px;

        &.loaded {
            .pages-list{
                display: flex;
            }
            
            .pages-loader {
                display: none;
            }
        }
    
        .pages-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: pages-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }
    
        @keyframes pages-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }

        .pages-list {
            display: none;
            width: 100%;
            flex-direction: column;
            max-width: $max-item-width;
            gap: 10px;

            .item {
                transition: 0.3s;
                overflow: hidden;
                padding: 10px;
                width: 100%;
                display: flex;
                flex-direction: row;
                align-items: center;
                background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                background-color: #FFF4;
                @include no-select();

                img {
                    width: 75px;
                    height: 75px;
                    object-fit: contain;
                    margin-right: 10px;
                }

                &:hover {
                    // cursor: pointer;
                    box-shadow: 0px 0px 16px #E84;

                    color: #E84;
                    filter: brightness(130%);
                }

                .edit,
                .delete {
                    transition: 0.3s;

                    &:hover {
                        cursor: pointer;
                        transform: scale(1.2);
                    }
                }

                .edit {
                    &:hover {
                        color: #0F0;
                    }
                }

                .delete {
                    &:hover {
                        color: #F00;
                    }
                }
            }

            .pages-add-item {
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
    import $ from 'jquery'
    import {ref} from 'vue'

    export default {
        name: "PagesPage",
        
        setup() {
            const imageUrl = ref('/images/2123d5e370.png');
            const pagesList = ref(<any>[]);

            fetch(`../api/pages`)
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list' : list
                }) => {
                    console.debug(list);
                    pagesList.value = list;

                    $('.pages-page').addClass('loaded');
                }
            )

            return {
                imageUrl,
                pagesList,
            }
        },

        methods : {
            editPage(event, pageId) {
                console.debug(`Edit page width id = ${pageId}`);
                const appUrl = `/admin-panel/page/edit?id=${pageId}`;

                if (event.ctrlKey) {
                    window.open(appUrl, '_blank');
                } else {
                    window.location.href = appUrl;
                }
            },

            deletePage(event, pageId) {
                console.debug(`Delete page width id = ${pageId}`);
                if (!confirm('Удалить страницу?')) return;
                fetch(`../api/pages/delete`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'page_id'       : pageId,
                    })
                })
                .then(() => {
                    //location.reload();
                    $(event.target).closest('.item').remove();
                })
                .catch(error => console.log("request failed", error));
            },
        },
    }
</script>