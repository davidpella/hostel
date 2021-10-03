<template>
    <div class="text-sm text-gray-500">
        Showing {{ payload.from }} - {{ payload.to }} out of {{ payload.total }}
    </div>

    <div class="flex items-center space-x-2">
        <InertiaLink
            :href="firstPageUrl"
            class="px-3 py-2 bg-gray-100 rounded-md self-stretch text-sm text-gray-800 font-medium"
            :class="[{'opacity-30': !firstPageUrl }]"
        >
            <ChevronDoubleLeftIcon class="h-5 w-5 text-gray-500" />
        </InertiaLink>

        <InertiaLink
            :href="prevPageUrl"
            class="px-3 py-2 bg-gray-100 rounded-md self-stretch text-sm text-gray-800 font-medium"
            :class="[{'opacity-30': !prevPageUrl }]"
        >
            Prev
        </InertiaLink>

        <InertiaLink
            :href="nextPageUrl"
            class="px-3 py-2 bg-gray-100 rounded-md self-stretch text-sm text-gray-800 font-medium"
            :class="[{'opacity-30': !nextPageUrl }]"
        >
            Next
        </InertiaLink>

        <InertiaLink
            :href="lastPageUrl"
            class="px-3 py-2 bg-gray-100 rounded-md self-stretch text-sm text-gray-800 font-medium"
            :class="[{'opacity-30': !lastPageUrl }]"
        >
            <ChevronDoubleRightIcon class="h-5 w-5 text-gray-500" />
        </InertiaLink>
    </div>
</template>

<script setup>
  import {usePagination} from "@/Modules/use/pagination";
  import { ChevronDoubleRightIcon, ChevronDoubleLeftIcon } from '@heroicons/vue/solid';
  import { Link as InertiaLink } from '@inertiajs/inertia-vue3';

  const props = defineProps({
      payload: {
          required: true,
          type: Object
      }
  });

  const {
      lastPageUrl,
      firstPageUrl,
      nextPageUrl,
      prevPageUrl,
  } = usePagination(props.payload);
</script>
