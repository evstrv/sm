<template>
    <div class="menu">
        <nav>
            <button class="menu-btn" @click="toProfile"><img src="../assets/user.png" alt="Profile"></button>
            <button class="logout" @click="logout"><img src="../assets/logout.png" alt="Logout"></button>
        </nav>
    </div>
</template>

<script>
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Menu',
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
    .menu{
        padding: 1rem 0 0 2rem;
        position: absolute;

        nav {
            width: 55px;
            border-radius: 20px;
            box-shadow: 0 0 4px 0 black;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            button {
                img {
                    width: 20px;
                    height: 20px;
                }

                &.logout {
                    width: 40px;
                    height: 40px;
                    border: none;
                    border-radius: 50%;
                    transition: .3s;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 10px 0;
                    background-color: #1074e7;

                    &:hover {
                        transition: .3s;
                        background-color: #0f63c4;
                    }

                    &:focus {
                        outline: none;
                        transition: box-shadow .3s;
                        box-shadow: 0px 0px 4px 2px #5aa0f1;
                    }
                }

                &.menu-btn {
                    width: 40px;
                    height: 40px;
                    border: none;
                    border-radius: 50%;
                    transition: .3s;
                    background-color: white;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 10px 0;
                    box-shadow: 0px 0px 4px 0px black;

                    &:hover {
                        transition: .3s;
                        background-color: rgba(0, 0, 0, .05);
                    }

                    &:focus {
                        outline: none;
                        transition: box-shadow .3s;
                        box-shadow: 0px 0px 4px 2px #5aa0f1;
                    }
                }
            }
        }
    }   
</style>