<template>
  <div class="container-fluid pb-5">
    <h1 class="mt-4">Edit Profile</h1>
    <ol class="admin-breadcrumb mb-4">
      <li class="admin-breadcrumb-item active">Profile</li>
    </ol>
    <div class="card">
      <div class="card-header">
        <h4>Edit Profile</h4>
      </div>
      <div class="card-body">
        <transition name="slide-fade">
          <div
            class="alert"
            :class="{
              'alert-danger': !success,
              'alert-success': success,
            }"
            v-show="showMsg && isProfile"
            v-html="message"
          ></div>
        </transition>
        <div class="row">
          <form class="col-md-12">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="inputFirstName"
                    >First Name</label
                  >
                  <input
                    class="form-control py-4"
                    id="inputFirstName"
                    type="text"
                    v-model="user.firstName"
                    placeholder="Enter first name"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="inputLastName"
                    >Last Name</label
                  >
                  <input
                    class="form-control py-4"
                    id="inputLastName"
                    type="text"
                    v-model="user.lastName"
                    placeholder="Enter last name"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="inputEmailAddress">Email</label>
              <input
                class="form-control py-4"
                id="inputEmailAddress"
                type="email"
                v-model="user.email"
                aria-describedby="emailHelp"
                placeholder="Enter email address"
              />
            </div>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="address">Address</label>
                  <input
                    class="form-control py-4"
                    id="address"
                    type="text"
                    v-model="user.address"
                    placeholder="Enter Address"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="city">City</label>
                  <input
                    class="form-control py-4"
                    id="city"
                    type="text"
                    v-model="user.city"
                    placeholder="Enter City"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="Country">Country</label>
              <select
                name="country"
                id="country"
                v-model="user.country"
                class="form-control"
                required
              >
                <option value="">--select country--</option>
                <option value="AFG">Afghanistan</option>
                <option value="ALA">Åland Islands</option>
                <option value="ALB">Albania</option>
                <option value="DZA">Algeria</option>
                <option value="ASM">American Samoa</option>
                <option value="AND">Andorra</option>
                <option value="AGO">Angola</option>
                <option value="AIA">Anguilla</option>
                <option value="ATA">Antarctica</option>
                <option value="ATG">Antigua and Barbuda</option>
                <option value="ARG">Argentina</option>
                <option value="ARM">Armenia</option>
                <option value="ABW">Aruba</option>
                <option value="AUS">Australia</option>
                <option value="AUT">Austria</option>
                <option value="AZE">Azerbaijan</option>
                <option value="BHS">Bahamas</option>
                <option value="BHR">Bahrain</option>
                <option value="BGD">Bangladesh</option>
                <option value="BRB">Barbados</option>
                <option value="BLR">Belarus</option>
                <option value="BEL">Belgium</option>
                <option value="BLZ">Belize</option>
                <option value="BEN">Benin</option>
                <option value="BMU">Bermuda</option>
                <option value="BTN">Bhutan</option>
                <option value="BOL">
                  Bolivia, Plurinational State of
                </option>
                <option value="BES">
                  Bonaire, Sint Eustatius and Saba
                </option>
                <option value="BIH">Bosnia and Herzegovina</option>
                <option value="BWA">Botswana</option>
                <option value="BVT">Bouvet Island</option>
                <option value="BRA">Brazil</option>
                <option value="IOT">
                  British Indian Ocean Territory
                </option>
                <option value="BRN">Brunei Darussalam</option>
                <option value="BGR">Bulgaria</option>
                <option value="BFA">Burkina Faso</option>
                <option value="BDI">Burundi</option>
                <option value="KHM">Cambodia</option>
                <option value="CMR">Cameroon</option>
                <option value="CAN">Canada</option>
                <option value="CPV">Cape Verde</option>
                <option value="CYM">Cayman Islands</option>
                <option value="CAF">Central African Republic</option>
                <option value="TCD">Chad</option>
                <option value="CHL">Chile</option>
                <option value="CHN">China</option>
                <option value="CXR">Christmas Island</option>
                <option value="CCK">Cocos (Keeling) Islands</option>
                <option value="COL">Colombia</option>
                <option value="COM">Comoros</option>
                <option value="COG">Congo</option>
                <option value="COD">
                  Congo, the Democratic Republic of the
                </option>
                <option value="COK">Cook Islands</option>
                <option value="CRI">Costa Rica</option>
                <option value="CIV">Côte d'Ivoire</option>
                <option value="HRV">Croatia</option>
                <option value="CUB">Cuba</option>
                <option value="CUW">Curaçao</option>
                <option value="CYP">Cyprus</option>
                <option value="CZE">Czech Republic</option>
                <option value="DNK">Denmark</option>
                <option value="DJI">Djibouti</option>
                <option value="DMA">Dominica</option>
                <option value="DOM">Dominican Republic</option>
                <option value="ECU">Ecuador</option>
                <option value="EGY">Egypt</option>
                <option value="SLV">El Salvador</option>
                <option value="GNQ">Equatorial Guinea</option>
                <option value="ERI">Eritrea</option>
                <option value="EST">Estonia</option>
                <option value="ETH">Ethiopia</option>
                <option value="FLK">Falkland Islands (Malvinas)</option>
                <option value="FRO">Faroe Islands</option>
                <option value="FJI">Fiji</option>
                <option value="FIN">Finland</option>
                <option value="FRA">France</option>
                <option value="GUF">French Guiana</option>
                <option value="PYF">French Polynesia</option>
                <option value="ATF">French Southern Territories</option>
                <option value="GAB">Gabon</option>
                <option value="GMB">Gambia</option>
                <option value="GEO">Georgia</option>
                <option value="DEU">Germany</option>
                <option value="GHA">Ghana</option>
                <option value="GIB">Gibraltar</option>
                <option value="GRC">Greece</option>
                <option value="GRL">Greenland</option>
                <option value="GRD">Grenada</option>
                <option value="GLP">Guadeloupe</option>
                <option value="GUM">Guam</option>
                <option value="GTM">Guatemala</option>
                <option value="GGY">Guernsey</option>
                <option value="GIN">Guinea</option>
                <option value="GNB">Guinea-Bissau</option>
                <option value="GUY">Guyana</option>
                <option value="HTI">Haiti</option>
                <option value="HMD">
                  Heard Island and McDonald Islands
                </option>
                <option value="VAT">
                  Holy See (Vatican City State)
                </option>
                <option value="HND">Honduras</option>
                <option value="HKG">Hong Kong</option>
                <option value="HUN">Hungary</option>
                <option value="ISL">Iceland</option>
                <option value="IND">India</option>
                <option value="IDN">Indonesia</option>
                <option value="IRN">Iran, Islamic Republic of</option>
                <option value="IRQ">Iraq</option>
                <option value="IRL">Ireland</option>
                <option value="IMN">Isle of Man</option>
                <option value="ISR">Israel</option>
                <option value="ITA">Italy</option>
                <option value="JAM">Jamaica</option>
                <option value="JPN">Japan</option>
                <option value="JEY">Jersey</option>
                <option value="JOR">Jordan</option>
                <option value="KAZ">Kazakhstan</option>
                <option value="KEN">Kenya</option>
                <option value="KIR">Kiribati</option>
                <option value="PRK">
                  Korea, Democratic People's Republic of
                </option>
                <option value="KOR">Korea, Republic of</option>
                <option value="KWT">Kuwait</option>
                <option value="KGZ">Kyrgyzstan</option>
                <option value="LAO">
                  Lao People's Democratic Republic
                </option>
                <option value="LVA">Latvia</option>
                <option value="LBN">Lebanon</option>
                <option value="LSO">Lesotho</option>
                <option value="LBR">Liberia</option>
                <option value="LBY">Libya</option>
                <option value="LIE">Liechtenstein</option>
                <option value="LTU">Lithuania</option>
                <option value="LUX">Luxembourg</option>
                <option value="MAC">Macao</option>
                <option value="MKD">
                  Macedonia, the former Yugoslav Republic of
                </option>
                <option value="MDG">Madagascar</option>
                <option value="MWI">Malawi</option>
                <option value="MYS">Malaysia</option>
                <option value="MDV">Maldives</option>
                <option value="MLI">Mali</option>
                <option value="MLT">Malta</option>
                <option value="MHL">Marshall Islands</option>
                <option value="MTQ">Martinique</option>
                <option value="MRT">Mauritania</option>
                <option value="MUS">Mauritius</option>
                <option value="MYT">Mayotte</option>
                <option value="MEX">Mexico</option>
                <option value="FSM">
                  Micronesia, Federated States of
                </option>
                <option value="MDA">Moldova, Republic of</option>
                <option value="MCO">Monaco</option>
                <option value="MNG">Mongolia</option>
                <option value="MNE">Montenegro</option>
                <option value="MSR">Montserrat</option>
                <option value="MAR">Morocco</option>
                <option value="MOZ">Mozambique</option>
                <option value="MMR">Myanmar</option>
                <option value="NAM">Namibia</option>
                <option value="NRU">Nauru</option>
                <option value="NPL">Nepal</option>
                <option value="NLD">Netherlands</option>
                <option value="NCL">New Caledonia</option>
                <option value="NZL">New Zealand</option>
                <option value="NIC">Nicaragua</option>
                <option value="NER">Niger</option>
                <option value="NGA">Nigeria</option>
                <option value="NIU">Niue</option>
                <option value="NFK">Norfolk Island</option>
                <option value="MNP">Northern Mariana Islands</option>
                <option value="NOR">Norway</option>
                <option value="OMN">Oman</option>
                <option value="PAK">Pakistan</option>
                <option value="PLW">Palau</option>
                <option value="PSE">
                  Palestinian Territory, Occupied
                </option>
                <option value="PAN">Panama</option>
                <option value="PNG">Papua New Guinea</option>
                <option value="PRY">Paraguay</option>
                <option value="PER">Peru</option>
                <option value="PHL">Philippines</option>
                <option value="PCN">Pitcairn</option>
                <option value="POL">Poland</option>
                <option value="PRT">Portugal</option>
                <option value="PRI">Puerto Rico</option>
                <option value="QAT">Qatar</option>
                <option value="REU">Réunion</option>
                <option value="ROU">Romania</option>
                <option value="RUS">Russian Federation</option>
                <option value="RWA">Rwanda</option>
                <option value="BLM">Saint Barthélemy</option>
                <option value="SHN">
                  Saint Helena, Ascension and Tristan da Cunha
                </option>
                <option value="KNA">Saint Kitts and Nevis</option>
                <option value="LCA">Saint Lucia</option>
                <option value="MAF">Saint Martin (French part)</option>
                <option value="SPM">Saint Pierre and Miquelon</option>
                <option value="VCT">
                  Saint Vincent and the Grenadines
                </option>
                <option value="WSM">Samoa</option>
                <option value="SMR">San Marino</option>
                <option value="STP">Sao Tome and Principe</option>
                <option value="SAU">Saudi Arabia</option>
                <option value="SEN">Senegal</option>
                <option value="SRB">Serbia</option>
                <option value="SYC">Seychelles</option>
                <option value="SLE">Sierra Leone</option>
                <option value="SGP">Singapore</option>
                <option value="SXM">Sint Maarten (Dutch part)</option>
                <option value="SVK">Slovakia</option>
                <option value="SVN">Slovenia</option>
                <option value="SLB">Solomon Islands</option>
                <option value="SOM">Somalia</option>
                <option value="ZAF">South Africa</option>
                <option value="SGS">
                  South Georgia and the South Sandwich Islands
                </option>
                <option value="SSD">South Sudan</option>
                <option value="ESP">Spain</option>
                <option value="LKA">Sri Lanka</option>
                <option value="SDN">Sudan</option>
                <option value="SUR">Suriname</option>
                <option value="SJM">Svalbard and Jan Mayen</option>
                <option value="SWZ">Swaziland</option>
                <option value="SWE">Sweden</option>
                <option value="CHE">Switzerland</option>
                <option value="SYR">Syrian Arab Republic</option>
                <option value="TWN">Taiwan, Province of China</option>
                <option value="TJK">Tajikistan</option>
                <option value="TZA">
                  Tanzania, United Republic of
                </option>
                <option value="THA">Thailand</option>
                <option value="TLS">Timor-Leste</option>
                <option value="TGO">Togo</option>
                <option value="TKL">Tokelau</option>
                <option value="TON">Tonga</option>
                <option value="TTO">Trinidad and Tobago</option>
                <option value="TUN">Tunisia</option>
                <option value="TUR">Turkey</option>
                <option value="TKM">Turkmenistan</option>
                <option value="TCA">Turks and Caicos Islands</option>
                <option value="TUV">Tuvalu</option>
                <option value="UGA">Uganda</option>
                <option value="UKR">Ukraine</option>
                <option value="ARE">United Arab Emirates</option>
                <option value="GBR">United Kingdom</option>
                <option value="USA">United States</option>
                <option value="UMI">
                  United States Minor Outlying Islands
                </option>
                <option value="URY">Uruguay</option>
                <option value="UZB">Uzbekistan</option>
                <option value="VUT">Vanuatu</option>
                <option value="VEN">
                  Venezuela, Bolivarian Republic of
                </option>
                <option value="VNM">Viet Nam</option>
                <option value="VGB">Virgin Islands, British</option>
                <option value="VIR">Virgin Islands, U.S.</option>
                <option value="WLF">Wallis and Futuna</option>
                <option value="ESH">Western Sahara</option>
                <option value="YEM">Yemen</option>
                <option value="ZMB">Zambia</option>
                <option value="ZWE">Zimbabwe</option>
              </select>
            </div>
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="phone">Phone</label>
                  <input
                    class="form-control py-4"
                    id="phone"
                    type="text"
                    v-model="user.phone"
                    placeholder="Enter Phone"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="zipCode">Zip Code</label>
                  <input
                    class="form-control py-4"
                    id="zipCode"
                    type="text"
                    v-model="user.zipCode"
                    placeholder="Enter Zip Code"
                  />
                </div>
              </div>
            </div>
            <div class="form-group mt-4 mb-0">
              <button
                class="btn btn-primary btn-lg btn-block"
                type="button"
                @click="updateUser"
                :disabled="loading"
              >
                Update Account
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
    <div class="card mt-5">
      <div class="card-header">
        <h4>Change Password</h4>
      </div>
      <div class="card-body">
        <transition name="slide-fade">
          <div
            class="alert"
            :class="{
              'alert-danger': !success,
              'alert-success': success,
            }"
            v-show="showMsg && !isProfile"
          >
            {{ message }}
          </div>
        </transition>
        <div class="row">
          <form class="col-md-12">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="inputPassword">Password</label>
                  <input
                    class="form-control py-4"
                    id="inputPassword"
                    type="password"
                    v-model="password.password"
                    placeholder="Enter New password"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="small mb-1" for="inputConfirmPassword"
                    >Confirm Password</label
                  >
                  <input
                    class="form-control py-4"
                    id="inputConfirmPassword"
                    type="password"
                    v-model="password.password_confirmation"
                    placeholder="Confirm password"
                  />
                </div>
              </div>
            </div>
            <div class="form-group mt-4 mb-0">
              <button
                class="btn btn-primary btn-lg btn-block"
                type="button"
                @click.prevent="changePassword"
                :disabled="loading"
              >
                Change Password
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
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "ProfileContainer",
  data() {
    return {
      user: {},
      password: {
        password: "",
        password_confirmation: "",
      },
      loading: false,
      isProfile: false,
      success: false,
      message: "",
      showMsg: false,
    };
  },
  computed: {
    ...mapState("users", ["userInfo", "userId"]),
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      let names = this.userInfo.names.split(" ");
      this.user = this.userInfo;
      this.user.id = this.userId;
      this.password.id = this.userId;
      this.user.firstName = names[0];
      this.user.lastName = names[1];
    },
    updateUser() {
      this.isProfile = true;
      this.loading = true;
      this.showMsg = false;
      this.$store
        .dispatch("users/updateUser", this.user)
        .then((response) => {
          this.loading = false;
          this.success = true;
          this.message = "<p>Your Profile updated successfully!!</p>";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
        })
        .catch((error) => {
          this.loading = false;
          console.log(error);
          console.log(error.response);
          this.success = false;
          this.showMsg = true;
          this.message =
            "<p><strong>" + error.response.data.message + "</strong></p>";
          error.response.data.errors.firstName.forEach((element) => {
            console.log(element);
            this.message += "<p>" + element + "</p>";
          });
          error.response.data.errors.lastName.forEach((element) => {
            console.log(element);
            this.message += "<p>" + element + "</p>";
          });
          error.response.data.errors.email.forEach((element) => {
            console.log(element);
            this.message += "<p>" + element + "</p>";
          });
        });
    },
    changePassword() {
      this.isProfile = false;
      this.loading = true;
      this.showMsg = false;
      this.$store
        .dispatch("users/changePassword", this.password)
        .then((response) => {
          this.password = {
            password: "",
            password_confirmation: "",
          };
          this.loading = false;
          this.success = true;
          this.message = "<p>Your Password was successfully changed!!</p>";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
        })
        .catch((error) => {
          this.isProfile = false;
          this.loading = false;
          console.log(error);
          console.log(error.response);
          this.success = false;
          this.showMsg = true;
          this.message =
            "<p><strong>" + error.response.data.message + "</strong></p>";
          error.response.data.errors.password.forEach((element) => {
            console.log(element);
            this.message += "<p>" + element + "</p>";
          });
        });
    },
  },
};
</script>

<style></style>
