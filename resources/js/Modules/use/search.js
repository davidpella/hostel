import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

export const useSearch = () => {
    const search = ref('');

    watch(search, (value) => {
        Inertia.reload({data: { search: value }});
    });

    return { search };
}


