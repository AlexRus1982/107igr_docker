<template>
    <div class="background-wrapper bg-white dark:bg-black transition-bg">
        <div class="background-animated">
            <div class="jumbo">
            </div>
        </div>

        <div class="main-panel">
            <div class="main-panel-layuot">
                <div class="main-panel-menu-title">
                    Администрирование
                </div>
                <div class="main-panel-menu">
                    <router-link class="router-link p-2 w-100" v-for="element in user_routes" :to="element.path">{{ element.name }}</router-link>
                </div>
                <div class="main-panel-title">
                    {{ route.currentRoute.value.name }}
                </div>
                <div class="main-panel-body">
                    <router-view />
                </div>
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .main-wrapper {
        display: flex;
        flex-direction: row;
        width: 100vw;
        min-height: 100vh;
        background: #EEE;
    }
    .page-wrapper {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .main-panel {
        box-shadow: 0px 0px 16px #000A;
        border: 1px solid #FFF2;
        position: absolute;
        inset: 20px;
        margin-left: auto;
        margin-right: auto;
        max-width: 1200px;
        background: #0007;
        backdrop-filter: blur(0px);
        color: #FFF;
        z-index: 10000;

        .main-panel-layuot {
            position: relative;
            width: 100%;
            height: 100%;

            .main-panel-menu-title {
                position: absolute;
                left: 0px;
                top: 0px;
                height: 50px;
                width: 200px;
                background: #0007;
                display: flex;
                align-items: center;
                justify-content: center;
                @include no-select();
            }

            .main-panel-menu {
                position: absolute;
                left: 0px;
                top: 51px;
                bottom: 0px;
                width: 200px;
                background: #0007;
                display: flex;
                flex-direction: column;
                overflow-x: hidden;
                overflow-y: auto;

                &::-webkit-scrollbar {
                    width: 5px;               /* ширина scrollbar */
                    height: 5px;
                }
                &::-webkit-scrollbar-track {
                    background: #0000;        /* цвет дорожки */
                }
                &::-webkit-scrollbar-thumb {
                    border-radius: 0px;       /* закругления плашки */
                    border: 3px solid #E84F;  /* padding вокруг плашки */
                }

                .router-link {
                    position: relative;
                    color: #FFF4;
                    text-decoration: none;
                    transition: 0.3s;
                    border: 1px solid #FFF2;
                    z-index: 1;
                    // border-right: 5px solid #E840;
                    @include no-select();

                    &::before {
                        content: "";
                        position: absolute;
                        transition: 0.3s;
                        top: 0px;
                        right: 0px;
                        height: 100%;
                        width: 0%;
                        background: #E84;
                        z-index: -1;
                    }
                    
                    &:hover {
                        color: #FFF;
                    }
                }

                .router-link-active {
                    color: #FFFF;
                    // border-right: 5px solid #E84F;
                    &.router-link {

                        &::before {
                            width: 100%;
                        }
                    }
                }

            }

            .main-panel-title {
                position: absolute;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: row;
                left: 201px;
                top: 0px;
                right: 0px;
                height: 50px;
                background: #0007;
                @include no-select();
            }

            .main-panel-body {
                position: absolute;
                left: 201px;
                top: 51px;
                right: 0px;
                bottom:0px;
                background: #0004;
                overflow: auto;

                &::-webkit-scrollbar {
                    width: 5px;               /* ширина scrollbar */
                    height: 5px;
                }
                &::-webkit-scrollbar-track {
                    background: #0000;        /* цвет дорожки */
                }
                &::-webkit-scrollbar-thumb {
                    border-radius: 0px;       /* закругления плашки */
                    border: 3px solid #E84F;  /* padding вокруг плашки */
                }
            }
        }
    }

    .background-wrapper {
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100vh;
        align-items: center;
        justify-content: center;
        background: #FFF;
    }

    .background-animated {
        position: absolute;
        overflow: hidden;
        inset: 0px;
    }

    @keyframes jumbo {
        from {
            background-position: 50% 50%, 50% 50%;
        }
        to {
            background-position: 350% 50%, 350% 50%;
        }
    }

    .jumbo {
        position: absolute;
        left: 0px;
        top: 0px;
        bottom: 0px;
        right: 0px;
        opacity: 0.5;

        --stripes: repeating-linear-gradient(
            100deg,
            #fff 0%,
            #fff 7%,
            transparent 10%,
            transparent 12%,
            #fff 16%
        );
        --stripesDark: repeating-linear-gradient(
            100deg,
            #000 0%,
            #000 7%,
            transparent 10%,
            transparent 12%,
            #000 16%
        );
        --rainbow: repeating-linear-gradient(
            100deg,
            #60a5fa 10%,
            #e879f9 15%,
            #60a5fa 20%,
            #5eead4 25%,
            #60a5fa 30%
        );
        background-image: var(--stripes), var(--rainbow);
        background-size: 300%, 200%;
        background-position: 50% 50%, 50% 50%;

        filter: blur(10px) invert(100%);

        mask-image: radial-gradient(ellipse at 100% 0%, black 40%, transparent 70%);

        pointer-events: none;
    }

    .jumbo::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: var(--stripes), var(--rainbow);
        background-size: 200%, 100%;
        animation: jumbo 60s linear infinite;
        background-attachment: fixed;
        mix-blend-mode: difference;
    }

</style>

<script lang="ts">
    import { useRouter } from 'vue-router'

    export default {
        name: "MainAdmin",

        components: {
        },

        setup() {
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

            return {
                route,
                user_routes,
            }
        },
    }
</script>