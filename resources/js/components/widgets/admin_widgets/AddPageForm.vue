<template>
  <div class="container-fluid pb-5">
    <h1 class="mt-4">Add Page</h1>
    <ol class="admin-breadcrumb mb-4">
      <li class="admin-breadcrumb-item">
        <router-link to="/artist/dashboard">Dashboard</router-link>
      </li>
      <li class="admin-breadcrumb-item active">Add Page</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Add a Page
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
          <form style="padding:40px 0px" @submit.prevent="addPage">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="category">Page Name: </label>
                <input
                  type="text"
                  class="form-control"
                  id="page_name"
                  name="page_name"
                  placeholder="Enter page title"
                  v-model="page_name"
                  required
                />
                <span
                  ><i
                    ><small class="text-danger" v-if="page_nameErr">{{
                      errors.page_name
                    }}</small></i
                  ></span
                >
              </div>
              <div class="form-group col-md-6">
                <label for="category">Page Url: </label>
                <div class="input-group">
                  <span class="input-group-text">{{ baseUrl }}/</span>
                  <input
                    type="text"
                    id="page_url"
                    placeholder="Enter page url"
                    name="page_url"
                    aria-label="page_url"
                    v-model="page_url"
                    class="form-control"
                    required
                  />
                </div>
                <span
                  ><i
                    ><small class="text-danger" v-if="page_urlErr">{{
                      errors.page_url
                    }}</small></i
                  ></span
                >
              </div>

              <div class="form-group col-md-12">
                <label for="inputAddress">Page Body:</label>
                <vue-editor v-model="content" required></vue-editor>
                <span
                  ><i
                    ><small class="text-danger" v-if="contentErr">{{
                      errors.content
                    }}</small></i
                  ></span
                >
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
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Basic Use - Covers most scenarios
import { VueEditor } from "vue2-editor";
export default {
  name: "addPageForm",
  components: {
    VueEditor,
  },
  data() {
    return {
      page_name: "",
      page_url: "",
      content: "",
      page_nameErr: "",
      page_urlErr: "",
      contentErr: "",
      success: "",
      showMsg: false,
      loading: false,
      message: "",
      baseUrl: "",
    };
  },
  mounted() {
    this.generateBaseUrl();
  },
  methods: {
    generateBaseUrl() {
      let base_url = window.location.origin;
      this.baseUrl = base_url;
    },
    onChange_featured_img(e) {
      console.log(e.target.files[0]);
      this.featured_img = e.target.files[0];
    },
    addPage() {
      this.page_url = this.page_url;
      this.page_url = this.page_url.split("&").join("and");
      this.page_url = this.page_url.replace(/\s+/g, "-");
      this.page_url = this.page_url.toLowerCase().trim();

      this.loading = true;
      this.showMsg = false;

      let formData = new FormData();
      formData.append("page_name", this.page_name);
      formData.append("page_url", this.page_url);
      formData.append("content", this.content);

      this.$store
        .dispatch("products/add_page", formData)
        .then((response) => {
          this.page_name = "";
          this.page_url = "";
          this.content = "";
          this.loading = false;
          this.success = true;
          this.message = "Page Saved successfully!";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
          console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          if ("page_name" in this.errors) {
            this.page_nameErr = true;
          }
          if ("page_url" in this.errors) {
            this.page_urlErr = true;
          }
          if ("content" in this.errors) {
            this.contentErr = true;
          }
          this.loading = false;
          this.success = false;
          this.message = `${error.response.data.message}`;
          this.showMsg = true;
          console.log(error.response.data.message);
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
<style>
.ql-editor {
  height: 50vh;
}
.input-group-text {
  display: flex;
  align-items: center;
  padding: 0.375rem 0.75rem;
  margin-bottom: 0;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  text-align: center;
  white-space: nowrap;
  background-color: #fff !important;
  border: 1px solid #ced4da;
  border-radius: 0.25rem 0rem 0rem 0.25rem !important;
}
</style>
