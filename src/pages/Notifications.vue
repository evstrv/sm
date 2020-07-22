<template>
    <div class="notifications">
        <div class="item" v-for="(item, id) in notifications" :key="`notice_${id}`">
            <div>
                <span v-if="item.type === 'ADD_FRIEND'">Вас хотят добавить в друзья</span>
            </div>
            <div v-if="item.type === 'ADD_FRIEND'">
                <button @click="acceptFriend(id)">Accept</button>
                <button @click="removeNotice(id)">Decline</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Notifications',
        data() {
            return {
                notifications: []
            }
        },
        methods: {
            acceptFriend(id) {
                fetch(
                    `//localhost/medium/api/users/followers.php`,
                    {
                        method: 'post',
                        headers: {
                        'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            userId: this.notifications[id].userId,
                            friendId: this.notifications[id].otherId
                        })
                    }
                ).then(res => res.json()).then(() => {
                    this.removeNotice(id);
                });
            },
            removeNotice(id) {
                fetch(
                    `//localhost/medium/api/notification.php?id=${this.notifications[id].id}`,
                    {
                        method: 'delete',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }
                ).then(res => res.json()).then(() => {
                    this.notifications.splice(id, 1);
                });
            }
        },
        mounted() {
            fetch(
                `//localhost/medium/api/notification.php?id=${localStorage.getItem('id')}`,
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => res.json()).then(res => {
                this.notifications = res.notifications || [];
            });
        }
    }
</script>

<style lang="scss" scoped>
    .notifications {
        width: 70%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            box-shadow: 0 0 4px 1px lightgrey;
            border-radius: 4px;
            padding: 1rem;

            &:not(:first-child) {
                margin-top: 1rem;
            }

            div {
                &:first-child {
                    span {
                        font-size: 1.1rem;
                        font-weight: 300;
                    }
                }

                &:last-child {
                    button {
                            padding: .3rem 2.5rem;
                            border: none;
                            border-radius: 6px;
                            font-size: 1rem;
                            background-color: #1074e7;
                            color: white;
                            font-weight: 500;
                            line-height: 20px;
                            transition: .3s;

                            &:not(:last-child) {
                                margin-right: 1rem;
                            }

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