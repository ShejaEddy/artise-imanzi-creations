<template>
    <div class="container-fluid pb-5">
        <h1 class="mt-4">Edit Slide</h1>
        <ol class="admin-breadcrumb mb-4">
            <li class="admin-breadcrumb-item">Dashboard</li>
            <li class="admin-breadcrumb-item active">edit slide</li>
        </ol>
        <div class="card">
            <div class="card-header">
                <h4>Slide Edit Form</h4>
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
                        @submit.prevent="UpdateSlide()"
                        enctype="multipart/form-data"
                    >
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4"
                                            >Slide Order:</label
                                        >
                                        <input
                                            type="number"
                                            class="form-control"
                                            v-model="slideData.slide_order"
                                            min="1"
                                            placeholder="Enter slide order..."
                                            required
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="slideOrderErr"
                                                    >{{
                                                        errors.slide_order["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4"
                                            >Slide Image:</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="slide_image"
                                            id="slide_image"
                                            placeholder="Slide Image..."
                                            @change="onChange_slide_image"
                                        />
                                        <span
                                            ><small class="text-warning"
                                                ><b>Dimensions: </b>1920x670
                                                Pixels
                                            </small></span
                                        >
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="slideImageErr"
                                                    >{{
                                                        errors.slide_image["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                        <div
                                            style="border:1px solid #bbb; padding: 10px; margin-top:10px; border-radius: 8px;"
                                            class="slide_image_preview"
                                        >
                                            <template v-if="slideUrl == ''">
                                                <img
                                                    class="image_preview"
                                                    :src="
                                                        `${baseUrl}/uploads/images/${slideData.slide_image}`
                                                    "
                                                />
                                            </template>
                                            <img
                                                v-else
                                                class="image_preview"
                                                :src="slideUrl"
                                            />
                                        </div>
                                        <div
                                            v-html="slideData.slide_caption"
                                            class="caption_preview"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="inputPassword4"
                                            >Slide Caption:</label
                                        >
                                        <vue-editor
                                            v-model="slideData.slide_caption"
                                        ></vue-editor>
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="slideCaptionErr"
                                                    >{{
                                                        errors.slide_caption[
                                                            "0"
                                                        ]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                style="margin-top: 60px;"
                                class="form-group col-md-12"
                            >
                                <button
                                    class="btn btn-primary btn-lg col-md-12"
                                    type="submit"
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
        </div>
    </div>
</template>
<script>
import { VueEditor } from "vue2-editor";
import { mapState } from "vuex";
export default {
    name: "EditSlideForm",
    components: {
        VueEditor
    },
    data() {
        return {
            slide_image: "",
            slide_caption: "",
            slide_order: "",
            slideImageErr: "",
            slideOrderErr: "",
            slideCaptionErr: "",
            slideUrl: "",
            loading: false,
            success: false,
            message: "",
            showMsg: false,
            baseUrl: "",
            id: this.$route.params.id,
            slideData: {}
        };
    },
    mounted() {
        this.generateBaseUrl();
    },
    created() {
        this.getSingleSlide(this.id);
    },
    methods: {
        getSingleSlide(id) {
            this.$store
                .dispatch("products/get_single_slide", { slideId: id })
                .then(response => {
                    console.log("SLIDE=> " + response[0]);
                    this.slideData = response[0];
                })
                .catch(error => {
                    console.log(error);
                });
        },

        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        ToText(HTML) {
            var input = HTML;
            return input
                .replace(/<(style|script|iframe)[^>]*?>[\s\S]+?<\/\1\s*>/gi, "")
                .replace(/<[^>]+?>/g, "")
                .replace(/\s+/g, " ")
                .replace(/ /g, " ")
                .replace(/>/g, " ");
        },
        onChange_slide_image(e) {
            this.slide_image = e.target.files[0];
            this.slideUrl = URL.createObjectURL(this.slide_image);
        },
        scrollTop() {
            this.intervalId = setInterval(() => {
                if (window.pageYOffset == 0) {
                    clearInterval(this.intervalId);
                }
                window.scroll(0, window.pageYOffset - 50);
            }, 20);
        },

        UpdateSlide() {
            this.loading = true;
            let formData = new FormData();
            formData.append("slideId", this.id);
            formData.append("slide_image", this.slide_image);
            formData.append("slide_caption", this.slideData.slide_caption);
            formData.append("slide_order", this.slideData.slide_order);
            this.$store
                .dispatch("products/update_slide", formData)
                .then(response => {
                    this.loading = false;
                    this.success = true;
                    this.message = "Slide updated successfully!";
                    this.showMsg = true;
                    setTimeout(() => {
                        this.showMsg = false;
                    }, 3000);
                    this.slide_image = "";
                    this.slide_caption = "";
                    this.slide_order = "";
                    this.slideImageErr = "";
                    this.slideCaptionErr = "";
                    this.slideOrderErr = "";
                    this.slideUrl = "";
                    this.scrollTop();
                    this.getSingleSlide(this.id);
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if ("slide_image" in this.errors) {
                        this.slideImageErr = true;
                    }
                    if ("slide_caption" in this.errors) {
                        this.slideCaptionErr = true;
                    }
                    if ("slide_order" in this.errors) {
                        this.slideOrderErr = true;
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
/* iPads (portrait and landscape) ----------- */
@media only screen and (min-width: 768px) and (max-width: 1024px) {
    .image_preview {
        width: 288px;
    }
    .caption_preview {
        margin: -95px 36px !important;
    }
}

.caption_preview {
    margin: -125px 50px !important;
}
</style>
