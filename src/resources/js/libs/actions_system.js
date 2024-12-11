export class ActionsSystem {

    _actions = new Map();

    constructor() {
        window.$action = (actionName, argsObject) => {
            return this.Action(actionName, argsObject);
        }
        
        window.$registerAction = (actionName, actionFunction) => {
            this.RegisterAction(actionName, actionFunction);
        }

        window.$unregisterAction = (actionName) => {
            this.UnregisterAction(actionName);
        }
    }

    RegisterAction(actionName, actionFunction) {
        if (this._actions.get(actionName) == undefined){
            this._actions.set(actionName, actionFunction);
        }
        else {
            console.warn(`action - '${actionName}' already registered`);
        }
    }

    UnregisterAction(actionName) {
        if (this._actions.get(actionName) != undefined) {
            this._actions.remove(actionName);
        }
    }

    Action(actionName, argsObject) {
        if (this._actions.get(actionName) != undefined){
            const func = this._actions.get(actionName);
            return func(argsObject);
        }
        return null;
    }

}