<div 
    class="modal fade" 
    id="screenShotModal" 
    {{-- data-bs-backdrop="static"  --}}
    data-bs-keyboard="false" 
    tabindex="-1" 
    aria-labelledby="screenShotModalLabel" 
    aria-hidden="true" 
    style="background: #FFFFFF00; backdrop-filter: blur(8px) grayscale(1.0);">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 p-2" style="transform: rotateZ(0deg);">
            <div class="modal-header bg-white bg-gradient text-black rounded-top-3 py-2 border-0" style="position: relative;">
                <div class="modal-title fs-3 fw-bold d-flex w-100 justify-content-center" id="screenShotModalLabel" style="text-align: center;">
                    Заголовок
                </div>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; left: calc(100% - 38px); top: 16px;"></button>
            </div>

            <div class="modal-body py-4 d-flex flex-column">
                <img src="#">
            </div>

        </div>
    </div>
</div>
<style>
    #screenShotModal.show {
        z-index: 1000000;
    }

    #screenShotModal .modal-dialog {
        max-width: 80vw;
    }

    #screenShotModal .modal-content {
        max-height: 80vh;
        height: fit-content;
    }

    .modal-backdrop {
        background-color: #0007;
    }

    .modal-body .label {
        width: 25px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .modal-body img {
        width: 100%;
        height: 100%;
        max-height: 60vh;
        object-fit: contain
    }
</style>