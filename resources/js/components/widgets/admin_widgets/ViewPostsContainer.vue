<template>
    <!--MainContainer-->
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">View Posts</h1>
            <ol class="admin-breadcrumb mb-4">
                <li class="admin-breadcrumb-item active">View Posts</li>
            </ol>
            <div class="row d-none">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <span
                                ><i
                                    style="font-size: 25px; margin-right: 10px"
                                    class="fa fa-sticky-note-o"
                                    aria-hidden="true"
                                ></i></span
                            >Posts
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
                            >Posts
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
                            >Posts
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
                            <canvas
                                id="myAreaChart"
                                width="100%"
                                height="40"
                            ></canvas>
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
                            <canvas
                                id="myBarChart"
                                width="100%"
                                height="40"
                            ></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-columns mr-1" aria-hidden="true"></i>
                    All Post
                    <div style="float:right">
                        <router-link
                            to="/admin/add-post"
                            class="btn btn-primary btn-sm"
                            ><i class="fas fa-plus mr-1" aria-hidden="true"></i
                            >Add post</router-link
                        >
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div
                            style="display: none"
                            class="col-sm-12"
                            v-show="posts.length === 0"
                        >
                            <div class="card">
                                <div class="card-body">
                                    <center>
                                        <h4
                                            style="color: rgb(186, 147, 62)"
                                            class="card-title"
                                        >
                                            Oops!! No posts available.
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
                            v-if="posts.length !== 0"
                        >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="posts.length > 0">
                                <tr v-for="post in posts" :key="post.id">
                                    <td class="text-center">
                                        <img
                                            style="background:white;"
                                            :src="
                                                `${baseUrl}/storage/${post.featured_image}`
                                            "
                                            class="img-thumbnail"
                                            width="45"
                                            alt="Cinque Terre"
                                        />
                                    </td>
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.author }}</td>
                                    <td
                                        :class="
                                            post.status === 'Published'
                                                ? 'text-success'
                                                : 'text-warning'
                                        "
                                    >
                                        {{ post.status }}
                                    </td>
                                    <td>
                                        {{
                                            post.date
                                                | moment("ddd, MMM Do YYYY")
                                        }}
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-info btn-sm"
                                            data-toggle="modal"
                                            :data-target="
                                                `#edit_modal_${post.id}`
                                            "
                                            @click="getSinglePost(post.id)"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="delete_post(post.id)"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button
                                            v-if="post.status != 'Published'"
                                            class="btn btn-primary btn-sm"
                                            @click="publishPost(post.id)"
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
        <div
            v-for="post in posts"
            :key="'p3-' + post.id"
            class="modal fade bd-example-modal-lg"
            :id="`edit_modal_${post.id}`"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <form
                    style="padding:30px 0px"
                    @submit.prevent="updatePost(post.id)"
                    enctype="multipart/form-data"
                >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Edit Post
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
                            <div class="container">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4"
                                            >Title:</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            :id="`title_${post.id}`"
                                            v-model="PostInfo.title"
                                            placeholder="Title..."
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="titleErr"
                                                    >{{
                                                        errors.title["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="category"
                                            >Featured Image:
                                        </label>
                                        <!-- <div class="row">
                      <div class="col-md-2"><img style="background:white; max-width: 135% !important;" :src="`${baseUrl}/storage/${PostInfo.featured_image}`" class="img-thumbnail" alt="Cinque Terre"></div>
                      <div class="col-md-10"><input type="file" accept="image/*" class="form-control-file mt-1" name="featured_img" :id="`featured_img_${post.id}`" placeholder="Featured Image..." @change="onChange_featured_img"></div>
                      </div> -->
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="featured_img"
                                            :id="`featured_img_${post.id}`"
                                            placeholder="Featured Image..."
                                            @change="onChange_featured_img"
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="featured_imgErr"
                                                    >{{
                                                        errors.featured_image[
                                                            "0"
                                                        ]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="category"
                                            >Post Caption:
                                        </label>
                                        <textarea
                                            class="form-control"
                                            :id="`caption_${post.id}`"
                                            name="caption"
                                            placeholder="Enter a Caption"
                                            v-model="PostInfo.caption"
                                            rows="2"
                                        >
                                        </textarea>
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="captionErr"
                                                    >{{
                                                        errors.caption["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputAddress"
                                            >Post Body:</label
                                        >
                                        <vue-editor
                                            v-model="PostInfo.body"
                                        ></vue-editor>
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="bodyErr"
                                                    >{{
                                                        errors.body["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                </div>
                                <transition name="slide-fade">
                                    <div
                                        class="alert"
                                        :class="{
                                            'alert-danger': !success,
                                            'alert-success': success
                                        }"
                                        v-show="showMsg"
                                    >
                                        {{ message }}
                                    </div>
                                </transition>
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
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="loading"
                            >
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
    name: "ViewPostsContainer",
    components: {
        VueEditor
    },
    data() {
        return {
            baseUrl: "",
            PostInfo: [],
            featured_img: "",
            // errors variables
            titleErr: "",
            captionErr: "",
            bodyErr: "",
            featured_imgErr: "",
            alertMsg: "",
            alertClass: "",
            errors: null,
            message: "",
            success: "",
            showMsg: false,
            loading: false,
            token: localStorage.getItem("userToken")
        };
    },
    computed: {
        ...mapState({
            posts: state => state.products.posts
        })
    },
    mounted() {
        this.loadPosts();
        this.generateBaseUrl();
    },
    methods: {
        ...mapActions("products", ["get_posts"]),

        loadPosts() {
            this.get_posts();
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        delete_post(id) {
            let r = confirm("Are you sure you want to delete this post?");
            if (r) {
                this.$store.dispatch("products/remove_post", id);
                this.loadPosts();
            }
        },
        publishPost(id) {
            let r = confirm("Are you sure you want to publish this post?");
            if (r) {
                this.$store.dispatch("products/publish_post", id);
                this.loadPosts();
            }
        },
        getSinglePost(id) {
            this.$store
                .dispatch("products/get_single_post", id)
                .then(response => {
                    this.PostInfo = response[0];
                    console.log(this.PostInfo);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        onChange_featured_img(e) {
            console.log(e.target.files[0]);
            this.featured_img = e.target.files[0];
        },

        updatePost(id) {
            this.loading = true;
            const config = {
                headers: {
                    Authorization: "Bearer " + this.token
                }
            };
            let formData = new FormData();
            formData.append("postId", id);
            formData.append("title", this.PostInfo.title);
            formData.append("caption", this.PostInfo.caption);
            formData.append("featured_image", this.featured_img);
            formData.append("body", this.PostInfo.body);
            axios
                .post("/api/update-post", formData, config)
                .then(response => {
                    this.loading = false;
                    this.success = true;
                    this.message = "Post Updated successfully!";
                    this.showMsg = true;
                    setTimeout(() => {
                        this.showMsg = false;
                    }, 3000);
                    console.log(response.data);
                    this.loadPosts();
                    this.titleErr = "";
                    this.captionErr = "";
                    this.bodyErr = "";
                    this.featured_imgErr = "";
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if ("title" in this.errors) {
                        this.titleErr = true;
                    }
                    if ("caption" in this.errors) {
                        this.captionErr = true;
                    }
                    if ("body" in this.errors) {
                        this.bodyErr = true;
                    }
                    if ("featured_image" in this.errors) {
                        this.featured_imgErr = true;
                    }
                    this.loading = false;
                    this.success = false;
                    this.message = `${error.response.data.message}`;
                    this.showMsg = true;
                    console.log(error.response.data.message);
                });
        }
    }
};
</script>
