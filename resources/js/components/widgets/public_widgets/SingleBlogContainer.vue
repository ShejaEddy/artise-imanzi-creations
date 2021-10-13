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
                                class="breadcrumbHeading breadcrumbHeadingArticle"
                            >
                                Blog
                            </h2>
                            <ol
                                class="breadcrumb"
                                itemscope
                                itemtype="http://schema.org/BreadcrumbList"
                            >
                                <li
                                    itemprop="itemListElement"
                                    itemscope
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <a
                                        href="../../index.html"
                                        title="Back to the frontpage"
                                        itemprop="item"
                                    >
                                        <span itemprop="name">Home</span>
                                    </a>
                                    <meta itemprop="position" content="1" />
                                </li>
                                <li
                                    itemprop="itemListElement"
                                    itemscope
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <a
                                        href="../news.html"
                                        title="lifestyle"
                                        itemprop="item"
                                    >
                                        <span itemprop="name">Blog</span>
                                    </a>
                                    <meta itemprop="position" content="2" />
                                </li>
                                <li
                                    class="active"
                                    itemprop="itemListElement"
                                    itemscope
                                    itemtype="http://schema.org/ListItem"
                                >
                                    <span itemprop="name">{{
                                        PostInfo.title
                                    }}</span>
                                    <meta itemprop="position" content="3" />
                                </li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </section>

            <section id="pageContent">
                <div class="container">
                    <div class="velaArticleWrap mb30">
                        <div
                            id="shopify-section-vela-template-article"
                            class="shopify-section"
                        >
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-9 mb30">
                                    <article
                                        class="articleItem"
                                        itemscope
                                        itemtype="http://schema.org/Article"
                                    >
                                        <meta
                                            itemscope
                                            itemprop="mainEntityOfPage"
                                            itemtype="https://schema.org/WebPage"
                                            itemid="https://google.com/article"
                                        />
                                        <meta
                                            itemprop="headline"
                                            content="Anteposuerit litterarum formas."
                                        />
                                        <meta
                                            itemprop="author"
                                            content="Mr Vela"
                                        />
                                        <meta
                                            itemprop="datePublished"
                                            content="04 Apr, 2020"
                                        />
                                        <meta
                                            itemprop="dateModified"
                                            content="04 Apr, 2020"
                                        />
                                        <div
                                            class="hidden"
                                            itemprop="image"
                                            itemscope
                                            itemtype="https://schema.org/ImageObject"
                                        >
                                            <meta
                                                itemprop="url"
                                                content="http://cdn.shopify.com/s/files/1/0376/9440/6700/articles/2.jpg?v=1585986704"
                                            />
                                            <meta
                                                itemprop="width"
                                                content="1170"
                                            />
                                            <meta
                                                itemprop="height"
                                                content="800"
                                            />
                                        </div>
                                        <div
                                            class="hidden"
                                            itemprop="publisher"
                                            itemscope
                                            itemtype="https://schema.org/Organization"
                                        >
                                            <div
                                                itemprop="logo"
                                                itemscope
                                                itemtype="https://schema.org/ImageObject"
                                            >
                                                <meta
                                                    itemprop="url"
                                                    content="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/logo.png?v=14864656690670566286"
                                                />
                                            </div>
                                            <meta
                                                itemprop="name"
                                                content="Mr Vela"
                                            />
                                        </div>
                                        <header class="articleHeader">
                                            <h1 class="velaArticleTitle">
                                                {{ PostInfo.title }}
                                            </h1>
                                            <div class="articleFeaturedImage">
                                                <div class="p-relative">
                                                    <div
                                                        class="product-card__image"
                                                        style="padding-top: 62.5%;"
                                                    >
                                                        <img
                                                            class="product-card__img lazyload"
                                                            :src="
                                                                `${baseUrl}/storage/${PostInfo.featured_image}`
                                                            "
                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                            data-aspectratio="1.6"
                                                            data-ratio="1.6"
                                                            data-sizes="auto"
                                                            :alt="
                                                                PostInfo.title
                                                            "
                                                        />
                                                    </div>
                                                    <div
                                                        class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder
                                                    ></div>
                                                </div>
                                            </div>
                                            <div class="blogTitle">
                                                <a
                                                    href="../news.html"
                                                    title="lifestyle"
                                                    >Blog</a
                                                >
                                            </div>
                                            <div class="articleMeta d-flex">
                                                <span class="articleAuthor"
                                                    >{{
                                                        PostInfo.author
                                                    }}
                                                    .</span
                                                >
                                                <span
                                                    class="articlePublish pull-left"
                                                    >{{
                                                        PostInfo.date
                                                            | moment(
                                                                "ddd, MMM Do YYYY"
                                                            )
                                                    }}</span
                                                >
                                            </div>
                                        </header>
                                        <div class="articleDetailContent">
                                            <div
                                                class="rte"
                                                itemprop="description"
                                            >
                                                <div
                                                    v-html="PostInfo.body"
                                                ></div>
                                            </div>
                                            <!-- <div class="articlePostBottom clearfix">
                                                <div class="articleSocialSharing pull-left">
                                                    <span>Share:</span>
                                                    <div class="articleFacebookShare">
                                                        <div class="fb-share-button" data-href="anteposuerit-litterarum-formas-1.html" data-mobile_iframe="true" data-layout="button_count"></div>
                                                    </div>
                                                    <div class="articleTwitterShare">
                                                        <a
                                                            class="twitter-share-button"
                                                            href="https://twitter.com/intent/tweet?text=Anteposuerit%20litterarum%20formas.&amp;url=https://velademo-Artise.myshopify.com/blogs/news/anteposuerit-litterarum-formas-1"
                                                            target="_blank"
                                                        >
                                                            <i class="fa fa-twitter"></i> Tweet
                                                        </a>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </article>
                                </div>

                                <aside
                                    class="velaSidebar velaBlogSidebar col-xs-12 col-sm-4 col-md-3"
                                >
                                    <div class="blogSidebar velaSearchSidebar">
                                        <div class="velaContent">
                                            <form
                                                @submit.prevent="
                                                    redirect_to_search_results()
                                                "
                                                class="formSearchPage formSearchBlogPage"
                                            >
                                                <input
                                                    type="hidden"
                                                    name="view"
                                                    value="blog"
                                                />
                                                <input
                                                    type="hidden"
                                                    name="type"
                                                    value="article"
                                                />
                                                <div class="input-group">
                                                    <input
                                                        type="search"
                                                        name="search_for"
                                                        id="search_for"
                                                        v-model="search_for"
                                                        placeholder="Search our blogs"
                                                        class="formSearchPageInput form-control"
                                                        required
                                                    />
                                                    <button
                                                        type="submit"
                                                        class="formSearchPageButton"
                                                    >
                                                        <i
                                                            class="icons icon-magnifier"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="blogSidebar">
                                        <h4 class="titleSidebar">
                                            Recent Articles
                                        </h4>
                                        <div class="velaContent">
                                            <ul
                                                class="listSidebarBlog list-unstyled"
                                            >
                                                <li
                                                    v-for="post in posts"
                                                    :key="post.id"
                                                >
                                                    <router-link
                                                        class="titleBlogsidebar"
                                                        :title="post.title"
                                                        :to="{
                                                            name: 'SingleBlog',
                                                            params: {
                                                                id: post.id
                                                            }
                                                        }"
                                                        >{{
                                                            post.title
                                                        }}</router-link
                                                    >
                                                    <time
                                                        datetime="2020-04-04"
                                                        >{{
                                                            post.date
                                                                | moment(
                                                                    "ddd, MMM Do YYYY"
                                                                )
                                                        }}</time
                                                    >
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <div class="velaCategoriesBlogSidebar velaBlock">
                                        <h3 class="titleSidebar">Categories</h3>
                                        <div class="velaContent">
                                            <ul class="sidebarListCategories list-unstyled">
                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Music</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Education</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Construction</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Travel</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Apps</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Text</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Tech</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Social</a>
                                                </li>

                                                <li class="sidebarBlogCateItem active">
                                                    <a class="active" href="../news.html">Uncategorized</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <!-- <div class="blogSidebar">
                                        <h4 class="titleSidebar">Popular Tags</h4>
                                        <div class="velaContent">
                                            <ul class="blogTagsList list-inline">
                                                <li><a href="tagged/apps.html" title="Show articles tagged Apps">Apps</a></li>
                                                <li><a href="tagged/conference.html" title="Show articles tagged Conference">Conference</a></li>
                                                <li><a href="tagged/developers.html" title="Show articles tagged Developers">Developers</a></li>
                                                <li><a href="tagged/enterprise.html" title="Show articles tagged Enterprise">Enterprise</a></li>
                                                <li><a href="tagged/startups.html" title="Show articles tagged Startups">Startups</a></li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div
                                        class="blogSidebar blogBannerSidebar hidden-xs hidden-sm"
                                    >
                                        <div class="effectOne">
                                            <a
                                                href="../news.html"
                                                title="velademo-Artise"
                                            >
                                                <div class="p-relative">
                                                    <div
                                                        class="product-card__image"
                                                        style="padding-top: 63.76811594202898%;"
                                                    >
                                                        <img
                                                            class="product-card__img lazyload"
                                                            data-src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/banner2_{width}x.jpg?v=1585764146"
                                                            data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                            data-aspectratio="1.5681818181818181"
                                                            data-ratio="1.5681818181818181"
                                                            data-sizes="auto"
                                                            alt=""
                                                        />
                                                    </div>
                                                    <div
                                                        class="placeholder-background placeholder-background--animation"
                                                        data-image-placeholder
                                                    ></div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </aside>
                            </div>

                            <div id="fb-root"></div>
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
    name: "SingleBlogContainer",
    data: function() {
        return {
            id: this.$route.params.id,
            baseUrl: "",
            PostInfo: "",
            search_for: ""
        };
    },
    watch: {
        "$route.params.id": {
            handler: function(id) {
                this.getSinglePost(id);
            },
            deep: true,
            immediate: true
        }
    },
    components: {},
    computed: {
        ...mapState({
            posts: state => state.products.posts
        })
    },

    created() {
        this.generateBaseUrl();
        this.getSinglePost(this.id);
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
        redirect_to_search_results() {
            this.$router.push({
                name: "BlogSearchResults",
                params: { searchFor: this.search_for }
            });
        },
        getSinglePost(id) {
            this.PostInfo = "";
            this.$store
                .dispatch("products/get_single_post", id)
                .then(response => {
                    this.PostInfo = response[0];
                })
                .catch(error => {
                    console.log(error);
                });
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
