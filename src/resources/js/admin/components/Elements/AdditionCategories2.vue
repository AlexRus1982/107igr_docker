<template>
    <!-- Модалка -->
    <v-dialog v-model="categoriesDialog" width="400" scrollable>

        <v-card>
            <v-card-title class="py-3 px-3" style="color: #2196F3;">Дополнительные категории</v-card-title>

            <v-divider class="m-0"></v-divider>

            <v-card-text class="px-2" style="height: 300px;">
                <v-container class="p-0 m-0">
                    <v-row v-for="[key, item] in categories" class="p-1 m-0">
                        <v-col class="p-0" cols="10" style="margin-right: 16px;">
                            <v-sheet :elevation="2" :height="32" border rounded class="d-flex align-center px-3">{{ item.category }}</v-sheet>
                        </v-col>
                        <v-col class="my-check-box p-0" cols="1">
                            <input class="ms-auto form-check-input" id="activityRedirect" type="checkbox" role="switch"
                            v-model="item.newChecked"
                            style="cursor: pointer; width: 32px; height: 32px; background-color: #2196F3; border-color: #2196F3; margin-top: 0px;">
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>

            <v-divider class="m-0"></v-divider>

            <v-card-actions class="py-3 px-3">
                <v-btn variant="outlined" color="#2196F3" text="Закрыть" rounded="xs" @click="categoriesDialog = false"></v-btn>
                <v-spacer></v-spacer>
                <v-btn color="#2196F3" text="Сохранить" variant="flat" rounded="xs" @click="saveCategories"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-container class="px-5 py-5 pe-1">
        <v-row>
            <v-col>
                <v-sheet variant="solo" class="title my-0 mb-2">Доп. категории</v-sheet>
                <v-sheet variant="solo" class="info d-flex align-center px-4">{{ addition_categories_string }}</v-sheet>
            </v-col>
            <v-col cols="1" class="px-0">
                <v-btn class="rounded" color="#2196F3" icon="mdi-lead-pencil" @click="showAdditionCategories" style="margin-left: 7px; margin-top: 28px; width: 40px; height: 40px;"></v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<style lang="scss">
    .v-sheet-category {
        overflow-y: auto;
    }
</style>

<script lang="ts">
    import { ref, watch } from 'vue'

    export default {
        name: "AdditionCategories",

        props: {
            app_category_id         : Number,
            app_addition_categories : String,
        },

        emits: [
            'additionCategoriesChanged',
        ],

        setup(props) {

            const categoriesDialog = ref(false)
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

                        categoriesMap.forEach((value, key) => {
                            value.checked = false;
                            value['newChecked'] = false;
                        });

                        categoriesMap.delete(`${props.app_category_id}`)

                        if (props.app_addition_categories) {
                            const categoriesId = JSON.parse(props.app_addition_categories);
                            categoriesId.forEach(categoryId => {
                                const category = categoriesMap.get(`${categoryId}`);
                                category.checked = true;
                            });
                        }

                        categories.value = Array.from(categoriesMap);
                        console.debug(Array.from(categoriesMap))

                        if (props.app_addition_categories) {
                            const categoriesId = JSON.parse(props.app_addition_categories);
                            const categoriesStrings = new Array();
                            categoriesId.forEach(categoryId => {
                                const category = categoriesMap.get(`${categoryId}`);
                                categoriesStrings.push(category.category);
                            });
                            addition_categories_string.value = categoriesStrings.join(', ');
                        } else {
                            addition_categories_string.value = '';
                        }
                    }
                )
            }

            makeCategories();

            watch(() => [props.app_addition_categories, ], (newValues, oldValues) => {
                makeCategories();
            });

            return {
                categoriesDialog,
                categories,
                addition_categories_string,
                categoriesMap,
            }
        },

        methods : {

            saveCategories() {
                this.categories.forEach(([key, element]) => {
                    element.checked = element.newChecked
                });

                const categoriesId = new Array();
                this.categories.forEach(([key, element]) => {
                    if (element.checked) {
                        categoriesId.push(element.id)
                    }
                });

                if (categoriesId.length) {
                    this.$emit('additionCategoriesChanged', JSON.stringify(categoriesId));
                } else {
                    this.$emit('additionCategoriesChanged', null);
                }

                this.categoriesDialog = false
            },

            showAdditionCategories() {
                this.categories.forEach(([key, element]) => {
                    element.newChecked = element.checked
                });

                this.categoriesDialog = true
            },
        },
    }
</script>