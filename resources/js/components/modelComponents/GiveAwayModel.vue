<template>
    <Modal v-model="open">
        <ModalHeader>
            <div class="d-flex justify-content-end">
                <button
                    @click="close('Modal closed')"
                    class="btn btn-primary action"
                >
                    {{ success ? "Close" : "Cancel" }}
                </button>
            </div>
        </ModalHeader>
        <ModalBody v-if="!success">
            <div class="mx-auto">
                <h2 class="mx-auto text-center mt-2">IT'S A FREE GIVE AWAY</h2>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-4">
                        <img
                            class="product-card__img lazyload"
                            :data-src="generateImageUrl(giveAway.forwardImage)"
                            data-sizes="auto"
                            alt=""
                            width="100%"
                        />
                    </div>
                </div>
                <div class="col-md-8">
                    <h3>{{ giveAway.name }}</h3>
                    <p>
                        {{ giveAway.shortDesc }}
                    </p>
                </div>
            </div>
        </ModalBody>
        <modal-body v-else>
            <div class="mx-auto p-5">
                <h4 class="mx-auto text-center my-5">
                    Congratulations! Kindly wait for your request to be
                    approved.
                </h4>
            </div>
        </modal-body>
        <ModalFooter v-if="!success">
            <form class="row g-3" @submit.prevent="storeRequest">
                <div class="d-flex justify-content-between px-5">
                    <div class="w-100">
                        <input
                            type="text"
                            class="form-control mr-3"
                            placeholder="Your full names"
                            v-model="giveAwayData.full_names"
                            required
                        />
                        <span
                            ><i
                                ><small
                                    class="text-danger mt-2"
                                    v-if="errors.full_names"
                                    >{{ errors.full_names["0"] }}</small
                                ></i
                            ></span
                        >
                    </div>
                    <div class="w-100">
                        <input
                            type="number"
                            class="form-control ml-3"
                            placeholder="Enter phone number"
                            required
                            v-model="giveAwayData.phone"
                        />
                        <span
                            ><i
                                ><small
                                    class="text-danger mt-2"
                                    v-if="errors.phone"
                                    >{{ errors.phone["0"] }}</small
                                ></i
                            ></span
                        >
                    </div>
                </div>

                <div class="col-auto mt-4 w-100">
                    <button
                        type="submit"
                        class="btn btn-primary mb-3 action block btn-block"
                    >
                        <div
                            v-if="loading"
                            class="spinner-border text-light ml-3"
                            role="status"
                        >
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span v-else>SUBMIT REQUEST</span>
                    </button>
                </div>
            </form>
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
            errors: {},
            success: false,
            loading: false,
            giveAwayData: {}
        };
    },
    computed: {
        ...mapState({
            giveAway: state => state.products.giveAway
        })
    },
    mounted() {},
    methods: {
        generateImageUrl(img) {
            let base_url = window.location.origin;
            return `${base_url}/uploads/images/${img}`;
        },
        storeRequest() {
            this.loading = true;
            this.errors = {};
            this.$store
                .dispatch("products/storeGiveAwayRequest", {
                    phone: this.giveAwayData.phone,
                    full_names: this.giveAwayData.full_names,
                    product_id: this.giveAway.id
                })
                .then(res => {
                    this.success = true;
                })
                .catch(err => {
                    if (err.response && err.response.data.errors)
                        this.errors = err.response.data.errors;
                    console.log(err.response);
                })
                .finally(() => (this.loading = false));
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
    color: rgb(0, 0, 0);
    font-size: 18px;
}

h2 {
    color: rgb(252, 173, 0);
    font-size: 24px;
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

input {
    background: rgb(236, 229, 213) !important;
    border-radius: 1.3rem !important;
}
</style>
