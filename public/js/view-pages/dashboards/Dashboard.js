/**
 * Created by waqas on 6/27/2016.
 */
var Dashboard = function (win, doc, options) {
    var W = win;
    var D = doc;
    var defaults = {
        dataFormId: "#regForm",
        appointmentLineChartDataset: [],
        appointmentPieChartDataset: [],
        appointments: [],
    };
    var settings = $.extend(defaults, options || {});
    var s = settings;

    console.log(s.appointments);
    var makeFullCalendarComponent = function () {

        $(function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            }

            if(mm<10) {
                mm='0'+mm
            }

            today = yyyy + '-' + mm +'-' + dd;

            $('#appointmentsCalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: today,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                /*views: {
                    agenda: {
                        eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
                    }
                },*/
                events: s.appointments,
                eventLimit:{
                    'agenda': 6, // adjust to 6 only for agendaWeek/agendaDay
                    'default': true // give the default value to other views
                },
                eventLimitClick: function(cellInfo) {
                    if (cellInfo.date) {
                        // var newdate = moment(cellInfo.date).format('YYYY-MM-DD');
                        // window.open('url-i-am-calling?variables', "_blank");
                        return false;
                    }
                },
                /*events: [
                    {
                        title: 'All Day Event',
                        start: '2016-06-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2016-06-07',
                        end: '2016-06-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-06-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-06-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2016-06-11',
                        end: '2016-06-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-06-12T10:30:00',
                        end: '2016-06-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2016-06-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-06-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2016-06-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2016-06-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2016-06-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2016-06-28'
                    }
                ]*/
            });
        });

    }

    var chartInitializer = function () {
        var config = {
            type: 'line',
            data: {
                labels: s.appointmentLineChartDataset.labels,
                datasets: [{
                    label: "Appointment(s)",
                    data: s.appointmentLineChartDataset.data,
                    fill: false,
                    borderDash: [5, 5]
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Appointments Per Week'
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
                            suggestedMin: s.appointmentLineChartDataset.data.min() - 5,
                            suggestedMax: s.appointmentLineChartDataset.data.max() +10
                        }
                    }]
                }
            }
        };

        var randomColorFactor = function () {
            return Math.round(Math.random() * 255);
        };
        var randomColor = function (opacity) {
            return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
        };
        $.each(config.data.datasets, function (i, dataset) {
            dataset.borderColor = randomColor(0.4);
            dataset.backgroundColor = randomColor(0.5);
            dataset.pointBorderColor = randomColor(0.7);
            dataset.pointBackgroundColor = randomColor(0.5);
            dataset.pointBorderWidth = 1;
        });

        //*** window On Load Event
        W.onload = function () {
            //*** LineChart Box 1
            var ctx = document.getElementById("canvas").getContext("2d");
            var myLineChart = new Chart(ctx, config);

            //PieChart Box 2
            var ctx = document.getElementById("chart-area").getContext("2d");
            var configPieChart = {
                type: 'pie',

                data: {
                    segmentShowStroke : true,
                    labels: s.appointmentPieChartDataset.labels,
                    datasets: [{
                        data: s.appointmentPieChartDataset.data,
                        backgroundColor: s.appointmentPieChartDataset.backgroundColor,
                    }],
                },
                options: {
                    responsive: true,
                }
            };
            W.myPie = new Chart(ctx, configPieChart);
        };
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
        makeFullCalendarComponent();
        eventsBindings();
        if (s.formMode == window.FORM_EDIT) {
            $('#user_type').trigger('change');
        }
    }
}