var ChartClass;
var ChartClass2;

(function ($) {

    $(document).ready(function () {


        console.log(categoryTotalPrices)
        var label = [];
        categoryCounts.map(item => {
            label.push(item.category);
        });

        var data = [];
        Object.values(categoryCounts).map(item => {
            data.push(item.category_count);
        });

        var label2 = [];
        categoryTotalPrices.map(item => {
            console.log('item:  ', item)
            label2.push(item.category);
        });

        var data2 = [];
        Object.values(categoryTotalPrices).map(item => {
            data2.push(item.total_price);
        });
        console.log(data);

        var ctx = document.getElementById('myChart').getContext('2d');
        ChartClass.ChartData(ctx, 'bar', label, data);
        var cty = document.getElementById('mySecondChart').getContext('2d');
        ChartClass2.ChartData(cty, 'pie', label2, data2);
    });

    ChartClass = {
        ChartData: function (ctx, type, label, data) {
            new Chart(ctx, {
                type: type,
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Number of Products',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',   // Red
                            'rgba(54, 162, 235, 0.2)',  // Blue
                            'rgba(255, 206, 86, 0.2)',  // Yellow
                            'rgba(75, 192, 192, 0.2)',  // Green
                            'rgba(153, 102, 255, 0.2)', // Purple
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(251, 191, 36, 0.2)',
                            'rgba(250, 204, 21, 0.2)',
                            'rgba(163, 230, 53, 0.2)',
                            'rgba(139, 92, 246, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64,1)',
                            'rgba(251, 191, 36,1)',
                            'rgba(250, 204, 21, 1)',
                            'rgba(163, 230, 53,1)',
                            'rgba(139, 92, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    };

    ChartClass2 = {
        ChartData: function (cty, type, label2, data2) {
            new Chart(cty, {
                type: type,
                data: {
                    labels: label2,
                    datasets: [{
                        label: 'Amount of Sales',
                        data: data2,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(251, 191, 36, 0.2)',
                            'rgba(250, 204, 21, 0.2)',
                            'rgba(163, 230, 53, 0.2)',
                            'rgba(139, 92, 246, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                             'rgba(255, 159, 64,1)',
                             'rgba(251, 191, 36,1)',
                             'rgba(250, 204, 21, 1)',
                             'rgba(163, 230, 53,1)',
                             'rgba(139, 92, 246, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    };
})(jQuery);
