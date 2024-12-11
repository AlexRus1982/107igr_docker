export class GlobalList {
    items = new Map();
    lastIndex = 6;

    constructor() {
        this.items.set('1', 'item1');
        this.items.set('2', 'item2');
        this.items.set('3', 'item3');
        this.items.set('4', 'item4');
        this.items.set('5', 'item5');
    }

    removeItem(itemIndex) {
        this.items.delete(itemIndex);
    }

    addItem(item) {
        this.items.set(this.lastIndex++, item);
    }
}