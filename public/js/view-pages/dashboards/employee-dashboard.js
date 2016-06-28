/**
 * Created by waqas on 6/27/2016.
 */
var EmployeeDasboard = function (win, doc, options) {
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        days: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        dataSet: [],
        total_fee: ['20000','25000','45000','10000'],
        appointments: [],
        status: ['completed','incomplete','rejected','pending']
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;


    var chartInitializer = function () {
        var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var randomScalingFactor = function () {
            return Math.round(Math.random() * 100);
            //return 0;
        };
        var randomColorFactor = function () {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function (opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };
        var config = {
            type: 'line',
            data: {
                labels: s.days,
                datasets: [{
                    label: "Patient Per Week",
                    data: [],
                    fill: false,
                    borderDash: [5, 5]
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Paitents Per Week'
                },
                tooltips: {
                    mode: 'label',
                    callbacks: {
                        // beforeTitle: function() {
                        //     return '...beforeTitle';
                        // },
                        // afterTitle: function() {
                        //     return '...afterTitle';
                        // },
                        // beforeBody: function() {
                        //     return '...beforeBody';
                        // },
                        // afterBody: function() {
                        //     return '...afterBody';
                        // },
                        // beforeFooter: function() {
                        //     return '...beforeFooter';
                        // },
                        // footer: function() {
                        //     return 'Footer';
                        // },
                        // afterFooter: function() {
                        //     return '...afterFooter';
                        // },
                    }
                },
                hover: {
                    mode: 'dataset'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Week'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            suggestedMin: -10,
                            suggestedMax: 250
                        }
                    }]
                }
            }
        };

        $.each(config.data.datasets, function (i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });
        var configPieChart = {
            type: 'pie',
            data: {
                datasets: [{
                    data: s.total_fee,
                    backgroundColor: [
                        "#F7464A",
                        "#46BFBD",
                        "#FDB45C",
                        "#949FB1",
                        "#4D5360",
                    ],
                }],
                labels: s.status
            },
            options: {
                responsive: true
            }
        };
        s
        //*** window On Load Event
        W.onload = function () {
            var ctx = document.getElementById("canvas").getContext("2d");
            if (config.data.datasets.data == '' || config.data.datasets.data == null || config.data.datasets.data == 0) {
                var myLineChart = new Chart(ctx, config);
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myPie = new Chart(ctx, configPieChart);
            }

            //window.myLine = new Chart(ctx, config);
        };


        $('#randomizeData').click(function () {
            $.each(config.data.datasets, function (i, dataset) {
                dataset.data = dataset.data.map(function () {
                    return randomScalingFactor();
                });

            });

            window.myLine.update();
        });

        $('#changeDataObject').click(function () {
            config.data = {
                labels: ["July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: "My First dataset",
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
                    fill: false,
                }, {
                    label: "My Second dataset",
                    fill: false,
                    data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()],
                }]
            };

            $.each(config.data.datasets, function (i, dataset) {
                dataset.borderColor = randomColor(0.4);
                dataset.backgroundColor = randomColor(0.5);
                dataset.pointBorderColor = randomColor(0.7);
                dataset.pointBackgroundColor = randomColor(0.5);
                dataset.pointBorderWidth = 1;
            });

            // Update the chart
            window.myLine.update();
        });

        $('#addDataset').click(function () {
            var newDataset = {
                label: 'Dataset ' + config.data.datasets.length,
                borderColor: randomColor(0.4),
                backgroundColor: randomColor(0.5),
                pointBorderColor: randomColor(0.7),
                pointBackgroundColor: randomColor(0.5),
                pointBorderWidth: 1,
                data: [],
            };

            for (var index = 0; index < config.data.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            config.data.datasets.push(newDataset);
            window.myLine.update();
        });

        $('#addData').click(function () {
            if (config.data.datasets.length > 0) {
                var month = MONTHS[config.data.labels.length % MONTHS.length];
                config.data.labels.push(month);

                $.each(config.data.datasets, function (i, dataset) {
                    dataset.data.push(randomScalingFactor());
                });

                window.myLine.update();
            }
        });

        $('#removeDataset').click(function () {
            config.data.datasets.splice(0, 1);
            window.myLine.update();
        });

        $('#removeData').click(function () {
            config.data.labels.splice(-1, 1); // remove the label first

            config.data.datasets.forEach(function (dataset, datasetIndex) {
                dataset.data.pop();
            });
            window.myLine.update();
        });
    }

    /**
     * Events Bindings | All Events Bindings Goes here
     * @access private
     * @return void
     */
    var eventsBindings = function () {

    };
    /**
     * Initialize | This function is used to Initialization
     * @access public
     * @return void
     */
    this.initializeAll = function () {
        chartInitializer();
        eventsBindings();
        if (s.formMode == window.FORM_EDIT) {
            $('#user_type').trigger('change');
        }
    }
}