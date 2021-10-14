<template>
    <div class="collections">
        <main class="mainContent">
            <div
                id="shopify-section-vela-breacrumb-image"
                class="shopify-section"
            >
                <section class="velaBreadcrumbs hasBackgroundImage">
                    <div
                        class="velaBreadcrumbsInner"
                        style="background-color: #eaebef"
                    >
                        <div class="velaBreadcrumbImage">
                            <img
                                alt="velademo-Artise"
                                src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/bg-breacumb2.jpg?v=1587132651"
                            />
                        </div>
                        <nav class="velaBreadcrumbWrap container">
                            <div class="velaBreadcrumbsInnerWrap">
                                <h1 class="breadcrumbHeading">Shop</h1>
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
                                            href="../index.html"
                                            title="Back to the frontpage"
                                            itemprop="item"
                                        >
                                            <span itemprop="name">Home</span>
                                        </a>
                                        <meta itemprop="position" content="1" />
                                    </li>
                                    <li
                                        class="active"
                                        itemprop="itemListElement"
                                        itemscope
                                        itemtype="http://schema.org/ListItem"
                                    >
                                        <span itemprop="name">Shop</span>
                                        <meta itemprop="position" content="2" />
                                    </li>
                                </ol>
                            </div>
                        </nav>
                    </div>
                </section>
            </div>
            <section id="pageContent">
                <div class="container">
                    <div class="pageCollectionInner mb20 pb-md-30">
                        <div class="row">
                            <aside
                                id="velaSidebar"
                                class="
                  filterTagFullwidthContent
                  sidebarLeft
                  velaSidebar
                  col-xs-3 col-sm-6 col-md-3 col-xl-3
                "
                                :class="{ active: showFilter }"
                            >
                                <div
                                    class="
                    filterTagFullwidthClose
                    hidden-xl hidden-lg hidden-md hidden-xl
                  "
                                    @click.prevent="toggleFilter"
                                ></div>
                                <div class="velaSidebarInner">
                                    <div
                                        id="shopify-section-sidebartop"
                                        class="shopify-section"
                                    >
                                        <div
                                            id="velaCategories"
                                            class="velaCategoriesSidebar velaBlock"
                                        >
                                            <h3 class="titleSidebar">
                                                Product Categories
                                            </h3>
                                            <div class="velaContent">
                                                <ul
                                                    class="sidebarListCategories list-unstyled"
                                                >
                                                    <li
                                                        class="sidebarCateItem active"
                                                        :class="{
                                                            active: is_category_active(
                                                                0
                                                            )
                                                        }"
                                                    >
                                                        <a
                                                            href="#"
                                                            @click.prevent="
                                                                filter_by_category(
                                                                    0
                                                                )
                                                            "
                                                            >All Categories</a
                                                        >
                                                    </li>

                                                    <div
                                                        v-for="(category,
                                                        index) in categories"
                                                        :key="index"
                                                    >
                                                        <li
                                                            class="sidebarCateItem"
                                                            v-if="
                                                                category.children_categories_num >
                                                                    0
                                                            "
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    display_categories(
                                                                        'second',
                                                                        category.id,
                                                                        index
                                                                    )
                                                                "
                                                                >{{
                                                                    category.name
                                                                }}
                                                                <span
                                                                    :id="
                                                                        `cat_icon_${index}`
                                                                    "
                                                                    class="fa fa-plus has_children_icon"
                                                                ></span
                                                            ></a>
                                                        </li>
                                                        <li
                                                            class="sidebarCateItem"
                                                            v-else
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_category(
                                                                        category.id
                                                                    )
                                                                "
                                                                >{{
                                                                    category.name
                                                                }}</a
                                                            >
                                                        </li>
                                                        <div
                                                            v-if="
                                                                category.children_categories_num >
                                                                    0
                                                            "
                                                        >
                                                            <div
                                                                v-for="(child_category,
                                                                index) in category.children_categories"
                                                                :key="index"
                                                            >
                                                                <div
                                                                    :class="
                                                                        `cat_second_level_${child_category.parent_id}`
                                                                    "
                                                                    class="cat_second_level"
                                                                    v-if="
                                                                        child_category.parent_id ==
                                                                            category.id
                                                                    "
                                                                >
                                                                    <li
                                                                        v-if="
                                                                            child_category.grand_children_categories_num >
                                                                                0
                                                                        "
                                                                        class="sidebarCateItem"
                                                                    >
                                                                        <a
                                                                            href="#"
                                                                            @click.prevent="
                                                                                display_categories(
                                                                                    'third',
                                                                                    child_category.id,
                                                                                    index
                                                                                )
                                                                            "
                                                                            >{{
                                                                                child_category.name
                                                                            }}
                                                                            <span
                                                                                :id="
                                                                                    `grand_cat_icon_${index}`
                                                                                "
                                                                                class="fa fa-plus has_children_icon"
                                                                            ></span
                                                                        ></a>
                                                                    </li>
                                                                    <li
                                                                        v-else
                                                                        class="sidebarCateItem"
                                                                    >
                                                                        <a
                                                                            href="#"
                                                                            @click.prevent="
                                                                                filter_by_category(
                                                                                    child_category.id
                                                                                )
                                                                            "
                                                                            >{{
                                                                                child_category.name
                                                                            }}</a
                                                                        >
                                                                    </li>
                                                                </div>
                                                                <div
                                                                    v-if="
                                                                        child_category.grand_children_categories_num >
                                                                            0
                                                                    "
                                                                >
                                                                    <div
                                                                        v-for="grand_child_category in child_category.grand_children_categories"
                                                                        :key="
                                                                            grand_child_category.id
                                                                        "
                                                                    >
                                                                        <div
                                                                            :class="
                                                                                `cat_third_level_${grand_child_category.parent_id}`
                                                                            "
                                                                            class="cat_third_level"
                                                                            v-if="
                                                                                grand_child_category.parent_id ==
                                                                                    child_category.id
                                                                            "
                                                                        >
                                                                            <li
                                                                                class="sidebarCateItem"
                                                                            >
                                                                                <a
                                                                                    href="#"
                                                                                    @click.prevent="
                                                                                        filter_by_category(
                                                                                            grand_child_category.id
                                                                                        )
                                                                                    "
                                                                                    >{{
                                                                                        grand_child_category.name
                                                                                    }}</a
                                                                                >
                                                                            </li>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        id="shopify-section-sidebarfilter"
                                        class="shopify-section"
                                    >
                                        <div
                                            id="sidebarAjaxFilter"
                                            class="velaFilter velaBlock"
                                        >
                                            <div class="velaContent">
                                                <div
                                                    class="ajaxFilter velaBlock"
                                                >
                                                    <h4
                                                        class="titleSidebar ajaxFilterTitle"
                                                    >
                                                        <span>Color</span>
                                                        <a
                                                            href="javascript:void(0)"
                                                            class="velaClear"
                                                            style="display: none"
                                                            title="Clear"
                                                        >
                                                            <i
                                                                class="icons icon-close"
                                                            ></i>
                                                        </a>
                                                    </h4>
                                                    <ul
                                                        class="listFilter list-unstyled"
                                                    >
                                                        <li
                                                            class="filterColor"
                                                            data-filter="color_black"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_color(
                                                                        'black'
                                                                    )
                                                                "
                                                                title="black"
                                                                style="background-color: black"
                                                            >
                                                                <img
                                                                    class="img-responsive"
                                                                    alt="Black"
                                                                    src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/black.png?v=18237608327431082828"
                                                                    onerror="this.onerror=null;this.src='http://cdn.shopify.com/s/files/1/0376/9440/6700/t/3/assets/color_default_icon.png?v=1021911530104449667';"
                                                                />
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="filterColor"
                                                            data-filter="color_blue"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_color(
                                                                        'blue'
                                                                    )
                                                                "
                                                                title="blue"
                                                                style="background-color: blue"
                                                            >
                                                                <img
                                                                    class="img-responsive"
                                                                    alt="Blue"
                                                                    src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/blue.png?v=3221980659058471133"
                                                                    onerror="this.onerror=null;this.src='http://cdn.shopify.com/s/files/1/0376/9440/6700/t/3/assets/color_default_icon.png?v=1021911530104449667';"
                                                                />
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="filterColor"
                                                            data-filter="color_grey"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_color(
                                                                        'grey'
                                                                    )
                                                                "
                                                                title="grey"
                                                                style="background-color: grey"
                                                            >
                                                                <img
                                                                    class="img-responsive"
                                                                    alt="Grey"
                                                                    src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/grey.png?v=9770268660561646233"
                                                                    onerror="this.onerror=null;this.src='http://cdn.shopify.com/s/files/1/0376/9440/6700/t/3/assets/color_default_icon.png?v=1021911530104449667';"
                                                                />
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="filterColor"
                                                            data-filter="color_white"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_color(
                                                                        'white'
                                                                    )
                                                                "
                                                                title="white"
                                                                style="background-color: white"
                                                            >
                                                                <img
                                                                    class="img-responsive"
                                                                    alt="White"
                                                                    src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/white.png?v=6798646103855154337"
                                                                    onerror="this.onerror=null;this.src='http://cdn.shopify.com/s/files/1/0376/9440/6700/t/3/assets/color_default_icon.png?v=1021911530104449667';"
                                                                />
                                                            </a>
                                                        </li>
                                                        <li
                                                            class="filterColor"
                                                            data-filter="color_yellow"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_color(
                                                                        'yellow'
                                                                    )
                                                                "
                                                                title="yellow"
                                                                style="background-color: yellow"
                                                            >
                                                                <img
                                                                    class="img-responsive"
                                                                    alt="Yellow"
                                                                    src="http://cdn.shopify.com/s/files/1/0376/9440/6700/files/yellow.png?v=5674479459882342465"
                                                                    onerror="this.onerror=null;this.src='http://cdn.shopify.com/s/files/1/0376/9440/6700/t/3/assets/color_default_icon.png?v=1021911530104449667';"
                                                                />
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <!-- <div class="cat_third_level" v-if="category.children_categories_num > 0">
                                                        <li class="sidebarCateItem" v-for="sub_category in category.children_categories" :key="sub_category.id">
                                                            <a href="#" @click.prevent=" filter_by_category(sub_category.id)">{{ sub_category.name }}</a>
                                                        </li>
                                                    </div> -->
                                                </div>
                                                <div
                                                    class="ajaxFilter velaBlock"
                                                >
                                                    <h4
                                                        class="titleSidebar ajaxFilterTitle"
                                                    >
                                                        <span>Price</span>
                                                        <a
                                                            href="javascript:void(0)"
                                                            class="velaClear"
                                                            style="display: none"
                                                            title="Clear"
                                                        >
                                                            <i
                                                                class="icons icon-close"
                                                            ></i>
                                                        </a>
                                                    </h4>
                                                    <ul
                                                        class="listFilter list-unstyled"
                                                    >
                                                        <li
                                                            class="filterItem"
                                                            data-filter="price_-0-50"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_price(
                                                                        '0-5000'
                                                                    )
                                                                "
                                                                title="Narrow selection to products matching tag Price_ 0 - 5000 (RWF)"
                                                                >0 - 5000
                                                                (RWF)</a
                                                            >
                                                        </li>
                                                        <li
                                                            class="filterItem"
                                                            data-filter="price_-50-100"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_price(
                                                                        '5000-10000'
                                                                    )
                                                                "
                                                                title="Narrow selection to products matching tag Price_ 5000 - 10000 (RWF)"
                                                                >5000 - 10000
                                                                (RWF)</a
                                                            >
                                                        </li>
                                                        <li
                                                            class="filterItem"
                                                            data-filter="price_-150-200"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_price(
                                                                        '10000-15000'
                                                                    )
                                                                "
                                                                title="Narrow selection to products matching tag Price_ 10000 - 15000 (RWF)"
                                                                >10000 - 15000
                                                                (RWF)</a
                                                            >
                                                        </li>
                                                        <li
                                                            class="filterItem"
                                                            data-filter="price_-200-250"
                                                        >
                                                            <a
                                                                href="#"
                                                                @click.prevent="
                                                                    filter_by_price(
                                                                        '15000'
                                                                    )
                                                                "
                                                                title="Narrow selection to products matching tag Price_ 15000 - Above (RWF)"
                                                                >15000 - Above
                                                                (RWF)</a
                                                            >
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        id="shopify-section-sidebarbottom"
                                        class="shopify-section"
                                    >
                                        <div
                                            class="velaProductsSidebar velaBlock"
                                        >
                                            <h3 class="titleSidebar">
                                                Best artists
                                            </h3>
                                            <div class="velaContent">
                                                <div
                                                    class="productSidebar"
                                                    v-for="product in products.slice(
                                                        0,
                                                        5
                                                    )"
                                                    :key="product.id"
                                                    v-if="
                                                        product.status !==
                                                            'Pending' &&
                                                            product.status !==
                                                                'Rejected'
                                                    "
                                                >
                                                    <div
                                                        class="productSidebarImage"
                                                    >
                                                        <router-link
                                                            class="d-block"
                                                            :to="{
                                                                name: 'Product',
                                                                params: {
                                                                    id:
                                                                        product.id
                                                                }
                                                            }"
                                                        >
                                                            <div
                                                                class="p-relative"
                                                            >
                                                                <div
                                                                    class="product-card__image"
                                                                    style="padding-top: 124.25%"
                                                                >
                                                                    <img
                                                                        class="product-card__img lazyload"
                                                                        :data-src="
                                                                            `${baseUrl}/uploads/images/${product.thumbnail}`
                                                                        "
                                                                        data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                                        data-aspectratio="0.8048289738430584"
                                                                        data-ratio="0.8048289738430584"
                                                                        data-sizes="auto"
                                                                        :alt="
                                                                            product.name
                                                                        "
                                                                    />
                                                                </div>
                                                                <div
                                                                    class="
                                    placeholder-background
                                    placeholder-background--animation
                                  "
                                                                    data-image-placeholder
                                                                ></div>
                                                            </div>
                                                        </router-link>
                                                    </div>
                                                    <div
                                                        class="productSidebarContent"
                                                    >
                                                        <h4
                                                            class="productSidebarName"
                                                        >
                                                            <router-link
                                                                :to="{
                                                                    name:
                                                                        'Product',
                                                                    params: {
                                                                        id:
                                                                            product.id
                                                                    }
                                                                }"
                                                                >{{
                                                                    product.name
                                                                }}</router-link
                                                            >
                                                        </h4>
                                                        <div
                                                            class="productSidebarPrice"
                                                        >
                                                            <div
                                                                class="priceProduct"
                                                            >
                                                                <span
                                                                    class="money"
                                                                    >{{
                                                                        product.price
                                                                    }}
                                                                    RWF</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <div
                                id="proListCollection"
                                class="
                  velaCenterColumn
                  velaCenterColumnFix
                  col-xs-12 col-sm-12 col-md-9 col-xl-9
                "
                            >
                                <div
                                    id="shopify-section-vela-template-collection"
                                    class="shopify-section"
                                >
                                    <div class="filterCollectionFullwidth">
                                        <div
                                            class="filterTagFullwidth hidden-xl hidden-md hidden-lg"
                                            @click.prevent="toggleFilter"
                                        >
                                            <div
                                                class="filterTagFullwidthButton"
                                            >
                                                <i class="fa fa-sliders"></i>
                                                <span>Filter</span>
                                            </div>
                                        </div>
                                        <div class="collBoxSort">
                                            <div class="collView">
                                                <button
                                                    class="changeView changeViewGrid changeViewActive"
                                                    type="button"
                                                    title="Grid view"
                                                    data-view="grid"
                                                >
                                                    <span
                                                        class="iconChangeView"
                                                    >
                                                        <svg
                                                            fill="currentColor"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            height="16"
                                                            width="16"
                                                            viewBox="0 0 16 16"
                                                            title="Grid"
                                                            style="vertical-align: middle"
                                                        >
                                                            <title>Grid</title>
                                                            <g>
                                                                <path
                                                                    d="M1,3.80447821 L1,1 L3.80447821,1 L3.80447821,3.80447821 L1,3.80447821 Z M6.5977609,3.80447821 L6.5977609,1 L9.4022391,1 L9.4022391,3.80447821 L6.5977609,3.80447821 Z M12.1955218,3.80447821 L12.1955218,1 L15,1 L15,3.80447821 L12.1955218,3.80447821 Z M1,9.4022391 L1,6.59706118 L3.80447821,6.59706118 L3.80447821,9.4022391 L1,9.4022391 Z M6.5977609,9.4022391 L6.5977609,6.5977609 L9.4022391,6.5977609 L9.4022391,9.4022391 L6.5977609,9.4022391 Z M12.1955218,9.4022391 L12.1955218,6.59706118 L15,6.59706118 L15,9.4022391 L12.1955218,9.4022391 Z M1,14.9993003 L1,12.1948221 L3.80447821,12.1948221 L3.80447821,14.9993003 L1,14.9993003 Z M6.5977609,14.9993003 L6.5977609,12.1948221 L9.4022391,12.1948221 L9.4022391,14.9993003 L6.5977609,14.9993003 Z M12.1955218,14.9993003 L12.1955218,12.1948221 L15,12.1948221 L15,14.9993003 L12.1955218,14.9993003 Z"
                                                                />
                                                            </g>
                                                        </svg>
                                                        <span class="hidden"
                                                            >Grid view</span
                                                        >
                                                    </span>
                                                </button>
                                                <button
                                                    class="changeView changeViewList"
                                                    type="button"
                                                    title="List view"
                                                    data-view="list"
                                                >
                                                    <span
                                                        class="iconChangeView"
                                                    >
                                                        <svg
                                                            fill="currentColor"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            height="16"
                                                            width="16"
                                                            viewBox="0 0 16 16"
                                                            title="List"
                                                            style="vertical-align: middle"
                                                        >
                                                            <title>List</title>
                                                            <g>
                                                                <path
                                                                    d="M0,3 L0,1 L2,1 L2,3 L0,3 Z M0,7 L0,5 L2,5 L2,7 L0,7 Z M0,11 L0,9 L2,9 L2,11 L0,11 Z M0,15 L0,13 L2,13 L2,15 L0,15 Z M4,3 L4,1 L16,1 L16,3 L4,3 Z M4,7 L4,5 L16,5 L16,7 L4,7 Z M4,11 L4,9 L16,9 L16,11 L4,11 Z M4,15 L4,13 L16,13 L16,15 L4,15 Z"
                                                                />
                                                            </g>
                                                        </svg>
                                                        <span class="hidden"
                                                            >List view</span
                                                        >
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="collSortBy pull-right">
                                                <!-- <label for="SortBy">Default sorting</label> -->
                                                <select
                                                    name="SortBy"
                                                    id="SortBy"
                                                    class="form-control"
                                                >
                                                    <option value
                                                        >Default sorting</option
                                                    >
                                                    <option value="manual"
                                                        >Featured</option
                                                    >
                                                    <option value="best-selling"
                                                        >Best Selling</option
                                                    >
                                                    <option
                                                        value="title-ascending"
                                                    >
                                                        Alphabetically, A-Z
                                                    </option>
                                                    <option
                                                        value="title-descending"
                                                    >
                                                        Alphabetically, Z-A
                                                    </option>
                                                    <option
                                                        value="price-ascending"
                                                    >
                                                        Price, low to high
                                                    </option>
                                                    <option
                                                        value="price-descending"
                                                    >
                                                        Price, high to low
                                                    </option>
                                                    <option
                                                        value="created-descending"
                                                    >
                                                        Date, new to old
                                                    </option>
                                                    <option
                                                        value="created-ascending"
                                                    >
                                                        Date, old to new
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collBoxProducts">
                                        <div
                                            id="velaProList"
                                            class="proList grid"
                                        >
                                            <transition name="slide-fade">
                                                <div
                                                    class="alert p-3"
                                                    :class="{
                                                        'alert-success': !remove,
                                                        'alert-danger': remove
                                                    }"
                                                    role="alert"
                                                    v-if="added"
                                                >
                                                    <i
                                                        class="fa fa-trash"
                                                        v-if="remove"
                                                    ></i>
                                                    <i
                                                        class="fa fa-check"
                                                        v-else
                                                    ></i>
                                                    Product
                                                    <a
                                                        href="#"
                                                        class="alert-link"
                                                        >{{ this.added }}</a
                                                    >is

                                                    <span v-if="remove"
                                                        >removed to cart</span
                                                    >
                                                    <span v-else
                                                        >added to cart</span
                                                    >
                                                </div>
                                            </transition>
                                            <transition name="slide-fade">
                                                <div
                                                    class="alert p-3"
                                                    :class="{
                                                        'alert-success': !wishlist_remove,
                                                        'alert-danger': wishlist_remove
                                                    }"
                                                    role="alert"
                                                    v-if="wishlist_added"
                                                >
                                                    <i
                                                        class="fa fa-trash"
                                                        v-if="wishlist_remove"
                                                    ></i
                                                    ><i
                                                        class="fa fa-check"
                                                        v-else
                                                    ></i>
                                                    Product
                                                    <a
                                                        href="#"
                                                        class="alert-link"
                                                    >
                                                        {{
                                                            this.wishlist_added
                                                        }} </a
                                                    >is
                                                    <span v-if="wishlist_remove"
                                                        >removed to
                                                        wishlist</span
                                                    >
                                                    <span v-else
                                                        >added to wishlist</span
                                                    >
                                                </div>
                                            </transition>
                                            <div class="rowFlex rowFlexMargin">
                                                <div
                                                    class="
                            velaProBlock
                            grid
                            col-sp-12 col-xs-6 col-md-4 col-lg-3
                          "
                                                    v-for="product in all_products"
                                                    :key="product.id"
                                                    v-if="
                                                        product.status !==
                                                            'Pending' &&
                                                            product.status !==
                                                                'Rejected'
                                                    "
                                                >
                                                    <div
                                                        class="velaProBlockInner"
                                                    >
                                                        <div
                                                            class="proHImage d-flex flexJustifyCenter"
                                                        >
                                                            <router-link
                                                                :to="{
                                                                    name:
                                                                        'Product',
                                                                    params: {
                                                                        id:
                                                                            product.id
                                                                    }
                                                                }"
                                                                class="proFeaturedImage"
                                                            >
                                                                <div
                                                                    class="wrap"
                                                                >
                                                                    <div
                                                                        class="p-relative"
                                                                    >
                                                                        <div
                                                                            class="product-card__image"
                                                                            style="padding-top: 124.25%"
                                                                        >
                                                                            <img
                                                                                class="product-card__img lazyload"
                                                                                :data-src="
                                                                                    `${baseUrl}/uploads/images/${product.thumbnail}`
                                                                                "
                                                                                data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                                                data-aspectratio="0.8048289738430584"
                                                                                data-ratio="0.8048289738430584"
                                                                                data-sizes="auto"
                                                                                :alt="
                                                                                    product.name
                                                                                "
                                                                            />
                                                                        </div>
                                                                        <div
                                                                            class="
                                        placeholder-background
                                        placeholder-background--animation
                                      "
                                                                            data-image-placeholder
                                                                        ></div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    v-if="
                                                                        product.backwardImage
                                                                    "
                                                                    class="
                                    hidden-sm hidden-xs
                                    proSwatch
                                    proImageSecond
                                  "
                                                                >
                                                                    <div
                                                                        class="p-relative"
                                                                    >
                                                                        <div
                                                                            class="product-card__image"
                                                                            style="padding-top: 124.25%"
                                                                        >
                                                                            <img
                                                                                class="product-card__img lazyload"
                                                                                :data-src="
                                                                                    `${baseUrl}/uploads/images/${product.backwardImage}`
                                                                                "
                                                                                data-widths="[180,360,540,720,900,1080,1296,1512,1728,1944,2160,2376,2592,2808,3024,4320]"
                                                                                data-aspectratio="0.8048289738430584"
                                                                                data-ratio="0.8048289738430584"
                                                                                data-sizes="auto"
                                                                                :alt="
                                                                                    product.name
                                                                                "
                                                                            />
                                                                        </div>
                                                                        <div
                                                                            class="
                                        placeholder-background
                                        placeholder-background--animation
                                      "
                                                                            data-image-placeholder
                                                                        ></div>
                                                                    </div>
                                                                </div>
                                                            </router-link>
                                                            <div
                                                                class="productLable"
                                                            >
                                                                <span
                                                                    class="labelSale"
                                                                    >Sale</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="productLable"
                                                                v-if="
                                                                    product.sale
                                                                "
                                                            >
                                                                <span
                                                                    class="labelSale"
                                                                    >Sale</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="proButton clearfix"
                                                            >
                                                                <button
                                                                    class="btn btnProduct btnAddToCart"
                                                                    :class="{
                                                                        added: isAdded(
                                                                            product.id
                                                                        )
                                                                    }"
                                                                    type="button"
                                                                    value="Submit"
                                                                    title="Add to Cart"
                                                                    @click.prevent="
                                                                        addToCart(
                                                                            product.id,
                                                                            product.name
                                                                        )
                                                                    "
                                                                >
                                                                    <span
                                                                        class="icons icon-handbag"
                                                                    ></span>
                                                                    <span
                                                                        class="text"
                                                                        >Add to
                                                                        Cart</span
                                                                    >
                                                                </button>
                                                                <div
                                                                    class="productQuickView"
                                                                >
                                                                    <a
                                                                        class="btn btnProduct btnProductQuickview"
                                                                        href="#"
                                                                        :class="{
                                                                            added: _isAdded(
                                                                                product.id
                                                                            )
                                                                        }"
                                                                        @click.prevent="
                                                                            addToWishlist(
                                                                                product.id,
                                                                                product.name
                                                                            )
                                                                        "
                                                                        data-handle="beoplay-a1"
                                                                        title="Add to wishlist"
                                                                    >
                                                                        <span
                                                                            class="icons icon-heart"
                                                                        ></span>
                                                                        <span
                                                                            class="text"
                                                                            >Add
                                                                            to
                                                                            wishlist</span
                                                                        >
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="productQuickView"
                                                                >
                                                                    <a
                                                                        class="btn btnProduct btnProductQuickview"
                                                                        href="#velaQuickView"
                                                                        data-handle="beoplay-a1"
                                                                        title="Quick view"
                                                                    >
                                                                        <span
                                                                            class="icons icon-magnifier"
                                                                        ></span>
                                                                        <span
                                                                            class="text"
                                                                            >Quick
                                                                            view</span
                                                                        >
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    v-if="
                                                                        product.category_name ==
                                                                            'Free Goods' ||
                                                                            product.price ==
                                                                                0
                                                                    "
                                                                    class="productQuickView"
                                                                >
                                                                    <a
                                                                        class="btn btnProduct btnProductQuickview"
                                                                        :href="
                                                                            `${baseUrl}/uploads/images/${product.book_pdf}`
                                                                        "
                                                                        :download="
                                                                            product.name
                                                                        "
                                                                        title="Download Now"
                                                                    >
                                                                        <span
                                                                            class="icons icon-cloud-download"
                                                                        ></span>
                                                                        <span
                                                                            class="text"
                                                                            >Download
                                                                            Now</span
                                                                        >
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="proContent">
                                                            <h5 class="proName">
                                                                <router-link
                                                                    :to="{
                                                                        name:
                                                                            'Product',
                                                                        params: {
                                                                            id:
                                                                                product.id
                                                                        }
                                                                    }"
                                                                    >{{
                                                                        product.name
                                                                    }}</router-link
                                                                >
                                                            </h5>
                                                            <div
                                                                class="groupPrice clearfix"
                                                            >
                                                                <div
                                                                    class="proPrice"
                                                                    v-if="
                                                                        product.discount >
                                                                            0
                                                                    "
                                                                >
                                                                    <div
                                                                        class="priceProduct priceCompare"
                                                                    >
                                                                        <span
                                                                            class="money"
                                                                            >RWF
                                                                            {{
                                                                                product.price
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                    <div
                                                                        class="priceProduct priceSale"
                                                                    >
                                                                        <span
                                                                            class="money"
                                                                            >RWF
                                                                            {{
                                                                                product.discounted_price
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="proPrice"
                                                                    v-else
                                                                >
                                                                    <div
                                                                        class="priceProduct"
                                                                    >
                                                                        <span
                                                                            class="money"
                                                                            >RWF
                                                                            {{
                                                                                product.price
                                                                            }}</span
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="velaSwatchCus"
                                                                ></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        id="collPagination"
                                        class="velaPaginationWrap clearfix"
                                    >
                                        <!-- <nav class="velaPagination pull-left">
                                 <ul class="pagination">
                                    <li class="disabled">
                                       <span>
                                          <i
                                             class="fa fa-angle-double-left"
                                          ></i>
                                       </span>
                                    </li>
                                    <li class="active"><span>1</span></li>
                                    <li>
                                       <a href="furniture4658.html?page=2" title
                                          >2</a
                                       >
                                    </li>
                                    <li class="pagiNext">
                                       <a
                                          href="furniture4658.html?page=2"
                                          title="Next"
                                       >
                                          <i
                                             class="fa fa-angle-double-right"
                                          ></i>
                                       </a>
                                    </li>
                                 </ul>
                              </nav> -->
                                        <div
                                            class="
                        collProductCount
                        itemPaginate
                        pull-right
                        hidden-xs hidden-sm
                      "
                                        >
                                            <span
                                                >Showing
                                                {{ all_products.length }}</span
                                            >
                                            of {{ all_products.length }} Results
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
<script>
import { mapState } from "vuex";
export default {
    name: "CollectionContainer",
    data() {
        return {
            added: false,
            wishlist_added: false,
            remove: false,
            wishlist_remove: false,
            product_category: 0,
            all_products: [],
            showFilter: false,
            baseUrl: "",
            show_cat: false,
            show_grand_cat: false
        };
    },
    computed: {
        ...mapState("products", ["cart", "wishlist", "products", "categories"])
    },
    created() {
        this.get_all_products();
    },
    mounted() {
        this.generateBaseUrl();
    },
    methods: {
        addToWishlist(id, name) {
            this.wishlist_added = name;
            if (
                this.wishlist !== null &&
                this.wishlist.findIndex(r => r.id === id) !== -1
            ) {
                this.wishlist_remove = true;
            } else {
                this.wishlist_remove = false;
            }
            this.$store.dispatch("products/addToWishlist", id);
            setTimeout(() => (this.wishlist_added = false), 1000);
        },
        display_categories(level, id, index) {
            if (level == "second" && this.show_cat == false) {
                $(".cat_second_level_" + id).addClass("show_categories");
                $(".cat_icon_" + index).removeClass("fa-plus");
                $(".cat_icon_" + index).addClass("fa-minus");
                this.show_cat = true;
            } else {
                $(".cat_second_level_" + id).removeClass("show_categories");
                $(".cat_icon_" + index).removeClass("fa-minus");
                $(".cat_icon_" + index).addClass("fa-plus");
                this.show_cat = false;
            }
            if (level == "third" && this.show_grand_cat == false) {
                $(".cat_third_level_" + id).addClass("show_categories");
                $(".grand_cat_icon_" + index).removeClass("fa-plus");
                $(".grand_cat_icon_" + index).addClass("fa-minus");
                this.show_grand_cat = true;
            } else {
                $(".cat_third_level_" + id).removeClass("show_categories");
                $(".grand_cat_icon_" + index).removeClass("fa-minus");
                $(".grand_cat_icon_" + index).addClass("fa-plus");
                this.show_grand_cat = false;
            }
        },

        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        addToCart(id, name) {
            this.added = name;
            if (
                this.cart !== null &&
                this.cart.findIndex(r => r.id === id) !== -1
            ) {
                this.remove = true;
            } else {
                this.remove = false;
            }
            this.$store.dispatch("products/addToCart", id);
            setTimeout(() => (this.added = false), 1000);
        },
        isAdded(id) {
            if (this.cart && this.cart.findIndex(r => r.id === id) !== -1) {
                return true;
            } else {
                return false;
            }
        },
        _isAdded(id) {
            if (
                this.wishlist &&
                this.wishlist.findIndex(r => r.id === id) !== -1
            ) {
                return true;
            } else {
                return false;
            }
        },
        filter_by_category(id) {
            this.product_category = id;
            if (this.product_category > 0) {
                this.all_products = this.products.filter(
                    p => p.categoryId == id
                );
            } else {
                this.all_products = this.products;
            }
        },
        filter_by_price(range) {
            let rangeArr = range.split("-");
            let start = rangeArr[0];
            let end = rangeArr[1];
            if (Boolean(end)) {
                this.all_products = this.products.filter(
                    p => p.price >= parseInt(start) && p.price <= parseInt(end)
                );
            } else {
                this.all_products = this.products.filter(
                    p => p.price >= parseInt(start)
                );
            }
        },

        filter_by_color(color) {
            console.log("color: " + color);
        },
        is_category_active(id) {
            if (this.product_category == id) {
                return true;
            } else {
                return false;
            }
        },
        get_all_products() {
            this.all_products = this.products;
        },
        toggleFilter() {
            this.showFilter = !this.showFilter;
        }
    },
    watch: {
        cart() {
            console.log("cart=>>>", this.cart);
        },
        products() {
            this.get_all_products();
        }
    }
};
</script>
<style lang="css" scoped>
.has_children_icon {
    font-size: 12px;
    margin-left: 8px;
    color: #fbad02;
}

.cat_second_level {
    margin-left: 20px;
    display: none;
}
.cat_third_level {
    margin-left: 40px;
    display: none;
}

.show_categories {
    display: block;
}
/* .category_nav ul ul{
                                             	top: 90;
                                             	display: none;
                                             	transition: top 3s;
                                             }
                                             .category_nav ul li:hover > ul{
                                             	display: block;
                                             }
                                             .category_nav ul ul ul li{
                                             	position: relative;
                                             	top: -5px;
                                             	left: 20px;
                                             } */

ul,
#myUL {
    list-style-type: none;
}

#myUL {
    margin: 0;
    padding: 0;
}

.caret {
    cursor: pointer;
    -webkit-user-select: none;
    /* Safari 3.1+ */
    -moz-user-select: none;
    /* Firefox 2+ */
    -ms-user-select: none;
    /* IE 10+ */
    user-select: none;
}

.caret::before {
    content: "\25B6";
    color: black;
    display: inline-block;
    margin-right: 6px;
}

.caret-down::before {
    -ms-transform: rotate(90deg);
    /* IE 9 */
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}

.nested {
    display: none;
}

/* .active {
                                             	display: block;
                                             } */

.added {
    background-color: #fbad02;
    border-color: #fbad02;
    color: #ffffff;
}

.slide-fade-enter-active {
    transition: all 0.4s ease;
}

.slide-fade-leave-active {
    transition: all 1.5s cubic-bezier(1, 0.5, 0.8, 1);
}

/* .slide-fade-leave-active below version 2.1.8 */

.slide-fade-enter,
.slide-fade-leave-to {
    transform: translateX(10px);
    opacity: 0;
}
</style>
