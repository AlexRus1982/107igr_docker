<template>

    <!-- Модалка -->
    <v-dialog v-model="linksDialog" width="400" scrollable>

        <v-card>
            <v-card-title class="py-3 px-3" style="color: #2196F3;">Выберете связь(и)</v-card-title>

            <v-divider class="m-0"></v-divider>

            <v-card-text class="px-2" style="height: 300px;">
                <v-container class="p-0 m-0">
                    <v-row v-for="[key, item] in Array.from(tags)" class="p-1 m-0">
                        <v-col class="p-0" cols="10" style="margin-right: 16px;">
                            <v-sheet :elevation="2" :height="32" border rounded class="d-flex align-center px-3">{{ item.tag_name }}</v-sheet>
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
                <v-btn variant="outlined" color="#2196F3" text="Закрыть" rounded="xs" @click="linksDialog = false"></v-btn>
                <v-spacer></v-spacer>
                <v-btn color="#2196F3" text="Сохранить" variant="flat" rounded="xs" @click="saveTags"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-container class="px-5 py-0 pe-1">
        <v-row>
            <v-col>
                <v-sheet variant="solo" class="title my-0 mb-2">Связано с</v-sheet>
                <v-sheet variant="solo" class="info d-flex align-center px-4">{{ tagsString }}</v-sheet>
            </v-col>
            <v-col cols="1" class="px-0">
                <v-btn class="rounded" color="#2196F3" icon="mdi-lead-pencil" @click="showLinksModal" style="margin-left: 7px; margin-top: 28px; width: 40px; height: 40px;"></v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<style lang="scss">
    .v-sheet-links {
        overflow-y: auto;
    }
</style>

<script lang="ts">

    import { ref, watch } from 'vue'

    export default {
        name: "AppLinks",

        props: {
            app_id : Number, 
        },

        computed : {
            tagsString(){
                let tagsString = ''
                console.debug(this.tags)
                this.tags.forEach(([key, tag]) => {
                    if (tag.checked) {
                        tagsString += tagsString == '' ? tag.tag_name : ', ' + tag.tag_name
                    }
                });
                return tagsString == '' ? '' : tagsString
            },

        },

        setup(props) {

            const linksDialog = ref(false)

            const tags = ref(<any>[]);
            const modalLinks = ref(<any>[]);
            const appLinks = ref(<any>[]);

            watch(() => [props.app_id, ], (newValues, oldValues) => {
                console.debug('get tags');
                fetch(`/../api/apps/tags`, {
                    method      : 'POST',
                    headers     : {
                        'Accept'        : 'application/json',
                        'Content-Type'  : 'application/json'
                    },
                    body        : JSON.stringify({
                        'app_id'        : newValues,
                    })
                })
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'tags'          : _tags,
                        'appLinks'      : _appLinks,
                    }) => {
                        console.debug(_tags, _appLinks);

                        const tagsMap = new Map();
                        _tags.forEach(element => {
                            tagsMap.set(`${element.id}`, element);
                        });

                        tagsMap.forEach((value, key) => {
                            value.checked = false;
                            value['newChecked'] = false;
                        });

                        tags.value = Array.from(tagsMap);

                        appLinks.value = new Map(_appLinks.map(appLink => [appLink.tag_id, appLink]));
    
                        console.debug(tags.value);
                        console.debug(appLinks.value);

                        
                        
                        // if (props.app_addition_categories) {
                        //     const categoriesId = JSON.parse(props.app_addition_categories);
                        //     const categoriesStrings = new Array();
                        //     categoriesId.forEach(categoryId => {
                        //         const category = categoriesMap.get(`${categoryId}`);
                        //         categoriesStrings.push(category.category);
                        //     });
                        //     addition_categories_string.value = categoriesStrings.join(', ');
                        // } else {
                        //     addition_categories_string.value = 'пусто';
                        // }
                    }
                )
            });

            return {
                linksDialog,
                tags,
                appLinks,
            }
        },

        // mounted() {
        //     this.modal = new window.bootstrap.Modal(this.$refs.setLinksModal);

        //     this.$refs.setLinksModal.addEventListener('show.bs.modal', event => {

        //         $('#setLinksModal .list-group-item').removeClass('hide');

        //         for(let [key, value] of this.appLinks) {
        //             console.debug(value);
        //             $(`#setLinksModal .list-group-item[tag_id="${value.tag_id}"]`).addClass('hide');
        //         }

        //         $('#setLinksModal .form-check-input').prop('checked', false);
        //     })
        // },

        methods : {

            deleteLink(linkId) {
                this.appLinks.delete(linkId)
            },

            addLinks() {
                const checkedLinks = $('#setLinksModal .form-check-input:checked');
                checkedLinks.each((index, element) => {
                    const tag_id = $(element).attr('tag_id');
                    const tag_name = $(element).attr('tag_name');
                    this.appLinks.set(tag_id, {
                        'tag_id'    : tag_id,
                        'app_id'    : this.$props.app_id,
                        'blog_id'   : null,
                        'id'        : tag_id,
                        'tag_name'  : tag_name,
                    });
                })

                this.modal.hide();
            },

            addAppLink() {
                this.modal.show();
            },

            showLinksModal() {
                this.tags.forEach(([key, element]) => {
                    element.newChecked = element.checked
                });

                this.linksDialog = true
            },

            saveTags() {
                this.tags.forEach(([key, element]) => {
                    element.checked = element.newChecked
                });

                // const categoriesId = new Array();
                // this.categories.forEach(([key, element]) => {
                //     if (element.checked) {
                //         categoriesId.push(element.id)
                //     }
                // });

                // if (categoriesId.length) {
                //     this.$emit('additionCategoriesChanged', JSON.stringify(categoriesId));
                // } else {
                //     this.$emit('additionCategoriesChanged', null);
                // }

                this.linksDialog = false
            },
        },
    }
</script>