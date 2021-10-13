<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">View All Users</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item active">View all users</li>
      </ol>
      <div class="row d-none">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">
              <span
                ><i
                  style="font-size: 25px; margin-right: 10px"
                  class="fa fa-th-large"
                  aria-hidden="true"
                ></i></span
              >Products
            </div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <a class="small text-white stretched-link" href="#"
                >View Details</a
              >
              <div class="small text-white">
                <i class="fas fa-angle-right"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
              <span
                ><i
                  style="
                              font-size: 25px;
                              margin-right: 10px;
                              color: #ba933e;
                           "
                  class="fa fa-shopping-basket"
                  aria-hidden="true"
                ></i></span
              >Orders
            </div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <a class="small text-white stretched-link" href="#"
                >View Details</a
              >
              <div class="small text-white">
                <i class="fas fa-angle-right"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">
              <span
                ><i
                  style="font-size: 25px; margin-right: 10px"
                  class="fa fa-users"
                  aria-hidden="true"
                ></i></span
              >Clients
            </div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <a class="small text-white stretched-link" href="#"
                >View Details</a
              >
              <div class="small text-white">
                <i class="fas fa-angle-right"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-secondary text-white mb-4">
            <div class="card-body">
              <span
                ><i
                  style="
                              font-size: 25px;
                              margin-right: 10px;
                              color: #ba933e;
                           "
                  class="fas fa-credit-card"
                  aria-hidden="true"
                ></i></span
              >Earnings
            </div>
            <div
              class="card-footer d-flex align-items-center justify-content-between"
            >
              <a class="small text-white stretched-link" href="#"
                >View Details</a
              >
              <div class="small text-white">
                <i class="fas fa-angle-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="display: none !important">
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-area mr-1"></i>
              Area Chart Example
            </div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="40"></canvas>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-bar mr-1"></i>
              Bar Chart Example
            </div>
            <div class="card-body">
              <canvas id="myBarChart" width="100%" height="40"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa fa-users mr-1" aria-hidden="true"></i>
          All Users
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <div
              style="display: none"
              class="col-sm-12"
              v-show="users.length === 0"
            >
              <div class="card">
                <div class="card-body">
                  <center>
                    <h4 style="color: rgb(186, 147, 62)" class="card-title">
                      Oops!! No users available.
                    </h4>
                  </center>
                </div>
              </div>
            </div>
            <table
              style="font-size: 14px;"
              class="table table-bordered table-striped table-hover"
              id="dataTable"
              width="100%"
              cellspacing="0"
              v-if="users.length !== 0"
            >
              <thead>
                <tr>
                  <th>Avatar</th>
                  <th>Names</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Role</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="users.length > 0">
                <tr v-for="user in users" :key="user.id">
                  <td class="text-center">
                    <img
                      style="background:white;"
                      :src="`${baseUrl}/assets/images/default-avatar.png`"
                      class="user-img-avatar"
                      width="45"
                      alt="User"
                    />
                  </td>
                  <td>{{ user.names }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.phone }}</td>
                  <td>{{ user.address }}</td>
                  <td>{{ user.role }}</td>
                  <td>{{ user.date | moment("ddd, MMM Do YYYY") }}</td>
                  <td>
                    <button
                      class="btn btn-info btn-sm"
                      data-toggle="modal"
                      :data-target="`#edit_modal_${user.id}`"
                      @click="getSingleUser(user.id)"
                    >
                      <i class="fa fa-edit"></i>
                    </button>

                    <button
                      class="btn btn-danger btn-sm"
                      @click="delete_user(user.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div
      v-for="user in users"
      :key="'p3-' + user.id"
      class="modal fade bd-example-modal-lg"
      :id="`edit_modal_${user.id}`"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <form
          style="padding:30px 0px"
          @submit.prevent="updateUser(user.id)"
          enctype="multipart/form-data"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <img
                  style="background:white;"
                  :src="`${baseUrl}/assets/images/default-avatar.png`"
                  class="user-img-avatar"
                  width="45"
                  alt="User"
                />
                <span class="text-primary">{{ UserInfo.names }}</span>
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <div class="container">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputEmail4">Name:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      :id="`name_${user.id}`"
                      v-model="UserInfo.names"
                      placeholder="Name..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="nameErr">{{
                          errors.name["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Email:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="email"
                      :id="`email_${user.id}`"
                      v-model="UserInfo.email"
                      placeholder="Email..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="emailErr">{{
                          errors.email["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4"> Phone:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="phone"
                      :id="`phone_${user.id}`"
                      v-model="UserInfo.phone"
                      placeholder="Phone..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="phoneErr">{{
                          errors.phone["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Address:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="address"
                      :id="`address_${user.id}`"
                      v-model="UserInfo.address"
                      placeholder="Address..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="addressErr">{{
                          errors.address["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Country:</label>
                    <select
                      name="country"
                      :id="`country_${user.id}`"
                      v-model="UserInfo.country"
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
                      <option value="BOL"
                        >Bolivia, Plurinational State of</option
                      >
                      <option value="BES"
                        >Bonaire, Sint Eustatius and Saba</option
                      >
                      <option value="BIH">Bosnia and Herzegovina</option>
                      <option value="BWA">Botswana</option>
                      <option value="BVT">Bouvet Island</option>
                      <option value="BRA">Brazil</option>
                      <option value="IOT"
                        >British Indian Ocean Territory</option
                      >
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
                      <option value="COD"
                        >Congo, the Democratic Republic of the</option
                      >
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
                      <option value="HMD"
                        >Heard Island and McDonald Islands</option
                      >
                      <option value="VAT">Holy See (Vatican City State)</option>
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
                      <option value="PRK"
                        >Korea, Democratic People's Republic of</option
                      >
                      <option value="KOR">Korea, Republic of</option>
                      <option value="KWT">Kuwait</option>
                      <option value="KGZ">Kyrgyzstan</option>
                      <option value="LAO"
                        >Lao People's Democratic Republic</option
                      >
                      <option value="LVA">Latvia</option>
                      <option value="LBN">Lebanon</option>
                      <option value="LSO">Lesotho</option>
                      <option value="LBR">Liberia</option>
                      <option value="LBY">Libya</option>
                      <option value="LIE">Liechtenstein</option>
                      <option value="LTU">Lithuania</option>
                      <option value="LUX">Luxembourg</option>
                      <option value="MAC">Macao</option>
                      <option value="MKD"
                        >Macedonia, the former Yugoslav Republic of</option
                      >
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
                      <option value="FSM"
                        >Micronesia, Federated States of</option
                      >
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
                      <option value="PSE"
                        >Palestinian Territory, Occupied</option
                      >
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
                      <option value="SHN"
                        >Saint Helena, Ascension and Tristan da Cunha</option
                      >
                      <option value="KNA">Saint Kitts and Nevis</option>
                      <option value="LCA">Saint Lucia</option>
                      <option value="MAF">Saint Martin (French part)</option>
                      <option value="SPM">Saint Pierre and Miquelon</option>
                      <option value="VCT"
                        >Saint Vincent and the Grenadines</option
                      >
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
                      <option value="SGS"
                        >South Georgia and the South Sandwich Islands</option
                      >
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
                      <option value="TZA">Tanzania, United Republic of</option>
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
                      <option value="UMI"
                        >United States Minor Outlying Islands</option
                      >
                      <option value="URY">Uruguay</option>
                      <option value="UZB">Uzbekistan</option>
                      <option value="VUT">Vanuatu</option>
                      <option value="VEN"
                        >Venezuela, Bolivarian Republic of</option
                      >
                      <option value="VNM">Viet Nam</option>
                      <option value="VGB">Virgin Islands, British</option>
                      <option value="VIR">Virgin Islands, U.S.</option>
                      <option value="WLF">Wallis and Futuna</option>
                      <option value="ESH">Western Sahara</option>
                      <option value="YEM">Yemen</option>
                      <option value="ZMB">Zambia</option>
                      <option value="ZWE">Zimbabwe</option>
                    </select>
                    <span
                      ><i
                        ><small class="text-danger" v-if="countryErr">{{
                          errors.country["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">City:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="city"
                      :id="`city_${user.id}`"
                      v-model="UserInfo.city"
                      placeholder="City..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="cityErr">{{
                          errors.city["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Zip Code:</label>
                    <input
                      type="text"
                      class="form-control"
                      name="zipCode"
                      :id="`zipCode_${user.id}`"
                      v-model="UserInfo.zipCode"
                      placeholder="Zip Code..."
                    />
                    <span
                      ><i
                        ><small class="text-danger" v-if="zipCodeErr">{{
                          errors.zipCode["0"]
                        }}</small></i
                      ></span
                    >
                  </div>
                </div>

                <transition name="slide-fade">
                  <div
                    class="alert"
                    :class="{
                      'alert-danger': !success,
                      'alert-success': success,
                    }"
                    v-show="showMsg"
                  >
                    {{ message }}
                  </div>
                </transition>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-primary" :disabled="loading">
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
  </main>
  <!--MainContainer--END-->
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "ViewUsersContainer",
  data() {
    return {
      baseUrl: "",
      UserInfo: [],
      // errors variables
      nameErr: false,
      emailErr: false,
      phoneErr: false,
      addressErr: false,
      countryErr: false,
      cityErr: false,
      zipCodeErr: false,
      passwordErr: false,
      ErrorsAvailable: false,
      alertMsg: "",
      alertClass: "",
      errors: null,
      message: "",
      success: "",
      showMsg: false,
      loading: false,
      token: localStorage.getItem("userToken"),
    };
  },
  computed: {
    ...mapState({
      users: (state) => state.users.users,
    }),
  },
  mounted() {
    this.loadUsers();
    this.generateBaseUrl();
  },
  methods: {
    ...mapActions("users", ["getUsers"]),

    loadUsers() {
      this.getUsers();
    },
    generateBaseUrl() {
      let base_url = window.location.origin;
      this.baseUrl = base_url;
    },
    delete_user(id) {
      let r = confirm("Are you sure you want to delete this user?");
      if (r) {
        this.$store.dispatch("users/remove_user", id);
        this.loadUsers();
      }
    },
    getSingleUser(id) {
      this.$store
        .dispatch("users/get_single_user", { userId: id })
        .then((response) => {
          this.UserInfo = response;
          console.log(this.UserInfo);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateUser(id) {
      this.loading = true;
      let names = $("#name_" + id).val();
      let email = $("#email_" + id).val();
      let phone = $("#phone_" + id).val();
      let address = $("#address_" + id).val();
      let city = $("#city_" + id).val();
      let country = $("#country_" + id).val();
      let zipCode = $("#zipCode_" + id).val();
      const config = {
        headers: {
          Authorization: "Bearer " + this.token,
        },
      };

      let formData = new FormData();
      formData.append("id", id);
      formData.append("names", names);
      formData.append("email", email);
      formData.append("phone", phone);
      formData.append("address", address);
      formData.append("city", city);
      formData.append("country", country);
      formData.append("zipCode", zipCode);

      axios
        .post("/api/admin-update-user", formData, config)
        .then((response) => {
          this.loading = false;
          this.success = true;
          this.message = "User Updated successfully!";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);
          console.log(response.data);
          this.loadUsers();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          if ("name" in this.errors) {
            this.nameErr = true;
          }
          if ("email" in this.errors) {
            this.emailErr = true;
          }
          if ("phone" in this.errors) {
            this.phoneErr = true;
          }
          if ("address" in this.errors) {
            this.addressErr = true;
          }
          if ("country" in this.errors) {
            this.countryErr = true;
          }
          if ("city" in this.errors) {
            this.cityErr = true;
          }
          if ("zipCode" in this.errors) {
            this.zipCodeErr = true;
          }
          this.loading = false;
          this.success = false;
          this.message = `${error.response.data.message}`;
          this.showMsg = true;
          console.log(error.response.data.message);
        });
    },
  },
};
</script>
