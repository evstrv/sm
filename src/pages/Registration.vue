<template>
    <div class="registration">
        <span>Join Medium</span>
        <h1>Create your account</h1>
        <div class="create">
            <form action="">
                <label for="">
                    <span>Username</span>
                    <input type="text" v-model="username">
                </label>
                <label for="">
                    <span>Account name <span>*</span></span>
                    <input type="text" v-model="account">
                </label>
                <label for="">
                    <span>Email address <span>*</span></span>
                    <input type="email" v-model="email">
                </label>
                <label for="">
                    <span>Birthday</span>
                    <input type="date" v-model="birthday">
                </label>
                <label for="">
                    <span>Password <span>*</span></span>
                    <input type="password" v-model="password">
                </label>
                <label for="">
                    <span>Confirm password <span>*</span></span>
                    <input type="password" v-model="confPass">
                </label>
                <button @click="submit">Create account</button>
            </form>
            <span>
                By creating an account, you agree to the Terms of Service (that don't exist). 
                For more information about Medium's privacy practices, see the Medium Privacy Statement (that doesn't exist). 
                We'll occasionally send you account-related emails.
            </span>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    export default Vue.extend({
        name: 'Registration',
        data() {
            return {
                username: '',
                account: '',
                email: '',
                birthday: '',
                password: '',
                confPass: ''
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
    .registration {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: inherit;

        > span {
            font-size: 1rem;
            font-weight: 400;
            color: rgb(85, 84, 84);
            margin: 0 0 16px;
        }

        h1 {
            font-size: 3rem;
            font-weight: 500;
            margin: 0;
        }

        .create {
            width: 40%;
            margin-top: 1.5rem;   

            form {
                label {
                    display: flex;
                    flex-direction: column;
                    margin: 0 0 7px;
                    font-size: 14px;

                    > span span  {
                        color: red;
                    }

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
                    margin-bottom: 1rem;
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

            > span {
                font-size: 12px;
            }
        }
    }
</style>