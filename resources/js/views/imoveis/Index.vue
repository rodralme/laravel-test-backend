<template>
    <div>
        <div>
            <router-link
                :to="{name: 'cadastro-imoveis'}"
                class="px-4 py-2 bg-blue-600 text-gray-100 rounded-md"
            >
                Novo imóvel
            </router-link>
        </div>

        <table class="datatable mt-6 w-full border">
            <thead>
            <tr class="bg-gray-800 text-gray-200">
                <td class="px-3 py-2">E-mail do proprietário</td>
                <td class="px-3 py-2">Referência</td>
                <td class="px-3 py-2">Status</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in lista" class="border-b text-gray-800">
                <td>{{ item.email_proprietario }}</td>
                <td>{{ item.referencia }}</td>
                <td>{{ item.status }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data: () => ({
        lista: [],
    }),

    created() {
        this.fetchData()
    },

    methods: {
        async fetchData() {
            const {data} = await axios.get('/api/imoveis')
            if (data.success) {
                this.lista = data.data
            } else {
                console.log('Erro ao obter lista de imóveis')
            }
        }
    },
}
</script>

<style>
.datatable > tbody > tr:last-child {
    border: none;
}

.datatable tr > td {
    padding: 0.5rem 0.75rem;
}
</style>
