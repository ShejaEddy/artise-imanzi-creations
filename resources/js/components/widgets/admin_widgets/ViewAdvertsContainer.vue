<template>
    <div class="container-fluid pb-5">
        <h1 class="mt-4">View Adverts</h1>
        <ol class="admin-breadcrumb mb-4">
            <li class="admin-breadcrumb-item">Dashboard</li>
            <li class="admin-breadcrumb-item active">View Adverts</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <h4>View Advert</h4>
            </div>
            <div class="card-body">
                <div v-if="adverts.length === 0" class="container">
                    <center>
                        <h4 style="color: rgb(186, 147, 62)" class="card-title">
                            Oops!! No Advert Available!!
                        </h4>
                    </center>
                </div>

                <div v-else class="container">
                    <div v-for="advert in adverts" :key="advert.id" class="row">
                        <div class="col-md-6">
                            <div
                                style="border:1px solid #bbb; padding: 10px; margin-top:10px; border-radius: 8px;"
                                class="left_advert_preview"
                            >
                                <img
                                    class="image_preview"
                                    :src="
                                        `${baseUrl}/uploads/images/${advert.left_advert}`
                                    "
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div
                                style="border:1px solid #bbb; padding: 10px; margin-top:10px; border-radius: 8px;"
                                class="right_advert_preview"
                            >
                                <img
                                    class="image_preview"
                                    :src="
                                        `${baseUrl}/uploads/images/${advert.right_advert}`
                                    "
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "ViewAdvertsContainer",
    data() {
        return {
            baseUrl: ""
        };
    },
    computed: {
        ...mapState({
            adverts: state => state.products.adverts
        })
    },
    mounted() {
        this.generateBaseUrl();
        this.loadAdverts();
    },
    methods: {
        ...mapActions("products", ["get_adverts"]),

        loadAdverts() {
            this.get_adverts();
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        scrollTop() {
            this.intervalId = setInterval(() => {
                if (window.pageYOffset == 0) {
                    clearInterval(this.intervalId);
                }
                window.scroll(0, window.pageYOffset - 50);
            }, 20);
        }
    }
};
</script>
<style scoped>
.slide-fade-enter-active {
    transition: all 0.8s ease;
}
.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
.fade-enter-active {
    transition: all 0.5s ease;
}
.fade-leave-active {
    transition: all 0s cubic-bezier(1, 0, 0, 1);
}
.fade-enter,
.fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
</style>
