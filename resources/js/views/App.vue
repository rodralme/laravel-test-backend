<template>
    <div>
        <h1>Laravel Test Backend</h1>

        <div>
            <router-link :to="{name: 'imoveis'}">Imóveis</router-link>
            |
            <router-link :to="{name: 'contratos'}">Contratos</router-link>
        </div>

        <router-view></router-view>
    </div>
</template>

<script>
export default {}
</script>
