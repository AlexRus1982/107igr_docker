<template>

    <!-- madal -->
    <div 
        class="modal fade"
        id="setLinksModal" 
        ref="setLinksModal"
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1" 
        aria-labelledby="gameInstructionsLabel" 
        aria-hidden="true" 
        style="background: #FFFFFF00; backdrop-filter: blur(8px) grayscale(1.0);">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content shadow rounded-0">

                <div class="modal-header text-black rounded-0">
                    <h5 class="modal-title">Выберете связь(и)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-2">

                    <ul class="list-group w-100 rounded-0" style="gap: 5px;">
                        <li 
                            v-for="[key, tag] in tags" :key="tag.id"
                            class="list-group-item border"
                            :tag_id="tag.id"
                        >
                            <input class="form-check-input me-1" type="checkbox" value="" :tag_id="tag.id" :id="'input_' + tag.id" :tag_name="tag.tag_name">
                            <label class="form-check-label stretched-link" :for="'input_' + tag.id">{{ tag.tag_name }}</label>
                        </li>
                    </ul>

                </div>

                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-warning rounded-0" @click="addLinks">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="links-editor-label" style="font-size: 1.5rem;">Связано с</div>
    <div class="app-links-wrapper">
        <div 
            class="app-link w-100 d-flex flex-row"
            v-if="appLinks && appLinks.size > 0"
            v-for="[key, tag] in appLinks"
            :key = "tag.tag_id"
            :tag_id="tag.tag_id"
        >
            <div class="tag-label ms-2">{{ tag.tag_name }}</div>
            <div class="tag-icon tag-delete-button ms-auto me-2" @click="deleteLink(tag.tag_id)" title="Удалить">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                </svg>
            </div>
        </div>
        <div v-if="!appLinks || appLinks?.size == 0">
            Нет связей
        </div>
    </div>

    <div class="app-links-add-button-wrapper">
        <div class="app-links-add-button" @click="addAppLink" title="Добавить скриншот">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
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

    #setLinksModal {
        @include no-select();

        .modal-dialog {
            max-width: 300px;

            .modal-content {
                max-height: 480px;

                .modal-body {
                    color: #000;
                    height: 100vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: flex-start;
                    
                    .list-group-item {

                        &:hover {
                            cursor: pointer !important;
                            background-color: #FC0;
                        }

                        &.hide {
                            display: none;
                        }
                    }
                }
            }
        }
    }

    .app-links-wrapper {
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

        .tag-delete-button {
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                transform: scale(1.5);
                color: #F44;
            }
        }
    }

    .app-links-add-button-wrapper {
        width: 100%;
        display: flex;
        overflow: hidden;

        .app-links-add-button {
            margin-left: auto;
            margin-right: 5px;
            transition: 0.3s;

            &:hover {
                cursor: pointer;
                transform: translate(0px, 2px) rotate(180deg);
            }
        }
    }

</style>

<script lang="ts">
    declare global {
        interface Window {
            bootstrap       :any;
        }
    }

    import $ from 'jquery'
    import { ref, watch } from 'vue'

    export default {
        name: "AppLinks",

        props: {
            app_id : Number, 
        },

        setup(props) {

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

                        tags.value = new Map(_tags.map(tag => [tag.id, tag]));
                        appLinks.value = new Map(_appLinks.map(appLink => [appLink.tag_id, appLink]));
    
                        console.debug(tags.value);
                        console.debug(appLinks.value);
                    }
                )
            });

            return {
                tags,
                appLinks,
            }
        },

        mounted() {
            this.modal = new window.bootstrap.Modal(this.$refs.setLinksModal);

            this.$refs.setLinksModal.addEventListener('show.bs.modal', event => {

                $('#setLinksModal .list-group-item').removeClass('hide');

                for(let [key, value] of this.appLinks) {
                    console.debug(value);
                    $(`#setLinksModal .list-group-item[tag_id="${value.tag_id}"]`).addClass('hide');
                }

                $('#setLinksModal .form-check-input').prop('checked', false);
            })
        },

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
        },
    }
</script>