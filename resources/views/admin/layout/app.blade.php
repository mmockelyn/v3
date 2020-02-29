<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->
<head>
    <base href="../../">
    <meta charset="utf-8" />
    <title>Administration | {{ env("APP_NAME") }}</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!--end::Fonts -->
    @yield("style")
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="/storage/logos/favicon.ico" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-page--loading-enabled kt-page--loading kt-header--fixed kt-header--minimize-topbar kt-header-mobile--fixed kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-subheader--enabled kt-subheader--transparent kt-page--loading">

<!-- begin::Page loader -->

<!-- end::Page Loader -->

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
@include("admin.layout.includes.header_mobile")

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">

            <!-- begin:: Header -->
            @include("admin.layout.includes.header")

            <!-- end:: Header -->
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                    <!-- begin:: Subheader -->
                    @yield("subheader")
                    <!-- end:: Subheader -->

                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                        @yield("content")
                    </div>

                    <!-- end:: Content -->
                </div>
            </div>

            <!-- begin:: Footer -->
            @include("admin.layout.includes.footer")

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Quick Panel -->

<!-- end::Quick Panel -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->

<!-- begin::Sticky Toolbar -->
<ul class="kt-sticky-toolbar" style="margin-top: 30px;">
    <li class="kt-sticky-toolbar__item kt-sticky-toolbar__item--danger" id="kt_sticky_toolbar_chat_toggler" data-toggle="kt-tooltip" title="Chat Example" data-placement="left">
        <a href="#" data-toggle="modal" data-target="#kt_chat_modal"><i class="flaticon2-chat-1"></i></a>
    </li>
</ul>

<!-- end::Sticky Toolbar -->

<!-- begin::Demo Panel -->

<!-- end::Demo Panel -->

<!--Begin:: Chat-->
<div class="modal fade- modal-sticky-bottom-right" id="kt_chat_modal" role="dialog" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="kt-chat">
                <div class="kt-portlet kt-portlet--last">
                    <div class="kt-portlet__head">
                        <div class="kt-chat__head ">
                            <div class="kt-chat__left">
                                <div class="kt-chat__label">
                                    <a href="#" class="kt-chat__title">Jason Muller</a>
                                    <span class="kt-chat__status">
												<span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
											</span>
                                </div>
                            </div>
                            <div class="kt-chat__right">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="flaticon-more-1"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-md">

                                        <!--begin::Nav-->
                                        <ul class="kt-nav">
                                            <li class="kt-nav__head">
                                                Messaging
                                                <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-group"></i>
                                                    <span class="kt-nav__link-text">New Group</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-open-text-book"></i>
                                                    <span class="kt-nav__link-text">Contacts</span>
                                                    <span class="kt-nav__link-badge">
																<span class="kt-badge kt-badge--brand  kt-badge--rounded-">5</span>
															</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-bell-2"></i>
                                                    <span class="kt-nav__link-text">Calls</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-dashboard"></i>
                                                    <span class="kt-nav__link-text">Settings</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon flaticon2-protected"></i>
                                                    <span class="kt-nav__link-text">Help</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__foot">
                                                <a class="btn btn-label-brand btn-bold btn-sm" href="#">Upgrade plan</a>
                                                <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                                            </li>
                                        </ul>

                                        <!--end::Nav-->
                                    </div>
                                </div>
                                <button type="button" class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
                                    <i class="flaticon2-cross"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-scroll kt-scroll--pull" data-height="410" data-mobile-height="225">
                            <div class="kt-chat__messages kt-chat__messages--solid">
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">2 Hours</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        How likely are you to recommend our company<br> to your friends and family?
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Hey there, we’re just writing to let you know that you’ve<br> been subscribed to a repository on GitHub.
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Ok, Understood!
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">Just Now</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You’ll receive notifications for all issues, pull requests!
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">2 Hours</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You were automatically <b class="kt-font-brand">subscribed</b> <br>because you’ve been given access to the repository
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        You can unwatch this repository immediately <br>by clicking here: <a href="#" class="kt-font-bold kt-link"></a>
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--success">
                                    <div class="kt-chat__user">
												<span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/100_12.jpg" alt="image">
												</span>
                                        <a href="#" class="kt-chat__username">Jason Muller</span></a>
                                        <span class="kt-chat__datetime">30 Seconds</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Discover what students who viewed Learn <br>Figma - UI/UX Design Essential Training also viewed
                                    </div>
                                </div>
                                <div class="kt-chat__message kt-chat__message--right kt-chat__message--brand">
                                    <div class="kt-chat__user">
                                        <span class="kt-chat__datetime">Just Now</span>
                                        <a href="#" class="kt-chat__username">You</span></a>
                                        <span class="kt-media kt-media--circle kt-media--sm">
													<img src="assets/media/users/300_21.jpg" alt="image">
												</span>
                                    </div>
                                    <div class="kt-chat__text">
                                        Most purchased Business courses during this sale!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-chat__input">
                            <div class="kt-chat__editor">
                                <textarea placeholder="Type here..." style="height: 50px"></textarea>
                            </div>
                            <div class="kt-chat__toolbar">
                                <div class="kt_chat__tools">
                                    <a href="#"><i class="flaticon2-link"></i></a>
                                    <a href="#"><i class="flaticon2-photograph"></i></a>
                                    <a href="#"><i class="flaticon2-photo-camera"></i></a>
                                </div>
                                <div class="kt_chat__actions">
                                    <button type="button" class="btn btn-brand btn-md  btn-font-sm btn-upper btn-bold kt-chat__reply">reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--ENd:: Chat-->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#3d94fb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#3d94fb",
                "warning": "#ffb822",
                "danger": "#fd27eb"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->
<script src="https://code.iconify.design/1/1.0.4/iconify.min.js"></script>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif
@yield("script")

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
