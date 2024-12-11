<template>
    <v-app :theme="theme">
        <v-navigation-drawer v-model="drawer" :location="$vuetify.display.mobile ? 'bottom' : undefined">
            <v-list-item title="Панель администратора" style="height: 49px;"></v-list-item>
            <v-divider style="margin-top: 0px;"></v-divider>
            <!-- <v-list :items="items"></v-list> -->
            <v-list-item 
                v-for="element in user_routes" 
                :href="element.path" 
                :title="element.name"
                :class="route.currentRoute.value.name == element.name ? 'current' : false"
            ></v-list-item>
        </v-navigation-drawer>

        <v-app-bar :elevation="0" class="main-bar">
            <v-btn v-if="!drawer" icon="mdi-menu" variant="text" @click="drawer = !drawer"></v-btn>
            <v-btn v-if="drawer" icon="mdi-close" variant="text" @click="drawer = !drawer"></v-btn>
            <v-app-bar-title>{{ route.currentRoute.value.name }}</v-app-bar-title>
        </v-app-bar>

        <v-main style="background-color: #F8F7FA;">
            <router-view />
        </v-main>
    </v-app>
</template>

<style lang="scss">
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .v-list-item.current {
        background-color: rgb(247, 247, 247);
    }

    .main-bar .v-toolbar__content {
        height: 50px !important;
        border-bottom: 1px solid #0002;
    }
</style>

<script lang="ts">
    import { useRouter } from 'vue-router'
    import {ref} from 'vue'

    export default {
        name: "MainAdmin",

        components: {
        },

        setup() {
            const theme = ref('light')
            const route = useRouter();
            // console.debug(route.getRoutes());
            const old_routes = useRouter().getRoutes();
            const user_routes = <any>{};

            for (const key in old_routes) {
                const element = old_routes[key];
                if (element.name != '' && element.name != undefined && element.meta.mainPage) {
                    user_routes[key] = element;
                }
            }

            //--------------------------------------
            // menu scroll test
            //--------------------------------------
            // let count = 0;
            // for (let i = 0; i < 100; i += 1) {
            //     for (const key in old_routes) {
            //         const element = old_routes[key];
            //         if (element.name != '' && element.name != undefined) {
            //             user_routes[count++] = element;
            //         }
            //     }
            // }

            const drawer = ref(false)
            const tab = ref(null)
            // const items = [
            //     { 
            //         type: 'subheader', 
            //         title: 'Group #1' },
            //     {
            //         title: 'Item #1',
            //         value: 1,
            //     },
            //     {
            //         title: 'Item #2',
            //         value: 2,
            //     },
            //     {
            //         title: 'Item #3',
            //         value: 3,
            //     },
            //     { 
            //         type: 'divider' 
            //     },
            //     { 
            //         type: 'subheader', title: 'Group #2' 
            //     },
            //     {
            //         title: 'Item #4',
            //         value: 4,
            //     },
            //     {
            //         title: 'Item #5',
            //         value: 5,
            //     },
            //     {
            //         title: 'Item #6',
            //         value: 6,
            //     },
            // ]

            return {
                theme,
                drawer,
                tab,
                // items,
                route,
                user_routes,
            }
        },
    }
</script>