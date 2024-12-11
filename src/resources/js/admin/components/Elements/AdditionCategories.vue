<template>
    <!-- madal -->
    <div 
        class="modal fade"
        id="setAdditionCategoriesModal" 
        ref="setAdditionCategoriesModal"
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1" 
        aria-hidden="true" 
        style="background: #FFFFFF00; backdrop-filter: blur(8px) grayscale(1.0);">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow rounded-0">

                <div class="modal-header text-black rounded-0">
                    <h5 class="modal-title">Дополнительные категории</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-2">

                    <!-- preloader -->
                    <div class="list-loader">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                        </svg>
                        <div>Загрузка ...</div>
                    </div>

                    <ul class="list-group w-100 rounded-0" style="gap: 5px;">
                        <li 
                            v-for="[key, item] in categories" 
                            :key="item.id"
                            class="list-group-item border"
                            :category_id="item.id"
                        >
                            <input 
                                class="form-check-input me-1"
                                type="checkbox"
                                :category_id="item.id"
                                :id="'input_' + item.id"
                                :ctegory_name="item.category"
                            >
                            <label 
                                class="form-check-label stretched-link" 
                                :for="'input_' + item.id"
                            >
                                {{ item.category }}
                            </label>
                        </li>
                    </ul>

                </div>

                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-warning rounded-0" @click="saveCategories()">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="text-section" style="border-top: 1px solid #FFF4; border-bottom: 1px solid #FFF4;">
        <div class="app-section d-flex align-items-center">
            <div class="app-section-name-label label me-2" style="padding: 6px 0px 6px 6px;">Доп. категории</div>
            <div class="app-section-value">{{ addition_categories_string }}</div>
            <div class="app-section-edit ms-auto px-2" @click="showAdditionCategories()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"></path></svg>                        
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    #setAdditionCategoriesModal {
        @include no-select();

        .modal-dialog {
            max-width: 400px;

            .modal-content {
                max-height: 600px;

                .modal-body {
                    color: #000;
                    height: 100vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: flex-start;
                    
                    .list-loader {
                        display: none;
                    }

                    .list-group-item {
                        display: block;

                        label {
                            margin-left: 10px;
                            cursor: pointer;
                        }
                        
                        &:hover {
                            background-color: #FC0;
                        }

                        &.hide {
                            display: none;
                        }
                    }
                }
            }
        }

        &.loading {
            .modal-body {
                justify-content: center;

                .list-loader {
                    display: block !important;
                    margin-top: auto;
                    margin-bottom: auto;
                    svg {
                        animation-name: list-loader-rotation;
                        animation-duration: 2s;
                        animation-iteration-count: infinite;
                        animation-timing-function: linear;
                    }
                }

                @keyframes list-loader-rotation {
                    0% {
                        transform:rotate(0deg);
                    }
                    100% {
                        transform:rotate(360deg);
                    }
                }

                .list-group-item {
                    display: none !important;
                }
            }
        }
    }

    .app-links-wrapper {
        @include no-select();
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        height: fit-content;
        // overflow-x: auto;
        padding: 10px 0px;
        gap: 20px;

        border-bottom: 1px solid #FFF4;
        border-top: 1px solid #FFF4;

        .tag-delete-button {
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                transform: scale(1.5);
                color: #F44;
            }
        }
    }

    .app-links-add-button-wrapper {
        width: 100%;
        display: flex;
        overflow: hidden;

        .app-links-add-button {
            margin-left: auto;
            margin-right: 5px;
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                transform: translate(0px, 2px) rotate(180deg);
            }
        }
    }

</style>

<script lang="ts">
    declare global {
        interface Window {
            bootstrap       :any;
        }
    }

    import $ from 'jquery'
    import { ref, watch } from 'vue'

    export default {
        name: "AdditionCategories",

        props: {
            app_category_id : Number,
            app_addition_categories: String, 
        },

        emits: [
            'additionCategoriesChanged',
        ],

        setup(props) {

            const categories = ref(<any>[]);
            const addition_categories_string = ref();
            const categoriesMap = new Map();

            function makeCategories() {
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
                        _categories.forEach(element => {
                            categoriesMap.set(`${element.category.id}`, element.category);
                        });

                        const newList = new Array();
                        categoriesMap.forEach((value, key) => {
                            value.checked = true;
                            newList.push(value);
                        });
                        categories.value = newList.entries();

                        if (props.app_addition_categories) {
                            const categoriesId = JSON.parse(props.app_addition_categories);
                            const categoriesStrings = new Array();
                            categoriesId.forEach(element => {
                                const category = categoriesMap.get(`${element}`);
                                categoriesStrings.push(category.category);
                            });
                            addition_categories_string.value = categoriesStrings.join(', ');
                        } else {
                            addition_categories_string.value = 'нет';
                        }
                    }
                )
            }

            makeCategories();

            watch(() => [props.app_addition_categories, ], (newValues, oldValues) => {
                makeCategories();
            });

            return {
                categories,
                addition_categories_string,
                categoriesMap,
            }
        },

        mounted() {
            this.modal = new window.bootstrap.Modal(this.$refs.setAdditionCategoriesModal);
        },

        methods : {

            saveCategories() {
                const checkedCategories = $('#setAdditionCategoriesModal .form-check-input:checked');
                const categoriesId = new Array();
                checkedCategories.each((index, element) => {
                    const category_id = $(element).attr('category_id');
                    categoriesId.push(category_id);
                })

                if (categoriesId.length) {
                    this.$emit('additionCategoriesChanged', JSON.stringify(categoriesId));
                } else {
                    this.$emit('additionCategoriesChanged', null);
                }

                this.modal.hide();
            },

            showAdditionCategories() {
                $('#setAdditionCategoriesModal .form-check-input').prop('checked', false);
                $(`#setAdditionCategoriesModal .list-group-item[category_id="${this.app_category_id}"]`).addClass('hide');

                console.debug(this.app_category_id, this.app_addition_categories);

                if (this.app_addition_categories) {
                    const categoriesId = JSON.parse(this.app_addition_categories);
                    categoriesId.forEach(element => {
                        const domElement = $(`#setAdditionCategoriesModal .list-group-item[category_id="${element}"] input`);
                        console.debug(element, domElement);
                        domElement.prop('checked', true);
                    });
                }

                this.modal.show();
            },
        },
    }
</script>