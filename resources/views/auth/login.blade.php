@extends('layouts.app')

@section('title')
    Authorization
@endsection

@section('content')

    <style>
        p {
            padding: 0;
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        .login-main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color: rgba(250, 250, 250, .7);
            height: 100vh;
        }

        .login-logo-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: transparent;
            width: 50%;
            height: 100vh;
        }

        .login-title-block {
            margin: 54px 0 0;
        }

        .login-title {
            width: 360px;
            height: 117px;
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 32px;
            text-align: center;
            color: #000000;
        }

        .login-form {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

            background-color: #000000;
            color: #ffff;
            width: 50%;
            height: 100vh;
        }

        .login-main-title {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 28px;
            text-align: center;
            color: #FFFFFF;
            padding: 0;
            margin: 0;
        }

        input {
            border: none;
            appearance: none;
            outline: none;
            padding: 0;
            margin: 0;
            text-decoration: none;
        }

        .log-form-email {
            margin: 20px 0 20px;
        }

        .log-f-email {
            height: 56px;
            width: 324px;
            padding: 19px;
            background: #FFFFFF;
            backdrop-filter: blur(10px);
            border-radius: 10px;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .log-f-email::placeholder {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: left;
            letter-spacing: 0.11em;
            text-transform: uppercase;

            color: #000000;
        }

        .log-f-pass {
            height: 56px;
            width: 324px;
            padding: 19px;
            background: #FFFFFF;
            backdrop-filter: blur(10px);
            border-radius: 10px;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .log-f-pass::placeholder {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: left;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            color: #000000;
        }

        .log-form-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 30px 0 37px;
            width: 324px;
        }

        .log-f-forget-text {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            text-decoration-line: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.63);
            cursor: pointer;
            color: #FFFFFF;
        }

        .log-f-enter-btn {
            height: 56px;
            width: 195px;
            background: #F1C82D;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: background .3s;
        }

        .log-f-enter-btn:hover {
            background: #ffde5f;
        }

        .log-f-enter-text {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            color: #000000;
        }

        .log-text-decorate {
            width: 324px;
            height: 21.5px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #000000;
        }

        .log-text-dec {
            width: 91px;
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            text-align: center;
            color: #FFFFFF;
            background-color: #000000;
            mix-blend-mode: normal;
            position: absolute;
            margin-top: 0;
        }

        .log-text-decorate:before {
            content: '';
            display: block;
            width: 100%;
            height: 1px;
            background-color: rgba(255, 255, 255, 0.63);
            position: relative;
        }

        .log-form-google {
            margin: 20px 0 20px;
        }

        .log-f-google {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 56px;
            width: 324px;
            background: #FFFFFF;
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }

        .log-f-g-text {
            position: relative;
            top: 2px;
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            color: #000000;
            padding: 0;
        }

        .log-form-facebook {
            margin: 20px 0 20px;
        }

        .log-f-facebook {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 56px;
            width: 324px;
            background: #FFFFFF;
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }

        .log-f-f-text {
            position: relative;
            top: 2px;
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0.11em;
            text-transform: uppercase;
            color: #000000;
            padding: 0;
        }

        .log-title-t {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            text-align: center;
            color: #FFFFFF;
            mix-blend-mode: normal;
        }

        .log-btn-singup {
            margin: 39px 0 0;
            text-align: center;
        }

        .log-btn-sing {
            height: 56px;
            width: 324px;
            padding: 20px 130px;
            background: #F1C82D;
            border-radius: 10px;
            transition: background .3s;
        }

        .log-btn-sing:hover {
            background: #ffde5f;
        }

        .log-btn-sing span {
            font-family: 'Proxima Nova', sans-serif;
            text-decoration: none;
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            text-align: center;
            text-transform: uppercase;
            color: #000000;
        }

        .log-form-captcha {
            width: 200px;
            margin: 20px 0 0;
            position: relative;
            left: 14px;
            bottom: 14px;
        }

        /*ADAPTIVE LOGIN PAGE*/
        @media (max-width: 1440px) {

        }

        @media (max-width: 1320px) {

        }

        @media (max-width: 960px) {
            .log-form-google {
                margin: 20px 0 20px;
            }

            .login-logo-content {
                width: 0%;
            }

            .login-form {
                width: 100%;
            }
        }

        @media (max-width: 800px) {

        }

        @media (max-height: 890px) {
            .test1 {
                display: grid;
                grid-template-columns: 224px 224px;
                gap: 20px
            }

            .log-form-flex {
                width: 468px;

                margin: 0;
            }

            .login-main-title {
                margin: 0 0 20px;
            }

            .log-form-name {
                margin: 0 0 0 0;
            }

            .log-form-email {
                margin: 0 0 0 0;
            }

            .log-f-email {
                width: 224px;
            }

            .log-form-pass {
                margin: 0 0 0 0;
            }

            .log-f-pass {
                width: 224px;
            }

            .log-text-decorate {
                position: relative;
                top: 35px;
                right: 0px;
                width: 468px;
                height: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .log-form-forget {
                width: 224px;
                height: 56px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .log-form-pass-conf {
                margin: 0 0 0 0;
            }

            .log-form-enter {
                margin: 0 0 0 0;
                /*width: 324px;*/
            }

            .log-f-enter-btn {
                width: 224px;
            }

            .log-form-google {
                margin: 60px 0 20px;
            }

            .log-f-google {
                width: 468px;
            }

            .log-f-g-text {
                content: 'test';
            }

            .log-form-facebook {
                margin: 19px 0 0 0;
            }

            .log-f-facebook {
                width: 468px;
            }

            .test2 {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
            }

            .log-title-text {
                position: relative;
                top: 23px;
                right: -10px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0 0 0 0;
                width: 224px;
                height: 56px;
            }

            .log-btn-singup {
                position: relative;
                left: 245px;
                top: -17px;
                width: 224px;
                margin: 0 0 0 0;
                /*text-align: center;*/
                /*height: 56px;*/
            }

            .log-btn-sing {
                width: 224px;
                padding: 20px 83px;
            }

            .log-form-captcha {
                margin: 20px 0 0;
                position: relative;
                left: 80px;
                bottom: -10px;
            }
            @media (max-width: 960px) {
                .log-form-google {
                    margin: 60px 0 20px;
                }

                .login-logo-content {
                    width: 0%;
                }

                .login-form {
                    width: 100%;
                }
            }
        }
    </style>

    <div class="login-main">
        <div class="login-logo-content">
            <div class="login-logo-main">
                <img class="login-logo" src="../../materials/images/workfitdxr_logo_1.png">
            </div>
            <div class="login-title-block">
                <h1 class="login-title">
                    A better way to address the gap in employee satisfaction
                </h1>
            </div>
        </div>
        <div class="login-form">
            <h1 class="login-main-title">Log in</h1>
            @if(count($errors))
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger alert-dismissible fade show">{{$error}}</p>
                @endforeach
            @endif
            <form method="POST" action="{{ route('login') }}" class="login-form-content">
                @csrf
                <div class="test1">
                    <div class="log-form-email">
                        <input id="email" type="email" class="log-f-email is-invalid"
                               name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                               placeholder="ENTER YOUR EMAIL">
                    </div>

                    <div class="log-form-pass">
                        <input id="password" type="password" class="log-f-pass is-invalid"
                               name="password" required autocomplete="current-password" placeholder="YOUR PASSWORD">
                    </div>

                    <div class="log-form-flex">
                        <div class="log-form-forget">
                            <a class="log-f-forget-link" href="/password/reset"><span class="log-f-forget-text">Forgot Password?</span></a>
                        </div>

                        <div class="log-form-enter">
                            <button type="submit" class="log-f-enter-btn"><span class="log-f-enter-text">Enter</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="log-form-captcha">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                </div>

                <div class="log-text-decorate">
                    <p class="log-text-dec">or</p>
                </div>

                <div class="log-form-google">
                    <a class="log-f-google" href="{{ route('auth.google') }}">
                        <svg width="42px"
                             height="39px"
                             viewBox="0 0 43 40"
                             fill="none"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect x="0.152344" y="0.554688" width="42.5986" height="39.4432" rx="19.7216"
                                  fill="url(#pattern0)"/>
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_1_75" transform="scale(0.0185185 0.02)"/>
                                </pattern>
                                <image id="image0_1_75" width="54" height="50"
                                       xlink:href="data:image/png;base64,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"/>
                            </defs>
                        </svg>
                        <span class="log-f-g-text">Continue with google</span>
                    </a>
                </div>
                <div class="log-form-facebook">
                    <a class="log-f-facebook" href="{{ route('auth.facebook') }}">
                        <svg width="32px"
                             height="55px"
                             viewBox="0 0 50 50"
                             fill="none"
                             style="margin: 0 5px 0 0"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M48 24C48 10.7438 37.2562 0 24 0C10.7438 0 0 10.7438 0 24C0 35.9813 8.775 45.9094 20.25 47.7094V30.9375H14.1562V24H20.25V18.7125C20.25 12.6984 23.8313 9.375 29.3156 9.375C31.9406 9.375 34.6875 9.84375 34.6875 9.84375V15.75H31.6594C28.6781 15.75 27.75 17.6016 27.75 19.5V24H34.4062L33.3422 30.9375H27.75V47.7094C39.225 45.9094 48 35.9813 48 24Z"
                                  fill="#1877F2"/>
                            <path d="M33.3422 30.9375L34.4062 24H27.75V19.5C27.75 17.6016 28.6781 15.75 31.6594 15.75H34.6875V9.84375C34.6875 9.84375 31.9406 9.375 29.3156 9.375C23.8313 9.375 20.25 12.6984 20.25 18.7125V24H14.1562V30.9375H20.25V47.7094C21.4734 47.9016 22.725 48 24 48C25.275 48 26.5266 47.9016 27.75 47.7094V30.9375H33.3422Z"
                                  fill="white"/>
                        </svg>
                        <span class="log-f-f-text">Continue with facebook</span>
                    </a>
                </div>

                <div class="log-title-text">
                    <p class="log-title-t">If you don't have an account yet:</p>
                </div>
                <div class="log-btn-singup">
                    <a href="/register" class="log-btn-sing">
                        <span>Sing up</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(!empty($notification))
        toastr.error(" {{ $notification['message'] }} ");
        @endif
    </script>

@endsection
