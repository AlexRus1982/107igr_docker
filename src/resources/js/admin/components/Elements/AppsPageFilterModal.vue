<template>
    <!-- Модалка фильтрации -->
    <div class="text-center">
        <v-dialog v-model="isShow" max-width="450" :persistent="true" scrollable>
            <v-card rounded="xs">
                <v-card-title class="py-5 px-2 d-flex" color="blue-lighten-1">
                    <div>{{ filterDialogInfo.title }}</div>
                    <v-btn icon="mdi-close" size="small" color="grey-lighten-5" variant="flat" rounded="xs"
                        class="ms-auto pa-1" @click="onCancelFilter"></v-btn>
                </v-card-title>

                <v-divider class="my-0"></v-divider>

                <v-card-text class="filter-card pa-0">
                    <v-list lines="one">
                        <v-list-item v-for="(item, index) in filterDialogInfo.filterList"
                            :active="index == filterDialogInfo.selected" :key="index" :title="item.name" :value="index"
                            color="blue-lighten-1" @click="filterDialogInfo.selected = index" />
                    </v-list>
                </v-card-text>

                <v-divider class="my-0"></v-divider>

                <v-card-actions class="py-4">
                    <v-spacer></v-spacer>

                    <v-btn text="Закрыть" color="blue-lighten-1" variant="outlined" rounded="xs"
                        @click="onCancelFilter"></v-btn>

                    <v-btn color="blue-lighten-1" text="Применить" variant="elevated" rounded="xs"
                        @click="onApplyFilter"></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<style lang="scss">
    .filter-card {
        &::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
    
        &::-webkit-scrollbar-track {
            background: #0000;
        }
    
        &::-webkit-scrollbar-thumb {
            border-radius: 5px;
            border: 3px solid #29FF;
        }
    }
</style>

<script lang="ts">
    import { ref, watch } from 'vue'

    export default {
        name: "AppsPageFilterModal",
        
        props: { 
            isShownObject : Object,
        },

        emits: [
            'filterChanged',
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
            const filterDialogInfo = ref({
                title           : '',
                selectedBefore  : 0,
                selected        : 0,
                filterList      : <any>[],
            })

            const categoriesList = ref(<any>[]);
            fetch('../api/categories/simple')
            .then(response => response.json())
            .then(
                ({
                    'server-answer' : server_answer, 
                    'list' : list
                }) => {
                    filterDialogInfo.value.filterList.push({name : 'Все', param : ''})
                    
                    filterDialogInfo.value.filterList.push({name : 'Игры', param : 'games'})
                    list.forEach(item => {
                        if (item.main_url == 'games'){
                            filterDialogInfo.value.filterList.push({name : `${item.category}`, param : `${item.id}`})
                        }
                    });

                    filterDialogInfo.value.filterList.push({name : 'Приложения', param : 'apps'})
                    list.forEach(item => {
                        if (item.main_url == 'apps'){
                            filterDialogInfo.value.filterList.push({name : `${item.category}`, param : `${item.id}`})
                        }
                    });

                    console.debug(filterDialogInfo.value.filterList)

                    const url = new URL(`${window.location}`);
                    const filterParam = url.searchParams.get('filter')
                    filterDialogInfo.value.filterList.forEach((item, index) => {
                        if (item.param == filterParam) {
                            console.debug(`param index = ${index}`)
                            filterDialogInfo.value.selectedBefore = index
                            filterDialogInfo.value.selected = index
                        }
                    });

                    const selectedName = filterDialogInfo.value.filterList[filterDialogInfo.value.selected].name
                    filterDialogInfo.value.title = `Фильтрация по: ${selectedName}`
                }
            )

            return {
                filterDialogInfo,
            }
        },

        methods: {
            onApplyFilter() {
                this.$props.isShownObject.isShown = false

                const selectedObject = this.filterDialogInfo.filterList[this.filterDialogInfo.selected]
                this.filterDialogInfo.title = `Фильтрация по: ${selectedObject.name}`
                this.filterDialogInfo.selectedBefore = this.filterDialogInfo.selected
                
                const url = new URL(`${window.location}`);
                url.searchParams.delete('page');
                url.searchParams.delete('filter');
                if (selectedObject.param) {
                    url.searchParams.set('filter', `${selectedObject.param}`);
                }
                window.history.pushState({}, '', url);
                this.$emit('filterChanged');
            },

            onCancelFilter() {
                this.$props.isShownObject.isShown = false
                this.filterDialogInfo.selected = this.filterDialogInfo.selectedBefore
            },
        },
    }
</script>