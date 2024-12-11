<template>
    <!-- Item -->
    <v-container 
        class="questions_and_answers_item p-3 pe-0 pt-5"
        :item_index="qaObject.index"
        style="border: 1px solid #0004; border-radius: 4px; position: relative; " 
        draggable="true"
    >

        <v-row class="align-center" draggable="false">
            <v-col class="pb-0">
                <v-sheet variant="solo" class="title mb-2" style="color: #FF8A80;">Вопрос:</v-sheet>
                <v-textarea 
                    variant="solo"
                    class="text-input"
                    density="compact"
                    rows="1"
                    auto-grow
                    :model-value="questionText" 
                    @update:modelValue="questionTextUpdated"
                ></v-textarea>
            </v-col>
            <v-col cols="1" class="m-0 p-0">
                <v-btn 
                    class="rounded ms-1"
                    color="#2196F3"
                    icon="mdi-delete-forever" 
                    style="width: 40px; height: 40px; margin-top: 15px;"
                    @click="clearQuestionText"
                ></v-btn>
            </v-col>
        </v-row>

        <v-row class="align-center" draggable="false">
            <v-col class="py-0">
                <v-sheet variant="solo" class="title mb-2" style="color: #8AFF80;">Ответ:</v-sheet>
                <v-textarea 
                    variant="solo"
                    class="text-input"
                    density="compact"
                    rows="1"
                    auto-grow
                    :model-value="answerText" 
                    @update:modelValue="answerTextUpdated"
                ></v-textarea>
            </v-col>
            <v-col cols="1" class="m-0 p-0">
                <v-btn 
                    class="rounded ms-1"
                    color="#2196F3"
                    icon="mdi-delete-forever" 
                    style="width: 40px; height: 40px; margin-top: 5px;"
                    @click="clearAnswerText"
                ></v-btn>
            </v-col>
        </v-row>

        <v-btn 
            class="rounded rounded-circle"
            color="#E53935"
            icon="mdi-close" 
            style="width: 24px; height: 24px; position: absolute; top: 5px; right: 5px;"
            @click="deleteItem"
        ></v-btn>
    </v-container>
</template>

<style lang="scss">
    .questions_and_answers_item {
        transition: 0.3s;

        &.move_up {
            border-top: 5px solid #29F7 !important;
        }

        &.move_down {
            border-bottom: 5px solid #29F7 !important;
        }
    }
</style>

<script lang="ts">
    import { ref } from 'vue'

    export default {
        name: "QuestionsAndAnswersItem",

        props: {
            order       : Number,
            qaObject    : Object, 
        },

        emits: [
            'questionChanged',
            'answerChanged',
            'deleteItem',
        ],

        computed: {
            questionText : function () {
                return this.$props.qaObject.question;
            },

            answerText : function () {
                return this.$props.qaObject.answer;
            },
        },

        // setup() {
        //     const deleteDialog = ref(false)

        //     return {
        //         deleteDialog,
        //     }
        // },

        methods : {
            deleteItem() {
                this.$emit('deleteItem', this.$props.order);
            },

            clearQuestionText() {
                // this.questionText = ''
                this.$props.qaObject.question = ''
            },

            questionTextUpdated(text) {
                // this.questionText = text
                // console.debug(this.questionText)
                this.$props.qaObject.question = text
            },
            
            clearAnswerText() {
                // this.answerText = ''
                this.$props.qaObject.answer = ''
            },

            answerTextUpdated(text) {
                // this.answerText = text
                // console.debug(this.answerText)
                this.$props.qaObject.answer = text
            },
        },
    }
</script>