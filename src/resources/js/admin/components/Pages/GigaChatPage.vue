<template>
    <div class="gigachat-page" ref="page">

        <!-- preloader -->
        <div class="page-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <div class="page-body">
            <div>Before chat message</div>
            <div>{{ beforeDesc }}</div>
            
            <div class="pt-5">After chat message</div>
            <div>{{ afterDesc }}</div>

            <div @click="testGenerate" style="border-radius: 5px; cursor: pointer; color:white; background: blue;">Генерация</div>
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

    .gigachat-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 50px 0px;

        &.loaded {
            .page-loader {
                display: none;
            }

            .page-body{
                display: flex;
            }

        }
    
        .page-loader {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: page-loader-rotation;
                animation-duration: 2s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
        }
    
        @keyframes page-loader-rotation {
            0% {
                transform:rotate(0deg);
            }
            100% {
                transform:rotate(360deg);
            }
        }

        .page-body {
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

    export default {
        name: "BlogsPage",

        setup() {
            const beforeDesc = ref('');
            const afterDesc = ref('');

            return {
                beforeDesc,
                afterDesc,
            }
        },
        
        mounted() {
            this.LoadData();
        },

        methods: {
            LoadData() {
            
                const loadRewrite = () => {
                    fetch(`/../api/gigachat`, {
                        method: 'POST',
                        headers: {
                            'Accept'          : 'application/json',
                            'Content-Type'    : 'application/json'
                        },
                        body: JSON.stringify({
                            'content'         : this.beforeDesc,
                        })
                    })
                    .then(response => response.json())
                    .then(
                        ({
                            'server-answer' : server_answer, 
                            'response'      : response,
                        }) => {
                            // let { 
                            //     'access_token'  : access_token,
                            //     'expires_at'    : expires_at,
                            // } = JSON.parse(response);
                            
                            // console.debug(access_token, expires_at);
                            this.afterDesc = response.choices[0].message.content;
                            console.debug(response.choices[0].message.content);
    
                            $(this.$refs.page).addClass('loaded');
                        }
                    )
                    .catch(error => console.log("request failed", error));
                }

                const loadApp = () => {
                    let id = '1';
                    fetch(`/../api/app/${id}`, {
                        method: 'GET',
                        headers: {
                            'Accept'          : 'application/json',
                            'Content-Type'    : 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(
                        ({
                            'server-answer' : server_answer, 
                            'app'           : app,
                        }) => {
                            console.debug(app);
                            this.beforeDesc = app.description;
                            loadRewrite();
                        }
                    )
                    .catch(error => console.log("request failed", error));
                }

                loadApp();
            },

            makeTranslit() {
                this.appData.url = this.appData.name.translit();
            },

            testGenerate() {
                // fetch(`/../api/cron/start`, {
                fetch(`/../api/cron/start/comment`, {
                    method: 'GET',
                    headers: {
                        'Accept'          : 'application/json',
                        'Content-Type'    : 'application/json'
                    },
                })
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer,
                        "cron-result"   : isDone,
                        "logger"        : logger, 
                        'app'           : app,
                    }) => {
                        console.debug(logger, server_answer, isDone, app);
                    }
                )
                .catch(error => console.log("request failed", error));
            }
        },
    }
</script>