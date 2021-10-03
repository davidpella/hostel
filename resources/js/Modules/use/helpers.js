import { onBeforeUnmount, reactive, computed, watch, toRefs } from "vue";

export const useState = () => {
    // Data
    const state = reactive({
        count: 0,
    });

    // Methods
    const increment = () => {
        state.count++;
    }

    const decrement = () => {
        state.count--;
    }

    // Computed Property
    const plusOne = computed(() => state.count + 1);

    // Watch
    watch(() => state.count, (currentValue, previousValue) => {
        console.log(`The new counter value is: ${currentValue} and previous is: ${previousValue}`);
    });

    return { ...toRefs(state), decrement, increment, plusOne };
};

export const useBook = () => {
    const book = reactive({
        id: 1,
        author: 'Vue Team',
        year: '2020',
        title: 'Vue 3 Guide',
        description: 'You are reading this book right now ;)',
        price: 'free',
    });

    return { book };
}


export const useCurrentTime = () => {
    const currentTime = ref(new Date());

    const updateCurrentTime = () => {
        currentTime.value = new Date();
    };

    const intervalHandle = setInterval(updateCurrentTime, 1000);

    onBeforeUnmount(() => {
        clearInterval(intervalHandle.value)
    });

    return { currentTime };
};
