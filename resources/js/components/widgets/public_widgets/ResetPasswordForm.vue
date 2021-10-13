<template>
  <section id="pageContent">
    <div class="container">
      <div class="velaAccountContainer">
        <div class="velaFormAccount">
          <div class="container text-center">
            <h3>Reset Password</h3>
          </div>
          <div class="tab-content">
            <div class="tab-pane active">
              <div
                id="ResetPasswordAlert"
                class="resetPassword alert alert-success p-3"
                :class="{
                  show: show_email_alert,
                  hidden: !show_email_alert,
                }"
              >
                <i class="fas fa-exclamation-circle mr-3"></i>
                We&#39;ve sent you an email with the Verification Code.
              </div>
              <transition name="slide-fade">
                <div
                  class="alert p-3"
                  :class="alertClass"
                  role="alert"
                  v-if="ErrorAvailable"
                >
                  <i class="fas fa-exclamation-circle mr-3"></i>{{ alertMsg }}
                </div>
              </transition>

              <div id="CustomerLoginForm" class="formAccount formAccountLogin">
                <form
                  id="customer_login"
                  @submit.prevent="ResetPassword()"
                  accept-charset="UTF-8"
                >
                  <input
                    type="hidden"
                    name="form_type"
                    value="customer_login"
                  /><input type="hidden" name="utf8" value="✓" />
                  <div class="formContent">
                    <div class="form-group">
                      <label for="RecoverEmail" class="hidden"
                        >Verification Code</label
                      >
                      <input
                        type="number"
                        name="vcode"
                        id="vcode"
                        v-model="vcode"
                        class="form-control"
                        placeholder="Verification Code"
                        required
                        @keyup="count_vcode_char()"
                      />
                      <span
                        ><i
                          ><small class="text-danger" v-if="RSvcodeErr">{{
                            errors.vcode["0"]
                          }}</small></i
                        ></span
                      >
                    </div>
                    <div class="form-group form-group--pasword">
                      <label for="CustomerPassword" class="hidden"
                        >New Password</label
                      >
                      <input
                        type="password"
                        value=""
                        name="password"
                        id="password"
                        v-model="password"
                        class="form-control"
                        placeholder="New Password"
                        required
                      />
                      <a
                        href="javascript:void(0)"
                        class="velaShowPassword"
                        @click="showPWD()"
                        >Show</a
                      >
                      <span
                        ><i
                          ><small class="text-danger" v-if="RSpasswordErr">{{
                            errors.password["0"]
                          }}</small></i
                        ></span
                      >
                    </div>
                    <div class="form-button">
                      <button
                        type="submit"
                        class="btn btnVelaOne"
                        :disabled="loading"
                      >
                        Reset Password
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
  </section>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "ResetPasswordForm",
  data: function() {
    return {
      email: this.$route.params.email,
      password: "",
      vcode: "",
      showBlock: false,
      ErrorAvailable: false,
      RSvcodeErr: false,
      RSpasswordErr: false,
      alertMsg: "",
      errors: null,
      show_email_alert: true,
      loading: false,
    };
  },

  mounted() {
    this.scrollTop();
  },
  methods: {
    count_vcode_char() {
      if (this.vcode.length == 6) {
        this.show_email_alert = false;
      }
    },
    scrollTop() {
      this.intervalId = setInterval(() => {
        if (window.pageYOffset == 0) {
          clearInterval(this.intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
      }, 20);
    },

    // Show and Hide password
    showPWD() {
      $("body").on("click", ".velaShowPassword", function(event) {
        var btnPassword = $(this),
          passwordField = btnPassword.prev("input");
        if (passwordField.attr("type") == "password") {
          passwordField.attr("type", "text");
          btnPassword.text("Hide");
        } else {
          passwordField.attr("type", "password");
          btnPassword.text("Show");
        }
      });
    },

    // Reset User Password
    ResetPassword() {
      this.loading = true;
      // Reset some variables
      this.alertMsg = "";
      this.alertClass = "";
      this.ErrorAvailable = false;
      this.RSpasswordErr = false;

      let data = {
        email: this.email,
        vcode: this.vcode,
        password: this.password,
      };

      this.$store
        .dispatch("users/ResetPassword", data)
        .then((response) => {
          this.loading = false;
          if (response == "Success") {
            this.alertMsg = "New password saved successfully!";
            this.alertClass = "alert-success";
            this.ErrorAvailable = true;
            this.scrollTop();
            setTimeout(function() {
              window.location.assign("/account");
            }, 2000);
          } else {
            this.alertMsg = "Invalid Verification Code, Request a new one!";
            this.ErrorAvailable = true;
            this.alertClass = "alert-danger";
            this.loading = false;
          }
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error.response.data.errors;
          if ("vcode" in this.errors) {
            this.RSvcodeErr = true;
          }
          if ("password" in this.errors) {
            this.RSpasswordErr = true;
          }
          this.alertMsg = error.response.data.message;
          this.ErrorAvailable = true;
          this.alertClass = "alert-danger";
        });
    },
  },
};
</script>
