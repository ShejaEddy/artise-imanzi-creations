<template>
    <!--MainContainer-->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">View Give Away Requests</h1>
            <ol class="admin-breadcrumb mb-4">
                <li class="admin-breadcrumb-item">Dashboard</li>
                <li class="admin-breadcrumb-item active">
                    View Give Away Requests
                </li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-columns mr-1" aria-hidden="true"></i>
                    All Give Away Requests
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-sm-12" v-show="giveAways.length === 0">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4
                                            style="color: rgb(186, 147, 62)"
                                            class="card-title"
                                        >
                                            Oops!! No Give Aways Requests
                                            Available!!
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
                            v-if="giveAways.length !== 0"
                        >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product image</th>
                                    <th>Product Name</th>
                                    <th>Client Names</th>
                                    <th>Phone Contact</th>
                                    <th>Sent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in giveAways"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <img
                                            style="background:white;"
                                            :src="
                                                `${baseUrl}/uploads/images/${item.product.thumbnail}`
                                            "
                                            class="img-thumbnail"
                                            width="45"
                                            alt="Cinque Terre"
                                        />
                                    </td>
                                    <td class="text-center">
                                        {{ item.product.name }}
                                    </td>
                                    <td class="text-center">
                                        {{ item.full_names }}
                                    </td>
                                    <td>{{ item.phone }}</td>
                                    <td
                                        :class="
                                            !!item.sent
                                                ? 'text-success'
                                                : 'text-warning'
                                        "
                                    >
                                        {{ !!item.sent }}
                                    </td>
                                    <td>
                                        <button
                                            v-if="!!item.sent"
                                            class="btn btn-sm shadow"
                                            :class="'btn-danger'"
                                            @click.prevent="
                                                toggleStatus(item.id)
                                            "
                                        >
                                            Not Sent
                                        </button>
                                        <button
                                            v-else
                                            class="btn btn-sm shadow"
                                            :class="'btn-success'"
                                            @click.prevent="
                                                toggleStatus(item.id)
                                            "
                                        >
                                            Sent
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
    name: "ViewgiveAwaysContainer",
    data() {
        return {
            baseUrl: "",
            review_content: ""
        };
    },
    computed: {
        ...mapState({
            giveAways: state => state.products.giveAways
        })
    },
    mounted() {
        this.generateBaseUrl();
        this.loadGiveAways();
    },
    methods: {
        ...mapActions("products", ["get_give_aways"]),

        loadGiveAways() {
            this.get_give_aways();
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
        async toggleStatus(id) {
            await this.$store.dispatch("products/toggleSentGiveAway", id);
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
