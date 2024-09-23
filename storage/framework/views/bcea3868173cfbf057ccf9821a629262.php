<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <?php ($icon = \App\Model\BusinessSetting::where(['key' => 'fav_icon'])->first()->value); ?>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('storage/app/public/restaurant/' . $icon ?? '')); ?>">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/vendor.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/vendor/icon-set/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin/css/owl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/style.css">
    <?php echo $__env->yieldPushContent('css_or_js'); ?>

    <script
        src="<?php echo e(asset('public/assets/admin')); ?>/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/toastr.css">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/admin')); ?>/css/custom-helper.css">
</head>

<body class="footer-offset">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-none" id="loading">
                <div class="loader-image">
                    <img width="200" src="<?php echo e(asset('public/assets/admin/img/loader.gif')); ?>">
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.admin.partials._header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.admin.partials._sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<main id="content" role="main" class="main pointer-event">

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('layouts.admin.partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="modal fade" id="popup-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <h2 class="order-check-colour">
                                    <i class="tio-shopping-cart-outlined"></i> <?php echo e(translate('You have new order, Check Please.')); ?>

                                </h2>
                                <hr>
                                <button id="check-order" class="btn btn-primary"><?php echo e(translate('Ok, let me check')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="<?php echo e(asset('public/assets/admin')); ?>/js/custom.js"></script>

<?php echo $__env->yieldPushContent('script'); ?>

<script src="<?php echo e(asset('public/assets/admin')); ?>/js/vendor.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/theme.min.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/sweet_alert.js"></script>
<script src="<?php echo e(asset('public/assets/admin')); ?>/js/toastr.js"></script>
<script src="<?php echo e(asset('public/assets/admin/js/owl.min.js')); ?>"></script>


<?php echo Toastr::message(); ?>


<?php if($errors->any()): ?>
    <script>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr.error('<?php echo e($error); ?>', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </script>
<?php endif; ?>
<script>
    $(document).on('ready', function () {
        var sidebar = $('.js-navbar-vertical-aside').hsSideNav();

        $('.js-nav-tooltip-link').tooltip({boundary: 'window'})

        $(".js-nav-tooltip-link").on("show.bs.tooltip", function (e) {
            if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                return false;
            }
        });

        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });

        $('.js-form-search').each(function () {
            new HSFormSearch($(this)).init()
        });

        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });

        $('.js-daterangepicker').daterangepicker();

        $('.js-daterangepicker-times').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    });
</script>


<?php echo $__env->yieldPushContent('script_2'); ?>
<audio id="myAudio">
    <source src="<?php echo e(asset('public/assets/admin/sound/notification.mp3')); ?>" type="audio/mpeg">
</audio>

<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
</script>
<script>
    $('#check-order').on('click', function(){
        location.href = '<?php echo e(route('admin.order.list',['status'=>'all'])); ?>';
    })

    <?php if(Helpers::module_permission_check('order_management')): ?>
        setInterval(function () {
            $.get({
                url: '<?php echo e(route('admin.get-restaurant-data')); ?>',
                dataType: 'json',
                success: function (response) {
                    let data = response.data;
                    if (data.new_order > 0) {
                        playAudio();
                        $('#popup-modal').appendTo("body").modal('show');
                    }
                },
            });
        }, 10000);
    <?php endif; ?>

    function route_alert(route, message) {
        Swal.fire({
            title: '<?php echo e(translate("Are you sure?")); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#01684b',
            cancelButtonText: '<?php echo e(translate("No")); ?>',
            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = route;
            }
        })
    }

    $('.form-alert').on('click', function (){
        let id = $(this).data('id');
        let message = $(this).data('message');
        form_alert(id, message)
    });

    function form_alert(id, message) {
        Swal.fire({
            title: '<?php echo e(translate("Are you sure?")); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#01684b',
            cancelButtonText: '<?php echo e(translate("No")); ?>',
            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#'+id).submit()
            }
        })
    }

    function call_demo(){
        toastr.info('<?php echo e(translate("Disabled for demo version!")); ?>')
    }

    $('.call-demo').click(function() {
        if ('<?php echo e(env('APP_MODE')); ?>' === 'demo') {
            call_demo();
        }
    });
</script>

<script>

    $('.status-change-alert').on('click', function (){
        let url = $(this).data('route');
        let message = $(this).data('message');
        status_change_alert(url, message, event)
    });

    function status_change_alert(url, message, e) {
        e.preventDefault();
        Swal.fire({
            title: '<?php echo e(translate("Are you sure?")); ?>',
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'default',
            confirmButtonColor: '#107980',
            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            cancelButtonText: '<?php echo e(translate("No")); ?>',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.href = url;
            }
        })
    }
</script>

<script>
    var initialImages = [];
    $(window).on('load', function() {
        $("form").find('img').each(function (index, value) {
            initialImages.push(value.src);
        })
    })

    $(document).ready(function() {
        $('form').on('reset', function(e) {
            $("form").find('img').each(function (index, value) {
                $(value).attr('src', initialImages[index]);
            })
        });
    });
</script>

<script>
    $(function(){
        var owl = $('.single-item-slider');
        owl.owlCarousel({
            autoplay: false,
            items:1,
            onInitialized  : counter,
            onTranslated : counter,
            autoHeight: true,
            dots: true,
        });

        function counter(event) {
            var element   = event.target;         // DOM element, in this example .owl-carousel
            var items     = event.item.count;     // Number of items
            var item      = event.item.index + 1;     // Position of the current item

            if(item > items) {
                item = item - items
            }
            $('.slide-counter').html(+item+"/"+items)
        }
    });
</script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="<?php echo e(asset('public/assets/admin')); ?>/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/layouts/admin/app.blade.php ENDPATH**/ ?>