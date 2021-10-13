<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Products Reviews</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item">Dashboard</li>
        <li class="admin-breadcrumb-item active">Products Revies</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa fa-star mr-1" aria-hidden="true"></i>
          Reviews
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
                'alert-success': success,
              }"
              v-if="showMsg"
            >
              {{ message }}
            </div>
          </transition>
          <div class="table-responsive">
            <div class="col-sm-12" v-show="reviews.length === 0">
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4 style="color: rgb(186, 147, 62)" class="card-title">
                      Oops!! No Reviews Available!!
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
              v-if="reviews.length !== 0"
            >
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Review</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(review, index) in reviews" :key="index">
                  <td>{{ index + 1 }}</td>
                  <td>
                    {{ review.names }} <br />
                    <small
                      ><u
                        ><a
                          href="#"
                          data-toggle="modal"
                          :data-target="`#details_modal_${review.id}`"
                          >More details</a
                        ></u
                      ></small
                    >
                  </td>
                  <td>{{ review.email }}</td>
                  <td>
                    <span v-show="!(toEdit == review.id)">{{
                      review.review
                    }}</span>
                    <textarea
                      class="form-control"
                      type="text"
                      v-model="review_content"
                      v-show="toEdit == review.id"
                      rows="1"
                    ></textarea>
                  </td>
                  <td
                    :class="
                      review.status === 'Approved'
                        ? 'text-success'
                        : 'text-warning'
                    "
                  >
                    {{ review.status }}
                  </td>
                  <td>
                    <button
                      class="btn btn-info btn-sm"
                      @click.prevent="editReview(review.id)"
                    >
                      <i class="fa fa-edit"></i>
                    </button>
                    <button
                      class="btn btn-success btn-sm"
                      v-show="toEdit == review.id"
                      @click.prevent="updateReview(review.id)"
                    >
                      <i class="fa fa-save"></i>
                    </button>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="deleteReview(review.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>

                    <button
                      v-if="review.status != 'Approved'"
                      class="btn btn-primary btn-sm"
                      @click.prevent="publishReview(review.id, 'Approved')"
                    >
                      <i class="fa fa-paper-plane"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div v-for="review in reviews" :key="review.id">
      <div
        class="modal fade"
        tabindex="-1"
        role="dialog"
        :id="`details_modal_${review.id}`"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">
                Review details
                <br />
                <small style="font-size:12px;"
                  ><timeago :datetime="review.date" :auto-update="60"></timeago
                ></small>
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
                <li class="list-group-item">
                  <b class="text-primary">Product: </b>{{ review.product_name }}
                </li>
                <li class="list-group-item">
                  <b class="text-primary">Creator: </b>{{ review.artist_name }}
                </li>
                <li class="list-group-item">
                  <b class="text-primary">Client names: </b>{{ review.names }}
                </li>
                <li class="list-group-item">
                  <b class="text-primary">Client email: </b>{{ review.email }}
                </li>
                <li class="list-group-item">
                  <b class="text-info">Review: </b>{{ review.review }}
                </li>
              </ul>
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
  name: "ViewReviewsContainer",
  data() {
    return {
      review_content: "product review",
      edit: false,
      success: false,
      message: "",
      showMsg: false,
      toEdit: 0,
      loading: false,
      baseUrl: "",
      review: "None",
    };
  },
  computed: {
    ...mapState("products", ["tags"]),
    ...mapState({
      tags: (state) => state.products.tags,
      reviews: (state) => state.products.allReviews,
    }),
  },
  mounted() {
    this.generateBaseUrl();
    this.loadReviews();
  },
  methods: {
    ...mapActions("products", ["get_all_reviews"]),

    loadReviews() {
      this.get_all_reviews();
    },

    loadProduct() {
      this.get_products();
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
    editReview(id) {
      console.log("id", id);
      let review = JSON.parse(
        JSON.stringify(this.reviews.filter((i) => i.id === id))
      );
      console.log("reviews", this.reviews);
      console.log("review", review);
      this.review_content = review[0].review;
      if (this.toEdit == id) {
        this.toEdit = 0;
        this.edit = false;
      } else {
        this.toEdit = id;
        this.edit = true;
      }
      this.showMsg = false;
    },
    updateReview(id) {
      this.showMsg = false;
      this.loading = true;
      let review = JSON.parse(
        JSON.stringify(this.reviews.filter((i) => i.id === id))
      );
      review[0].review = this.review_content;
      this.$store
        .dispatch("products/update_product_review", review[0])
        .then((response) => {
          console.log("responsee", response);
          this.loadReviews();
          this.loading = false;
          this.edit = false;
          this.toEdit = 0;
          this.success = true;
          this.message = "Changes saved successfully!!";
          this.showMsg = true;
          this.scrollTop();
          setTimeout(() => {
            this.message = "";
            this.showMsg = false;
          }, 3000);
        })
        .catch((error) => {
          this.loading = false;
          this.success = false;
          this.message = `${error.response.data.message}`;
          this.showMsg = true;
        });
    },
    publishReview(id, approve) {
      this.showMsg = false;
      this.loading = true;
      let review = JSON.parse(
        JSON.stringify(this.reviews.filter((i) => i.id === id))
      );
      review[0].review = this.review_content;
      review[0].status = approve;
      this.$store
        .dispatch("products/update_product_review", review[0])
        .then((response) => {
          console.log("responsee", response);
          this.loadReviews();
          this.loading = false;
          this.edit = false;
          this.toEdit = 0;
          this.success = true;
          this.message = "Changes saved successfully!!";
          this.showMsg = true;
          this.scrollTop();
          setTimeout(() => {
            this.message = "";
            this.showMsg = false;
          }, 3000);
        })
        .catch((error) => {
          this.loading = false;
          this.success = false;
          this.message =
            "<p><strong>" + error.response.data.message + "</strong></p>";
          error.response.data.errors.name.forEach((element) => {
            console.log(element);
            this.message += "<p>" + element + "</p>";
          });
          this.showMsg = true;
        });
    },
    deleteReview(id) {
      let r = confirm("Are you sure you want to delete this review?");
      if (r) {
        this.$store.dispatch("products/remove_product_review", id);
        this.loadReviews();
      }
    },
  },
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
