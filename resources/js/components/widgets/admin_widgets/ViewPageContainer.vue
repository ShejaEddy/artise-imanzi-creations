<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">View Pages</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item">Dashboard</li>
        <li class="admin-breadcrumb-item active">View Pages</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-columns mr-1" aria-hidden="true"></i>
          All Pages
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="col-sm-12" v-show="pages.length === 0">
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4 style="color: rgb(186, 147, 62)" class="card-title">
                      Oops!! No Pages Available!!
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
              v-if="pages.length !== 0"
            >
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Url</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(page, index) in pages" :key="index">
                  <td>{{ index + 1 }}</td>
                  <td>{{ page.page_name }}</td>
                  <td>
                    <a :href="`/${page.id}/${page.page_url}`" target="_blank">{{
                      baseUrl + "/" + page.page_url
                    }}</a>
                  </td>
                  <td>
                    <button
                      data-toggle="modal"
                      :data-target="`#edit_modal_${page.id}`"
                      class="btn btn-info btn-sm"
                      @click="getSinglePage(page.id)"
                    >
                      <i class="fa fa-edit"></i>
                    </button>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="deletePage(page.id)"
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
    <div
      v-for="page in pages"
      :key="'p3-' + page.id"
      class="modal fade bd-example-modal-lg"
      :id="`edit_modal_${page.id}`"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <form
          style="padding:30px 0px"
          @submit.prevent="updatePage(page.id)"
          enctype="multipart/form-data"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Page</h5>
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
              <div class="container">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="category">Page Name: </label>
                    <input
                      type="text"
                      class="form-control"
                      id="page_name"
                      name="page_name"
                      placeholder="Enter page title"
                      v-model="pageData.page_name"
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
                  <div class="form-group col-md-12">
                    <label for="inputAddress">Page Body:</label>
                    <vue-editor
                      v-model="pageData.content"
                      required
                    ></vue-editor>
                    <span
                      ><i
                        ><small class="text-danger" v-if="contentErr">{{
                          errors.content
                        }}</small></i
                      ></span
                    >
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary" :disabled="loading">
                Update
                <div
                  v-if="loading"
                  class="spinner-border text-light ml-3"
                  role="status"
                >
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
  <!--MainContainer--END-->
</template>

<script>
import { VueEditor } from "vue2-editor";
import { mapState, mapActions } from "vuex";
export default {
  name: "ViewPageContainer",
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
      pageData: {},
      id: this.$route.params.id,
    };
  },
  computed: {
    ...mapState({
      pages: (state) => state.products.pages,
    }),
  },
  mounted() {
    this.generateBaseUrl();
    this.loadPages();
  },
  methods: {
    ...mapActions("products", ["get_pages"]),

    loadPages() {
      this.get_pages();
    },
    getSinglePage(id) {
      this.$store
        .dispatch("products/get_single_page", { pageId: id })
        .then((response) => {
          this.pageData = response[0];
        })
        .catch((error) => {
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
    deletePage(id) {
      let r = confirm("Are you sure you want to delete this page?");
      if (r) {
        this.$store.dispatch("products/remove_page", id);
        this.loadPages();
      }
    },

    updatePage(id) {
      this.loading = true;
      this.showMsg = false;

      let formData = new FormData();
      formData.append("pageId", id);
      formData.append("page_name", this.pageData.page_name);
      formData.append("content", this.pageData.content);

      this.$store
        .dispatch("products/update_page", formData)
        .then((response) => {
          this.page_name = "";
          this.page_url = "";
          this.content = "";
          this.loading = false;
          this.success = true;
          this.message = "<p>Page updated successfully!!</p>";
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
          this.message = "<p>" + error.response.data.message + "</p>";
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
