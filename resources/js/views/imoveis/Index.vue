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
            <tr v-for="item in lista" class="border-b text-gray-800 text-sm">
                <td>{{ item.email_proprietario }}</td>
                <td>{{ item.referencia }}</td>
                <td :class="item.contratado ? 'text-green-700' : 'text-blue-700'">
                    {{ item.contratado ? 'Contratado' : 'Não contratado' }}
                </td>
                <td>
                    <button
                        @click.prevent="remover(item.id)"
                        class="text-red-500 underline focus:outline-none hover:text-red-800"
                    >
                        remover
                    </button>
                </td>
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
        },

        async remover(id) {
            const {data} = await axios.delete('/api/imoveis/' + id)
            if (data.success) {
                this.lista = this.lista.filter(item => item.id !== id)
                console.log('Imóvel removido com sucesso')
            } else {
                console.log('Erro ao remover imóvel')
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
