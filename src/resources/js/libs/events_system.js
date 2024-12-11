export class EventsSystem {

    eventsListeners = new Map();

    constructor() {
        window.$emit = (event, ...args) => {
            const events = Array.isArray(event) ? event : [event];
            this.Event(events, ...args);
        }
        
        window.$on = (listener, eventFunction) => {
            const listeners = Array.isArray(listener) ? listener : [listener];
            this.AddEventListener(listeners, eventFunction);
        }

        window.$off = (listener, eventFunction) => {
            const listeners = Array.isArray(listener) ? listener : [listener];
            this.RemoveEventListener(listeners, eventFunction);
        }
    }

    AddEventListener(listeners, eventFunction) {
        listeners.forEach(listener => {
            if (this.eventsListeners.get(listener) == undefined){
                this.eventsListeners.set(listener, [eventFunction]);
            }
            else {
                this.eventsListeners.get(listener).push(eventFunction);
            }
        });
    }

    RemoveEventListener(listeners, eventFunction) {
        listeners.forEach(listener => {
            if (this.eventsListeners.get(listener) != undefined){
                const functions = this.eventsListeners.get(listener);
                const pos = functions.indexOf(eventFunction);
                if (pos >= 0) {
                    functions.splice(pos,1);
                }
            }
        });
    }

    Event(events, ...args) {
        // console.debug(events);
        // console.debug(events, this.eventsListeners);
        events.forEach(event => {
            if (this.eventsListeners.get(event) != undefined){
                const functions = this.eventsListeners.get(event);
                functions.forEach(func => {
                    func(args, event);
                });
            }
        });
    }

}