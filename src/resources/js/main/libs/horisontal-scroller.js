export class HorisontalScroller {
    
    mouseDown       = false;
    startScroll     = false;
    startScrollPos  = 0;
    startScrollLeft = 0;
    startScrollTime = 0;
    scrollInterval  = null;
    scrollDelta     = 0;
    scrollAxel      = 1.0;

    constructor() {
        setInterval(this.horisontalChecker, 1000);
        this.addEventListeners();
    }

    horisontalChecker() {
        $('.horisontal-scroller-container').each((index, element) => {

            const _lastElement = $(element).find('.horisontal-scroller-element').last();
            const _img = $(element).parent().find('.horisontal-scroller-title-wrapper img').first();
    
            const _lastElementRight = _lastElement.offset().left + _lastElement.width();
    
            const _width = $(element).width() + $(element).offset().left + 24;
    
            _img.css('display', (_lastElementRight >= _width) ? 'block' : 'none');
    
            // console.debug({_width, _lastElementRight});
        })
    }

    addEventListeners() {
        
        this._horisontalScrollerElementClick = () => {
            window.event.preventDefault();
        }
        $on('horisontal-scroller-element-click', this._horisontalScrollerElementClick);

        this._horisontalScrollerElementUp = (element) => {
            if (this.startScroll) {
                window.event.preventDefault();
            }
            else {
                const _href = $(element).attr('href');
                if (_href) {
                    window.location = _href;
                    return;
                }

                const _img = $(element).find('img');
                const _src = _img.attr('src');
                if (_src) {
                    $('#screenShotModal img').attr('src', _src);
                    $('#screenShotModal .modal-title').prop('innerHTML', _img.attr('alt'));
                    window._screenShotModal.show();
                    // console.debug(_img.attr('title'));
                }
            }
        }
        $on('horisontal-scroller-element-up', this._horisontalScrollerElementUp);

        // #region scroll functions -----------------------------------
        this._horisontalScrollerMouseDown = (element) => {
            this.mouseDown = true;
            this.startScroll = false;
            this.startScrollPos = window.event.clientX;
            this.startScrollLeft = $(element).scrollLeft();
            this.startScrollTime = performance.now();
            clearInterval(this.scrollInterval);
        }
        $on('horisontal-scroller-mouse-down', this._horisontalScrollerMouseDown);

        this._horisontalScrollerMouseUp = (element) => {
            this.mouseDown = false;
            this.startScroll = false;
            
            const timeDelta = performance.now() - this.startScrollTime;
            const scrollDelta = Math.abs(this.scrollDelta);
            this.scrollAxel = Number(scrollDelta / timeDelta);
            this.scrollAxel = this.scrollAxel < 1.0 ? 1.0 : this.scrollAxel;
            this.scrollAxel = this.scrollAxel > 3.0 ? 3.0 : this.scrollAxel;

            this.scrollInterval = setInterval(() => {
                const scrollLeft = $(element).scrollLeft();
                this.scrollDelta = this.scrollDelta * 0.3 * this.scrollAxel;
                $(element).scrollLeft(scrollLeft - this.scrollDelta);
                if (Math.abs(this.scrollDelta) < 1.0) {
                    clearInterval(this.scrollInterval);
                }
            }, 20);
        }
        $on('horisontal-scroller-mouse-up', this._horisontalScrollerMouseUp);

        this._horisontalScrollerMouseOver = (element) => {
            if (!this.mouseDown) return;
            this.scrollDelta = window.event.clientX - this.startScrollPos;
            const _scrollLeft = this.startScrollLeft - this.scrollDelta;
            
            this.startScroll = (this.scrollDelta != 0) ? true : false;

            if (this.startScroll) {
                $(element).scrollLeft(_scrollLeft);
            }
        }
        $on('horisontal-scroller-mouse-over', this._horisontalScrollerMouseOver);

        this._horisontalScrollerMouseOut = () => {
            this.startScroll = false;
        }
        $on('horisontal-scroller-mouse-out', this._horisontalScrollerMouseOut);
        // #endregion scroll functions ---------------------------------


    }

    clearEventListeners() {
        $off('horisontal-scroller-element-click', this._horisontalScrollerElementClick);
        $off('horisontal-scroller-element-up', this._horisontalScrollerElementUp);
        $off('horisontal-scroller-mouse-down', this._horisontalScrollerMouseDown);
        $off('horisontal-scroller-mouse-up', this._horisontalScrollerMouseUp);
        $off('horisontal-scroller-mouse-over', this._horisontalScrollerMouseOver);
        $off('horisontal-scroller-mouse-out', this._horisontalScrollerMouseOut);
    }
}