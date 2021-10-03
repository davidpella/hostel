<template>
    <Dialog :open="isOpen">
        <DialogOverlay class="fixed inset-0 bg-black opacity-30" />

        <div class="fixed bg-white bottom-0 max-w-md p-6 right-0 top-0">
            <slot />
        </div>
    </Dialog>
</template>

<script setup>
import { Dialog, DialogOverlay, DialogTitle, DialogDescription } from "@headlessui/vue";

const emit = defineEmits(['close', 'open']);

defineProps({
    isOpen: {
        required: true,
        type: Boolean
    }
});
</script>
