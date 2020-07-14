<template>
    <div class="entry">
        <h1>Sign in to Medium</h1>
        <div class="login">
            <form action="">
                <label for="">
                    <span>Username</span>
                    <input type="text" v-model="login">
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
            return {
                login: '',
                password: ''
            };
        },
        computed: {

        },
        methods: {

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
                        transition: .3s;
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
    }
</style>