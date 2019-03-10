<template>
    <div id="app" class="text-center">
        <form @submit.prevent="checkUrl()" class="form-signin">
            <img class="mb-4" src="/src/assets/logo2.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">HTTP/2 Test Verify </h1>

            <div class="mb-4">
                <label class="sr-only">URL</label>
                <input type="text" name="url" v-model="url" class="form-control" placeholder="URL" required autofocus>
            </div>

            <div v-if="result" class="text-center alert  mb-4" :class="{
                'alert-success': result.success,
                'alert-danger': ! result.success
            }">
                {{ result.message }}
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Test</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'app',
        data() {
            return {
                url: '',
                result: ''
            }
        },
        methods: {
            checkUrl() {
                this.result = '';

                axios.get('/api.php?url=' + this.url)
                    .then(response => {
                        this.result = response.data;

                        // this.result = response.data;
                    }).catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>

<style lang="scss">

    html,
    body,
    #app {
        height: 100%;
    }

    #app {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }

    .form-signin .checkbox {
        font-weight: 400;
    }

    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }

    .form-signin .form-control:focus {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
