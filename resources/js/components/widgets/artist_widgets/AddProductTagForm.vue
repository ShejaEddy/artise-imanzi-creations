<template>
  <div class="container-fluid pb-5">
    <h1 class="mt-4">Add Product Tag</h1>
    <ol class="admin-breadcrumb mb-4">
      <li class="admin-breadcrumb-item">
        <router-link to="/artist/dashboard">Dashboard</router-link>
      </li>
      <li class="admin-breadcrumb-item active">Add Tag</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Add a Tag
      </div>

      <div class="card-body">
        <transition name="slide-fade">
          <div
            class="alert"
            :class="{
              'alert-danger': !success,
              'alert-success': success,
            }"
            v-show="showMsg"
          >
            {{ message }}
          </div>
        </transition>
        <div class="container">
          <form style="padding: 40px 60px" @submit.prevent="addProductTag">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="category">Product Tag: </label>
                <input
                  type="text"
                  class="form-control"
                  id="tag"
                  name="tag"
                  placeholder="Enter tag name"
                  v-model="tag"
                />
              </div>
            </div>

            <button
              type="submit"
              class="btn btn-lg btn-primary col-md-12"
              :disabled="loading"
            >
              Save
              <div
                v-if="loading"
                class="spinner-border text-light ml-3"
                role="status"
              >
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "addProductTagForm",
  data() {
    return {
      tag: "",
      message: "",
      success: "",
      showMsg: false,
      loading: false,
    };
  },
  methods: {
    addProductTag() {
      this.loading = true;
      this.showMsg = false;
      this.$store
        .dispatch("products/add_product_tag", { name: this.tag })
        .then((response) => {
          this.tag = "";
          this.loading = false;
          this.success = true;
          this.message = "Tag Saved successfully!";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
          console.log(response);
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
          console.log(error.response);
          this.success = false;
          this.message = `${error.response.data.message}`;
          this.showMsg = true;
        });
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
