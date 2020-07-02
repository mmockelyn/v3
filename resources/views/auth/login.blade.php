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
    <base href="../../../">
    <meta charset="utf-8" />
    <title>{{ env("APP_NAME") }} | Connexion</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!--end::Fonts -->

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
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="kt-login__logo">
                                <a href="#">
                                    <img src="/storage/logos/logo.png" width="200">
                                </a>
                            </div>
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Connectez-vous</h3>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="{{ route('login') }}">
                                        @include("admin.layout.includes.alert")
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email"
                                                   autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password"
                                                   placeholder="Password" name="password">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> Se souvenir de moi
                                                <span></span>
                                            </label>
                                            <a href="javascript:" id="kt_login_forgot">Mot de passe, perdu ?</a>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signin_submit"
                                                    class="btn btn-brand btn-pill btn-elevate">Connexion
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="kt-login__signup">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Inscrivez-vous</h3>
                                    <div class="kt-login__desc">Entrez vos coordonnées pour créer votre compte:</div>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Fullname" name="name">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password" placeholder="Confirm Password" name="password_confirmation">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="agree"> J'accepte les <a href="#">termes et conditions</a> d'utilisation du site.
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signup_submit" class="btn btn-brand btn-pill btn-elevate">M'inscrire</button>
                                            <button id="kt_login_signup_cancel" class="btn btn-outline-brand btn-pill">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="kt-login__forgot">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Mot de passe, perdu ?</h3>
                                    <div class="kt-login__desc">Entrez votre e-mail pour réinitialiser votre mot de passe:</div>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Envoyer le lien de réinitialisation du mot de passe </button>
                                            <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Vous n'avez pas de compte ?
								</span>&nbsp;&nbsp;
                        <a href="javascript:" id="kt_login_signup" class="kt-login__account-link">M'inscrire!</a>
                    </div>
                </div>
            </div>
            @if(now()->hour >= 7 && now()->hour <= 18)
                <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url(/storage/other/back_login.jpg);">
            @else
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url(/storage/other/back_login_night.jpg);">
            @endif
                <div class="kt-login__section">
                    <div class="kt-login__block">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div id="xl_auth" style="width: 100%; height: 1000px"></div>
<!-- end:: Page -->

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

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/auth/login.js') }}"></script>
@if(config('app.env') == 'local')
    <script src="http://localhost:35729/livereload.js"></script>
@endif
    <script type="application/javascript">
        const s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://login-sdk.xsolla.com/latest/";
        const head = document.getElementsByTagName("head")[0];
        head.appendChild(s);
        let xl;

        s.addEventListener("load", function() {
            xl = new XsollaLogin.Widget({
                projectId: "62553964-bca3-11ea-a85b-42010aa80004",
                callbackUrl: "https://login.xsolla.com/api/blank",
                preferredLocale: "fr_XX"
            });

            xl.mount("xl_auth");

            xl.on(xl.events.Close, () => {
                xl.close();
            });
        });

        // function for opening a widget by button
        /*
          function openWidget() {
            xl.open();
          }
        */
    </script>

<!--end::Global Theme Bundle -->

<!--begin::Page Scripts(used by this page) -->

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
