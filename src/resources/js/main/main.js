import jQuery                   from 'jquery';
window.$                        = jQuery;

// import * as bootstrap           from 'bootstrap'
// window.bootstrap                = bootstrap;

import                          '../libs/bootstrap';

import { EventsSystem }         from '../libs/events_system.js';
import { ActionsSystem }        from '../libs/actions_system.js';
import { Actions }              from './libs/actions.js';
import { HorisontalScroller }   from './libs/horisontal-scroller.js'
import { DownloadCounter }      from './libs/download-counter.js'

window.eventsSystem             = new EventsSystem();
window.actionsSystem            = new ActionsSystem();
window.actions                  = new Actions();
window.horisontalScroller       = new HorisontalScroller();

const _screenShotModal          = document.getElementById('screenShotModal');
if (_screenShotModal) {
    window._screenShotModal     = new bootstrap.Modal(_screenShotModal);
}

if (document.getElementsByClassName('download-start-counter').length) {
    window.downloadCounter      = new DownloadCounter();
}


$on('comments-writer-inputs-text-changed', (element) => {
    const text_length = $(element).val().length;
    if (text_length) {
        $(element).parent().addClass('expand');
    } else {
        $(element).parent().removeClass('expand');
    }
});

$on('comments-writer-inputs-text-clear', () => {
    $('.app-comments-wrapper .comments-writer-wrapper .comments-writer-inputs').removeClass('expand');
    $('.app-comments-wrapper .comments-writer-wrapper .comments-writer-inputs textarea').val('');
    $('.app-comments-wrapper .comments-writer-wrapper .comments-writer-inputs input').val('');
});

$on('comments-liked', ([commentId]) => {
    console.debug('comment liked', commentId);
});

$on('comments-disliked', ([commentId]) => {
    console.debug('comment disliked', commentId);
});

const _commentSendModal          = document.getElementById('commentSendModal');
if (_commentSendModal) {
    window._commentSendModal     = new bootstrap.Modal(_commentSendModal);
}

$on('comments-send-answer', ([parentAnswerId]) => {
    const appId = $('#commentSendModal').attr('app-id');
    $('#commentSendModal').attr('comment-parent-id', parentAnswerId);
    console.debug('send answer', parentAnswerId, appId);

    window._commentSendModal.show();
});

$on('comments-send-main', ([appId]) => {
    const commentMessage = $('.app-comments .comments-writer-inputs .comment-input').val();
    const commentAuthor = $('.app-comments .comments-writer-inputs .comment-author').val();
    const commentMail = $('.app-comments .comments-writer-inputs .comment-mail').val();
    console.debug('send main', [ appId, commentMessage, commentAuthor, commentMail ]);
});

$on('comments-send-form', () => {
    const appId = $('#commentSendModal').attr('app-id');
    const parentAnswerId = $('#commentSendModal').attr('comment-parent-id');
    const commentMessage = $('#commentSendModal .comment-input').val();
    const commentAuthor = $('#commentSendModal .comment-author').val();
    const commentMail = $('#commentSendModal .comment-mail').val();

    console.debug('send form answer', [ parentAnswerId, appId, commentMessage, commentAuthor, commentMail]);

    window._commentSendModal.hide();
});

// $on('edit-if-admin-clicked', ([appId]) => {
//     const appUrl = `/admin-panel/apps/edit?id=${appId}`;
//     window.open(appUrl, '_blank');
// });

$on('header-sercher-click', () => {
    $('.searcher-header-container').toggleClass('active');
    $('.searcher-header-container input').val('');
});

$on('search-button-click', (element) => {
    const search_value = $(element).parent().find('input').first().val();
    window.location.href = `/search?searchParam=${search_value}`;
    // console.debug(`find - ${search_value}`);
});

$on('search_desc_input', (element) => {
    const button = $(element).parent().find('.search_desc_button').first();

    if ($(element).val().length >= 3) {
        button.removeClass('hide');
    } else {
        button.addClass('hide');
    }
});

$on('search_mobile_input', (element) => {
    const button = $(element).parent().find('.search_mobile_button').first();

    if ($(element).val().length >= 3) {
        button.removeClass('hide');
    } else {
        button.addClass('hide');
    }
});