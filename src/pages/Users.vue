<template>
    <div class="followers">
        <div class="search">
            <form action="">
                <input type="text" placeholder="Search" v-model="search">
                <button @click="find">Find</button>
            </form>
        </div>
        <div class="user-list">
            <div class="item" v-for="(item, id) in users" :key="`user_item_${id}`">
                <div class="img">
                    <img :src="item.avatar || noImage" :alt="item.username">
                </div>
                <div class="info">
                    <div class="name" @click="$router.push(`/users/${item.id}`)">{{ item.firstName }} {{item.lastName}}<span v-if="item.id === userId">It's you</span></div>
                    <div class="add" v-if="item.id !== userId">
                        <button @click="submitRequestFriend(item.id)" v-if="!requests[item.id]">Follow</button>
                        <button v-else-if="requests[item.id]" @click="removeRequest(requests[item.id], item.id)">Unfollow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Users',
        data() {
            return {
                search: '',
                users: [],
                noImage: '//localhost/medium/src/assets/user.png',
                userId: localStorage.getItem('id'),
                requests: {}
            }
        },
        methods: {
            find() {
                fetch(
                    '//localhost/medium/api/users/search.php',
                    {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            search: this.search
                        })
                    }
                ).then(res => res.json()).then(res => {
                    console.log(res);
                    this.users = res.users || [];
                    this.search = '';
                });
            },
            submitRequestFriend(friendId){
                fetch(
                    '//localhost/medium/api/notification.php',
                    {
                        method: 'post',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            userId: this.userId,
                            otherId: friendId,
                            type: 'ADD_FRIEND'
                        })
                    }
                ).then(res => res.json()).then(res => {
                    const requests = {...this.requests};
                    requests[friendId] = res.id;
                    this.requests = {...requests};
                });  
            },
            removeRequest(notificationId, friendId){
                fetch(
                    `//localhost/medium/api/notification.php?id=${notificationId}`,
                    {
                        method: 'delete',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }
                ).then(res => res.json()).then(res => {
                    if(res.res){
                        const requests = {...this.requests};
                        delete requests[friendId];
                        this.requests = {...requests};
                    }
                });
            }
        },
        mounted() {
            fetch(
                '//localhost/medium/api/users/users.php',
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => res.json()).then(res => {
                console.log(res);
                this.users = res.users || [];
                this.requests = res.requests || {};
            });
        }
    }
</script>

<style lang="scss" scoped>
    .followers {
        width: 70%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;

        .search {
            margin-bottom: 1rem;

            form {
                display: flex;
                width: 100%;
                box-sizing: border-box;
                box-shadow: 0 0 4px 1px lightgrey;
                border-radius: 4px;
                padding: 1rem;

                input {
                    width: 100%;
                    padding: 5px 12px;
                    font-size: 14px;
                    border: 1px solid lightgrey;
                    border-radius: 6px;

                    &:focus {
                        outline: none;
                        box-shadow: 0px 0px 4px 1px rgba(141,174,240,1);
                    }
                }

                button {
                    padding: .2rem 2rem;
                    margin-left: 1rem;
                    border: none;
                    border-radius: 6px;
                    font-size: .9rem;
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

        .user-list {
            width: 100%;
            display: flex;
            flex-direction: column;

            .item {
                display: flex;
                width: 100%;
                box-sizing: border-box;
                box-shadow: 0 0 4px 1px lightgrey;
                border-radius: 4px;
                padding: 1rem;

                &:not(:first-child) {
                    margin-top: 1rem;
                }

                .img {
                    min-width: 150px;
                    max-width: 150px;
                    min-height: 150px;
                    max-height: 150px;
                    display: flex;
                    align-items: center;
                    justify-content: center;

                    img {
                        width: auto;
                        max-width: 150px;
                        height: 100%;
                        max-height: 150px;
                        border-radius:50%;
                        object-fit: cover;
                    }
                }

                .info {
                    display: flex;
                    flex-direction: column;
                    margin-left: 2rem;
                    width: 100%;

                    .name {
                        font-size: 1.5rem;
                        font-weight: 300;
                        margin-bottom: 1rem;
                        padding-bottom: 1rem;
                        border-bottom: 1px solid lightgrey;
                        
                        &:hover {
                            cursor: pointer;
                        }
                        
                        span {
                            color: green;
                            font-size: 1rem;
                            margin-left: 1rem;
                            font-weight: 600;
                        }
                    }

                    .add {
                        margin: auto 0 0 auto;

                        button {
                            padding: .3rem 2.5rem;
                            margin-top: 1rem;
                            border: none;
                            border-radius: 6px;
                            font-size: 1rem;
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
    }
</style>