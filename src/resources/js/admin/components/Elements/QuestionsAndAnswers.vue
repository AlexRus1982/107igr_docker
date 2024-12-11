<template>
    <!-- Модалка удаления-->
    <v-dialog v-model="deleteDialog" width="300" scrollable draggable="false">
        <v-card>
            <v-card-title class="py-3 px-3 mb-5" color="#FF5252">Удалить элемент?</v-card-title>

            <v-card-actions class="py-3 px-3">
                <v-btn variant="outlined" color="#2962FF" text="Закрыть" rounded="xs" @click="deleteDialog = false"></v-btn>
                <v-spacer></v-spacer>
                <v-btn color="#FF5252" text="Удалить" variant="flat" rounded="xs" @click="deleteItemConfirm"></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Вопросы и ответы -->
    <v-card id="qwAndAnswAnchor" elevation="4" rounded="lg" class="p-3">
        <v-card-title class="m-0 mb-3 p-0">Вопросы и ответы</v-card-title>
        <v-card-text class="m-0 p-0"
        @drop="onDropp($event)"
        @dragover.prevent
        @dragenter.prevent
        >
            <!-- preloader -->
            <v-progress-circular v-if="isLoading == true" color="blue" indeterminate :size="32" :width="4"></v-progress-circular>

            <v-container v-if="isLoading == false" class="p-0 mb-3 ga-3 d-flex flex-column">
                <QuestionsAndAnswersItem 
                    v-for="(item, index) in questionsAndAnswersFiltered"
                    :qaObject="item"
                    @deleteItem="removeItem"
                    
                    :order="item.index"
                    @dragstart="onDragStart($event, item.index, item)"
                    @dragend="onDragEnd($event, item.index, item)"
                    @dragover="onDragOver($event, item.index, item)"
                    @dragleave="onDragLeave($event, item.index, item)"
                />
            </v-container>

            <v-container v-if="isLoading == false" class="p-0">
                <!-- Add button -->
                <v-row>
                    <v-col class="mt-3 pt-0 d-flex">
                        <v-btn 
                            class="add-new-item-button rounded" color="#2196F3" icon="mdi-plus" 
                            style="margin-left: auto; width: 40px; height: 40px;"
                            @click="addNew"
                        ></v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-card-text>
    </v-card>
</template>

<style lang="scss">
    .add-new-item-button {
        transition: 0.3s;
        .v-icon {
            transition: 0.3s;
        }

        &:hover {
            .v-icon {
                transform: rotateZ(180deg);
            }
        }
    }
</style>

<script lang="ts">

    import $                        from 'jquery'
    import { ref }                  from 'vue'
    import QuestionsAndAnswersItem  from './QuestionsAndAnswersItem.vue'

    export default {
        name: "QuestionsAndAnswers",

        components: {
            QuestionsAndAnswersItem,
        },

        props: {
            loading             : Boolean,
            questionsAndAnswers : Object,
        },

        computed: {
            questionsAndAnswersFiltered : function () {
                const filteredArray = [];
                let index = 0;
                this.$props.questionsAndAnswers.forEach(element => {
                    if (!element.deleted) {
                        element['index'] = index
                        filteredArray.push(element)
                    }
                    index++
                });

                filteredArray.sort((a,b) => Number(a.order) - Number(b.order));

                return filteredArray;
            },

            isLoading : function() {
                return (this.$props.loading) ? true : this.$props.loading
            },

        },

        setup() {
            const deleteDialog = ref(false)
            let deletedConfirmIndex = null

            let dragItem:any        = null
            let dragItemOver:any    = null

            return {
                deleteDialog,
                deletedConfirmIndex,

                dragItem,
                dragItemOver,
            }
        },

        methods : {
            addNew() {
                console.debug('add new item', this.appId)
                const length = this.$props.questionsAndAnswers.length
                this.$props.questionsAndAnswers.push({ id : null, question : '', answer: '', order : length, deleted : false})
                console.debug(this.questionsAndAnswers)
            },

            removeItem(itemIndex) {
                this.deletedConfirmIndex = itemIndex
                this.deleteDialog = true
            },

            deleteItemConfirm() {
                this.deleteDialog = false
                this.$props.questionsAndAnswers[this.deletedConfirmIndex].deleted = true
            },

            // drag and drop
            onDragStart(event, index, item) {
                // console.debug('onDragStart', index)
                this.dragItem = item
                
                event.dataTransfer.dropEffect = 'move';
                event.dataTransfer.effectAllowed = 'move';
            },

            onDragEnd(event, index, item) {
                // console.debug('onDragEnd', index)
                this.dragItem = null;
                this.dragItemOver = null

                $(`.questions_and_answers_item`).removeClass('move_up')
                $(`.questions_and_answers_item`).removeClass('move_down')
            },

            onDragOver(event, index, item) {
                if (this.dragItem != item){
                    this.dragItemOver = item
                    $(`.questions_and_answers_item[item_index="${index}"]`).addClass('move_up')
                }
            },

            onDragLeave(event, index, item) {
                this.dragItemOver = null
                $(`.questions_and_answers_item[item_index="${index}"]`).removeClass('move_up')
                $(`.questions_and_answers_item[item_index="${index}"]`).removeClass('move_down')

            },

            onDropp(event) {
                if (this.dragItemOver == null) return
                if (this.dragItem == null) return

                this.dragItem.order = Number(this.dragItemOver.order) - 0.5

                let index = 0
                this.$props.questionsAndAnswers.forEach(element => {
                    element['sortIndex'] = index++
                });

                const sortedArray = 
                this.$props.questionsAndAnswers
                .filter(item => item.deleted == false)
                .sort((a,b) => Number(a.order) - Number(b.order))
               
                index = 0
                sortedArray.forEach(element => {
                    element.order = index++
                });

                console.debug(this.$props.questionsAndAnswers)

                $(`.questions_and_answers_item`).removeClass('move_up')
                $(`.questions_and_answers_item`).removeClass('move_down')
            },
        },
    }
</script>