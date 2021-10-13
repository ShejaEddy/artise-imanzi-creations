<template>
    <div class="product_page">
        <div class="main">
            <section class="velaBreadcrumbs hasBackgroundImage">
                <div
                    class="velaBreadcrumbsInner"
                    style="background-color: #eaebef;"
                >
                    <div class="velaBreadcrumbImage">
                        <img
                            alt="velademo-Artise"
                            src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/bg-breacumb.jpg?v=1586848586"
                        />
                    </div>
                    <nav class="velaBreadcrumbWrap container">
                        <div class="velaBreadcrumbsInnerWrap">
                            <h2
                                class="breadcrumbHeading breadcrumbHeadingProduct"
                            >
                                {{ ProductInfo.name }}
                            </h2>
                            <ol
                                class="breadcrumb"
                                itemscope=""
                                itemtype="http://schema.org/BreadcrumbList"
                            >
                                <li
                                    itemprop="itemListElement"
                                    itemscope=""
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <a
                                        href="/"
                                        title="Back to the frontpage"
                                        itemprop="item"
                                    >
                                        <span itemprop="name">Home</span>
                                    </a>
                                    <meta itemprop="position" content="1" />
                                </li>
                                <!-- <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="../collections/chairs.html" title="Chairs" itemprop="item">
                            <span itemprop="name">Chairs</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li> -->
                                <li
                                    class="active"
                                    itemprop="itemListElement"
                                    itemscope=""
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <span itemprop="name">{{
                                        ProductInfo.name
                                    }}</span>
                                    <meta itemprop="position" content="3" />
                                </li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </section>

            <div class="container bootdey">
                <div class="col-md-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="pro-img-details">
                                    <img
                                        style="max-width: 90%; !important;"
                                        id="ProductPhotoImg"
                                        class="img-responsive"
                                        :src="
                                            `${baseUrl}/storage/${ProductInfo.forwardImage}`
                                        "
                                        alt=""
                                    />
                                </div>
                                <div
                                    style="display: none;"
                                    class="pro-img-list"
                                >
                                    <a href="#">
                                        <img
                                            src="https://via.placeholder.com/115x100/87CEFA/000000"
                                            alt=""
                                        />
                                    </a>
                                    <a href="#">
                                        <img
                                            src="https://via.placeholder.com/115x100/FF7F50/000000"
                                            alt=""
                                        />
                                    </a>
                                    <a href="#">
                                        <img
                                            src="https://via.placeholder.com/115x100/20B2AA/000000"
                                            alt=""
                                        />
                                    </a>
                                    <a href="#">
                                        <img
                                            src="https://via.placeholder.com/120x100/20B2AA/000000"
                                            alt=""
                                        />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4
                                    style="margin: 0 0 30px !important; padding: 0 !important; font-size: 32px !important;"
                                    class="pro-d-title"
                                >
                                    <a href="#" class="">
                                        {{ ProductInfo.name }}
                                    </a>
                                </h4>
                                <p>
                                    {{ ProductInfo.longDesc }}
                                </p>

                                <div
                                    style="margin: 50px 0px 0px 0px;"
                                    class="single_price"
                                >
                                    <span
                                        style="font-size: 24px; font-weight: 800; margin: 50px 0px; color: #fbad02 !important;"
                                        class="money"
                                        v-if="ProductInfo.discount > 0"
                                        >Rwf
                                        {{ ProductInfo.discounted_price }}</span
                                    >
                                    <span
                                        style="font-size: 24px; font-weight: 800; margin: 50px 0px; color: #fbad02 !important;"
                                        class="money"
                                        v-else
                                        >Rwf {{ ProductInfo.price }}</span
                                    >
                                </div>

                                <p
                                    style="margin: 20px 0px 40px 0px !important;"
                                >
                                    <button
                                        type="submit"
                                        name="add"
                                        id="AddToCart"
                                        class="btn btnAddToCart"
                                        :class="{
                                            added: isAdded(ProductInfo.id)
                                        }"
                                        @click.prevent="
                                            addToCart(
                                                ProductInfo.id,
                                                ProductInfo.name
                                            )
                                        "
                                    >
                                        <i class="icons icon-handbag mr-2"></i>
                                        <span
                                            id="AddToCartText"
                                            v-if="isAdded(ProductInfo.id)"
                                            >Remove From Cart</span
                                        >
                                        <span id="AddToCartText" v-else
                                            >Add to Cart</span
                                        >
                                    </button>
                                </p>
                                <div
                                    style="margin: 0 0 8px; font-size: 14px;"
                                    class="m-bot15"
                                >
                                    <strong
                                        style="margin: 0 10px 0 0; color: #1a1a1a; font-weight: 700;"
                                        >Availability :</strong
                                    >
                                    <span
                                        style="color: #5cb85c; font-size: 12px;"
                                        >In Stock</span
                                    >
                                </div>
                                <div
                                    style="margin: 0 0 8px; font-size: 14px;"
                                    class="m-bot15"
                                >
                                    <strong
                                        style="margin: 0 10px 0 0; color: #1a1a1a; font-weight: 700;"
                                        >Size :</strong
                                    >
                                    <span style="font-size: 12px;">{{
                                        ProductInfo.size
                                    }}</span>
                                </div>
                                <div
                                    style="margin: 0 0 8px; font-size: 14px;"
                                    class="m-bot15"
                                >
                                    <strong
                                        style="margin: 0 10px 0 0; color: #1a1a1a; font-weight: 700;"
                                        >Creator :</strong
                                    >
                                    <span style="font-size: 12px;">{{
                                        ProductArtist.names
                                    }}</span>
                                </div>
                                <div
                                    style="margin: 0 0 8px; font-size: 14px;"
                                    class="m-bot15"
                                >
                                    <div class="form-group row">
                                        <label
                                            for="inputEmail3"
                                            class="col-sm-2 col-form-label"
                                            ><strong
                                                style="margin: 0 0px 0 0; color: #1a1a1a; font-weight: 700;"
                                                >Rate :</strong
                                            ></label
                                        >
                                        <div class="col-md-3">
                                            <select
                                                style="margin-left:-45px !important; padding: 0px 10px !important; height: 31px !important; font-size:13px!impotant;"
                                                type="text"
                                                class="form-control"
                                                v-model="rate_value"
                                                @change="rateProduct()"
                                            >
                                                <option value="0" selected
                                                    >0</option
                                                >
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="star_rating">
                                    <span>&star;</span>
                                    <span>&star;</span>
                                    <span>&star;</span>
                                    <span>&star;</span>
                                    <span>&star;</span>
                                    <br />
                                    <div
                                        :style="{
                                            width:
                                                ProductInfo.ratings_percentage +
                                                '%'
                                        }"
                                        class="star_rating_current"
                                    >
                                        <span>&starf;</span>
                                        <span>&starf;</span>
                                        <span>&starf;</span>
                                        <span>&starf;</span>
                                        <span>&starf;</span>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="col-md-6">
                                    <div style="margin-top:20px;" class="card">
                                        <div
                                            class="card-body justify-content-center text-center"
                                        >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4
                                                        class="add_reviews_header"
                                                    >
                                                        Add a review
                                                    </h4>
                                                    <transition
                                                        name="slide-fade"
                                                    >
                                                        <div
                                                            class="alert p-3"
                                                            :class="alertClass"
                                                            role="alert"
                                                            v-if="responseAvail"
                                                        >
                                                            <i
                                                                class="fas fa-exclamation-circle mr-3"
                                                            ></i
                                                            >{{ alertMsg }}
                                                        </div>
                                                    </transition>
                                                    <form
                                                        id="review_form"
                                                        @submit.prevent="
                                                            SaveReview()
                                                        "
                                                    >
                                                        <div
                                                            class="row form-group"
                                                        >
                                                            <div class="col">
                                                                <input
                                                                    type="text"
                                                                    class="form-control"
                                                                    v-model="
                                                                        review_names
                                                                    "
                                                                    id="names"
                                                                    name="names"
                                                                    placeholder="Names..."
                                                                    required
                                                                />
                                                            </div>
                                                            <div class="col">
                                                                <input
                                                                    type="email"
                                                                    class="form-control"
                                                                    v-model="
                                                                        review_email
                                                                    "
                                                                    id="email"
                                                                    name="email"
                                                                    placeholder="Email..."
                                                                    required
                                                                />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea
                                                                class="form-control"
                                                                v-model="
                                                                    review_message
                                                                "
                                                                id="review_message"
                                                                name="review_message"
                                                                placeholder="Enter your review..."
                                                                rows="3"
                                                                required
                                                            ></textarea>
                                                        </div>
                                                        <div
                                                            class="form-button"
                                                        >
                                                            <input
                                                                type="submit"
                                                                value="Submit"
                                                                class="btn btnVelaOne col-md-12"
                                                            />
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-12">
                                                    <ul
                                                        style="margin-top:40px;"
                                                        class="list-group"
                                                    >
                                                        <h4
                                                            class="view_reviews_header"
                                                        >
                                                            Product Reviews
                                                        </h4>
                                                        <a
                                                            class="list-group-item"
                                                            v-for="review in reviews"
                                                            :key="review.id"
                                                        >
                                                            <div
                                                                class="media col-md-2"
                                                            >
                                                                <div
                                                                    class="pull-left"
                                                                >
                                                                    <img
                                                                        style="background:white; border-radius:60px; width:35px; height:35px;"
                                                                        :src="
                                                                            `${baseUrl}/assets/images/default-avatar.png`
                                                                        "
                                                                        class="user-img-avatar"
                                                                        width="45"
                                                                        alt="User"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-7"
                                                            >
                                                                <h4
                                                                    style="font-size:14px;margin: 0px 10px 0px 0px; color: rgb(26, 26, 26); font-weight: 700;"
                                                                    class="list-group-item-heading text-left"
                                                                >
                                                                    {{
                                                                        review.names
                                                                    }}
                                                                </h4>
                                                                <p
                                                                    style="font-size:14px;"
                                                                    class="list-group-item-text text-left"
                                                                >
                                                                    {{
                                                                        review.review
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="col-md-3 text-center"
                                                            >
                                                                <small
                                                                    style="font-size:10px !important;"
                                                                >
                                                                    <timeago
                                                                        :datetime="
                                                                            review.created_at
                                                                        "
                                                                        :auto-update="
                                                                            60
                                                                        "
                                                                    ></timeago
                                                                ></small>
                                                            </div>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    data: function() {
        return {
            product: "",
            ProductInfo: "",
            ProductArtist: "",
            added: false,
            remove: false,
            id: this.$route.params.id,
            baseUrl: "",
            review_names: "",
            review_email: "",
            review_message: "",
            testing: "",
            responseAvail: false,
            alertMsg: "",
            alertClass: "",
            rate_value: 0
        };
    },
    components: {},
    computed: {
        ...mapState("products", ["cart", "reviews"])
    },

    created() {
        this.generateBaseUrl();
        this.getSingleProduct(this.id);
        this.loadReviews();
        this.saveViews();
    },
    methods: {
        ...mapActions("products", ["get_reviews"]),

        loadReviews() {
            this.get_reviews(this.id);
        },
        SaveReview() {
            let review_data = {
                names: this.review_names,
                email: this.review_email,
                review: this.review_message,
                product_id: this.id
            };
            this.$store
                .dispatch("products/add_review", review_data)
                .then(response => {
                    this.loadReviews();
                    this.alertMsg = "Review was submited successfully!";
                    this.alertClass = "alert-success";
                    this.responseAvail = true;

                    setTimeout(() => {
                        this.responseAvail = false;
                    }, 2000);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        rateProduct() {
            let rate_data = {
                rate_value: this.rate_value,
                product_id: this.id
            };
            this.$store
                .dispatch("products/add_rate", rate_data)
                .then(response => {
                    console.log("rated");
                    this.getSingleProduct(this.id);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        getSingleProduct(id) {
            this.$store
                .dispatch("products/get_single_product", { productId: id })
                .then(response => {
                    this.ProductInfo = response.product[0];
                    this.ProductArtist = response.artist;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        saveViews() {
            let data = {
                product_id: this.id
            };
            this.$store
                .dispatch("products/save_views", data)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        addToCart(id, name) {
            this.added = name;
            if (
                this.cart !== null &&
                this.cart.findIndex(r => r.id === id) !== -1
            ) {
                this.remove = true;
            } else {
                this.remove = false;
            }
            this.$store.dispatch("products/addToCart", id);
            setTimeout(() => (this.added = false), 1000);
        },
        isAdded(id) {
            if (this.cart && this.cart.findIndex(r => r.id === id) !== -1) {
                return true;
            } else {
                return false;
            }
        }
    }
};
</script>

<style lang="css" scoped>
.proVariants .selector-wrapper:nth-child(1) {
    display: none;
}
.spr-container {
    padding: 24px;
    border-color: #ececec;
}
.spr-form,
.spr-review {
    border-color: #ececec;
}
.added {
    background-color: #fbad02;
    border-color: #fbad02;
    color: #ffffff;
}
a.list-group-item {
    height: auto;
    min-height: 220px;
}
a.list-group-item.active small {
    color: #fff;
}
.stars {
    margin: 20px auto 1px;
}
a.list-group-item {
    height: auto;
    min-height: 75px;
}
.add_reviews_header {
    margin-bottom: 40px;
}
.view_reviews_header {
    margin-bottom: 30px;
}
.star_rating {
    display: inline-block;
    color: #fbad02;
    font-size: 1.5em;
    position: relative;
}
.star_rating .star_rating_current {
    position: absolute;
    top: 0;
    /* width: 50%; */
    overflow: hidden;
    white-space: nowrap;
}
</style>
