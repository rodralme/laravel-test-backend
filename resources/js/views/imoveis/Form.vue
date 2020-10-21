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
                        name="email_proprietario"
                        label="E-mail do proprietário"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.rua"
                        name="rua"
                        label="Rua"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.numero"
                        name="numero"
                        label="Número"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.complemento"
                        name="complemento"
                        label="Complemento"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.bairro"
                        name="bairro"
                        label="Bairro"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.cidade"
                        name="cidade"
                        label="Cidade"
                    />
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text
                        v-model="model.estado"
                        name="estado"
                        label="Estado"
                    />
                </li>
            </ul>

            <ul
                v-show="Object.keys(errors).length"
                class="errors mt-6 py-4 border border-red-500 rounded-md bg-red-100 text-red-500"
            >
                <li v-for="field in errors" class="px-6 leading-relaxed">
                    <div v-for="error in field">{{ error }}</div>
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
            async cadastrar() {
                this.loading = true
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
