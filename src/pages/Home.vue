<template>  
    <div class="home">
        <div class="create">
            <form action="">
                <div class="area">
                    <textarea placeholder="What's new?"></textarea>
                </div>
                <div class="functions">
                    <!-- <label>
                        <img :src="uploadImg" alt="uploadImg">
                        <span></span>
                        <input type="file" @change="upload">
                    </label> -->
                    <button>Send</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        data() {
            return {
                uploadImg: '//localhost/medium/src/assets/picture.png'
            }
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

                    label {
                        display: flex;
                        align-items: center;
                        position: relative;

                        img {
                            width: 25px;
                            height: 25px;
                        }

                        span {
                            display: flex;
                            opacity: 0;
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            align-items: center;
                            justify-content: center;
                            border-radius: 4px;
                            left: 0;
                            top: 0;
                        }

                        input {
                            display: none;
                        }

                        &:hover {
                            cursor: pointer;
                        }
                    }

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
    }
</style>