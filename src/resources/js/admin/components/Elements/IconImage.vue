<template>
    <div 
        class="icon-image-wrapper"
    >
        <img :src="iconPath" @error="errorImage" ref="iconImage">

        <div class="edit-button" title="Редактировать иконку" @click="editIcon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
        </div>

        <div class="delete-button" title="Удалить иконку" @click="clearIcon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
            </svg>
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

    .icon-image-wrapper {
        @include no-select();
        height: 100%;
        width: fit-content;
        transition: 0.1s;
        position: relative;

        img {
            height: 100%;
            aspect-ratio: 1 / 1;
            width: fit-content;
            object-fit: contain;
            background: #FFF;
            border-radius: 10px;
            box-shadow: 1px 1px 8px #0004;
        }

        .edit-button,
        .delete-button {
            position: absolute;
            top: 0px;
            filter: drop-shadow(0px 0px 2px #FFF);
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                filter: drop-shadow(0px 0px 2px #FFF0);
                transform: scale(1.2);
            }
        }

        .edit-button {
            right: 25px;
            color: green;
        }

        .delete-button {
            right: 5px;
            color: red;
        }
    }
</style>

<script lang="ts">
    declare global {
        interface Window {
            imageUploader:any;
            GlobalVars:any;
        }
    }

    export default {
        name: "IconImage",

        props: {
            imagePath : String, 
        },

        computed: {
            iconPath : function () {
                if (this.imagePath == undefined || this.imagePath == '') {
                    if (this.$refs.iconImage) this.$refs.iconImage.style = 'padding: 10px;';
                    return "/images/no-photo.svg";
                } else {
                    if (this.$refs.iconImage) this.$refs.iconImage.style = 'padding: 0px;';
                    return this.imagePath;
                }
            }
        },

        emits: [
            'imageChanged',
        ],

        mounted() {
            if (!window.imageUploader) return;
            window.imageUploader.modalElemet.addEventListener('hide.bs.modal', event => {
                console.debug('closed');
                if (window.imageUploader.changed && window.imageUploader.imageType == 'icon') {
                    this.$emit('imageChanged', window.imageUploader.newPath);
                }
            });
        },

        methods : {
            errorImage(event) {
                event.target.src = '/images/photo-error.svg';
                event.target.style = 'padding: 10px;';
            },

            clearIcon() {
                if (!confirm('Удалить икноку')) return;
                this.$emit('imageChanged', null);
            },

            editIcon() {
                if (!window.imageUploader) return;
                window.imageUploader.oldPath = this.imagePath;
                window.imageUploader.newPath = '';
                window.imageUploader.imageType = 'icon';
                window.imageUploader?.modal?.show();
            },
        },
    }
</script>