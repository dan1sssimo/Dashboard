<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<script type="text/javascript" src="/js/jQuery.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<style>
    html, body {
        display: flex;
        justify-content: center;
        font-family: Roboto, Arial, sans-serif;
        font-size: 15px;
    }
    form {
        border: 5px solid #f1f1f1;
    }
    input[type=text], input[type=password], select {
        width: 100%;
        padding: 16px 8px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .icon {
        font-size: 110px;
        display: flex;
        justify-content: center;
        color: #4286f4;
    }
    button {
        background-color: #4286f4;
        color: white;
        padding: 14px 0;
        margin: 10px 0;
        border: none;
        cursor: grab;
        width: 48%;
    }
    h1 {
        text-align:center;
        fone-size:18;
    }
    button:hover {
        opacity: 0.8;
    }
    .formcontainer {
        text-align: center;
        margin: 24px 50px 12px;
    }
    .container {
        padding: 16px 0;
        text-align:left;
    }
    span.psw {
        float: right;
        padding-top: 0;
        padding-right: 15px;
    }
    /* Change styles for span on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
    }

    .modal-spiner {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 1;
        visibility: visible;
        transform: scale(1.1);
        transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
    }

    .modal-content-spiner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 1rem 1.5rem;
        width: 24rem;
        border-radius: 0.5rem;
    }

    .close-button-spiner {
        float: right;
        width: 1.5rem;
        line-height: 1.5rem;
        text-align: center;
        cursor: pointer;
        border-radius: 0.25rem;
        background-color: lightgray;
    }

    .close-button-spiner:hover {
        background-color: darkgray;
    }

    .show-modal-spiner {
        opacity: 1;
        visibility: visible;
        transform: scale(1.0);
        transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
    }

    .spin-spiner {
        background-color: green;
        height: 100px;
        width: 100px;
        border-radius: 100px;
        border: 5px solid #00000000;
        border-top: 5px solid #ffffff;
        animation: loading 2s linear infinite;
    }

    .loading-spiner {
        position: absolute;
        color: #ffffff;
        font-family: Arial, Helvetica, sans-serif;
    }

    @keyframes loading-spiner {
        100% {
            transform: rotate(360deg);
        }
    }

    .load-spiner {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<body>
{{--<form>--}}
{{--    <h1>Full form below and confirm data</h1>--}}
{{--    <div class="icon">--}}
{{--        <i class="fas fa-user-circle"></i>--}}
{{--    </div>--}}
{{--    <div class="formcontainer">--}}
{{--        <div class="container">--}}
{{--            @foreach($user as $elem)--}}
{{--                @if($elem->employee === "yes")--}}
{{--                    <label for="name"><strong>Your name:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your name" value="{{$elem->name}}" disabled name="name" id="name" required>--}}

{{--                    <label for="email"><strong>Your email:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your email" value="{{$elem->email}}" disabled name="email" id="email" required>--}}

{{--                    <label for="company"><strong>Your company:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your company" value="{{$elem->company_title}}" disabled name="company" id="company" required>--}}

{{--                    <label for="manager"><strong>Choose your company manager:</strong></label>--}}
{{--                    <select id="manager">--}}
{{--                        @foreach($managers as $manager)--}}
{{--                            <option name="manager" class="manager" value="{{$manager->name}}">{{$manager->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="department"><strong>Choose your department:</strong></label>--}}
{{--                    <select id="department">--}}
{{--                        @foreach($departments as $department)--}}
{{--                            <option name="department" class="department" value="{{$department->title}}">{{$department->title}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="chief"><strong>Choose your department chief:</strong></label>--}}
{{--                    <select id="chief">--}}
{{--                        @foreach($chiefs as $chief)--}}
{{--                            <option name="chief" class="chief" value="{{$chief->name}}">{{$chief->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="supervisor"><strong>Choose your direct supervisor:</strong></label>--}}
{{--                    <select id="supervisor">--}}
{{--                        @foreach($supervisors as $supervisor)--}}
{{--                            <option name="supervisor" class="supervisor" value="{{$supervisor->name}}">{{$supervisor->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/><br/>--}}

{{--                    <label for="checkbox"><strong>Confirm information:</strong></label>--}}
{{--                    <input type="checkbox" name="checkbox" id="checkbox" required>--}}
{{--                @elseif($elem->teamlead === "yes")--}}
{{--                    <label for="name"><strong>Your name:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your name" value="{{$elem->name}}" disabled name="name" id="name" required>--}}

{{--                    <label for="email"><strong>Your email:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your email" value="{{$elem->email}}" disabled name="email" id="email" required>--}}

{{--                    <label for="company"><strong>Your company:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your company" value="{{$elem->company_title}}" disabled name="company" id="company" required>--}}

{{--                    <label for="manager"><strong>Choose your company manager:</strong></label>--}}
{{--                    <select id="manager">--}}
{{--                        @foreach($managers as $manager)--}}
{{--                            <option name="manager" class="manager" selected value="None">None</option>--}}
{{--                            <option name="manager" class="manager"  value="{{$manager->name}}">{{$manager->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="department"><strong>Choose your department:</strong></label>--}}
{{--                    <select id="department">--}}
{{--                        @foreach($departments as $department)--}}
{{--                            <option name="department" class="department" value="{{$department->title}}">{{$department->title}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="chief"><strong>Choose your department chief:</strong></label>--}}
{{--                    <select id="chief">--}}
{{--                        @foreach($chiefs as $chief)--}}
{{--                            <option name="chief" class="chief" selected value="None">None</option>--}}
{{--                            <option name="chief" class="chief" value="{{$chief->name}}">{{$chief->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="supervisor"><strong>Choose your direct supervisor:</strong></label>--}}
{{--                    <input type="text" id="supervisor" name="supervisor" class="supervisor" value="{{$elem->name}}" disabled>--}}

{{--                    <label for="checkbox"><strong>Confirm information:</strong></label>--}}
{{--                    <input type="checkbox" name="checkbox" id="checkbox" required>--}}
{{--                @elseif($elem->chief === "yes")--}}
{{--                    <label for="name"><strong>Your name:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your name" value="{{$elem->name}}" disabled name="name" id="name" required>--}}

{{--                    <label for="email"><strong>Your email:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your email" value="{{$elem->email}}" disabled name="email" id="email" required>--}}

{{--                    <label for="company"><strong>Your company:</strong></label>--}}
{{--                    <input type="text" placeholder="Enter your company" value="{{$elem->company_title}}" disabled name="company" id="company" required>--}}

{{--                    <label for="manager"><strong>Choose your company manager:</strong></label>--}}
{{--                    <select id="manager">--}}
{{--                        @foreach($managers as $manager)--}}
{{--                            <option name="manager" class="manager" value="{{$manager->name}}">{{$manager->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="department"><strong>Choose your department:</strong></label>--}}
{{--                    <select id="department">--}}
{{--                        @foreach($departments as $department)--}}
{{--                            <option name="department" class="department" value="{{$department->title}}">{{$department->title}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br/>--}}

{{--                    <label for="chief"><strong>Choose your department chief:</strong></label>--}}
{{--                    <input type="text" id="chief" name="chief" class="chief" value="{{$elem->name}}" disabled>--}}

{{--                    <label for="supervisor"><strong>Choose your direct supervisor:</strong></label>--}}
{{--                    <input type="text" id="supervisor" name="supervisor" class="supervisor" value="None" disabled>--}}

{{--                    <label for="checkbox"><strong>Confirm information:</strong></label>--}}
{{--                    <input type="checkbox" name="checkbox" id="checkbox" required>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <button type="submit" id="btn-api"><strong>SEND!</strong></button>--}}
{{--    </div>--}}
{{--</form>--}}

        <div class="modal-spiner">
            <div class="modal-content-spiner">
                <span class="close-button-spiner"></span>
                <div class="load-spiner">
                    <div class="spin-spiner"></div>
                    <div class="loading-spiner">LOADING</div>
                </div>
                <h1>Please, wait a second...</h1>
            </div>
        </div>
</body>
<script>
            $(document).ready(function() {
                var myHeaders = new Headers();
                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                myHeaders.append("Content-Type", "application/json");

                var raw = JSON.stringify({
                    "QuestionText": "Select your department",
                    "DefaultChoices": false,
                    "DataExportTag": "Q1.3",
                    "QuestionType": "MC",
                    "Selector": "DL",
                    "Configuration": {
                        "QuestionDescriptionOption": "UseText"
                    },
                    "QuestionDescription": "Select your department",
                    "Choices": {
                        "1": {
                            "Display": "{{($department === null) ? "" : $department}}"
                        }
                    },
                    "ChoiceOrder": [
                        1
                    ],
                    "Validation": {
                        "Settings": {
                            "ForceResponse": "ON",
                            "ForceResponseType": "ON",
                            "Type": "None"
                        }
                    },
                    "Language": [],
                    "NextChoiceId": 4,
                    "NextAnswerId": 1
                });

                var requestOptions = {
                    method: 'PUT',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };

                fetch("https://sjc1.qualtrics.com/API/v3/survey-definitions/SV_9FtECtejcxTGgL4/questions/QID63", requestOptions)
                    .then(response => response.text())
                    .then(result => console.log())
                    .catch(error => console.log('error', error));
            })

            $(document).ready(function ()
            {
                var myHeaders = new Headers();
                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                myHeaders.append("Content-Type", "application/json");

                var raw = JSON.stringify({
                    "QuestionText": "Select your supervisor",
                    "DefaultChoices": false,
                    "DataExportTag": "Q1.4",
                    "QuestionType": "MC",
                    "Selector": "DL",
                    "Configuration": {
                        "QuestionDescriptionOption": "UseText"
                    },
                    "QuestionDescription": "Select your supervisor",
                    "Choices": {
                        "1": {
                            "Display": "{{($supervisor === null) ?  "" : $supervisor}}"
                        }
                    },
                    "ChoiceOrder": [
                        1
                    ],
                    "Validation": {
                        "Settings": {
                            "ForceResponse": "ON",
                            "ForceResponseType": "ON",
                            "Type": "None"
                        }
                    },
                    "Language": [],
                    "NextChoiceId": 4,
                    "NextAnswerId": 1
                });

                var requestOptions = {
                    method: 'PUT',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };

                fetch("https://sjc1.qualtrics.com/API/v3/survey-definitions/SV_9FtECtejcxTGgL4/questions/QID103", requestOptions)
                    .then(response => response.text())
                    .then(result => console.log())
                    .catch(error => console.log('error', error));
            })

            $(document).ready(function () {
                var myHeaders = new Headers();
                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                myHeaders.append("Content-Type", "application/json");

                var raw = JSON.stringify({
                    "QuestionText": "Select your company",
                    "DefaultChoices": false,
                    "DataExportTag": "Q1.2",
                    "QuestionType": "MC",
                    "Selector": "DL",
                    "Configuration": {
                        "QuestionDescriptionOption": "UseText"
                    },
                    "QuestionDescription": "Select your company",
                    "Choices": {
                        "1": {
                            "Display": "{{$company}}"
                        }
                    },
                    "ChoiceOrder": [
                        1
                    ],
                    "Validation": {
                        "Settings": {
                            "ForceResponse": "ON",
                            "ForceResponseType": "ON",
                            "Type": "None"
                        }
                    },
                    "Language": [],
                    "NextChoiceId": 4,
                    "NextAnswerId": 1
                });

                var requestOptions = {
                    method: 'PUT',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };

                fetch("https://sjc1.qualtrics.com/API/v3/survey-definitions/SV_9FtECtejcxTGgL4/questions/QID101", requestOptions)
                    .then(response => response.text())
                    .then(result => console.log())
                    .catch(error => console.log('error', error));
            })

            $(document).ready(function () {
                var myHeaders = new Headers();
                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                myHeaders.append("Content-Type", "application/json");

                var raw = JSON.stringify({
                    "QuestionText": "Select your work email from the list below",
                    "DefaultChoices": false,
                    "DataExportTag": "Q1.1",
                    "QuestionType": "MC",
                    "Selector": "DL",
                    "Configuration": {
                        "QuestionDescriptionOption": "UseText"
                    },
                    "QuestionDescription": "Select your work email from the list below",
                    "Choices": {
                        "1": {
                            "Display": "{{$email}}"
                        }
                    },
                    "ChoiceOrder": [
                        1
                    ],
                    "Validation": {
                        "Settings": {
                            "ForceResponse": "ON",
                            "ForceResponseType": "ON",
                            "Type": "None"
                        }
                    },
                    "Language": [],
                    "NextChoiceId": 4,
                    "NextAnswerId": 1
                });

                var requestOptions = {
                    method: 'PUT',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };
                fetch("https://sjc1.qualtrics.com/API/v3/survey-definitions/SV_9FtECtejcxTGgL4/questions/QID62", requestOptions)
                    .then(response => response.text())
                    .then(result => console.log())
                    .catch(error => console.log('error', error));
            })

            $(document).ready(function () {
                var myHeaders = new Headers();
                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                myHeaders.append("Content-Type", "application/json");

                var raw = JSON.stringify({
                    "Description": "string",
                    "Published": true
                });

                var requestOptions = {
                    method: 'POST',
                    headers: myHeaders,
                    body: raw,
                    redirect: 'follow'
                };

                fetch("https://sjc1.qualtrics.com/API/v3/survey-definitions/SV_9FtECtejcxTGgL4/versions", requestOptions)
                    .then(response => response.text())
                    .then(result => console.log())
                    .catch(error => console.log('error', error));
            })

            $(document).ready(() =>
            {
                // alert("Please, don't refresh this page and wait near 15 seconds, your data uploading .... ")
                // $(".modal").css("visibility", "visible");
                setTimeout(function(){
                    window.location = "https://qualtricsxm29zkvsd7y.qualtrics.com/jfe/form/SV_9FtECtejcxTGgL4";
                }, 10000);
            })
</script>

</html>
