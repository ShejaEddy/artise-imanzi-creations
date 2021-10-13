import { Line, mixins } from "vue-chartjs";
const { reactiveProp } = mixins;
export default {
    extends: Line,
    mixins: [reactiveProp],
    props: ["options"],
    mounted() {
        console.log("chartData Line", this.chartData);
        this.renderChart(this.chartData, this.options);
    }
};