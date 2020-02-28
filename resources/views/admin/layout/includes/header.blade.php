<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="off">
    <div class="kt-header__top">
        <div class="kt-container ">

            <!-- begin:: Brand -->
            <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                <div class="kt-header__brand-logo">
                    <a href="{{ route('Back.dashboard') }}">
                        <img alt="Logo" src="/storage/logos/logo-long.png" width="150"/>
                    </a>
                </div>
            </div>

            <!-- end:: Brand -->

            <!-- begin:: Header Topbar -->
            <div class="kt-header__topbar">

                <!--begin: Search -->
                <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown kt-hidden-desktop" id="kt_quick_search_toggle">
                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
											<span class="kt-header__topbar-icon kt-header__topbar-icon--success">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
											</span>
                    </div>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                        <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
                            <form method="get" class="kt-quick-search__form">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                                    <input type="text" class="form-control kt-quick-search__input" placeholder="Recherche..">
                                    <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
                                </div>
                            </form>
                            <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Search -->

                    <!--begin: Notifications -->
                        <div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
											<span class="kt-header__topbar-icon kt-header__topbar-icon--success">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
														<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
													</g>
												</svg>

                                                <!--<i class="flaticon2-bell-alarm-symbol"></i>-->
											</span>
                                @if(count(auth()->user()->unreadNotifications) != 0)
                                <span id="countNotifBar" class="kt-hidden- kt-badge kt-badge--danger">{{ count(auth()->user()->unreadNotifications) }}</span>
                                @else
                                    <span id="countNotifBar" class="kt-hidden kt-badge kt-badge--danger">{{ count(auth()->user()->unreadNotifications) }}</span>
                                @endif
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <form>

                                    <!--begin: Head -->
                                    <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                                        <h3 class="kt-head__title">
                                            Vos notifications
                                            &nbsp;
                                            <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">{{ count(auth()->user()->unreadNotifications) }} {{ \App\HelpersClass\Generator::formatPlural('Nouvelle', count(auth()->user()->unreadNotifications)) }} {{ \App\HelpersClass\Generator::formatPlural('Notification', count(auth()->user()->unreadNotifications)) }}</span>
                                        </h3>
                                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="tab" href="#topbar_notifications_notifications" role="tab" aria-selected="true">Alerts</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_events" role="tab" aria-selected="false">Evenements</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#topbar_notifications_logs" role="tab" aria-selected="false">Logs</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!--end: Head -->
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                                @foreach(auth()->user()->notifications as $notification)
                                                    @if($notification->data['type'] == 'alert')
                                                        <a data-href="@if(!empty($notification->data['link'])) {{ $notification->data['link'] }} @endif" class="kt-notification__item @if($notification->read_at != null) kt-notification__item--read @endif" data-id="{{ $notification->id }}">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="{{ $notification->data['icon'] }} kt-font-{{ $notification->data['icon_color'] }}"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    {{ $notification->data['title'] }}
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{ $notification->updated_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                                @foreach(auth()->user()->notifications as $notification)
                                                    @if($notification->data['type'] == 'event')
                                                        <a href="#" class="kt-notification__item @if($notification->read_at != null) kt-notification__item--read @endif" data-id="{{ $notification->id }}">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="{{ $notification->data['icon'] }} kt-font-{{ $notification->data['icon_color'] }}"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    {{ $notification->data['title'] }}
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{ $notification->updated_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                                                @foreach(auth()->user()->notifications as $notification)
                                                    @if($notification->data['type'] == 'log')
                                                        <a href="#" class="kt-notification__item @if($notification->read_at != null) kt-notification__item--read @endif" data-id="{{ $notification->id }}">
                                                            <div class="kt-notification__item-icon">
                                                                <i class="{{ $notification->data['icon'] }} kt-font-{{ $notification->data['icon_color'] }}"></i>
                                                            </div>
                                                            <div class="kt-notification__item-details">
                                                                <div class="kt-notification__item-title">
                                                                    {{ $notification->data['title'] }}
                                                                </div>
                                                                <div class="kt-notification__item-time">
                                                                    {{ $notification->updated_at->diffForHumans() }}
                                                                </div>
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!--end: Notifications -->


                        <!--begin: Cart -->
                        <!--<div class="kt-header__topbar-item dropdown">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
                                                    <span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                <path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
                                                            </g>
                                                        </svg>
                                                    </span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                <form>
                                    <div class="kt-mycart">
                                        <div class="kt-mycart__head kt-head" style="background-image: url(assets/media/misc/bg-1.jpg);">
                                            <div class="kt-mycart__info">
                                                <span class="kt-mycart__icon"><i class="flaticon2-shopping-cart-1 kt-font-success"></i></span>
                                                <h3 class="kt-mycart__title">My Cart</h3>
                                            </div>
                                            <div class="kt-mycart__button">
                                                <button type="button" class="btn btn-success btn-sm" style=" ">2 Items</button>
                                            </div>
                                        </div>
                                        <div class="kt-mycart__body kt-scroll" data-scroll="true" data-height="245" data-mobile-height="200">
                                            <div class="kt-mycart__item">
                                                <div class="kt-mycart__container">
                                                    <div class="kt-mycart__info">
                                                        <a href="#" class="kt-mycart__title">
                                                            Samsung
                                                        </a>
                                                        <span class="kt-mycart__desc">
                                                                                Profile info, Timeline etc
                                                                            </span>
                                                        <div class="kt-mycart__action">
                                                            <span class="kt-mycart__price">$ 450</span>
                                                            <span class="kt-mycart__text">for</span>
                                                            <span class="kt-mycart__quantity">7</span>
                                                            <a href="#" class="btn btn-label-success btn-icon">&minus;</a>
                                                            <a href="#" class="btn btn-label-success btn-icon">&plus;</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="kt-mycart__pic">
                                                        <img src="assets/media/products/product9.jpg" title="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="kt-mycart__item">
                                                <div class="kt-mycart__container">
                                                    <div class="kt-mycart__info">
                                                        <a href="#" class="kt-mycart__title">
                                                            Panasonic
                                                        </a>
                                                        <span class="kt-mycart__desc">
                                                                                For PHoto & Others
                                                                            </span>
                                                        <div class="kt-mycart__action">
                                                            <span class="kt-mycart__price">$ 329</span>
                                                            <span class="kt-mycart__text">for</span>
                                                            <span class="kt-mycart__quantity">1</span>
                                                            <a href="#" class="btn btn-label-success btn-icon">&minus;</a>
                                                            <a href="#" class="btn btn-label-success btn-icon">&plus;</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="kt-mycart__pic">
                                                        <img src="assets/media/products/product13.jpg" title="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="kt-mycart__item">
                                                <div class="kt-mycart__container">
                                                    <div class="kt-mycart__info">
                                                        <a href="#" class="kt-mycart__title">
                                                            Fujifilm
                                                        </a>
                                                        <span class="kt-mycart__desc">
                                                                                Profile info, Timeline etc
                                                                            </span>
                                                        <div class="kt-mycart__action">
                                                            <span class="kt-mycart__price">$ 520</span>
                                                            <span class="kt-mycart__text">for</span>
                                                            <span class="kt-mycart__quantity">6</span>
                                                            <a href="#" class="btn btn-label-success btn-icon">&minus;</a>
                                                            <a href="#" class="btn btn-label-success btn-icon">&plus;</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="kt-mycart__pic">
                                                        <img src="assets/media/products/product16.jpg" title="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="kt-mycart__item">
                                                <div class="kt-mycart__container">
                                                    <div class="kt-mycart__info">
                                                        <a href="#" class="kt-mycart__title">
                                                            Candy Machine
                                                        </a>
                                                        <span class="kt-mycart__desc">
                                                                                For PHoto & Others
                                                                            </span>
                                                        <div class="kt-mycart__action">
                                                            <span class="kt-mycart__price">$ 784</span>
                                                            <span class="kt-mycart__text">for</span>
                                                            <span class="kt-mycart__quantity">4</span>
                                                            <a href="#" class="btn btn-label-success btn-icon">&minus;</a>
                                                            <a href="#" class="btn btn-label-success btn-icon">&plus;</a>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="kt-mycart__pic">
                                                        <img src="assets/media/products/product15.jpg" title="" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-mycart__footer">
                                            <div class="kt-mycart__section">
                                                <div class="kt-mycart__subtitel">
                                                    <span>Sub Total</span>
                                                    <span>Taxes</span>
                                                    <span>Total</span>
                                                </div>
                                                <div class="kt-mycart__prices">
                                                    <span>$ 840.00</span>
                                                    <span>$ 72.00</span>
                                                    <span class="kt-font-brand">$ 912.00</span>
                                                </div>
                                            </div>
                                            <div class="kt-mycart__button kt-align-right">
                                                <button type="button" class="btn btn-primary btn-sm">Place Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>-->

                        <!--end: Cart-->

                        <!--begin: User bar -->
                        <div class="kt-header__topbar-item kt-header__topbar-item--user">
                            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,10px">
                                <span class="kt-hidden kt-header__topbar-welcome">Bonjour,</span>
                                <span class="kt-hidden kt-header__topbar-username">{{ auth()->user()->name }}</span>
                                @if(\Thomaswelton\LaravelGravatar\Facades\Gravatar::exists(auth()->user()->email))
                                <img class="kt-hidden-" alt="Pic" src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src(auth()->user()->email) }}" />
                                @else
                                <span class="kt-header__topbar-icon kt-header__topbar-icon--brand kt-hidden-"><b>{{ \App\HelpersClass\Generator::firsLetter(auth()->user()->name,2) }}</b></span>
                                @endif
                            </div>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

                                <!--begin: Head -->
                                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                                    <div class="kt-user-card__avatar">
                                        @if(\Thomaswelton\LaravelGravatar\Facades\Gravatar::exists(auth()->user()->email))
                                        <img class="kt-hidden-" alt="Pic" src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src(auth()->user()->email) }}" />
                                        @else
                                        <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                        <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden-">{{ \App\HelpersClass\Generator::firsLetter(auth()->user()->name,2) }}</span>
                                        @endif
                                    </div>
                                    <div class="kt-user-card__name">
                                        {{ auth()->user()->name }}
                                    </div>
                                    <div class="kt-user-card__badge">
                                        <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">{{ count(auth()->user()->unreadNotifications) }} {{ \App\HelpersClass\Generator::formatPlural('Nouvelle', count(auth()->user()->unreadNotifications)) }} {{ \App\HelpersClass\Generator::formatPlural('Notification', count(auth()->user()->unreadNotifications)) }}</span>
                                    </div>
                                </div>

                                <!--end: Head -->

                                <!--begin: Navigation -->
                                <div class="kt-notification">
                                    <a href="{{ route('Account.index') }}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Mon compte
                                            </div>
                                        </div>
                                    </a>
                                    <div class="kt-notification__custom kt-space-between">
                                        <a href="{{ route('logout') }}" class="btn btn-label btn-label-brand btn-sm btn-bold">Deconnexion</a>
                                        <a href="custom/user/login-v2.html" target="_blank" class="btn btn-clean btn-sm btn-bold">Premium</a>
                                    </div>
                                </div>

                                <!--end: Navigation -->
                            </div>
                        </div>

                        <!--end: User bar -->
            </div>

            <!-- end:: Header Topbar -->
        </div>
    </div>
    <div class="kt-header__bottom">
        <div class="kt-container ">

            <!-- begin: Header Menu -->
            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
            <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                    <ul class="kt-menu__nav ">
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.dashboard')) }} kt-menu__item--rel ">
                            <a href="{{ route('Back.dashboard') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-mobile-phone"  style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Acceuil</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Blog.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Blog.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-newspaper-o" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Blog</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Route.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Route.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-road" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Route</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Objet.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Objet.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-cubes" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Objets</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Tutoriel.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Tutoriel.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-youtube-play" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Tutoriels</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Wiki.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Wiki.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-wikipedia-w" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Wiki</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.User.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.User.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-wikipedia-w" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Utilisateurs</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                        <li class="kt-menu__item {{ \App\HelpersClass\Generator::currentRoute(route('Back.Slideshow.index')) }} kt-menu__item--rel">
                            <a href="{{ route('Back.Slideshow.index') }}" class="kt-menu__link">
                                <span class="kt-menu__link-icon la la-wikipedia-w" style="color: #646c9a"></span>
                                <span class="kt-menu__link-text">Slideshow</span>
                                <i class="kt-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="kt-header-toolbar">
                    <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
                        <form method="get" class="kt-quick-search__form">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                                <input type="text" class="form-control kt-quick-search__input" placeholder="Recherche...">
                                <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close" style="display: none;"></i></span></div>
                            </div>
                        </form>
                        <div id="kt_quick_search_toggle" data-toggle="dropdown" data-offset="0px,10px"></div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                            <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="300" data-mobile-height="200">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="btnRefreshCache">Rafraichir le cache</button>
                </div>
            </div>

            <!-- end: Header Menu -->
        </div>
    </div>
</div>
