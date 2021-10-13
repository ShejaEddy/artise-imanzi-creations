<template>
    <Modal>
        <ModalHeader>
            <div class="d-flex justify-content-end">
                <button
                    @click="close('Modal closed')"
                    class="btn btn-primary action"
                >
                    Close
                </button>
            </div>
        </ModalHeader>
        <ModalBody>
            <div class="row">
                <div class="col-md-4">
                    <div>
                        <img
                            class="product-card__img lazyload"
                            :data-src="`${baseUrl}/storage/${thumbnail}`"
                            data-sizes="auto"
                            alt=""
                            width="100%"
                        />
                    </div>
                    <div class="row product-slider">
                        <div class="col-md-6">
                            <img
                                class="product-card__img lazyload"
                                :data-src="`${baseUrl}/storage/${forwardImage}`"
                                data-sizes="auto"
                                alt=""
                                width="100%"
                            />
                        </div>
                        <div class="col-md-6">
                            <img
                                class="product-card__img lazyload"
                                :data-src="
                                    `${baseUrl}/storage/${backwardImage}`
                                "
                                data-sizes="auto"
                                alt=""
                                width="100%"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- <h3>NGUNDA BOOKS</h3> -->
                    <h3>{{ name }}</h3>
                    <p>
                        {{ description }}
                    </p>
                    <!-- <div class="btn-group">
            <button
              type="button"
              class="btn btn-danger dropdown-toggle"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
              Choose product
            </button>
          </div> -->
                </div>
            </div>
        </ModalBody>
        <ModalFooter>
            <button @click="addToCart(id, name)" class="btn btn-primary action">
                <span v-if="isAdded(id)">Remove from Cart</span>
                <span v-else>Add to Cart</span>
            </button>
            <!-- <button @click="close('Modal closed')" class="btn btn-primary action">
        Cancel
      </button> -->
        </ModalFooter>
    </Modal>
</template>

<script>
import Modal from "./Model.vue";
import ModalHeader from "./ModelHeader.vue";
import ModalFooter from "./ModelFooter.vue";
import ModalBody from "./ModelBody.vue";
import ModalMixin from "./ModelMixins";
import { mapState } from "vuex";
export default {
    components: { Modal, ModalHeader, ModalBody, ModalFooter },
    mixins: [ModalMixin],
    data() {
        return {
            imageUrl: "",
            baseUrl: "",
            added: "",
            remove: "",
            images: [1, 2]
        };
    },
    watch: {
        cart() {
            console.log("cart=>>>", this.cart);
        },
        products() {
            this.get_all_products();
        }
    },
    computed: {
        ...mapState("products", ["cart", "wishlist", "products", "categories"])
        // ...mapState(["cart", "whishlist"]),
    },
    mounted() {
        this.generateImageUrl();
    },
    props: {
        id: Number,
        name: String,
        description: String,
        thumbnail: String,
        forwardImage: String,
        backwardImage: String
    },

    methods: {
        generateImageUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
            this.imageUrl = this.baseUrl + "/assets/images/ngunda-novel.png";
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

<style scoped>
.action {
    background: rgb(252, 173, 0) !important;
    border-radius: 1.3rem;
    color: #fff;
}
h3 {
    color: rgb(252, 173, 0);
    font-size: 18px;
}

.btn {
    background: #fff;
    /* color: #000; */
    font-weight: 900;
}

.product-slider {
    margin: 0.5rem 0;
}
.d-flex {
    width: 100%;
}
</style>
