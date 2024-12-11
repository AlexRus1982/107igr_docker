<template>
    <ImageUploader></ImageUploader>
    
    <div class="page-page">
        
        <!-- preloader -->
        <div class="page-loader">
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
                    <div class="toast-body">{{ pageMessageWarn }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <div id="toast-message-success" class="toast align-items-center bg-success text-bg-primary border-0 rounded-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ pageMessageSuccess }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="page-body">
            <div class="header-buttons d-flex mb-3">
                <div 
                    class="view-button d-flex ms-auto me-2 p-2" 
                    @click="viewPage($event)" 
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
                        <div class="app-section-name-label label me-2">Название страницы</div>
                        <input class="app-section-name-input" type="text" v-model="pageData.name">
                    </div>
        
                    <div class="app-section d-flex">
                        <div class="app-section-name-label label me-2">Синоним URL</div>
                        <input class="app-section-name-input" type="text" v-model="pageData.url">
                        <div class="translate-button" title="Сгенерировать транслит" @click="makeTranslit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                                <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
                                <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="me-auto form-check form-switch form-check-reverse" style="font-size: 1.1rem; padding-top: 6px; padding-bottom: 6px;">
                        <label class="form-check-label" for="activityCheck" style="margin-right: 108px;">Активность</label>
                        <input 
                            class="ms-auto form-check-input"
                            id="activityCheck"
                            type="checkbox"
                            role="switch"
                            :checked="pageData.activity == 1 ? true : false"
                            style="cursor: pointer;"
                            @change="switchActivity"
                        >
                    </div>
                </div>

                <div class="image-section">
                    <IconImage :imagePath = "pageData.image" @imageChanged="onIconChanged"></IconImage>
                </div>
            </div>

            <div class="text-editor-label" style="font-size: 1.5rem;">Содержимое страницы</div>
            <TextEditor :text="DTO_description" @textChanged="onTextChanged"></TextEditor>
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

    .page-page {
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
            }
        }

        .image-section {
            margin-left: 20px;
            min-width: 135px;
            max-width: 135px;
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            position: relative;
        }

        &.loaded {
            .page-body {
                display: flex;
            }
            
            .page-loader {
                display: none;
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

            .translate-button {
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

    import ImageUploader    from '../Elements/ImageUploader.vue'
    import IconImage        from '../Elements/IconImage.vue'
    import TextEditor       from '../Elements/TextEditor.vue'

    export default {
        name: "PageEditPage",

        components: {
            ImageUploader,
            IconImage,
            TextEditor,
        },

        setup() {
            /*
                "id",
                "activity",
                "name",
                "url",
                "image",
                "description"
            */

            const url = new URL(`${window.location}`);
            const pageId = url.searchParams.get('id');

            const pageData = ref(<any>[]);
            const pageMessageWarn = ref('');
            const pageMessageSuccess = ref('');

            const DTO_description = ref(pageData.description);

            console.debug(url, pageId);

            fetch(`/../api/page/${pageId}`)
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'page'          : page,
                }) => {
                    console.debug(JSON.stringify(Object.keys(page)));
                    console.debug(page);
                    
                    pageData.value = page;
                    DTO_description.value = page.description;

                    $('.page-page').addClass('loaded');
                }
            )

            return {
                pageData,
                pageMessageWarn,
                pageMessageSuccess,
                DTO_description,
            }
        },

        mounted() {
            this.toastWarn      = new window.bootstrap.Toast($('#toast-message-warn')[0]);
            this.toastSuccess   = new window.bootstrap.Toast($('#toast-message-success')[0]);
        },

        methods: {
            onIconChanged(iconPath) {
                this.pageData.image = iconPath;
            },

            onTextChanged(text) {
                this.pageData.description = text;
            },

            saveValues() {
                console.debug(this.pageData);
                fetch(`/../api/pages/update`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'page_DTO'      : this.pageData,
                    })
                })
                .then(() => {
                    this.pageMessageSuccess = 'Данные сохранены.';
                    this.toastSuccess.show();
                })
                .catch(error => console.log("request failed", error));
            },

            viewPage(event) {
                const pageUrl = `/../${this.pageData.url}`;

                if (event.ctrlKey) {
                    window.open(pageUrl, '_blank');
                } else {
                    window.location.href = pageUrl;
                }
            },

            makeTranslit() {
                this.pageData.url = this.pageData.name.translit();
            },

            switchActivity() {
                this.pageData.activity = (this.pageData.activity == '0') ? '1' : '0';
            },
        },
    }
</script>