<template>
    <div class="card-body">
        <div class="row">
            <div style="padding: 2%;" class="col-md-3" v-for="(image,index) in imageList">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top"
                         :src="image.path"
                         alt="Card image cap">
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "ImageList",
    data() {
        return {
            imageList: []
        }
    },
    methods: {
        getImages() {
            axios.get('/api/v1/images')
                .then(({data}) => {
                    this.imageList = data.data;
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    mounted() {
        this.getImages();
    }
}
</script>

<style scoped>

</style>
