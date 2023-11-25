var ChartClass;

(function ($) {

    $(document).ready(function () {
        var labels = Object.keys(listings);
        console.log(labels);
        var data = Object.values(listings);
        var ctx = document.getElementById('myChart').getContext('2d');
        ChartClass.ChartData(ctx, 'bar', labels, data);

        var cty = document.getElementById('mySecondChart').getContext('2d');
        ChartClass.ChartData(cty, 'pie', labels, data);
    });

    ChartClass = {
        ChartData:function(ctx, type, labels, data) {
            new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# of Products',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',   // Red
                            'rgba(54, 162, 235, 0.2)',  // Blue
                            'rgba(255, 206, 86, 0.2)',  // Yellow
                            'rgba(75, 192, 192, 0.2)',  // Green
                            'rgba(153, 102, 255, 0.2)', // Purple
                            'rgba(255, 159, 64, 0.2)'   // Orange
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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
