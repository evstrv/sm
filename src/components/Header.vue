<template>
    <header>
        <div class="logo">
            <img :src="logoImg">
        </div>
    </header>
</template>

<script>
    export default {
        name: 'Header',
        data() {
            return {
                logoImg: require('../assets/medium.png')
            };
        }
    }
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
        margin-bottom: 1rem;

        div {
            &.logo {
                display: flex;
                align-items: center;
                
                img {
                    width: 30px;
                }
            }
        }
    }
</style>