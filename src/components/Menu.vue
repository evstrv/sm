<template>
    <div class="menu">
        <nav v-show="show">
            <button @click="toHome"><img src="../assets/home.png" alt="Home"></button>
            <button @click="toFollowers"><img src="../assets/followers.png" alt="Followers"></button>
            <button @click="toProfile"><img src="../assets/user.png" alt="Profile"></button>
            <button @click="toNotifications"><img src="../assets/notice.png" alt="Notice"></button>
            <button @click="logout"><img src="../assets/logout.png" alt="Logout"></button>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'Menu',
        data() {
            const isLogin = localStorage.getItem('id') && localStorage.getItem('username');

            return {
                isLogin: isLogin,
                show: false
            };
        },
        methods: {
            logout() {
                localStorage.setItem('id', '');
                localStorage.setItem('username', '');
                this.isLogin = false;
                this.$router.push('/');
                this.show = false;
            },
            toHome() {
                this.$router.push('/home');
            },
            toProfile() {
                this.$router.push('/profile');
            },
            toFollowers() {
                this.$router.push('/users');
            },
            toNotifications() {
                this.$router.push('/notifications');
            }
        },
        mounted() {
            this.$root.$on('emit', (isShow) => {
                this.show = isShow;
            });
        }
    }
</script>

<style lang="scss" scoped>
    .menu{
        padding: 0 2rem;
        position: absolute;
        width: 55px;

        nav {
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

                &:active {
                    outline: none;
                    transition: box-shadow .15s;
                    box-shadow: 0px 0px 4px 1px #5aa0f1;
                }

                &:focus {
                    outline: none;
                }

                img {
                    width: 25px;
                    height: 25px;
                }
            }
        }
    }   
</style>