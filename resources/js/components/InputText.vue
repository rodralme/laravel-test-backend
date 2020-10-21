<template>
    <div class="flex items-center">
        <label :for="name" class="w-64 inline-block">
            {{ label }}
        </label>
        <input
            :value="value"
            :id="name"
            :name="name"
            type="text"
            class="px-3 py-2 border rounded-md flex-1"
            @input="$emit('input', $event.target.value)"
        />
    </div>
</template>

<script>
    export default {
        name: 'input-text',

        props: ['value', 'name', 'label'],
    }
</script>
