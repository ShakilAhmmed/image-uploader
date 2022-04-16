<template>
    <div>
        <div class="card-body">
            <form @submit.prevent="downloadImage">
                <div class="row">
                    <div class="col-md-4">
                        <label>URL</label>
                        <input v-model.lazy="image_url" class="form-control"/>
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;</label>
                        <button class="form-control btn btn-success">Submit</button>
                    </div>
                </div>
                <br>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top"
                             :src="imagePreview"
                             alt="Card image cap">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <router-link :to="{ name : 'image-list'}" class="btn btn-info">
                Go Back
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddImage",
    data() {
        return {
            image_url: '',
        }
    },
    computed: {
        imagePreview() {
            if (!this.image_url) {
                return 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1200px-Vue.js_Logo_2.svg.png'
            }
            return this.image_url;
        }
    },
    methods: {
        downloadImage() {
            axios.post('/api/v1/images/download', {
                image_url: this.image_url
            })
                .then((response) => {
                    this.$toastr.success('Image Downloading', 'Success');
                    this.image_url = null;
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>

<style scoped>

</style>
