@extends('layouts.app')
@section('content')
<style>
    .navbar-main-dashboard, .footer-dashboard-main {
        display: none;
    }



    .modal {
        display: flex; /* Hidden by default */
        justify-content: center;
        align-items: center;
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    /* Modal Content/Box */
    .modal-content {
        height: 422.34px;
        width: 385.9px;
        padding: 15px;
        background: #FFFFFF;
        border: 1px solid #D1D1D1;
        border-radius: 10px;
    }
    .close {
        display: flex;
        justify-content: right;
        align-items: center;
        margin: 0 0 30px;
    }
    .close svg {
        cursor: pointer;
    }
    .modal-content-text {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .modal-content-check {
        margin: 0 0 45px;
    }
    .modal-text {
        margin: 0 0 40px;
    }
    .modal-t {
        width: 225px;
        height: 29px;

        font-family: 'Proxima Nova', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 29px;
        text-align: center;

        color: #000000;

    }
    .modal-button {
        display: flex;
        justify-content: center;
        align-items: center;

        height: 70px;
        width: 300px;
        text-decoration: none;
        background: #59D876;
        border-radius: 10px;
        transition: all 0.5s;
    }
    .modal-button:hover {
        background: #42a457;
    }
    .modal-btn {
        width: 50px;
        height: 19px;

        font-family: 'Proxima Nova', sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        line-height: 19px;
        text-align: center;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        color: #FFFFFF;

        mix-blend-mode: normal;
    }

    /*Error*/
    .modal-content-text-error {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .modal-text-error {
        margin: 0 0 40px;
    }
    .modal-t-err {
        width: 225px;
        height: 29px;

        font-family: 'Proxima Nova', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 24px;
        line-height: 29px;
        text-align: center;

        color: #000000;
    }
    .modal-button-error {
        display: flex;
        justify-content: center;
        align-items: center;

        height: 70px;
        width: 300px;
        text-decoration: none;
        background: #E4572E;
        border-radius: 10px;
        transition: all 0.5s;
    }
    .modal-button-error:hover {
        background: #a23c1f;
    }
    .modal-btn-err {
        width: 110px;
        height: 19px;

        font-family: 'Proxima Nova', sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        line-height: 19px;
        text-align: center;
        letter-spacing: 0.11em;
        text-transform: uppercase;
        color: #FFFFFF;

        mix-blend-mode: normal;
    }
</style>

<!-- The Modal 1-->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">
            {{--<svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6.5332" y="19.6051" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-45 6.5332 19.6051)" fill="#737373"/>
                <rect x="20.1941" y="21.8475" width="19.3192" height="3.17091" rx="1.58545" transform="rotate(-135 20.1941 21.8475)" fill="#737373"/>
            </svg>--}}
        </span>
        <div class="modal-content-text">
            <div class="modal-content-check">
                <svg width="91" height="91" viewBox="0 0 91 91" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M45.633 90.9362C33.7024 90.923 22.2642 86.1776 13.8279 77.7414C5.39168 69.3051 0.646352 57.8669 0.633057 45.9363C0.633057 45.1036 0.963828 44.3051 1.5526 43.7163C2.14138 43.1275 2.93993 42.7967 3.77259 42.7967C4.60525 42.7967 5.4038 43.1275 5.99258 43.7163C6.58135 44.3051 6.91212 45.1036 6.91212 45.9363C6.91212 53.5945 9.18307 61.0808 13.4378 67.4485C17.6925 73.8161 23.7399 78.779 30.8152 81.7097C37.8905 84.6404 45.676 85.4072 53.1871 83.9132C60.6982 82.4191 67.5976 78.7313 73.0129 73.3161C78.4281 67.9009 82.1159 61.0015 83.6099 53.4903C85.104 45.9792 84.3372 38.1937 81.4065 31.1184C78.4758 24.0431 73.5129 17.9957 67.1452 13.741C60.7776 9.48629 53.2913 7.21535 45.633 7.21535C44.8004 7.21535 44.0018 6.88458 43.4131 6.2958C42.8243 5.70702 42.4935 4.90847 42.4935 4.07581C42.4935 3.24316 42.8243 2.4446 43.4131 1.85583C44.0018 1.26705 44.8004 0.936279 45.633 0.936279C57.5678 0.936279 69.0137 5.67734 77.4528 14.1165C85.892 22.5556 90.633 34.0015 90.633 45.9363C90.633 57.871 85.892 69.3169 77.4528 77.7561C69.0137 86.1952 57.5678 90.9362 45.633 90.9362Z" fill="#59D876"/>
                    <path d="M45.633 90.9362C41.1264 90.9405 36.6447 90.2674 32.3381 88.9395C31.5509 88.6868 30.8951 88.1338 30.5132 87.4005C30.1313 86.6672 30.054 85.8129 30.2982 85.0229C30.5424 84.233 31.0883 83.5714 31.8175 83.1815C32.5466 82.7917 33.4 82.7053 34.1925 82.9409C37.8987 84.0822 41.7551 84.6608 45.633 84.6572C46.4657 84.6572 47.2642 84.988 47.853 85.5767C48.4418 86.1655 48.7725 86.9641 48.7725 87.7967C48.7725 88.6294 48.4418 89.4279 47.853 90.0167C47.2642 90.6055 46.4657 90.9362 45.633 90.9362ZM18.6749 81.099C17.9347 81.1022 17.2176 80.841 16.653 80.3623C12.0467 76.4904 8.26453 71.7331 5.53069 66.3725C5.15211 65.6309 5.08364 64.7693 5.34035 63.9772C5.59705 63.1851 6.15791 62.5274 6.89953 62.1488C7.64115 61.7702 8.50278 61.7018 9.29488 61.9585C10.087 62.2152 10.7447 62.776 11.1232 63.5177C13.4754 68.1329 16.731 72.2284 20.6967 75.5609C21.1904 75.9748 21.5447 76.5307 21.7113 77.153C21.8778 77.7753 21.8487 78.4338 21.6278 79.0389C21.4068 79.6441 21.0048 80.1665 20.4765 80.5351C19.9482 80.9037 19.3191 81.1006 18.6749 81.099ZM4.37534 56.2172C3.63593 56.2152 2.92088 55.9527 2.35588 55.4757C1.79087 54.9987 1.41206 54.3379 1.28604 53.6093C0.269198 47.6806 0.441374 41.6089 1.79255 35.7474C2.00587 34.9661 2.51292 34.2974 3.20773 33.8811C3.90253 33.4648 4.73133 33.3332 5.52092 33.5137C6.31051 33.6942 6.99979 34.1729 7.4447 34.8497C7.88962 35.5266 8.05574 36.3491 7.90836 37.1456C6.75303 42.1954 6.61075 47.4241 7.48976 52.5293C7.63056 53.3497 7.43979 54.1925 6.95938 54.8723C6.47897 55.5521 5.74826 56.0132 4.9279 56.1544C4.74577 56.1906 4.56095 56.2116 4.37534 56.2172ZM11.7637 24.4702C11.1832 24.4736 10.6131 24.3157 10.117 24.0141C9.62094 23.7126 9.21832 23.2792 8.95402 22.7624C8.68971 22.2455 8.57411 21.6654 8.62009 21.0866C8.66606 20.5079 8.87181 19.9533 9.21441 19.4846C11.871 15.8495 15.0554 12.6312 18.6623 9.93628C18.9921 9.68891 19.3675 9.50892 19.7669 9.4066C20.1663 9.30427 20.5819 9.28162 20.99 9.33993C21.3982 9.39823 21.7908 9.53636 22.1456 9.74642C22.5004 9.95648 22.8103 10.2344 23.0577 10.5642C23.305 10.894 23.485 11.2693 23.5873 11.6687C23.6897 12.0681 23.7123 12.4838 23.654 12.8919C23.5957 13.3001 23.4576 13.6927 23.2475 14.0475C23.0375 14.4022 22.7596 14.7122 22.4298 14.9595C19.3277 17.2791 16.5891 20.0487 14.3046 23.1767C14.0133 23.5776 13.6311 23.9037 13.1895 24.1286C12.7478 24.3534 12.2593 24.4705 11.7637 24.4702ZM35.5865 8.43349C34.8198 8.43316 34.0797 8.15229 33.5059 7.64386C32.932 7.13542 32.564 6.43458 32.4713 5.6735C32.3786 4.91243 32.5677 4.14375 33.0027 3.51244C33.4378 2.88114 34.0888 2.43085 34.833 2.24651C38.3668 1.37493 41.9933 0.93498 45.633 0.936282C46.4657 0.936282 47.2642 1.26705 47.853 1.85583C48.4418 2.44461 48.7725 3.24316 48.7725 4.07582C48.7725 4.90847 48.4418 5.70703 47.853 6.2958C47.2642 6.88458 46.4657 7.21535 45.633 7.21535C42.4954 7.21372 39.3693 7.59324 36.3232 8.34558C36.0817 8.40208 35.8346 8.43157 35.5865 8.43349Z" fill="#59D876"/>
                    <path d="M40.0528 60.2396C39.2191 60.2395 38.4195 59.9082 37.83 59.3187L26.67 48.1545C26.1154 47.5593 25.8135 46.7722 25.8279 45.9588C25.8422 45.1454 26.1717 44.3694 26.7469 43.7942C27.3222 43.219 28.0982 42.8895 28.9115 42.8751C29.7249 42.8608 30.5121 43.1627 31.1072 43.7173L40.0528 52.6587L60.1458 32.5656C60.741 32.0111 61.5281 31.7092 62.3415 31.7235C63.1548 31.7379 63.9309 32.0674 64.5061 32.6426C65.0813 33.2178 65.4108 33.9938 65.4251 34.8072C65.4395 35.6205 65.1376 36.4077 64.583 37.0028L42.284 59.3312C41.9902 59.6221 41.6418 59.852 41.259 60.0079C40.8761 60.1638 40.4662 60.2425 40.0528 60.2396Z" fill="#59D876"/>
                </svg>
            </div>
            <div class="modal-text">
                <p class="modal-t">Payment successful!</p>
            </div><br /><br />
            <a class="modal-button" href="/home" class="btn btn-success">
                <span class="modal-btn">Done</span>
            </a>
        </div>
    </div>
</div>

@endsection


