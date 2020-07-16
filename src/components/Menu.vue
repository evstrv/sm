<template>
    <div class="menu">
        <nav>
            <button @click="toHome"><img src="../assets/home.png" alt="Home"></button>
            <button><img src="../assets/messages.png" alt="Messages"></button>
            <button><img src="../assets/followers.png" alt="Followers"></button>
            <button @click="toProfile"><img src="../assets/user.png" alt="Profile"></button>
            <button @click="logout"><img src="../assets/logout.png" alt="Logout"></button>
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
            toHome() {
                this.$router.push('/home');
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            button {
                width: 45px;
                height: 45px;
                border: none;
                border-radius: 50%;
                background-color: #fff;
                transition: .3s;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 10px 0;
                transition: .3s;

                &:hover {
                    transition: .3s;
                    background-color: rgba(0, 0, 0, .05);
                }

                &:focus {
                    outline: none;
                    transition: box-shadow .3s;
                    box-shadow: 0px 0px 4px 1px #5aa0f1;
                }

                img {
                    width: 25px;
                    height: 25px;
                }
            }
        }
    }   
</style>