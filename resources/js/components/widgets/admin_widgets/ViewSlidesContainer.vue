<template>
    <!--MainContainer-->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">View Slides</h1>
            <ol class="admin-breadcrumb mb-4">
                <li class="admin-breadcrumb-item">Dashboard</li>
                <li class="admin-breadcrumb-item active">View Slides</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-columns mr-1" aria-hidden="true"></i>
                    All Slides
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-sm-12" v-show="slides.length === 0">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4
                                            style="color: rgb(186, 147, 62)"
                                            class="card-title"
                                        >
                                            Oops!! No Slides Available!!
                                        </h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <table
                            class="table table-bordered table-striped table-hover"
                            id="dataTable"
                            width="50%"
                            cellspacing="0"
                            v-if="slides.length !== 0"
                        >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(slide, index) in slides"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td class="text-center">
                                        <img
                                            style="background:white;"
                                            :src="
                                                `${baseUrl}/storage/${slide.slide_image}`
                                            "
                                            class="img-thumbnail"
                                            width="100"
                                            alt="Cinque Terre"
                                        />
                                    </td>
                                    <td>{{ slide.slide_order }}</td>
                                    <td
                                        :class="
                                            slide.status === 'show'
                                                ? 'text-success'
                                                : 'text-warning'
                                        "
                                    >
                                        {{ slide.status }}
                                    </td>
                                    <td>
                                        <router-link
                                            :to="{
                                                name: 'AdminEditSlide',
                                                params: { id: slide.id }
                                            }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </router-link>
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click.prevent="
                                                deleteSlide(slide.id)
                                            "
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--MainContainer--END-->
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "ViewSlidesContainer",
    data() {
        return {
            baseUrl: "",
            review_content: ""
        };
    },
    computed: {
        ...mapState({
            slides: state => state.products.slides
        })
    },
    mounted() {
        this.generateBaseUrl();
        this.loadSlides();
    },
    methods: {
        ...mapActions("products", ["get_slides"]),

        loadSlides() {
            this.get_slides();
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
        },
        deleteSlide(id) {
            let r = confirm("Are you sure you want to delete this slide?");
            if (r) {
                this.$store.dispatch("products/remove_slide", id);
                this.loadSlides();
            }
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
