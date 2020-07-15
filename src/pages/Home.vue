<template>
    <div class="home">
        <div class="menu">
            <nav>
                <button @click="toProfile"><img src="../assets/user.png" alt="Profile"></button>
                <button @click="logout"><img src="../assets/logout.png" alt="Logout"></button>
            </nav>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Home',
        data() {
            const isLogin = localStorage.getItem('id') && localStorage.getItem('login');

            return {
                isLogin: isLogin
            };
        },
        methods: {
            logout() {
                localStorage.setItem('id', '');
                localStorage.setItem('username', '');
                this.isLogin = false;
                this.$router.push('/');
            },
            toProfile() {
                this.$router.push('/profile');
            }
        }
    })
</script>

<style lang="scss" scoped>
    .home {
        .menu{
            padding: 1rem 0 0 2rem;

            nav {
                width: 60px;
                border-radius: 20px;
                box-shadow: 0 0 4px 0 black;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

                button {
                    width: 40px;
                    height: 40px;
                    border: none;
                    border-radius: 50%;
                    background-color: #1074e7;
                    color: white;
                    font-size: 1.2rem;
                    font-weight: 300;
                    transition: .3s;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 10px 0;

                    &:hover {
                        transition: .3s;
                        background-color: #0f63c4;
                    }

                    &:focus {
                        outline: none;
                        transition: box-shadow .3s;
                        box-shadow: 0px 0px 4px 2px #5aa0f1;
                    }

                    img {
                        width: 20px;
                        height: 20px;
                    }
                }
            }
        }
    }
</style>