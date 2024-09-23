<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">

                    <?php ($logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value); ?>
                    <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>" aria-label="Front">
                        <img class="w-100 side-logo"
                             src="<?php echo e(App\CentralLogics\Helpers::onErrorImage($logo, asset('storage/app/public/restaurant') . '/' . $logo, asset('public/assets/admin/img/160x160/img2.jpg'), 'restaurant/')); ?>"
                             alt="<?php echo e(translate('logo')); ?>">
                    </a>

                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <div class="navbar-nav-wrap-content-left d-none d-xl-block">
                        <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                            <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                               data-placement="right" title="Collapse"></i>
                            <i class="tio-last-page navbar-vertical-aside-toggle-full-align"></i>
                        </button>
                    </div>
                </div>

                <div class="navbar-vertical-content" id="navbar-vertical-content">
                    <form class="sidebar--search-form">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="form-control form--control"
                                   placeholder="<?php echo e(translate('Search Menu...')); ?>" id="search-sidebar-menu">
                        </div>
                    </form>
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                    <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['dashboard_management'])): ?>
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin')?'show active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.dashboard')); ?>" title="<?php echo e(translate('dashboard')); ?>">
                                    <i class="tio-home-vs-1-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(translate('dashboard')); ?>

                                </span>
                                </a>
                            </li>
                    <?php endif; ?>

                    <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['pos_management'])): ?>
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/pos*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('POS')); ?>">
                                    <i class="tio-shopping nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('POS')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/pos*')?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/pos')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.pos.index')); ?>"
                                           title="<?php echo e(translate('New Sale')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"><?php echo e(translate('New Sale')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/pos/orders')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.pos.orders')); ?>"
                                           title="<?php echo e(translate('orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate sidebar--badge-container">
                                                <span><?php echo e(translate('orders')); ?></span>
                                                <span class="badge badge-soft-info badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::Pos()->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['order_management'])): ?>
                            <li class="nav-item">
                                <small
                                    class="nav-subtitle"><?php echo e(translate('order_management')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/verify-offline-payment*') ?'show active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.verify-offline-payment', ['pending'])); ?>" title="<?php echo e(translate('Verify_Offline_Payment')); ?>">
                                    <i class="tio-shopping-basket nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(translate('Verify_Offline_Payment')); ?>

                                </span>
                                </a>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/orders*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('orders')); ?>">
                                    <i class="tio-shopping-cart nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('orders')); ?>

                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/order*')?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/all')?'active':''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.orders.list',['all'])); ?>"
                                           title="<?php echo e(translate('all_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate sidebar--badge-container">
                                                <span><?php echo e(translate('all')); ?></span>
                                                <span class="badge badge-info badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::notPos()->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    
                                     <li class="nav-item <?php echo e(Request::is('admin/orders/list/waitlist')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['waitlist'])); ?>" title="<?php echo e(translate('Waitlist_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate sidebar--badge-container">
                                                <span><?php echo e(translate('Waitlist Orders')); ?></span>
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['is_wholesale'=>1])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    
                                    
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/pending')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['pending'])); ?>"
                                           title="<?php echo e(translate('pending_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate sidebar--badge-container">
                                                <span><?php echo e(translate('pending')); ?></span>
                                                <span class="badge badge-soft-info badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'pending'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/confirmed')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['confirmed'])); ?>"
                                           title="<?php echo e(translate('confirmed_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate sidebar--badge-container">
                                                <span><?php echo e(translate('confirmed')); ?></span>
                                                    <span class="badge badge-soft-success badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'confirmed'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/processing')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['processing'])); ?>"
                                           title="<?php echo e(translate('processing_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('packaging')); ?></span>
                                                    <span class="badge badge-soft-warning badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'processing'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/out_for_delivery')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['out_for_delivery'])); ?>"
                                           title="<?php echo e(translate('out_for_delivery_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('out_for_delivery')); ?></span>
                                                    <span class="badge badge-soft-warning badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'out_for_delivery'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/delivered')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['delivered'])); ?>"
                                           title="<?php echo e(translate('delivered_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('delivered')); ?></span>
                                                    <span class="badge badge-soft-success badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::notPos()->where(['order_status'=>'delivered'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/returned')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['returned'])); ?>"
                                           title="<?php echo e(translate('returned_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('returned')); ?></span>
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'returned'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/failed')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['failed'])); ?>"
                                           title="<?php echo e(translate('failed_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('failed')); ?></span>
                                                <span class="badge badge-soft-danger badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'failed'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/orders/list/canceled')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.orders.list',['canceled'])); ?>"
                                           title="<?php echo e(translate('canceled_orders')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate  sidebar--badge-container">
                                                <span><?php echo e(translate('canceled')); ?></span>
                                                    <span class="badge badge-soft-light badge-pill ml-1">
                                                    <?php echo e(\App\Model\Order::where(['order_status'=>'canceled'])->count()); ?>

                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['product_management'])): ?>
                            <li class="nav-item">
                                <small
                                    class="nav-subtitle"><?php echo e(translate('product_management')); ?> </small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/category*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('category setup')); ?>"
                                >
                                    <i class="tio-category nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('category setup')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/category*')?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/category/add')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.category.add')); ?>"
                                           title="<?php echo e(translate('categories')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('categories')); ?></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/category/add-sub-category')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.category.add-sub-category')); ?>"
                                           title="<?php echo e(translate('sub_categories')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('sub_categories')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/product*') || Request::is('admin/attribute*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="<?php echo e(translate('product setup')); ?>"
                                >
                                    <i class="tio-premium-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('product setup')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/product*') || Request::is('admin/attribute*') ? 'block' : 'none'); ?>">

                                    <li class="nav-item <?php echo e(Request::is('admin/attribute*')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.attribute.add-new')); ?>"
                                           title="<?php echo e(translate('product attribute')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('product attribute')); ?></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/product/list*')?'active':''); ?> <?php echo e(Request::is('admin/product/add-new')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.product.list')); ?>"
                                           title="<?php echo e(translate('list')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('product list')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/product/bulk-import')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.product.bulk-import')); ?>"
                                           title="<?php echo e(translate('bulk_import')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('bulk_import')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/product/bulk-export-index')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.product.bulk-export-index')); ?>"
                                           title="<?php echo e(translate('bulk_export')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('bulk_export')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/product/limited-stock')?'active':''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.product.limited-stock')); ?>"
                                           title="<?php echo e(translate('Limited Stocks')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Limited Stocks')); ?></span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['promotion_management'])): ?>
                            <li class="nav-item">
                                <small
                                    class="nav-subtitle"><?php echo e(translate('promotion_management')); ?> </small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/banner*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.banner.add-new')); ?>"
                                   title="<?php echo e(translate('banner')); ?>"
                                >
                                    <i class="tio-image nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('banner')); ?></span>
                                </a>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/coupon*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.coupon.add-new')); ?>"
                                   title="<?php echo e(translate('coupons')); ?>"
                                >
                                    <i class="tio-gift nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('coupons')); ?></span>
                                </a>
                            </li>
<!--
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/notification*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.notification.add-new')); ?>"
                                   title="<?php echo e(translate('send notifications')); ?>"
                                >
                                    <i class="tio-notifications nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('send')); ?> <?php echo e(translate('notifications')); ?>

                                    </span>
                                </a>
                            </li>
-->
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/offer*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.offer.flash.index')); ?>"
                                   title="<?php echo e(translate('flash_sale')); ?>"
                                >
                                    <i class="tio-alarm-alert nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('flash_sale')); ?>

                                    </span>
                                </a>
                            </li>


                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/discount*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link" href="<?php echo e(route('admin.discount.add-new')); ?>"
                                   title="<?php echo e(translate('category_discount')); ?>">
                                    <i class="tio-layers-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('category_discount')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
<!--
                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['support_management'])): ?>
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Layouts"><?php echo e(translate('Help & Support Section')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/message*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.message.list')); ?>"
                                   title="<?php echo e(translate('messages')); ?>"
                                >
                                    <i class="tio-messages nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('messages')); ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
-->
<!--
                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['report_management'])): ?>
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Documentation"><?php echo e(translate('report_and_analytics')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/report/sale-report')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('admin.report.sale-report')); ?>"
                                   title="<?php echo e(translate('sale')); ?> <?php echo e(translate('report')); ?>">
                                    <span class="tio-chart-bar-1 nav-icon"></span>
                                    <span class="text-truncate"><?php echo e(translate('Sales Report')); ?></span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/report/order')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('admin.report.order')); ?>"
                                   title="<?php echo e(translate('order')); ?> <?php echo e(translate('report')); ?>">
                                    <span class="tio-chart-bar-2 nav-icon"></span>
                                    <span class="text-truncate"><?php echo e(translate('Order Report')); ?></span>
                                </a>
                            </li>
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/report/earning')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('admin.report.earning')); ?>"
                                   title="<?php echo e(translate('earning')); ?> <?php echo e(translate('report')); ?>"
                                >
                                    <span class="tio-chart-pie-1 nav-icon"></span>
                                    <span
                                        class="text-truncate"><?php echo e(translate('earning')); ?> <?php echo e(translate('report')); ?></span>
                                </a>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/report/expense')?'active':''); ?>">
                                <a class="nav-link " href="<?php echo e(route('admin.report.expense')); ?>"
                                   title="<?php echo e(translate('expense')); ?> <?php echo e(translate('report')); ?>"
                                >
                                    <span class="tio-chart-bar-4 nav-icon"></span>
                                    <span
                                        class="text-truncate"><?php echo e(translate('expense')); ?> <?php echo e(translate('report')); ?></span>
                                </a>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/analytics*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('Analytics')); ?>">
                                    <i class="tio-chart-donut-2 nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('Analytics')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/analytics*')?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/analytics/keyword-search')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.analytics.keyword-search', ['date_range'=>'today', 'date_range_2'=>'today'])); ?>"
                                           title="<?php echo e(translate('keyword-search')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Keyword Search')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/analytics/customer-search')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.analytics.customer-search', ['date_range'=>'today', 'date_range_2'=>'today'])); ?>"
                                           title="<?php echo e(translate('customer-search')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('customer search')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
-->

                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['user_management'])): ?>
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Documentation"><?php echo e(translate('user management')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/customer/list') || Request::is('admin/customer/view*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.customer.list')); ?>"
                                   title="<?php echo e(translate('customer')); ?> <?php echo e(translate('list')); ?>"
                                >
                                    <i class="tio-poi-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('customer')); ?> <?php echo e(translate('list')); ?>

                                    </span>
                                </a>
                            </li>
<!--
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/customer/wallet/*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('Customer Wallet')); ?>">
                                    <i class="tio-wallet-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            <?php echo e(translate('Customer Wallet')); ?>

                                        </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/customer/wallet*')?'block':'none'); ?>">

                                    <li class="nav-item <?php echo e(Request::is('admin/customer/wallet/add-fund')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.customer.wallet.add-fund')); ?>"
                                           title="<?php echo e(translate('add_fund')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('add_fund')); ?>

                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/customer/wallet/report')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.customer.wallet.report')); ?>"
                                           title="<?php echo e(translate('report')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('report')); ?>

                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/customer/wallet/bonus*')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.customer.wallet.bonus.index')); ?>"
                                           title="<?php echo e(translate('wallet_bonus_setup')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('wallet_bonus_setup')); ?>

                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
-->
<!--
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/customer/loyalty-point*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('Customer Loyalty Point')); ?>">
                                    <i class="tio-medal nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            <?php echo e(translate('Customer Loyalty Point')); ?>

                                        </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/customer/loyalty-point*')?'block':'none'); ?>">

                                    <li class="nav-item <?php echo e(Request::is('admin/customer/loyalty-point/report')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.customer.loyalty-point.report')); ?>"
                                           title="<?php echo e(translate('report')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('report')); ?>

                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
-->

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/reviews*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.reviews.list')); ?>"
                                   title="<?php echo e(translate('product')); ?> <?php echo e(translate('reviews')); ?>"
                                >
                                    <i class="tio-star nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('product')); ?> <?php echo e(translate('reviews')); ?>

                                    </span>
                                </a>
                            </li>
        <!--
                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/customer/subscribed-email*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.customer.subscribed_emails')); ?>"
                                   title="<?php echo e(translate('Subscribed Emails')); ?>">
                                    <i class="tio-email-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('Subscribed Emails')); ?>

                                    </span>
                                </a>
                            </li>
    -->

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/delivery-man/*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('deliveryman')); ?>">
                                    <i class="tio-user nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            <?php echo e(translate('deliveryman')); ?>

                                        </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/delivery-man*')?'block':'none'); ?>">

                                    <li class="nav-item <?php echo e(Request::is('admin/delivery-man/list')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.delivery-man.list')); ?>"
                                           title="<?php echo e(translate('list')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('Delivery Man List')); ?>

                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/delivery-man/add')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.delivery-man.add')); ?>"
                                           title="<?php echo e(translate('register')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('Add New Delivery Man')); ?>

                                            </span>
                                        </a>
                                    </li>


                                    

                                    <li class="nav-item <?php echo e(Request::is('admin/delivery-man/pending/list') || Request::is('admin/delivery-man/denied/list')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.delivery-man.pending')); ?>"
                                           title="<?php echo e(translate('joining request')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('New Joining Request')); ?>

                                            </span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/delivery-man/reviews/list')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.delivery-man.reviews.list')); ?>"
                                           title="<?php echo e(translate('reviews')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                <?php echo e(translate('Delivery Man Reviews')); ?>

                                            </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <?php if(auth('admin')->user()->admin_role_id == 1): ?>
                                <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/employee*')?'active':''); ?>  <?php echo e(Request::is('admin/custom-role*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:" title="<?php echo e(translate('employees')); ?>">
                                    <i class="tio-incognito nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                            <?php echo e(translate('employees')); ?>

                                        </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/employee*') || Request::is('admin/custom-role*') || Request::is('admin/employee/update/*') ?'block':'none'); ?>">

                                    <li class="nav-item <?php echo e(Request::is('admin/custom-role*')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.custom-role.create')); ?>"
                                           title="<?php echo e(translate('Employee Role Setup')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                                    <?php echo e(translate('Employee Role Setup')); ?></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/employee/list')?'active':''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('admin.employee.list')); ?>"
                                           title="<?php echo e(translate('List')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Employee List')); ?></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/employee/add-new')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.employee.add-new')); ?>"
                                           title="<?php echo e(translate('add_new')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Add New Employee')); ?></span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <?php endif; ?>
                        <?php endif; ?>
<!--
                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['system_management'])): ?>
                            <li class="nav-item">
                                <small class="nav-subtitle"
                                       title="Layouts"><?php echo e(translate('system setting')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/business-settings/store*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.business-settings.store.ecom-setup')); ?>"
                                   title="<?php echo e(translate('Business Setup')); ?>">
                                    <i class="tio-settings nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        <?php echo e(translate('Business Setup')); ?>

                                    </span>
                                </a>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/branch*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="<?php echo e(translate('Branch Setup')); ?>"
                                >
                                    <i class="tio-shop nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('Branch Setup')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/branch*')?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/branch/add-new')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.branch.add-new')); ?>"
                                           title="<?php echo e(translate('add New')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"><?php echo e(translate('Add New')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/branch/list')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.branch.list')); ?>"
                                           title="<?php echo e(translate('list')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"><?php echo e(translate('list')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/business-settings/web-app/payment-method*')
                                        || Request::is('admin/business-settings/web-app/third-party/fcm*')
                                       || Request::is('admin/business-settings/web-app/third-party*')
                                        || Request::is('admin/business-settings/web-app/mail-config*')
                                        || Request::is('admin/business-settings/web-app/sms-module*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="<?php echo e(translate('Branch Setup')); ?>"
                                >
                                    <i class="tio-website nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('3rd Party')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/business-settings/web-app/payment-method*')
                                        || Request::is('admin/business-settings/web-app/third-party/fcm*')
                                        || Request::is('admin/business-settings/web-app/third-party*')
                                        || Request::is('admin/business-settings/web-app/mail-config*')
                                        || Request::is('admin/business-settings/web-app/sms-module*') ?'block':'none'); ?>">
                                    <li class="nav-item <?php echo e(Request::is('admin/business-settings/web-app/payment-method')
                                        || Request::is('admin/business-settings/web-app/third-party/fcm*')
                                        || Request::is('admin/business-settings/web-app/third-party*')
                                        || Request::is('admin/business-settings/web-app/mail-config*')
                                        || Request::is('admin/business-settings/web-app/sms-module*') ?'active':''); ?>">

                                        <a class="nav-link " href="<?php echo e(route('admin.business-settings.web-app.payment-method')); ?>"
                                           title="<?php echo e(translate('3rd party configuration')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"><?php echo e(translate('3rd party configuration')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/business-settings/web-app/third-party/fcm*')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.business-settings.web-app.third-party.fcm-index')); ?>"
                                           title="<?php echo e(translate('Push Notification')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Push Notification')); ?></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo e(Request::is('admin/business-settings/web-app/third-party/offline*')?'active':''); ?>">
                                        <a class="nav-link " href="<?php echo e(route('admin.business-settings.web-app.third-party.offline-payment.list')); ?>"
                                           title="<?php echo e(translate('Offline Payment')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span class="text-truncate"><?php echo e(translate('Offline Payment')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/business-settings/page-setup/*')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                   href="javascript:"
                                   title="<?php echo e(translate('Pages & Media')); ?>"
                                >
                                    <i class="tio-pages-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('Pages & Media')); ?></span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: <?php echo e(Request::is('admin/business-settings/page-setup/*')?'block':''); ?> <?php echo e(Request::is('admin/business-settings/web-app/third-party/social-media')?'block':''); ?>">
                                    <li class="nav-item mt-0 <?php echo e(Request::is('admin/business-settings/page-setup/*')?'active':''); ?>">
                                        <a class="nav-link"
                                           href="<?php echo e(route('admin.business-settings.page-setup.about-us')); ?>"
                                           title="<?php echo e(translate('Page Setup')); ?>">
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('Page Setup')); ?></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo e(Request::is('admin/business-settings/web-app/third-party/social-media')?'active':''); ?>">
                                        <a class="nav-link "
                                           href="<?php echo e(route('admin.business-settings.web-app.third-party.social-media')); ?>"
                                           title="<?php echo e(translate('Social Media')); ?>"
                                        >
                                            <span class="tio-circle nav-indicator-icon"></span>
                                            <span
                                                class="text-truncate"><?php echo e(translate('Social Media')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
-->
<!--
                            <li class="nav-item mt-0
                                <?php echo e(Request::is('admin/business-settings/web-app/system-setup*')?'active':''); ?>">
                                <a class="nav-link"
                                   href="<?php echo e(route('admin.business-settings.web-app.system-setup.language.index')); ?>"
                                   title="<?php echo e(translate('system_settings')); ?>">
                                    <i class="tio-security-on-outlined nav-icon"></i>
                                    <span
                                        class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('system_setup')); ?></span>
                                </a>
                            </li>

                        <?php endif; ?>
-->
<!--
                        <?php if(Helpers::module_permission_check(MANAGEMENT_SECTION['addon_management'])): ?>

                            <li class="nav-item">
                                <small class="nav-subtitle"><?php echo e(translate('system')); ?> <?php echo e(translate('addon')); ?></small>
                                <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                            </li>

                            <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/system-addon')?'active':''); ?>">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                   href="<?php echo e(route('admin.system-addon.index')); ?>" title="<?php echo e(translate('System Addons')); ?>">
                                    <i class="tio-add-circle-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    <?php echo e(translate('System Addons')); ?>

                                </span>
                                </a>
                            </li>
-->
                            <?php if(count(config('addon_admin_routes'))>0): ?>
                                <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is('admin/payment/configuration/*') || Request::is('admin/sms/configuration/*')?'active':''); ?> mb-5">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" >
                                        <i class="tio-puzzle nav-icon"></i>
                                        <span  class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"><?php echo e(translate('Addon Menus')); ?></span>
                                    </a>
                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: <?php echo e(Request::is('admin/payment/configuration/*') || Request::is('admin/sms/configuration/*')?'block':'none'); ?>">
                                        <?php $__currentLoopData = config('addon_admin_routes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $routes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="navbar-vertical-aside-has-menu <?php echo e(Request::is($route['path'])  ? 'active' :''); ?>">
                                                    <a class="js-navbar-vertical-aside-menu-link nav-link "
                                                       href="<?php echo e($route['url']); ?>" title="<?php echo e(translate($route['name'])); ?>">
                                                        <span class="tio-circle nav-indicator-icon"></span>
                                                        <span class="text-truncate"><?php echo e(translate($route['name'])); ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                        <?php endif; ?>

                        <li class="nav-item">
                            <div class="nav-divider"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>


<?php $__env->startPush('script_2'); ?>
    <script>
        $(window).on('load', function () {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 10);
            }
        });

        var $rows = $('#navbar-vertical-content .navbar-nav > li');
        $('#search-sidebar-menu').keyup(function () {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/infinitt/namelok.co.tz/resources/views/layouts/admin/partials/_sidebar.blade.php ENDPATH**/ ?>