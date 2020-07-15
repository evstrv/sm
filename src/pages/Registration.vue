<template>
    <div class="registration">
        <span>Join Medium</span>
        <h1>Create your account</h1>
        <div class="create">
            <span class="success" v-if="successRegistration">Registration completed successfully!</span>
            <div class="errors" v-show="isError">
                <span class="error" v-show="isError && !username">The username field is incorrect!</span>
                <span class="error" v-show="isError && !email">The email field is incorrect!</span>
                <span class="error" v-show="isError && !password">The password field is incorrect!</span>
                <span class="error" v-show="isError && (!confPass || !password || password !== confPass)">Password mismatch!</span>
            </div>
            <form action="">
                <label for="">
                    <span>First name </span>
                    <input type="text" v-model="firstName">
                </label>
                <label for="">
                    <span>Last name </span>
                    <input type="text" v-model="lastName">
                </label>
                <label for="">
                    <span>Birthday</span>
                    <input type="date" v-model="birthday">
                </label>
                <label for="">
                    <span>Username <span>*</span></span>
                    <input type="text" v-model="username">
                </label>
                <label for="">
                    <span>Email address <span>*</span></span>
                    <input type="email" v-model="email">
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
            <span class="terms">
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
                firstName: '',
                lastName: '',
                birthday: '',
                username: '',
                email: '',
                password: '',
                confPass: '',
                needCheck: false,
                successRegistration: false
            };
        },
        computed: {
            isError() {
                if(this.needCheck) {
                    return !(this.password === this.confPass && this.username && this.email);
                }
                return false;
            }
        },
        methods: {
            submit(event) {
                event.preventDefault();
                this.needCheck = true;
                if(!this.isError) {
                    fetch(
                        '//localhost/medium/api/user/registration.php',
                        {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                firstName: this.firstName,
                                lastName: this.lastName,
                                birthday: new Date(this.birthday).valueOf() / 1000,
                                username: this.username,
                                email: this.email,
                                password: this.password
                            })
                        }
                    ).then(res => res.json()).then(res => {
                        console.log(res);   
                        if(res && res.res) {
                            this.firstName = '',
                            this.lastName = '',
                            this.birthday = '',
                            this.username = '',
                            this.email = '',
                            this.password = '',
                            this.confPass = '',
                            this.needCheck = false,
                            this.successRegistration = true
                        }
                        this.$router.push('/    ');
                    }).catch(err => {
                        console.log(err);
                    });
                }
            }
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
            text-align: center;
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

                    > span > span  {
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

            span {
                &.success {
                    background-color: #e4ffe2;
                    border: 1px solid #80f975;
                    border-radius: 6px;
                    width: 100%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: 0 0 15px;
                    padding: 10px 0;
                    font-size: 13px;
                }

                &.terms {
                    font-size: 12px;
                }
            }

            .errors {
                background-color: #ffeef0;
                border: 1px solid #f97583;
                border-radius: 6px;
                margin: 0 0 15px;
                padding: 10px;
                
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
    }
</style>