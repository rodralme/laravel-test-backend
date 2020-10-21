<template>
    <div class="h-screen flex">
        <!-- Menu -->
        <ul class="w-48 py-4 bg-gray-800">
            <li>
                <router-link :to="{name: 'imoveis'}">
                    <div class="px-4 py-4 text-gray-300 hover:text-white hover:bg-gray-700">
                        Imóveis
                    </div>
                </router-link>
            </li>
            <li>
                <router-link :to="{name: 'contratos'}">
                    <div class="px-4 py-4 text-gray-300 hover:text-white hover:bg-gray-700">
                        Contratos
                    </div>
                </router-link>
            </li>
        </ul>

        <!-- Content -->
        <div class="flex-1">
            <p class="w-full text-center p-6 bg-gray-100 border-b text-gray-700 text-2xl font-bold">
                Laravel Test Backend
            </p>

            <div class="p-6">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
export default {}
</script>
