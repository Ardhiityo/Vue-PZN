import { defineStore } from "pinia";
import { reactive, ref } from "vue";


export const useTodos = defineStore('todolist', () => {
    let id = 1;
    const todos = reactive([]);
    
    // TODO: add 
    function add (name) {
        todos.push({
            id: id++,
            name: name
         });
    }
    
    // TODO: update
    function update(id, name) {
        const index = todos.findIndex(item => item.id === Number(id));
        todos[index].name = name;
    }
    
    // TODO: remove
    function remove(id) {
        const index = todos.findIndex(item => item.id === id);
        todos.splice(index, 1);
    }
    
    // TODO: find 
    function find(id) {
        const index = todos.findIndex(item => item.id === Number(id));
        return todos[index];
    }
     
    return {
        todos,
        add,
        update,
        remove,
        find
    };
})