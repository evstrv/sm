<template>
    <div class="edit">
        <div class="error" v-show="isError">
            <span v-show="isError && !firstName">The first name field is incorrect!</span>
            <span v-show="isError && !lastName">The last name field is incorrect!</span>
            <span v-show="isError && !birthday">The birthday field is incorrect!</span>
        </div>
        <div class="column">
                <h1>Edit profile</h1>
                <form action="">
                    <label for="">
                        <span>First name <span>*</span></span>
                        <input type="text" v-model="firstName">
                    </label>
                    <label for="">
                        <span>Last name <span>*</span></span>
                        <input type="text" v-model="lastName">
                    </label>
                    <label for="">
                        <span>Birthday <span>*</span></span>
                        <input type="date" v-model="birthday">
                    </label>
                    <label for="">
                        <span>Hometown</span>
                        <input type="text" v-model="hometown">
                    </label>
                    <label for="">
                        <span>Language</span>
                        <input type="text" v-model="language">
                    </label>
                    <button @click="edit">Edit</button>
                </form>
            </div>
    </div>
</template>

<script>
    export default {
        name: 'Edit',
        data() {
            return {
                firstName: '',
                lastName: '',
                birthday: '',
                hometown: '',
                language: '',
                needCheck: false
            }
        },
        computed: {
            isError() {
                if(this.needCheck) {
                    return !(this.firstName && this.lastName && this.birthday);
                }
                return false;
            }
        },
        methods: {
            edit() {
                this.needCheck = true;
                if(!this.isError) {
                    const body = {
                        firstName: this.firstName,
                        lastName: this.lastName,
                        birthday: new Date(this.birthday).valueOf() / 1000,
                        hometown: this.hometown,
                        language: this.language
                    };
                    fetch(
                        '//localhost/medium/api/user/edit.php?id='+localStorage.getItem('id'), 
                        {
                            method: 'put',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(body)
                        }
                    ).then(res => res.json()).then(res => {
                        console.log(res);
                        if(res.res === true) {
                            this.$router.push('/profile');
                        }
                    });
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    .edit {
        width: 70%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        .error {
            width: 50%;
            background-color: #ffeef0;
            border: 1px solid #f97583;
            border-radius: 6px;
            margin: 0 0 15px;
            padding: 10px 0;
                
            > span {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 13px;
                text-align: center;
                padding: 5px 0;
            }
        }

        .column {
            width: 50%;
            box-sizing: border-box;
            border-radius: 4px;
            padding: 1rem;
            box-shadow: 0 0 4px 1px lightgrey;

            h1 {
                margin: 0;
                padding: 0;
                text-align: center;
                font-weight: 300;
                margin-bottom: 15px;
            }

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

                    &:active {
                        outline: none;
                        transition: box-shadow .15s;
                        box-shadow: 0px 0px 4px 2px #5aa0f1;
                    }

                    &:focus {
                        outline: none;
                    }
                }
            }
        }
    }
</style>