<template>
    <footer>
        <span>© 2020 Medium</span>
    </footer>
</template>

<script>
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Footer'
    })
</script>

<style lang="scss" scoped>
    footer {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px 0 8px;
        font-weight: 300;
        font-size: 1rem;
        margin-top: 1rem;
    }
</style>