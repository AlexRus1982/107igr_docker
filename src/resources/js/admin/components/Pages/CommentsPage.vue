<template>
    <div class="comments-page">
        <!-- preloader -->
        <div class="comments-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <div class="comments-list">
            <comments-list :node="tree"></comments-list>
        </div>
    </div>
</template>

<style lang="scss" scoped>
    $max-item-width : 800px;
    
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .comments-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 0px;

        &.loaded {
            .comments-list{
                display: flex;
            }
            
            .comments-loader {
                display: none;
            }
        }
    
        .comments-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: comments-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }
    
        @keyframes comments-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }

        .comments-list {
            display: none;
            width: 100%;
            flex-direction: column;
            max-width: $max-item-width;
            gap: 10px;
        }
    }
</style>

<script lang="ts">
    import $ from 'jquery'
    import {ref} from 'vue'
    import CommentsList from '../Elements/CommentsList.vue';

    export default {
        name: "CommentsPage",
        components: {
            'comments-list' : CommentsList,
        },

        setup() {
            // let tree = {
            //     label: 'root',
            //     nodes: [
            //         {
            //             label: 'item1',
            //             nodes: [
            //                 {
            //                     label: 'item1.1',
            //                     nodes: [
            //                         {
            //                             label: 'item1.1.1'
            //                         },
            //                         {
            //                             label: 'item1.1.2'
            //                         },
            //                     ]
            //                 },
            //                 {
            //                     label: 'item1.2',
            //                     nodes: [
            //                         {
            //                             label: 'item1.2.1'
            //                         },
            //                         {
            //                             label: 'item1.2.2'
            //                         },
            //                         {
            //                             label: 'item1.2.3'
            //                         }
            //                     ]
            //                 }
            //             ]
            //         }, 
            //         {
            //             label: 'item2',
            //             nodes: [
            //                 {
            //                     label: 'item2.1'
            //                 },
            //                 {
            //                     label: 'item2.2'
            //                 },
            //                 {
            //                     label: 'item2.3'
            //                 }
            //             ]
            //         }
            //     ]
            // }

            const tree = ref(<any> {
                root : true,
                children : [],
            });

            fetch(`../api/comments`)
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list' : list
                }) => {
                    console.debug(list);

                    const elementsMap = new Map();
                    list.forEach(element => {
                        element.children = [];
                        elementsMap.set(element.id, element);

                        let item_time = element.date_time;
                        if (item_time != '' && item_time != undefined){
                            let nowTime:any = new Date();
                            let itemTime:any = new Date(item_time);
                            let diff:any = nowTime - itemTime;

                            let diff_s = Math.floor(diff / 1000);
                            let diff_m = Math.floor(diff / (60 * 1000));
                            let diff_h = Math.floor(diff / (60 * 60 * 1000));
                            let diff_d = Math.floor(diff / (24 * 60 * 60 * 1000));
                            let diff_y = Math.floor(diff / (365 * 24 * 60 * 60 * 1000));

                            let diff_value = diff_s;
                            let diff_str = 0;

                            if (diff_m > 0) {
                                diff_value = diff_m;
                                diff_str = 1;
                            }

                            if (diff_h > 0) {
                                diff_value = diff_h;
                                diff_str = 2;
                            }

                            if (diff_d > 0) {
                                diff_value = diff_d;
                                diff_str = 3;
                            }

                            if (diff_y > 0) {
                                diff_value = diff_y;
                                diff_str = 4;
                            }

                            let timeData = [
                                ['секунд', 'секунду', 'секунды', 'секунды', 'секунды', 'секунд', 'секунд', 'секунд', 'секунд', 'секунд'],
                                ['минут', 'минуту', 'минуты', 'минуты', 'минуты', 'минут', 'минут', 'минут', 'минут', 'минут'],
                                ['часов', 'час', 'часа', 'часа', 'часа', 'часов', 'часов', 'часов', 'часов', 'часов'],
                                ['дней', 'день', 'дня', 'дня', 'дня', 'дней', 'дней', 'дней', 'дней', 'дней'],
                                ['лет', 'год', 'года', 'года', 'года', 'лет', 'лет', 'лет', 'лет', 'лет']
                            ];

                            if (diff_value > 10 && diff_value < 20){
                                item_time = `${diff_value} ${timeData[diff_str][0]} назад`;
                            }
                            else {
                                item_time = `${diff_value} ${timeData[diff_str][diff_value % 10]} назад`;
                            }
                        }
                        else {
                            item_time = '';
                        }
                        
                        element.time_ago = item_time;
                    })

                    list.forEach(element => {
                        const parent = element.answer_parent_id;
                        if (parent != -1) {
                            elementsMap.get(parent).children.push(element);
                        }
                    })

                    const newList = list.filter(element => element.answer_parent_id == -1);

                    console.debug(newList);

                    tree.value.children = newList;

                    $('.comments-page').addClass('loaded');
                }
            )

            return {
                tree,
            }
        },
    }
</script>