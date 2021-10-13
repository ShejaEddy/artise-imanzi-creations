<template>
  <!--MainContainer-->
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Add Product</h1>
      <ol class="admin-breadcrumb mb-4">
        <li class="admin-breadcrumb-item">
          <router-link to="/artist/dashboard">Dashboard</router-link>
        </li>
        <li class="admin-breadcrumb-item active">Add-product</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa fa-plus mr-1" aria-hidden="true"></i>
          Add a product
        </div>
        <div class="card-body">
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
          <div class="container">
            <form
              style="padding: 40px 0px"
              @submit.prevent="saveProduct"
              enctype="multipart/form-data"
            >
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Name:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="name"
                    name="name"
                    id="name"
                    placeholder="Product name..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="nameErr">{{
                        errors.name["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-6">
                  <label for="product_owner">Product owner</label>
                  <select
                    id="product_owner"
                    name="product_owner"
                    v-model="product_owner"
                    class="form-control"
                  >
                    <option value="company">Company</option>
                    <option value="artist">Artist</option>
                    <option value="other">Others</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPassword4">Price (Rwf):</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="price"
                    name="price"
                    id="price"
                    placeholder="Product price..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="priceErr">{{
                        errors.price["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPassword4">Discount (%):</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="discount"
                    name="discount"
                    id="discount"
                    placeholder="Product discount..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="discountErr">{{
                        errors.discount["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Category:</label>
                  <select
                    id="category"
                    name="category"
                    v-model="category"
                    class="form-control"
                    @change="checkCatName()"
                  >
                    <option value="">Choose category...</option>
                    <option
                      :value="item.id"
                      v-for="item in extractedCategories"
                      :key="item.id"
                    >
                      <span v-if="item.parent_category == 'None'">{{
                        item.name
                      }}</span>
                      <span v-else
                        >{{ item.name }} -> (<b>Parent:</b>
                        {{ item.parent_category }})</span
                      >
                    </option>
                  </select>
                  <span
                    ><i
                      ><small class="text-danger" v-if="categoryErr">{{
                        errors.categoryId["0"]
                      }}</small></i
                    ></span
                  >
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
                  <span
                    ><i
                      ><small class="text-danger" v-if="tagsErr">{{
                        errors.tags["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Stock:</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="stock"
                    name="name"
                    id="name"
                    placeholder="Product stock..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="stockErr">{{
                        errors.stock["0"]
                      }}</small></i
                    ></span
                  >
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
                  <span
                    ><i
                      ><small class="text-danger" v-if="colorsErr">{{
                        errors.colors["0"]
                      }}</small></i
                    ></span
                  >
                </div> -->
              </div>
              <div class="form-row">
                <div v-if="product_type != 'book'" class="form-group col-md-4">
                  <label for="inputEmail4"
                    >Size (<small>width & height in centimeters</small>):</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    v-model="size"
                    name="size"
                    id="size"
                    placeholder="Product size ex: 1000x500"
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="sizeErr">{{
                        errors.size["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div v-else class="form-group col-md-4">
                  <label for="inputEmail4">Book pages</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="size"
                    name="size"
                    id="size"
                    placeholder="Book pages..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="sizeErr">{{
                        errors.size["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Location:</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="location"
                    name="location"
                    id="location"
                    placeholder="Product location..."
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="locationErr">{{
                        errors.location["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Thumbnail:</label>
                  <input
                    type="file"
                    accept="image/*"
                    class="form-control-file mt-1"
                    name="thumbnail"
                    id="thumbnail"
                    placeholder="Product thumbnail..."
                    @change="onChange_thumbnail"
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="thumbnailErr">{{
                        errors.thumbnail["0"]
                      }}</small></i
                    ></span
                  >
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Forward Image:</label>
                  <input
                    type="file"
                    accept="image/*"
                    class="form-control-file mt-1"
                    name="forward_img"
                    id="forward_img"
                    placeholder="Product forward_img..."
                    @change="onChange_forward_img"
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="forward_imgErr">{{
                        errors.forwardImage["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Backward Image:</label>
                  <input
                    type="file"
                    accept="image/*"
                    class="form-control-file mt-1"
                    name="backward_img"
                    id="backward_img"
                    placeholder="Product backward_img..."
                    @change="onChange_backward_img"
                  />
                  <span
                    ><i
                      ><small class="text-danger" v-if="backward_imgErr">{{
                        errors.backwardImage["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div
                  v-if="product_type == 'book' && is_eBook"
                  class="form-group col-md-4"
                >
                  <label for="inputEmail4">Book PDF:</label>
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
                      ><small class="text-danger" v-if="bookPdfErr">{{
                        errors.book_pdf["0"]
                      }}</small></i
                    ></span
                  >
                </div>
                <div v-else class="form-group col-md-4">
                  <label for="inputEmail4">Other Images:</label>
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
                <label for="inputAddress">Short Description:</label>
                <textarea
                  class="form-control"
                  v-model="short_description"
                  name="short_description"
                  id="short_description"
                  rows="2"
                  placeholder="Add short description..."
                ></textarea>
                <span
                  ><i
                    ><small class="text-danger" v-if="short_descriptionErr">{{
                      errors.shortDesc["0"]
                    }}</small></i
                  ></span
                >
              </div>
              <div class="form-group">
                <label for="inputAddress">Long Description:</label>
                <textarea
                  class="form-control"
                  v-model="long_description"
                  name="long_description"
                  id="long_description"
                  rows="3"
                  placeholder="Add long description..."
                ></textarea>
                <span
                  ><i
                    ><small class="text-danger" v-if="long_descriptionErr">{{
                      errors.longDesc["0"]
                    }}</small></i
                  ></span
                >
              </div>
              <button type="submit" class="btn btn-lg btn-primary col-md-12">
                Save
                <div
                  v-if="loading"
                  class="spinner-border text-light ml-3"
                  role="status"
                >
                  <span class="sr-only">Loading...</span>
                </div>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--MainContainer--END-->
</template>
<script>
import Multiselect from "vue-multiselect";
import { mapState, mapActions } from "vuex";
export default {
  name: "AddProductsForm",
  components: { Multiselect },
  data() {
    return {
      name: "",
      category: "",
      is_eBook: false,
      category_name: "",
      product_owner: "",
      stock: "",
      price: "",
      discount: "",
      size: "",
      location: "",
      short_description: "",
      long_description: "",
      thumbnail: "",
      forward_img: "",
      backward_img: "",
      files: "",
      book_pdf: "",
      product_type: "",
      token: localStorage.getItem("userToken"),
      tagsSelected: "",
      // colorSelected: "",
      userId: localStorage.getItem("userId"),

      nameErr: false,
      categoryErr: false,
      //colorsErr: false,
      tagsErr: false,
      stockErr: false,
      priceErr: false,
      discountErr: false,
      sizeErr: false,
      locationErr: false,
      short_descriptionErr: false,
      long_descriptionErr: false,
      thumbnailErr: false,
      forward_imgErr: false,
      backward_imgErr: false,
      bookPdfErr: false,
      productTypeErr: false,
      ErrorsAvailable: false,
      alertMsg: "",
      alertClass: "",
      errors: null,
      message: "",
      success: "",
      showMsg: false,
      loading: false,
    };
  },

  computed: {
    ...mapState({
      categories: (state) => state.products.categories,
      tags: (state) => state.products.tagOptions,
      // colors: (state) => state.products.colorOptions,
      extractedCategories: (state) => state.products.extractedCategories,
    }),
  },

  mounted() {
    this.loadCategories();
    this.loadTags();
    // this.loadColors();
    this.loadExtractedCategories();
  },

  methods: {
    ...mapActions("products", ["get_product_categories"]),
    ...mapActions("products", ["get_tags_options"]),
    // ...mapActions("products", ["get_color_options"]),
    ...mapActions("products", ["get_extracted_categories"]),

    loadExtractedCategories() {
      this.get_extracted_categories();
    },
    scrollTop() {
      this.intervalId = setInterval(() => {
        if (window.pageYOffset == 0) {
          clearInterval(this.intervalId);
        }
        window.scroll(0, window.pageYOffset - 50);
      }, 20);
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
      let cat_id = this.category;
      let result = false;
      let _category_name = "";
      let _product_type = "";

      $.each(this.extractedCategories, function (key, value) {
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
      this.product_type = _product_type;
      this.category_name = _category_name;
      this.is_eBook = result;
    },

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

    saveProduct() {
      this.loading = true;
      let currentObj = this;

      const config = {
        headers: {
          Authorization: "Bearer " + this.token,
        },
      };

      let formData = new FormData();
      formData.append("thumbnail", this.thumbnail);
      formData.append("forwardImage", this.forward_img);
      formData.append("backwardImage", this.backward_img);
      formData.append("name", this.name);
      formData.append("product_owner", this.product_owner)
      formData.append("categoryId", this.category);
      formData.append("tags", this.tagsSelected);
      formData.append("stock", this.stock);
      formData.append("price", this.price);
      formData.append("discount", this.discount);
      //formData.append("colors", this.colorSelected);
      formData.append("size", this.size);
      formData.append("location", this.location);
      formData.append("shortDesc", this.short_description);
      formData.append("longDesc", this.long_description);
      formData.append("added_by", this.userId);
      formData.append("product_type", this.product_type);
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
        .post("/api/add-product", formData, config)
        .then((response) => {
          this.loading = false;
          this.success = true;
          this.message = "Product Saved successfully!!";
          this.showMsg = true;
          setTimeout(() => {
            this.showMsg = false;
          }, 3000);

          // Resetting variables
          this.nameErr = false;
          this.categoryErr = false;
          // this.colorsErr = false;
          this.tagsErr = false;
          this.stockErr = false;
          this.priceErr = false;
          this.discountErr = false;
          this.sizeErr = false;
          this.locationErr = false;
          this.short_descriptionErr = false;
          this.long_descriptionErr = false;
          this.thumbnailErr = false;
          this.forward_imgErr = false;
          this.backward_imgErr = false;
          this.bookPdfErr = false;
          this.productTypeErr = false;
          this.ErrorsAvailable = false;
          this.errors = null;

          this.scrollTop();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          if ("name" in this.errors) {
            this.nameErr = true;
          }
          if ("categoryId" in this.errors) {
            this.categoryErr = true;
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
          if ("product_type" in this.errors) {
            this.productTypeErr = true;
          }
          if ("book_pdf" in this.errors) {
            this.bookPdfErr = true;
          }

          this.loading = false;
          this.success = false;
          this.message = `${error.response.data.message}`;
          this.showMsg = true;
          console.log(error.response.data.message);
          this.scrollTop();
        });
    },

    addTag(newTag) {
      const tag = {
        name: newTag.name,
        code: newTag.substring(0, 2) + Math.floor(Math.random() * 10000000),
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
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
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
.multiselect__tag {
  position: relative;
  display: inline-block;
  padding: 4px 26px 4px 10px;
  border-radius: 5px;
  margin-right: 10px;
  color: #fff;
  line-height: 1;
  background: #fbad02 !important;
  margin-bottom: 5px;
  white-space: nowrap;
  overflow: hidden;
  max-width: 100%;
  text-overflow: ellipsis;
}
.multiselect__tag-icon:focus,
.multiselect__tag-icon {
  background: #fff !important;
}
.multiselect__tag-icon:focus,
.multiselect__tag-icon:hover {
  background: #111 !important;
}
.multiselect__placeholder {
  color: #555555;
  display: inline-block;
  font-size: 16px;
}
</style>
