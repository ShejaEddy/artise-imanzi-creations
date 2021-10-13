<template>
  <Modal>
    <ModalHeader>
      <div class="d-flex justify-content-end">
        <button @click="close('Modal closed')" class="btn btn-primary action">
          Cancel
        </button>
      </div>
    </ModalHeader>
    <ModalBody>
      <div class="mx-auto">
        <h2 class="mx-auto">IT'S A FREE GIVE AWAY</h2>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="mt-4">
            <img
              class="product-card__img lazyload"
              :data-src="imageUrl"
              data-sizes="auto"
              alt=""
              width="100%"
            />
          </div>
        </div>
        <div class="col-md-8">
          <h3>NDOLI VOLUME E1 GIVE AWAY</h3>
          <p>
            NGUNDA, Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            Integer faucibus nulla non quam sollicitudin semper. Fusce ut
            suscipit nunc. Donec suscipit, orci sed semper commodo
          </p>
        </div>
      </div>
    </ModalBody>
    <ModalFooter>
      <form class="row g-3">
        <div class="col-auto">
          <input
            type="text"
            class="form-control"
            placeholder="Enter phone number"
          />
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-primary mb-3 action">
            RECEIVE PRODUCT
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
export default {
  components: { Modal, ModalHeader, ModalBody, ModalFooter },
  mixins: [ModalMixin],
  data() {
    return {
      imageUrl: "",
      baseUrl: "",
      images: [1, 2],
    };
  },
  mounted() {
    this.generateImageUrl();
  },
  methods: {
    generateImageUrl() {
      let base_url = window.location.origin;
      this.baseUrl = base_url;
      this.imageUrl = this.baseUrl + "/assets/images/ngunda-novel.png";
    },
  },
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