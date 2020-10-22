<template>
    <div class="text-gray-700">
        <h2 class="w-full text-xl font-bold pb-6">
            Cadastro de Contratos
        </h2>
        <form @submit.prevent="cadastrar">
            <ul class="border rounded-md">
                <li class="px-4 py-4 border-b">
                    <select-field
                        v-model="model.imovel_id"
                        :error="errors.imovel_id"
                        :items="imoveisDisponiveis"
                        name="imovel_id"
                        label="Imóvel"
                        autofocus
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <select-field
                        v-model="model.tipo_pessoa"
                        :error="errors.tipo_pessoa"
                        name="tipo_pessoa"
                        label="Tipo pessoa"
                        :items="tiposPessoa"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <text-field
                        v-model="model.documento"
                        :error="errors.documento"
                        name="documento"
                        label="Documento"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <text-field
                        v-model="model.email_contratante"
                        :error="errors.email_contratante"
                        name="email_contratante"
                        label="E-mail do contratante"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <text-field
                        v-model="model.nome_contratante"
                        :error="errors.nome_contratante"
                        name="nome_contratante"
                        label="Nome do contratante"
                    />
                </li>
            </ul>

            <div class="py-6 flex justify-center space-x-4">
                <button
                    type="submit"
                    :class="'px-4 py-2 bg-blue-600 text-gray-100 rounded-md ' + (!loading || 'opacity-50 cursor-not-allowed')"
                    :disabled="loading"
                >
                    {{ loading ? 'Aguarde...' : 'Cadastrar' }}
                </button>
                <router-link
                    :to="{name: 'contratos.index'}"
                    class="px-4 py-2 bg-blue-600 text-gray-100 rounded-md"
                >
                    Voltar
                </router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    import TextField from "../../components/TextField"
    import SelectField from "../../components/SelectField"

    export default {
        components: {TextField, SelectField},

        data: () => ({
            model: {},
            loading: false,
            errors: {},
            tiposPessoa: window.enums.TipoPessoa,
            imoveisDisponiveis: [],
        }),

        async created() {
            this.carregarImoveisDisponiveis()
        },

        methods: {
            validar() {
                // required
                ['imovel_id', 'tipo_pessoa', 'documento', 'email_contratante', 'nome_contratante']
                    .forEach(field => !!this.model[field] || (this.errors[field] = 'Campo obrigatório'))

                // e-mail
                const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                if (!this.errors.email_contratante && !regex.test(this.model.email_contratante)) {
                    this.errors.email_contratante = 'E-mail inválido'
                }
            },

            async cadastrar() {
                this.loading = true
                this.errors = {}
                this.validar()
                if (Object.keys(this.errors).length) {
                    this.loading = false
                    return
                }
                try {
                    const {data} = await axios.post('/api/contratos', this.model)
                    if (data.success) {
                        console.log('OK')
                    } else {
                        console.log('Erro ao cadastrar o contrato')
                    }
                    this.model = {}
                    this.carregarImoveisDisponiveis()
                } catch (error) {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                        return
                    }
                    throw error
                } finally {
                    this.loading = false
                }
            },

            async carregarImoveisDisponiveis() {
                const {data} = await axios.get('/api/imoveis/disponiveis')
                if (data.success) {
                    this.imoveisDisponiveis = data.data
                } else {
                    console.log('Não foi possível obter a lista de imóveis disponíveis')
                    this.imoveisDisponiveis = []
                }
            }
        }
    }
</script>

<style>
    form > ul > li:last-child {
        border: none;
    }
</style>
