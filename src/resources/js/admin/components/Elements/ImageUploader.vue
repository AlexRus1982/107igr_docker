<template>
    <!-- madal -->
    <div 
        class="modal fade"
        id="editIconModal" 
        ref="editIconModal"
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1" 
        aria-labelledby="gameInstructionsLabel" 
        aria-hidden="true" 
        style="background: #FFFFFF00; backdrop-filter: blur(8px) grayscale(1.0);">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow rounded-0">
                <div class="modal-header bg-dark bg-gradient text-white rounded-0 py-2">
                    <h1 class="modal-title fw-bold" id="gameInstructionsLabel" style="font-size: min(4vw, 20px);">Загрузить картинку</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2" @drop.prevent="onDropImage($event)">
                    <img class="mt-auto" :src="imagePath" @error="errorImage" ref="iconImageDialog">
                    <div class="mt-auto p-2 w-100 d-flex flex-column">
                        <input class="form-control w-100 rounded-0" ref="fileInput" type="file" accept="image/*" @input="pickFile">
                        <div class="mt-3 d-flex justify-content-center upload-button p-2 bg-primary text-white rounded-0" @click="onDownloadClick">Применить</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    #editIconModal {

        .modal-dialog {
            max-width: 640px;

            .modal-content {
                max-height: 480px;

                .modal-body {
                    color: #000;
                    height: 100vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;

                    img {
                        height: 250px;
                        padding: 10px;
                        aspect-ratio: 1 / 1;
                        width: fit-content;
                        object-fit: contain;
                        background: #FFF;
                        box-shadow: 0px 0px 16px #0003;
                    }

                    .upload-button {
                        cursor: pointer;
                        -ms-user-select: none;
                        -moz-user-select: none;
                        -khtml-user-select: none;
                        -webkit-user-select: none;
                        user-select: none;
                        transition: 0.3s;

                        &:hover {
                            background-color: #28F !important;
                        }
                    }
                }
            }
        }
    }
</style>

<script lang="ts">
    declare global {
        interface Window {
            imageUploader   :any;
            bootstrap       :any;
        }
    }
    
    export default {
        name: "ImageUploader",

        computed: {
            imagePath : function () {
                if (window.imageUploader?.oldPath == undefined || window.imageUploader?.oldPath == '') {
                    if (this.$refs.iconImage) this.$refs.iconImage.style = 'padding: 10px;';
                    return "/images/no-photo.svg";
                } else {
                    if (this.$refs.iconImage) this.$refs.iconImage.style = 'padding: 0px;';
                    return window.imageUploader?.oldPath;
                }
            }
        },

        mounted() {
            window.imageUploader = {
                modal       : new window.bootstrap.Modal(this.$refs.editIconModal),
                modalElemet : this.$refs.editIconModal,
                changed     : false,
                oldPath     : '',
                newPath     : '',
                imageType   : '',
                imageIndex  : -1,
            }

            this.$refs.editIconModal.addEventListener('show.bs.modal', event => {
                this.$refs.fileInput.value = '';
                window.imageUploader.changed = false;

                if (window.imageUploader.oldPath == undefined || window.imageUploader.oldPath == '') {
                    if (this.$refs.iconImageDialog) {
                        this.$refs.iconImageDialog.style = 'padding: 10px;';
                        this.$refs.iconImageDialog.src = "/images/no-photo.svg";
                    }
                } else {
                    if (this.$refs.iconImageDialog) {
                        this.$refs.iconImageDialog.style = 'padding: 0px;';
                        this.$refs.iconImageDialog.src = window.imageUploader.oldPath;
                    }
                }
            })
        },

        methods : {
            errorImage(event) {
                // event.target.src = '/images/photo-error.svg';
                event.target.style = 'padding: 10px;';
            },

            pickFile() {
                let input = this.$refs.fileInput;
                let file = input.files;
                if (file && file[0]) {
                    let reader = new FileReader
                    
                    reader.onload = e => {
                        this.$refs.iconImageDialog.src = e?.target?.result
                    }

                    reader.readAsDataURL(file[0]);
                }
            },

            onDownloadClick() {
                fetch(`/../api/upload/image`, {
                    method  : 'POST',
                    headers : {
                        'Accept'        : 'application/json',
                        'Content-Type'  : 'application/json'
                    },
                    body    : JSON.stringify({
                        'base64_data'   : this.$refs.iconImageDialog.src,
                    })
                })
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'imagePath'     : imagePath,
                    }) => {
                        console.debug(imagePath);
                        window.imageUploader.changed = true;
                        window.imageUploader.newPath = imagePath;
                        window.imageUploader.modal.hide();
                    }
                )
                .catch(error => console.error("request failed", error));
            },

            onDropImage(event) {
                console.debug(event);
            },
        },
    }
</script>