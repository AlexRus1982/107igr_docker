<template>
    <div 
        class="screen-shots-wrapper"
        @drop="onDropp($event)"
        @dragover.prevent
        @dragenter.prevent
    >
        <div 
            class="screen-shot"
            v-if ="showGallery"
            v-for="(imgSrc, index) in arrayGallery" :key="index"
            :order="index"
            draggable="true"
            @dragstart="onDragStart($event, index)"
            @dragend="onDragEnd($event, index)"
            @dragover="onDragOver($event, index)"
            @dragleave="onDragLeave($event, index)"
        >
            <img :src="'https://files.107igr.ru' + imgSrc" :original="imgSrc" @error="errorScreenShot">

            <div class="edit-button" title="Редактировать скриншот" @click="editScreenShot(index)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </div>

            <div class="delete-button" title="Удалить скриншот" @click="deleteScreenShot(index)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </div>
        </div>
        <div v-if="!showGallery">
            Нет скриншотов
        </div>
    </div>
    <div class="screen-shots-add-button-wrapper">
        <div class="screen-shots-add-button" @click="addScreenShot" title="Добавить скриншот">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
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

    .screen-shots-wrapper {
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

        &::-webkit-scrollbar {
            width: 5px;                 /* ширина scrollbar */
            height: 5px;
        }
        &::-webkit-scrollbar-track {
            background: #0000;        /* цвет дорожки */
        }
        &::-webkit-scrollbar-thumb {
            border-radius: 0px;         /* закругления плашки */
            border: 3px solid #E84F;  /* padding вокруг плашки */
        }

        .screen-shot {
            cursor: grab;
            height: 150px;
            width: fit-content;
            transition: 0.1s;
            position: relative;

            img {
                height: 100%;
                width: fit-content;
                object-fit: contain;
            }

            &.drag-over {
                border-left: 5px solid #E84;
            }

            &.dragging {
                // filter: grayscale(1.0);
                opacity: 0;
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
    }

    .screen-shots-add-button-wrapper {
        width: 100%;
        display: flex;
        overflow: hidden;

        .screen-shots-add-button {
            margin-left: auto;
            margin-right: 5px;
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                transform: rotate(180deg);
            }
        }
    }

</style>

<script lang="ts">
    
    import $ from 'jquery'

    export default {
        name: "ScreenShots",

        props: {
            gallery : String, 
        },

        computed: {
            showGallery: function() {
                if(!this.gallery) return;
                // const galleryList = this.gallery.split(';');
                const galleryList = JSON.parse(this.gallery);
                return galleryList.length > 0;
            },

            arrayGallery: function() {
                if(!this.gallery) return;
                // const galleryList = this.gallery.split(';');
                const galleryList = JSON.parse(this.gallery);
                
                galleryList.forEach((element, index) => {
                    if (element == '') {
                        galleryList[index] = '/images/no-photo.svg';
                    }
                });
                return galleryList;
            }
        },

        components: {
        },

        emits: [
            'orderChanged',
        ],

        setup(props, context) {
            // const ResourcesLocation = window.GlobalVars.ResourcesLocation;

            let dragItem:any        = null;
            let dragItemNext:any    = null;
            let dragItemOver:any    = null;

            function onDragStart(event, item) {
                $('.screen-shot').removeClass('drag-over');
                $(`.screen-shot[order="${item}"]`).addClass('dragging');
                dragItem = item;
                dragItemNext = $(`.screen-shot[order="${item}"]`).next()?.attr('order');
                
                event.dataTransfer.dropEffect = 'move';
                event.dataTransfer.effectAllowed = 'move';
            }

            function onDragEnd(event, item) {

                $('.screen-shot').removeClass('drag-over');
                $('.screen-shot').removeClass('dragging');

                dragItem        = null;
                dragItemNext    = null;
                dragItemOver    = null;
            }

            function onDragOver(event, item) {

                $('.screen-shot').removeClass('drag-over');
                if (item != dragItem && item != dragItemNext) {
                    $(`.screen-shot[order="${item}"]`).addClass('drag-over');
                    dragItemOver = item;
                }
            }

            function onDragLeave(event, item) {
                $('.screen-shot').removeClass('drag-over');

                dragItemOver = null;
            }

            function onDropp(event) {
                $('.screen-shot').removeClass('drag-over');
                $('.screen-shot').removeClass('dragging');

                if (dragItemOver == null) return;
                if (dragItem == null) return;

                // const galleryList = props?.gallery?.split(';');
                const galleryList = JSON.parse(<string>props?.gallery);
                const newGalleryList = <string[]>[];

                galleryList?.forEach((element, index) => {
                    if (index == dragItemOver) {
                        newGalleryList.push(galleryList[dragItem]);
                        newGalleryList.push(galleryList[dragItemOver]);
                    } else if (index == dragItem) {
                    } else {
                        newGalleryList.push(galleryList[index]);
                    }
                })

                // context.emit('orderChanged', newGalleryList.join(';'));
                context.emit('orderChanged', JSON.stringify(newGalleryList));
            }

            return {
                // ResourcesLocation,

                onDragStart,
                onDragEnd,
                onDragOver,
                onDragLeave,
                onDropp,

            }
        },

        mounted() {
            if (!window.imageUploader) return;
            window.imageUploader.modalElemet.addEventListener('hide.bs.modal', event => {
                if (window.imageUploader.changed && window.imageUploader.imageType == 'screenShot') {
                    // const galleryList = this.$props?.gallery?.split(';');
                    const galleryList = JSON.parse(this.$props?.gallery);
                    const newGalleryList = <string[]>[];

                    galleryList?.forEach((element, index) => {
                        if (index != window.imageUploader.imageIndex) {
                            newGalleryList.push(galleryList[index]);
                        } else {
                            newGalleryList.push(window.imageUploader.newPath);
                        }
                    })

                    // this.$emit('orderChanged', newGalleryList.join(';'));
                    this.$emit('orderChanged', JSON.stringify(newGalleryList));
                }

                if (window.imageUploader.changed && window.imageUploader.imageType == 'screenShotAdd') {
                    // const galleryList = this.$props?.gallery?.split(';');
                    const galleryList = JSON.parse(this.$props?.gallery);
                    const newGalleryList = <string[]>[];

                    galleryList?.forEach((element, index) => {
                        newGalleryList.push(galleryList[index]);
                    })
                    newGalleryList.push(window.imageUploader.newPath);

                    // this.$emit('orderChanged', newGalleryList.join(';'));
                    this.$emit('orderChanged', JSON.stringify(newGalleryList));
                }
            });
        },

        methods : {
            errorScreenShot(event) {
                event.target.src = '/images/photo-error.svg';
                event.target.style = 'padding: 10px;';
            },

            deleteScreenShot(screenShotIndex) {
                if (!confirm('Удалить скриншот')) return;

                // const galleryList = this.$props?.gallery?.split(';');
                const galleryList = JSON.parse(this.$props?.gallery);
                const newGalleryList = <string[]>[];

                galleryList?.forEach((element, index) => {
                    if (index != screenShotIndex) {
                        newGalleryList.push(galleryList[index]);
                    }
                })

                // this.$emit('orderChanged', newGalleryList.join(';'));
                this.$emit('orderChanged', JSON.stringify(newGalleryList));
            },

            editScreenShot(screenShotIndex) {
                if (!window.imageUploader) return;
                window.imageUploader.oldPath = this.imagePath;
                window.imageUploader.newPath = '';
                window.imageUploader.imageType = 'screenShot';
                window.imageUploader.imageIndex = screenShotIndex;
                window.imageUploader?.modal?.show();
            },

            addScreenShot() {
                if (!window.imageUploader) return;
                window.imageUploader.oldPath = this.imagePath;
                window.imageUploader.newPath = '';
                window.imageUploader.imageType = 'screenShotAdd';
                window.imageUploader.imageIndex = 0;
                window.imageUploader?.modal?.show();
            },
        },
    }
</script>