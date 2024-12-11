<template>
    <!-- Модалка сортировки -->
    <div class="text-center">
        <v-dialog v-model="isShow" max-width="450" :persistent="true" scrollable>
            <v-card rounded="xs">
                <v-card-title class="py-5 px-2 d-flex" color="blue-lighten-1">
                    <div>{{ sortDialogInfo.title }}</div>
                    <v-btn icon="mdi-close" size="small" color="grey-lighten-5" variant="flat" rounded="xs"
                        class="ms-auto pa-1" @click="onCancelSort"></v-btn>
                </v-card-title>

                <v-divider class="mt-0"></v-divider>

                <v-card-text class="pa-0">
                    <v-list lines="one">
                        <v-list-item v-for="(item, index) in sortDialogInfo.sortList"
                            :active="index == sortDialogInfo.selected" :key="index" :title="item.name" :value="index"
                            color="blue-lighten-1" @click="sortDialogInfo.selected = index" />
                    </v-list>
                </v-card-text>

                <v-divider class="mb-0"></v-divider>

                <v-card-actions class="py-4">
                    <v-spacer></v-spacer>

                    <v-btn text="Закрыть" color="blue-lighten-1" variant="outlined" rounded="xs"
                        @click="onCancelSort"></v-btn>

                    <v-btn color="blue-lighten-1" text="Применить" variant="elevated" rounded="xs"
                        @click="onApplySort"></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<style lang="scss">
</style>

<script lang="ts">
    import { ref, watch } from 'vue'

    export default {
        name: "AppsPageSortModal",
        
        props: { 
            isShownObject : Object,
        },

        emits: [
            'sortChanged',
        ],

        computed: {
            isShow : function() {
                return this.$props.isShownObject.isShown ? true : false
            }
        },

        // watch: {
        //     '$props': {
        //         handler: function (val, oldVal) {
        //             console.log('watch', val)
        //         },
        //         deep: true
        //     }
        // },

        setup(props) {
            const sortDialogInfo = ref({
                title           : '',
                selectedBefore  : 0,
                selected        : 0,
                sortList        : [
                    { name      : 'Без сортировки',     param : '' },
                    { name      : 'Алфавиту',           param : 'name,asc' },
                    { name      : 'Самые скачиваемые',  param : 'downloads,desc' },
                    { name      : 'Мало скачиваемые',   param : 'downloads,asc' },
                    { name      : 'Самые посещаемые',   param : 'visited,desc' },
                    { name      : 'Мало посещаемые',    param : 'visited,asc' },
                ],
            })

            const url = new URL(`${window.location}`);
            const sortParam = url.searchParams.get('sort')
            console.debug(url, sortParam)
            sortDialogInfo.value.sortList.forEach((item, index) => {
                if (item.param == sortParam) {
                    console.debug(`param index = ${index}`)
                    sortDialogInfo.value.selectedBefore = index
                    sortDialogInfo.value.selected = index
                }
            });

            const selectedName = sortDialogInfo.value.sortList[sortDialogInfo.value.selected].name
            sortDialogInfo.value.title = `Сортировка по: ${selectedName}`

            return {
                sortDialogInfo,
            }
        },

        methods: {
            onApplySort() {
                this.$props.isShownObject.isShown = false
                
                const selectedObject = this.sortDialogInfo.sortList[this.sortDialogInfo.selected]
                this.sortDialogInfo.title = `Сортировка по: ${selectedObject.name}`
                this.sortDialogInfo.selectedBefore = this.sortDialogInfo.selected
                
                const url = new URL(`${window.location}`);
                url.searchParams.delete('page');
                url.searchParams.delete('sort');
                if (selectedObject.param) {
                    url.searchParams.set('sort', `${selectedObject.param}`);
                }
                window.history.pushState({}, '', url);
                this.$emit('sortChanged');
            },

            onCancelSort() {
                this.$props.isShownObject.isShown = false
                this.sortDialogInfo.selected = this.sortDialogInfo.selectedBefore
                console.debug('cancel sort')
            },
        },
    }
</script>