<template>
    <ImageUploader></ImageUploader>
    
    <div class="apps-page">
        
        <!-- preloader -->
        <div class="apps-loader">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
            </svg>
            <div>Загрузка ...</div>
        </div>

        <!-- toasts -->
        <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-2">
            <div id="toast-message-warn" class="toast align-items-center bg-danger text-bg-primary border-0 rounded-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ appMessageWarn }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div id="toast-message-success" class="toast align-items-center bg-success text-bg-primary border-0 rounded-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ appMessageSuccess }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="apps-body">

            <div class="header-buttons d-flex mb-3">
                
                <div 
                    class="view-button d-flex ms-auto me-2 p-2" 
                    @click="viewApp($event)" 
                    title="Просмотр&#013;'Crtl + click' - просмотр в новом окне"
                >
                    <div class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>
                    </div>
                    <div class="btn-label">Просмотр</div>
                </div>

                <div class="save-button d-flex p-2" @click="saveValues" title="Сохранить изменения">
                    <div class="btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                            <path d="M11 2H9v3h2V2Z"/>
                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0ZM1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5Zm3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4v4.5ZM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5V15Z"/>
                        </svg>
                    </div>
                    <div class="btn-label">Сохранить</div>
                </div>
            </div>

            <div class="first-block d-flex">

                <div class="text-section">
                    <div class="app-section d-flex">
                        <div class="app-section-name-label label me-2">Название приложения</div>
                        <input class="app-section-name-input" type="text" v-model="appData.name">
                    </div>
        
                    <div class="app-section d-flex">
                        <div class="app-section-name-label label me-2">Синоним URL</div>
                        <input class="app-section-name-input" type="text" v-model="appData.url">
                        <div class="translate-button" title="Сгенерировать транслит" @click="makeTranslit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                                <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
                                <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>
                            </svg>
                        </div>
                    </div>
        
                    <div class="app-section d-flex">
                        <div class="app-section-name-label label me-2">Ссылка на файл</div>
                        <input class="app-section-name-input" type="text" v-model="appData.file">
                    </div>

                    <div class="app-section d-flex">
                        <div class="app-section-name-label label me-2">Ссылка на сервере</div>
                        <input v-if="appData.file" class="app-section-name-input" type="text" v-model="appData.file_on_server" :placeholder="appData.file_on_server_placeholder">
                        <input v-else class="app-section-name-input" type="text" placeholder="Нет ссылки на файл" disabled>
                        <div v-if="appData.file && appUploading == false" class="upload-button" title="Загрузить на сервер" @click="loadToServer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                        </div>

                        <div v-if="appData.file && appUploading" class="upload-button loading" title="Идет процесс загрузки">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-browser-chrome" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M16 8a8.001 8.001 0 0 1-7.022 7.94l1.902-7.098a2.995 2.995 0 0 0 .05-1.492A2.977 2.977 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8ZM0 8a8 8 0 0 0 7.927 8l1.426-5.321a2.978 2.978 0 0 1-.723.255 2.979 2.979 0 0 1-1.743-.147 2.986 2.986 0 0 1-1.043-.7L.633 4.876A7.975 7.975 0 0 0 0 8Zm5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a2.979 2.979 0 0 0-1.252.243 2.987 2.987 0 0 0-1.81 2.59ZM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="image-section">
                    <IconImage :imagePath = "appData.icon" @imageChanged="onIconChanged"></IconImage>
                </div>
            </div>

            <div class="me-auto form-check form-switch form-check-reverse" style="font-size: 1.1rem;">
                <label class="form-check-label" for="activityCheck" style="margin-right: 108px;">Активность</label>
                <input 
                    class="ms-auto form-check-input"
                    id="activityCheck"
                    type="checkbox"
                    role="switch"
                    :checked="appData.activity == 1 ? true : false"
                    style="cursor: pointer;"
                    @change="switchActivity"
                >
            </div>

            <div class="text-section">
                <div class="app-section d-flex">
                    <div class="app-section-name-label label me-2">
                        <div class="me-auto form-check form-switch form-check-reverse" style="font-size: 1.1rem;">
                            <label class="form-check-label" for="activityRedirect" style="margin-right: 125px;">Редирект</label>
                            <input 
                                class="form-check-input"
                                id="activityRedirect"
                                type="checkbox"
                                role="switch"
                                :checked="appData.redirect == 1 ? true : false"
                                style="cursor: pointer;"
                                @change="switchRedirect($event)"
                            >
                        </div>
                    </div>
                    <input 
                        class="app-section-name-input"
                        type="text"
                        style="width: calc(100% - 251px);"
                        v-model="appData.redirect_url"
                        @change="changedRedirectUrl"
                    >
                </div>
            </div>

            <div class="text-section">
                <div class="app-section d-flex">
                    <div class="app-section-name-label label me-2">Категория</div>
                    <div class="app-section-value" style="padding: 7px 0px;">{{appData.category}}</div>
                </div>
            </div>

            <AdditionCategories 
                :app_category_id = "appData.category_id"
                :app_addition_categories = "appData.addition_categories"
                @additionCategoriesChanged="onAdditionCategoriesChanged"
            >
            </AdditionCategories>

            <AppLinks :app_id = "appData.id"></AppLinks>

            <div class="app-section d-flex">
                <div class="app-section-name-label label me-2">Плюсы</div>
                <input class="app-section-name-input" type="text" v-model="appData.pluses_JSON">
            </div>

            <div class="app-section d-flex">
                <div class="app-section-name-label label me-2">Минусы</div>
                <input class="app-section-name-input" type="text" v-model="appData.minuses_JSON">
            </div>

            <div class="text-editor-label" style="font-size: 1.5rem;">Описание</div>
            <TextEditor :text="DTO_description" @textChanged="onTextChanged"></TextEditor>

            <div class="text-editor-label" style="font-size: 1.5rem;">ГигаЧат</div>
            <TextEditor :text="appData.gen_desc" @textChanged="onTextChanged"></TextEditor>

            <div class="screen-shots-label" style="font-size: 1.5rem;">Скриншоты</div>
            <ScreenShots :gallery="appData.screen_shots" @orderChanged="onScreenShotsChanged"></ScreenShots>

            <div class="video-shots-label" style="font-size: 1.5rem;">Видео</div>
            <VideoShots :gallery="appData.video" @orderChanged="onVideoShotsChanged"></VideoShots>
        </div>
        
    </div>
</template>

<style lang="scss">
    $max-item-width : 950px;
    
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .tox.tox-tinymce-aux {
        z-index: 100000;
    }

    .tox .tox-notifications-container {
        display: none !important;
        top: -10000px !important;
    }

    .apps-page {
        width: 100%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 0px;

        .label {
            font-size: 1.15rem;
            text-wrap: nowrap;
            min-width: 200px;
            display: flex;
            align-items: center;
        }

        .app-section-name-input {
            width: 100%;
            padding: 5px;
            outline: none;
        }

        .text-section {
            width: 100%;
            display: flex;
            gap: 10px;
            flex-direction: column;
            justify-content: center;

            .app-section-edit {
                cursor: pointer;
                transition: 0.3s;

                &:hover {
                    transform: scale(1.5);
                    color: #0F0;
                }
            }
        }

        .image-section {
            margin-left: 20px;
            min-width: 183px;
            max-width: 183px;
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            position: relative;
        }

        &.loaded {
            .apps-body {
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

        .upload-button.loading {
            margin-top: auto;
            margin-bottom: auto;
            svg {
                animation-name: apps-loader-rotation;
                animation-duration: 1s;
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

        .apps-body {
            display: none;
            width: 100%;
            flex-direction: column;
            max-width: $max-item-width;
            gap: 10px;

            .header-buttons {
                position: fixed;
                right: 25px;
                top: 4px;

                .view-button,
                .save-button {
                    position: relative;
                    border: 1px solid #FFF;
    
                    &::before {
                        content: "";
                        position: absolute;
                        transition: 0.3s;
                        top: 0px;
                        right: 0px;
                        height: 100%;
                        width: 0%;
                        background: #E84;
                        z-index: 0;
                    }
    
                    &:hover {
                        cursor: pointer;
                        
                        &::before {
                            width: 100%;
                        }
    
                        .btn-icon,
                        .btn-label {
                            filter: drop-shadow(0px 0px 4px #FFF);
                        }
                    }
    
                    .btn-icon {
                        z-index: 1;
                    }
    
                    .btn-label {
                        margin-left: 10px;
                        z-index: 1;
                    }
                }
            }

            .translate-button,
            .upload-button {
                margin-left: 10px;
                background-color: #FFF;
                color: #E84;
                padding: 5px 6px;
                border: 1px solid #FFF;
                transition: 0.3s;

                &:hover {
                    cursor: pointer;
                    border: 1px solid #E84F;
                    transform: scale(0.95);
                }
            }

        }
    }
</style>

<script lang="ts">
    declare global {
        interface Window {
            bootstrap:any;
        }
    }

    import $ from 'jquery'
    import { ref } from 'vue'

    import ImageUploader        from '../Elements/ImageUploader.vue'
    import IconImage            from '../Elements/IconImage.vue'
    import AdditionCategories   from '../Elements/AdditionCategories.vue'
    import AppLinks             from '../Elements/AppLinks.vue'
    import TextEditor           from '../Elements/TextEditor.vue'
    import ScreenShots          from '../Elements/ScreenShots.vue'
    import VideoShots           from '../Elements/VideoShots.vue'
import { createLogger } from 'vite';

    export default {
        name: "AppsEditPage",

        components: {
            ImageUploader,
            IconImage,
            AdditionCategories,
            AppLinks,
            TextEditor,
            ScreenShots,
            VideoShots,
        },

        setup() {
            /*
            {
                "id" : 0,
                "activity" : '0',
                "redirect" : '0',
                "redirect_url" : '',
                "visited" : '',
                "url" : '',
                "category_id" : '0',
                "name" : '',
                "icon" : '',
                "description" : '',
                "images" : '',
                "video" : '',
                "file" : '',
                "developer" : null,
                "android version" : null,
                "size" : null,
                "downloads" : null,
                "update" : null,
                "limits" : null,
                "pluses" : null,
                "minuses" : null,
                "version1" : null,
                "version2" : null,
                "version3" : null,
                "version4" : null,
            }
            */

            const url = new URL(`${window.location}`);
            const appId = url.searchParams.get('id');

            const appData = ref(<any>[]);
            const appMessageWarn = ref('');
            const appMessageSuccess = ref('');
            const appUploading = ref(false);

            const DTO_description = ref(appData.description);

            console.debug(url, appId);

            fetch(`/../api/app/${appId}`)
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'app'           : app,
                }) => {
                    console.debug(JSON.stringify(Object.keys(app)));
                    console.debug(app);
                    
                    // app.icon = '/img/tmp.png';
                    // app.icon = '';

                    if(app.file_on_server == '' || app.file_on_server == null) {
                        // app.file_on_server = '/storage/' + app.file.split('/').pop()
                        app.file_on_server_placeholder = `/storage/${app.file?.split('/').pop()}/${app.url}.apk`;
                    }

                    appData.value = app;
                    DTO_description.value = app.description;

                    $('.apps-page').addClass('loaded');
                }
            )

            return {
                appData,
                appMessageWarn,
                appMessageSuccess,
                appUploading,
                DTO_description,
            }
        },

        mounted() {
            this.toastWarn      = new window.bootstrap.Toast($('#toast-message-warn')[0]);
            this.toastSuccess   = new window.bootstrap.Toast($('#toast-message-success')[0]);
        },

        methods: {
            onIconChanged(iconPath) {
                this.appData.icon = iconPath;
            },

            onTextChanged(text) {
                this.appData.description = text;
            },

            onAdditionCategoriesChanged(additionCategories) {
                console.debug('changed', additionCategories);
                this.appData.addition_categories = additionCategories;
            },

            onScreenShotsChanged(screenShots) {
                this.appData.screen_shots = screenShots;
            },

            onVideoShotsChanged(videoShots) {
                this.appData.video = videoShots;
            },

            saveValues() {
                console.debug(this.appData);
                fetch(`/../api/apps/update`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'app_DTO'       : this.appData,
                    })
                })
                .then(() => {
                    this.appMessageSuccess = 'Данные сохранены.';
                    this.toastSuccess.show();
                })
                .catch(error => console.log("request failed", error));
            },

            viewApp(event) {
                const appUrl = `/../${this.appData.main_url}/${this.appData.url}`;

                if (event.ctrlKey) {
                    window.open(appUrl, '_blank');
                } else {
                    window.location.href = appUrl;
                }
            },

            makeTranslit() {
                this.appData.url = this.appData.name.translit();
            },

            loadToServer() {
                this.appUploading = true;

                let url_path = this.appData.file;

                fetch(`/../api/upload/app`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'app_id'        : this.appData.id,
                        'upload_url'    : url_path,
                        'app_name'      : this.appData.url,
                    })
                })
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'upload-result' : upload_result,
                        'upload-path'   : upload_path,
                    }) => {
                        console.debug(server_answer, upload_result, upload_path);
                        this.appMessageSuccess = 'Файл загружен на сервер.';
                        this.toastSuccess.show();
                        this.appUploading = false;
                        this.appData.file_on_server = upload_path;
                })
                .catch(error => console.log("request failed", error));

                // this.appMessageSuccess = 'Файл загружен на сервер.';
                // this.toastSuccess.show();
            },

            switchActivity() {
                this.appData.activity = (this.appData.activity == '0') ? '1' : '0';
            },

            switchRedirect(event) {
                if (this.appData.redirect_url == '' || this.appData.redirect_url == null) {
                    if (event.target.checked) {
                        this.appMessageWarn = 'Поле редирета должно быть заполнено !!!';
                        this.toastWarn.show();
                        event.target.checked = false;
                        this.appData.redirect = 0;
                    }
                }
                else {
                    this.appData.redirect = event.target.checked ? 1 : 0;
                }
            },

            changedRedirectUrl() {
            },
        },
    }
</script>