export class Actions {

    constructor() {
        
        // makeGalleryImages Action
        $registerAction('makeGalleryImages', (args) => {
            const {item, image_resources} = args;
            console.debug(image_resources);
            
            let index = 0;
            for(const image of image_resources) {
                const image_markers = `${image.image_show_in_gallery}${image.image_show_in_sizes}${image.image_show_in_desc}`;
                
                const marker_show_in_gallery = image_markers[0] == 1 ? '' : ' unchecked';
                const marker_show_in_sizes   = image_markers[1] == 1 ? '' : ' unchecked';
                const marker_show_after_desc = image_markers[2] == 1 ? '' : ' unchecked';
                
                //const photoURL = `${window.web_path}${photo}`;
                const photoURL = `${BaseLocation}${ImagesResourcesPath}${image.resource_id}_eighth.webp`;
                const photo = photoURL;
                $('#accordionImages .gallery').append(`
                    <div class="img-thumbnail" draggable="true">
                        <img 
                            src="${photoURL}"
                            baseURL="${photo}"
                            image-markers="${image_markers}"
                            image-id="${image.image_id}"
                            class="shadow m-2"
                            onError="this.onerror=null;this.src='${window.ImageErrorPhotoPath}';"
                        />
                        <svg class="img-thumbnail-delete" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
        
                        <div class="markers marker-show-in-gallery${marker_show_in_gallery}" title="Показать в галерее">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                            </svg>
                        </div>
        
                        <div class="markers marker-show-in-sizes${marker_show_in_sizes}" title="Показать в размерах">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                            </svg>
                        </div>
        
                        <div class="markers marker-show-after-desc${marker_show_after_desc}" title="Показать под описанием">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                            </svg>
                        </div>
                    </div>
                `);
                index++;
            }
        });

        // makeGalleryPreviewImages Action
        $registerAction('makeGalleryPreviewImages', (args) => {
            const {files, uploadFiles, toAdd, existSrc} = args;
            
            let count = 0;
            Object.values(files).forEach(file => {

                const fileId = `${Date.now()}_${count}`;
                count++;
                uploadFiles.set(fileId, file);

                const fileReader = new FileReader();
                fileReader.onload = (event) => {
                    if (!existSrc.includes(event.target.result)){
                        const image = `
                            <div class="img-thumbnail" draggable="true">
                                <img 
                                    src="${event.target.result}"
                                    image-markers="100"
                                    image-id=""
                                    file-id="${fileId}"
                                    class="need-to-upload shadow m-2"
                                    onError="this.onerror=null;this.src='${window.ImageErrorPhotoPath}';"
                                />
                                <svg class="img-thumbnail-delete" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                </svg>

                                <div class="markers marker-show-in-gallery" title="Показать в галерее">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                    </svg>
                                </div>

                                <div class="markers marker-show-in-sizes unchecked" title="Показать в размерах">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                    </svg>
                                </div>

                                <div class="markers marker-show-after-desc unchecked" title="Показать под описанием">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path class="check-marker" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                    </svg>
                                </div>
                            </div>
                        `;
                        
                        toAdd.append(image);
                    }
                    else {
                        messages.Danger('Дубликат фото !!!');
                    }

                };
                fileReader.readAsDataURL(file);
            });
        });

        // uploadProductImages Action
        $registerAction('uploadProductImages', (args) => {
            const {uploadImagesPromisses, uploadFiles, itemArticul} = args;
            
            let imagesCount = 0;
            $('.gallery .img-thumbnail .need-to-upload').each((index, element) => {
                const fileId = $(element).attr('file-id');
                const file = uploadFiles.get(`${fileId}`);
                
                const imageData = new FormData();
                imageData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                imageData.append('product_image', file);
                imageData.append('item_articul', itemArticul);

                uploadImagesPromisses.push(new Promise((resolve, reject) => {
                    $.ajax({
                        url         : `${BaseLocation}/product/image/upload`,
                        type        : "POST",
                        contentType : false,
                        processData : false,
                        data        : imageData,
                        success: response => {
                            $(element).removeAttr('file-id');
                            $(element).attr('src', `${BaseLocation}${response.path}`);
                            $(element).attr('baseurl', `${BaseLocation}${response.path}`);
                            //console.debug(response);
                            resolve(response);
                        },
                        error: (e)=>reject(e),
                    });
                }));

                imagesCount++;
            });
            uploadFiles.clear();
            return imagesCount;
        });

        // makeScreenShot Action
        $registerAction('makeScreenShot', (args) => {
            //const {uploadImagesPromisses, uploadFiles, itemArticul} = args;

            if (!window.modals.screenShotModal) {
                window.modals.screenShotModal = new bootstrap.Modal('#screenShotModal');
            }

            console.time('StartScreenShot');
            html2canvas(document.body).then(function(canvas) {
                let my_screen = canvas;
                my_screen.crossOrigin = "anonymous";
    
                // Resize the canvas to the desired size
                var resizedCanvas = document.createElement('canvas');
                var resizedCtx = resizedCanvas.getContext('2d');
                resizedCanvas.width = $(window).width() * 0.5;// 640;
                resizedCanvas.height = $(window).height() * 0.5; //480;
                resizedCtx.drawImage(my_screen, 0, 0, resizedCanvas.width, resizedCanvas.height);
    
                const srcData = resizedCanvas.toDataURL("image/webp", 0.5);
                document.getElementById("screenShotImage").src = srcData;
                console.timeEnd('StartScreenShot');
                console.debug('length - ', srcData.length);

                window.modals.screenShotModal.show();
            });
        });

        // makeScreenShot Action
        $registerAction('makeScreenShotElement', (args) => {
            // const {element} = args;

            if (!window.modals.screenShotModal) {
                window.modals.screenShotModal = new bootstrap.Modal('#screenShotModal');
            }

            console.time('StartScreenShot');
            html2canvas($('#screenShotModal')).then(function(canvas) {
                let my_screen = canvas;
                my_screen.crossOrigin = "anonymous";
    
                // Resize the canvas to the desired size
                var resizedCanvas = document.createElement('canvas');
                var resizedCtx = resizedCanvas.getContext('2d');
                resizedCanvas.width = $(window).width() * 0.5;// 640;
                resizedCanvas.height = $(window).height() * 0.5; //480;
                resizedCtx.drawImage(my_screen, 0, 0, resizedCanvas.width, resizedCanvas.height);
    
                const srcData = resizedCanvas.toDataURL("image/webp", 0.5);
                document.getElementById("screenShotImage").src = srcData;
                console.timeEnd('StartScreenShot');
                console.debug('length - ', srcData.length);

                window.modals.screenShotModal.show();
            });
        });

    }
}
