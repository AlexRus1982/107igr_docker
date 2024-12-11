<template>
    <div v-if="columnItem.labelContent == 'icon'" :class="columnItem.labelClass" @click="editApp($event, appObject)"
        style="cursor: pointer;">
        <img :src="'https://files.107igr.ru' + appObject.icon">
    </div>

    <div v-else-if="columnItem.labelContent == 'name'" :class="columnItem.labelClass"
        @click="editApp($event, appObject)" style="cursor: pointer;">
        {{ appObject.name }}
    </div>

    <div v-else-if="columnItem.labelContent == 'category'" :class="columnItem.labelClass">
        {{ appObject.category }}
    </div>

    <div v-else-if="columnItem.labelContent == 'visited'" :class="columnItem.labelClass">
        {{ appObject.visited }}
    </div>

    <div v-else-if="columnItem.labelContent == 'go-to'" :class="columnItem.labelClass">
        <div class="go-to-link" title="Переход" @click.stop="linkApp($event, appObject)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-reply"
                viewBox="0 0 16 16">
                <path
                    d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
            </svg>
        </div>
    </div>

    <div v-else-if="columnItem.labelContent == 'redirect'" :class="columnItem.labelClass"
        :title="(appObject.redirect_url != '' && appObject.redirect_url) ? appObject.redirect_url : ''">
        <svg v-if="appObject.redirect_url != '' && appObject.redirect_url" xmlns="http://www.w3.org/2000/svg" width="16"
            height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
            <path v-if="appObject.redirect == 1"
                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
        </svg>
    </div>

    <div v-else-if="columnItem.labelContent == 'activity'" :class="columnItem.labelClass" class="switcher">
        <!-- <div class="form-check form-switch">
            <input class="form-check-input" :app-id="appObject.id" type="checkbox" role="switch"
                :checked="appObject.activity == 1 ? true : false" @input.stop="setActivity(appObject.id)" style="cursor: pointer;">
        </div> -->
        <v-switch
          :model-value="appObject.activity == 1 ? true : false"
          color="#2196F3"
          :loading="appObject.activity_loading"
          @update:modelValue="setActivity($event, appObject)"
        ></v-switch>
    </div>

    <div v-else-if="columnItem.labelContent == 'delete'" :class="columnItem.labelClass" title="Удалить"
        @click.stop="deleteApp($event, appObject)">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash3"
            viewBox="0 0 16 16" style="cursor: pointer;">
            <path
                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
        </svg>
    </div>

    <div v-else class="cw"></div>
</template>

<style lang="scss">
    .go-to-link {
        transition: 0.3s;
        margin-left: 10px;
        transform: scaleX(-1);
        &:hover {
            cursor: pointer;
            transform: scaleX(-1.5) scaleY(1.5);
            color: #06F;
            filter: drop-shadow(0px 0px 1px #FFF);
        }
    }

    .switcher .v-input__details {
        display: none !important;
    }
</style>

<script lang="ts">
    export default {
        name: "AppsPageTableLineCol",
        
        props: [ 
            'appObject',
            'columnItem',
        ],

        setup() {

            return {
            }
        },

        methods: {
            linkApp(event, app) {
                const appUrl = `../${app.main_url}/${app.url}`;
                window.open(appUrl, '_blank');
                // if (event.ctrlKey) {
                //     window.open(appUrl, '_blank');
                // } else {
                //     window.location.href = appUrl;
                // }
            },

            editApp(event, app) {
                const appUrl = `/admin-panel/apps/edit?id=${app.id}`;
                window.open(appUrl, '_blank');
                // if (event.ctrlKey) {
                //     window.open(appUrl, '_blank');
                // } else {
                //     window.location.href = appUrl;
                // }
            },

            deleteApp(event, app) {
                if (!confirm('Удалить приложение?')) return;
                fetch(`../api/apps/delete`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'app_id'        : app.id,
                    })
                })
                .then(() => {
                    //location.reload();
                    // $(event.target).closest('.item').remove();
                })
                .catch(error => console.log("request failed", error));
            },

            setActivity(event_value, app) {
                app.activity_loading = event_value ? 'primary' : 'grey-lighten-5'
                
                const resetActivity= () => {
                    app.activity = event_value ? 1 : 0;
                    app.activity_loading = false;
                }
                
                fetch(`../api/apps/activity`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'id'       : app.id,
                        'activity' : event_value ? '1' : '0',
                    })
                })
                .then(response => response.json())
                .then(
                    () => resetActivity()
                )
                .catch(error => console.log("request failed", error));
            }
        },
    }
</script>