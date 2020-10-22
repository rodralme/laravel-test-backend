<template>
    <div class="flex items-center">
        <label :for="name" class="w-64 inline-block">
            {{ label }}
        </label>
        <div class="flex-1">
            <input
                v-bind="$attrs"
                :value="value"
                :id="name"
                :name="name"
                type="text"
                :class="'px-3 py-2 border rounded-md w-full focus:outline-none focus:border-blue-400 ' + (!error || 'border-red-500')"
                @input="$emit('input', $event.target.value)"
            />
            <div v-if="error" class="text-sm text-red-500 mt-1">
                {{ Array.isArray(error) ? error[0] : error }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'text-field',

        props: ['value', 'name', 'label', 'error'],
    }
</script>
