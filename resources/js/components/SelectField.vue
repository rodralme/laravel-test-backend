<template>
    <div class="flex items-center">
        <label :for="name" class="w-64 inline-block">
            {{ label }}
        </label>
        <div class="flex-1">
            <select
                :value="value"
                :id="name"
                :name="name"
                :class="'px-3 py-3 border rounded-md w-full bg-white focus:outline-none ' + (!error || 'border-red-500')"
                @change="$emit('input', $event.target.value)"
            >
                <option value="">(Selecione)</option>
                <option v-for="item in items" :key="item.value" :value="item.value">
                    {{ item.label }}
                </option>
            </select>
            <div v-if="error" class="text-sm text-red-500 mt-1">
                {{ Array.isArray(error) ? error[0] : error }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'select-field',

        props: ['value', 'name', 'label', 'error', 'items'],
    }
</script>
