<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Product Tags</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item active">Product Tags</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa fa-shopping-basket mr-1" aria-hidden="true"></i>
          Tags
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
            <div class="col-sm-12" v-show="tags.length === 0">
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4 style="color: rgb(186, 147, 62)" class="card-title">
                      Oops!! No Tags Available!!
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
              v-if="tags.length !== 0"
            >
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="cat in tags" :key="cat.id">
                  <td>
                    <span v-show="!(toEdit == cat.id)">{{ cat.name }}</span>
                    <input
                      class="form-control"
                      type="text"
                      v-model="tag"
                      v-show="toEdit == cat.id"
                    />
                  </td>
                  <td>
                    <button
                      class="btn btn-info btn-sm"
                      @click.prevent="editTag(cat.id)"
                    >
                      <i class="fa fa-edit"></i>
                    </button>
                    <button
                      class="btn btn-success btn-sm"
                      v-show="toEdit == cat.id"
                      @click.prevent="updateTag(cat.id)"
                    >
                      <i class="fa fa-save"></i>
                    </button>
                    <button
                      class="btn btn-danger btn-sm"
                      @click.prevent="deleteTag(cat.id)"
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
import { mapState } from "vuex";
export default {
  name: "ViewProductTagsContainer",
  data() {
    return {
      tag: "Hello",
      edit: false,
      success: false,
      message: "",
      showMsg: false,
      toEdit: 0,
      loading: false,
    };
  },
  computed: {
    ...mapState("products", ["tags"]),
  },
  methods: {
    scrollTop() {
      this.intervalId = setInterval(() => {
        if (window.pageYOffset == 0) {
          clearInterval(this.intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
      }, 20);
    },
    editTag(id) {
      console.log("id", id);
      let cat = JSON.parse(
        JSON.stringify(this.tags.filter((i) => i.id === id))
      );
      console.log("tags", this.tags);
      console.log("tag", cat);
      this.tag = cat[0].name;
      if (this.toEdit == id) {
        this.toEdit = 0;
        this.edit = false;
      } else {
        this.toEdit = id;
        this.edit = true;
      }
      this.showMsg = false;
    },
    updateTag(id) {
      this.showMsg = false;
      this.loading = true;
      let cat = JSON.parse(
        JSON.stringify(this.tags.filter((i) => i.id === id))
      );
      cat[0].name = this.tag;
      this.$store
        .dispatch("products/update_product_tag", cat[0])
        .then((response) => {
          console.log("responsee", response);
          this.loading = false;
          this.edit = false;
          this.toEdit = 0;
          this.success = true;
          this.message = "Changes saved successfully!";
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
    deleteTag(id) {
      let r = confirm("Are you sure you want to delete this tag?");
      if (r) {
        this.$store.dispatch("products/remove_product_tag", id);
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
