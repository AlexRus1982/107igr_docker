<template>
    <ImageUploader></ImageUploader>

    <div class="apps-page" ref="appsPage">

        <!-- preloader -->
        <div class="apps-loader">
            <v-progress-circular color="blue" indeterminate :size="75" :width="9"></v-progress-circular>
        </div>

        <!-- toasts -->
        <div class="toast-container position-fixed bottom-0 start-50 translate-middle-x p-2">
            <div id="toast-message-warn" class="toast align-items-center bg-danger text-bg-primary border-0 rounded-0"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ appMessageWarn }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <div id="toast-message-success"
                class="toast align-items-center bg-success text-bg-primary border-0 rounded-0" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">{{ appMessageSuccess }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="anchor" id="startAnchor"></div>
        <div class="apps-body">

            <div class="left-column">
                <v-card elevation="0" rounded="lg"
                    style="position: sticky; top: 0px; display: flex; flex-direction: column; gap: 10px; width: 220px; padding: 0px 10px; background: none;">
                    <IconImage :imagePath="'https://files.107igr.ru' + appData.icon" @imageChanged="onIconChanged"
                        style="height: 200px; object-fit: contain;"></IconImage>

                    <!-- Content Menu -->
                    <v-card class="content-menu" elevation="4" rounded="lg">
                        <v-list density="compact">
                            <v-list-item 
                                v-for="item in contentMenu"
                                @click="scrollToId(item.anchor)"
                                :class="item.id == activeContentMenuId ? 'active' : false"
                            >
                                {{ item.label }}
                            </v-list-item>
                        </v-list>
                    </v-card>

                    <v-btn color="#2196F3" size="large" prepend-icon="mdi-eye" @click="viewApp($event)"
                        title="Просмотр&#013;'Crtl + click' - просмотр в новом окне" rounded="xs">
                        Просмотр
                    </v-btn>

                    <v-btn color="#2196F3" size="large" prepend-icon="mdi-content-save" @click="saveValues" title="Сохранить изменения" rounded="xs">
                        Сохранить
                    </v-btn>
                </v-card>
            </div>

            <div class="right-column">

                <v-card elevation="4" rounded="lg" position="sticky" class="pb-5">
                    <v-card-title class="m-0 py-0" style="font-size: 2.5rem; color: #2196F3; cursor: pointer; width: fit-content;" @click="viewApp($event)">{{ appData.name }}</v-card-title>

                    <div class="first-block d-flex">

                        <div class="text-section" style="gap: 0px;">

                            <v-sheet variant="solo" class="title ma-5 mb-2">Название приложения</v-sheet>
                            <v-text-field variant="solo" class="text-input ma-5 my-0" density="compact" v-model="appData.name"></v-text-field>
                            
                            <!-- Синоним URL -->
                            <v-container class="px-5 py-0 pe-1">
                                <v-row>
                                    <v-col>
                                        <v-sheet variant="solo" class="title mb-2">Синоним URL</v-sheet>
                                        <v-text-field variant="solo" class="text-input" density="compact" v-model="appData.url"></v-text-field>
                                    </v-col>
                                    <v-col cols="1" class="px-0">
                                        <v-btn class="rounded" color="#2196F3" size="large" icon="mdi-translate" title="Сгенерировать транслит" @click="makeTranslit" style="margin-left: 7px; margin-top: 28px; width: 40px; height: 40px;"></v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>

                            <!-- Активность -->
                            <v-container class="px-5 pt-0 pb-7">
                                <v-row>
                                    <v-col>
                                        <!-- <v-sheet :elevation="2" :height="56" border rounded class="d-flex align-center px-4">Активность</v-sheet> -->
                                        <v-sheet variant="solo" class="title my-0">Активность</v-sheet>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="1" class="my-check-box" style="padding: 0px 0px 0px 10px;">
                                        <input class="ms-auto form-check-input" id="activityCheck" type="checkbox" role="switch"
                                        :checked="appData.activity == 1 ? true : false" 
                                        style="cursor: pointer; width: 40px; height: 40px; margin: 0px 0px 7px 0px; background-color: #2196F3; border-color: #2196F3;"
                                        @change="switchActivity">
                                    </v-col>
                                </v-row>
                            </v-container>

                            <v-sheet variant="solo" class="title mx-5 my-0 mb-2">Ссылка на файл</v-sheet>
                            <v-text-field variant="solo-filled" class="text-input mx-5" density="compact" v-model="appData.file"></v-text-field>

                            <!-- Ссылка на сервере -->
                            <v-container class="server-loader px-5 py-0 pe-1">
                                <v-row>
                                    <v-col>
                                        <v-sheet variant="solo" class="title my-0 mb-2">Ссылка на сервере</v-sheet>
                                        <v-text-field v-if="appData.file" variant="solo" class="text-input" density="compact" v-model="appData.file_on_server" :placeholder="appData.file_on_server_placeholder"></v-text-field>
                                        <v-text-field v-else variant="solo" placeholder="Нет ссылки на файл" class="text-input" density="compact" disabled></v-text-field>
                                    </v-col>
                                    <v-col v-if="appData.file && appUploading == false" cols="1" class="px-0">
                                        <v-btn class="rounded" color="#2196F3" size="large" icon="mdi-download" title="Загрузить на сервер" @click="loadToServer" style="margin-left: 7px; margin-top: 28px; width: 40px; height: 40px;"></v-btn>
                                    </v-col>
                                    <v-col v-if="appData.file && appUploading" cols="1" class="progress-circular px-0">
                                    <!-- <v-col cols="1" class="px-0"> -->
                                        <v-progress-circular
                                            color="blue-lighten-3"
                                            indeterminate
                                            :size="40"
                                            :width="5"
                                        ></v-progress-circular>
                                    </v-col>
                                </v-row>
                            </v-container>

                            <!-- Редирект -->
                            <v-container class="px-5 py-0 pe-1">
                                <v-row>
                                    <v-col>
                                        <v-sheet variant="solo" class="title my-0 mb-2">Редирект</v-sheet>
                                        <v-text-field variant="solo" class="text-input" density="compact" v-model="appData.redirect_url" @change="changedRedirectUrl"></v-text-field>
                                    </v-col>
                                    <v-col cols="1" class="my-check-box" style="padding: 0px 0px 0px 7px;">
                                        <input class="ms-auto form-check-input" id="activityRedirect" type="checkbox" role="switch"
                                        :checked="appData.redirect == 1 ? true : false" 
                                        style="cursor: pointer; width: 40px; height: 40px; margin: 41px 0px 0px 0px; background-color: #2196F3; border-color: #2196F3;"
                                        @change="switchRedirect($event)">
                                    </v-col>
                                </v-row>
                            </v-container>

                            <!-- Категория -->
                            <!-- <v-container class="px-5 py-0">
                                <v-row>
                                    <v-col>
                                        <v-sheet variant="solo" class="title my-0 mb-2">Категория</v-sheet>
                                        <v-sheet variant="solo" class="info info-category d-flex align-center px-4">{{ appData.category }}</v-sheet>
                                    </v-col>
                                </v-row>
                            </v-container> -->

                            <!-- Категория2 -->
                            <v-container class="px-5 py-0">
                                <v-row>
                                    <v-col>
                                        <v-sheet variant="solo" class="title my-0 mb-2">Категория</v-sheet>
                                        <v-select variant="solo" class="category-selector"
                                            v-model="categorySelected"
                                            :items="categories"
                                            item-title="category"
                                            item-value="categoryId"
                                            @update:modelValue = "onCategoryChanged"
                                            label="Select"
                                            persistent-hint
                                            return-object
                                            single-line
                                        ></v-select>
                                    </v-col>
                                </v-row>
                            </v-container>

                            <AdditionCategories :app_category_id="appData.category_id"
                                :app_addition_categories="appData.addition_categories"
                                @additionCategoriesChanged="onAdditionCategoriesChanged">
                            </AdditionCategories>

                            <AppLinks :app_id="appData.id"></AppLinks>
                        </div>

                    </div>
                </v-card>

                <!-- Характеристики -->
                <v-card id="charakteristicsAnchor" elevation="4" rounded="lg" class="p-3">
                    <v-card-title class="m-0 mb-3 p-0">Характеристики</v-card-title>
                    <v-card-text class="m-0 p-0">
                        <v-container class="px-3 py-3 pb-5" style="border-top: 1px solid #0007;">
                            <v-row v-for="item in charakteristics" style="border-bottom: 1px solid #0007; font-size: 14px;">
                                <v-col cols="3" style="background-color: #F0F4F8;"><div>{{ item.label }}</div></v-col>
                                <v-col><div>{{ appData[`${item.data}`] }}</div></v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>

                <!-- Плюсы -->
                <v-card id="plusesAnchor" elevation="4" rounded="lg" class="p-3 pe-0">
                    <v-card-title class="m-0 mb-3 p-0">Плюсы</v-card-title>
                    <v-card-text class="m-0 p-0">
                        <v-container class="p-0">
                            <v-row v-for="plusItem in getPlusesArray">
                                <v-col>
                                    <v-sheet variant="solo" class="info d-flex align-center px-4">{{ plusItem }}</v-sheet>
                                </v-col>
                                <v-col cols="1" class="m-0 p-0 mt-3">
                                    <v-btn class="rounded" color="#2196F3" icon="mdi-delete-forever" style="width: 40px; height: 40px; margin-left: 7px;"></v-btn>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>

                <!-- Минусы -->
                <v-card id="minusesAnchor" elevation="4" rounded="lg" class="p-3 pe-0">
                    <v-card-title class="m-0 mb-3 p-0">Минусы</v-card-title>
                    <v-card-text class="m-0 p-0">
                        <v-container class="p-0">
                            <v-row v-for="minusItem in getMinusesArray">
                                <v-col>
                                    <v-sheet variant="solo" class="info d-flex align-center px-4">{{ minusItem }}</v-sheet>
                                </v-col>
                                <v-col cols="1" class="m-0 p-0 mt-3">
                                    <v-btn class="rounded" color="#2196F3" icon="mdi-delete-forever" style="width: 40px; height: 40px; margin-left: 7px;"></v-btn>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                </v-card>

                <!-- Скриншоты и видео -->
                <v-card id="mediaTabAnchor" elevation="4" rounded="lg">
                    <v-tabs v-model="screenShotsTab">
                        <v-tab value="screen_shots_tab">Скриншоты</v-tab>
                        <v-tab value="videos_tab">Видео</v-tab>
                    </v-tabs>

                    <v-card-text>
                        <v-tabs-window v-model="screenShotsTab">
                            <!-- Скриншоты -->
                            <v-tabs-window-item value="screen_shots_tab">
                                <!-- <div class="screen-shots-label" style="font-size: 1.5rem;">Скриншоты</div> -->
                                <ScreenShots :gallery="appData.screen_shots" @orderChanged="onScreenShotsChanged">
                                </ScreenShots>
                            </v-tabs-window-item>

                            <!-- Видео -->
                            <v-tabs-window-item value="videos_tab">
                                <!-- <div class="video-shots-label" style="font-size: 1.5rem;">Видео</div> -->
                                <VideoShots :gallery="appData.video" @orderChanged="onVideoShotsChanged"></VideoShots>
                            </v-tabs-window-item>
                        </v-tabs-window>
                    </v-card-text>
                </v-card>

                <!-- Описание и Гигачат -->
                <v-card id="descTabAnchor" elevation="4" rounded="lg">
                    <v-tabs v-model="descTab">
                        <v-tab value="desc_tab">Описание</v-tab>
                        <v-tab value="desc_gen_tab">ГигаЧат</v-tab>
                    </v-tabs>

                    <v-card-text>
                        <v-tabs-window v-model="descTab">
                            <!-- Описание -->
                            <v-tabs-window-item value="desc_tab">
                                <!-- <div class="text-editor-label" style="font-size: 1.5rem;">Описание</div> -->
                                <TextEditor :text="DTO_description" @textChanged="onTextChanged"></TextEditor>
                            </v-tabs-window-item>

                            <!-- ГигаЧат -->
                            <v-tabs-window-item value="desc_gen_tab">
                                <!-- <div class="text-editor-label" style="font-size: 1.5rem;">ГигаЧат</div> -->
                                <TextEditor :text="appData.gen_desc" @textChanged="onTextChanged"></TextEditor>
                            </v-tabs-window-item>
                        </v-tabs-window>
                    </v-card-text>
                </v-card>

                <!-- Вопросы и ответы -->
                <QuestionsAndAnswers :loading="questionsAndAnswersLoading" :questionsAndAnswers="questionsAndAnswers"/>

            </div>
        </div>
    </div>
</template>

<style lang="scss">
    $max-item-width : 1200px;

    .my-check-box .form-check-input:not(:checked) {
        box-shadow: inset 0px 0px 2px 2px rgb(33, 150, 243);
        background-color: #FFF !important;
    }
   
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

    .server-loader {
        .v-progress-circular {
            margin-top: 28px;
            margin-left: 10px;
        }
    }

    .tox .tox-notifications-container {
        display: none !important;
        top: -10000px !important;
    }

    .content-menu .active {
        background-color: #29F7;
        color: #FFF;
        font-weight: bold;
    }

    .apps-page {
        width: 100%;
        height: calc(100vh - 64px);
        overflow-y: auto;
        scroll-behavior: smooth;
        scroll-margin-top: 20px;
        // min-height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        // padding: 64px 0px;

        &::-webkit-scrollbar {
            width: 5px;               /* ширина scrollbar */
            height: 5px;
        }
        &::-webkit-scrollbar-track {
            background: #0000;        /* цвет дорожки */
        }
        &::-webkit-scrollbar-thumb {
            border-radius: 0px;       /* закругления плашки */
            border: 3px solid #2196F3;  /* padding вокруг плашки */
        }

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
                flex-direction: row;
                margin: 64px 0px;

                .left-column {
                    width: 100%;
                    max-width: 220px;
                    margin-left: 10px;
                    // background-color: #0F0;
                }

                .right-column {
                    width: 100%;
                    max-width: 900px;
                    display: flex;
                    flex-direction: column;
                    gap: 50px;
                    // background-color:#E84;
                }
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

            .v-sheet.title {
                font-size: 14px;
                color: #636B74;
            }

            .v-sheet.info {
                font-size: 14px;
                color: #000;
                box-shadow: 0px 0px 2px 0px var(--v-shadow-key-ambient-opacity, rgba(0, 0, 0, 0.12));
                background-color: #F0F4F8;
                border-radius: 5px !important;
                height: 40px;

                &.info-category {
                    box-shadow: 0px 0px 0px 1px #0007;
                }
            }

            .text-input .v-field {
                box-shadow: 0px 0px 2px 0px var(--v-shadow-key-ambient-opacity, rgba(0, 0, 0, 0.12));
            }

            .v-text-field.text-input {
                input {
                    background-color: #F0F4F8;
                    font-size: 14px;
                    color: #000;
                    border-radius: 5px;
                    padding: 5px 10px;
                    height: 32px;

                    &:focus {
                        box-shadow: 0px 0px 0px 2px #29F;
                    }
                }
            }

            .v-textarea.text-input {
                textarea {
                    background-color: #F0F4F8;
                    font-size: 14px;
                    color: #000;
                    border-radius: 5px;
                    padding: 10px 10px 5px 10px;
                    height: 32px;

                    &:focus {
                        box-shadow: inset 0px 3px 2px 3px #29F;
                    }
                }
            }

            .v-textarea.info {
                textarea {
                    background-color: #F0F4F8;
                    font-size: 14px;
                    color: #000;
                    border-radius: 5px;
                    padding: 5px 10px;
                    height: 32px;

                    &:focus {
                        box-shadow: 0px 0px 0px 2px #29F;
                    }
                }
            }

            .v-select.category-selector {
                .v-field {
                    background-color: #F0F4F8;
                    height: 40px;
                    padding-right: 5px;

                    .v-field__overlay {
                        box-shadow: 0px 0px 0px 1px #0007;
                        border-radius: 5px;
                    }

                    .v-field__input {
                        font-size: 14px;
                        color: #000;
                        padding: 5px 10px;
                        height: 40px;
                        min-height: 40px;
                    }
                }
            }

            .header-buttons {
                position: fixed;
                right: 25px;
                top: 4px;
                z-index: 10000;

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
    import AdditionCategories   from '../Elements/AdditionCategories2.vue'
    import AppLinks             from '../Elements/AppLinks2.vue'
    import TextEditor           from '../Elements/TextEditor.vue'
    import ScreenShots          from '../Elements/ScreenShots.vue'
    import VideoShots           from '../Elements/VideoShots.vue'
    import QuestionsAndAnswers  from '../Elements/QuestionsAndAnswers.vue'
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
            QuestionsAndAnswers,
        },

        computed : {
            getPlusesArray(){
                if (this.appData.pluses_JSON) {
                    const plusesArray = JSON.parse(this.appData.pluses_JSON)
                    console.debug(plusesArray)
                    return plusesArray.filter(item => item != '')
                } else {
                    return []
                }
            },

            getMinusesArray(){
                if (this.appData.minuses_JSON) {
                    const minusesArray = JSON.parse(this.appData.minuses_JSON)
                    console.debug(minusesArray)
                    return minusesArray.filter(item => item != '')
                } else {
                    return []
                }
            },
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
            const categories = ref(<any>[]);
            const categorySelected = ref({});

            fetch(`/../api/categories`, {
                method      : 'GET',
                headers     : {
                    'Accept'        : 'application/json',
                    'Content-Type'  : 'application/json'
                },
            })
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list'          : _categories,
                }) => {

                    const categoryList = []
                    _categories.forEach(element => {
                        categoryList.push({ categoryId : element.category.id, category : element.category.category });
                    });

                    categories.value = categoryList
                    console.debug(categories)

                    // categoriesMap.forEach((value, key) => {
                    //     value.checked = false;
                    //     value['newChecked'] = false;
                    // });

                    // categoriesMap.delete(`${props.app_category_id}`)
                }
            )

            const screenShotsTab = ref(null)
            const descTab = ref(null)
            const plusesAndMinusesTab = ref(null)

            const url = new URL(`${window.location}`);
            const appId = url.searchParams.get('id');

            const appData = ref(<any>[]);
            const appMessageWarn = ref('');
            const appMessageSuccess = ref('');
            const appUploading = ref(false);

            const activeContentMenuId = ref('01')
            const contentMenu = [
                { 'id' : '01',  'label' : 'Начало',           'anchor' : 'startAnchor' },
                { 'id' : '02',  'label' : 'Характеристики',   'anchor' : 'charakteristicsAnchor' },
                { 'id' : '03',  'label' : 'Плюсы',            'anchor' : 'plusesAnchor' },
                { 'id' : '04',  'label' : 'Минусы',           'anchor' : 'minusesAnchor' },
                { 'id' : '05',  'label' : 'Медиа',            'anchor' : 'mediaTabAnchor' },
                { 'id' : '06',  'label' : 'Описание',         'anchor' : 'descTabAnchor' },
                { 'id' : '07',  'label' : 'Вопросы и ответы', 'anchor' : 'qwAndAnswAnchor' },
            ]

            const charakteristics = [
                { 'label' : 'Разработчик',      'data' : 'developer' },
                { 'label' : 'Категории',        'data' : 'category' },
                { 'label' : 'Версия Android',   'data' : 'android version' },
                { 'label' : 'Обновлено',        'data' : 'update' },
                { 'label' : 'Отзывов',          'data' : 'feedback' },
                { 'label' : 'Размер',           'data' : 'size' },
                { 'label' : 'Ограничения',      'data' : 'limits' },
                { 'label' : 'Скачиваний',       'data' : 'downloads' },
            ]

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

                    app['feedback'] = '4 млн'

                    appData.value = app;
                    DTO_description.value = app.description;

                    categorySelected.value = { categoryId : app.category_id, category : app.category }

                    $('.apps-page').addClass('loaded');
                }

            )

            const questionsAndAnswers = ref(<any>[])
            const questionsAndAnswersLoading = ref(true)

            fetch(`/../api/questionsAndAnswers?app_id=${appId}`, {
            // fetch(`/../api/questionsAndAnswers`, {
                method      : 'GET',
                headers     : {
                    'Accept'        : 'application/json',
                    'Content-Type'  : 'application/json'
                },
            })
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list'          : _questionsAndAnswers,
                }) => {
                    console.debug(_questionsAndAnswers)
                    questionsAndAnswersLoading.value = false

                    _questionsAndAnswers.forEach(item => {
                        questionsAndAnswers.value.push({ id : item.qa_id, question : item.qa_q, answer: item.qa_a, order : item.qa_order, deleted : false })
                    });
                }
            )

            // questionsAndAnswers.value.push({ id : '1', question : '1?', answer: '1.', order : 0, deleted : false })
            // questionsAndAnswers.value.push({ id : '2', question : '2?', answer: '2.', order : 1, deleted : false })
            // questionsAndAnswers.value.push({ id : '3', question : '3?', answer: '3.', order : 2, deleted : false })
            // console.debug(questionsAndAnswers)

            return {
                categories,
                categorySelected,
                activeContentMenuId,
                contentMenu,
                descTab,
                screenShotsTab,
                plusesAndMinusesTab,
                appId,
                appData,
                appMessageWarn,
                appMessageSuccess,
                appUploading,
                DTO_description,
                charakteristics,

                questionsAndAnswers,
                questionsAndAnswersLoading,
            }
        },

        mounted() {

            this.toastWarn      = new window.bootstrap.Toast($('#toast-message-warn')[0]);
            this.toastSuccess   = new window.bootstrap.Toast($('#toast-message-success')[0]);

            this.$refs.appsPage.addEventListener('scroll', (event) => {
                
                const minusArray = this.contentMenu.filter(item => {
                    const element = document.getElementById(item.anchor);
                    const elementTop = element?.getBoundingClientRect().top - 114;
                    return elementTop < 0
                })

                if (minusArray.length > 0){
                    const element = document.getElementById(minusArray[0].anchor);
                    const elementTop = element?.getBoundingClientRect().top - 114;

                    let maxValue = elementTop
                    this.activeContentMenuId = minusArray[0].id

                    minusArray.forEach(item => {
                        const element = document.getElementById(item.anchor);
                        const elementTop = element?.getBoundingClientRect().top - 114;
                        if (elementTop >= maxValue) {
                            maxValue = elementTop
                            this.activeContentMenuId = item.id
                        }
                    });
                }
            })
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
                // console.debug(this.appData);
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

                console.debug(this.questionsAndAnswers, this.appId);
                fetch(`/../api/questionsAndAnswers`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'app_id'        : this.appId,
                        'list'          : this.questionsAndAnswers,
                    })
                })
                .then(() => {
                    // this.appMessageSuccess = 'Данные сохранены.';
                    // this.toastSuccess.show();

                    this.questionsAndAnswersLoading = true
                    fetch(`/../api/questionsAndAnswers?app_id=${this.appId}`, {
                    // fetch(`/../api/questionsAndAnswers`, {
                        method      : 'GET',
                        headers     : {
                            'Accept'        : 'application/json',
                            'Content-Type'  : 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(
                        ({
                            'server-answer' : server_answer, 
                            'list'          : _questionsAndAnswers,
                        }) => {
                            console.debug(_questionsAndAnswers)
                            
                            this.questionsAndAnswers.length = 0
                            _questionsAndAnswers.forEach(item => {
                                this.questionsAndAnswers.push({ id : item.qa_id, question : item.qa_q, answer: item.qa_a, order : item.qa_order, deleted : false })
                            });
                            this.questionsAndAnswersLoading = false
                        }
                    )

                })
                .catch(error => console.log("request failed", error));
            },

            viewApp(event) {
                const appUrl = `/../${this.appData.main_url}/${this.appData.url}`;
                window.open(appUrl, '_blank');

                // if (event.ctrlKey) {
                //     window.open(appUrl, '_blank');
                // } else {
                //     window.location.href = appUrl;
                // }
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

            scrollToId(idName) {
                const element = document.getElementById(idName);
                const viewportOffset = element?.getBoundingClientRect();
                const scrollTo = (viewportOffset?.top ? viewportOffset?.top : 0) + this.$refs.appsPage.scrollTop - 64;

                this.$refs.appsPage.scrollTo({ top: scrollTo, left: 0, behavior: 'smooth' })
            },

            onCategoryChanged() {
                this.appData.category_id = this.categorySelected.categoryId
                this.appData.category = this.categorySelected.category
                console.debug(this.appData)
            }
        },
    }
</script>