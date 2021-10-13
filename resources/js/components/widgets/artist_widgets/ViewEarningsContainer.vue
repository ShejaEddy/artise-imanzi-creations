<template>
    <!--MainContainer-->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Earnings</h1>
            <ol class="admin-breadcrumb mb-4">
                <li class="admin-breadcrumb-item active">All Earnings</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa fa-credit-card mr-1" aria-hidden="true"></i>
                    Earmings
                </div>
                <div v-show="earnings.length !== 0" class="col-md-12 col-sm-12">
                    <div
                        class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 mt-4 p-4"
                    >
                        <line-chart
                            :chart-data="chartdataLinear"
                            :options="options"
                        />
                    </div>
                </div>
                <div class="card-body">
                    <transition name="fade">
                        <div
                            class="spinner-border text-primary"
                            role="status"
                            v-show="loading"
                        >
                            <span class="sr-only">Loading...</span>
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div
                            class="alert"
                            :class="{
                                'alert-danger': !success,
                                'alert-success': success
                            }"
                            v-if="showMsg"
                        >
                            {{ message }}
                        </div>
                    </transition>
                    <div class="table-responsive">
                        <div class="col-sm-12" v-show="earnings.length === 0">
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4
                                            style="color: rgb(186, 147, 62)"
                                            class="card-title"
                                        >
                                            Oops!! No Earmings Available!!
                                        </h4>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <table
                            style="font-size: 14px;"
                            class="table table-bordered table-striped table-hover"
                            id="dataTable"
                            width="50%"
                            cellspacing="0"
                            v-if="earnings.length !== 0"
                        >
                            <thead>
                                <tr>
                                    <th>RefNo</th>
                                    <th>transaction Id</th>
                                    <th>Client name</th>
                                    <th>Client email</th>
                                    <th>Client telephone</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(earning, index) in earnings"
                                    :key="index"
                                >
                                    <td>{{ earning.refNo }} <br /></td>
                                    <td>{{ earning.transaction_id }}</td>
                                    <td>{{ earning.names }}</td>
                                    <td>{{ earning.email }}</td>
                                    <td>{{ earning.phone }}</td>
                                    <td>
                                        {{ earning.amount }}
                                        {{ earning.currency }}
                                    </td>

                                    <td
                                        :class="
                                            earning.status === 'successful'
                                                ? 'text-success'
                                                : 'text-warning'
                                        "
                                    >
                                        {{ earning.status }}
                                    </td>
                                    <td>
                                        {{
                                            earning.date
                                                | moment("ddd, MMM Do YYYY")
                                        }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div v-for="earning in earnings" :key="earning.id">
       <div
                  class="modal fade"
                  tabindex="-1"
                  role="dialog"
                  :id="`details_modal_${earning.id}`"
                  aria-labelledby="myLargeModalLabel"
                  aria-hidden="true"
               >
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">
                              Review details
                              <br>
                              <small style="font-size:12px;"><timeago :datetime="earning.date" :auto-update="60" ></timeago></small>
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
                        <div class="modal-body">
                          <ul class="list-group">
                           <li class="list-group-item"><b class="text-primary">Product: </b>{{review.product_name}}</li>
                           <li class="list-group-item"><b class="text-primary">Creator: </b>{{review.artist_name}}</li>
                           <li class="list-group-item"><b class="text-primary">Client names: </b>{{review.names}}</li>
                           <li class="list-group-item"><b class="text-primary">Client email: </b>{{review.email}}</li>
                           <li class="list-group-item"><b class="text-info">Review: </b>{{review.review}}</li>
                           </ul>
                        </div>
                     </div>
                  </div>
       </div>
      </div> -->
    </main>
    <!--MainContainer--END-->
</template>

<script>
import { mapState, mapActions } from "vuex";
import LineChart from "./linear";
export default {
    name: "ViewEarningsContainer",
    components: { LineChart },
    data() {
        return {
            earnings: "",
            edit: false,
            success: false,
            message: "",
            showMsg: false,
            toEdit: 0,
            loading: false,
            baseUrl: "",
            review: "None",
            allData: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            label: "Random",
            loaded: false,
            labels: [],
            colors: ["#FBAD02"],
            months: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            chartdataLinear: null,
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ],
                    xAxes: [
                        {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        };
    },
    mounted() {
        this.generateBaseUrl();
        this.loadEarnings();
    },
    methods: {
        loadEarnings() {
            this.$store
                .dispatch("products/get_my_earnings")
                .then(response => {
                    this.loading = false;
                    this.earnings = response;
                    this.parseData("Yearly", response);
                    this.$forceUpdate();
                })
                .catch(error => {
                    console.log(error);
                });
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
        //feeding fees data to the chart
        parseData(type, data) {
            if (type == "Yearly") {
                var crtMonth = 0;
                var total = 0;
                this.allData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                //creating totaled earnings of each month
                $.each(data, (k, v) => {
                    var date = v.date.split("-");
                    var month = date[1];
                    if (crtMonth == 0) {
                        crtMonth = month;
                        total += parseFloat(v.amount);
                    } else if (crtMonth == month) {
                        total += parseFloat(v.amount);
                    } else {
                        var index = parseInt(crtMonth) - 1;
                        this.allData[index] = total;
                        total = 0;
                        crtMonth = month;
                        total += parseFloat(v.amount);
                    }
                    var index = parseInt(crtMonth) - 1;
                    this.allData[index] = total;
                    //    total = 0;
                    //    crtMonth = 0;
                });

                this.label = "Earnings";
                this.loaded = true;
            }
            this.chartdataLinear = {
                labels: this.months,
                datasets: [
                    {
                        label: this.label,
                        backgroundColor: this.colors,
                        data: this.allData
                    }
                ]
            };
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
