<template>
    <!--MainContainer-->
    <div class="main_container">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">All Products</h1>
                <ol class="admin-breadcrumb mb-4">
                    <li class="admin-breadcrumb-item">
                        <router-link to="/artist/dashboard"
                            >Dashboard</router-link
                        >
                    </li>
                    <li class="admin-breadcrumb-item active">view product</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-columns mr-1" aria-hidden="true"></i>
                        Products
                        <div style="float:right">
                            <router-link
                                to="add-product"
                                class="btn btn-primary btn-sm"
                                ><i
                                    class="fas fa-plus mr-1"
                                    aria-hidden="true"
                                ></i
                                >Add product</router-link
                            >
                        </div>
                    </div>
                    <div class="card-body">
                        <transition name="fade">
                            <div
                                class="spinner-border text-primary"
                                role="status"
                                v-show="loading"
                            >
                                <span class="sr-only">Loading...</span>
                            </div>
                        </transition>
                        <transition name="slide-fade">
                            <div
                                class="alert"
                                :class="{
                                    'alert-danger': !success,
                                    'alert-success': success
                                }"
                                v-if="showMsg"
                                v-html="message"
                            ></div>
                        </transition>
                        <div class="table-responsive">
                            <div
                                class="col-sm-12"
                                v-show="products.length === 0"
                            >
                                <div class="card">
                                    <div class="card-body">
                                        <center>
                                            <h4
                                                style="color: rgb(186, 147, 62)"
                                                class="card-title"
                                            >
                                                Oops!! No Products Available!!
                                            </h4>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <table
                                style="font-size: 14px;"
                                class="table table-bordered table-striped table-hover"
                                id="dataTable"
                                width="50%"
                                cellspacing="0"
                                v-if="products.length !== 0"
                            >
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price(Rwf)</th>
                                        <th>Discount(%)</th>
                                        <th>
                                            Size (<small>width & height</small>)
                                        </th>
                                        <th>Location</th>
                                        <th>Stock Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="product in products"
                                        :key="'p-' + product.id"
                                    >
                                        <td class="text-center">
                                            <a
                                                href="#"
                                                data-toggle="modal"
                                                :data-target="
                                                    `#details_modal_${product.id}`
                                                "
                                                @click="
                                                    getSingleProduct(product.id)
                                                "
                                                ><img
                                                    style="background:white;"
                                                    :src="
                                                        `${baseUrl}/uploads/images/${product.thumbnail}`
                                                    "
                                                    class="img-thumbnail"
                                                    width="45"
                                                    alt="Cinque Terre"
                                            /></a>
                                        </td>
                                        <td>
                                            {{ product.name }} <br />
                                            <small
                                                ><u
                                                    ><a
                                                        href="#"
                                                        data-toggle="modal"
                                                        :data-target="
                                                            `#details_modal_${product.id}`
                                                        "
                                                        @click="
                                                            getSingleProduct(
                                                                product.id
                                                            )
                                                        "
                                                        >More details</a
                                                    ></u
                                                ></small
                                            >
                                            |
                                            <small
                                                ><u
                                                    ><a
                                                        href="#"
                                                        data-toggle="modal"
                                                        :data-target="
                                                            `#reviews_modal_${product.id}`
                                                        "
                                                        >Reviews({{
                                                            product.reviews_num
                                                        }})</a
                                                    ></u
                                                ></small
                                            >
                                        </td>
                                        <td>{{ product.price }}</td>
                                        <td>{{ product.discount }}</td>
                                        <td>{{ product.size }}</td>
                                        <td>{{ product.location }}</td>
                                        <td>
                                            <span
                                                v-if="product.stock <= 0"
                                                class="text-warning"
                                                >{{ product.stock }} Not in
                                                stock
                                                <i
                                                    class="fas fa-times-circle ml-2"
                                                ></i
                                            ></span>
                                            <span v-else class="text-success"
                                                >({{ product.stock }}) In stock
                                                <i
                                                    class="fas fa-check-circle ml-2"
                                                ></i
                                            ></span>
                                        </td>
                                        <td>
                                            <span
                                                v-if="
                                                    product.status == 'Pending'
                                                "
                                                class="text-warning"
                                                >{{ product.status }}</span
                                            >
                                            <span
                                                v-if="
                                                    product.status == 'Rejected'
                                                "
                                                class="text-danger"
                                                >{{ product.status }}</span
                                            >
                                            <span
                                                v-if="
                                                    product.status == 'Approved'
                                                "
                                                class="text-success"
                                                >{{ product.status }}</span
                                            ><br />
                                            <small
                                                v-if="
                                                    product.status ==
                                                        'Pending' ||
                                                        product.status ==
                                                            'Rejected'
                                                "
                                            >
                                                <a
                                                    href="#"
                                                    class="badge badge-secondary"
                                                    @click="
                                                        approve_product(
                                                            product.id
                                                        )
                                                    "
                                                    ><i
                                                        class="fas fa-check-circle mr-1"
                                                    ></i
                                                    >Approve</a
                                                ></small
                                            >
                                            <small
                                                v-if="
                                                    product.status == 'Approved'
                                                "
                                            >
                                                <a
                                                    href="#"
                                                    class="badge badge-danger"
                                                    @click="
                                                        reject_product(
                                                            product.id
                                                        )
                                                    "
                                                    ><i
                                                        class="fa fa-times-circle mr-1"
                                                    ></i
                                                    >Reject</a
                                                ></small
                                            >
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-info btn-sm"
                                                data-toggle="modal"
                                                :data-target="
                                                    `#edit_modal_${product.id}`
                                                "
                                                @click="
                                                    populate_other_info(
                                                        product.id,
                                                        product.categoryId
                                                    ),
                                                        getSingleProduct(
                                                            product.id
                                                        )
                                                "
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button
                                                class="btn btn-danger btn-sm"
                                                @click.prevent="
                                                    deleteProduct(product.id)
                                                "
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
        </main>

        <div
            v-for="product in products"
            :key="'p2-' + product.id"
            class="modal fade bd-example-modal-lg"
            :id="`details_modal_${product.id}`"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Product Details
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
                        <div class="card flex-row flex-wrap">
                            <div class="card-header border-0">
                                <img
                                    :src="
                                        `${baseUrl}/uploads/images/${product.thumbnail}`
                                    "
                                    width="300"
                                    alt=""
                                />
                            </div>
                            <div class="card-block px-2">
                                <h4 class="card-title text-primary mt-3">
                                    {{ product.name }}
                                </h4>
                                <p style="width: 400px;" class="card-text mt-2">
                                    {{ product.longDesc }}
                                </p>
                                <hr />
                                <p><b>Price: </b> {{ product.price }} Frw</p>
                                <p style="margin-top: -12px;">
                                    <b>size: </b> {{ product.size }}
                                </p>
                                <p style="margin-top: -12px;">
                                    <b>Stock: </b> {{ product.stock }}
                                </p>
                                <p style="margin-top: -12px;">
                                    <b>Location: </b> {{ product.location }}
                                </p>
                                <p style="margin-top: -12px;">
                                    <b>Artist Name: </b>
                                    {{ Productartist.names }}
                                </p>
                                <p style="margin-top: -12px;">
                                    <b>Artist Phone: </b>
                                    {{ Productartist.phone }}
                                </p>
                            </div>
                            <div class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            v-for="product in products"
            :key="'p3-' + product.id"
            class="modal fade bd-example-modal-lg"
            :id="`edit_modal_${product.id}`"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg" role="document">
                <form
                    style="padding: 30px 0px;"
                    @submit.prevent="updateProduct(product.id)"
                    enctype="multipart/form-data"
                >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Edit {{ product.name }}
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
                                            :id="`name_${product.id}`"
                                            v-model="ProductInfo.name"
                                            placeholder="Product name..."
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="nameErr"
                                                    >{{
                                                        errors.name["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4"
                                            >Price (Rwf):</label
                                        >
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="price"
                                            :id="`price_${product.id}`"
                                            v-model="ProductInfo.price"
                                            placeholder="Product price..."
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="priceErr"
                                                    >{{
                                                        errors.price["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputPassword4"
                                            >Discount (%):</label
                                        >
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="discount"
                                            :id="`discount_${product.id}`"
                                            v-model="ProductInfo.discount"
                                            placeholder="Product discount..."
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="discountErr"
                                                    >{{
                                                        errors.discount["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState"
                                            >Category:</label
                                        >
                                        <select
                                            id="category"
                                            name="category"
                                            v-model="ProductInfo.categoryId"
                                            class="form-control"
                                            @change="checkCatName()"
                                        >
                                            <option value=""
                                                >Choose category...</option
                                            >
                                            <option
                                                :value="item.id"
                                                v-for="item in extractedCategories"
                                                :key="'c-' + item.id"
                                            >
                                                <span
                                                    v-if="
                                                        item.parent_category ==
                                                            'None'
                                                    "
                                                    >{{ item.name }}</span
                                                >
                                                <span v-else
                                                    >{{ item.name }} -> (<b
                                                        >Parent:</b
                                                    >
                                                    {{
                                                        item.parent_category
                                                    }})</span
                                                >
                                            </option>
                                        </select>
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="categoryErr"
                                                    >{{
                                                        errors.categoryId["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState"
                                            >Other Category:</label
                                        >
                                        <select
                                            id="other-category"
                                            name="other-category"
                                            v-model="
                                                ProductInfo.otherCategoryId
                                            "
                                            class="form-control"
                                        >
                                            <option value=""
                                                >Choose category...</option
                                            >
                                            <option
                                                :value="item.id"
                                                v-for="item in otherCategories"
                                                :key="'c-' + item.id"
                                            >
                                                {{ item.name }}
                                            </option>
                                        </select>
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="otherCategoryErr"
                                                    >{{
                                                        errors.otherCategoryId[
                                                            "0"
                                                        ]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Tags:</label>
                                        <multiselect
                                            v-model="tagsSelected"
                                            :options="tags"
                                            :multiple="true"
                                            :taggable="true"
                                            @tag="addTag"
                                            tag-placeholder="Add this as new tag"
                                            placeholder="Type to search or add tag"
                                        >
                                        </multiselect>
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="tagsErr"
                                                    >{{
                                                        errors.tags["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Stock:</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="stock"
                                            :id="`stock_${product.id}`"
                                            v-model="ProductInfo.stock"
                                            placeholder="Product stock..."
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="stockErr"
                                                    >{{
                                                        errors.stock["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <!-- <div class="form-group col-md-4">
                    <label for="inputEmail4">Color:</label>
                    <multiselect
                      v-model="colorSelected"
                      :options="colors"
                      :multiple="true"
                      :taggable="true"
                      @tag="addColor"
                      tag-placeholder="Add this as new color"
                      placeholder="Type to search or add color"
                    >
                    </multiselect>
                    <span>
                      <i
                        ><small class="text-danger" v-if="colorsErr">{{
                          errors.colors["0"]
                        }}</small></i
                      >
                    </span>
                  </div> -->
                                </div>
                                <div class="form-row">
                                    <div
                                        v-if="
                                            ProductInfo.product_type != 'book'
                                        "
                                        class="form-group col-md-4"
                                    >
                                        <label for="inputEmail4"
                                            >Size (<small
                                                >width & height in
                                                centimeters</small
                                            >):</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="ProductInfo.size"
                                            name="size"
                                            :id="`size_${product.id}`"
                                            placeholder="Product size ex: 1000x500"
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="sizeErr"
                                                    >{{
                                                        errors.size["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div v-else class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Book pages</label
                                        >
                                        <input
                                            type="number"
                                            class="form-control"
                                            v-model="ProductInfo.size"
                                            name="size"
                                            :id="`size_${product.id}`"
                                            placeholder="Book pages..."
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="sizeErr"
                                                    >{{
                                                        errors.size["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Location:</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="location"
                                            :id="`location_${product.id}`"
                                            v-model="ProductInfo.location"
                                            placeholder="Product location..."
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="locationErr"
                                                    >{{
                                                        errors.location["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Thumbnail:</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="thumbnail"
                                            id="thumbnail"
                                            placeholder="Product thumbnail..."
                                            @change="onChange_thumbnail"
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="thumbnailErr"
                                                    >{{
                                                        errors.thumbnail["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Forward Image:</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="forward_img"
                                            id="forward_img"
                                            placeholder="Product forward_img..."
                                            @change="onChange_forward_img"
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="forward_imgErr"
                                                    >{{
                                                        errors.forwardImage["0"]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Backward Image:</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="backward_img"
                                            id="backward_img"
                                            placeholder="Product backward_img..."
                                            @change="onChange_backward_img"
                                        />
                                        <span>
                                            <i
                                                ><small
                                                    class="text-danger"
                                                    v-if="backward_imgErr"
                                                    >{{
                                                        errors.backwardImage[
                                                            "0"
                                                        ]
                                                    }}</small
                                                ></i
                                            >
                                        </span>
                                    </div>
                                    <div
                                        v-if="
                                            ProductInfo.product_type ==
                                                'book' && is_eBook
                                        "
                                        class="form-group col-md-4"
                                    >
                                        <label for="inputEmail4"
                                            >Book PDF:</label
                                        >
                                        <input
                                            type="file"
                                            accept="application/pdf"
                                            class="form-control-file mt-1"
                                            name="book_pdf"
                                            id="book_pdf"
                                            placeholder="Product files..."
                                            @change="onChange_book_pdf"
                                        />
                                        <span
                                            ><i
                                                ><small
                                                    class="text-danger"
                                                    v-if="bookPdfErr"
                                                    >{{
                                                        errors.book_pdf["0"]
                                                    }}</small
                                                ></i
                                            ></span
                                        >
                                    </div>
                                    <div v-else class="form-group col-md-4">
                                        <label for="inputEmail4"
                                            >Other Images:</label
                                        >
                                        <input
                                            type="file"
                                            accept="image/*"
                                            class="form-control-file mt-1"
                                            name="files"
                                            id="files"
                                            placeholder="Product files..."
                                            @change="onChange_files"
                                            multiple
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress"
                                        >Short Description:</label
                                    >
                                    <textarea
                                        class="form-control"
                                        name="short_description"
                                        :id="`short_description_${product.id}`"
                                        rows="2"
                                        v-model="ProductInfo.shortDesc"
                                        placeholder="Add short description..."
                                    ></textarea>
                                    <span>
                                        <i
                                            ><small
                                                class="text-danger"
                                                v-if="short_descriptionErr"
                                                >{{
                                                    errors.shortDesc["0"]
                                                }}</small
                                            ></i
                                        >
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress"
                                        >Long Description:</label
                                    >
                                    <textarea
                                        class="form-control"
                                        name="long_description"
                                        :id="`long_description_${product.id}`"
                                        rows="3"
                                        v-model="ProductInfo.longDesc"
                                        placeholder="Add long description..."
                                    ></textarea>
                                    <span>
                                        <i
                                            ><small
                                                class="text-danger"
                                                v-if="long_descriptionErr"
                                                >{{
                                                    errors.longDesc["0"]
                                                }}</small
                                            ></i
                                        >
                                    </span>
                                </div>
                                <transition name="slide-fade">
                                    <div
                                        class="alert"
                                        :class="{
                                            'alert-danger': !success,
                                            'alert-success': success
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
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="loading"
                            >
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

        <div
            class="modal fade"
            tabindex="-1"
            role="dialog"
            v-for="product in products"
            :key="product.id"
            :id="`reviews_modal_${product.id}`"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Product Reviews
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
                        <ul style="margin-top:40px;" class="list-group">
                            <template v-if="product.reviews.length > 0">
                                <a
                                    class="list-group-item"
                                    v-for="review in product.reviews"
                                    :key="review.id"
                                >
                                    <div class="row">
                                        <div class="media col-md-1">
                                            <div class="pull-left">
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
                                        <div class="col-md-8">
                                            <h4
                                                style="font-size:14px;margin: 0px 10px 0px 0px; color: rgb(26, 26, 26); font-weight: 700;"
                                                class="list-group-item-heading text-left"
                                            >
                                                {{ review.names }}
                                            </h4>
                                            <p
                                                style="font-size:14px;"
                                                class="list-group-item-text text-left"
                                            >
                                                {{ review.review }}
                                            </p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <small
                                                ><timeago
                                                    :datetime="
                                                        review.created_at
                                                    "
                                                    :auto-update="60"
                                                ></timeago
                                            ></small>
                                        </div>
                                    </div>
                                </a>
                            </template>
                            <template v-else>
                                <div class="card">
                                    <div class="card-body text-center">
                                        No reviews available
                                    </div>
                                </div>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MainContainer--END-->
</template>

<script>
import Multiselect from "vue-multiselect";
import { mapState, mapActions } from "vuex";
export default {
    name: "ViewProductsContainer",
    components: { Multiselect },
    data() {
        return {
            baseUrl: "",
            category: "",
            category_name: "",
            tag: "Hello",
            edit: false,
            success: false,
            message: "",
            showMsg: false,
            toEdit: 0,
            loading: false,
            thumbnail: "",
            forward_img: "",
            backward_img: "",
            book_pdf: "",
            product_type: "",
            is_eBook: false,
            files: "",
            token: localStorage.getItem("userToken"),
            tagsSelected: "",
            //colorSelected: "",
            userId: localStorage.getItem("userId"),
            ProductInfo: {},
            Productartist: {},

            // errors variables
            nameErr: false,
            categoryErr: false,
            //colorsErr: false,
            tagsErr: false,
            stockErr: false,
            priceErr: false,
            discountErr: false,
            sizeErr: false,
            productTypeErr: false,
            locationErr: false,
            short_descriptionErr: false,
            long_descriptionErr: false,
            thumbnailErr: false,
            forward_imgErr: false,
            backward_imgErr: false,
            ErrorsAvailable: false,
            bookPdfErr: false,
            otherCategoryErr: false,
            alertMsg: "",
            alertClass: "",
            errors: null,
            message: "",
            success: "",
            showMsg: false,
            loading: false
        };
    },
    computed: {
        ...mapState({
            products: state => state.products.AllProducts,
            categories: state => state.products.categories,
            tags: state => state.products.tagOptions,
            //colors: (state) => state.products.colorOptions,
            extractedCategories: state => state.products.extractedCategories,
            otherCategories: state => state.products.other_categories
        })
    },
    mounted() {
        this.loadProducts();
        this.loadCategories();
        this.loadTags();
        //this.loadColors();
        this.generateBaseUrl();
        this.loadExtractedCategories();
        this.get_other_categories();
    },

    methods: {
        ...mapActions("products", ["get_products"]),
        ...mapActions("products", ["get_product_categories"]),
        ...mapActions("products", ["get_tags_options"]),
        //...mapActions("products", ["get_color_options"]),
        ...mapActions("products", ["get_other_categories"]),
        ...mapActions("products", ["get_extracted_categories"]),

        loadExtractedCategories() {
            this.get_extracted_categories();
        },

        loadProducts() {
            this.get_products();
        },
        loadCategories() {
            this.get_product_categories();
        },

        loadTags() {
            this.get_tags_options();
        },
        // loadColors() {
        //   this.get_color_options();
        // },

        checkCatName() {
            let cat_id = this.ProductInfo.categoryId;
            let result = false;
            let _category_name = "";
            let _product_type = "";

            $.each(this.extractedCategories, function(key, value) {
                if (cat_id == this.id) {
                    _category_name = this.name;
                    if (
                        _category_name == "ebooks" ||
                        _category_name == "eBooks" ||
                        _category_name == "e-books" ||
                        _category_name == "e-Books" ||
                        _category_name == "Ebooks" ||
                        _category_name == "ebook" ||
                        _category_name == "eBook" ||
                        _category_name == "e-book" ||
                        _category_name == "e-Book" ||
                        _category_name == "Ebook"
                    ) {
                        result = true;
                        _product_type = "book";
                    } else if (
                        _category_name == "Hardcopies" ||
                        _category_name == "hardcopies" ||
                        _category_name == "HARDCOPIES" ||
                        _category_name == "Hardcopie" ||
                        _category_name == "hardcopie" ||
                        _category_name == "HARDCOPIE" ||
                        _category_name == "Books" ||
                        _category_name == "books" ||
                        _category_name == "BOOKS" ||
                        _category_name == "Book" ||
                        _category_name == "book" ||
                        _category_name == "BOOK"
                    ) {
                        _product_type = "book";
                    } else {
                        _product_type = "others";
                    }
                }
            });
            this.ProductInfo.product_type = _product_type;
            this.category_name = _category_name;
            this.is_eBook = result;
        },
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },

        approve_product(id) {
            let r = confirm("Are you sure you want to approve this product?");
            if (r) {
                this.$store.dispatch("products/approve_product", id);
                this.loadProducts();
            }
        },

        reject_product(id) {
            let r = confirm("Are you sure you want to reject this product?");
            if (r) {
                this.$store.dispatch("products/reject_product", id);
                this.loadProducts();
            }
        },

        getSingleProduct(id) {
            this.$store
                .dispatch("products/get_single_product", { productId: id })
                .then(response => {
                    this.ProductInfo = response.product[0];
                    this.Productartist = response.artist;
                    this.tagsSelected = response.tags;
                    //this.colorSelected = response.colors;
                    this.checkCatName();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        deleteProduct(id) {
            let r = confirm("Are you sure you want to delete this product?");
            if (r) {
                this.$store.dispatch("products/remove_product", id);
            }
        },

        //   view_details(id){
        //       alert('called');
        //     $('#details_modal').modal('show')
        //   },

        onChange_thumbnail(e) {
            console.log(e.target.files[0]);
            this.thumbnail = e.target.files[0];
        },
        onChange_forward_img(e) {
            console.log(e.target.files[0]);
            this.forward_img = e.target.files[0];
        },
        onChange_backward_img(e) {
            console.log(e.target.files[0]);
            this.backward_img = e.target.files[0];
        },
        onChange_files(e) {
            console.log(e.target.files);
            this.files = e.target.files;
        },
        onChange_book_pdf(e) {
            console.log(e.target.files[0]);
            this.book_pdf = e.target.files[0];
        },

        updateProduct(id) {
            this.loading = true;
            let currentObj = this;
            let name = $("#name_" + id).val();
            let price = $("#price_" + id).val();
            let discount = $("#discount_" + id).val();
            let stock = $("#stock_" + id).val();
            let location = $("#location_" + id).val();
            let size = $("#size_" + id).val();
            let short_description = $("#short_description_" + id).val();
            let long_description = $("#long_description_" + id).val();
            const config = {
                headers: {
                    Authorization: "Bearer " + this.token
                }
            };

            let formData = new FormData();
            formData.append("thumbnail", this.thumbnail);
            formData.append("forwardImage", this.forward_img);
            formData.append("backwardImage", this.backward_img);
            formData.append("name", name);
            formData.append("productId", id);
            formData.append("categoryId", this.ProductInfo.categoryId);
            formData.append(
                "otherCategoryId",
                this.ProductInfo.otherCategoryId
            );
            formData.append("tags", this.tagsSelected),
                formData.append("stock", stock);
            formData.append("price", price);
            formData.append("discount", discount);
            //formData.append("colors", this.colorSelected);
            formData.append("size", size);
            formData.append("location", location);
            formData.append("shortDesc", short_description);
            formData.append("longDesc", long_description);
            formData.append("added_by", this.userId);
            formData.append("product_type", this.ProductInfo.product_type);
            formData.append("is_eBook", this.is_eBook);

            if (this.product_type == "book" && this.is_eBook == false) {
                for (let i = 0; i < this.files.length; i++) {
                    formData.append("otherImages[]", this.files[i]);
                }
            } else if (this.product_type != "book" && this.is_eBook == false) {
                for (let i = 0; i < this.files.length; i++) {
                    formData.append("otherImages[]", this.files[i]);
                }
            } else {
                formData.append("book_pdf", this.book_pdf);
            }

            axios
                .post("/api/update-product", formData, config)
                .then(response => {
                    this.loading = false;
                    this.success = true;
                    this.message = "Product Updated successfully!";
                    this.showMsg = true;
                    setTimeout(() => {
                        this.showMsg = false;
                    }, 3000);
                    console.log(response.data);
                    this.loadProducts();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    if ("name" in this.errors) {
                        this.nameErr = true;
                    }
                    if ("categoryId" in this.errors) {
                        this.categoryErr = true;
                    }
                    if ("otherCategoryId" in this.errors) {
                        this.otherCategoryErr = true;
                    }
                    // if ("colors" in this.errors) {
                    //   this.colorsErr = true;
                    // }
                    if ("tags" in this.errors) {
                        this.tagsErr = true;
                    }
                    if ("stock" in this.errors) {
                        this.stockErr = true;
                    }
                    if ("price" in this.errors) {
                        this.priceErr = true;
                    }
                    if ("discount" in this.errors) {
                        this.discountErr = true;
                    }
                    if ("size" in this.errors) {
                        this.sizeErr = true;
                    }
                    if ("location" in this.errors) {
                        this.locationErr = true;
                    }
                    if ("book_pdf" in this.errors) {
                        this.bookPdfErr = true;
                    }
                    if ("product_type" in this.errors) {
                        this.productTypeErr = true;
                    }
                    if ("shortDesc" in this.errors) {
                        this.short_descriptionErr = true;
                    }
                    if ("longDesc" in this.errors) {
                        this.long_descriptionErr = true;
                    }
                    if ("forwardImage" in this.errors) {
                        this.forward_imgErr = true;
                    }
                    if ("backwardImage" in this.errors) {
                        this.backward_imgErr = true;
                    }
                    if ("thumbnail" in this.errors) {
                        this.thumbnailErr = true;
                    }
                    this.loading = false;
                    this.success = false;
                    this.message = `${error.response.data.message}`;
                    this.showMsg = true;
                    console.log(error.response.data.message);
                });
        },

        addTag(newTag) {
            const tag = {
                name: newTag.name,
                code:
                    newTag.substring(0, 2) +
                    Math.floor(Math.random() * 10000000)
            };
            this.tagOptions.push(tag);
            this.tagsSelected.push(tag);
        },

        // addColor(newColor) {
        //   const color = {
        //     name: newColor,
        //     code: newColor.substring(0, 2) + Math.floor(Math.random() * 10000000),
        //   };
        //   this.colorOptions.push(color);
        //   this.colorSelected.push(color);
        // },

        populate_other_info(product_id, category_id) {
            this.category = category_id;
        }
    }
};
</script>
<style scoped>
.slide-fade-enter-active {
    transition: all 0.8s ease;
}
.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
.fade-enter-active {
    transition: all 0.5s ease;
}
.fade-leave-active {
    transition: all 0s cubic-bezier(1, 0, 0, 1);
}
.fade-enter,
.fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
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
</style>
