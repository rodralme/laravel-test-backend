<template>
    <div class="text-gray-700">
        <h2 class="w-full text-xl font-bold pb-6">
            Cadastro de Imóvel
        </h2>
        <form @submit.prevent="cadastrar">
            <ul class="border rounded-md">
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.email_proprietario"
                        :error="errors.email_proprietario"
                        name="email_proprietario"
                        label="E-mail do proprietário"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.rua"
                        :error="errors.rua"
                        name="rua"
                        label="Rua"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.numero"
                        :error="errors.numero"
                        name="numero"
                        label="Número"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.complemento"
                        :error="errors.complemento"
                        name="complemento"
                        label="Complemento"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.bairro"
                        :error="errors.bairro"
                        name="bairro"
                        label="Bairro"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.cidade"
                        :error="errors.cidade"
                        name="cidade"
                        label="Cidade"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.estado"
                        :error="errors.estado"
                        name="estado"
                        label="Estado"
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
                    :to="{name: 'imoveis'}"
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
    import InputText from "../../components/InputText"

    export default {
        components: {InputText},

        data: () => ({
            model: {},
            loading: false,
            errors: {},
        }),

        methods: {
            validar() {
                // required
                ['email_proprietario', 'rua', 'bairro', 'cidade', 'estado']
                    .forEach(field => !!this.model[field] || (this.errors[field] = 'Campo obrigatório'))

                // e-mail
                const regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                if (!this.errors.email_proprietario && !regex.test(this.model.email_proprietario)) {
                    this.errors.email_proprietario = 'E-mail inválido'
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
                    const {data} = await axios.post('/api/imoveis', this.model)
                    if (data.success) {
                        console.log('OK')
                    } else {
                        console.log('Erro ao cadastrar o imóvel')
                    }
                    this.model = {}
                } catch (error) {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                        return
                    }
                    throw error
                } finally {
                    this.loading = false
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
