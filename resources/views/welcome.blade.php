@extends('layouts.app')
@section('title')
    Welcome!
@endsection
@section('content')

    <style type="text/css">
        a {
            text-decoration: none;
        }
        .content-main {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90vh;
            padding: 0 80px;
            width: 100%;
        }
        .content-title {
            position: relative;
            left: 9px;
            top: 1px;
            width: 360px;
            height: 117px;

            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 32px;
            text-align: center;

            color: #000000;
        }
        .content-auth {
            position: relative;
            top: 60px;
            left: 110px;
            width: 50%;
            /*position: relative;*/
            /*right: -90px;*/
            border-left: 1px solid rgba(255, 255, 255, 0.63);
            max-width: 532px;
            height: 345px;
        }
        .cont-auth-title {
            margin: 0 0 46.77px;
            height: 50px;
        }
        .auth-title {
            position: relative;
            top: 10px;
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 36px;
            text-align: center;
            color: #FFFFFF;
        }
        .content-logo {
            width: 50%;
            position: relative;
            left: 37px;
            top: 46px;
        }
        .content-logo-block {
            max-width: 379px;
            height: 55px;

            margin: 0 0 54px;
        }
        .cont-log {
            position: relative;
            top: 10px;
            margin: 0 0 17.9px;
            text-align: center;
            height: 70px;
        }
        .c-log-btn {
            height: 70px;
            max-width: 300px;
            padding: 25.5px 119.5px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;

            transition: background-color .3s;
        }
        .c-log-btn:hover {
            background-color: rgba(0, 0, 0, 1);
        }
        .c-log-btn span {
            font-family: 'Proxima Nova', sans-serif;
            text-decoration: none;
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
        }
        .cont-sing {
            position: relative;
            top: 10px;
            margin: 0 0 60px;
            text-align: center;
            height: 70px;
        }
        .c-sing-btn {
            height: 70px;
            max-width: 300px;
            padding: 25.5px 115px;
            background: #F1C82D;
            border-radius: 10px;

            transition: background .3s;
        }
        .c-sing-btn:hover {
            background: #ffde5f;
        }
        .c-sing-btn span {
            font-family: 'Proxima Nova', sans-serif;
            text-decoration: none;
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            color: #000000;
        }
        .cont-referal {
            font-family: 'Proxima Nova', sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 20px;
            text-align: center;
            text-decoration-line: none;

        }
        .cont-referal a {
            color: #FFFFFF;
            border-bottom: 1px solid rgba(255, 255, 255, 0.63);
        }
        /*ADAPTIVE WELCOME PAGE*/
        @media (max-width: 1641px) {
            .content-auth {
                max-width: 482px;
                height: 345px;
            }
        }
        @media (max-width: 1440px) {
            .content-auth {
                max-width: 462px;
                height: 345px;
            }
        }
        @media (max-width: 1281px) {
            .auth-title {
                font-size: 26px;
            }
            .c-log-btn {
                height: 56px;
                max-width: 235px;
                padding: 20px 96px;
            }
            .cont-sing {
                margin: 0 0 48px;
                height: 56px;
            }
            .c-sing-btn {
                height: 56px;
                max-width: 235px;
                padding: 20px 96px;
            }
            .content-logo-block {
                margin: 0 0 38px;
            }
            .content-main-logo {
                position: relative;
                left: 32px;
                width: 303px;
                height: 44px;
            }
            .content-title {
                height: 100px;
                width: 350px;
                font-size: 26px;
            }
            .content-auth {
                position: relative;
                left: 50px;
                max-width: 402px;
                height: 345px;
            }
        }
        @media (max-width: 1081px) {
            .content-title {
                height: 85px;
                font-size: 26px;
            }
            .content-auth {
                max-width: 362px;
                height: 345px;
            }
        }
        @media (max-width: 1010px) {
            .content-auth {
                margin-top: 20px;
            }
            .content-title {
                height: 70px;
                width: 320px;
                font-size: 24px;
            }
            .cont-auth-title {
                height: 20px;
            }

        }
        /*MOBILE*/
        @media (max-width: 910px) {
            .content-logo {
                width: 362px;
                position: relative;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
            }
            .content-auth {
                position: relative;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                border-left: 0;
                border-top: 1px solid rgba(255, 255, 255, 0.63);
                padding: 20px 0 0;
            }
            .content-main {
                position: relative;
                top: 0;
                right: 0;
                left: 0;
                bottom: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 90vh;
                padding: 60px 0 0;
                width: 100%;
            }
            .content-logo {
            }
        }
    </style>

{{--    <div class="content">--}}
{{--        <a href="/login" class="btn btn-warning" class="welcome_button">Welcome!</a>--}}
{{--    </div>--}}

    <div class="content-main">
        <div class="content-logo">
            <div class="content-logo-block">
                <img class="content-main-logo" src="../../materials/images/workfitdxr_logo_1.png">
            </div>
            <div class="content-title-block">
                <h1 class="content-title">
                    A better way to address the gap in employee satisfaction
                </h1>
            </div>
        </div>
        <div class="content-auth">
           <div class="cont-auth-title">
               <h2 class="auth-title">Get Started!</h2>
           </div>
            <div class="cont-log">
                <a href="/login" class="c-log-btn"><span>LOG IN</span></a>
            </div>
            <div class="cont-sing">
                <a href="/register" class="c-sing-btn"><span>SING UP</span></a>
            </div>
           <div class="cont-referal">
               <a href="#">Referal link</a>
           </div>
        </div>
    </div>

@endsection
