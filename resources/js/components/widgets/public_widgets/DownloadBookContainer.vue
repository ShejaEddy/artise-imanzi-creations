<template>
    <div
        class="velaHomeBlogs mbGutter style1"
        style="background-color: rgba(0, 0, 0, 0); padding: 50px 0 20px;"
    >
        <div class="container">
            <div class="velaHomeBlogsInner">
                <div
                    style="margin:0 auto; float:none; padding:10px 0px;"
                    class="col-md-6"
                    v-for="ct in cart"
                    :key="ct.id"
                    v-if="
                        ct.book_pdf != '' ||
                            ct.book_pdf != null ||
                            ct.book_pdf != undefined ||
                            ct.book_pdf == 'N/A'
                    "
                >
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ ct.name }}</h5>
                            <p class="card-text">
                                Click the Button below to download your
                                purchased eBook!
                            </p>
                            <a
                                :href="`${baseUrl}/storage/${ct.book_pdf}`"
                                :download="ct.name"
                                class="btnNewsletter btnVelaOne"
                            >
                                <span>Download now</span>
                                <i
                                    style="font-size:20px !important;"
                                    class="icons icon-cloud-download ml-3"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "DownloadBook",
    data() {
        return {
            baseUrl: "",
            showFilter: false,
            cart: JSON.parse(localStorage.getItem("cart_pro_download"))
        };
    },
    computed: {},
    mounted() {
        this.scrollTop();
        this.generateBaseUrl();
    },
    methods: {
        generateBaseUrl() {
            let base_url = window.location.origin;
            this.baseUrl = base_url;
        },
        scrollTop() {
            this.intervalId = setInterval(() => {
                if (window.pageYOffset == 0) {
                    clearInterval(this.intervalId);
                }
                window.scroll(0, window.pageYOffset - 50);
            }, 20);
        }
    }
};
</script>
