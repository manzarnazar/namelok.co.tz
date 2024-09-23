<?php $__env->startSection('title', translate('Add new product')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(asset('public/assets/admin/img/add-product.png')); ?>" class="w--24" alt="">
                </span>
                <span>
                    <?php echo e(translate('add New Product')); ?>

                </span>
            </h1>
        </div>

        <form action="javascript:" method="post" id="product_form"
                enctype="multipart/form-data" class="row g-2">
            <?php echo csrf_field(); ?>
            <?php ($data = Helpers::get_business_settings('language')); ?>
            <?php ($default_lang = Helpers::get_default_language()); ?>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body pt-2">
                        <?php if($data && array_key_exists('code', $data[0])): ?>

                            <ul class="nav nav-tabs mb-4">

                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link <?php echo e($lang['default'] == true ? 'active':''); ?>" href="#" id="<?php echo e($lang['code']); ?>-link"><?php echo e(Helpers::get_language_name($lang['code']).'('.strtoupper($lang['code']).')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="<?php echo e($lang['default'] == false ? 'd-none':''); ?> lang_form" id="<?php echo e($lang['code']); ?>-form">
                                    <div class="form-group">
                                        <label class="input-label" for="<?php echo e($lang['code']); ?>_name"><?php echo e(translate('name')); ?> (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                        <input type="text" name="name[]" id="<?php echo e($lang['code']); ?>_name" class="form-control"
                                            placeholder="<?php echo e(translate('New Product')); ?>" <?php echo e($lang['status'] == true ? 'required':''); ?>

                                            <?php if($lang['status'] == true): ?> oninvalid="document.getElementById('<?php echo e($lang['code']); ?>-link').click()" <?php endif; ?>>
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang['code']); ?>">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="<?php echo e($lang['code']); ?>_description"><?php echo e(translate('short')); ?> <?php echo e(translate('description')); ?>  (<?php echo e(strtoupper($lang['code'])); ?>)</label>
                                        <textarea name="description[]" class="form-control h--172px summernote" id="<?php echo e($lang['code']); ?>_hiddenArea"></textarea>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div id="<?php echo e($default_lang); ?>-form">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('name')); ?> (EN)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New Product')); ?>" required>
                                </div>
                                <input type="hidden" name="lang[]" value="en">
                                <div class="form-group mb-0">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('short')); ?> <?php echo e(translate('description')); ?> (EN)</label>
                                    <textarea name="description[]" class="form-control h--172px summernote" id="hiddenArea"></textarea>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-user"></i>
                            </span>
                            <span>
                                <?php echo e(translate('category')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlSelect1"><?php echo e(translate('category')); ?><span
                                            class="input-label-secondary">*</span></label>
                                    <select name="category_id" class="form-control js-select2-custom"
                                            onchange="getRequest('<?php echo e(url('/')); ?>/admin/product/get-categories?parent_id='+this.value,'sub-categories')">
                                        <option value="">---<?php echo e(translate('select')); ?>---</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlSelect1"><?php echo e(translate('sub_category')); ?><span
                                            class="input-label-secondary"></span></label>
                                    <select name="sub_category_id" id="sub-categories"
                                            class="form-control js-select2-custom"
                                            onchange="getRequest('<?php echo e(url('/')); ?>/admin/product/get-categories?parent_id='+this.value,'sub-sub-categories')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('unit')); ?></label>
                                    <select name="unit" class="form-control js-select2-custom">
                                        <option value="kg"><?php echo e(translate('kg')); ?></option>
                                        <option value="gm"><?php echo e(translate('gm')); ?></option>
                                        <option value="ltr"><?php echo e(translate('ltr')); ?></option>
                                        <option value="pc"><?php echo e(translate('pc')); ?></option>
                                        <option value="ml"><?php echo e(translate('ml')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('capacity')); ?></label>
                                    <input type="number" min="0" step="0.01" value="1" name="capacity"
                                        class="form-control"
                                        placeholder="<?php echo e(translate('Ex : 54ml')); ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label"
                                           for="exampleFormControlInput1"><?php echo e(translate('Maximum_Order_Quantity')); ?></label>
                                    <input type="number" min="1" step="1" value="1" name="maximum_order_quantity"
                                           class="form-control"
                                           placeholder="<?php echo e(translate('Ex : 3')); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="card min-h-116px">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <div class="d-flex flex-wrap-reverse justify-content-between">
                                <div class="w-200 flex-grow-1 mr-3">
                                    <?php echo e(translate('Turning Visibility off will not show this product in the user app and website')); ?>

                                </div>
                                <div class="d-flex align-items-center mb-2 mb-sm-0">
                                    <h5 class="mb-0 mr-2"><?php echo e(translate('Visibility')); ?></h5>
                                    <label class="toggle-switch my-0">
                                        <input type="checkbox" class="toggle-switch-input" name="status" value="1" checked>
                                        <span class="toggle-switch-label mx-auto text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="mb-3"><?php echo e(translate('product')); ?> <?php echo e(translate('image')); ?> <small
                        class="text-danger">* ( <?php echo e(translate('ratio')); ?> 1:1 )</small></h5>
                        <div class="product--coba">
                            <div class="row g-2" id="coba"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-label"></i>
                            </span>
                            <span>
                                <?php echo e(translate('tags')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tags" placeholder="Enter tags" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-dollar"></i>
                            </span>
                            <span>
                                <?php echo e(translate('price_information')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('default_unit_price')); ?></label>
                                        <input type="number" min="0" max="100000000" step="any" value="1" name="price"
                                            class="form-control"
                                            placeholder="<?php echo e(translate('Ex : 349')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('product_stock')); ?></label>
                                        <input type="number" min="0" max="100000000" value="0" name="total_stock" class="form-control"
                                            placeholder="<?php echo e(translate('Ex : 100')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('discount_type')); ?></label>
                                        <select name="discount_type" id="discount_type" class="form-control js-select2-custom">
                                            <option value="percent"><?php echo e(translate('percent')); ?></option>
                                            <option value="amount"><?php echo e(translate('amount')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('discount')); ?> <span id="discount_symbol">(%)</span></label>
                                        <input type="number" min="0" max="100000" value="0" name="discount" step="any" id="discount" class="form-control"
                                               placeholder="<?php echo e(translate('Ex : 5%')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                               for="exampleFormControlInput1"><?php echo e(translate('tax_type')); ?></label>
                                        <select name="tax_type" id="tax_type" class="form-control js-select2-custom">
                                            <option value="percent"><?php echo e(translate('percent')); ?></option>
                                            <option value="amount"><?php echo e(translate('amount')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                               for="exampleFormControlInput1"><?php echo e(translate('tax_rate')); ?> <span id="tax_symbol">(%)</span></label>
                                        <input type="number" min="0" value="0" step="0.01" max="100000" name="tax"
                                               class="form-control"
                                               placeholder="<?php echo e(translate('Ex : $ 100')); ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-puzzle"></i>
                            </span>
                            <span>
                                <?php echo e(translate('attribute')); ?>

                            </span>
                        </h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group __select-attr">
                            <label class="input-label"
                                    for="exampleFormControlSelect1"><?php echo e(translate('Select attribute')); ?><span
                                    class="input-label-secondary"></span></label>
                            <select name="attribute_id[]" id="choice_attributes"
                                    class="form-control js-select2-custom"
                                    multiple="multiple">
                                <?php $__currentLoopData = \App\Model\Attribute::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($attribute['id']); ?>"><?php echo e($attribute['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="customer_choice_options" id="customer_choice_options"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="variant_combination" id="variant_combination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-puzzle"></i>
                            </span>
                            <span>Whole Sale</span>
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="d-flex flex-wrap-reverse justify-content-between">
                            <div class="w-200 flex-grow-1 mr-3">
                                <?php echo e(translate('Turning Wholesale will create offer on product wholesale')); ?>

                            </div>
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <h5 class="mb-0 mr-2"><?php echo e(translate('Wholesale')); ?></h5>
                                <label class="toggle-switch my-0">
                                    <input type="checkbox" class="toggle-switch-input" name="is_wholesale" id="wholesale-toggle" value="1">
                                    <span class="toggle-switch-label mx-auto text">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-lg-6" id="wholesale-fields" style="display: none;">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Wholesale Options</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="min-quantity"><?php echo e(translate('Minimum Quantity')); ?></label>
                            <input type="number" class="form-control" id="min-quantity" name="minimum_wholesale_qty" placeholder="Enter minimum quantity">
                        </div>
                        <div class="form-group">
                            <label for="max-quantity"><?php echo e(translate('Maximum Quantity')); ?></label>
                            <input type="number" class="form-control" id="max-quantity" name="maximum_wholesale_qty" placeholder="Enter maximum quantity">
                        </div>
                        
                        <div class="form-group">
                            <label for="expiry_date">Wholesale Expiry Date:</label>
                            <input type="date" name="wholesale_expiry_date" id="expiry_date" class="form-control" value="<?php echo e(old('expiry_date')); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="waitlist_note"><?php echo e(translate('Waitlist Note')); ?></label>
                            <textarea name="waitlist_note" id="waitlist_note" class="form-control" placeholder="Enter any additional note for the waitlist"></textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="btn--container justify-content-end">
                    <a href="" class="btn btn--reset min-w-120px"><?php echo e(translate('reset')); ?></a>
                    <button type="submit" class="btn btn--primary"><?php echo e(translate('submit')); ?></button>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(asset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
    </script>

    <script>
        $(".lang_link").click(function(e){
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#"+lang+"-form").removeClass('d-none');
            if(lang == '<?php echo e($default_lang); ?>')
            {
                $("#from_part_2").removeClass('d-none');
            }
            else
            {
                $("#from_part_2").addClass('d-none');
            }


        })
    </script>

    <script>


        $('#product_form').on('submit', function () {


            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.product.store')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('<?php echo e(translate("product uploaded successfully!")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.product.list')); ?>';
                        }, 2000);
                    }
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 4,
                rowHeight: '150px',
                groupClassName: '',
                maxFileSize: '',
                placeholderImage: {
                    image: '<?php echo e(asset('public/assets/admin/img/upload-en.png')); ?>',
                    width: '100%'
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('<?php echo e(translate("Please only input png or jpg type file")); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('<?php echo e(translate("File size too big")); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>

    <script>
        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
    </script>

    <script>
        $(document).on('ready', function () {
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>

    <script src="<?php echo e(asset('public/assets/admin')); ?>/js/tags-input.min.js"></script>

    <script>
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row g-1"><div class="col-md-3 col-sm-4"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="Choice Title" readonly></div><div class="col-lg-9 col-sm-8"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="combination_update()"></div></div>');
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        function combination_update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '<?php echo e(route('admin.product.variant-combination')); ?>',
                data: $('#product_form').serialize(),
                success: function (data) {
                    $('#variant_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $('#product_form').on('submit', function () {

            var myEditor = document.querySelector('#editor')
            $("#hiddenArea").val(myEditor.children[0].innerHTML);

            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.product.store')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('<?php echo e(translate("product uploaded successfully!")); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function () {
                            location.href = '<?php echo e(route('admin.product.list')); ?>';
                        }, 2000);
                    }
                }
            });
        });
    </script>

    <script>

        document.getElementById('wholesale-toggle').addEventListener('change', function() {
            var wholesaleFields = document.getElementById('wholesale-fields');
            // document.getElementById('wholesale_expiry_group').style.display = this.checked ? 'block' : 'none';
            if (this.checked) {
                wholesaleFields.style.display = 'block';
            } else {
                wholesaleFields.style.display = 'none';
            }
        });

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="stock_"]');
            for(var i=0; i<qty_elements.length; i++)
            {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if(qty_elements.length > 0)
            {
                $('input[name="total_stock"]').attr("readonly", true);
                $('input[name="total_stock"]').val(total_qty);
                console.log(total_qty)
            }
            else{
                $('input[name="total_stock"]').attr("readonly", false);
            }
        }
    </script>

    <script>

        $('#discount_type').change(function(){
            if($('#discount_type').val() == 'percent') {
                $("#discount_symbol").html('(%)')
            } else {
                $("#discount_symbol").html('')
            }
        });

        $('#tax_type').change(function(){
            if($('#tax_type').val() == 'percent') {
                $("#tax_symbol").html('(%)')
            } else {
                $("#tax_symbol").html('')
            }
        });
    </script>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/infinitt/namelok.co.tz/resources/views/admin-views/product/index.blade.php ENDPATH**/ ?>