<template>
    <div class="entry">
        <h1>Sign in to Medium</h1>
        <span class="success" v-if="isLogin">You have successfully authorized!</span>
        <div class="errors" v-show="isError">
            <span class="error" v-show="isError && !username">The username field is incorrect!</span>
            <span class="error" v-show="isError && !password">The password field is incorrect!</span>
        </div>
        <div class="login">
            <form action="">
                <label for="">
                    <span>Username</span>
                    <input type="text" v-model="username">
                </label>
                <label for="">
                    <span>Password</span>
                    <input type="password" v-model="password">
                </label>
                <button @click="authorize">Sign in</button>
            </form>
        </div>
        <div class="create">
            <span>New to Medium? <router-link to="/registration">Create an account.</router-link></span>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Entry',
        data() {
            const isLogin = localStorage.getItem('id') && localStorage.getItem('username');

            return {
                username: '',
                password: '',
                isLogin: isLogin,
                needCheck: false
            };
        },
        computed: {
            isError() {
                if(this.needCheck) {
                    return !(this.username && this.password);
                }
                return false;
            }
        },
        methods: {
            authorize(event) {
                event.preventDefault();
                this.needCheck = true;
                if(!this.isError) {
                    fetch(
                        '//localhost/medium/api/user/authorize.php',
                        {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                username: this.username,
                                password: this.password
                            })
                        }
                    ).then(res => res.json()).then(res => {
                        this.isLogin = true;
                        localStorage.setItem('id', res.userId);
                        localStorage.setItem('username', this.username);
                        this.$router.push('/home');
                    });
                }
            }
        },
        mounted() {

        }
    })
</script>

<style lang="scss" scoped>
    .entry {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: inherit;

        h1 {
            font-weight: 300;
            font-size: 1.5rem;
        }

        span {
            &.success {
                background-color: #e4ffe2;
                border: 1px solid #80f975;
                border-radius: 6px;
                width: 18%;
                text-align: center;
                margin: 0 0 15px;
                padding: 10px 20px;
                font-size: 13px;
            }
        }

        .login {
            border: 1px solid rgba($color: gray, $alpha: .5);
            border-radius: 6px;
            padding: 20px;
            width: 18%;
            margin-bottom: 1rem;

            form {
                label {
                    display: flex;
                    flex-direction: column;
                    margin: 0 0 7px;
                    font-size: 14px;

                    input {
                        margin: 5px 0 15px;
                        padding: 5px 12px;
                        font-size: 14px;
                        border: 1px solid rgba($color: gray, $alpha: .5);
                        border-radius: 6px;

                        &:focus {
                            outline: none;
                            box-shadow: 0px 0px 5px 1px rgba(141,174,240,1);
                        }
                    }
                }

                button {
                    width: 100%;
                    padding: 5px 16px;
                    border: none;
                    border-radius: 6px;
                    font-size: 14px;
                    background-color: #1074e7;
                    color: white;
                    font-weight: 500;
                    line-height: 20px;
                    transition: .3s;

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
            }
        }

        .create {
            width: 18%;
            border: 1px solid rgba($color: gray, $alpha: .5);
            border-radius: 6px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: center;

            span {
                text-align: center;
                font-size: 14px;

                a {
                    text-decoration: none;
                    color: #0366d6;

                    &:hover {
                        text-decoration: underline;
                    }
                }
            }
        }

        .errors {
            background-color: #ffeef0;
            border: 1px solid #f97583;
            border-radius: 6px;
            margin: 0 0 15px;
            padding: 10px 20px;
            width: 18%;
                
            span {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 13px;
                text-align: center;

                &:not(:last-child) {
                    padding-bottom: 10px;
                }
            }
        }
    }
</style>