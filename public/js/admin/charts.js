$(document).ready(function() {
    var options = {
        series: [],
        chart: {
            type: "donut",
        },
        noData: {
            text: 'Loading...'
        },
        labels: [],
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200,
                },
                legend: {
                    position: "bottom",
                },
            },
        }, ],
    };

    // 
    var options2 = {
        series: [{
            name: "Order",
            data: [],
        }],
        chart: {
            height: 350,
            type: "line",
            zoom: {
                enabled: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "straight",
        },
        noData: {
            text: 'Loading...'
        },
        grid: {
            row: {
                colors: ["#f3f3f3", "transparent"],
                opacity: 0.5,
            },
        },
        xaxis: {
            categories: [],
        },
    };
    var chart1 = new ApexCharts(document.querySelector("#order-status-chart"), options);
    chart1.render();

    var chart2 = new ApexCharts(document.querySelector("#order-chart"), options2);
    chart2.render();

    // ajax update
    $.getJSON('/admin/chart/order_status').done(function(response) {
        chart1.updateOptions({
            labels: response.labels,
            series: response.data
        });
    });

    $.getJSON('/admin/chart/order_by_month').done(function(response) {
        chart2.updateOptions({
            xaxis: {
                categories: response.labels
            },
            series: [{
                name: response.name,
                data: response.data,
            }]
        });
    });

});