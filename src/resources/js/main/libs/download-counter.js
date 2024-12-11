export class DownloadCounter {
    counter         = 10;
    counterInterval = null;

    constructor() {
        this.counterInterval = setInterval(() => {
            this.MakeCounter();
        }, 1000);
    }


    MakeCounter() {
        $('.download-start-counter').prop('innerHTML', this.counter);
        this.counter--;
        if (this.counter < 0) {
            clearInterval(this.counterInterval);
            this.StartDownloading();
        }
    }

    StartDownloading() {
        console.debug('StartDownloading')
        $('.download-title-wrapper').addClass('start');
        console.debug($('.download-link a').attr('href'))

        // /*
        let a = document.createElement('a');
        a.href = $('.download-link a').attr('href');
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        // */
    }

}