<template>
    <div class="user">
        <div class="column-1">
            <div class="avatar">
                <label>
                    <img :src="user.avatar || noImage" :alt="user.username">
                </label>
            </div>
            <div class="followers">
                <span>Followers</span>
                <div>
                    <div class="item" v-for="(item, id) in users" :key="`user_item_${id}`">
                        <div class="img">
                            <img :src="item.avatar || noImage" :alt="item.username">
                            <span>{{ item.firstName }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column-2">
            <div class="about">
                <h1>{{ user.firstName }} {{ user.lastName }}</h1>
                <div>
                    <div>
                        <h3>Birthday:</h3>
                        <span>{{ this.birthday }}</span>
                    </div>
                    <div v-show="user.hometown">
                        <h3>Hometown:</h3>
                        <span>{{ user.hometown }}</span>
                    </div>
                    <div v-show="user.language">
                        <h3>Language:</h3>
                        <span>{{ user.language }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'User',
        data() {
            return {
                user: {},
                birthday: '',
                noImage: require('../assets/user.png'),
                users: {}
            }
        },
        mounted() {
            fetch(
                `//localhost/medium/api/user/user.php?id=${this.$route.params.id}`,
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => res.json()).then(res => {
                this.user = res.user;

                const date = new Date(+res.user.birthday * 1000);
                const month = '' + (date.getMonth() + 1);
                const day = '' + date.getDate();
                let strDate = (day.length < 2 ? '0' + day : day) + '.' + (month.length < 2 ? '0' + month : month) + '.' + date.getFullYear();
                
                this.birthday = strDate;
                console.log(this.user);
            });

            fetch(
                `//localhost/medium/api/user/followers.php?id=${this.$route.params.id}`, 
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => res.json()).then(res => {
                console.log(res);
                this.users = res.users || [];
            });
        }
    }
</script>

<style lang="scss" scoped>
    .user {
        width: 70%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;

        .column-1 {
            width: 25%;
            display: flex;
            flex-direction: column;

            .avatar {
                height: auto;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 1rem;
                margin-right: 1rem;
                box-shadow: 0 0 4px 1px lightgrey;
                margin-bottom: 1rem;

                label {
                    width: auto;
                    height: auto;
                    overflow: hidden;
                    position: relative;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin: auto 0;
                    border-radius: 4px;
                    box-shadow: 0 0 8px 2px lightgrey;
                    background-color: white;

                    img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }

            .followers {
                height: auto;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 1rem;
                margin-right: 1rem;
                box-shadow: 0 0 4px 1px lightgrey;

                > span {
                    font-size: 1rem;
                    font-weight: 300;
                    margin-bottom: 11px;
                    padding-bottom: 10px;
                    border-bottom: 1px solid lightgrey;
                }

                > div {
                    display: flex;
                    justify-content: space-evenly;
                    align-items: center;
                    flex-wrap: wrap;

                    .item {
                        margin: 5px;
                        width: 25%;
                        
                        .img {
                            display: flex;
                            flex-direction: column;
                            align-items: center;

                            img {
                                width: 50px;
                                height: 50px;
                                border-radius: 50%;
                                object-fit: cover;
                            }

                            span {
                                font-size: 1rem;
                                font-weight: 300;
                            }
                        }
                    }
                }
            }
        }

        .column-2 {
            width: 75%;
            display: flex;
            flex-direction: column;

            .about {
                height: auto;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 1rem;
                box-shadow: 0 0 4px 1px lightgrey;

                h1 {
                    margin: 0;
                    padding: 0;
                    font-size: 1.5rem;
                    font-weight: 300;
                    margin-bottom: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid lightgrey;
                }

                > div {
                    // margin-bottom: 1rem;
                    // padding-bottom: 1rem;
                    // border-bottom: 1px solid lightgrey;

                    > div {
                        display: flex;
                        align-items: center;
                        
                        &:not(:first-child) {
                            margin-top: 10px;
                        }

                        h3 {
                            width: 30%;
                            margin: 0;
                            padding: 0;
                            font-size: 1.1rem;
                            font-weight: 300;
                        }

                        span {
                            font-size: 1.1rem;
                            font-weight: 500;
                        }
                    }
                }
            }

            .edit {
                box-sizing: border-box;
                border-radius: 4px;
                padding: 1rem;
                margin-right: 1rem;
                margin-bottom: 1rem;
                box-shadow: 0 0 4px 1px lightgrey;

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
    }
</style>