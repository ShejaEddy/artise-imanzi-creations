<template>
    <p>View categories</p>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
    name: "ViewProductCategoriesContainer"
};
</script>
<style scoped>
.slide-fade-enter-active {
    transition: all 0.8s ease;
}
.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
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
div.card {
    transition: height 0.8s;
}
</style>
