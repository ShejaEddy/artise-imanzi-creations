<template>
    <div class="container-fluid pb-5">
        <h1 class="mt-4">Add Adverts</h1>
        <ol class="admin-breadcrumb mb-4">
            <li class="admin-breadcrumb-item">Dashboard</li>
            <li class="admin-breadcrumb-item active">add Adverts</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <h4>Advert Form</h4>
            </div>
            <div class="card-body">
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
                <div class="container">
                    <form
                        style="padding:30px 0px"
                        method="POST"
                        @submit.prevent="AddAdvert()"
                        enctype="multipart/form-data"
                    >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Left Advert:</label>
                                <input
                                    type="file"
                                    accept="image/*"
                                    class="form-control-file mt-1"
                                    name="left_advert"
                                    id="left_advert"
                                    placeholder="Left Advert..."
                                    @change="onChange_left_advert"
                                    required
                                />
                                <span
                                    ><small class="text-warning"
                                        ><b>Dimensions: </b>690x440 Pixels
                                    </small></span
                                >

                                <span
                                    ><i
                                        ><small
                                            class="text-danger"
                                            v-if="leftAdvertErr"
                                            >{{
                                                errors.left_advert["0"]
                                            }}</small
                                        ></i
                                    ></span
                                >
                                <div
                                    style="border:1px solid #bbb; padding: 10px; margin-top:10px; border-radius: 8px;"
                                    class="left_advert_preview"
                                >
                                    <b class="text-center" v-if="leftUrl == ''"
                                        >No image to preview
                                    </b>
                                    <img class="image_preview" :src="leftUrl" />
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4"
                                    >Right Advert:</label
                                >
                                <input
                                    type="file"
                                    accept="image/*"
                                    class="form-control-file mt-1"
                                    name="right_advert"
                                    id="right_advert"
                                    placeholder="Right Advert..."
                                    @change="onChange_right_advert"
                                    required
                                />
                                <span
                                    ><small class="text-warning"
                                        ><b>Dimensions: </b>690x440 Pixels
                                    </small></span
                                >
                                <span
                                    ><i
                                        ><small
                                            class="text-danger"
                                            v-if="rightAdvertErr"
                                            >{{
                                                errors.right_advert["0"]
                                            }}</small
                                        ></i
                                    ></span
                                >
                                <div
                                    style="border:1px solid #bbb; padding: 10px; margin-top:10px; border-radius: 8px;"
                                    class="right_advert_preview col-md-12"
                                >
                                    <b class="text-center" v-if="rightUrl == ''"
                                        >No image to preview
                                    </b>
                                    <img
                                        class="image_preview"
                                        :src="rightUrl"
                                    />
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button
                                    class="btn btn-primary btn-lg col-md-12"
                                    type="submit"
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    name: "AddAdvertForm",
    data() {
        return {
            left_advert: "",
            right_advert: "",
            leftAdvertErr: "",
            rightAdvertErr: "",
            rightUrl: "",
            leftUrl: "",
            loading: false,
            success: false,
            message: "",
            showMsg: false,
            baseUrl: ""
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

        onChange_right_advert(e) {
            this.right_advert = e.target.files[0];
            this.rightUrl = URL.createObjectURL(this.right_advert);
        },
        onChange_left_advert(e) {
            this.left_advert = e.target.files[0];
            this.leftUrl = URL.createObjectURL(this.left_advert);
        },

        scrollTop() {
            this.intervalId = setInterval(() => {
                if (window.pageYOffset == 0) {
                    clearInterval(this.intervalId);
                }
                window.scroll(0, window.pageYOffset - 50);
            }, 20);
        },
        // User Registration
        AddAdvert() {
            this.loading = true;
            let formData = new FormData();
            formData.append("left_advert", this.left_advert);
            formData.append("right_advert", this.right_advert);
            console.log(this.left_advert);
            return;

            this.$store
                .dispatch("products/add_advert", formData)
                .then(response => {
                    this.loading = false;
                    this.success = true;
                    this.message = "Advert added successfully!";
                    this.showMsg = true;
                    setTimeout(() => {
                        this.showMsg = false;
                    }, 3000);
                    this.left_advert = "";
                    this.right_advert = "";
                    this.leftAdvertErr = "";
                    this.rightAdvertErr = "";
                    this.rightUrl = "";
                    this.leftUrl = "";
                    console.log(response.data);
                    this.scrollTop();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if ("left_advert" in this.errors) {
                        this.leftAdvertErr = true;
                    }
                    if ("right_advert" in this.errors) {
                        this.rightAdvertErr = true;
                    }
                    this.loading = false;
                    this.success = false;
                    this.message = `${error.response.data.message}`;
                    this.showMsg = true;
                    console.log(error.response.data.message);
                    this.scrollTop();
                });
        }
    }
};
</script>

<style>
.image_preview {
    width: 465px;
}
/* Smartphone & kindle (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 700px) {
    .image_preview {
        width: 218px;
    }
}
</style>
