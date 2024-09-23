<?php $__env->startSection('title', translate('new sale')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
        <div class="content container-fluid">
            <div class="d-flex flex-wrap">
                <div class="order--pos-left">
                    <div class="card">
                        <div class="card-header m-1 bg-light border-0">
                            <h5 class="card-title">
                                <span>
                                <?php echo e(translate('Product section')); ?>

                            </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4 g-3">
                                <div class="col-sm-6">
                                    <div class="input-group header-item">
                                        <select name="category" id="category" class="form-control js-select2-custom mx-1" title="<?php echo e(translate('select category')); ?>">
                                            <option value=""><?php echo e(translate('All Categories')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->id); ?>" <?php echo e($category == $item->id ? 'selected' : ''); ?>><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <form id="search-form">
                                        <div class="input-group input-group-merge input-group-flush">
                                            <div class="input-group-prepend w--30 justify-content-center">
                                                <div class="input-group-text">
                                                    <i class="tio-search"></i>
                                                </div>
                                            </div>
                                            <input id="datatableSearch" type="search" value="<?php echo e($keyword?$keyword:''); ?>" name="search"
                                                class="form-control rounded border"
                                                placeholder="<?php echo e(translate('Search by product name')); ?>"
                                                aria-label="Search here">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="items">
                                <div class="row g-1">
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="order--item-box item-box">
                                            <?php echo $__env->make('admin-views.pos._single_product',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <div class="pt-4">
                                <?php echo $products->withQueryString()->links(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="order--pos-right">
                    <div class="card">
                        <div class="card-header bg-light border-0 m-1">
                            <h5 class="card-title">
                                <span>
                                    <?php echo e(translate('Billing section')); ?>

                                </span>
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="px-4">
                                <div class="w-100">
                                    <div class="d-flex flex-wrap flex-row py-2 add--customer-btn">
                                        <select id='customer' name="customer_id" data-placeholder="<?php echo e(translate('Walk In Customer')); ?>" class="js-data-example-ajax form-control m-1">
                                            <option value="" selected disabled><?php echo e(translate('select customer')); ?></option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user['id']); ?>" <?php echo e(session('customer_id') == $user['id'] ? 'selected' : ''); ?>><?php echo e($user['f_name'] . ' ' . $user['l_name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <button class="btn btn--primary rounded font-regular" data-toggle="modal" data-target="#add-customer" type="button"><?php echo e(translate('Add New Customer')); ?></button>
                                    </div>
                                </div>
                                <div class="w-100 py-2">
                                    <h5><?php echo e(translate('Select Branch')); ?></h5>
                                    <select id="branch" name="branch_id" class="js-data-example-ajax-2 form-control">
                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch['id']); ?>" <?php echo e(session('branch_id') == $branch['id'] ? 'selected' : ''); ?>><?php echo e($branch['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="w-100 py-2">
                                    <div class="form-group">
                                        <label class="input-label font-weight-semibold fz-16 text-dark"><?php echo e(translate('Select Order Type')); ?></label>
                                        <div>
                                            <div class="form-control d-flex flex-column-3">
                                                <label class="custom-radio d-flex gap-2 align-items-center m-0">
                                                    <input type="radio" class="order-type-radio" name="order_type" value="take_away" <?php echo e(!session()->has('order_type') || session()->get('order_type') == 'take_away' ? 'checked' : ''); ?>>
                                                    <span class="media align-items-center mb-0">
                                                        <span class="media-body ml-1"><?php echo e(translate('Take Away')); ?></span>
                                                    </span>
                                                </label>
                                                <label class="custom-radio d-flex gap-2 align-items-center m-0 ml-3">
                                                    <input type="radio" class="order-type-radio" name="order_type" value="home_delivery" <?php echo e(session()->has('order_type') && session()->get('order_type') == 'home_delivery' ? 'checked' : ''); ?>>
                                                    <span class="media align-items-center mb-0">
                                                        <span class="media-body ml-1"><?php echo e(translate('Home Delivery')); ?></span>
                                                    </span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="w-100 py-2">
                                    <div class="form-group d-none" id="home_delivery_section">
                                        <div class="d-flex justify-content-between">
                                            <label for="" class="font-weight-semibold fz-16 text-dark"><?php echo e(translate('Delivery Information')); ?>

                                                <small>(<?php echo e(translate('Home Delivery')); ?>)</small>
                                            </label>
                                            <span class="edit-btn cursor-pointer" id="delivery_address" data-toggle="modal"
                                                  data-target="#AddressModal"><i class="tio-edit"></i>
                                        </span>
                                        </div>
                                        <div class="pos--delivery-options-info d-flex flex-wrap" id="del-add">
                                            <?php echo $__env->make('admin-views.pos._address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class='w-100' id="cart">
                                    <?php echo $__env->make('admin-views.pos._cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="quick-view" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content" id="quick-view-modal">

                </div>
            </div>
        </div>

    <?php ($order=\App\Model\Order::find(session('last_order'))); ?>
    <?php if($order): ?>
        <?php (session(['last_order'=> false])); ?>
        <div class="modal fade" id="print-invoice" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(translate('Print Invoice')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <input type="button" class="btn btn-primary non-printable print-button"
                                    value="<?php echo e(translate('Proceed, If thermal printer is ready.')); ?>"/>
                            <a href="<?php echo e(url()->previous()); ?>"
                                class="btn btn-danger non-printable"><?php echo e(translate('Back')); ?></a>
                        </div>
                        <hr class="non-printable">
                        <div id="printableArea">
                            <?php echo $__env->make('admin-views.pos.order.invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

        <?php echo $__env->make('admin-views.pos.add-customer-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="modal fade" id="AddressModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light border-bottom py-3">
                        <h5 class="modal-title flex-grow-1 text-center"><?php echo e(translate('Delivery Information')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php
                        if(session()->has('address')) {
                            $old = session()->get('address');
                        }else {
                            $old = null;
                        }
                        ?>
                        <form id='delivery_address_store'>
                            <?php echo csrf_field(); ?>

                            <div class="row g-2" id="delivery_address">
                                <div class="col-md-6">
                                    <label class="input-label" for=""><?php echo e(translate('contact_person_name')); ?>

                                        <span class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                           value="<?php echo e($old ? $old['contact_person_name'] : ''); ?>" placeholder="<?php echo e(translate('Ex :')); ?> <?php echo e(translate('Jhon')); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="input-label" for=""><?php echo e(translate('Contact Number')); ?>

                                        <span class="input-label-secondary text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="contact_person_number"
                                           value="<?php echo e($old ? $old['contact_person_number'] : ''); ?>"  placeholder="<?php echo e(translate('Ex :')); ?> +3264124565" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="input-label" for=""><?php echo e(translate('Road')); ?></label>
                                    <input type="text" class="form-control" name="road" value="<?php echo e($old ? $old['road'] : ''); ?>"  placeholder="<?php echo e(translate('Ex :')); ?> <?php echo e(translate('4th')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="input-label" for=""><?php echo e(translate('House')); ?></label>
                                    <input type="text" class="form-control" name="house" value="<?php echo e($old ? $old['house'] : ''); ?>" placeholder="<?php echo e(translate('Ex :')); ?> <?php echo e(translate('45/C')); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label class="input-label" for=""><?php echo e(translate('Floor')); ?></label>
                                    <input type="text" class="form-control" name="floor" value="<?php echo e($old ? $old['floor'] : ''); ?>"  placeholder="<?php echo e(translate('Ex :')); ?> <?php echo e(translate('1A')); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="input-label" for=""><?php echo e(translate('longitude')); ?><span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                           value="<?php echo e($old ? $old['longitude'] : ''); ?>" readonly required>
                                </div>
                                <div class="col-md-6">
                                    <label class="input-label" for=""><?php echo e(translate('latitude')); ?><span
                                            class="input-label-secondary text-danger">*</span></label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                           value="<?php echo e($old ? $old['latitude'] : ''); ?>" readonly required>
                                </div>
                                <div class="col-md-12">
                                    <label class="input-label"><?php echo e(translate('address')); ?></label>
                                    <textarea name="address" id="address" class="form-control" required><?php echo e($old ? $old['address'] : ''); ?></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-primary">
                                            <?php echo e(translate('* pin the address in the map to calculate delivery fee')); ?>

                                        </span>
                                    </div>
                                    <div id="location_map_div">
                                        <input id="pac-input" class="controls rounded initial-8"
                                               title="<?php echo e(translate('search_your_location_here')); ?>" type="text"
                                               placeholder="<?php echo e(translate('search_here')); ?>" />
                                        <div id="location_map_canvas" class="overflow-hidden rounded"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="btn--container justify-content-end">
                                    <button class="btn btn-sm btn--primary w-100 delivery-address-update-button" type="button" data-dismiss="modal">
                                        <?php echo e(translate('Update')); ?> <?php echo e(translate('Delivery address')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Model\BusinessSetting::where('key', 'map_api_client_key')->first()?->value); ?>&libraries=places&v=3.51"></script>
    <script>

        $('#category').on('change', function() {
            var selectedCategoryId = $(this).val();
            set_category_filter(selectedCategoryId);
        });

        $('#customer').on('change', function() {
            var selectedCustomerId = $(this).val();
            store_key('customer_id', selectedCustomerId);
        });

        $('#branch').on('change', function() {
            var selectedBranchId = $(this).val();
            store_key('branch_id', selectedBranchId);
        });

        $('.order-type-radio').on('change', function() {
            var orderType = $(this).val();
            select_order_type(orderType);
        });

        $('.delivery-address-update-button').on('click', function() {
            deliveryAddressStore();
        });

        $('.quick-view-trigger').on('click', function() {
            var productId = $(this).data('product-id');
            quickView(productId);
        });

        $(document).on('ready', function () {
            <?php if($order): ?>
            $('#print-invoice').modal('show');
            <?php endif; ?>
        });

        $('.print-button').on('click', function() {
            printDiv('printableArea');
        });

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

        function set_category_filter(id) {
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('category_id', id);
            location.href = nurl;
        }

        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            var keyword = $('#datatableSearch').val();
            var nurl = new URL('<?php echo url()->full(); ?>');
            nurl.searchParams.set('keyword', keyword);
            location.href = nurl;
        });

        function quickView(product_id) {
            $.ajax({
                url: '<?php echo e(route('admin.pos.quick-view')); ?>',
                type: 'GET',
                data: {
                    product_id: product_id
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        }

        function checkAddToCartValidity() {
            return true;
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function (e) {
            e.preventDefault();

            var fieldName = $(this).attr('data-field');
            var type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }

                    var qty_max_val = parseInt($('#check_max_qty').val());
                    var qty_max_val = qty_max_val + 1;
                    if (parseInt(input.val()) >= qty_max_val) {
                        Swal.fire({
                            icon: 'error',
                            title: '<?php echo e(translate("Cart")); ?>',
                            text: '<?php echo e(translate('stock limit exceeded')); ?>.',
                            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                        });
                        input.val(qty_max_val-1);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            var input_qty_max_val = parseInt($('#check_max_qty').val());
            var input_qty_max_val = input_qty_max_val + 1;


            var name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo e(translate("Cart")); ?>',
                    text: '<?php echo e(translate('Sorry, the minimum value was reached')); ?>',
                    confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                });
                $(this).val($(this).data('oldValue'));
            }

            if(valueCurrent >= input_qty_max_val){
                console.log(input_qty_max_val);
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo e(translate("Cart")); ?>',
                    text: '<?php echo e(translate('the maximum value was reached')); ?>',
                    confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                });
                $(this).val(input_qty_max_val-1)
            } else if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo e(translate("Cart")); ?>',
                    text: '<?php echo e(translate('Sorry, stock limit exceeded')); ?>.',
                    confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                });
                $(this).val(1)
            }
        });
        $(".input-number").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    function getVariantPrice() {
        if (1) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('admin.pos.variant_price')); ?>',
                data: $('#add-to-cart-form').serializeArray(),
                success: function (data) {
                    $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                    $('#add-to-cart-form #chosen_price_div #chosen_price').html(data.price);
                }
            });
        }
    }

    function addToCart(form_id = 'add-to-cart-form') {
        if (checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.pos.add-to-cart')); ?>',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.data == 1) {
                        Swal.fire({
                            icon: 'info',
                            title: "<?php echo e(translate('Cart')); ?>",
                            text: "<?php echo e(translate('Product already added in cart')); ?>",
                            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                        });
                        return false;
                    } else if (data.quantity <= 0) {
                        Swal.fire({
                            icon: 'info',
                            title: "<?php echo e(translate('Cart')); ?>",
                            text: "<?php echo e(translate('Product is out of stock')); ?>",
                            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                        });
                        return false;

                    }   else if (data.data == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: "<?php echo e(translate('Cart')); ?>",
                            text: '<?php echo e(translate('product out of stock')); ?>.',
                            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
                        });
                        return false;
                    }
                    $('.call-when-done').click();

                    toastr.success('<?php echo e(translate('Item has been added in your cart')); ?>!', {
                        CloseButton: true,
                        ProgressBar: true
                    });

                    updateCart();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        } else {
            Swal.fire({
                type: 'info',
                title: "<?php echo e(translate('Cart')); ?>",
                text: '<?php echo e(translate('Please choose all the options')); ?>',
                confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            });
        }
    }

    function removeFromCart(key) {
        $.post('<?php echo e(route('admin.pos.remove-from-cart')); ?>', {_token: '<?php echo e(csrf_token()); ?>', key: key}, function (data) {
            if (data.errors) {
                for (var i = 0; i < data.errors.length; i++) {
                    toastr.error(data.errors[i].message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            } else {
                updateCart();
                toastr.info('<?php echo e(translate('Item has been removed from cart')); ?>', {
                    CloseButton: true,
                    ProgressBar: true
                });
            }

        });
    }

    function emptyCart() {
        $.post('<?php echo e(route('admin.pos.emptyCart')); ?>', {_token: '<?php echo e(csrf_token()); ?>'}, function (data) {
            updateCart();
            location.reload();
            toastr.info('<?php echo e(translate('Item has been removed from cart')); ?>', {
                CloseButton: true,
                ProgressBar: true
            });
        });
    }

    function updateCart() {
        $.post('<?php echo e(route('admin.pos.cart_items')); ?>', {_token: '<?php echo e(csrf_token()); ?>'}, function (data) {
            $('#cart').empty().html(data);
        });
    }

    function store_key(key, value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            }
        });
        $.post({
            url: '<?php echo e(route('admin.pos.store-keys')); ?>',
            data: {
                key:key,
                value:value,
            },
            success: function (data) {
                key = key=='customer_id' ? "<?php echo e(translate('customer_id')); ?>" : (key=='branch_id' ? "<?php echo e(translate('branch_id')); ?>":'');
                toastr.success(key+' '+'<?php echo e(translate('selected')); ?>!', {
                    CloseButton: true,
                    ProgressBar: true
                });
            },
        });
    }

    $(function () {
        $(document).on('click', 'input[type=number]', function () {
            this.select();
        });
    });

    function updateQuantity(e) {
        var element = $(e.target);
        var minValue = parseInt(element.attr('min'));
        var maxValue = parseInt(element.attr('max'));
        var valueCurrent = parseInt(element.val());

        var key = element.data('key');
        var product_id = element.attr("id");
        if (valueCurrent >= minValue && valueCurrent <= maxValue) {
            $.post('<?php echo e(route('admin.pos.updateQuantity')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                key: key,
                quantity: valueCurrent
            }, function (data) {
                updateCart();
            });
        } else if(valueCurrent >= maxValue) {Swal.fire({
            icon: 'error',
            title: '<?php echo e(translate("Cart")); ?>',
            text: '<?php echo e(translate('Product out of stock!!!')); ?>',
            confirmButtonText: '<?php echo e(translate("Yes")); ?>',
        });
            element.val(element.data('oldValue'));
            updateCart();
        } else {
            Swal.fire({
                icon: 'error',
                title: "<?php echo e(translate('Cart')); ?>",
                text: '<?php echo e(translate('Sorry, the minimum value was reached')); ?>',
                confirmButtonText: '<?php echo e(translate("Yes")); ?>',
            });
            element.val(element.data('oldValue'));
            updateCart();
        }

        if (e.type == 'keydown') {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }

    }

    $('.js-select2-custom').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    $('.js-data-example-ajax').select2({
        ajax: {
            url: '<?php echo e(route('admin.pos.customers')); ?>',
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });

    $(document).ready(function() {
        var orderType = <?php echo json_encode(session('order_type')); ?>;

        if (orderType === 'home_delivery') {
            $('#home_delivery_section').removeClass('d-none');
        } else {
            $('#home_delivery_section').addClass('d-none');
        }
    });

    function select_order_type(order_type) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
            }
        });

        $.post({
            url: '<?php echo e(route('admin.pos.order_type.store')); ?>',
            data: {
                order_type:order_type,
            },
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log(data);
                updateCart();
            },
            complete: function () {
                $('#loading').hide();
            }
        });

       if(order_type == 'home_delivery') {
            $('#home_delivery_section').removeClass('d-none');
        }else{
            $('#home_delivery_section').addClass('d-none')
        }
    }

    $( document ).ready(function() {
        function initAutocomplete() {
            var myLatLng = {

                lat: 23.811842872190343,
                lng: 90.356331
            };
            const map = new google.maps.Map(document.getElementById("location_map_canvas"), {
                center: {
                    lat: 23.811842872190343,
                    lng: 90.356331
                },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
            });

            marker.setMap(map);
            var geocoder = geocoder = new google.maps.Geocoder();
            google.maps.event.addListener(map, 'click', function(mapsMouseEvent) {
                var coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
                var coordinates = JSON.parse(coordinates);
                var latlng = new google.maps.LatLng(coordinates['lat'], coordinates['lng']);
                marker.setPosition(latlng);
                map.panTo(latlng);

                document.getElementById('latitude').value = coordinates['lat'];
                document.getElementById('longitude').value = coordinates['lng'];

                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[1]) {
                            document.getElementById('address').value = results[1].formatted_address;
                        }
                    }
                });
            });
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var mrkr = new google.maps.Marker({
                        map,
                        title: place.name,
                        position: place.geometry.location,
                    });
                    google.maps.event.addListener(mrkr, "click", function(event) {
                        document.getElementById('latitude').value = this.position.lat();
                        document.getElementById('longitude').value = this.position.lng();

                    });

                    markers.push(mrkr);

                    if (place.geometry.viewport) {
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
        initAutocomplete();
    });

    function deliveryAddressStore(form_id = 'delivery_address_store') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('admin.pos.add-delivery-address')); ?>',
            data: $('#' + form_id).serializeArray(),
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    $('#del-add').empty().html(data.view);
                }
                updateCart();
                $('.call-when-done').click();
            },
            complete: function() {
                $('#loading').hide();
            }
        });
    }

    $('.js-data-example-ajax-2').select2()

    $('#order_place').submit(function (eventObj) {
        if ($('#customer').val()) {
            $(this).append('<input type="hidden" name="user_id" value="' + $('#customer').val() + '" /> ');
        }
        return true;
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/pos/index.blade.php ENDPATH**/ ?>