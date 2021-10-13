<template>
    <section id="pageContent">
        <div class="container">
            <div class="velaAccountContainer">
                <div class="velaFormAccount">
                    <ul class="nav navFormAccount">
                        <li
                            :class="{
                                active: activateLogin,
                                inactive: !activateLogin
                            }"
                            @click="activateTabs('login')"
                        >
                            <a href="#frmAccountTabLogin" data-toggle="tab">
                                Login
                            </a>
                        </li>
                        <li
                            :class="{
                                active: activateRegister,
                                inactive: !activateRegister
                            }"
                            @click="activateTabs('register')"
                        >
                            <a href="#frmAccountTabRegister" data-toggle="tab">
                                Create Account
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div
                            id="frmAccountTabLogin"
                            class="tab-pane"
                            :class="{
                                active: activateLogin,
                                inactive: !activateLogin
                            }"
                            @click="activateTabs('login')"
                        >
                            <div
                                id="ResetPassword"
                                class="resetPassword alert alert-success hidden"
                            >
                                We&#39;ve sent you an email with a link to
                                update your password.
                            </div>
                            <transition name="slide-fade">
                                <div
                                    class="alert p-3"
                                    :class="alertClass"
                                    role="alert"
                                    v-if="L_ErrorAvailable"
                                >
                                    <i
                                        class="fas fa-exclamation-circle mr-3"
                                    ></i
                                    >{{ alertMsg }}
                                </div>
                            </transition>

                            <transition name="slide-fade">
                                <div
                                    class="alert alert-info p-3"
                                    role="alert"
                                    v-if="LoginReason == 'CheckoutReason'"
                                >
                                    <i
                                        class="fas fa-exclamation-circle mr-3"
                                    ></i
                                    >Please login to continue!
                                </div>
                            </transition>
                            <div
                                id="CustomerLoginForm"
                                class="formAccount formAccountLogin"
                                v-bind:class="{ hidden: showBlock }"
                            >
                                <form
                                    id="customer_login"
                                    @submit.prevent="UserLogin()"
                                    accept-charset="UTF-8"
                                >
                                    <input
                                        type="hidden"
                                        name="form_type"
                                        value="customer_login"
                                    /><input
                                        type="hidden"
                                        name="utf8"
                                        value="✓"
                                    />
                                    <div class="formContent">
                                        <div class="form-group">
                                            <label
                                                for="CustomerEmail"
                                                class="hidden"
                                                >Email</label
                                            >
                                            <input
                                                type="email"
                                                name="Lemail"
                                                id="Lemail"
                                                v-model="Lemail"
                                                class="form-control"
                                                placeholder="Email"
                                                required
                                                autofocus
                                            />
                                            <span
                                                ><i
                                                    ><small
                                                        class="text-danger"
                                                        v-if="LemailErr"
                                                        >{{
                                                            errors.email["0"]
                                                        }}</small
                                                    ></i
                                                ></span
                                            >
                                        </div>
                                        <div
                                            class="form-group form-group--pasword"
                                        >
                                            <label
                                                for="CustomerPassword"
                                                class="hidden"
                                                >Password</label
                                            >
                                            <input
                                                type="password"
                                                value=""
                                                name="Lpassword"
                                                id="Lpassword"
                                                v-model="Lpassword"
                                                class="form-control"
                                                placeholder="Password"
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
                                                    ><small
                                                        class="text-danger"
                                                        v-if="LpasswordErr"
                                                        >{{
                                                            errors.password["0"]
                                                        }}</small
                                                    ></i
                                                ></span
                                            >
                                        </div>
                                        <div class="form-button">
                                            <button
                                                type="submit"
                                                class="btn btnVelaOne"
                                                :disabled="loading"
                                            >
                                                Sign In
                                                <div
                                                    v-if="loading"
                                                    class="spinner-border text-light ml-3"
                                                    role="status"
                                                >
                                                    <span class="sr-only"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </button>
                                        </div>

                                        <!-- <center>
                      <div
                        class="btn-group"
                        role="group"
                        aria-label="Basic example"
                      >
                        <button
                          @click="socialLogin('google')"
                          type="button"
                          class="btn btn-sm btn-danger"
                        >
                          <i class="fas fa-google" aria-hidden="true"></i>
                          Google
                        </button>
                        <button
                          @click="socialLogin('facebook')"
                          type="button"
                          class="btn btn-sm btn-primary"
                        >
                          <i class="fas fa-facebook" aria-hidden="true"></i>
                          Facebook
                        </button>
                      </div>
                    </center> -->
                                        <div class="forgetPassword">
                                            <a
                                                class="velaAccountButton velaRecoverPassword"
                                                @click="showBlock = !showBlock"
                                                >Forgot your password?</a
                                            >
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div
                                id="RecoverPasswordForm"
                                class="formAccount formAccountRecover"
                                v-bind:class="{ hidden: !showBlock }"
                            >
                                <transition name="slide-fade">
                                    <div
                                        class="alert p-3"
                                        :class="alertClass"
                                        role="alert"
                                        v-if="RS_ErrorAvailable"
                                    >
                                        <i
                                            class="fas fa-exclamation-circle mr-3"
                                        ></i
                                        >{{ alertMsg }}
                                    </div>
                                </transition>
                                <h2 class="velaAccountTitle">
                                    <span>Reset your password</span>
                                </h2>
                                <form
                                    @submit.prevent="RecoverPwd()"
                                    accept-charset="UTF-8"
                                >
                                    <input
                                        type="hidden"
                                        name="form_type"
                                        value="recover_customer_password"
                                    /><input
                                        type="hidden"
                                        name="utf8"
                                        value="✓"
                                    />
                                    <div class="formContent">
                                        <div class="formAccountText">
                                            <p>
                                                We will send you an email to
                                                reset your password.
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="RecoverEmail"
                                                class="hidden"
                                                >Email</label
                                            >
                                            <input
                                                type="email"
                                                name="RecoverEmail"
                                                id="RecoverEmail"
                                                v-model="RecoverEmail"
                                                class="form-control"
                                                placeholder="Email"
                                                required
                                            />
                                        </div>
                                        <div class="form-button">
                                            <button
                                                type="submit"
                                                class="btn btnVelaOne"
                                                :disabled="loading"
                                            >
                                                Submit
                                                <div
                                                    v-if="loading"
                                                    class="spinner-border text-light ml-3"
                                                    role="status"
                                                >
                                                    <span class="sr-only"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </button>

                                            <div class="forgetPassword">
                                                <a
                                                    class="velaAccountButton velaHideRecoverPasswordLink"
                                                    @click="
                                                        showBlock = !showBlock
                                                    "
                                                    >Back to login</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div
                            id="frmAccountTabRegister"
                            class="tab-pane"
                            :class="{
                                active: activateRegister,
                                inactive: !activateRegister
                            }"
                            @click="activateTabs('register')"
                        >
                            <transition name="slide-fade">
                                <div
                                    class="alert p-3"
                                    :class="alertClass"
                                    role="alert"
                                    v-if="R_ErrorAvailable"
                                >
                                    <i
                                        class="fas fa-exclamation-circle mr-3"
                                    ></i
                                    >{{ alertMsg }}
                                </div>
                            </transition>
                            <div
                                id="CustomerRegisterForm"
                                class="formAccount formAccountRegister"
                            >
                                <form
                                    id="create_customer"
                                    @submit.prevent="UserRegistration()"
                                    accept-charset="UTF-8"
                                >
                                    <input
                                        type="hidden"
                                        name="form_type"
                                        value="create_customer"
                                    /><input
                                        type="hidden"
                                        name="utf8"
                                        value="✓"
                                    />
                                    <div class="formContent">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="FirstName"
                                                        class="hidden"
                                                        >Names</label
                                                    >
                                                    <input
                                                        type="text"
                                                        name="names"
                                                        id="names"
                                                        v-model="names"
                                                        class="form-control"
                                                        placeholder="Names..."
                                                        required
                                                        autofocus
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="namesErr"
                                                                >{{
                                                                    errors
                                                                        .names[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="LastName"
                                                        class="hidden"
                                                        >Email</label
                                                    >
                                                    <input
                                                        type="email"
                                                        name="email"
                                                        id="email"
                                                        v-model="email"
                                                        class="form-control"
                                                        placeholder="Email..."
                                                        required
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="emailErr"
                                                                >{{
                                                                    errors
                                                                        .email[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >Phone</label
                                                    >
                                                    <input
                                                        type="number"
                                                        name="phone"
                                                        id="phone"
                                                        v-model="phone"
                                                        class="form-control"
                                                        placeholder="Phone..."
                                                        required
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="phoneErr"
                                                                >{{
                                                                    errors
                                                                        .phone[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >Address</label
                                                    >
                                                    <input
                                                        type="text"
                                                        name="address"
                                                        id="address"
                                                        v-model="address"
                                                        class="form-control"
                                                        placeholder="Address..."
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="
                                                                    addressErr
                                                                "
                                                                >{{
                                                                    errors
                                                                        .address[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >Country</label
                                                    >
                                                    <select
                                                        name="country"
                                                        id="country"
                                                        v-model="country"
                                                        class="form-control"
                                                        required
                                                    >
                                                        <option value=""
                                                            >--select
                                                            country--</option
                                                        >
                                                        <option value="AFG"
                                                            >Afghanistan</option
                                                        >
                                                        <option value="ALA"
                                                            >Åland
                                                            Islands</option
                                                        >
                                                        <option value="ALB"
                                                            >Albania</option
                                                        >
                                                        <option value="DZA"
                                                            >Algeria</option
                                                        >
                                                        <option value="ASM"
                                                            >American
                                                            Samoa</option
                                                        >
                                                        <option value="AND"
                                                            >Andorra</option
                                                        >
                                                        <option value="AGO"
                                                            >Angola</option
                                                        >
                                                        <option value="AIA"
                                                            >Anguilla</option
                                                        >
                                                        <option value="ATA"
                                                            >Antarctica</option
                                                        >
                                                        <option value="ATG"
                                                            >Antigua and
                                                            Barbuda</option
                                                        >
                                                        <option value="ARG"
                                                            >Argentina</option
                                                        >
                                                        <option value="ARM"
                                                            >Armenia</option
                                                        >
                                                        <option value="ABW"
                                                            >Aruba</option
                                                        >
                                                        <option value="AUS"
                                                            >Australia</option
                                                        >
                                                        <option value="AUT"
                                                            >Austria</option
                                                        >
                                                        <option value="AZE"
                                                            >Azerbaijan</option
                                                        >
                                                        <option value="BHS"
                                                            >Bahamas</option
                                                        >
                                                        <option value="BHR"
                                                            >Bahrain</option
                                                        >
                                                        <option value="BGD"
                                                            >Bangladesh</option
                                                        >
                                                        <option value="BRB"
                                                            >Barbados</option
                                                        >
                                                        <option value="BLR"
                                                            >Belarus</option
                                                        >
                                                        <option value="BEL"
                                                            >Belgium</option
                                                        >
                                                        <option value="BLZ"
                                                            >Belize</option
                                                        >
                                                        <option value="BEN"
                                                            >Benin</option
                                                        >
                                                        <option value="BMU"
                                                            >Bermuda</option
                                                        >
                                                        <option value="BTN"
                                                            >Bhutan</option
                                                        >
                                                        <option value="BOL"
                                                            >Bolivia,
                                                            Plurinational State
                                                            of</option
                                                        >
                                                        <option value="BES"
                                                            >Bonaire, Sint
                                                            Eustatius and
                                                            Saba</option
                                                        >
                                                        <option value="BIH"
                                                            >Bosnia and
                                                            Herzegovina</option
                                                        >
                                                        <option value="BWA"
                                                            >Botswana</option
                                                        >
                                                        <option value="BVT"
                                                            >Bouvet
                                                            Island</option
                                                        >
                                                        <option value="BRA"
                                                            >Brazil</option
                                                        >
                                                        <option value="IOT"
                                                            >British Indian
                                                            Ocean
                                                            Territory</option
                                                        >
                                                        <option value="BRN"
                                                            >Brunei
                                                            Darussalam</option
                                                        >
                                                        <option value="BGR"
                                                            >Bulgaria</option
                                                        >
                                                        <option value="BFA"
                                                            >Burkina
                                                            Faso</option
                                                        >
                                                        <option value="BDI"
                                                            >Burundi</option
                                                        >
                                                        <option value="KHM"
                                                            >Cambodia</option
                                                        >
                                                        <option value="CMR"
                                                            >Cameroon</option
                                                        >
                                                        <option value="CAN"
                                                            >Canada</option
                                                        >
                                                        <option value="CPV"
                                                            >Cape Verde</option
                                                        >
                                                        <option value="CYM"
                                                            >Cayman
                                                            Islands</option
                                                        >
                                                        <option value="CAF"
                                                            >Central African
                                                            Republic</option
                                                        >
                                                        <option value="TCD"
                                                            >Chad</option
                                                        >
                                                        <option value="CHL"
                                                            >Chile</option
                                                        >
                                                        <option value="CHN"
                                                            >China</option
                                                        >
                                                        <option value="CXR"
                                                            >Christmas
                                                            Island</option
                                                        >
                                                        <option value="CCK"
                                                            >Cocos (Keeling)
                                                            Islands</option
                                                        >
                                                        <option value="COL"
                                                            >Colombia</option
                                                        >
                                                        <option value="COM"
                                                            >Comoros</option
                                                        >
                                                        <option value="COG"
                                                            >Congo</option
                                                        >
                                                        <option value="COD"
                                                            >Congo, the
                                                            Democratic Republic
                                                            of the</option
                                                        >
                                                        <option value="COK"
                                                            >Cook
                                                            Islands</option
                                                        >
                                                        <option value="CRI"
                                                            >Costa Rica</option
                                                        >
                                                        <option value="CIV"
                                                            >Côte
                                                            d'Ivoire</option
                                                        >
                                                        <option value="HRV"
                                                            >Croatia</option
                                                        >
                                                        <option value="CUB"
                                                            >Cuba</option
                                                        >
                                                        <option value="CUW"
                                                            >Curaçao</option
                                                        >
                                                        <option value="CYP"
                                                            >Cyprus</option
                                                        >
                                                        <option value="CZE"
                                                            >Czech
                                                            Republic</option
                                                        >
                                                        <option value="DNK"
                                                            >Denmark</option
                                                        >
                                                        <option value="DJI"
                                                            >Djibouti</option
                                                        >
                                                        <option value="DMA"
                                                            >Dominica</option
                                                        >
                                                        <option value="DOM"
                                                            >Dominican
                                                            Republic</option
                                                        >
                                                        <option value="ECU"
                                                            >Ecuador</option
                                                        >
                                                        <option value="EGY"
                                                            >Egypt</option
                                                        >
                                                        <option value="SLV"
                                                            >El Salvador</option
                                                        >
                                                        <option value="GNQ"
                                                            >Equatorial
                                                            Guinea</option
                                                        >
                                                        <option value="ERI"
                                                            >Eritrea</option
                                                        >
                                                        <option value="EST"
                                                            >Estonia</option
                                                        >
                                                        <option value="ETH"
                                                            >Ethiopia</option
                                                        >
                                                        <option value="FLK"
                                                            >Falkland Islands
                                                            (Malvinas)</option
                                                        >
                                                        <option value="FRO"
                                                            >Faroe
                                                            Islands</option
                                                        >
                                                        <option value="FJI"
                                                            >Fiji</option
                                                        >
                                                        <option value="FIN"
                                                            >Finland</option
                                                        >
                                                        <option value="FRA"
                                                            >France</option
                                                        >
                                                        <option value="GUF"
                                                            >French
                                                            Guiana</option
                                                        >
                                                        <option value="PYF"
                                                            >French
                                                            Polynesia</option
                                                        >
                                                        <option value="ATF"
                                                            >French Southern
                                                            Territories</option
                                                        >
                                                        <option value="GAB"
                                                            >Gabon</option
                                                        >
                                                        <option value="GMB"
                                                            >Gambia</option
                                                        >
                                                        <option value="GEO"
                                                            >Georgia</option
                                                        >
                                                        <option value="DEU"
                                                            >Germany</option
                                                        >
                                                        <option value="GHA"
                                                            >Ghana</option
                                                        >
                                                        <option value="GIB"
                                                            >Gibraltar</option
                                                        >
                                                        <option value="GRC"
                                                            >Greece</option
                                                        >
                                                        <option value="GRL"
                                                            >Greenland</option
                                                        >
                                                        <option value="GRD"
                                                            >Grenada</option
                                                        >
                                                        <option value="GLP"
                                                            >Guadeloupe</option
                                                        >
                                                        <option value="GUM"
                                                            >Guam</option
                                                        >
                                                        <option value="GTM"
                                                            >Guatemala</option
                                                        >
                                                        <option value="GGY"
                                                            >Guernsey</option
                                                        >
                                                        <option value="GIN"
                                                            >Guinea</option
                                                        >
                                                        <option value="GNB"
                                                            >Guinea-Bissau</option
                                                        >
                                                        <option value="GUY"
                                                            >Guyana</option
                                                        >
                                                        <option value="HTI"
                                                            >Haiti</option
                                                        >
                                                        <option value="HMD"
                                                            >Heard Island and
                                                            McDonald
                                                            Islands</option
                                                        >
                                                        <option value="VAT"
                                                            >Holy See (Vatican
                                                            City State)</option
                                                        >
                                                        <option value="HND"
                                                            >Honduras</option
                                                        >
                                                        <option value="HKG"
                                                            >Hong Kong</option
                                                        >
                                                        <option value="HUN"
                                                            >Hungary</option
                                                        >
                                                        <option value="ISL"
                                                            >Iceland</option
                                                        >
                                                        <option value="IND"
                                                            >India</option
                                                        >
                                                        <option value="IDN"
                                                            >Indonesia</option
                                                        >
                                                        <option value="IRN"
                                                            >Iran, Islamic
                                                            Republic of</option
                                                        >
                                                        <option value="IRQ"
                                                            >Iraq</option
                                                        >
                                                        <option value="IRL"
                                                            >Ireland</option
                                                        >
                                                        <option value="IMN"
                                                            >Isle of Man</option
                                                        >
                                                        <option value="ISR"
                                                            >Israel</option
                                                        >
                                                        <option value="ITA"
                                                            >Italy</option
                                                        >
                                                        <option value="JAM"
                                                            >Jamaica</option
                                                        >
                                                        <option value="JPN"
                                                            >Japan</option
                                                        >
                                                        <option value="JEY"
                                                            >Jersey</option
                                                        >
                                                        <option value="JOR"
                                                            >Jordan</option
                                                        >
                                                        <option value="KAZ"
                                                            >Kazakhstan</option
                                                        >
                                                        <option value="KEN"
                                                            >Kenya</option
                                                        >
                                                        <option value="KIR"
                                                            >Kiribati</option
                                                        >
                                                        <option value="PRK"
                                                            >Korea, Democratic
                                                            People's Republic
                                                            of</option
                                                        >
                                                        <option value="KOR"
                                                            >Korea, Republic
                                                            of</option
                                                        >
                                                        <option value="KWT"
                                                            >Kuwait</option
                                                        >
                                                        <option value="KGZ"
                                                            >Kyrgyzstan</option
                                                        >
                                                        <option value="LAO"
                                                            >Lao People's
                                                            Democratic
                                                            Republic</option
                                                        >
                                                        <option value="LVA"
                                                            >Latvia</option
                                                        >
                                                        <option value="LBN"
                                                            >Lebanon</option
                                                        >
                                                        <option value="LSO"
                                                            >Lesotho</option
                                                        >
                                                        <option value="LBR"
                                                            >Liberia</option
                                                        >
                                                        <option value="LBY"
                                                            >Libya</option
                                                        >
                                                        <option value="LIE"
                                                            >Liechtenstein</option
                                                        >
                                                        <option value="LTU"
                                                            >Lithuania</option
                                                        >
                                                        <option value="LUX"
                                                            >Luxembourg</option
                                                        >
                                                        <option value="MAC"
                                                            >Macao</option
                                                        >
                                                        <option value="MKD"
                                                            >Macedonia, the
                                                            former Yugoslav
                                                            Republic of</option
                                                        >
                                                        <option value="MDG"
                                                            >Madagascar</option
                                                        >
                                                        <option value="MWI"
                                                            >Malawi</option
                                                        >
                                                        <option value="MYS"
                                                            >Malaysia</option
                                                        >
                                                        <option value="MDV"
                                                            >Maldives</option
                                                        >
                                                        <option value="MLI"
                                                            >Mali</option
                                                        >
                                                        <option value="MLT"
                                                            >Malta</option
                                                        >
                                                        <option value="MHL"
                                                            >Marshall
                                                            Islands</option
                                                        >
                                                        <option value="MTQ"
                                                            >Martinique</option
                                                        >
                                                        <option value="MRT"
                                                            >Mauritania</option
                                                        >
                                                        <option value="MUS"
                                                            >Mauritius</option
                                                        >
                                                        <option value="MYT"
                                                            >Mayotte</option
                                                        >
                                                        <option value="MEX"
                                                            >Mexico</option
                                                        >
                                                        <option value="FSM"
                                                            >Micronesia,
                                                            Federated States
                                                            of</option
                                                        >
                                                        <option value="MDA"
                                                            >Moldova, Republic
                                                            of</option
                                                        >
                                                        <option value="MCO"
                                                            >Monaco</option
                                                        >
                                                        <option value="MNG"
                                                            >Mongolia</option
                                                        >
                                                        <option value="MNE"
                                                            >Montenegro</option
                                                        >
                                                        <option value="MSR"
                                                            >Montserrat</option
                                                        >
                                                        <option value="MAR"
                                                            >Morocco</option
                                                        >
                                                        <option value="MOZ"
                                                            >Mozambique</option
                                                        >
                                                        <option value="MMR"
                                                            >Myanmar</option
                                                        >
                                                        <option value="NAM"
                                                            >Namibia</option
                                                        >
                                                        <option value="NRU"
                                                            >Nauru</option
                                                        >
                                                        <option value="NPL"
                                                            >Nepal</option
                                                        >
                                                        <option value="NLD"
                                                            >Netherlands</option
                                                        >
                                                        <option value="NCL"
                                                            >New
                                                            Caledonia</option
                                                        >
                                                        <option value="NZL"
                                                            >New Zealand</option
                                                        >
                                                        <option value="NIC"
                                                            >Nicaragua</option
                                                        >
                                                        <option value="NER"
                                                            >Niger</option
                                                        >
                                                        <option value="NGA"
                                                            >Nigeria</option
                                                        >
                                                        <option value="NIU"
                                                            >Niue</option
                                                        >
                                                        <option value="NFK"
                                                            >Norfolk
                                                            Island</option
                                                        >
                                                        <option value="MNP"
                                                            >Northern Mariana
                                                            Islands</option
                                                        >
                                                        <option value="NOR"
                                                            >Norway</option
                                                        >
                                                        <option value="OMN"
                                                            >Oman</option
                                                        >
                                                        <option value="PAK"
                                                            >Pakistan</option
                                                        >
                                                        <option value="PLW"
                                                            >Palau</option
                                                        >
                                                        <option value="PSE"
                                                            >Palestinian
                                                            Territory,
                                                            Occupied</option
                                                        >
                                                        <option value="PAN"
                                                            >Panama</option
                                                        >
                                                        <option value="PNG"
                                                            >Papua New
                                                            Guinea</option
                                                        >
                                                        <option value="PRY"
                                                            >Paraguay</option
                                                        >
                                                        <option value="PER"
                                                            >Peru</option
                                                        >
                                                        <option value="PHL"
                                                            >Philippines</option
                                                        >
                                                        <option value="PCN"
                                                            >Pitcairn</option
                                                        >
                                                        <option value="POL"
                                                            >Poland</option
                                                        >
                                                        <option value="PRT"
                                                            >Portugal</option
                                                        >
                                                        <option value="PRI"
                                                            >Puerto Rico</option
                                                        >
                                                        <option value="QAT"
                                                            >Qatar</option
                                                        >
                                                        <option value="REU"
                                                            >Réunion</option
                                                        >
                                                        <option value="ROU"
                                                            >Romania</option
                                                        >
                                                        <option value="RUS"
                                                            >Russian
                                                            Federation</option
                                                        >
                                                        <option value="RWA"
                                                            >Rwanda</option
                                                        >
                                                        <option value="BLM"
                                                            >Saint
                                                            Barthélemy</option
                                                        >
                                                        <option value="SHN"
                                                            >Saint Helena,
                                                            Ascension and
                                                            Tristan da
                                                            Cunha</option
                                                        >
                                                        <option value="KNA"
                                                            >Saint Kitts and
                                                            Nevis</option
                                                        >
                                                        <option value="LCA"
                                                            >Saint Lucia</option
                                                        >
                                                        <option value="MAF"
                                                            >Saint Martin
                                                            (French
                                                            part)</option
                                                        >
                                                        <option value="SPM"
                                                            >Saint Pierre and
                                                            Miquelon</option
                                                        >
                                                        <option value="VCT"
                                                            >Saint Vincent and
                                                            the
                                                            Grenadines</option
                                                        >
                                                        <option value="WSM"
                                                            >Samoa</option
                                                        >
                                                        <option value="SMR"
                                                            >San Marino</option
                                                        >
                                                        <option value="STP"
                                                            >Sao Tome and
                                                            Principe</option
                                                        >
                                                        <option value="SAU"
                                                            >Saudi
                                                            Arabia</option
                                                        >
                                                        <option value="SEN"
                                                            >Senegal</option
                                                        >
                                                        <option value="SRB"
                                                            >Serbia</option
                                                        >
                                                        <option value="SYC"
                                                            >Seychelles</option
                                                        >
                                                        <option value="SLE"
                                                            >Sierra
                                                            Leone</option
                                                        >
                                                        <option value="SGP"
                                                            >Singapore</option
                                                        >
                                                        <option value="SXM"
                                                            >Sint Maarten (Dutch
                                                            part)</option
                                                        >
                                                        <option value="SVK"
                                                            >Slovakia</option
                                                        >
                                                        <option value="SVN"
                                                            >Slovenia</option
                                                        >
                                                        <option value="SLB"
                                                            >Solomon
                                                            Islands</option
                                                        >
                                                        <option value="SOM"
                                                            >Somalia</option
                                                        >
                                                        <option value="ZAF"
                                                            >South
                                                            Africa</option
                                                        >
                                                        <option value="SGS"
                                                            >South Georgia and
                                                            the South Sandwich
                                                            Islands</option
                                                        >
                                                        <option value="SSD"
                                                            >South Sudan</option
                                                        >
                                                        <option value="ESP"
                                                            >Spain</option
                                                        >
                                                        <option value="LKA"
                                                            >Sri Lanka</option
                                                        >
                                                        <option value="SDN"
                                                            >Sudan</option
                                                        >
                                                        <option value="SUR"
                                                            >Suriname</option
                                                        >
                                                        <option value="SJM"
                                                            >Svalbard and Jan
                                                            Mayen</option
                                                        >
                                                        <option value="SWZ"
                                                            >Swaziland</option
                                                        >
                                                        <option value="SWE"
                                                            >Sweden</option
                                                        >
                                                        <option value="CHE"
                                                            >Switzerland</option
                                                        >
                                                        <option value="SYR"
                                                            >Syrian Arab
                                                            Republic</option
                                                        >
                                                        <option value="TWN"
                                                            >Taiwan, Province of
                                                            China</option
                                                        >
                                                        <option value="TJK"
                                                            >Tajikistan</option
                                                        >
                                                        <option value="TZA"
                                                            >Tanzania, United
                                                            Republic of</option
                                                        >
                                                        <option value="THA"
                                                            >Thailand</option
                                                        >
                                                        <option value="TLS"
                                                            >Timor-Leste</option
                                                        >
                                                        <option value="TGO"
                                                            >Togo</option
                                                        >
                                                        <option value="TKL"
                                                            >Tokelau</option
                                                        >
                                                        <option value="TON"
                                                            >Tonga</option
                                                        >
                                                        <option value="TTO"
                                                            >Trinidad and
                                                            Tobago</option
                                                        >
                                                        <option value="TUN"
                                                            >Tunisia</option
                                                        >
                                                        <option value="TUR"
                                                            >Turkey</option
                                                        >
                                                        <option value="TKM"
                                                            >Turkmenistan</option
                                                        >
                                                        <option value="TCA"
                                                            >Turks and Caicos
                                                            Islands</option
                                                        >
                                                        <option value="TUV"
                                                            >Tuvalu</option
                                                        >
                                                        <option value="UGA"
                                                            >Uganda</option
                                                        >
                                                        <option value="UKR"
                                                            >Ukraine</option
                                                        >
                                                        <option value="ARE"
                                                            >United Arab
                                                            Emirates</option
                                                        >
                                                        <option value="GBR"
                                                            >United
                                                            Kingdom</option
                                                        >
                                                        <option value="USA"
                                                            >United
                                                            States</option
                                                        >
                                                        <option value="UMI"
                                                            >United States Minor
                                                            Outlying
                                                            Islands</option
                                                        >
                                                        <option value="URY"
                                                            >Uruguay</option
                                                        >
                                                        <option value="UZB"
                                                            >Uzbekistan</option
                                                        >
                                                        <option value="VUT"
                                                            >Vanuatu</option
                                                        >
                                                        <option value="VEN"
                                                            >Venezuela,
                                                            Bolivarian Republic
                                                            of</option
                                                        >
                                                        <option value="VNM"
                                                            >Viet Nam</option
                                                        >
                                                        <option value="VGB"
                                                            >Virgin Islands,
                                                            British</option
                                                        >
                                                        <option value="VIR"
                                                            >Virgin Islands,
                                                            U.S.</option
                                                        >
                                                        <option value="WLF"
                                                            >Wallis and
                                                            Futuna</option
                                                        >
                                                        <option value="ESH"
                                                            >Western
                                                            Sahara</option
                                                        >
                                                        <option value="YEM"
                                                            >Yemen</option
                                                        >
                                                        <option value="ZMB"
                                                            >Zambia</option
                                                        >
                                                        <option value="ZWE"
                                                            >Zimbabwe</option
                                                        >
                                                    </select>
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="
                                                                    countryErr
                                                                "
                                                                >{{
                                                                    errors
                                                                        .country[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >City</label
                                                    >
                                                    <input
                                                        type="text"
                                                        name="city"
                                                        id="city"
                                                        v-model="city"
                                                        class="form-control"
                                                        placeholder="City..."
                                                        required
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="cityErr"
                                                                >{{
                                                                    errors.city[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >Zip Code</label
                                                    >
                                                    <input
                                                        type="text"
                                                        name="zipCode"
                                                        id="zipCode"
                                                        v-model="zipCode"
                                                        class="form-control"
                                                        placeholder="Zip Code..."
                                                    />
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="
                                                                    zipCodeErr
                                                                "
                                                                >{{
                                                                    errors
                                                                        .zipCode[
                                                                        "0"
                                                                    ]
                                                                }}</small
                                                            ></i
                                                        ></span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <label
                                                        for="Email"
                                                        class="hidden"
                                                        >Register As</label
                                                    >
                                                    <select
                                                        name="role"
                                                        id="role"
                                                        v-model="role"
                                                        class="form-control"
                                                        required
                                                    >
                                                        <option value=""
                                                            >Registering as
                                                            ?</option
                                                        >
                                                        <option value="artist"
                                                            >Artist</option
                                                        >
                                                        <option value="client"
                                                            >Client</option
                                                        >
                                                    </select>
                                                    <span
                                                        ><i
                                                            ><small
                                                                class="text-danger"
                                                                v-if="roleErr"
                                                                >{{
                                                                    errors.role[
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
                                            class="form-group form-group--pasword"
                                        >
                                            <label
                                                for="CreatePassword"
                                                class="hidden"
                                                >Password</label
                                            >
                                            <input
                                                type="password"
                                                name="password"
                                                id="password"
                                                v-model="password"
                                                class="form-control"
                                                placeholder="Password..."
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
                                                    ><small
                                                        class="text-danger"
                                                        v-if="passwordErr"
                                                        >{{
                                                            errors.password["0"]
                                                        }}</small
                                                    ></i
                                                ></span
                                            >
                                        </div>
                                        <div class="form-button">
                                            <button
                                                type="submit"
                                                class="btn btnVelaOne"
                                                :disabled="loading"
                                            >
                                                Create an account
                                                <div
                                                    v-if="loading"
                                                    class="spinner-border text-light ml-3"
                                                    role="status"
                                                >
                                                    <span class="sr-only"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </button>
                                        </div>
                                        <div class="forgetPassword">
                                            <a
                                                style="border-radius: 50px; cursor:pointer;"
                                                class="velaAccountButton velaRecoverPassword"
                                                @click="
                                                    socialRegister('google')
                                                "
                                            >
                                                <img
                                                    class="mr-2"
                                                    :src="
                                                        `${baseUrl}/assets/images/google.png`
                                                    "
                                                    width="25"
                                                    alt=""
                                                />
                                                Sign up with google</a
                                            >
                                        </div>
                                        <!-- <div class="forgetPassword">
                                            <a
                                                style="border-radius: 50px; cursor:pointer;"
                                                class="velaAccountButton velaRecoverPassword"
                                                @click="AuthProvider('google')"
                                            >
                                                <img
                                                    class="mr-2"
                                                    :src="
                                                        `${baseUrl}/assets/images/google.png`
                                                    "
                                                    width="25"
                                                    alt=""
                                                />
                                                Sign up with google</a
                                            >
                                        </div> -->
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
    name: "AuthForms",
    data: function() {
        return {
            loading: false,
            RecoverEmail: "",
            showBlock: false,
            Lemail: "",
            Lpassword: "",
            LemailErr: false,
            LpasswordErr: false,
            names: "",
            email: "",
            phone: "",
            address: "",
            country: "",
            city: "",
            zipCode: "",
            role: "",
            password: "",
            namesErr: false,
            emailErr: false,
            phoneErr: false,
            addressErr: false,
            countryErr: false,
            cityErr: false,
            zipCodeErr: false,
            roleErr: false,
            passwordErr: false,
            L_ErrorAvailable: false,
            R_ErrorAvailable: false,
            RS_ErrorAvailable: false,
            alertMsg: "",
            activateLogin: true,
            activateRegister: false,
            alertClass: "",
            errors: null,
            LoginReason: "DashboardReason",
            baseUrl: ""
        };
    },

    mounted() {
        this.CheckLoginReason();
        this.scrollTop();
        this.generateBaseUrl();
    },
    methods: {
        // AuthProvider(provider) {
        //     this.$auth
        //         .authenticate(provider)
        //         .then(response => {
        //             console.log("PROVIDER ==> ", response);
        //             this._SocialLogin(provider, response);
        //         })
        //         .catch(err => {
        //             console.log({ err: err });
        //         });
        // },
        // _SocialLogin(provider, response) {
        //     this.$http
        //         .post("/sociallogin/" + provider, response)
        //         .then(response => {
        //             console.log(response.data);
        //         })
        //         .catch(err => {
        //             console.log({ err: err });
        //         });
        // },

        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        RecoverPwd() {
            this.loading = true;
            let data = {
                vcode: Math.floor(100000 + Math.random() * 900000),
                email: this.RecoverEmail
            };
            this.$store
                .dispatch("users/ResetPasswordRequest", data)
                .then(response => {
                    this.loading = false;
                    this.$router.push({
                        name: "ResetPassword",
                        params: { email: this.RecoverEmail }
                    });
                })
                .catch(error => {
                    this.alertMsg = "Something went wrong, Try again!";
                    this.RS_ErrorAvailable = true;
                    this.alertClass = "alert-danger";
                    this.loading = false;
                });
        },
        CheckLoginReason() {
            this.LoginReason = localStorage.getItem("LoginReason");
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

        // User Login
        UserLogin() {
            this.loading = true;
            this.$gtag.event("login page", { method: "Google" });
            let credentials = {
                email: this.Lemail,
                password: this.Lpassword
            };
            this.$store
                .dispatch("users/UserLogin", credentials)
                .then(response => {
                    this.loading = false;
                    console.log("Logged in.");
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                    if ("email" in this.errors) {
                        this.LemailErr = true;
                    }
                    if ("password" in this.errors) {
                        this.LpasswordErr = true;
                    }
                    this.alertMsg = error.response.data.message;
                    this.L_ErrorAvailable = true;
                    this.alertClass = "alert-danger";
                });
        },

        // User Registration
        UserRegistration() {
            this.loading = true;
            this.$gtag.event("signup page", { method: "Google" });
            if (this.address == "") {
                this.address = "N/A";
            }
            if (this.zipCode == "") {
                this.zipCode = "N/A";
            }
            let data = {
                names: this.names,
                email: this.email,
                phone: this.phone,
                address: this.address,
                country: this.country,
                city: this.city,
                zipCode: this.zipCode,
                role: this.role,
                password: this.password
            };

            this.$store
                .dispatch("users/UserRegistration", data)
                .then(response => {
                    this.loading = false;
                    this.alertMsg = "You have successfully registered!";
                    this.alertClass = "alert-success";
                    this.R_ErrorAvailable = true;
                    this.scrollTop();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                })
                .catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                    if ("names" in this.errors) {
                        this.namesErr = true;
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
                    if ("role" in this.errors) {
                        this.roleErr = true;
                    }
                    if ("password" in this.errors) {
                        this.passwordErr = true;
                    }

                    this.alertMsg = error.response.data.message;
                    this.R_ErrorAvailable = true;
                    this.alertClass = "alert-danger";
                    this.scrollTop();
                });
        },

        // Tab activations
        activateTabs(tab) {
            if (tab == "login") {
                this.activateLogin = true;
                this.activateRegister = false;
            } else if (tab == "register") {
                this.activateRegister = true;
                this.activateLogin = false;
            }
        },

        socialLogin(provider) {
            let data = {
                provider: provider
            };
            this.$store
                .dispatch("users/SocialLogin", data)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        socialRegister(provider) {
            let data = {
                provider: provider
            };
            this.$store
                .dispatch("users/SocialSignup", data)
                .then(response => {
                    console.log("SOCIAL-REG-RESP = ", response);
                    this.alertMsg = "You have successfully registered!";
                    this.alertClass = "alert-success";
                    this.R_ErrorAvailable = true;
                    this.scrollTop();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
