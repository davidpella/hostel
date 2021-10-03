import { computed } from "vue";

export const usePagination = (object) => {
    const lastPageUrl = computed(() => {
        return object.last_page_url;
    });

    const firstPageUrl = computed(() => {
        return object.first_page_url;
    });

    const nextPageUrl = computed(() => {
        return object.next_page_url;
    });

    const prevPageUrl = computed(() => {
        return object.prev_page_url;
    });

    return {
        lastPageUrl,
        firstPageUrl,
        nextPageUrl,
        prevPageUrl,
    };
};
