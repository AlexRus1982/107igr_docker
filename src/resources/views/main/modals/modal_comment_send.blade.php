<div 
    class="modal fade" 
    id="commentSendModal" 
    app-id="{{ $app->id }}"
    comment-parent-id="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="commentSendModalLabel" 
    aria-hidden="true" 
    style="background: #FFFFFF00; backdrop-filter: blur(8px) grayscale(1.0);">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 p-2" style="transform: rotateZ(0deg);">
            <div class="modal-header text-black rounded-top-3 py-2 border-bottom" style="position: relative;">
                <div class="modal-image">
                    <img src="/uploads/icon_5dcfcea708196_11.png">
                </div>
                <div class="modal-title fs-4 fw-bold d-flex w-100 justify-content-start" id="commentSendModalLabel" style="text-align: center;">
                    Ответить
                </div>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; left: calc(100% - 38px); top: 16px;"></button>
            </div>

            <div class="modal-body p-2 py-3 d-flex flex-column">
                <textarea type="text" class="comment-input" placeholder="Сообщение"></textarea>
                <input type="text" class="comment-author" placeholder="Имя">
                <input type="email" class="comment-mail" placeholder="Емейл">
            </div>

            <div class="modal-footer p-2 d-flex flex-column">
                <div 
                    class="comment-button-send ms-auto"
                    onclick="$emit('comments-send-form')"
                >
                    Отправить
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #commentSendModal.show {
        z-index: 1000000;
    }

    #commentSendModal .modal-dialog {
        max-width: 800px;
    }

    #commentSendModal .modal-content {
        max-height: 80vh;
        height: fit-content;
    }

    .modal-backdrop {
        background-color: #0007;
    }


    #commentSendModal .modal-image img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 10px;
    }

    #commentSendModal .modal-body {
        gap: 10px;
    }

    #commentSendModal .modal-body textarea {
        overflow-y: hidden;
        width: 100%;
        height: 40px;
        border-radius: 5px;
        padding: 10px;
        min-height: 40px;
        max-height: 200px;
        border: 1px solid #E6E7E8;
        outline: none;
    }

    #commentSendModal .modal-body input {
        border-radius: 5px;
        height: 40px;
        padding: 10px;
        outline: none;
        border: 1px solid #E6E7E8;
    }

    #commentSendModal .modal-body .comment-mail:invalid {
        border: 1px solid #F007;
    }

    #commentSendModal .modal-footer .comment-button-send {
        position: relative;
        color: #FFF;
        background-color: #59F;
        border-radius: 5px;
        padding: 5px;
        transition: 0.3s;
        width: fit-content;
        box-shadow: 0px 0px 4px #0007;
    }

    #commentSendModal .modal-footer .comment-button-send::after {
        content: '';
        position: absolute;
        transition: 0.3s;
        width: 100%;
        height: 75%;
        z-index: 1;
        top: 0px;
        left: 0px;
        background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0));
        opacity: 0;
    }

    #commentSendModal .modal-footer .comment-button-send:hover {
        cursor: pointer;
        box-shadow: 0px 0px 4px #0000;
        transform: scale(0.95);
    }

    #commentSendModal .modal-footer .comment-button-send:hover::after {
        opacity: 1.0;
    }

</style>