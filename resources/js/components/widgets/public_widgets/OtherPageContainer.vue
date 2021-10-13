<template>
  <div class="container">
    <main class="mainContent" role="main">
      <div class="shopify-policy__container">
        <div class="shopify-policy__title text-center">
          <h1>{{ PageData.page_name }}</h1>
        </div>

        <div class="shopify-policy__body">
          <div class="rte">
            <span v-html="PageData.content"></span>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  name: "OtherPageContainer",
  data: function() {
    return {
      id: this.$route.params.id,
      baseUrl: "",
      PageData: "",
      search_for: "",
    };
  },
  watch: {
    "$route.params.id": {
      handler: function(id) {
        this.getSinglePage(id);
      },
      deep: true,
      immediate: true,
    },
  },
  components: {},
  computed: {
    ...mapState({
      posts: (state) => state.products.posts,
    }),
  },

  created() {
    this.generateBaseUrl();
    this.getSinglePage(this.id);
    this.loadPosts();
  },
  methods: {
    ...mapActions("products", ["get_posts"]),

    loadPosts() {
      this.get_posts();
    },
    generateBaseUrl() {
      let base_url = window.location.origin;
      this.baseUrl = base_url;
    },

    getSinglePage(id) {
      this.PageData = "";
      this.$store
        .dispatch("products/get_single_page", { pageId: id })
        .then((response) => {
          this.PageData = response[0];
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style lang="css" scoped>
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
.star_rating {
  display: inline-block;
  color: #fbad02;
  font-size: 1.5em;
  position: relative;
}
.star_rating .star_rating_current {
  position: absolute;
  top: 0;
  /* width: 50%; */
  overflow: hidden;
  white-space: nowrap;
}
</style>
