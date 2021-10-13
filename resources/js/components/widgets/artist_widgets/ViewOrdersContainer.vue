<template>
   <!--MainContainer-->
   <main>
      <div class="container-fluid">
         <h1 class="mt-4">Dashboard</h1>
         <ol class="admin-breadcrumb mb-4">
            <li class="admin-breadcrumb-item active">Dashboard</li>
         </ol>
         <div class="row d-none">
            <div class="col-xl-3 col-md-6">
               <div class="card bg-primary text-white mb-4">
                  <div class="card-body">
                     <span
                        ><i
                           style="font-size: 25px; margin-right: 10px"
                           class="fa fa-th-large"
                           aria-hidden="true"
                        ></i></span
                     >Products
                  </div>
                  <div
                     class="card-footer d-flex align-items-center justify-content-between"
                  >
                     <a class="small text-white stretched-link" href="#"
                        >View Details</a
                     >
                     <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="card bg-secondary text-white mb-4">
                  <div class="card-body">
                     <span
                        ><i
                           style="
                              font-size: 25px;
                              margin-right: 10px;
                              color: #FBAD02;
                           "
                           class="fa fa-shopping-basket"
                           aria-hidden="true"
                        ></i></span
                     >Orders
                  </div>
                  <div
                     class="card-footer d-flex align-items-center justify-content-between"
                  >
                     <a class="small text-white stretched-link" href="#"
                        >View Details</a
                     >
                     <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="card bg-primary text-white mb-4">
                  <div class="card-body">
                     <span
                        ><i
                           style="font-size: 25px; margin-right: 10px"
                           class="fa fa-users"
                           aria-hidden="true"
                        ></i></span
                     >Clients
                  </div>
                  <div
                     class="card-footer d-flex align-items-center justify-content-between"
                  >
                     <a class="small text-white stretched-link" href="#"
                        >View Details</a
                     >
                     <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-md-6">
               <div class="card bg-secondary text-white mb-4">
                  <div class="card-body">
                     <span
                        ><i
                           style="
                              font-size: 25px;
                              margin-right: 10px;
                              color: #FBAD02;
                           "
                           class="fas fa-credit-card"
                           aria-hidden="true"
                        ></i></span
                     >Earnings
                  </div>
                  <div
                     class="card-footer d-flex align-items-center justify-content-between"
                  >
                     <a class="small text-white stretched-link" href="#"
                        >View Details</a
                     >
                     <div class="small text-white">
                        <i class="fas fa-angle-right"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row" style="display: none !important">
            <div class="col-xl-6">
               <div class="card mb-4">
                  <div class="card-header">
                     <i class="fas fa-chart-area mr-1"></i>
                     Area Chart Example
                  </div>
                  <div class="card-body">
                     <canvas id="myAreaChart" width="100%" height="40"></canvas>
                  </div>
               </div>
            </div>
            <div class="col-xl-6">
               <div class="card mb-4">
                  <div class="card-header">
                     <i class="fas fa-chart-bar mr-1"></i>
                     Bar Chart Example
                  </div>
                  <div class="card-body">
                     <canvas id="myBarChart" width="100%" height="40"></canvas>
                  </div>
               </div>
            </div>
         </div>
         <div class="card mb-4">
            <div class="card-header">
               <i class="fa fa-shopping-basket mr-1" aria-hidden="true"></i>
               My Orders
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <div
                     style="display: none"
                     class="col-sm-12"
                     v-show="myOrders.length === 0"
                  >
                     <div class="card">
                        <div class="card-body">
                           <center>
                              <h4
                                 style="color: rgb(186, 147, 62)"
                                 class="card-title"
                              >
                                 Oops!! No orders available.
                              </h4>
                           </center>
                        </div>
                     </div>
                  </div>
                  <table
                     style="font-size: 14px;"
                     class="table table-bordered table-striped table-hover"
                     id="dataTable"
                     width="100%"
                     cellspacing="0"
                     v-if="myOrders.length !== 0"
                  >
                     <thead>
                        <tr>
                           <th>REF No</th>
                           <th>Amount</th>
                           <th>Completed</th>
                           <th>Created At</th>
                           <td>Action</td>
                        </tr>
                     </thead>
                     <tbody v-if="myOrders.length > 0">
                        <tr v-for="order in myOrders" :key="order.id">
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
                          <td>
                              <span
                                 v-if="order.orderCompleted == 'Yes'"
                                 class="badge badge-success"
                                 >Yes</span
                              >
                              <span v-else class="badge badge-warning">No</span>
                           </td>
                           <td>{{ order.created_at }}</td>
                           <td>
                              <a
                                 class="badge badge-success"
                                 href=""
                                 @click.prevent="complete(order.id)"
                                 v-if="order.orderCompleted == 'No'"
                              >
                                 Mark as Complete
                              </a>
                              <span v-else class="badge badge-danger">N/A</span>
                           </td>
                        </tr>
                     </tbody>
                  </table>
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
                           <h5 class="modal-title" id="exampleModalLongTitle">
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
                              <strong>Price: </strong>{{ d.price }} RWF
                              &nbsp;&nbsp; <strong>Total: </strong
                              >{{ d.price * d.quantity }} RWF &nbsp;&nbsp;
                              &nbsp;&nbsp; <strong>Confirmation: </strong
                              >{{ d.isConfirmed }} &nbsp;&nbsp;
                           </p>
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
import { mapState } from "vuex";
export default {
   name: "ViewOrderContainer",
   data() {
      return {
         toView: {},
         detail: {},
      };
   },
   computed: {
      ...mapState("users", ["myOrders", "orders", "orderDetails"]),
   },
   methods: {
      view(id) {
         this.toView = this.myOrders.filter((o) => o.id == id);
         this.detail = this.orderDetails.filter((d) => d.orderId == id);
      },
      complete(id) {
         let r = confirm(
            "Are sure to complete this order? This action is irreversible!!!!"
         );
         if (r) {
            this.$store.dispatch("users/orderCompletion", {
               id: id,
               orderCompleted: "Yes",
            });
         }
      },
   },
    watch: {
      orders(response) {
         this.orders = orders;
      },
      orders(response) {
         this.orders = orders;
      },
   },
};
</script>
