<template>
    <div>
        <div>
            <router-link
                :to="{name: 'cadastro-imoveis'}"
                class="px-3 py-2 bg-blue-600 text-gray-100"
            >
                Novo imóvel
            </router-link>
        </div>

        <table class="mt-6 table w-full border">
            <thead>
            <tr class="bg-gray-800 text-gray-200">
                <td class="px-3 py-2">E-mail do proprietário</td>
                <td class="px-3 py-2">Localização</td>
                <td class="px-3 py-2">Status</td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
