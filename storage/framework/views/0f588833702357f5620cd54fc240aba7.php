<?php $__env->startSection('title', translate('Dashboard')); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['dashboard_management'])): ?>
        <div class="content container-fluid">
            <div class="page-header mb-0 pb-2 border-0">
                <h1 class="page-header-title text-107980"><?php echo e(translate('welcome')); ?>, <?php echo e(auth('admin')->user()->f_name); ?></h1>
                <p class="welcome-msg"><?php echo e(translate('welcome_message')); ?></p>
            </div>

            <div class="card mb-10px">
                <div class="card-body">
                    <div class="btn--container justify-content-between align-items-center mb-2 pb-1">
                        <h5 class="card-title mb-2">
                            <img src="<?php echo e(asset('/public/assets/admin/img/business-analytics.png')); ?>" alt="" class="<?php echo e(translate('card-icon')); ?>">
                            <?php echo e(translate('Business Analytics')); ?>

                        </h5>
                        <div class="mb-2">
                            <select class="custom-select statistics-type-select" name="statistics_type">
                                <option value="overall" <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'overall' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('Overall Statistics')); ?>

                                </option>
                                <option value="today" <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'today' ? 'selected' : ''); ?>>
                                    <?php echo e(translate("Today's Statistics")); ?>

                                </option>
                                <option value="this_month" <?php echo e(session()->has('statistics_type') && session('statistics_type') == 'this_month' ? 'selected' : ''); ?>>
                                    <?php echo e(translate("This Month's Statistics")); ?>

                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2" id="order_stats">
                        <?php echo $__env->make('admin-views.partials._dashboard-order-stats',['data'=>$data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>

            <div class="dashboard-statistics">
                <div class="row g-1">
                    <div class="col-lg-8 col--xl-8">
                        <div class="card h-100 bg-white">
                            <div class="card-body p-20px pb-0">
                                <div class="btn--container justify-content-between align-items-center">
                                    <h5 class="card-title mb-2">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/order-statistics.png')); ?>" alt=""
                                             class="card-icon">
                                        <span><?php echo e(translate('order_statistics')); ?></span>
                                    </h5>
                                    <div class="mb-2">
                                        <div class="d-flex flex-wrap statistics-btn-grp">
                                            <label>
                                                <input type="radio" name="order__statistics" hidden checked>
                                                <span class="order-type" data-order-type="yearOrder"><?php echo e(translate('This_Year')); ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="order__statistics" hidden>
                                                <span class="order-type" data-order-type="MonthOrder"><?php echo e(translate('This_Month')); ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="order__statistics" hidden>
                                                <span class="order-type" data-order-type="WeekOrder"><?php echo e(translate('This Week')); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="updatingOrderData">
                                    <div id="line-chart-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col--xl-4">
                        <div class="card h-100 bg-white">
                            <div class="card-header border-0 order-header-shadow">
                                <h5 class="card-title">
                                    <span><?php echo e(translate('order_status_statistics')); ?></span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="position-relative pie-chart">
                                    <div id="dognut-pie"></div>
                                    <div class="total--orders">
                                        <h3><?php echo e($data['pending_count'] + $data['ongoing_count'] + $data['delivered_count']+ $data['canceled_count']+ $data['returned_count']+ $data['failed_count']); ?> </h3>
                                        <span><?php echo e(translate('orders')); ?></span>
                                    </div>
                                </div>
                                <div class="apex-legends">
                                    <div class="before-bg-E5F5F1">
                                        <span><?php echo e(translate('pending')); ?> (<?php echo e($data['pending_count']); ?>)</span>
                                    </div>
                                    <div class="before-bg-036BB7">
                                        <span><?php echo e(translate('ongoing')); ?> (<?php echo e($data['ongoing_count']); ?>)</span>
                                    </div>
                                    <div class="before-bg-107980">
                                        <span><?php echo e(translate('delivered')); ?> (<?php echo e($data['delivered_count']); ?>)</span>
                                    </div>
                                    <div class="before-bg-0e0def">
                                        <span><?php echo e(translate('canceled')); ?> (<?php echo e($data['canceled_count']); ?>)</span>
                                    </div>
                                    <div class="before-bg-ff00ff">
                                        <span><?php echo e(translate('returned')); ?> (<?php echo e($data['returned_count']); ?>)</span>
                                    </div>
                                    <div class="before-bg-f51414">
                                        <span><?php echo e(translate('failed')); ?> (<?php echo e($data['failed_count']); ?>)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col--xl-8">
                        <div class="card h-100 bg-white">
                            <div class="card-body p-20px pb-0">
                                <div class="btn--container justify-content-between align-items-center">
                                    <h5 class="card-title mb-2">
                                        <img src="<?php echo e(asset('/public/assets/admin/img/order-statistics.png')); ?>" alt=""
                                             class="card-icon">
                                        <span><?php echo e(translate('earning_statistics')); ?></span>
                                    </h5>
                                    <div class="mb-2">
                                        <div class="d-flex flex-wrap statistics-btn-grp">
                                            <label>
                                                <input type="radio" name="earning__statistics" hidden checked>
                                                <span class="earning-statistics" data-earn-type="yearEarn"><?php echo e(translate('This_Year')); ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="earning__statistics" hidden>
                                                <span class="earning-statistics" data-earn-type="MonthEarn"><?php echo e(translate('This_Month')); ?></span>
                                            </label>
                                            <label>
                                                <input type="radio" name="earning__statistics" hidden>
                                                <span class="earning-statistics" data-earn-type="WeekEarn"><?php echo e(translate('This Week')); ?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="updatingData">
                                    <div id="line-adwords"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col--xl-4">
                        <div class="card h-100 bg-white">
                            <div class="card-header border-0 order-header-shadow">
                                <h5 class="card-title d-flex justify-content-between flex-grow-1">
                                    <span><?php echo e(translate('recent_orders')); ?></span>
                                    <a href="<?php echo e(route('admin.orders.list',['all'])); ?>"
                                       class="fz-12px font-medium text-006AE5"><?php echo e(translate('view_all')); ?></a>
                                </h5>
                            </div>
                            <div class="card-body p-10px">
                                <ul class="recent--orders">
                                    <?php $__currentLoopData = $data['recent_orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.orders.details', ['id'=>$order['id']])); ?>">
                                                <div>
                                                    <h6><?php echo e(translate('order')); ?> #<?php echo e($order['id']); ?></h6>
                                                    <span
                                                        class="text-uppercase"><?php echo e(date('m-d-Y  h:i A', strtotime($order['created_at']))); ?></span>
                                                </div>
                                                <?php if($order['order_status'] == 'pending'): ?>
                                                    <span
                                                        class="status text-0661cb"><?php echo e(translate($order['order_status'])); ?></span>
                                                <?php elseif($order['order_status'] == 'delivered'): ?>
                                                    <span
                                                        class="status text-56b98f"><?php echo e(translate($order['order_status'])); ?></span>
                                                <?php elseif($order['order_status'] == 'confirmed' || $order['order_status'] == 'processing' || $order['order_status'] == 'out_for_delivery'): ?>
                                                    <span
                                                        class="status text-F5A200"><?php echo e($order['order_status'] == 'processing' ? translate('packaging') : translate($order['order_status'])); ?></span>
                                                <?php elseif($order['order_status'] == 'canceled' || $order['order_status'] == 'failed'): ?>
                                                    <span
                                                        class="status text-F5A200"><?php echo e(translate($order['order_status'])); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="status text-0661CB"><?php echo e(translate($order['order_status'])); ?></span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card h-100">
                            <?php echo $__env->make('admin-views.partials._top-selling-products',['top_sell'=>$data['top_sell']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card h-100">
                            <?php echo $__env->make('admin-views.partials._most-rated-products',['most_rated_products'=>$data['most_rated_products']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card h-100">
                            <?php echo $__env->make('admin-views.partials._top-customer',['top_customer'=>$data['top_customer']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php $__env->stopSection(); ?>

            <?php $__env->startPush('script'); ?>
                <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
                <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chart.js.extensions/chartjs-extensions.js"></script>
                <script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js"></script>
                <script src="<?php echo e(asset('/public/assets/admin/js/apex-charts/apexcharts.js')); ?>"></script>
                <script src="<?php echo e(asset('/public/assets/admin/js/apex-charts/dashboard.js')); ?>"></script>
            <?php $__env->stopPush(); ?>

            <?php $__env->startPush('script_2'); ?>
                <script>
                    "use strict";

                    $('.statistics-type-select').on('change', function() {
                        order_stats_update($(this).val());
                    });

                    $('.order-type').on('click', function() {
                        var orderType = $(this).data('order-type');
                        orderStatisticsUpdate(orderType);
                    });

                    $('.earning-statistics').on('click', function() {
                        var earnType = $(this).data('earn-type');
                        earningStatisticsUpdate(earnType);
                    });

                    var options = {
                        series: [{
                            name: "<?php echo e(translate('Orders')); ?>",
                            data: [
                                <?php echo e($orderStatisticsChart[1]); ?>, <?php echo e($orderStatisticsChart[2]); ?>, <?php echo e($orderStatisticsChart[3]); ?>, <?php echo e($orderStatisticsChart[4]); ?>,
                                <?php echo e($orderStatisticsChart[5]); ?>, <?php echo e($orderStatisticsChart[6]); ?>, <?php echo e($orderStatisticsChart[7]); ?>, <?php echo e($orderStatisticsChart[8]); ?>,
                                <?php echo e($orderStatisticsChart[9]); ?>, <?php echo e($orderStatisticsChart[10]); ?>, <?php echo e($orderStatisticsChart[11]); ?>, <?php echo e($orderStatisticsChart[12]); ?>

                            ],
                        }],
                        chart: {
                            height: 316,
                            type: 'line',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false,
                            },
                            markers: {
                                size: 5,
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        colors: ['#87bcbf', '#107980'],
                        stroke: {
                            curve: 'smooth',
                            width: 3,
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        },
                        grid: {
                            show: true,
                            padding: {
                                bottom: 0
                            },
                            borderColor: "#d9e7ef",
                            strokeDashArray: 7,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        yaxis: {
                            tickAmount: 4,
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#line-chart-1"), options);
                    chart.render();

                    var options = {
                        series: [<?php echo e($data['ongoing_count']); ?>, <?php echo e($data['delivered_count']); ?>, <?php echo e($data['pending_count']); ?>, <?php echo e($data['canceled']); ?>, <?php echo e($data['returned']); ?>, <?php echo e($data['failed']); ?>],
                        chart: {
                            width: 320,
                            type: 'donut',
                        },
                        labels: ['<?php echo e(translate('ongoing')); ?>', '<?php echo e(translate('delivered')); ?>', '<?php echo e(translate('pending')); ?>', '<?php echo e(translate('canceled')); ?>', '<?php echo e(translate('returned')); ?>', '<?php echo e(translate('failed')); ?>'],
                        dataLabels: {
                            enabled: false,
                            style: {
                                colors: ['#036BB7', '#107980', '#6a5acd', '#ff00ff', '#0e0def', '#f51414']
                            }
                        },
                        responsive: [{
                            breakpoint: 1650,
                            options: {
                                chart: {
                                    width: 250
                                },
                            }
                        }],
                        colors: ['#036BB7', '#107980', '#6a5acd', '#0e0def', '#ff00ff', '#f51414'],
                        fill: {
                            colors: ['#036BB7', '#107980', '#6a5acd', '#0e0def', '#ff00ff', '#f51414']
                        },
                        legend: {
                            show: false
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#dognut-pie"), options);
                    chart.render();

                    var optionsLine = {
                        chart: {
                            height: 328,
                            type: 'line',
                            zoom: {
                                enabled: false
                            },
                            toolbar: {
                                show: false,
                            },
                        },
                        stroke: {
                            curve: 'straight',
                            width: 2
                        },
                        colors: ['#87bcbf', '#107980'],
                        series: [{
                            name: "<?php echo e(translate('Earning')); ?>",
                            data: [<?php echo e($earning[1]); ?>, <?php echo e($earning[2]); ?>, <?php echo e($earning[3]); ?>, <?php echo e($earning[4]); ?>, <?php echo e($earning[5]); ?>, <?php echo e($earning[6]); ?>, <?php echo e($earning[7]); ?>, <?php echo e($earning[8]); ?>, <?php echo e($earning[9]); ?>, <?php echo e($earning[10]); ?>, <?php echo e($earning[11]); ?>, <?php echo e($earning[12]); ?>],
                        },
                        ],
                        markers: {
                            size: 6,
                            strokeWidth: 0,
                            hover: {
                                size: 9
                            }
                        },
                        grid: {
                            show: true,
                            padding: {
                                bottom: 0
                            },
                            borderColor: "#d9e7ef",
                            strokeDashArray: 7,
                            xaxis: {
                                lines: {
                                    show: true
                                }
                            }
                        },
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        xaxis: {
                            tooltip: {
                                enabled: false
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'right',
                            offsetY: -20
                        }
                    }
                    var chartLine = new ApexCharts(document.querySelector('#line-adwords'), optionsLine);
                    chartLine.render();

                    function order_stats_update(type) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "<?php echo e(route('admin.order-stats')); ?>",
                            type: "post",
                            data: {
                                statistics_type: type,
                            },
                            beforeSend: function () {
                                $('#loading').show()
                            },
                            success: function (data) {
                                $('#order_stats').html(data.view)
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                            },
                            complete: function () {
                                $('#loading').hide()
                            }
                        });
                    }

                    Chart.plugins.unregister(ChartDataLabels);

                    function orderStatisticsUpdate(value) {

                        $.ajax({
                            url: '<?php echo e(route('admin.dashboard.order-statistics')); ?>',
                            type: 'GET',
                            data: {
                                type: value
                            },
                            beforeSend: function () {
                                $('#loading').show()
                            },
                            success: function (response_data) {
                                console.log(response_data);
                                document.getElementById("line-chart-1").remove();
                                let graph = document.createElement('div');
                                graph.setAttribute("id", "line-chart-1");
                                document.getElementById("updatingOrderData").appendChild(graph);

                                var options = {
                                    series: [{
                                        name: "<?php echo e(translate('Orders')); ?>",
                                        data: response_data.orders,
                                    }],
                                    chart: {
                                        height: 316,
                                        type: 'line',
                                        zoom: {
                                            enabled: false
                                        },
                                        toolbar: {
                                            show: false,
                                        },
                                        markers: {
                                            size: 5,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false,
                                    },
                                    colors: ['#87bcbf', '#107980'],
                                    stroke: {
                                        curve: 'smooth',
                                        width: 3,
                                    },
                                    xaxis: {
                                        categories: response_data.orders_label,
                                    },
                                    grid: {
                                        show: true,
                                        padding: {
                                            bottom: 0
                                        },
                                        borderColor: "#d9e7ef",
                                        strokeDashArray: 7,
                                        xaxis: {
                                            lines: {
                                                show: true
                                            }
                                        }
                                    },
                                    yaxis: {
                                        tickAmount: 4,
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#line-chart-1"), options);
                                chart.render();
                            },
                            complete: function () {
                                $('#loading').hide()
                            }
                        });
                    }

                    function earningStatisticsUpdate(value) {
                        $.ajax({
                            url: '<?php echo e(route('admin.dashboard.earning-statistics')); ?>',
                            type: 'GET',
                            data: {
                                type: value
                            },
                            beforeSend: function () {
                                $('#loading').show()
                            },
                            success: function (response_data) {
                                document.getElementById("line-adwords").remove();
                                let graph = document.createElement('div');
                                graph.setAttribute("id", "line-adwords");
                                document.getElementById("updatingData").appendChild(graph);

                                var optionsLine = {
                                    chart: {
                                        height: 328,
                                        type: 'line',
                                        zoom: {
                                            enabled: false
                                        },
                                        toolbar: {
                                            show: false,
                                        },
                                    },
                                    stroke: {
                                        curve: 'straight',
                                        width: 2
                                    },
                                    colors: ['#87bcbf', '#107980'],
                                    series: [{
                                        name: "<?php echo e(translate('Earning')); ?>",
                                        data: response_data.earning,
                                    }],
                                    markers: {
                                        size: 6,
                                        strokeWidth: 0,
                                        hover: {
                                            size: 9
                                        }
                                    },
                                    grid: {
                                        show: true,
                                        padding: {
                                            bottom: 0
                                        },
                                        borderColor: "#d9e7ef",
                                        strokeDashArray: 7,
                                        xaxis: {
                                            lines: {
                                                show: true
                                            }
                                        }
                                    },
                                    labels: response_data.earning_label,
                                    xaxis: {
                                        tooltip: {
                                            enabled: false
                                        }
                                    },
                                    legend: {
                                        position: 'top',
                                        horizontalAlign: 'right',
                                        offsetY: -20
                                    }
                                }
                                var chartLine = new ApexCharts(document.querySelector('#line-adwords'), optionsLine);
                                chartLine.render();
                            },
                            complete: function () {
                                $('#loading').hide()
                            }
                        });
                    }
                </script>
        <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/dashboard.blade.php ENDPATH**/ ?>