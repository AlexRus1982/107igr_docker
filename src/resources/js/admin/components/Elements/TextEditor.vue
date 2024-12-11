<template>
    <textarea class="mytextarea" id="mytextarea" ref="textarea">{{ setText }}</textarea>
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

    // .tox.tox-tinymce {
    //     // height: 800px !important;
    //     border-radius: 0px;
    // }

    // .tox.tox-tinymce-aux {
    //     z-index: 100000;
    // }

    // .tox .tox-notifications-container {
    //     display: none !important;
    //     top: -10000px !important;
    // }

</style>

<script lang="ts">
    declare global {
        interface Window {
            tinymce:any;
        }
    }

    export default {
        name: "TextEditor",

        props: {
            text : String, 
        },

        computed: {
            setText: function() {
                if (!this.text) return '';

                this.$refs.textarea.value = this.text;

                window.tinymce.init({
                    // 'api-key': 'naagvvgcz8eh0ahdvwilhulkyuro78iobvsnj4pxbkjzrpcx',
                    selector: 'textarea.mytextarea',
                    plugins: 'autoresize anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount code insertdatetime pagebreak preview',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat | preview',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    language: 'ru',
                    mergetags_list: [
                    { value: 'First.Name', title: 'First Name' },
                    { value: 'Email', title: 'Email' },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                    setup: (editor) => {
                        editor.on('Paste Change input Undo Redo', () => {
                            clearTimeout(this.editorChangeHandlerId);
                            this.editorChangeHandlerId = setTimeout(() => {
                                console.log('changed');
                                this.$emit('textChanged', window.tinymce?.get("mytextarea")?.getContent());
                            }, 100);
                        });
                    }
                })

                window.tinymce?.get("mytextarea")?.setContent(this.text);

                return this.text;
            }
        },

        components: {
        },

        emits: [
            'textChanged',
        ],

        setup() {

            return {
            }
        },

        mounted() {
            // window.tinymce.get("mytextarea").setContent(app.description);
            // var myContent = tinymce.get("myTextarea").getContent();
            // window.tinymce.init({
            //     selector: 'textarea',
            //     plugins: 'ai tinycomments autoresize mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste autocorrect a11ychecker typography inlinecss code insertdatetime pagebreak preview',
            //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat | preview',
            //     tinycomments_mode: 'embedded',
            //     tinycomments_author: 'Author name',
            //     language: 'ru',
            //     mergetags_list: [
            //     { value: 'First.Name', title: 'First Name' },
            //     { value: 'Email', title: 'Email' },
            //     ],
            //     ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            //     setup: (editor) => {
            //         editor.on('Paste Change input Undo Redo', () => {
            //             clearTimeout(this.editorChangeHandlerId);
            //             this.editorChangeHandlerId = setTimeout(() => {
            //                 console.log('changed');
            //                 this.$emit('textChanged', window.tinymce?.get("mytextarea")?.getContent());
            //             }, 100);
            //         });
            //     }
            // });
        }
    }
</script>