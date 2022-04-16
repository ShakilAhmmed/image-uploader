<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <router-link :to="{ name : 'add-image'}" class="btn btn-primary">
                                    Add More
                                </router-link>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-2">
                                <button class="btn btn-danger float-end" @click="logout">
                                    <b>Logout</b>
                                </button>
                            </div>
                        </div>
                    </div>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "dashboard",
    data() {
        return {
            user: this.$store.state.auth.user
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('/api/v1/auth/logout').then(({data}) => {
                this.signOut()
                this.$router.push({name: "login"})
            })
        }
    },
    mounted() {

    }
}
</script>
