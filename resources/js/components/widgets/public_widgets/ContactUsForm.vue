<template>
  <section id="pageContent">
    <div class="container-full">
      <div class="pageContainer">
        <div id="shopify-section-vela-template-contact" class="shopify-section">
          <div class="pageContact">
            <div class="velaGoogleMap mb40">
              <div
                id="googleMapvela-template-contact"
                class="velaGoogleMapInner"
              >
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31900.292483377038!2d30.060937779896463!3d-1.937834768263611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6a40203f041%3A0x5f8434259d8c4393!2sKacyiru%2C%20Kigali!5e0!3m2!1sen!2srw!4v1603144551464!5m2!1sen!2srw"
                  width="1500"
                  height="590"
                  frameborder="0"
                  style="border:0;"
                  allowfullscreen=""
                  aria-hidden="false"
                  tabindex="0"
                ></iframe>
              </div>
              <!-- <div class="googleOverPlay"></div> -->
            </div>
            <div class="pageContactInfo mb30">
              <div class="container">
                <div class="rowFlex rowFlexMargin">
                  <div class="col-xs-12 col-md-12 mb30 text-center">
                    <div class="about-us-p">
                      Founded in 2019, Imanzi Creations Ltd is a creative studio
                      that publishes books and animated stories, with the aim of
                      entertaining, and inspiring people in Rwanda and beyond.
                      It is headquartered in Kigali, Rwanda.
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-5 mb30">
                    <div class="pageContactLeft">
                      <h1 class="velaContactTitle">Contact Us</h1>
                      <div class="rowFlex rowFlexMargin">
                        <div class="col-xs-12">
                          <div class="contactDetail">
                            <p>
                              For any questions and suggestions reach out to us
                              and we will get back to you as soon as
                              possible.<br /><br />
                            </p>
                            <p></p>
                            <p>
                              <strong>Add:&nbsp;</strong> Kg 167 st Kacyiru,
                              Kigali, Rwanda
                            </p>
                            <p>
                              <strong>Phone:</strong>&nbsp; (+250) 780 347 100
                            </p>
                            <p>
                              <strong>Email:&nbsp;</strong>
                              info@artise.africa
                            </p>
                            <p>
                              <strong>Open:</strong>&nbsp; 8am - 7pm, Mon - Sat
                            </p>
                            <p></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-7 mb20">
                    <div class="pageContactRight">
                      <transition name="slide-fade">
                        <div
                          class="alert p-3"
                          :class="alertClass"
                          role="alert"
                          v-if="showMsg"
                        >
                          <i class="fas fa-exclamation-circle mr-3"></i
                          >{{ alertMsg }}
                        </div>
                      </transition>
                      <div class="formContactUs">
                        <form
                          @submit.prevent="SendMail()"
                          id="contact_form"
                          accept-charset="UTF-8"
                          class="contact-form"
                        >
                          <input
                            type="hidden"
                            name="form_type"
                            value="contact"
                          /><input type="hidden" name="utf8" value="✓" />
                          <div class="formContent">
                            <div class="row">
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="ContactFormName" class="hidden"
                                    >Name <sup>*</sup></label
                                  >
                                  <input
                                    type="text"
                                    id="ContactFormName"
                                    class="form-control"
                                    placeholder="Name"
                                    name="contact[name]"
                                    autocapitalize="words"
                                    v-model="names"
                                    required
                                  />
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="ContactFormEmail" class="hidden"
                                    >Email <sup>*</sup></label
                                  >
                                  <input
                                    type="email"
                                    id="ContactFormEmail"
                                    class="form-control"
                                    placeholder="Email"
                                    name="contact[email]"
                                    autocorrect="off"
                                    autocapitalize="off"
                                    v-model="email"
                                    required
                                  />
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group">
                                  <label for="ContactFormMessage" class="hidden"
                                    >Message<sup>*</sup></label
                                  >
                                  <textarea
                                    rows="6"
                                    id="ContactFormMessage"
                                    class="form-control"
                                    placeholder="Message"
                                    v-model="message"
                                    required
                                    name="contact[body]"
                                  ></textarea>
                                </div>
                              </div>
                            </div>
                            <div class="form-button">
                              <button
                                type="submit"
                                class="btn btnVelaOne col-md-12"
                                :disabled="loading"
                              >
                                Send message
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "ContactUsForm",
  data: function() {
    return {
      loading: false,
      names: "",
      email: "",
      message: "",
      alertClass: "alert-success",
      alertMsg: "Success!!!",
      showMsg: false,
    };
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
    SendMail() {
      this.loading = true;
      let data = {
        names: this.names,
        email: this.email,
        message: this.message,
      };
      this.$store
        .dispatch("products/ContactUsMail", data)
        .then((response) => {
          if (response == "Success") {
            this.loading = false;
            this.alertMsg =
              "Thanks for contacting us! We will be in touch with you shortly.";
            this.alertClass = "alert-success";
            this.showMsg = true;
            this.names = "";
            this.email = "";
            this.message = "";
            setInterval(() => {
              this.showMsg = false;
            }, 4000);
            //this.scrollTop();
          }
        })
        .catch((error) => {
          this.loading = false;
          this.alertMsg = "Something went wrong pleas try again later.";
          this.alertClass = "alert-danger";
          this.showMsg = true;
          //this.scrollTop();
        });
    },
  },
};
</script>
<style>
.about-us-p {
  width: 50%;
  margin: 0px auto 50px auto;
}
/* Smartphone & kindle (portrait and landscape) ----------- */
@media only screen and (min-width: 320px) and (max-width: 700px) {
  .about-us-p {
    width: 100%;
    margin: auto;
  }
}
/* iPads (portrait and landscape) ----------- */
@media only screen and (min-width: 768px) and (max-width: 1024px) {
  .about-us-p {
    width: 70%;
    margin: 0px auto 50px auto;
  }
}
</style>
