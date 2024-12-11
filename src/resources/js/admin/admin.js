import $                       from 'jquery';
// window.$                        = jQuery;

import * as bootstrap           from 'bootstrap'
window.bootstrap                = bootstrap;

import                          '../libs/bootstrap';

import { EventsSystem }         from '../libs/events_system.js';
import { ActionsSystem }        from '../libs/actions_system.js';
import { Actions }              from './libs/actions.js';

window.eventsSystem             = new EventsSystem();
window.actionsSystem            = new ActionsSystem();
window.actions                  = new Actions();


Array.prototype.remove = function(index) {
    this.splice(index, 1);
}

String.prototype.translit = function (){
	var converter = {
		'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
		'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
		'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
		'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
		'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
		'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
		'э': 'e',    'ю': 'yu',   'я': 'ya'
	};
    let word = this;
 
	word = word.toLowerCase();
  
	var answer = '';
	for (var i = 0; i < word.length; ++i ) {
		if (converter[word[i]] == undefined){
			answer += word[i];
		} else {
			answer += converter[word[i]];
		}
	}
 
	answer = answer.replace(/[^-0-9a-z]/g, '-');
	answer = answer.replace(/[-]+/g, '-');
	answer = answer.replace(/^\-|-$/g, ''); 
	return answer;
}

import MainAdmin                from './components/MainAdmin2.vue';

import { GlobalVars }           from './globals';
window.GlobalVars               = new GlobalVars();

import { GlobalList}            from './globalList';

import { createApp }            from 'vue/dist/vue.esm-bundler';
import { reactive }             from 'vue';

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import { md1 } from 'vuetify/blueprints'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'

const vuetify = createVuetify({
    components,
    directives,
    blueprint: md1,
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
    icons: {
        defaultSet: 'mdi', // This is already the default value - only for display purposes
    },
})

import { 
    createWebHistory, 
    createRouter,
}                               from "vue-router";

const routes = [
    {
        path            : "/admin-panel/",
        name            : "Приложения",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/AppsPage3.vue'),
    },

    {
        path            : "/admin-panel/apps/edit",
        name            : "Редактирование приложения",
        meta            : {
            mainPage    : false,
        },
        component       : () => import('./components/Pages/AppsEditPage2.vue'),
    },

    {
        path            : "/admin-panel/apps/edit2",
        name            : "Редактирование приложения 2",
        meta            : {
            mainPage    : false,
        },
        component       : () => import('./components/Pages/AppsEditPage2.vue'),
    },

    {
        path            : "/admin-panel/categories",
        name            : "Категории",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/CategoryPage.vue'),
    },

    {
        path            : "/admin-panel/category/edit",
        name            : "Редактирование категории",
        meta            : {
            mainPage    : false,
        },
        component       : () => import('./components/Pages/CategoryEditPage.vue'),
    },

    {
        path            : "/admin-panel/pages",
        name            : "Страницы",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/PagesPage.vue'),
    },

    {
        path            : "/admin-panel/page/edit",
        name            : "Редактирование страницы",
        meta            : {
            mainPage    : false,
        },
        component       : () => import('./components/Pages/PageEditPage.vue'),
    },

    {
        path            : "/admin-panel/blogs",
        name            : "Блог",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/BlogsPage.vue'),
    },

    {
        path            : "/admin-panel/tags",
        name            : "Тэги",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/TagsPage.vue'),
    },

    {
        path            : "/admin-panel/comments",
        name            : "Комментарии",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/CommentsPage.vue'),
    },

    {
        path            : "/admin-panel/gigachat",
        name            : "ГигаЧат",
        meta            : {
            mainPage    : true,
        },
        component       : () => import('./components/Pages/GigaChatPage.vue'),
    },

    {
        path        : '/:pathMatch(.*)*',
        component   : () => import('./components/Pages/Page404.vue'),
    },
];
  
const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp({
    components: {
        'main-admin' : MainAdmin,
    },
});

// app.config.globalProperties.globalVariables = reactive(new GlobalVars());
// app.config.globalProperties.globalList      = reactive(new GlobalList());
// window._globalList = app.config.globalProperties.globalList;

app.use(router);
app.use(vuetify);
app.mount('#app');
