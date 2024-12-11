<template>
    <div class="category-page">
        <!-- loading -->
        <div class="category-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <!-- games -->
        <CategoryPageList 
            :categoriesList="categoriesList" 
            categoryType="games"
            categoryTitle="Игры"
        >
        </CategoryPageList>

        <!-- apps -->
        <CategoryPageList 
            :categoriesList="categoriesList" 
            categoryType="apps"
            categoryTitle="Приложения"
        >
        </CategoryPageList>
    </div>
</template>

<style lang="scss">
    $max-item-width : 600px;

    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .drag-clone {
        width: 100%;
        max-width: $max-item-width;
        height: 3px;
        box-shadow: 0px 0px 2px #FFF;
        background: #FFF;
        // opacity: 0.3;
    }

    .category-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 0px;

        
        &.loaded {
            .category-group {
                display: flex;
            }
            
            .category-loader {
                display: none;
            }
        }

        .category-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: category-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }

        @keyframes category-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }
    }
</style>

<script lang="ts">
    import {ref} from 'vue';
    import $ from 'jquery';
    import CategoryPageList from '../Elements/CategoryPageList.vue';

    export default {
        name       : "CategoryPage",
        components : {
            'CategoryPageList' : CategoryPageList,
        },

        setup() {
            const categoriesList = ref(<any>[]);

            fetch('../api/categories')
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
                    $('.category-page').addClass('loaded');
                }
            )

            return {
                categoriesList,
            }
        },
    }
</script>