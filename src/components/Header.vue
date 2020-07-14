<template>
    <header>
        <div class="logo">
            <a href="/"><img :src="logoImg"></a>
        </div>
    </header>
</template>

<script lang="ts">
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Header',
        data() {
            return {
                logoImg: require('../assets/medium.png')
            };
        }
    })
</script>

<style lang="scss" scoped>
    header {
        box-shadow: 0 0 4px 0 black;
        width: 100%;
        min-height: 43px;
        padding: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
        background-color: white;

        div {
            &.logo {
                display: flex;
                align-items: center;
                
                a {
                    width: 30px;
                    height: 30px;

                    img {
                        width: inherit;
                    }
                }
            }
        }
    }
</style>