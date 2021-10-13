<template>
  <div class="container-fluid pb-5">
    <h1 class="mt-4">Add Post</h1>
    <ol class="admin-breadcrumb mb-4">
      <li class="admin-breadcrumb-item">
        <router-link to="/artist/dashboard">Dashboard</router-link>
      </li>
      <li class="admin-breadcrumb-item active">Add Post</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <i class="fa fa-plus mr-1" aria-hidden="true"></i>
        Add a Post
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
          <form style="padding:40px 0px" @submit.prevent="addPost">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="category">Title: </label>
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  placeholder="Enter a Title"
                  v-model="title"
                />
                <span
                  ><i
                    ><small class="text-danger" v-if="titleErr">{{
                      errors.title
                    }}</small></i
                  ></span
                >
              </div>
              <div class="form-group col-md-6">
                <label for="category">Featured Image: </label>
                <input
                  type="file"
                  accept="image/*"
                  class="form-control-file mt-1"
                  name="featured_img"
                  id="featured_img"
                  placeholder="Featured Image..."
                  @change="onChange_featured_img"
                />
                <span
                  ><i
                    ><small class="text-danger" v-if="featured_imgErr">{{
                      errors.featured_img
                    }}</small></i
                  ></span
                >
              </div>
              <div class="form-group col-md-12">
                <label for="category">Post Caption: </label>
                <textarea
                  class="form-control"
                  id="caption"
                  name="caption"
                  placeholder="Enter a Caption"
                  rows="2"
                  v-model="caption"
                >
                </textarea>
                <span
                  ><i
                    ><small class="text-danger" v-if="captionErr">{{
                      errors.caption
                    }}</small></i
                  ></span
                >
              </div>
              <div class="form-group col-md-12">
                <label for="inputAddress">Post Body:</label>
                <vue-editor v-model="content"></vue-editor>
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
  name: "addPostForm",
  components: {
    VueEditor,
  },
  data() {
    return {
      title: "",
      featured_img: "",
      caption: "",
      content: "",
      titleErr: "",
      contentErr: "",
      captionErr: "",
      featured_imgErr: "",
      success: "",
      showMsg: false,
      loading: false,
      message: "",
    };
  },
  methods: {
    onChange_featured_img(e) {
      console.log(e.target.files[0]);
      this.featured_img = e.target.files[0];
    },
    addPost() {
      this.loading = true;
      this.showMsg = false;
      const config = {
        headers: {
          Authorization: "Bearer " + this.token,
        },
      };

      let formData = new FormData();
      formData.append("title", this.title);
      formData.append("caption", this.caption);
      formData.append("featured_image", this.featured_img);
      formData.append("content", this.content);

      this.$store
        .dispatch("products/add_post", formData, config)
        .then((response) => {
          this.title = "";
          this.caption = "";
          this.featured_img = "";
          this.content = "";
          this.loading = false;
          this.success = true;
          this.message = "Post Saved successfully!";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
          console.log(response);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          if ("title" in this.errors) {
            this.titleErr = true;
          }
          if ("caption" in this.errors) {
            this.captionErr = true;
          }
          if ("featured_image" in this.errors) {
            this.featured_imgErr = true;
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
</style>
