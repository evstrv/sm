<template>  
    <div class="home">
        <div class="create">
            <form action="">
                <div class="area">
                    <textarea placeholder="What's new?" v-model="textarea"></textarea>
                </div>
                <div class="functions">
                    <button @click="send">Send</button>
                </div>
            </form>
        </div>
        <div class="posts">
            <div>
                <div class="item" v-for="(item, id) in posts" :key="`posts_item_${id}`">
                    <div class="author">
                        <div>
                            <img :src="item.avatar || noImage" alt=""/>
                            <span>{{ item.firstName }} {{ item.lastName }}</span>
                        </div>
                        <span>{{ item.time }}</span>
                    </div>
                    <div class="text">
                        <span>{{ item.text }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {
                textarea: '',
                userId: localStorage.getItem('id'),
                noImage: '//localhost/medium/src/assets/user.png',
                needCheck: false,
                posts: []
            }
        },
        computed: {
            isError() {
                if(this.needCheck) {
                    return !(this.textarea);
                }
                return false;
            }
        },
        methods: {
            send() {
                this.needCheck = true;
                if(!this.isError) {
                    const body = {
                        textarea: this.textarea,
                        userId: this.userId
                    };
                    fetch(
                        '//localhost/medium/api/posts.php',
                        {
                            method: 'put',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(body)
                        }
                    ).then(res => res.json()).then(res => {
                        console.log(res);
                        this.textarea = '';
                    });
                }
            }
        },
        mounted() {
            fetch(
                '//localhost/medium/api/posts.php',
                {
                    method: 'get',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            ).then(res => res.json()).then(res => {
                console.log(res);
                this.posts = res.posts || [];
            });
        }
    }
</script>

<style lang="scss" scoped>
    .home {
        width: 50%;
        margin: 0 auto;
        display: flex;
        flex-direction: column;

        .create {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            box-sizing: border-box;
            border-radius: 4px;
            padding: 1rem;
            box-shadow: 0 0 4px 1px lightgrey;
            margin-bottom: 1rem;

            form {
                width: 100%;
                display: flex;
                flex-direction: column;

                .area {
                    display: flex;
                    margin-bottom: 10px;

                    textarea {
                        width: 100%;
                        height: 80px;
                        padding: 10px;
                        resize: none;
                        font-size: 1rem;
                        border: 1px solid lightgrey;
                        border-radius: 6px;

                        &:focus {
                            outline: none;
                            box-shadow: 0px 0px 4px 1px rgba(141,174,240,1);
                        }
                    }
                }

                .functions {
                    display: flex;
                    justify-content: space-between;

                    button {
                        padding: .2rem 2rem;
                        border: none;
                        border-radius: 6px;
                        font-size: .9rem;
                        background-color: #1074e7;
                        color: white;
                        font-weight: 500;
                        line-height: 20px;
                        transition: .3s;
                        margin-left: auto;

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

        .posts {
            width: 100%;
            height: auto;

            .item {
                width: 100%;
                height: auto;
                display: flex;
                flex-direction: column;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 1rem;
                box-shadow: 0 0 4px 1px lightgrey;
                margin-bottom: 1rem;

                .author {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 1rem;
                    padding-bottom: 1rem;
                    border-bottom: 1px solid lightgrey;

                    div {
                        display: flex;
                        justify-content: center;
                        align-items: center;

                        img {
                            width: 45px;
                            height: 45px;
                            object-fit: cover;
                            border-radius: 50%;
                        }

                        span {
                            margin-left: 10px;
                            font-weight: 500;
                            font-size: 1rem;
                        }
                    }
                }

                .text {
                    
                }
            }
        }
    }
</style>