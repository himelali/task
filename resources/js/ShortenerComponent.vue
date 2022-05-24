<template>
    <div class="d-block">
        <form method="POST" v-on:submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="url">Original URL</label>
                <input type="text" required :disabled="loading" class="form-control" v-model="url" maxlength="200" placeholder="Write valid url"
                       :class="errors.hasOwnProperty('url') ? 'is-invalid' : null">
                <div v-if="errors.hasOwnProperty('url')" class="invalid-feedback">
                    {{ errors.url[0] }}
                </div>
            </div>
            <button type="submit" :disabled="loading" class="btn btn-primary">
                <span v-if="!loading">Submit</span>
                <span v-else>Submitting...</span>
            </button>
        </form>
        <div v-if="response.message" class="alert alert-primary mt-3 text-center" role="alert">
            {{ response.message }}<br><br>
            <code class="text-center" v-if="response.short_url">
                Original URL:  <a :href="response.original_url" class="font-weight-bold" target="_blank">{{ response.original_url }}</a><br><br>
                Shortener URL: <a :href="response.short_url" class="font-weight-bold" target="_blank">{{ response.short_url }}</a>
            </code>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ShortenerComponent',
    data() {
        return {
            errors: {},
            loading: false,
            url: '',
            response: {
                message: '',
                short_url: '',
                original_url: '',
            }
        }
    },
    methods: {
        onSubmit(e) {
            e.preventDefault();
            let _this = this;
            _this.errors = {};
            _this.response = {
                message: '',
                short_url: '',
                original_url: ''
            };
            _this.loading = true;
            axios.post('/', {url: _this.url}).then((res) => {
                _this.loading = false;
                _this.response = res.data;
                _this.url = '';
            }).catch((err) => {
                _this.loading = false;
                if(err.response && err.response.data) {
                    this.errors = err.response.data.errors ? err.response.data.errors : {};
                }
            });
        }
    }
}
</script>

<style scoped>

</style>
