<template>
    <!-- list -->
    <div 
        :id="`category-group-${categoryType}`"
        class="category-group droppable"
        @drop="onDropp($event, 1)"
        @dragover.prevent
        @dragenter.prevent
    >
        <div class="category-title">
            <div class="category-title-label">{{ categoryTitle }}</div>
            <div class="category-title-button" @click="toggleCollapse(`category-group-${categoryType}`)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16">
                    <path d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z"/>
                </svg>
            </div>
        </div>
        <div class="category-items pt-2">
            <div 
                class="category-item draggable"
                v-for="item in categoriesList.filter(item => item.category.main_url == categoryType)"
                :class="item.dragClass" 
                :key="item.category.id"
                :item-id="item.category.id"
                @dragstart="onDragStart($event, item)"
                @dragend="onDragEnd($event, item)"
                @dragover="onDragOver($event, item)"
                draggable="true"
            >
                <img :src="item.category_image" draggable="false">
                
                <div>{{ item.category.category }}</div>
                
                <div class="counts">{{ item.category_active_count }} / {{ item.category_count }}</div>
                
                <div class="edit" title="Редактирование" @click="editCategory($event, item.category.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </div>

                <div class="delete" title="Удалить" @click="deleteCategory($event, item.category.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                    </svg>
                </div>

            </div>
        </div>
    </div>
</template>

<style lang="scss">
    $max-item-width : 600px;

    @mixin no-select {
        -ms-user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        user-select: none;
    }

    .drag-clone {
        width: 100%;
        max-width: $max-item-width;
        height: 3px;
        box-shadow: 0px 0px 2px #FFF;
        background: #FFF;
        // opacity: 0.3;
    }

    .category-group:not(:last-child) {
        margin-bottom: 10px;
    }

    .category-group {
        display: none;
        flex-direction: column;
        align-items: flex-end;
        width: 100%;
        max-width: $max-item-width;

        .category-title {
            display: flex;
            flex-direction: row;
            position: sticky;
            top: 0px;
            z-index: 1000;
            width: 100%;
            padding: 20px;
            background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
            background-color: #E84;

            .category-title-label {
                @include no-select();
            }

            .category-title-button {
                @include no-select();
                margin-left: auto;
                transition: 0.3s;

                &:hover {
                    cursor: pointer;
                }
            }
        }

        .category-items {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 90%;
            // max-height: 100%;
            transition: 0.3s;
            gap: 10px;

            .category-item {
                transition: 0.3s;
                overflow: hidden;
                padding: 5px;
                width: 100%;
                display: flex;
                flex-direction: row;
                align-items: center;
                background-image: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.15));
                background-color: #FFF4;
                border: 1px solid #FFF6;

                &:hover {
                    cursor: pointer;
                    box-shadow: 0px 0px 16px #E84;
                    color: #E84;
                    filter: brightness(130%);
                }

                &.dragged {
                    opacity: 1.0;
                }
    
                img {
                    width: 50px;
                    height: 50px;
                    border-radius: 10px;
                    box-shadow: 0px 0px 4px #0007;
                    object-fit: cover;
                    margin-right: 10px;
                }

                .counts {
                    margin-left: auto;
                    margin-right: 20px;
                }

                .edit,
                .delete {
                    transition: 0.3s;

                    &:hover {
                        cursor: pointer;
                        transform: scale(1.2);
                    }
                }

                .edit {
                    margin: 0px 10px;
                    &:hover {
                        color: #0F0;
                    }
                }

                .delete {
                    &:hover {
                        color: #F00;
                    }
                }

            }
        }

        &.collapsed {
            // .category-items {
            //     // max-height: 0;
            //     overflow: hidden;
            // }

            .category-title {
                .category-title-button {
                    transform: rotateZ(-180deg);
                }
            }
        }
    }

</style>

<script lang="ts">
    import $ from 'jquery';

    export default {
        name: "CategoryPageList",

        props: [
            'categoriesList', 
            'categoryType',
            'categoryTitle',
        ],

        setup(props) {
            // const ResourcesLocation = window.GlobalVars.ResourcesLocation;

            let overIndex:number    = -1;
            let dragTarget:any      = null;
            let dragCopyTarget:any  = null;
            let dragItem:any        = null;

            function onDragStart(e, item) {
                dragItem = JSON.parse(JSON.stringify(item));

                e.dataTransfer.setData('itemId', `${item.category.id}`);
                e.dataTransfer.dropEffect = 'move';
                console.debug(item.category.id);
                props.categoriesList.forEach(element => {
                    if (item.category.id == element.category.id) {
                        element.dragClass = "dragged";
                    }
                });

                dragTarget = e.target;
                dragCopyTarget = $('<div class="drag-clone"></div>');
                setTimeout(() => {
                    dragTarget.style.display = "none";
                }, 0);
            }

            function onDragEnd(e, item) {
                props.categoriesList.forEach(element => {
                    if (item.category.id == element.category.id) {
                        element.dragClass = "";
                    }
                });

                setTimeout(() => {
                    dragTarget.style.display = "flex";
                }, 0);

                $(dragCopyTarget).remove();
            }

            function onDragOver(e, item) {
                props.categoriesList.forEach(element => {
                    if (item.category.id == element.category.id) {
                        if (item.category.id != overIndex) {
                            overIndex = item.category.id;
                            console.debug(overIndex);
                            const html_element = $(`.category-group .category-item[item-id="${overIndex}"]`);
                            console.debug(html_element);
                            $(dragCopyTarget).insertBefore(html_element);
                        }
                        return;
                    }
                });
            }

            function onDropp(e, categoryId) {
                console.debug(`Drop - ${overIndex} Category type - ${props.categoryType}`);
                props.categoriesList.forEach(element => {
                    element.dragClass = "";
                });
                
                $(dragCopyTarget).remove();

                let insertIndex = -1;
                let deleteIndex = -1;
                let index = 0;
                props.categoriesList.forEach(element => {
                    if (element.category.id == overIndex) {
                        insertIndex = index;
                    }
                    if (element.category.id == dragItem.category.id) {
                        deleteIndex = index;
                    }
                    index++;
                });

                console.debug(insertIndex);
                props.categoriesList.splice(deleteIndex, 1);
                props.categoriesList.splice(insertIndex, 0, dragItem);

                const orders = <any>[];
                let orderIndex = 1;
                props.categoriesList.forEach(element => {
                    if (element.category.main_url == props.categoryType){
                        orders.push({
                            'category_id'    : element.category.id,
                            'category_order' : orderIndex++,
                        })
                    }
                })

                fetch(`../api/categories/orders`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'categoryType'  : props.categoryType,
                        'orders'        : orders,
                    })
                })
                .then(response => response.json())
                .then(
                    ({
                        'server-answer' : server_answer, 
                        'script-time'   : script_time,
                    }) => {
                        console.debug(`Сортировка - ${server_answer} - выполнена за ${script_time}`);
                    }
                )
                .catch(error => console.log("request failed", error));

                overIndex = -1;
            }

            function toggleCollapse(elementId) {
                $(`#${elementId}`).toggleClass('collapsed');
                if (!$(`#${elementId}`).hasClass('collapsed')){
                    $(`#${elementId} .category-items`).slideDown(300);
                } else {
                    $(`#${elementId} .category-items`).slideUp(300);
                }
            }

            return {
                // ResourcesLocation, 

                onDragStart,
                onDragEnd,
                onDragOver,
                onDropp,

                toggleCollapse,
            }
        },

        methods: {

            editCategory(event, category_id) {
                const appUrl = `/admin-panel/category/edit?category_id=${category_id}`;

                if (event.ctrlKey) {
                    window.open(appUrl, '_blank');
                } else {
                    window.location.href = appUrl;
                }
            },

            deleteCategory(event, category_id) {
                if (!confirm('Удалить категорию?')) return;
                fetch(`../api/categories/delete`, {
                    method: 'POST',
                    headers: {
                      'Accept'          : 'application/json',
                      'Content-Type'    : 'application/json'
                    },
                    body: JSON.stringify({
                        'category_id'   : category_id,
                    })
                })
                .then(() => {
                    //location.reload();
                    $(event.target).closest('.category-item').remove();
                })
                .catch(error => console.log("request failed", error));
            },

        },
    }
</script>