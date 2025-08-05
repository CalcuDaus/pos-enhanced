var options = {
    series: [
        {
            name: "Pendapatan",
            data: lastYearData.incomeData,
        },
        {
            name: "Pengeluaran",
            data: lastYearData.expenseData,
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            borderRadius: 5,
            borderRadiusApplication: "end",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: lastYearData.categories,
    },
    yaxis: {
        title: {
            text: "Rp (rupiah)",
        },
    },
    fill: {
        opacity: 1,
    },
    colors: ["#4CAF50", "#F44336"],
    tooltip: {
        y: {
            formatter: function (val) {
                return "Rp " + new Intl.NumberFormat("id-ID").format(val);
            },
        },
    },
};
var chart = new ApexCharts(
    document.querySelector("#yearly-summary-chart"),
    options
);

var optionsDaily = {
    series: [
        {
            name: "Pendapatan",
            data: dailyData.incomeData,
        },
        {
            name: "Pengeluaran",
            data: dailyData.expenseData,
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            borderRadius: 5,
            borderRadiusApplication: "end",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: dailyData.categories,
    },
    yaxis: {
        title: {
            text: "Rp (rupiah)",
        },
    },
    fill: {
        opacity: 1,
    },
    colors: ["#4CAF50", "#F44336"],
    tooltip: {
        y: {
            formatter: function (val) {
                return "Rp " + new Intl.NumberFormat("id-ID").format(val);
            },
        },
    },
};
var chartDaily = new ApexCharts(
    document.querySelector("#daily-summary-chart"),
    optionsDaily
);

chart.render();
chartDaily.render();
