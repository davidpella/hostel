<template>
    <div>{{ student }}</div>
</template>

<script setup>
    defineProps({
        student: {
            required: true,
            type: Object,
        }
    })
</script>
