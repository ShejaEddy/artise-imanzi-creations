<template>
  <div
    class="velaHomeBlogs mbGutter style1"
    style="background-color: rgba(0, 0, 0, 0); padding: 50px 0 20px;"
  >
    <div class="container">
      <div class="velaHomeBlogsInner">
        <div
          style="margin:0 auto; float:none; padding:10px 0px;"
          class="col-md-6"
        >
          <div class="card text-center">
            <div class="card-body">
              <form @submit.prevent="googleAuth()" accept-charset="UTF-8">
                <h5 class="card-title">
                  <img
                    class="mr-2"
                    :src="`${baseUrl}/assets/images/google.png`"
                    width="40"
                    alt=""
                  />
                </h5>
                <p class="card-text">
                  Please select your role:
                </p>

                <div class="formContent">
                  <div class="col-md-12">
                    <div
                      style="margin:0 auto; float:none;"
                      class="form-group col-md-5"
                    >
                      <select v-model="role" class="custom-select" required>
                        <option selected value=""
                          >---Select your role---</option
                        >
                        <option value="artist">Artist</option>
                        <option value="buyer">Buyer</option>
                      </select>
                    </div>
                  </div>
                  <button
                    style="margin:15px auto; float:none;"
                    type="submit"
                    class="btn btnVelaOne col-md-4"
                    :disabled="loading"
                  >
                    Continue
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
    </div>
  </div>
</template>
<script>
export default {
  name: "GoogleAuthorization",
  data() {
    return {
      loading: false,
      baseUrl: "",
      showFilter: false,
      code: this.$route.query.code,
      role: "",
    };
  },
  computed: {},
  mounted() {
    this.scrollTop();
    this.generateBaseUrl();
  },

  methods: {
    googleAuth() {
      if (this.role.length > 0) {
        this.loading = true;
        let data = {
          role: this.role,
          code: this.code,
          provider: "google",
        };
        this.$store
          .dispatch("users/GoogleAuth", data)
          .then((response) => {
            console.log("success");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    generateBaseUrl() {
      let base_url = window.location.origin;
      this.baseUrl = base_url;
    },
    scrollTop() {
      this.intervalId = setInterval(() => {
        if (window.pageYOffset == 0) {
          clearInterval(this.intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
      }, 20);
    },
  },
};
</script>

<style scoped>
.custom-select {
  display: inline-block;
  width: 100%;
  height: 40px !important;
  padding: 9px 15px !important;
  font-size: 14px !important;
  font-weight: 400 !important;
  line-height: 1.6 !important;
  color: #495057;
}
</style>
