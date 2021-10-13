<template>
    <!--MainContainer-->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Search Results</h1>
            <ol class="admin-breadcrumb mb-4">
                <li class="admin-breadcrumb-item active">Dashboard</li>
                <li class="admin-breadcrumb-item">search results</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-search mr-1" aria-hidden="true"></i>
                    Searched data
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table
                            style="font-size: 14px;"
                            class="table table-bordered table-striped table-hover"
                            id="dataTable"
                            width="100%"
                            cellspacing="0"
                            v-if="orders.length !== 0"
                        >
                            <thead>
                                <tr>
                                    <th>REF No</th>
                                    <th>Amount</th>
                                    <th>Names</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Completed</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody v-if="orders.length > 0">
                                <tr v-for="order in orders" :key="order.id">
                                    <td>
                                        <a
                                            href="#"
                                            data-toggle="modal"
                                            data-target=".bd-example-modal-lg"
                                            @click="view(order.id)"
                                            >{{ order.refNo }}</a
                                        >
                                    </td>
                                    <td>RWF {{ order.amount }}</td>
                                    <td>{{ order.names }}</td>
                                    <td>{{ order.phone }}</td>
                                    <td>{{ order.email }}</td>
                                    <td>
                                        <span
                                            v-if="order.orderCompleted == 'Yes'"
                                            class="badge badge-success"
                                            >Yes</span
                                        >
                                        <span v-else class="badge badge-warning"
                                            >No</span
                                        >
                                    </td>
                                    <td>
                                        {{
                                            order.created_at
                                                | moment("ddd, MMM Do YYYY")
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-12" v-else>
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4
                                            style="color: rgb(186, 147, 62)"
                                            class="card-title"
                                        >
                                            Oops!! No data found.
                                        </h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="modal fade bd-example-modal-lg"
                        tabindex="-1"
                        role="dialog"
                        aria-labelledby="myLargeModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" v-if="toView[0]">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                        id="exampleModalLongTitle"
                                    >
                                        REF: {{ toView[0].refNo }}
                                    </h5>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" v-if="detail">
                                    <p v-for="d in detail" :key="d.id">
                                        <strong>Product: </strong
                                        >{{ d.product }}&nbsp;&nbsp;
                                        <strong>Quantity: </strong
                                        >{{ d.quantity }}Items&nbsp;&nbsp;
                                        <strong>Price: </strong
                                        >{{ d.price }} RWF &nbsp;&nbsp;
                                        <strong>Total: </strong
                                        >{{ d.price * d.quantity }} RWF
                                        &nbsp;&nbsp;
                                    </p>
                                    <hr />
                                </div>
                            </div>
                        </div>
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
    name: "SearchResultContainer",
    data() {
        return {
            toView: {},
            detail: {}
        };
    },
    mounted() {
        this.loadProduct();
        this.loadUsers();
    },
    computed: {
        ...mapState({
            users: state => state.users.users,
            user: state => state.users.userInfo,
            products: state => state.products.AllProducts
        }),
        ...mapState("users", ["orders", "orderDetails"])
    },
    methods: {
        ...mapActions("products", ["get_products"]),
        ...mapActions("users", ["getUsers"]),

        loadUsers() {
            this.getUsers();
        },
        loadProduct() {
            this.get_products();
        },
        view(id) {
            this.toView = this.orders.filter(o => o.id == id);
            this.detail = this.orderDetails.filter(d => d.orderId == id);
        }
    }
    // watch: {
    //    orders(response) {
    //       this.orders = orders;
    //    },
    // },
};
</script>
