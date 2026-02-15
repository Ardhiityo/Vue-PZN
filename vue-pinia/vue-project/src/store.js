import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useCounter = defineStore("counter", () => {
    // State
    const counter = ref(0);

    // Action
    function increment() {
        counter.value++;
    }

    // Action
    function reset() {
        counter.value = 0;
    }
    
    // Getter
    // Akan di trigger apabila nilai state berubah
    const doubled = computed(() => {
        console.log("computed");
        return counter.value * 2;
    });
    
    return {
        counter,
        increment,
        reset,
        doubled
    }
});