<template>
    <div 
        class="video-shots-wrapper"
        @drop="onDropp($event)"
        @dragover.prevent
        @dragenter.prevent
    >
        <div 
            class="video-shot"
            v-if ="showGallery"
            v-for="(videoSrc, index) in arrayGallery" :key="index"
            :order="index"
            @dragstart="onDragStart($event, index)"
            @dragend="onDragEnd($event, index)"
            @dragover="onDragOver($event, index)"
            @dragleave="onDragLeave($event, index)"
            draggable="true"
        >
            <iframe 
                class="video m-3"
                :src="videoSrc"
                frameborder="0"
                draggable="false"
                allowfullscreen
            >
            </iframe>

            <div class="edit-button" title="Редактировать видео">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
            </div>

            <div class="delete-button" title="Удалить видео">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </div>
        </div>
        <div v-if="!showGallery">
            Нет видео
        </div>
    </div>
    <div class="video-shots-add-button-wrapper">
        <div class="video-shots-add-button" title="Добавить видео">
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

    .video-shots-wrapper {
        @include no-select();
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        height: fit-content;
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

        .video-shot {
            cursor: grab;
            height: 180px;
            width: fit-content;
            transition: 0.1s;
            position: relative;

            &:hover {
                background: #E84;
            }

            img {
                height: 100%;
                width: fit-content;
                object-fit: contain;
            }

            &.drag-over {
                border-left: 5px solid #E84;
            }

            &.dragging {
                opacity: 0;
            }

            .edit-button,
            .delete-button {
                position: absolute;
                top: 15px;
                filter: drop-shadow(0px 0px 2px #FFF);
                transition: 0.3s;

                &:hover {
                    cursor: pointer;
                    filter: drop-shadow(0px 0px 2px #FFF0);
                    transform: scale(1.2);
                }
            }

            .edit-button {
                right: 35px;
                color: green;
            }

            .delete-button {
                right: 15px;
                color: red;
            }
        }
    }

    .video-shots-add-button-wrapper {
        width: 100%;
        display: flex;
        overflow: hidden;

        .video-shots-add-button {
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
        name: "VideoShots",

        props: {
            gallery : String, 
        },

        computed: {
            showGallery: function() {
                if(!this.gallery) return;
                const galleryList = this.gallery.split(';');
                return galleryList.length > 0;
            },

            arrayGallery: function() {
                if(!this.gallery) return;
                const galleryList = this.gallery.split(';');
                return galleryList;
            }
        },

        components: {
        },

        emits: [
            'orderChanged',
        ],

        setup(props, context) {

            let dragItem:any        = null;
            let dragItemNext:any    = null;
            let dragItemOver:any    = null;

            function onDragStart(event, item) {
                $('.video-shot').removeClass('drag-over');
                $(`.video-shot[order="${item}"]`).addClass('dragging');
                dragItem = item;
                dragItemNext = $(`.video-shot[order="${item}"]`).next()?.attr('order');
                
                event.dataTransfer.dropEffect = 'move';
                event.dataTransfer.effectAllowed = 'move';
            }

            function onDragEnd(event, item) {
                $('.video-shot').removeClass('drag-over');
                $('.video-shot').removeClass('dragging');

                dragItem        = null;
                dragItemNext    = null;
                dragItemOver    = null;
            }

            function onDragOver(event, item) {
                $('.video-shot').removeClass('drag-over');
                if (item != dragItem && item != dragItemNext) {
                    $(`.video-shot[order="${item}"]`).addClass('drag-over');
                    dragItemOver = item;
                }
            }

            function onDragLeave(event, item) {
                $('.video-shot').removeClass('drag-over');

                dragItemOver = null;
            }

            function onDropp(event) {
                $('.video-shot').removeClass('drag-over');
                $('.video-shot').removeClass('dragging');

                if (dragItemOver == null) return;
                if (dragItem == null) return;

                const galleryList = props?.gallery?.split(';');
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

                context.emit('orderChanged', newGalleryList.join(';'));
            }

            return {
                onDragStart,
                onDragEnd,
                onDragOver,
                onDragLeave,
                onDropp,

            }
        },
    }
</script>