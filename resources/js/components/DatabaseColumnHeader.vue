<template>
    <td>
        <button
            @click.prevent="onClick"
            class="flex items-center justify-start border-0 focus:outline-none"
        >
            <span class="">
                <slot/>
            </span>

            <!-- indicador da ordenação -->
            <span v-if="value.field === to" class="pl-3 text-xs">
                <svg v-if="value.order === 'asc'" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg v-if="value.order === 'desc'" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd"></path></svg>
            </span>
        </button>
    </td>
</template>

<script>
export default {
    name: 'database-column-header',

    props: ['value', 'to'],

    methods: {
        onClick() {
            const sort = {
                field: this.to,
                order: 'asc',
            }
            if (this.value.field === this.to) {
                sort.order = this.value.order === 'asc' ? 'desc' : 'asc'
            }
            this.$emit('input', sort)
        }
    }
}
</script>

