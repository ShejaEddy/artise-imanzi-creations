<template>
    <div class="product_page">
        <div class="main">
            <section class="velaBreadcrumbs hasBackgroundImage">
                <div
                    class="velaBreadcrumbsInner"
                    style="background-color: #eaebef;"
                >
                    <div class="velaBreadcrumbImage">
                        <img
                            alt="velademo-Artise"
                            src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/bg-breacumb.jpg?v=1586848586"
                        />
                    </div>
                    <nav class="velaBreadcrumbWrap container">
                        <div class="velaBreadcrumbsInnerWrap">
                            <h2
                                class="breadcrumbHeading breadcrumbHeadingProduct"
                            >
                                Blog
                            </h2>
                            <ol
                                class="breadcrumb"
                                itemscope=""
                                itemtype="http://schema.org/BreadcrumbList"
                            >
                                <li
                                    itemprop="itemListElement"
                                    itemscope=""
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <a
                                        href="/"
                                        title="Back to the frontpage"
                                        itemprop="item"
                                    >
                                        <span itemprop="name">Home</span>
                                    </a>
                                    <meta itemprop="position" content="1" />
                                </li>
                                <!-- <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a href="../collections/chairs.html" title="Chairs" itemprop="item">
                            <span itemprop="name">Chairs</span>
                        </a>
                        <meta itemprop="position" content="2" />
                    </li> -->
                                <li
                                    class="active"
                                    itemprop="itemListElement"
                                    itemscope=""
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <span itemprop="name">Blog</span>
                                    <meta itemprop="position" content="3" />
                                </li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </section>

            <section id="pageContent" class="pageBlogContent mb30">
                <div class="container">
                    <div class="velaBlogWrap">
                        <div
                            id="shopify-section-vela-template-blog"
                            class="shopify-section"
                        >
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="blogContainer">
                                        <h1 class="velaBlogTitle">blog</h1>
                                        <div
                                            class="col-sm-12"
                                            v-if="posts.length <= 0"
                                        >
                                            <div class="card">
                                                <div class="card-body">
                                                    <center>
                                                        <h4
                                                            style="color: rgb(186, 147, 62)"
                                                            class="card-title"
                                                        >
                                                            Oops!! No posts
                                                            available.
                                                        </h4>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            v-else
                                            class="blogListArticle blogGridTemplate"
                                        >
                                            <div class="rowFlexMargin rowFlex">
                                                <div
                                                    v-for="post in posts"
                                                    :key="post.id"
                                                    class="col-sp-12 col-xs-6 col-md-4"
                                                >
                                                    <div
                                                        v-if="
                                                            post.status ==
                                                                'Published'
                                                        "
                                                        class="blogArticle mb20 pb-md-30"
                                                    >
                                                        <div
                                                            class="articleImage"
                                                        >
                                                            <router-link
                                                                :to="{
                                                                    name:
                                                                        'SingleBlog',
                                                                    params: {
                                                                        id:
                                                                            post.id
                                                                    }
                                                                }"
                                                            >
                                                                <div
                                                                    class="p-relative"
                                                                >
                                                                    <div
                                                                        class="product-card__image"
                                                                        style="padding-top: 62.5%;"
                                                                    >
                                                                        <img
                                                                            class="product-card__img lazyload"
                                                                            :data-src="
                                                                                `${baseUrl}/storage/${post.featured_image}`
                                                                            "
                                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                                            data-aspectratio="1.6"
                                                                            data-ratio="1.6"
                                                                            data-sizes="auto"
                                                                            alt="Anteposuerit litterarum formas."
                                                                        />
                                                                    </div>
                                                                    <div
                                                                        class="placeholder-background placeholder-background--animation"
                                                                        data-image-placeholder
                                                                    ></div>
                                                                </div>
                                                            </router-link>
                                                        </div>

                                                        <div
                                                            class="articleContent"
                                                        >
                                                            <div
                                                                class="blogTitle"
                                                            >
                                                                <a
                                                                    href="news.html"
                                                                    title="lifestyle"
                                                                    >Blog</a
                                                                >
                                                            </div>
                                                            <div
                                                                class="articleMeta d-flex"
                                                            >
                                                                <span
                                                                    class="articleAuthor"
                                                                    >{{
                                                                        post.author
                                                                    }}
                                                                    .</span
                                                                >
                                                                <span
                                                                    class="articlePublish pull-left"
                                                                    >{{
                                                                        post.date
                                                                            | moment(
                                                                                "ddd, MMM Do YYYY"
                                                                            )
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <h3
                                                                class="articleTitle"
                                                            >
                                                                <router-link
                                                                    :to="{
                                                                        name:
                                                                            'SingleBlog',
                                                                        params: {
                                                                            id:
                                                                                post.id
                                                                        }
                                                                    }"
                                                                    >{{
                                                                        post.title
                                                                    }}</router-link
                                                                >
                                                            </h3>
                                                            <div
                                                                class="articleDesc"
                                                            >
                                                                {{
                                                                    post.caption
                                                                }}
                                                            </div>
                                                            <router-link
                                                                class="btnBlogReadMore"
                                                                :to="{
                                                                    name:
                                                                        'SingleBlog',
                                                                    params: {
                                                                        id:
                                                                            post.id
                                                                    }
                                                                }"
                                                                title="Read More"
                                                            >
                                                                Read More
                                                                <span
                                                                    class="icons icon-arrow-right"
                                                                ></span>
                                                            </router-link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="velaPaginationWrap clearfix"
                                            >
                                                <!-- <nav class="velaPagination pull-left">
                                                    <ul class="pagination">
                                                        <li class="disabled">
                                                            <span>
                                                                <i class="fa fa-angle-double-left"></i>
                                                                
                                                            </span>
                                                        </li>

                                                        <li class="active"><span>1</span></li>

                                                        <li>
                                                            <a href="news4658.html?page=2" title="">2</a>
                                                        </li>

                                                        <li class="pagiNext">
                                                            <a href="news4658.html?page=2" title="Next">
                                                               
                                                                <i class="fa fa-angle-double-right"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav> -->

                                                <div
                                                    class="itemPaginate pull-right"
                                                >
                                                    <span
                                                        >Showing
                                                        {{ posts.length }}</span
                                                    >
                                                    of
                                                    {{ posts.length }} Results
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
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    data: function() {
        return {
            baseUrl: ""
        };
    },
    computed: {
        ...mapState({
            posts: state => state.products.posts
        })
    },

    created() {
        this.generateBaseUrl();
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
        }
    }
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
