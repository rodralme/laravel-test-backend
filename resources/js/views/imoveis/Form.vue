<template>
    <div class="text-gray-700">
        <h2 class="w-full text-xl font-bold pb-6">
            Cadastro de Imóvel
        </h2>
        <form>
            <ul class="border rounded-md">
                <li class="px-4 py-4 border-b">
                    <input-text name="email_proprietario" label="E-mail do proprietário"/>
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text name="rua" label="Rua"/>
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text name="numero" label="Número"/>
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text name="complemento" label="Complemento"/>
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text name="cidade" label="Cidade"/>
                </li>
                <li class="px-4 py-4 border-b">
                    <input-text name="estado" label="Estado"/>
                </li>
            </ul>
        </form>
    </div>
</template>

<script>
import InputText from "../../components/InputText"

export default {
    components: {InputText}
}
</script>

<style>
    form > ul > li:last-child {
        border: none;
    }
</style>
