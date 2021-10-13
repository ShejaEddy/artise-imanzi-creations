<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Product Categories</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item active">Product Categories</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa fa-shopping-basket mr-1" aria-hidden="true"></i>
          Categories
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
              v-show="showMsg"
              v-html="message"
            ></div>
          </transition>
          <div class="table-responsive">
            <div class="col-sm-12" v-show="!categories">
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4 style="color: rgb(186, 147, 62)" class="card-title">
                      Oops!! No orders available.
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
              v-if="categories"
            >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Parent Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="cat in extractedCategories" :key="cat.id">
                  <td>
                    <span v-show="!(toEdit == cat.id)">{{ cat.name }}</span>
                    <input
                      class="form-control"
                      type="text"
                      v-model="category"
                      v-show="toEdit == cat.id"
                    />
                  </td>
                  <td>
                    <span v-show="!(toEdit == cat.id)">
                      {{ cat.parent_category }}
                    </span>
                    <select
                      id="parent_category_id"
                      name="parent_category_id"
                      v-model="CategoryInfo.parent_category_id"
                      v-show="toEdit == cat.id"
                      class="form-control"
                    >
                      <option value="0">None</option>
                      <option
                        :value="item.id"
                        v-for="item in extractedCategories"
                        :key="item.id"
                      >
                        <span v-if="item.parent_category == 'None'">{{
                          item.name
                        }}</span>
                        <span v-else
                          >{{ item.name }} -> (<b>Parent:</b>
                          {{ item.parent_category }})</span
                        >
                      </option>
                    </select>
                  </td>
                  <td>
                    <button
                      class="btn btn-info btn-sm"
                      @click.prevent="
                        editCategory(cat.id), getSingleCategory(cat.id)
                      "
                    >
                      <i class="fa fa-edit"></i>
                    </button>
                    <button
                      class="btn btn-success btn-sm"
                      v-show="toEdit == cat.id"
                      @click.prevent="updateCategory(cat.id)"
                    >
                      <i class="fa fa-save"></i>
                    </button>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="deleteCategory(cat.id)"
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
  name: "ViewProductCategoriesContainer",
  data() {
    return {
      category: "category name",
      parent_category: 0,
      edit: false,
      success: false,
      message: "",
      showMsg: false,
      toEdit: 0,
      loading: false,
      CategoryInfo: {},
    };
  },
  computed: {
    ...mapState({
      categories: (state) => state.products.categories,
      extractedCategories: (state) => state.products.extractedCategories,
    }),
  },
  mounted() {
    this.loadExtractedCategories();
  },

  methods: {
    ...mapActions("products", ["get_extracted_categories"]),

    loadExtractedCategories() {
      this.get_extracted_categories();
    },
    scrollTop() {
      this.intervalId = setInterval(() => {
        if (window.pageYOffset == 0) {
          clearInterval(this.intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
      }, 20);
    },
    getSingleCategory(id) {
      this.$store
        .dispatch("products/get_single_category", { categoryId: id })
        .then((response) => {
          this.CategoryInfo = response;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editCategory(id) {
      let cat = this.extractedCategories.filter((i) => i.id === id);
      this.category = cat[0].name;
      if (this.toEdit == id) {
        this.toEdit = 0;
        this.edit = false;
      } else {
        this.toEdit = id;
        this.edit = true;
      }
      this.showMsg = false;
    },
    updateCategory(id) {
      this.loading = true;
      this.showMsg = false;
      let cat = this.extractedCategories.filter((i) => i.id === id);
      cat[0].name = this.category;
      let name = this.category;
      let parent_category_id = $("#parent_category_id").val();

      let data = {
        id: id,
        name: name,
        parent_category_id: parent_category_id,
      };
      this.$store
        .dispatch("products/update_product_category", data)
        .then((response) => {
          this.loading = false;
          this.edit = false;
          this.toEdit = 0;
          this.success = true;
          this.message = "Changes saved successfully!!";
          this.showMsg = true;
          this.loadExtractedCategories();
          this.scrollTop();
          setTimeout(() => {
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
    deleteCategory(id) {
      let r = confirm("Are you sure you want to delete this category?");
      if (r) {
        this.$store.dispatch("products/remove_product_category", id);
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
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
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
div.card {
  transition: height 0.8s;
}
</style>
