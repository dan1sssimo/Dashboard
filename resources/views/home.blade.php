@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/css/chartsModalWindow.css">
    <link rel="stylesheet" type="text/css" href="/css/modal.css">
    <link rel="stylesheet" type="text/css" href="/css/light-dark-mode.css">

    @if(Auth::user()->admin !== "yes")
        <div class="dropdown-departments-modal-iTemperature">
            <div class="dropdown-departments-content-iTemperature" style="width: 30%; height: 60vh;"><br />
                <div class="dropdown-departments-content-text-iTemperature">
                    <span style="margin-left: 90%; margin-bottom: 10px; margin-top: -30px; cursor: pointer"><img class="close-dropdown" src="https://www.svgrepo.com/download/32011/close-button.svg" width="30px;"></span>
                    <div class="dropdown-departments-text-iTemperature" style="text-align: center">
                        <ul style="list-style: none;">
                            @foreach($departments as $department_title)
                                <li><a style="cursor:pointer;" class="department-{{$department_title->id}}-iTemp">{{$department_title->department}}</a></li>
                                <script>
                                    $(".department-{{$department_title->id}}-iTemp").on("click", function(e)
                                    {
                                        e.preventDefault();
                                        $(".dropdown-departments-modal-iTemperature").css({
                                            "display": "none"
                                        })

                                        $(document).ready(function () {

                                            var myHeaders = new Headers();
                                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                            myHeaders.append("Content-Type", "application/json");

                                            var raw = JSON.stringify({
                                                "format": "json",
                                                "compress": false
                                            });

                                            var requestOptions = {
                                                method: 'POST',
                                                headers: myHeaders,
                                                body: raw,
                                                redirect: 'follow'
                                            };

                                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                                .then(response => response.json())
                                                .then(first => {
                                                    setTimeout(function () {
                                                        var myHeaders = new Headers();
                                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                        myHeaders.append("Content-Type", "application/json");

                                                        var requestOptions = {
                                                            method: 'GET',
                                                            headers: myHeaders,
                                                            redirect: 'follow'
                                                        };

                                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                            .then(response => response.json())
                                                            .then(second => {
                                                                setTimeout(function () {
                                                                    var myHeaders = new Headers();
                                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                    var requestOptions = {
                                                                        method: 'GET',
                                                                        headers: myHeaders,
                                                                        redirect: 'follow'
                                                                    };

                                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                        .then(response => response.json())
                                                                        .then(result => {
                                                                            let responses = result["responses"];
                                                                            let reduced = (a, b) => a + b;

                                                                            let knoweledgeFirst = [];
                                                                            let knoweledgeSecond = [];
                                                                            let knoweledgeThird = [];

                                                                            let clientFirst = [];
                                                                            let clientSecond = [];
                                                                            let clientThird = [];

                                                                            let teamFirst = [];
                                                                            let teamSecond = [];
                                                                            let teamThird = [];

                                                                            let skillFirst = [];
                                                                            let skillSecond = [];
                                                                            let skillThird = [];

                                                                            let materialFirst = [];
                                                                            let materialSecond = [];
                                                                            let materialThird = [];

                                                                            let leadershipFirst = [];
                                                                            let leadershipSecond = [];
                                                                            let leadershipThird = [];

                                                                            let organizationFirst = [];
                                                                            let organizationSecond = [];
                                                                            let organizationThird = [];

                                                                            let societalFirst = [];
                                                                            let societalSecond = [];
                                                                            let societalThird = [];

                                                                            let projectFirst = [];
                                                                            let projectSecond = [];
                                                                            let projectThird = [];

                                                                            let organizationCultureFirst = [];
                                                                            let organizationCultureSecond = [];
                                                                            let organizationCultureThird = [];

                                                                            let characterFirst = [];
                                                                            let characterSecond = [];
                                                                            let characterThird = [];

                                                                            let objReportDate = [];
                                                                            responses.forEach(el => {
                                                                                let department = "{{$department_title->department}}";
                                                                                department = department.replace("&amp;", "&")
                                                                                if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID63_TEXT"] == department) {
                                                                                    let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                                                    let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                                                    let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                                                    let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                                                    let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                                                    let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                                                    let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                                                    let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                                                    let pjFirst = el["values"]["QID30_1"];
                                                                                    let culFirst = el["values"]["QID31_1"];
                                                                                    let chFirst = el["values"]["QID32_1"];

                                                                                    let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                                                    let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                                                    let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                                                    let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                                                    let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                                                    let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                                                    let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                                                    let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                                                    let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                                                    let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                                                    let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                                                    let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                                                    let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                                                    let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                                                    let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                                                    let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                                                    let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                                                    let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                                                    let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                                                    let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                                                    let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                                                    let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                                                    knoweledgeFirst.push(knFirst);
                                                                                    knoweledgeSecond.push(knSecond);
                                                                                    knoweledgeThird.push(knThird);

                                                                                    skillFirst.push(skFirst);
                                                                                    skillSecond.push(skSecond);
                                                                                    skillThird.push(skThird);

                                                                                    clientFirst.push(clFirst);
                                                                                    clientSecond.push(clSecond);
                                                                                    clientThird.push(clThird);

                                                                                    teamFirst.push(tmFirst);
                                                                                    teamSecond.push(tmSecond);
                                                                                    teamThird.push(tmThird);

                                                                                    materialFirst.push(mtFirst);
                                                                                    materialSecond.push(mtSecond);
                                                                                    materialThird.push(mtThird);

                                                                                    leadershipFirst.push(ldFirst);
                                                                                    leadershipSecond.push(ldSecond);
                                                                                    leadershipThird.push(ldThird);

                                                                                    organizationFirst.push(orgFirst);
                                                                                    organizationSecond.push(orgSecond);
                                                                                    organizationThird.push(orgThird);

                                                                                    societalFirst.push(scFirst);
                                                                                    societalSecond.push(scSecond);
                                                                                    societalThird.push(scThird);

                                                                                    projectFirst.push(pjFirst);
                                                                                    projectSecond.push(pjSecond);
                                                                                    projectThird.push(pjThird);

                                                                                    organizationCultureFirst.push(culFirst);
                                                                                    organizationCultureSecond.push(culSecond);
                                                                                    organizationCultureThird.push(culThird);

                                                                                    characterFirst.push(chFirst);
                                                                                    characterSecond.push(chSecond);
                                                                                    characterThird.push(chThird);

                                                                                    /*GAP REPORT LOGIC CODE*/

                                                                                    /*GAP RAPORT*/
                                                                                    let arrayNameCard = [
                                                                                        'Knowledge Progress',
                                                                                        'Client Impact',
                                                                                        'Team Impact',
                                                                                        'Skill Progress',
                                                                                        'Material Progress - Pay & Benefits',
                                                                                        'Team & Leadership Ethics',
                                                                                        'Organization Impact',
                                                                                        'Societal Impact Size',
                                                                                        'Project Impact',
                                                                                        'Organization Culture',
                                                                                        'Character Culture',
                                                                                        'Role Progress',
                                                                                        'Task Impact',
                                                                                        'Social Progress',
                                                                                        'Social Positive Impact',
                                                                                        'Group/Team Culture'
                                                                                    ]

                                                                                    var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                                                    var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                                                    var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                                                    var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                                                    var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                                                    var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                                                    var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                                                    var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                                                    var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                                                    var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                                                    var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                                                    var satisfactionITemperatures = [];
                                                                                    satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                                                        [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                                                        [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                                                    document.getElementById("satisfaction-depatment").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                    document.getElementById("satisfaction-depatment-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                    satisfactionITemperatures.forEach(elem => {

                                                                                        var c = document.getElementById("satisfaction-depatment");
                                                                                        var ctx = c.getContext("2d");
                                                                                        ctx.beginPath();
                                                                                        ctx.fillStyle = "rgba(255, 255, 255)";
                                                                                        ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                        ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                        ctx.fill();

                                                                                        var cModal = document.getElementById("satisfaction-depatment-modal");
                                                                                        var ctxModal = cModal.getContext("2d");
                                                                                        ctxModal.beginPath();
                                                                                        ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                                                        ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                        ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                        ctxModal.fill();
                                                                                    })
                                                                                }
                                                                            })
                                                                        })
                                                                        .catch(error => console.log('error', error));
                                                                }, 4000);
                                                            })
                                                            .catch(error => console.log('error', error));
                                                    }, 4000);
                                                })
                                                .catch(error => console.log('error', error));
                                        })
                                    })
                                </script>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown-teams-modal-iTemperature">
            <div class="dropdown-teams-content-iTemperature" style="width: 30%; height: 60vh;"><br />
                <div class="dropdown-teams-content-text-iTemperature">
                    <span style="margin-left: 90%; margin-bottom: 10px; margin-top: -30px; cursor: pointer"><img class="close-dropdown" src="https://www.svgrepo.com/download/32011/close-button.svg" width="30px;"></span>
                    <div class="dropdown-teams-text-iTemperature" style="text-align: center">
                        <ul style="list-style: none;">
                            @foreach($teamleads as $sv)
                                @if(Auth::user()->chief === "yes")
                                    @if($sv->department === $department)
                                        <li><a style="cursor:pointer;" class="team-{{$sv->id}}-iTemp">{{$sv->name}}</a></li>
                                        <script>
                                            $(".team-{{$sv->id}}-iTemp").on("click", function(e)
                                            {
                                                e.preventDefault();
                                                $(".dropdown-teams-modal-iTemperature").css({
                                                    "display": "none"
                                                })

                                                $(document).ready(function () {

                                                    var myHeaders = new Headers();
                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                    myHeaders.append("Content-Type", "application/json");

                                                    var raw = JSON.stringify({
                                                        "format": "json",
                                                        "compress": false
                                                    });

                                                    var requestOptions = {
                                                        method: 'POST',
                                                        headers: myHeaders,
                                                        body: raw,
                                                        redirect: 'follow'
                                                    };

                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                                        .then(response => response.json())
                                                        .then(first => {
                                                            setTimeout(function () {
                                                                var myHeaders = new Headers();
                                                                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                                myHeaders.append("Content-Type", "application/json");

                                                                var requestOptions = {
                                                                    method: 'GET',
                                                                    headers: myHeaders,
                                                                    redirect: 'follow'
                                                                };

                                                                fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                                    .then(response => response.json())
                                                                    .then(second => {
                                                                        setTimeout(function () {
                                                                            var myHeaders = new Headers();
                                                                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                            var requestOptions = {
                                                                                method: 'GET',
                                                                                headers: myHeaders,
                                                                                redirect: 'follow'
                                                                            };

                                                                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                                .then(response => response.json())
                                                                                .then(result => {
                                                                                    let responses = result["responses"];
                                                                                    let reduced = (a, b) => a + b;

                                                                                    let knoweledgeFirst = [];
                                                                                    let knoweledgeSecond = [];
                                                                                    let knoweledgeThird = [];

                                                                                    let clientFirst = [];
                                                                                    let clientSecond = [];
                                                                                    let clientThird = [];

                                                                                    let teamFirst = [];
                                                                                    let teamSecond = [];
                                                                                    let teamThird = [];

                                                                                    let skillFirst = [];
                                                                                    let skillSecond = [];
                                                                                    let skillThird = [];

                                                                                    let materialFirst = [];
                                                                                    let materialSecond = [];
                                                                                    let materialThird = [];

                                                                                    let leadershipFirst = [];
                                                                                    let leadershipSecond = [];
                                                                                    let leadershipThird = [];

                                                                                    let organizationFirst = [];
                                                                                    let organizationSecond = [];
                                                                                    let organizationThird = [];

                                                                                    let societalFirst = [];
                                                                                    let societalSecond = [];
                                                                                    let societalThird = [];

                                                                                    let projectFirst = [];
                                                                                    let projectSecond = [];
                                                                                    let projectThird = [];

                                                                                    let organizationCultureFirst = [];
                                                                                    let organizationCultureSecond = [];
                                                                                    let organizationCultureThird = [];

                                                                                    let characterFirst = [];
                                                                                    let characterSecond = [];
                                                                                    let characterThird = [];

                                                                                    let objReportDate = [];
                                                                                    responses.forEach(el => {
                                                                                        let sv = "{{$sv->name}}"
                                                                                        let department = "{{$department}}";
                                                                                        department = department.replace("&amp;", "&");
                                                                                        if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == sv && el["values"]["QID63_TEXT"] == department) {
                                                                                            let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                                                            let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                                                            let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                                                            let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                                                            let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                                                            let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                                                            let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                                                            let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                                                            let pjFirst = el["values"]["QID30_1"];
                                                                                            let culFirst = el["values"]["QID31_1"];
                                                                                            let chFirst = el["values"]["QID32_1"];

                                                                                            let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                                                            let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                                                            let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                                                            let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                                                            let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                                                            let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                                                            let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                                                            let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                                                            let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                                                            let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                                                            let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                                                            let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                                                            let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                                                            let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                                                            let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                                                            let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                                                            let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                                                            let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                                                            let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                                                            let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                                                            let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                                                            let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                                                            knoweledgeFirst.push(knFirst);
                                                                                            knoweledgeSecond.push(knSecond);
                                                                                            knoweledgeThird.push(knThird);

                                                                                            skillFirst.push(skFirst);
                                                                                            skillSecond.push(skSecond);
                                                                                            skillThird.push(skThird);

                                                                                            clientFirst.push(clFirst);
                                                                                            clientSecond.push(clSecond);
                                                                                            clientThird.push(clThird);

                                                                                            teamFirst.push(tmFirst);
                                                                                            teamSecond.push(tmSecond);
                                                                                            teamThird.push(tmThird);

                                                                                            materialFirst.push(mtFirst);
                                                                                            materialSecond.push(mtSecond);
                                                                                            materialThird.push(mtThird);

                                                                                            leadershipFirst.push(ldFirst);
                                                                                            leadershipSecond.push(ldSecond);
                                                                                            leadershipThird.push(ldThird);

                                                                                            organizationFirst.push(orgFirst);
                                                                                            organizationSecond.push(orgSecond);
                                                                                            organizationThird.push(orgThird);

                                                                                            societalFirst.push(scFirst);
                                                                                            societalSecond.push(scSecond);
                                                                                            societalThird.push(scThird);

                                                                                            projectFirst.push(pjFirst);
                                                                                            projectSecond.push(pjSecond);
                                                                                            projectThird.push(pjThird);

                                                                                            organizationCultureFirst.push(culFirst);
                                                                                            organizationCultureSecond.push(culSecond);
                                                                                            organizationCultureThird.push(culThird);

                                                                                            characterFirst.push(chFirst);
                                                                                            characterSecond.push(chSecond);
                                                                                            characterThird.push(chThird);

                                                                                            /*GAP REPORT LOGIC CODE*/

                                                                                            /*GAP RAPORT*/
                                                                                            let arrayNameCard = [
                                                                                                'Knowledge Progress',
                                                                                                'Client Impact',
                                                                                                'Team Impact',
                                                                                                'Skill Progress',
                                                                                                'Material Progress - Pay & Benefits',
                                                                                                'Team & Leadership Ethics',
                                                                                                'Organization Impact',
                                                                                                'Societal Impact Size',
                                                                                                'Project Impact',
                                                                                                'Organization Culture',
                                                                                                'Character Culture',
                                                                                                'Role Progress',
                                                                                                'Task Impact',
                                                                                                'Social Progress',
                                                                                                'Social Positive Impact',
                                                                                                'Group/Team Culture'
                                                                                            ]

                                                                                            var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                                                            var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                                                            var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                                                            var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                                                            var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                                                            var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                                                            var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                                                            var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                                                            var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                                                            var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                                                            var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                                                            var satisfactionITemperatures = [];
                                                                                            satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                                                                [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                                                                [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                                                            document.getElementById("satisfaction-team").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                            document.getElementById("satisfaction-team-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                            satisfactionITemperatures.forEach(elem => {

                                                                                                var c = document.getElementById("satisfaction-team");
                                                                                                var ctx = c.getContext("2d");
                                                                                                ctx.beginPath();
                                                                                                ctx.fillStyle = "rgba(255, 255, 255)";
                                                                                                ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                                ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                                ctx.fill();

                                                                                                var cModal = document.getElementById("satisfaction-team-modal");
                                                                                                var ctxModal = cModal.getContext("2d");
                                                                                                ctxModal.beginPath();
                                                                                                ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                                                                ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                                ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                                ctxModal.fill();
                                                                                            })
                                                                                        }
                                                                                    })
                                                                                })
                                                                                .catch(error => console.log('error', error));
                                                                        }, 4000);
                                                                    })
                                                                    .catch(error => console.log('error', error));
                                                            }, 4000);
                                                        })
                                                        .catch(error => console.log('error', error));
                                                })
                                            })
                                        </script>
                                    @endif
                                @else
                                    <li><a style="cursor:pointer;" class="team-{{$sv->id}}-iTemp">{{$sv->name}}</a></li>
                                    <script>
                                        $(".team-{{$sv->id}}-iTemp").on("click", function(e)
                                        {
                                            e.preventDefault();
                                            $(".dropdown-teams-modal-iTemperature").css({
                                                "display": "none"
                                            })

                                            $(document).ready(function () {

                                                var myHeaders = new Headers();
                                                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                myHeaders.append("Content-Type", "application/json");

                                                var raw = JSON.stringify({
                                                    "format": "json",
                                                    "compress": false
                                                });

                                                var requestOptions = {
                                                    method: 'POST',
                                                    headers: myHeaders,
                                                    body: raw,
                                                    redirect: 'follow'
                                                };

                                                fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                                    .then(response => response.json())
                                                    .then(first => {
                                                        setTimeout(function () {
                                                            var myHeaders = new Headers();
                                                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                            myHeaders.append("Content-Type", "application/json");

                                                            var requestOptions = {
                                                                method: 'GET',
                                                                headers: myHeaders,
                                                                redirect: 'follow'
                                                            };

                                                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                                .then(response => response.json())
                                                                .then(second => {
                                                                    setTimeout(function () {
                                                                        var myHeaders = new Headers();
                                                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                        var requestOptions = {
                                                                            method: 'GET',
                                                                            headers: myHeaders,
                                                                            redirect: 'follow'
                                                                        };

                                                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                            .then(response => response.json())
                                                                            .then(result => {
                                                                                let responses = result["responses"];
                                                                                let reduced = (a, b) => a + b;

                                                                                let knoweledgeFirst = [];
                                                                                let knoweledgeSecond = [];
                                                                                let knoweledgeThird = [];

                                                                                let clientFirst = [];
                                                                                let clientSecond = [];
                                                                                let clientThird = [];

                                                                                let teamFirst = [];
                                                                                let teamSecond = [];
                                                                                let teamThird = [];

                                                                                let skillFirst = [];
                                                                                let skillSecond = [];
                                                                                let skillThird = [];

                                                                                let materialFirst = [];
                                                                                let materialSecond = [];
                                                                                let materialThird = [];

                                                                                let leadershipFirst = [];
                                                                                let leadershipSecond = [];
                                                                                let leadershipThird = [];

                                                                                let organizationFirst = [];
                                                                                let organizationSecond = [];
                                                                                let organizationThird = [];

                                                                                let societalFirst = [];
                                                                                let societalSecond = [];
                                                                                let societalThird = [];

                                                                                let projectFirst = [];
                                                                                let projectSecond = [];
                                                                                let projectThird = [];

                                                                                let organizationCultureFirst = [];
                                                                                let organizationCultureSecond = [];
                                                                                let organizationCultureThird = [];

                                                                                let characterFirst = [];
                                                                                let characterSecond = [];
                                                                                let characterThird = [];

                                                                                let objReportDate = [];
                                                                                responses.forEach(el => {
                                                                                    let sv = "{{$sv->name}}"
                                                                                    let department = "{{$department}}";
                                                                                    department = department.replace("&amp;", "&");
                                                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == sv) {
                                                                                        let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                                                        let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                                                        let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                                                        let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                                                        let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                                                        let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                                                        let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                                                        let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                                                        let pjFirst = el["values"]["QID30_1"];
                                                                                        let culFirst = el["values"]["QID31_1"];
                                                                                        let chFirst = el["values"]["QID32_1"];

                                                                                        let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                                                        let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                                                        let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                                                        let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                                                        let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                                                        let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                                                        let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                                                        let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                                                        let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                                                        let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                                                        let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                                                        let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                                                        let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                                                        let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                                                        let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                                                        let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                                                        let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                                                        let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                                                        let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                                                        let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                                                        let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                                                        let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                                                        knoweledgeFirst.push(knFirst);
                                                                                        knoweledgeSecond.push(knSecond);
                                                                                        knoweledgeThird.push(knThird);

                                                                                        skillFirst.push(skFirst);
                                                                                        skillSecond.push(skSecond);
                                                                                        skillThird.push(skThird);

                                                                                        clientFirst.push(clFirst);
                                                                                        clientSecond.push(clSecond);
                                                                                        clientThird.push(clThird);

                                                                                        teamFirst.push(tmFirst);
                                                                                        teamSecond.push(tmSecond);
                                                                                        teamThird.push(tmThird);

                                                                                        materialFirst.push(mtFirst);
                                                                                        materialSecond.push(mtSecond);
                                                                                        materialThird.push(mtThird);

                                                                                        leadershipFirst.push(ldFirst);
                                                                                        leadershipSecond.push(ldSecond);
                                                                                        leadershipThird.push(ldThird);

                                                                                        organizationFirst.push(orgFirst);
                                                                                        organizationSecond.push(orgSecond);
                                                                                        organizationThird.push(orgThird);

                                                                                        societalFirst.push(scFirst);
                                                                                        societalSecond.push(scSecond);
                                                                                        societalThird.push(scThird);

                                                                                        projectFirst.push(pjFirst);
                                                                                        projectSecond.push(pjSecond);
                                                                                        projectThird.push(pjThird);

                                                                                        organizationCultureFirst.push(culFirst);
                                                                                        organizationCultureSecond.push(culSecond);
                                                                                        organizationCultureThird.push(culThird);

                                                                                        characterFirst.push(chFirst);
                                                                                        characterSecond.push(chSecond);
                                                                                        characterThird.push(chThird);

                                                                                        /*GAP REPORT LOGIC CODE*/

                                                                                        /*GAP RAPORT*/
                                                                                        let arrayNameCard = [
                                                                                            'Knowledge Progress',
                                                                                            'Client Impact',
                                                                                            'Team Impact',
                                                                                            'Skill Progress',
                                                                                            'Material Progress - Pay & Benefits',
                                                                                            'Team & Leadership Ethics',
                                                                                            'Organization Impact',
                                                                                            'Societal Impact Size',
                                                                                            'Project Impact',
                                                                                            'Organization Culture',
                                                                                            'Character Culture',
                                                                                            'Role Progress',
                                                                                            'Task Impact',
                                                                                            'Social Progress',
                                                                                            'Social Positive Impact',
                                                                                            'Group/Team Culture'
                                                                                        ]

                                                                                        var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                                                        var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                                                        var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                                                        var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                                                        var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                                                        var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                                                        var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                                                        var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                                                        var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                                                        var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                                                        var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                                                        var satisfactionITemperatures = [];
                                                                                        satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                                                            [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                                                            [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                                                        document.getElementById("satisfaction-team").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                        document.getElementById("satisfaction-team-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                                                        satisfactionITemperatures.forEach(elem => {

                                                                                            var c = document.getElementById("satisfaction-team");
                                                                                            var ctx = c.getContext("2d");
                                                                                            ctx.beginPath();
                                                                                            ctx.fillStyle = "rgba(255, 255, 255)";
                                                                                            ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                            ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                            ctx.fill();

                                                                                            var cModal = document.getElementById("satisfaction-team-modal");
                                                                                            var ctxModal = cModal.getContext("2d");
                                                                                            ctxModal.beginPath();
                                                                                            ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                                                            ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                                                            ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                                                            ctxModal.fill();
                                                                                        })
                                                                                    }
                                                                                })
                                                                            })
                                                                            .catch(error => console.log('error', error));
                                                                    }, 4000);
                                                                })
                                                                .catch(error => console.log('error', error));
                                                        }, 4000);
                                                    })
                                                    .catch(error => console.log('error', error));
                                            })
                                        })
                                    </script>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown-departments-modal">
            <div class="dropdown-departments-content" style="width: 30%; height: 60vh;"><br />
                <div class="dropdown-departments-content-text">
                    <span style="margin-left: 90%; margin-bottom: 10px; margin-top: -30px; cursor: pointer"><img class="close-dropdown" src="https://www.svgrepo.com/download/32011/close-button.svg" width="30px;"></span>
                    <div class="dropdown-departments-text" style="text-align: center">
                        <ul style="list-style: none;">
                            @foreach($departments as $department_title)
                                <li><a style="cursor:pointer;" class="department-{{$department_title->id}}">{{$department_title->department}}</a></li>
                                <script>
                                    $(".department-{{$department_title->id}}").on("click", function(e)
                                    {
                                        e.preventDefault();
                                        $(".dropdown-departments-modal").css({
                                            "display": "none"
                                        })

                                        var myHeaders = new Headers();
                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                        myHeaders.append("Content-Type", "application/json");

                                        var raw = JSON.stringify({
                                            "format": "json",
                                            "compress": false
                                        });

                                        var requestOptions = {
                                            method: 'POST',
                                            headers: myHeaders,
                                            body: raw,
                                            redirect: 'follow'
                                        };

                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                            .then(response => response.json())
                                            .then(first => {
                                                setTimeout(function () {
                                                    var myHeaders = new Headers();
                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                    myHeaders.append("Content-Type", "application/json");

                                                    var requestOptions = {
                                                        method: 'GET',
                                                        headers: myHeaders,
                                                        redirect: 'follow'
                                                    };

                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                        .then(response => response.json())
                                                        .then(second => {
                                                            setTimeout(function () {
                                                                var myHeaders = new Headers();
                                                                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                var requestOptions = {
                                                                    method: 'GET',
                                                                    headers: myHeaders,
                                                                    redirect: 'follow'
                                                                };

                                                                fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                    .then(response => response.json())
                                                                    .then(result => {
                                                                        let responses = result["responses"];
                                                                        responses.forEach(el => {
                                                                            let department = "{{$department_title->department}}";
                                                                            department = department.replace("&amp;", "&");
                                                                            if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID63_TEXT"] == department) {
                                                                                let societal = el["values"]["QID3_1"];
                                                                                let client = el["values"]["QID4_1"];
                                                                                let knowledge = el["values"]["QID12_1"];
                                                                                let team = el["values"]["QID55_1"];
                                                                                let organization = el["values"]["QID60_1"];
                                                                                let leadership = el["values"]["QID54_1"];
                                                                                let progress = el["values"]["QID50_1"];
                                                                                let skill = el["values"]["QID4_1"];
                                                                                let organizationCulture = el["values"]["QID15_1"];
                                                                                let character = el["values"]["QID14_1"];
                                                                                let project = el["values"]["QID7_6"];

                                                                                let SatisfactionIndicatorArray = [
                                                                                    [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                                                    [client, "Client", 3], [team, "Team Impact", 4],
                                                                                    [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                                                    [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                                                    [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                                                ]

                                                                                document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                                                                                document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                                                var c = document.getElementById("bubble-department");
                                                                                var ctx = c.getContext("2d");

                                                                                var cModal = document.getElementById("bubble-department-modal");
                                                                                var ctxModal = cModal.getContext("2d");

                                                                                SatisfactionIndicatorArray.forEach(xY => {
                                                                                    ctx.beginPath();
                                                                                    ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                    ctx.font = "bold 8px verdana, sans-serif";
                                                                                    ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                    ctx.fill();

                                                                                    ctxModal.beginPath();
                                                                                    ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                    ctxModal.font = "bold 8px verdana, sans-serif";
                                                                                    ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                    ctxModal.fill();
                                                                                })
                                                                            }
                                                                        })
                                                                    })
                                                                    .catch(error => console.log('error', error));
                                                            }, 4000);
                                                        })
                                                        .catch(error => console.log('error', error));
                                                }, 4000);
                                            })
                                            .catch(error => console.log('error', error));
                                    })
                                </script>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="dropdown-teams-modal">
            <div class="dropdown-teams-content" style="width: 30%; height: 60vh;"><br />
                <div class="dropdown-teams-content-text">
                    <span style="margin-left: 90%; margin-bottom: 10px; margin-top: -30px; cursor: pointer"><img class="close-dropdown" src="https://www.svgrepo.com/download/32011/close-button.svg" width="30px;"></span>
                    <div class="dropdown-teams-text" style="text-align: center">
                        <ul style="list-style: none;">
                            @foreach($teamleads as $sv)
                                @if(Auth::user()->chief === "yes")
                                    @if($sv->department === $department)
                                        <li><a style="cursor:pointer;" class="team-{{$sv->id}}">{{$sv->name}}</a></li>
                                        <script>
                                            $(".team-{{$sv->id}}").on("click", function(e)
                                            {
                                                e.preventDefault();
                                                $(".dropdown-teams-modal").css({
                                                    "display": "none"
                                                })

                                                var myHeaders = new Headers();
                                                myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                myHeaders.append("Content-Type", "application/json");

                                                var raw = JSON.stringify({
                                                    "format": "json",
                                                    "compress": false
                                                });

                                                var requestOptions = {
                                                    method: 'POST',
                                                    headers: myHeaders,
                                                    body: raw,
                                                    redirect: 'follow'
                                                };

                                                fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                                    .then(response => response.json())
                                                    .then(first => {
                                                        setTimeout(function () {
                                                            var myHeaders = new Headers();
                                                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                            myHeaders.append("Content-Type", "application/json");

                                                            var requestOptions = {
                                                                method: 'GET',
                                                                headers: myHeaders,
                                                                redirect: 'follow'
                                                            };

                                                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                                .then(response => response.json())
                                                                .then(second => {
                                                                    setTimeout(function () {
                                                                        var myHeaders = new Headers();
                                                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                        var requestOptions = {
                                                                            method: 'GET',
                                                                            headers: myHeaders,
                                                                            redirect: 'follow'
                                                                        };

                                                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                            .then(response => response.json())
                                                                            .then(result => {
                                                                                let responses = result["responses"];
                                                                                responses.forEach(el => {
                                                                                    let sv = "{{$sv->name}}"
                                                                                    let department = "{{$department}}";
                                                                                    department = department.replace("&amp;", "&");
                                                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == sv && el["values"]["QID63_TEXT"] == department) {
                                                                                        let societal = el["values"]["QID3_1"];
                                                                                        let client = el["values"]["QID4_1"];
                                                                                        let knowledge = el["values"]["QID12_1"];
                                                                                        let team = el["values"]["QID55_1"];
                                                                                        let organization = el["values"]["QID60_1"];
                                                                                        let leadership = el["values"]["QID54_1"];
                                                                                        let progress = el["values"]["QID50_1"];
                                                                                        let skill = el["values"]["QID4_1"];
                                                                                        let organizationCulture = el["values"]["QID15_1"];
                                                                                        let character = el["values"]["QID14_1"];
                                                                                        let project = el["values"]["QID7_6"];

                                                                                        let SatisfactionIndicatorArray = [
                                                                                            [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                                                            [client, "Client", 3], [team, "Team Impact", 4],
                                                                                            [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                                                            [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                                                            [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                                                        ]

                                                                                        document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                                                                                        document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                                                        var c = document.getElementById("bubble-team");
                                                                                        var ctx = c.getContext("2d");

                                                                                        var cModal = document.getElementById("bubble-team-modal");
                                                                                        var ctxModal = cModal.getContext("2d");

                                                                                        SatisfactionIndicatorArray.forEach(xY => {
                                                                                            ctx.beginPath();
                                                                                            ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                            ctx.font = "bold 8px verdana, sans-serif";
                                                                                            ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                            ctx.fill();

                                                                                            ctxModal.beginPath();
                                                                                            ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                            ctxModal.font = "bold 8px verdana, sans-serif";
                                                                                            ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                            ctxModal.fill();
                                                                                        })
                                                                                    }
                                                                                })
                                                                            })
                                                                            .catch(error => console.log('error', error));
                                                                    }, 4000);
                                                                })
                                                                .catch(error => console.log('error', error));
                                                        }, 4000);
                                                    })
                                                    .catch(error => console.log('error', error));
                                            })
                                        </script>
                                    @endif
                                @else
                                    <li><a style="cursor:pointer;" class="team-{{$sv->id}}">{{$sv->name}}</a></li>
                                    <script>
                                        $(".team-{{$sv->id}}").on("click", function(e)
                                        {
                                            e.preventDefault();
                                            $(".dropdown-teams-modal").css({
                                                "display": "none"
                                            })

                                            var myHeaders = new Headers();
                                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                            myHeaders.append("Content-Type", "application/json");

                                            var raw = JSON.stringify({
                                                "format": "json",
                                                "compress": false
                                            });

                                            var requestOptions = {
                                                method: 'POST',
                                                headers: myHeaders,
                                                body: raw,
                                                redirect: 'follow'
                                            };

                                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                                .then(response => response.json())
                                                .then(first => {
                                                    setTimeout(function () {
                                                        var myHeaders = new Headers();
                                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                                        myHeaders.append("Content-Type", "application/json");

                                                        var requestOptions = {
                                                            method: 'GET',
                                                            headers: myHeaders,
                                                            redirect: 'follow'
                                                        };

                                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                                            .then(response => response.json())
                                                            .then(second => {
                                                                setTimeout(function () {
                                                                    var myHeaders = new Headers();
                                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                                    var requestOptions = {
                                                                        method: 'GET',
                                                                        headers: myHeaders,
                                                                        redirect: 'follow'
                                                                    };

                                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                                        .then(response => response.json())
                                                                        .then(result => {
                                                                            let responses = result["responses"];
                                                                            responses.forEach(el => {
                                                                                let sv = "{{$sv->name}}"
                                                                                let department = "{{$department}}";
                                                                                department = department.replace("&amp;", "&");
                                                                                if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == sv) {
                                                                                    let societal = el["values"]["QID3_1"];
                                                                                    let client = el["values"]["QID4_1"];
                                                                                    let knowledge = el["values"]["QID12_1"];
                                                                                    let team = el["values"]["QID55_1"];
                                                                                    let organization = el["values"]["QID60_1"];
                                                                                    let leadership = el["values"]["QID54_1"];
                                                                                    let progress = el["values"]["QID50_1"];
                                                                                    let skill = el["values"]["QID4_1"];
                                                                                    let organizationCulture = el["values"]["QID15_1"];
                                                                                    let character = el["values"]["QID14_1"];
                                                                                    let project = el["values"]["QID7_6"];

                                                                                    let SatisfactionIndicatorArray = [
                                                                                        [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                                                        [client, "Client", 3], [team, "Team Impact", 4],
                                                                                        [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                                                        [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                                                        [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                                                    ]

                                                                                    document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                                                                                    document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                                                    var c = document.getElementById("bubble-team");
                                                                                    var ctx = c.getContext("2d");

                                                                                    var cModal = document.getElementById("bubble-team-modal");
                                                                                    var ctxModal = cModal.getContext("2d");

                                                                                    SatisfactionIndicatorArray.forEach(xY => {
                                                                                        ctx.beginPath();
                                                                                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                        ctx.font = "bold 8px verdana, sans-serif";
                                                                                        ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                        ctx.fill();

                                                                                        ctxModal.beginPath();
                                                                                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                                        ctxModal.font = "bold 8px verdana, sans-serif";
                                                                                        ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                                        ctxModal.fill();
                                                                                    })
                                                                                }
                                                                            })
                                                                        })
                                                                        .catch(error => console.log('error', error));
                                                                }, 4000);
                                                            })
                                                            .catch(error => console.log('error', error));
                                                    }, 4000);
                                                })
                                                .catch(error => console.log('error', error));
                                        })
                                    </script>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(Auth::user()->password == 'user')
        <div id="modalChangePassword" class="modalChangePassword" style="top: -40px; overflow-y: hidden;">
            <div class="modal-content" style="width: 30%; height: 60vh;"><br />
                <div class="modal-content-text">
                    <div class="modal-text">
                        <form action="/home/updatePassword/{{Auth::user()->email}}" method="POST">
                            @csrf
                            <label class="form-label">Company title: </label>
                            <input type="text" name="company_title" class="form-control company_title">
                            <br />
                            <label class="form-label">New password: </label>
                            <input type="password" name="new_password" class="form-control password">
                            <br />
                            <label class="form-label">Confirm password: </label>
                            <input type="password" name="confirm_password" class="form-control confirm_password">
                            <br />
                            <br />
                            <button type="submit" class="modal-button btn btn-primary buttonForConfirm"><span class="modal-btn">Confirm</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Hash::check(Auth::user()->email, Auth::user()->password))
        <div id="modalChangePassword" class="modalChangePassword" style="top: -40px; overflow-y: hidden;">
            <div class="modal-content" style="width: 30%; height: 60vh;"><br />
                <div class="modal-content-text">
                    <div class="modal-text">
                        <form action="/home/updatePassword/{{Auth::user()->email}}" method="POST">
                            @csrf
                            <label class="form-label">Company title: </label>
                            <input type="text" name="company_title" value="{{Auth::user()->company_title}}" class="form-control company_title">
                            <br />
                            <label class="form-label">New password: </label>
                            <input type="password" name="new_password" class="form-control password">
                            <br />
                            <label class="form-label">Confirm password: </label>
                            <input type="password" name="confirm_password" class="form-control confirm_password">
                            <br />
                            <br />
                            <button type="submit" class="modal-button btn btn-primary buttonForConfirm"><span class="modal-btn">Confirm</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="home-main">
        <div class="home-container">
            @if(Auth::user()->admin === "yes")
                <div style="display: flex; align-content: center; justify-content: center; padding: 5px;">
                    <select class="existCompanies form-select" style="width: 300px;">
                        <option value="Choose company:" selected disabled>Check company:</option>
                        @foreach($companies as $company)
                            <option value="{{$company->title}}">{{$company->title}}</option>
                        @endforeach
                    </select><br />
                    <a href="" class="btn btn-primary getCompanyResults" style="margin-left: 7px;">Get data</a>
                    <a href="" class="btn btn-secondary disabled getCompanyResultsDisabled" tabindex="-1" role="button" aria-disabled="true" style="display: none; margin-left: 7px;">Get data</a>
                </div>

                <script>
                    $(".getCompanyResults").on("click", function(e)
                    {
                        $(".getCompanyResults").css("display", "none");
                        $(".getCompanyResultsDisabled").css("display", "block");
                        $(".existCompanies").attr("disabled", true);
                        e.preventDefault();
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-center",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "10000",
                            "extendedTimeOut": "10000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                        toastr["success"]("Please, check some seconds ...", "OK!")

                        // teams chart
                        $(document).ready(function()
                        {
                            var myHeaders = new Headers();
                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                            myHeaders.append("Content-Type", "application/json");

                            var raw = JSON.stringify({
                                "format": "json",
                                "compress": false
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: myHeaders,
                                body: raw,
                                redirect: 'follow'
                            };

                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                .then(response => response.json())
                                .then(first =>
                                {
                                    setTimeout(function()
                                    {
                                        var myHeaders = new Headers();
                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                        myHeaders.append("Content-Type", "application/json");

                                        var requestOptions = {
                                            method: 'GET',
                                            headers: myHeaders,
                                            redirect: 'follow'
                                        };

                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                            .then(response => response.json())
                                            .then(second => {
                                                setTimeout(function()
                                                {
                                                    var myHeaders = new Headers();
                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                    var requestOptions = {
                                                        method: 'GET',
                                                        headers: myHeaders,
                                                        redirect: 'follow'
                                                    };

                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                        .then(response => response.json())
                                                        .then(result => {
                                                            var responses = result["responses"];

                                                            let canvasTeams = document.getElementById("teamsChart");
                                                            let ctxTeams = canvasTeams.getContext("2d");
                                                            ctxTeams.clearRect(0, 0, 340, 343);

                                                            let canvasTeamsModal = document.getElementById("teamsChart-modal");
                                                            let ctxTeamsModal = canvasTeamsModal.getContext("2d");
                                                            ctxTeamsModal.clearRect(0, 0, 340, 343);

                                                            responses.forEach(el =>
                                                            {
                                                                if(el["values"]["QID101_TEXT"] === $(".existCompanies").val())
                                                                {
                                                                    let firstTeamsChart = isNaN((el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1))?0:(el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1);

                                                                    let secondTeamsChart = isNaN(el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"])?0:el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"];

                                                                    let thirdTeamsChart = isNaN((el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1))?0:(el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1);

                                                                    let sumTeamsChart = firstTeamsChart + secondTeamsChart + thirdTeamsChart;

                                                                    let cTeamsChart = document.getElementById("teamsChart-modal");
                                                                    let ctxTeamsChart = cTeamsChart.getContext("2d");
                                                                    let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                                                                    ctxTeamsChart.beginPath();

                                                                    ctxTeamsChart.fillStyle = "white";
                                                                    ctxTeamsChart.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                                    ctxTeamsChart.fill()

                                                                    ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                                                                    ctxTextTeamsChart.fillStyle = "black";

                                                                    let str = el["values"]["QID62_TEXT"];
                                                                    let from = str.search('@');
                                                                    let answer = str.substring(0,from);

                                                                    ctxTextTeamsChart.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)

                                                                    let c = document.getElementById("teamsChart");
                                                                    let ctx = c.getContext("2d");
                                                                    let ctxText = c.getContext("2d");
                                                                    ctx.beginPath();

                                                                    ctx.fillStyle = "white";
                                                                    ctx.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                                    ctx.fill()

                                                                    ctxText.font = "bold 12px verdana, sans-serif ";
                                                                    ctxText.fillStyle = "black";
                                                                    // let str1 = el["values"]["QID62_TEXT"];
                                                                    // let from1= str1.search('@');
                                                                    // let answer1 = str1.substring(0,from1);
                                                                    ctxText.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)
                                                                }
                                                            })
                                                        })
                                                        .catch(error => console.log('error', error));
                                                }, 4000);
                                            })
                                            .catch(error => console.log('error', error));
                                    }, 4000);
                                })
                                .catch(error => console.log('error', error));
                        })
                        // end teams chart

                        // gap report and satisfaction itemperature
                        $(document).ready(function()
                        {
                            var myHeaders = new Headers();
                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                            myHeaders.append("Content-Type", "application/json");

                            var raw = JSON.stringify({
                                "format": "json",
                                "compress": false
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: myHeaders,
                                body: raw,
                                redirect: 'follow'
                            };

                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                .then(response => response.json())
                                .then(first =>
                                {
                                    setTimeout(function()
                                    {
                                        var myHeaders = new Headers();
                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                        myHeaders.append("Content-Type", "application/json");

                                        var requestOptions = {
                                            method: 'GET',
                                            headers: myHeaders,
                                            redirect: 'follow'
                                        };

                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                            .then(response => response.json())
                                            .then(second => {
                                                setTimeout(function()
                                                {
                                                    var myHeaders = new Headers();
                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                    var requestOptions = {
                                                        method: 'GET',
                                                        headers: myHeaders,
                                                        redirect: 'follow'
                                                    };

                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                        .then(response => response.json())
                                                        .then(result => {
                                                            $(".box-4").empty(); $(".modal-content-flex-4").empty();

                                                            let canvasSatisfactionCompany = document.getElementById("satisfaction-company");
                                                            let ctxSatisfactionCompany = canvasSatisfactionCompany.getContext("2d");
                                                            ctxSatisfactionCompany.clearRect(0, 0, 810, 180);

                                                            let canvasSatisfactionCompanyModal = document.getElementById("satisfaction-company-modal");
                                                            let ctxSatisfactionCompanyModal = canvasSatisfactionCompanyModal.getContext("2d");
                                                            ctxSatisfactionCompanyModal.clearRect(0, 0, 810, 180);

                                                            let responses = result["responses"];
                                                            let reduced = (a, b) => a + b;

                                                            let knoweledgeFirst = [];
                                                            let knoweledgeSecond = [];
                                                            let knoweledgeThird = [];

                                                            let clientFirst = [];
                                                            let clientSecond = [];
                                                            let clientThird = [];

                                                            let teamFirst = [];
                                                            let teamSecond = [];
                                                            let teamThird = [];

                                                            let skillFirst = [];
                                                            let skillSecond = [];
                                                            let skillThird = [];

                                                            let materialFirst = [];
                                                            let materialSecond = [];
                                                            let materialThird = [];

                                                            let leadershipFirst = [];
                                                            let leadershipSecond = [];
                                                            let leadershipThird = [];

                                                            let organizationFirst = [];
                                                            let organizationSecond = [];
                                                            let organizationThird = [];

                                                            let societalFirst = [];
                                                            let societalSecond = [];
                                                            let societalThird = [];

                                                            let projectFirst = [];
                                                            let projectSecond = [];
                                                            let projectThird = [];

                                                            let organizationCultureFirst = [];
                                                            let organizationCultureSecond = [];
                                                            let organizationCultureThird = [];

                                                            let characterFirst = [];
                                                            let characterSecond = [];
                                                            let characterThird = [];

                                                            function test4(id) {
                                                                $('#box-4').append(`
                                                                        <div class="panel-report ${id}">
                                                                            <div class="progress-report">
                                                                                <div id="target" class="target"></div>
                                                                                <div id="limit" class="limit"></div>
                                                                                <div id="progress-done" class="progress-done"></div>
                                                                            </div>
                                                                            <div class="panel-report-1">
                                                                                <div class="panel-report-degrees">0</div>
                                                                                <div class="panel-report-info">
                                                                                    <div class="panel-report-name"></div>
                                                                                    <div class="panel-report-rates">0</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        `)
                                                            }


                                                            let objReportDate = [];
                                                            responses.forEach(el =>
                                                            {
                                                                if(el["values"]["QID101_TEXT"] == $('.existCompanies').val())
                                                                {
                                                                    let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                                    let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                                    let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                                    let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                                    let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                                    let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                                    let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                                    let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                                    let pjFirst = el["values"]["QID30_1"];
                                                                    let culFirst = el["values"]["QID31_1"];
                                                                    let chFirst = el["values"]["QID32_1"];

                                                                    let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                                    let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                                    let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                                    let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                                    let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                                    let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                                    let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                                    let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                                    let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                                    let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                                    let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                                    let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                                    let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                                    let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                                    let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                                    let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                                    let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                                    let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                                    let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                                    let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                                    let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                                    let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                                    knoweledgeFirst.push(knFirst);
                                                                    knoweledgeSecond.push(knSecond);
                                                                    knoweledgeThird.push(knThird);

                                                                    skillFirst.push(skFirst);
                                                                    skillSecond.push(skSecond);
                                                                    skillThird.push(skThird);

                                                                    clientFirst.push(clFirst);
                                                                    clientSecond.push(clSecond);
                                                                    clientThird.push(clThird);

                                                                    teamFirst.push(tmFirst);
                                                                    teamSecond.push(tmSecond);
                                                                    teamThird.push(tmThird);

                                                                    materialFirst.push(mtFirst);
                                                                    materialSecond.push(mtSecond);
                                                                    materialThird.push(mtThird);

                                                                    leadershipFirst.push(ldFirst);
                                                                    leadershipSecond.push(ldSecond);
                                                                    leadershipThird.push(ldThird);

                                                                    organizationFirst.push(orgFirst);
                                                                    organizationSecond.push(orgSecond);
                                                                    organizationThird.push(orgThird);

                                                                    societalFirst.push(scFirst);
                                                                    societalSecond.push(scSecond);
                                                                    societalThird.push(scThird);

                                                                    projectFirst.push(pjFirst);
                                                                    projectSecond.push(pjSecond);
                                                                    projectThird.push(pjThird);

                                                                    organizationCultureFirst.push(culFirst);
                                                                    organizationCultureSecond.push(culSecond);
                                                                    organizationCultureThird.push(culThird);

                                                                    characterFirst.push(chFirst);
                                                                    characterSecond.push(chSecond);
                                                                    characterThird.push(chThird);

                                                                    /*GAP REPORT LOGIC CODE*/

                                                                    /*GAP RAPORT*/
                                                                    let arrayNameCard = [
                                                                        'Knowledge Progress',
                                                                        'Client Impact',
                                                                        'Team Impact',
                                                                        'Skill Progress',
                                                                        'Material Progress - Pay & Benefits',
                                                                        'Team & Leadership Ethics',
                                                                        'Organization Impact',
                                                                        'Societal Impact Size',
                                                                        'Project Impact',
                                                                        'Organization Culture',
                                                                        'Character Culture',
                                                                        'Role Progress',
                                                                        'Task Impact',
                                                                        'Social Progress',
                                                                        'Social Positive Impact',
                                                                        'Group/Team Culture'
                                                                    ]

                                                                    function letLimit(a) {
                                                                        let b = 0;
                                                                        if(a <= 10) {
                                                                            b = 10;
                                                                            return b;
                                                                        } else if(a > 10 && a <= 20) {
                                                                            b = 20;
                                                                            return b;
                                                                        } else if(a > 20 && a <= 30) {
                                                                            b = 30;
                                                                            return b;
                                                                        } else if(a > 30 && a <= 40) {
                                                                            b = 40;
                                                                            return b;
                                                                        } else if(a > 40 && a <= 50) {
                                                                            b = 50;
                                                                            return b;
                                                                        } else if(a > 50 && a <= 60) {
                                                                            b = 60;
                                                                            return b;
                                                                        } else if(a > 60 && a <= 70) {
                                                                            b = 70;
                                                                            return b;
                                                                        } else if(a > 70 && a <= 80) {
                                                                            b = 80;
                                                                            return b;
                                                                        } else if(a > 80 && a <= 90) {
                                                                            b = 90;
                                                                            return b;
                                                                        } else {
                                                                            b = 100;
                                                                            return b;
                                                                        }
                                                                    }

                                                                    objReportDate = [
                                                                        {
                                                                            input: `${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`,
                                                                            inputProgress: `${Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                            nameCard: arrayNameCard[0]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`,
                                                                            inputProgress: `${Math.floor((clientSecond.reduce(reduced) / clientSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                            nameCard: arrayNameCard[1]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`,
                                                                            inputProgress: `${Math.floor((teamSecond.reduce(reduced) / teamSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                            nameCard: arrayNameCard[2]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`,
                                                                            inputProgress: `${Math.floor((skillSecond.reduce(reduced) / skillSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                            nameCard: arrayNameCard[3]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`,
                                                                            inputProgress: `${Math.floor((materialSecond.reduce(reduced) / materialSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                            nameCard: arrayNameCard[4]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`,
                                                                            inputProgress: `${Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                            nameCard: arrayNameCard[5]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`,
                                                                            inputProgress: `${Math.floor((organizationSecond.reduce(reduced) / organizationSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                            nameCard: arrayNameCard[6]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`,
                                                                            inputProgress: `${Math.floor((societalSecond.reduce(reduced) / societalSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                            nameCard: arrayNameCard[7]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`,
                                                                            inputProgress: `${Math.floor((projectSecond.reduce(reduced) / projectSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                            nameCard: arrayNameCard[8]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`,
                                                                            inputProgress: `${Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                            nameCard: arrayNameCard[9]
                                                                        },
                                                                        {
                                                                            input: `${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`,
                                                                            inputProgress: `${Math.floor((characterSecond.reduce(reduced) / characterSecond.length))}`,
                                                                            maxInput: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                            maxInputProgress: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                            nameCard: arrayNameCard[10]
                                                                        }
                                                                    ]

                                                                    /*END GAP REPORT LOGIC CODE*/

                                                                    var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced)/knoweledgeSecond.length)-(knoweledgeThird.reduce(reduced)/knoweledgeThird.length));
                                                                    var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced)/clientSecond.length)-(clientThird.reduce(reduced)/clientThird.length))
                                                                    var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced)/teamSecond.length)-(teamThird.reduce(reduced)/teamThird.length))
                                                                    var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced)/skillSecond.length)-(skillThird.reduce(reduced)/skillThird.length))
                                                                    var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced)/materialSecond.length)-(materialThird.reduce(reduced)/materialThird.length))
                                                                    var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced)/leadershipSecond.length)-(leadershipThird.reduce(reduced)/leadershipThird.length))
                                                                    var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced)/organizationSecond.length)-(organizationThird.reduce(reduced)/organizationThird.length))
                                                                    var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced)/societalSecond.length)-(societalThird.reduce(reduced)/societalThird.length))
                                                                    var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced)/projectSecond.length)-(projectThird.reduce(reduced)/projectThird.length))
                                                                    var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced)/organizationCultureSecond.length)-(organizationCultureThird.reduce(reduced)/organizationCultureThird.length))
                                                                    var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced)/characterSecond.length)-(characterThird.reduce(reduced)/characterThird.length))

                                                                    var satisfactionITemperatures = [];
                                                                    satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                                        [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                                        [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                                    document.getElementById("satisfaction-company").getContext("2d").clearRect(0, 0, 810, 180);
                                                                    document.getElementById("satisfaction-company-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                                    satisfactionITemperatures.forEach(elem =>
                                                                    {

                                                                        var c = document.getElementById("satisfaction-company");
                                                                        var ctx = c.getContext("2d");
                                                                        ctx.beginPath();
                                                                        ctx.fillStyle = "rgba(255, 255, 255)";
                                                                        ctx.fillText(elem[1], (elem[0] === 0)?420:420 + (elem[0]*43), (13*elem[3]));
                                                                        ctx.arc((elem[0] === 0)?410:410 + (elem[0]*43), 13*elem[3], 7, 0, 2 * Math.PI);
                                                                        ctx.fill();

                                                                        var cModal = document.getElementById("satisfaction-company-modal");
                                                                        var ctxModal = cModal.getContext("2d");
                                                                        ctxModal.beginPath();
                                                                        ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                                        ctxModal.fillText(elem[1], (elem[0] === 0)?420:420 + (elem[0]*43), (13*elem[3]));
                                                                        ctxModal.arc((elem[0] === 0)?410:410 + (elem[0]*43), 13*elem[3], 7, 0, 2 * Math.PI);
                                                                        ctxModal.fill();
                                                                    })
                                                                }
                                                            })
                                                            if(typeof(objReportDate[0]) !== 'undefined')
                                                            {
                                                                objReportDate.sort((a, b) => b.input - a.input).sort((a, b) => (a.input - a.inputProgress) - (b.input - b.inputProgress))

                                                                for (let i = 0; i <= objReportDate.length - 1; i++) {
                                                                    test4(i)

                                                                    let formGapReport = $(`.${i}`)
                                                                    let target = formGapReport.get(0).querySelector('.target')
                                                                    let limit = formGapReport.get(0).querySelector('.limit')
                                                                    let progress = formGapReport.get(0).querySelector('.progress-done')
                                                                    let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
                                                                    let out2 = formGapReport.get(0).querySelector(".panel-report-name");
                                                                    let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
                                                                    let finalValue = 0
                                                                    let max = 0;

                                                                    // console.log(`${i})`,'objReportDate: ',objReportDate[i]);

                                                                    setMaxWidth();

                                                                    function setMaxWidth() {
                                                                        max = parseInt(objReportDate[i].maxInput, 10);
                                                                        max = parseInt(objReportDate[i].maxInputProgress, 10);

                                                                        setLimit()
                                                                    }

                                                                    function setLimit() {
                                                                        finalValue = parseInt(objReportDate[i].input, 10);
                                                                        changeWidth(target)
                                                                        changeWidth(limit)
                                                                        setTarget()
                                                                    }

                                                                    function setTarget() {
                                                                        finalValue = parseInt(objReportDate[i].inputProgress, 10);
                                                                        changeWidth(progress)
                                                                    }

                                                                    function changeWidth(obj) {
                                                                        obj.style.width = `${(finalValue / max) * 100}%`;
                                                                        out()
                                                                    }

                                                                    function out() {
                                                                        out2.innerHTML = `${objReportDate[i].nameCard}`;
                                                                        if (objReportDate[i].input === objReportDate[i].inputProgress) {
                                                                            out1.innerHTML = `${objReportDate[i].input}`;
                                                                            out3.innerHTML = '✓';

                                                                            if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#10582D";
                                                                                target.style.background = "rgba(0,255,100,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#55D98A 2.94%'
                                                                                    + ", "
                                                                                    + '#B6EDB1 61.71%'
                                                                                    + ", "
                                                                                    + 'rgba(213, 243, 189, 0.86) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#D88E20";
                                                                                target.style.background = "rgba(255,202,0,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + 'rgba(255, 148, 50, 0.97) -19.19%'
                                                                                    + ", "
                                                                                    + 'rgba(252, 182, 77, 0.97) 9.81%'
                                                                                    + ", "
                                                                                    + 'rgba(250, 209, 105, 0.36) 61.71%'
                                                                                    + ", "
                                                                                    + 'rgba(255, 246, 213, 0.19) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#5e5e5e";
                                                                                target.style.background = "rgba(187,187,187,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#BFBFBF -5.46%'
                                                                                    + ", "
                                                                                    + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                                                                    + ", "
                                                                                    + 'rgba(241, 241, 241, 0) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#0A8899";
                                                                                target.style.background = "rgba(0,226,255,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#63E4F4 -19.19%'
                                                                                    + ", "
                                                                                    + '#7CDEEB 9.81%'
                                                                                    + ", "
                                                                                    + '#C5F7FC 61.71%'
                                                                                    + ", "
                                                                                    + '#F0FEFF 127.35%'
                                                                                    + ")";
                                                                            }

                                                                        } else {
                                                                            out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;

                                                                            if (objReportDate[i].inputProgress > objReportDate[i].input) {
                                                                                let a = objReportDate[i].input;
                                                                                let b = objReportDate[i].inputProgress;
                                                                                let c = b - a;
                                                                                out3.innerHTML = `${c}`;
                                                                            } else if (objReportDate[i].inputProgress < objReportDate[i].input) {
                                                                                let a = objReportDate[i].input;
                                                                                let b = objReportDate[i].inputProgress;
                                                                                let c = a - b
                                                                                out3.innerHTML = `${c * (-1)}`;
                                                                            }
                                                                            if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#10582D";
                                                                                target.style.background = "rgba(0,255,100,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#55D98A 2.94%'
                                                                                    + ", "
                                                                                    + '#B6EDB1 61.71%'
                                                                                    + ", "
                                                                                    + 'rgba(213, 243, 189, 0.86) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#D88E20";
                                                                                target.style.background = "rgba(255,202,0,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + 'rgba(255, 148, 50, 0.97) -19.19%'
                                                                                    + ", "
                                                                                    + 'rgba(252, 182, 77, 0.97) 9.81%'
                                                                                    + ", "
                                                                                    + 'rgba(250, 209, 105, 0.36) 61.71%'
                                                                                    + ", "
                                                                                    + 'rgba(255, 246, 213, 0.19) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#5e5e5e";
                                                                                target.style.background = "rgba(187,187,187,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#BFBFBF -5.46%'
                                                                                    + ", "
                                                                                    + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                                                                    + ", "
                                                                                    + 'rgba(241, 241, 241, 0) 127.35%'
                                                                                    + ")";
                                                                            } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                                                                limit.style.borderRightWidth = "2px";
                                                                                limit.style.borderRightStyle = "solid";
                                                                                limit.style.borderRightColor = "#0A8899";
                                                                                target.style.background = "rgba(0,226,255,0.1)";
                                                                                progress.style.background =
                                                                                    "linear-gradient(269.49deg, "
                                                                                    + '#63E4F4 -19.19%'
                                                                                    + ", "
                                                                                    + '#7CDEEB 9.81%'
                                                                                    + ", "
                                                                                    + '#C5F7FC 61.71%'
                                                                                    + ", "
                                                                                    + '#F0FEFF 127.35%'
                                                                                    + ")";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                $("#box-4").clone().appendTo(".modal-content-flex-4");
                                                            }
                                                        })
                                                        .catch(error => console.log('error', error));
                                                }, 4000);
                                            })
                                            .catch(error => console.log('error', error));
                                    }, 4000);
                                })
                                .catch(error => console.log('error', error));
                        })
                        // end gap report and satisfaction itemperature

                        // satisfation indicator
                        $(document).ready(function()
                        {
                            var myHeaders = new Headers();
                            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                            myHeaders.append("Content-Type", "application/json");

                            var raw = JSON.stringify({
                                "format": "json",
                                "compress": false
                            });

                            var requestOptions = {
                                method: 'POST',
                                headers: myHeaders,
                                body: raw,
                                redirect: 'follow'
                            };

                            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                                .then(response => response.json())
                                .then(first =>
                                {
                                    setTimeout(function()
                                    {
                                        var myHeaders = new Headers();
                                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                        myHeaders.append("Content-Type", "application/json");

                                        var requestOptions = {
                                            method: 'GET',
                                            headers: myHeaders,
                                            redirect: 'follow'
                                        };

                                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                                            .then(response => response.json())
                                            .then(second => {
                                                setTimeout(function()
                                                {
                                                    var myHeaders = new Headers();
                                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                                    var requestOptions = {
                                                        method: 'GET',
                                                        headers: myHeaders,
                                                        redirect: 'follow'
                                                    };

                                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                                        .then(response => response.json())
                                                        .then(result => {

                                                            let canvasCompany = document.getElementById("bubble-company");
                                                            let ctxCompany = canvasCompany.getContext("2d");
                                                            ctxCompany.clearRect(0, 0, 240, 240);

                                                            let canvasCompanyModal = document.getElementById("bubble-company-modal");
                                                            let ctxCompanyModal = canvasCompanyModal.getContext("2d");
                                                            ctxCompanyModal.clearRect(0, 0, 240, 240);

                                                            let responses = result["responses"];
                                                            responses.forEach(el =>
                                                            {
                                                                if (el["values"]["QID101_TEXT"] === $(".existCompanies").val()) {

                                                                    let societal = el["values"]["QID3_1"];
                                                                    let client = el["values"]["QID4_1"];
                                                                    let knowledge = el["values"]["QID12_1"];
                                                                    let team = el["values"]["QID55_1"];
                                                                    let organization = el["values"]["QID60_1"];
                                                                    let leadership = el["values"]["QID54_1"];
                                                                    let progress = el["values"]["QID50_1"];
                                                                    let skill = el["values"]["QID4_1"];
                                                                    let organizationCulture = el["values"]["QID15_1"];
                                                                    let character = el["values"]["QID14_1"];
                                                                    let project = el["values"]["QID7_6"];

                                                                    let SatisfactionIndicatorArray = [
                                                                        [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                                        [client, "Client", 3], [team, "Team Impact", 4],
                                                                        [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                                        [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                                        [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                                    ]

                                                                    document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                                                                    document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                                    var c = document.getElementById("bubble-company");
                                                                    var ctx = c.getContext("2d");

                                                                    var cModal = document.getElementById("bubble-company-modal");
                                                                    var ctxModal = cModal.getContext("2d");

                                                                    SatisfactionIndicatorArray.forEach(xY => {
                                                                        ctx.beginPath();
                                                                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                        ctx.font = "bold 8px verdana, sans-serif";
                                                                        ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                        ctx.fill();

                                                                        ctxModal.beginPath();
                                                                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                        ctxModal.font = "bold 8px verdana, sans-serif";
                                                                        ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                        ctxModal.fill();
                                                                    })
                                                                }
                                                            })
                                                            $(".getCompanyResults").css("display", "block");
                                                            $(".getCompanyResultsDisabled").css("display", "none");
                                                            $(".existCompanies").attr("disabled", false);
                                                        })
                                                        .catch(error => console.log('error', error));
                                                }, 4000);
                                            })
                                            .catch(error => console.log('error', error));
                                    }, 4000);
                                })
                                .catch(error => console.log('error', error));
                        })
                        // end satisfaction indicator
                    });
                </script>
            @endif
            @if(Auth::user()->tariff === 1)
                <header class="home-header">
                    <div class="home-header-content">
                        <div class="home-header-cont-1">
                            <div class="home-h-title">Satisfaction ITemperature Index</div>
                            <a href="#" class="btn-satisfactionITemperatureIndex">
                                <svg width="12"
                                     height="8"
                                     style="margin: 0 0 0 10px"
                                     viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="path-satisfaction" d="M11.1812 4.05851C11.3765 3.86325 11.3765 3.54667 11.1812 3.3514L7.99921 0.169423C7.80395 -0.0258394 7.48737 -0.0258395 7.2921 0.169423C7.09684 0.364685 7.09684 0.681267 7.2921 0.87653L10.1205 3.70496L7.2921 6.53338C7.09684 6.72865 7.09684 7.04523 7.2921 7.24049C7.48736 7.43575 7.80395 7.43575 7.99921 7.24049L11.1812 4.05851ZM0.827637 4.20496L10.8276 4.20496L10.8276 3.20496L0.827637 3.20496L0.827637 4.20496Z" fill="#3E3E3E"/>
                                </svg>
                            </a>
                            <div class="modal-satisfactionITemperatureIndex" style="height: 100vh">
                                <!-- Modal c+-ontent -->
                                <div style="display: flex; justify-content: center; align-items: center; height: 100vh">
                                    <div class="modal-content-1">
                                        <span class="close">&times;</span>
                                        <div class="modal-flex-content-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="home-header-cont-2">
                            <div class="home-h-title">Gap Report</div>
                            <a href="#" class="btn-gapReport">
                                <svg width="12"
                                     height="8"
                                     style="margin: 0 0 0 10px"
                                     viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path class="path-satisfaction" d="M11.1812 4.05851C11.3765 3.86325 11.3765 3.54667 11.1812 3.3514L7.99921 0.169423C7.80395 -0.0258394 7.48737 -0.0258395 7.2921 0.169423C7.09684 0.364685 7.09684 0.681267 7.2921 0.87653L10.1205 3.70496L7.2921 6.53338C7.09684 6.72865 7.09684 7.04523 7.2921 7.24049C7.48736 7.43575 7.80395 7.43575 7.99921 7.24049L11.1812 4.05851ZM0.827637 4.20496L10.8276 4.20496L10.8276 3.20496L0.827637 3.20496L0.827637 4.20496Z" fill="#3E3E3E"/>
                                </svg>
                            </a>
                        </div>

                    </div>
                </header>

                <main class="home-main-content">
                    <div class="container">

                        <div class="box-1">
                            <div class="box1-btn-cards">
                                <button class="box1-btn-cards-switch company" @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") style="pointer-events: none; color: black; font-weight: bold;"  @else style="background-color: blue; color: white;"  @endif>Company</button>
                                <button class="box1-btn-cards-switch department" @if(Auth::user()->teamlead == "yes" || Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->chief == "yes") style="background-color: blue; color: white;"  @endif>Department @if(Auth::user()->manager === "yes")<a class="departments-dropdown-iTemperature">▼</a>@endif</button>
                                <button class="box1-btn-cards-switch teams" @if(Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->teamlead == "yes") style="background-color: blue; color: white;"  @endif>Teams @if(Auth::user()->manager === "yes" || Auth::user()->chief === "yes")<a class="teams-dropdown-iTemperature">▼</a>@endif</button>
                            </div>

                            <div class="box1-content">
                                <div class="satisfaction">
                                    <p class="box1-left-text">Needs Attentions</p>
                                    <canvas id="satisfaction-company" class="satisfaction-company" width="810" height="180" style="display: @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") none @else block @endif;"></canvas>
                                    <canvas id="satisfaction-depatment" class="satisfaction-depatment" width="810" height="180" style="display: @if(Auth::user()->chief == "yes") block @else none @endif;"></canvas>
                                    <canvas id="satisfaction-team" class="satisfaction-team" width="810" height="180" style="display: @if(Auth::user()->teamlead == "yes") block @else none @endif;"></canvas>
                                    <p class="box1-right-text">Doing Great</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-satisfactionITemperatureIndex" style="height: 100%;">
                            <!-- Modal c+-ontent -->
                            <div style="height: 100%; display: flex; justify-content: center; align-items: center">
                                <div class="modal-content-1">
                                    <span class="close">&times;</span>
                                    <div class="modal-flex-content-1" >
                                        <div class="box-1">
                                            <div class="box1-btn-cards">
                                                <button class="box1-btn-cards-switch company-modal" @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") style="pointer-events: none; color: black; font-weight: bold;"  @else style="background-color: blue; color: white;"  @endif>Company</button>
                                                <button class="box1-btn-cards-switch department-modal" @if(Auth::user()->teamlead == "yes" || Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->chief == "yes") style="background-color: blue; color: white;"  @endif>Department</button>
                                                <button class="box1-btn-cards-switch teams-modal" @if(Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->teamlead == "yes") style="background-color: blue; color: white;"  @endif>Teams</button>
                                            </div>

                                            <div class="box1-content">
                                                <div class="satisfaction">
                                                    <p class="box1-left-text">Needs Attentions</p>
                                                    <canvas id="satisfaction-company-modal" class="satisfaction-company-modal" width="810" height="180" style="display: @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") none @else block @endif;"></canvas>
                                                    <canvas id="satisfaction-depatment-modal" class="satisfaction-depatment-modal" width="810" height="180" style="display: @if(Auth::user()->chief == "yes") block @else none @endif;"></canvas>
                                                    <canvas id="satisfaction-team-modal" class="satisfaction-team-modal" width="810" height="180" style="display: @if(Auth::user()->teamlead == "yes") block @else none @endif;"></canvas>
                                                    <p class="box1-right-text">Doing Great</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-2">
                            <div class="box2-title">
                                <p>Satisfaction Indicator Report</p>
                                <a href="#" class="btn-satisfactionIndicatorReport">
                                    <svg width="12"
                                         height="8"
                                         style="margin: 0 0 0 10px"
                                         viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="path-satisfaction" d="M11.1812 4.05851C11.3765 3.86325 11.3765 3.54667 11.1812 3.3514L7.99921 0.169423C7.80395 -0.0258394 7.48737 -0.0258395 7.2921 0.169423C7.09684 0.364685 7.09684 0.681267 7.2921 0.87653L10.1205 3.70496L7.2921 6.53338C7.09684 6.72865 7.09684 7.04523 7.2921 7.24049C7.48736 7.43575 7.80395 7.43575 7.99921 7.24049L11.1812 4.05851ZM0.827637 4.20496L10.8276 4.20496L10.8276 3.20496L0.827637 3.20496L0.827637 4.20496Z" fill="#3E3E3E"/>
                                    </svg>
                                </a>

                                <div class="modal-satisfactionIndicatorReport">
                                    <!-- Modal c+-ontent -->
                                    <div style="height: 100%; display: flex; justify-content: center; align-items: center">
                                        <div class="modal-content-2">
                                            <span class="close">&times;</span>
                                            <div class="modal-flex-content-2" >
                                                <div class="box-2" style="position: relative; top: 170px; transform: scale(1.7);">
                                                    <div class="box2-btn-cards">
                                                        <button class="box2-btn-cards-switch companyBubble-modal" @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") style="pointer-events: none; color: black; font-weight: bold;"  @else style="background-color: blue; color: white;"  @endif>Company</button>
                                                        <button class="box2-btn-cards-switch departmentBubble-modal" @if(Auth::user()->teamlead == "yes" || Auth::user()->admin === "yes") style="pointer-events: none; color: black; font-weight: bold;"  @elseif(Auth::user()->chief == "yes") style="background-color: blue; color: white;"  @endif>Department</button>
                                                        <button class="box2-btn-cards-switch teamsBubble-modal" @if(Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;" @elseif(Auth::user()->teamlead == "yes") style="background-color: blue; color: white;"  @endif>Teams</button>
                                                    </div>
                                                    <div class="box2-content">
                                                        <div class="box2-graph">
                                                            <canvas id="bubble-company-modal" class="bubble-company-modal" height=240 width=240 style="display: @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") none @else block @endif;"></canvas>
                                                            <canvas id="bubble-department-modal" class="bubble-department-modal" height=240 width=240 style="display: @if(Auth::user()->chief == "yes") block @else none @endif;"></canvas>
                                                            <canvas id="bubble-team-modal" class="bubble-team-modal" height=240 width=240 style="display: @if(Auth::user()->teamlead == "yes") block @else none @endif;"></canvas>
                                                        </div>
                                                        <div class="box2-degrees-1">
                                                            <svg width="359"
                                                                 height="6"
                                                                 viewBox="0 0 359 8"
                                                                 style="position: relative; top: 23px; right: -17px;"
                                                                 fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.03561 3.34579C0.840345 3.54105 0.840345 3.85763 1.03561 4.05289L4.21759 7.23487C4.41285 7.43014 4.72943 7.43014 4.92469 7.23487C5.11996 7.03961 5.11996 6.72303 4.92469 6.52777L2.09627 3.69934L4.92469 0.870914C5.11996 0.675652 5.11996 0.359069 4.92469 0.163807C4.72943 -0.0314553 4.41285 -0.0314553 4.21759 0.163807L1.03561 3.34579ZM358.036 4.05289C358.231 3.85763 358.231 3.54105 358.036 3.34579L354.854 0.163807C354.659 -0.0314553 354.342 -0.0314553 354.147 0.163807C353.952 0.359069 353.952 0.675652 354.147 0.870914L356.975 3.69934L354.147 6.52777C353.952 6.72303 353.952 7.03961 354.147 7.23487C354.342 7.43014 354.659 7.43014 354.854 7.23487L358.036 4.05289ZM1.38916 4.19934L357.682 4.19934V3.19934L1.38916 3.19934V4.19934Z" fill="black"/>
                                                            </svg>
                                                            <div class="box2-degrees-titles-1">
                                                                <p class="box2-degrees-title-12">Needs Unmet</p>
                                                                <p class="box2-degrees-title-22">Needs Met</p>
                                                            </div>
                                                        </div>
                                                        <div class="box2-degrees-2">
                                                            <svg width="359" height="6"
                                                                 viewBox="0 0 359 8"
                                                                 style="position: relative; bottom: 18px;"
                                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.03561 3.34579C0.840345 3.54105 0.840345 3.85763 1.03561 4.05289L4.21759 7.23487C4.41285 7.43014 4.72943 7.43014 4.92469 7.23487C5.11996 7.03961 5.11996 6.72303 4.92469 6.52777L2.09627 3.69934L4.92469 0.870914C5.11996 0.675652 5.11996 0.359069 4.92469 0.163807C4.72943 -0.0314553 4.41285 -0.0314553 4.21759 0.163807L1.03561 3.34579ZM358.036 4.05289C358.231 3.85763 358.231 3.54105 358.036 3.34579L354.854 0.163807C354.659 -0.0314553 354.342 -0.0314553 354.147 0.163807C353.952 0.359069 353.952 0.675652 354.147 0.870914L356.975 3.69934L354.147 6.52777C353.952 6.72303 353.952 7.03961 354.147 7.23487C354.342 7.43014 354.659 7.43014 354.854 7.23487L358.036 4.05289ZM1.38916 4.19934L357.682 4.19934V3.19934L1.38916 3.19934V4.19934Z" fill="black"/>
                                                            </svg>
                                                            <div class="box2-degrees-titles">
                                                                <p class="box2-degrees-title-1">Low Importance</p>
                                                                <p class="box2-degrees-title-2">High Importance</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box2-btn-cards">
                                <button class="box2-btn-cards-switch companyBubble" @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") style="pointer-events: none; color: black; font-weight: bold;"  @else style="background-color: blue; color: white;"  @endif>Company</button>
                                <button class="box2-btn-cards-switch departmentBubble" @if(Auth::user()->teamlead == "yes" || Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->chief == "yes") style="background-color: blue; color: white;"  @endif>Department @if(Auth::user()->manager === "yes")<a class="departments-dropdown">▼</a>@endif</button>
                                <button class="box2-btn-cards-switch teamsBubble" @if(Auth::user()->admin === "yes") style="pointer-events: none; color: black;font-weight: bold;"  @elseif(Auth::user()->teamlead == "yes") style="background-color: blue; color: white;"  @endif>Teams @if(Auth::user()->manager === "yes" || Auth::user()->chief === "yes")<a class="teams-dropdown">▼</a>@endif</button>
                            </div>
                            <script>
                                $(".departments-dropdown").on("click", function(e)
                                {
                                    e.preventDefault();
                                    $(".dropdown-departments-modal").css({
                                        "display": "flex",
                                        "z-index": "10"
                                    })
                                    $(".box1-right-text").css({
                                        "z-index": "0"
                                    })
                                    $(".box-4").css({
                                        "z-index": "0"
                                    })
                                    $(".box1-btn-cards").css({
                                        "z-index": "1"
                                    })
                                    $(".satisfaction").css({
                                        "z-index": "0"
                                    })
                                })

                                $(".teams-dropdown").on("click", function(e)
                                {
                                    e.preventDefault();
                                    $(".dropdown-teams-modal").css({
                                        "display": "flex",
                                        "z-index": "10"
                                    })
                                    $(".box1-right-text").css({
                                        "z-index": "0"
                                    })
                                    $(".box-4").css({
                                        "z-index": "0"
                                    })
                                    $(".box1-btn-cards").css({
                                        "z-index": "1"
                                    })
                                    $(".satisfaction").css({
                                        "z-index": "0"
                                    })
                                })

                                $('.departments-dropdown-iTemperature').on("click", function(e){
                                    e.preventDefault();
                                    $(".dropdown-departments-modal-iTemperature").css({
                                        "display": "flex",
                                        "z-index": "10"
                                    })
                                    $(".box1-right-text").css({
                                        "z-index": "0"
                                    })
                                    $(".box-4").css({
                                        "z-index": "0"
                                    })
                                    $(".box1-btn-cards").css({
                                        "z-index": "1"
                                    })
                                    $(".satisfaction").css({
                                        "z-index": "0"
                                    })
                                })

                                $('.teams-dropdown-iTemperature').on("click", function(e){
                                    e.preventDefault();
                                    $(".dropdown-teams-modal-iTemperature").css({
                                        "display": "flex",
                                        "z-index": "10"
                                    })
                                    $(".box1-right-text").css({
                                        "z-index": "0"
                                    })
                                    $(".box-4").css({
                                        "z-index": "0"
                                    })
                                    $(".box1-btn-cards").css({
                                        "z-index": "1"
                                    })
                                    $(".satisfaction").css({
                                        "z-index": "0"
                                    })
                                })

                                $(".close-dropdown").on("click", function(e)
                                {
                                    e.preventDefault();
                                    $(".dropdown-departments-modal").css({
                                        "display": "none"
                                    })
                                    $(".dropdown-teams-modal").css({
                                        "display": "none"
                                    })
                                    $(".dropdown-departments-modal-iTemperature").css({
                                        "display": "none"
                                    })
                                    $(".dropdown-teams-modal-iTemperature").css({
                                        "display": "none"
                                    })
                                })
                            </script>
                            <div class="box2-content">
                                <div class="box2-graph">
                                    <canvas id="bubble-company" class="bubble-company bubbleChart" height=240 width=240 style="display: @if(Auth::user()->chief == "yes" || Auth::user()->teamlead == "yes") none @else block @endif;"></canvas>
                                    <canvas id="bubble-department" class="bubble-department bubbleChart" height=240 width=240 style="display: @if(Auth::user()->chief == "yes" || Auth::user()->manager == "yes") block @else none @endif;"></canvas>
                                    <canvas id="bubble-team" class="bubble-team bubbleChart" height=240 width=240 style="display: @if(Auth::user()->teamlead == "yes") block @else none @endif;"></canvas>
                                </div>
                                <div class="box2-degrees-1">
                                    <svg width="359"
                                         height="6"
                                         viewBox="0 0 359 8"
                                         style="position: relative; top: 23px; right: -17px;"
                                         fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.03561 3.34579C0.840345 3.54105 0.840345 3.85763 1.03561 4.05289L4.21759 7.23487C4.41285 7.43014 4.72943 7.43014 4.92469 7.23487C5.11996 7.03961 5.11996 6.72303 4.92469 6.52777L2.09627 3.69934L4.92469 0.870914C5.11996 0.675652 5.11996 0.359069 4.92469 0.163807C4.72943 -0.0314553 4.41285 -0.0314553 4.21759 0.163807L1.03561 3.34579ZM358.036 4.05289C358.231 3.85763 358.231 3.54105 358.036 3.34579L354.854 0.163807C354.659 -0.0314553 354.342 -0.0314553 354.147 0.163807C353.952 0.359069 353.952 0.675652 354.147 0.870914L356.975 3.69934L354.147 6.52777C353.952 6.72303 353.952 7.03961 354.147 7.23487C354.342 7.43014 354.659 7.43014 354.854 7.23487L358.036 4.05289ZM1.38916 4.19934L357.682 4.19934V3.19934L1.38916 3.19934V4.19934Z" fill="black"/>
                                    </svg>
                                    <div class="box2-degrees-titles-1">
                                        <p class="box2-degrees-title-12">Needs Unmet</p>
                                        <p class="box2-degrees-title-22">Needs Met</p>
                                    </div>
                                </div>
                                <div class="box2-degrees-2">
                                    <svg width="359" height="6"
                                         viewBox="0 0 359 8"
                                         style="position: relative; bottom: 18px;"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.03561 3.34579C0.840345 3.54105 0.840345 3.85763 1.03561 4.05289L4.21759 7.23487C4.41285 7.43014 4.72943 7.43014 4.92469 7.23487C5.11996 7.03961 5.11996 6.72303 4.92469 6.52777L2.09627 3.69934L4.92469 0.870914C5.11996 0.675652 5.11996 0.359069 4.92469 0.163807C4.72943 -0.0314553 4.41285 -0.0314553 4.21759 0.163807L1.03561 3.34579ZM358.036 4.05289C358.231 3.85763 358.231 3.54105 358.036 3.34579L354.854 0.163807C354.659 -0.0314553 354.342 -0.0314553 354.147 0.163807C353.952 0.359069 353.952 0.675652 354.147 0.870914L356.975 3.69934L354.147 6.52777C353.952 6.72303 353.952 7.03961 354.147 7.23487C354.342 7.43014 354.659 7.43014 354.854 7.23487L358.036 4.05289ZM1.38916 4.19934L357.682 4.19934V3.19934L1.38916 3.19934V4.19934Z" fill="black"/>
                                    </svg>
                                    <div class="box2-degrees-titles">
                                        <p class="box2-degrees-title-1">Low Importance</p>
                                        <p class="box2-degrees-title-2">High Importance</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-3">
                            <div class="box3-title">
                                <p>Teams chart</p>
                                <a href="#" class="btn-team">
                                    <svg width="12"
                                         height="8"
                                         style="margin: 0 0 0 10px"
                                         viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path class="path-satisfaction" d="M11.1812 4.05851C11.3765 3.86325 11.3765 3.54667 11.1812 3.3514L7.99921 0.169423C7.80395 -0.0258394 7.48737 -0.0258395 7.2921 0.169423C7.09684 0.364685 7.09684 0.681267 7.2921 0.87653L10.1205 3.70496L7.2921 6.53338C7.09684 6.72865 7.09684 7.04523 7.2921 7.24049C7.48736 7.43575 7.80395 7.43575 7.99921 7.24049L11.1812 4.05851ZM0.827637 4.20496L10.8276 4.20496L10.8276 3.20496L0.827637 3.20496L0.827637 4.20496Z" fill="#3E3E3E"/>
                                    </svg>
                                </a>

                                <div class="modal-team" style="height: 100%;">
                                    <!-- Modal c+-ontent -->
                                    <div style="height: 100%; display: flex; justify-content: center; align-items: center">
                                        <div class="modal-content-2">
                                            <span class="close">&times;</span>
                                            <div class="modal-flex-content-3">
                                                <div class="box3-content">
                                                    <div style="height: 330px; width: 340px">
                                                        <canvas id="teamsChart-modal" class="teamsChart-modal" width=343 height=340></canvas>
                                                        <p class="box3-degrees-title-12">Team culture evaluation</p>
                                                        <p class="box3-degrees-title-2">Weighted Indicator Satisfaction</p>
                                                        <div class="box3-degrees-title-11">
                                                            <p>Low</p>
                                                            <p>High</p>
                                                        </div>
                                                        <div class="box3-degrees-title-22">
                                                            <p>Low</p>
                                                            <p>High</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box3-content">
                                <div style="height: 330px; width: 340px">
                                    <canvas id="teamsChart" width=343 height=340></canvas>
                                    <p class="box3-degrees-title-12">Team culture evaluation</p>
                                    <p class="box3-degrees-title-2">Weighted Indicator Satisfaction</p>
                                    <div class="box3-degrees-title-11">
                                        <p>Low</p>
                                        <p>High</p>
                                    </div>
                                    <div class="box3-degrees-title-22">
                                        <p>Low</p>
                                        <p>High</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="box-4" class="box-4">
                            @if(Auth::user()->admin !== "yes") <p style="margin-top: 17px;">Data loading ... </p> @endif
                            <div @if(Auth::user()->admin !== "yes") style="margin-top: -7px;" @endif>
                                <div class="panel-report 0">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 10%; background: rgba(187, 187, 187, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(94, 94, 94); width: 10%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(191, 191, 191) -5.46%, rgba(206, 206, 206, 0.373) 77.74%, rgba(241, 241, 241, 0) 127.35%); width: 30%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Team Impact</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 1">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 0%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 0%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Team &amp; Leadership Ethics</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 2">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 0%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 0%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Societal Impact Size</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 3">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 20%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 20%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 20%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Client Impact</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 4">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 20%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 20%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 20%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Material Progress - Pay &amp; Benefits</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 5">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 10%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 10%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Knowledge Progress</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 6">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 40%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 40%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 20%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Organization Impact</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 7">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 50%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 50%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Organization Culture</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 8">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 70%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 70%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Project Impact</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 9">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 70%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 70%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Character Culture</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-report 10">
                                    <div class="progress-report">
                                        <div id="target" class="target" style="width: 90%; background: rgba(0, 226, 255, 0.1);"></div>
                                        <div id="limit" class="limit" style="border-right: 2px solid rgb(10, 136, 153); width: 90%;"></div>
                                        <div id="progress-done" class="progress-done" style="background: linear-gradient(269.49deg, rgb(99, 228, 244) -19.19%, rgb(124, 222, 235) 9.81%, rgb(197, 247, 252) 61.71%, rgb(240, 254, 255) 127.35%); width: 10%;"></div>
                                    </div>
                                    <div class="panel-report-1">
                                        <div class="panel-report-degrees">0</div>
                                        <div class="panel-report-info">
                                            <div class="panel-report-name">Skill Progress</div>
                                            <div class="panel-report-rates">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                        <div class="modal-gapReport" style="display: none; overflow-y: hidden;">
                            <div class="modal-gapReport-content">
                                <div class="modal-content-4" style=" transform: scale(1.0);">
                                    <span class="close" style="margin-top: -4px;">&times;</span>
                                    <div class="modal-content-flex-4" style="margin-top: 90px; transform: scale(1.2); align-items: center; display: flex; justify-content: center;">

                                    </div>
                                </div>
                            </div>
                        </div>
                </main>
            @else
                <div style="text-align: center">
                    <a href="/users">Add and update coworkers</a><br />
                    <a href="#" class="show-test-results" style="cursor:pointer;">Save test results from Qualtrics</a><br />
                    <a href="/departments">Look on your company departments</a>
                    <p>If you want to use more options, look our <a href="/payment">offers</a></p>
                </div>
            @endif
        </div>
    </div>

    <div class="sidebar-menu-main" id="popupBurger">
        <div class="sidebar-menu-content">
            <div class="sidebar-menu-wrapper">
                <div class="side-menu-cart1">
                    <div class="side-menu-workforce">
                        <svg width="36" height="16" viewBox="0 0 36 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.27644 15.8781C12.6758 15.8781 16.255 12.4253 16.255 8.18152C16.255 3.93772 12.6758 0.484985 8.27644 0.484985C3.87713 0.484985 0.297852 3.93772 0.297852 8.18152C0.297852 12.4253 3.87684 15.8781 8.27644 15.8781ZM8.27615 2.40933C11.5761 2.40933 14.2602 4.99846 14.2602 8.18152C14.2602 8.42739 14.2389 8.66828 14.2076 8.90612L9.02071 8.15632L5.7721 2.94593C6.53474 2.60481 7.38148 2.40933 8.27615 2.40933ZM4.1234 4.03491L7.5537 9.53631C7.70697 9.78246 7.96616 9.94887 8.26037 9.99206L13.6189 10.7671C12.6336 12.6537 10.6117 13.954 8.27644 13.954C4.97674 13.954 2.29271 11.3648 2.29271 8.1818C2.29214 6.55427 2.9968 5.08513 4.1234 4.03491Z" fill="#AFAFAF"/>
                            <path d="M35.0659 3.28577H20.1802V5.20983H35.0659V3.28577Z" fill="#AFAFAF"/>
                            <path d="M30.0915 8.09637H20.1802V10.0204H30.0915V8.09637Z" fill="#AFAFAF"/>
                            <path d="M32.9232 12.9065H20.1802V14.8306H32.9232V12.9065Z" fill="#AFAFAF"/>
                        </svg>
                        <p class="side-menu-workforce-text">Workforce Monitor</p>
                    </div>
                    <div class="side-menu-trends-proj">
                        <svg width="30"
                             height="31"
                             viewBox="0 0 30 31"
                             style="margin: 20px 0 10px;"
                             fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.95796 24.4658H1.9624V30.6007H5.95796V24.4658Z" fill="#747474"/>
                            <path d="M28.4497 13.9109H24.4541V30.6006H28.4497V13.9109Z" fill="#747474"/>
                            <path d="M20.8662 17.124H16.8706V30.6006H20.8662V17.124Z" fill="#747474"/>
                            <path d="M13.3579 21.3276H9.3623V30.5923H13.3579V21.3276Z" fill="#747474"/>
                            <path d="M12.0181 9.0829L1.53809 18.4808L2.1291 19.1384L12.3011 10.0152L16.3966 13.9941L26.8682 3.98857L26.2523 6.57736L27.118 6.78546L28.2251 2.07404L23.4803 2.98136L23.6468 3.84706L26.2606 3.34762L16.4049 12.7705L12.3178 8.80821L12.0181 9.0829Z" fill="#747474"/>
                            <path d="M0.955453 17.8232L12.3428 7.60123L16.4049 11.5468L23.497 4.77104L21.0331 2.56516L29.3988 0.958618L27.5592 8.7L25.32 6.68558L16.3966 15.2177L12.2762 11.2222L2.06255 20.3787L0.297852 18.4142L0.955453 17.8232Z" fill="#747474"/>
                        </svg>
                        <p class="side-menu-trends-text">Trends & Projections</p>
                        <a href="/home" class="side-menu-companies-link">Dashboard</a><br />
                        <a href="/profile" class="side-menu-companies-link">Profile</a><br />
                        @if(Auth::user()->admin === "yes")<a class="side-menu-companies-link" href="/companies">Companies</a><br />@endif
                        <a class="side-menu-companies-link" href="/users">@if(Auth::user()->manager === "yes" || Auth::user()->chief === "yes" || Auth::user()->teamlead === "yes"){{ __('Сompany staff') }}@elseif(Auth::user()->admin === "yes"){{ __('Admin panel') }}@endif</a><br />
                        @if(Auth::user()->manager === "yes")<a class="side-menu-companies-link" href="/departments">Departments</a><br />@endif
                        @if(Auth::user()->admin !== "yes") <a href="#" class="show-test-results side-menu-companies-link" style="cursor:pointer;">Save test results</a><br />@endif
                        <a href="/payment" class="side-menu-companies-link">Our offers</a>
                    </div>
                    <div class="side-menu-hide-menu">
                        <svg width="12" height="9" viewBox="0 0 12 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.942833 4.83585C0.747571 4.64059 0.747571 4.32401 0.942833 4.12875L4.12481 0.946767C4.32008 0.751504 4.63666 0.751504 4.83192 0.946766C5.02718 1.14203 5.02718 1.45861 4.83192 1.65387L2.00349 4.4823L4.83192 7.31073C5.02718 7.50599 5.02718 7.82257 4.83192 8.01783C4.63666 8.2131 4.32008 8.2131 4.12481 8.01783L0.942833 4.83585ZM11.2964 4.9823L1.29639 4.9823L1.29639 3.9823L11.2964 3.9823L11.2964 4.9823Z" fill="#A6A6A6"/>
                        </svg>
                        <a class="side-menu-hide-menu-button" id="hambClose">Hide Menu</a>
                    </div>
                </div>
                <div class="side-menu-cart2">
                    <div>
                        <a href="{{ route('profile') }}">
                            <div class="side-menu-avatar-image" style="margin-left: 25px;">
                                <img xmlns="http://www.w3.org/2000/svg"
                                     class="sidebar-avatar-image"
                                     viewBox="0 -100 448 612" src="{{ (!empty(Auth::user()->image))?url('upload/'.Auth::user()->image):url('upload/no_image.jpg') }}" alt="User Avatar">
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            </div>
                        </a>
                        <div class="side-menu-main-name">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <p class="sidebar-name-text-hi">Hi, </p>
                                <p class="sidebar-name-text" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="side-menu-nav-links">
                        <a class="side-menu-nav-link">Help</a>
                        <a class="side-menu-nav-link">About</a>
                        <a class="side-menu-nav-link">Subscription</a>
                        <div class="side-menu-nav-exit">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.2865 4.02262C10.1307 4.02262 9.9812 3.96072 9.871 3.85052C9.7608 3.74032 9.69889 3.59086 9.69889 3.43502C9.69889 3.27918 9.7608 3.12972 9.871 3.01952C9.9812 2.90932 10.1307 2.84741 10.2865 2.84741H11.4617C11.6176 2.84741 11.767 2.90932 11.8772 3.01952C11.9874 3.12972 12.0493 3.27918 12.0493 3.43502V11.6615C12.0493 11.8173 11.9874 11.9668 11.8772 12.077C11.767 12.1872 11.6176 12.2491 11.4617 12.2491H10.2865C10.1307 12.2491 9.9812 12.1872 9.871 12.077C9.7608 11.9668 9.69889 11.8173 9.69889 11.6615C9.69889 11.5057 9.7608 11.3562 9.871 11.246C9.9812 11.1358 10.1307 11.0739 10.2865 11.0739H10.8741V4.02262H10.2865Z" fill="#666666"/>
                                <path d="M2.16583 7.20755L3.82288 4.85712C3.91274 4.73044 4.04911 4.64449 4.20216 4.61807C4.35521 4.59164 4.51251 4.62689 4.63965 4.7161C4.7032 4.76063 4.7573 4.81731 4.79883 4.88286C4.84035 4.94842 4.86849 5.02155 4.8816 5.09803C4.89471 5.17452 4.89254 5.25284 4.87522 5.32848C4.8579 5.40413 4.82576 5.47559 4.78067 5.53875L3.76999 6.96075H8.52372C8.67957 6.96075 8.82902 7.02266 8.93922 7.13286C9.04942 7.24306 9.11133 7.39252 9.11133 7.54836C9.11133 7.7042 9.04942 7.85366 8.93922 7.96386C8.82902 8.07406 8.67957 8.13596 8.52372 8.13596H3.82288L4.88057 9.54622C4.92687 9.60795 4.96055 9.6782 4.9797 9.75295C4.99885 9.8277 5.00309 9.90549 4.99218 9.98188C4.98127 10.0583 4.95542 10.1318 4.9161 10.1982C4.87679 10.2646 4.82478 10.3226 4.76305 10.3689C4.66133 10.4451 4.53762 10.4864 4.41048 10.4864C4.31926 10.4864 4.22929 10.4651 4.1477 10.4244C4.0661 10.3836 3.99513 10.3243 3.9404 10.2513L2.17758 7.90092C2.10232 7.80154 2.06063 7.6808 2.05851 7.55615C2.0564 7.43151 2.09398 7.30942 2.16583 7.20755Z" fill="#666666"/>
                            </svg>
                            <a href="https://bodiadave.dev.yeducoders.com:443/logout" class="side-menu-nav-exit-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Exit</a>
                            <form id="logout-form" action="https://bodiadave.dev.yeducoders.com:443/logout" method="POST" class="d-none">
                                <input type="hidden" name="_token" value="tHbQHSXAESmah6hRGVw3XAiPfj9gcHHeCHxOHp7Z">
                            </form>
                        </div>
                    </div>
                    <div>
                        <div class="nav-d-theme">
                            <div class="nav-d-change-theme">
                                <input id="xxx2" onclick="bg()" type="checkbox" style="cursor: pointer">
                                @if(Auth::user()->tariff !== 1)
                                    <script>
                                        document.getElementById("xxx").disabled = true;
                                        document.getElementById("xxx2").disabled = true;
                                        $("#xxx").attr("title", "You can't change colors");
                                        $("#xxx2").attr("title", "You can't change colors");
                                    </script>
                                @endif
                                <script src="/js/theme.js"></script>
                            </div>
                            <div class="nav-d-text-theme-d">White theme</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="sidebar-main">
        <div class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-cont-trends">
                    <svg width="18"
                         height="19"
                         viewBox="0 0 18 19"
                         fill="none"
                         style="transform: rotate(-270deg); position: relative; left: 20px;"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.1665 14.7646V17.1129H17.7722V14.7646H14.1665Z" fill="#747474"/>
                        <path d="M7.96289 1.54547V3.8938L17.772 3.8938V1.54547L7.96289 1.54547Z" fill="#747474"/>
                        <path d="M9.85156 6.00238V8.35071H17.7723V6.00238H9.85156Z" fill="#747474"/>
                        <path d="M12.3223 10.4153V12.7637H17.7674V10.4153H12.3223Z" fill="#747474"/>
                        <path d="M5.1257 11.2028L10.6492 17.3623L11.0356 17.0149L5.67364 11.0365L8.01218 8.62947L2.13159 2.4749L3.6531 2.83694L3.77541 2.32813L1.00635 1.67745L1.53961 4.46609L2.04842 4.36824L1.75488 2.83205L7.29301 8.62458L4.96425 11.0267L5.1257 11.2028Z" fill="#747474"/>
                        <path d="M10.2625 17.7048L4.25467 11.0121L6.57364 8.62463L2.59128 4.45635L1.29481 5.90448L0.350586 0.987679L4.90046 2.06889L3.71652 3.38493L8.73117 8.62952L6.38284 11.0512L11.7644 17.0541L10.6098 18.0913L10.2625 17.7048Z" fill="#747474"/>
                    </svg>
                    <p class="sidebar-trends-text">trends and projections</p>
                </div>
                <div class="sidebar-cont-workforce">
                    <svg width="16"
                         height="36"
                         style="transform: rotate(-270deg); position: relative; left: 20px;"
                         viewBox="0 0 16 36"
                         fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.7437 27.3883C15.7437 22.989 12.2909 19.4097 8.04712 19.4097C3.80332 19.4097 0.350586 22.989 0.350586 27.3883C0.350586 31.7876 3.80332 35.3669 8.04712 35.3669C12.2909 35.3669 15.7437 31.7879 15.7437 27.3883ZM2.27493 27.3886C2.27493 24.0886 4.86407 21.4046 8.04712 21.4046C8.29299 21.4046 8.53388 21.4258 8.77172 21.4571L8.02192 26.644L2.81153 29.8926C2.47041 29.13 2.27493 28.2833 2.27493 27.3886ZM3.90051 31.5413L9.40191 28.111C9.64806 27.9578 9.81447 27.6986 9.85766 27.4044L10.6327 22.0458C12.5193 23.0312 13.8196 25.053 13.8196 27.3883C13.8196 30.688 11.2304 33.372 8.0474 33.372C6.41987 33.3726 4.95073 32.6679 3.90051 31.5413Z" fill="#AFAFAF"/>
                        <path d="M3.15137 0.599086L3.15137 15.4848H5.07543L5.07543 0.599086H3.15137Z" fill="#AFAFAF"/>
                        <path d="M7.96191 5.57349L7.96191 15.4848H9.88598V5.57349H7.96191Z" fill="#AFAFAF"/>
                        <path d="M12.772 2.74174V15.4848H14.696V2.74174H12.772Z" fill="#AFAFAF"/>
                    </svg>
                    <p class="sidebar-workforce-text">workforce monitor</p>
                </div>
            </div>
        </div>

        <div class="sidebar-btn-on">
            <div class="sidebar-btn-on-content">
                <button class="sidebar-button-on">
                    <a class="sidebar-button-on-text" id="hamb" >All Menu</a>
                    <svg width="11" height="9" viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="path-satisfaction" d="M0.359825 4.74821C0.164563 4.55295 0.164563 4.23636 0.359825 4.0411L3.54181 0.85912C3.73707 0.663858 4.05365 0.663858 4.24891 0.85912C4.44417 1.05438 4.44417 1.37096 4.24891 1.56623L1.42049 4.39465L4.24891 7.22308C4.44418 7.41834 4.44418 7.73493 4.24891 7.93019C4.05365 8.12545 3.73707 8.12545 3.54181 7.93019L0.359825 4.74821ZM10.7134 4.89465L0.713379 4.89465L0.713379 3.89465L10.7134 3.89465L10.7134 4.89465Z" fill="black"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

{{--    <script src="/js/popup.js"></script>--}}
    <!-- jquery actions with menu and contents -->
    <script type="text/javascript">
        function sideMenu()
        {
            $(".side-menu-hide-menu-button").on("click", () =>
            {
                $(".sidebar-menu-main").css("display", "none");
                $(".sidebar-main").css("display", "block");
            })

            $(".sidebar-button-on-text").on("click", () =>
            {
                $(".sidebar-menu-main").css("display", "block");
                $(".sidebar-main").css("display", "none");
            })
        }
        sideMenu()

        @if(Auth::user()->admin !== "yes" && Auth::user()->password !== "user")

        // GAP REPORT AND SATISFACTION ITEMPERATURA CHARTS
        @if(Auth::user()->manager === "yes")
            if(sessionStorage.getItem("storageGapReportCompany") !== null)
            {
                $('#box-4').empty(); $(".modal-content-flex-4").empty();
                var objReportDate = JSON.parse(sessionStorage.getItem("storageGapReportCompany"))
                function test4(id) {
                    $('#box-4').append(`
                                                            <div class="panel-report ${id}">
                                                                <div class="progress-report">
                                                                    <div id="target" class="target"></div>
                                                                    <div id="limit" class="limit"></div>
                                                                    <div id="progress-done" class="progress-done"></div>
                                                                </div>
                                                                <div class="panel-report-1">
                                                                    <div class="panel-report-degrees">0</div>
                                                                    <div class="panel-report-info">
                                                                        <div class="panel-report-name"></div>
                                                                        <div class="panel-report-rates">0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            `)
                }
                if (typeof (objReportDate[0]) !== 'undefined') {

                    objReportDate.sort((a, b) => b.input - a.input).sort((a, b) => (a.input - a.inputProgress) - (b.input - b.inputProgress))

                    for (let i = 0; i <= 10; i++) {
                        test4(i)
                        let formGapReport = $(`.${i}`)
                        let target = formGapReport.get(0).querySelector('.target')
                        let limit = formGapReport.get(0).querySelector('.limit')
                        let progress = formGapReport.get(0).querySelector('.progress-done')
                        let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
                        let out2 = formGapReport.get(0).querySelector(".panel-report-name");
                        let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
                        let finalValue = 0
                        let max = 0;

                        // console.log(`${i})`,'objReportDate: ',objReportDate[i]);

                        setMaxWidth();

                        function setMaxWidth() {
                            max = parseInt(objReportDate[i].maxInput, 10);
                            max = parseInt(objReportDate[i].maxInputProgress, 10);

                            setLimit()
                        }

                        function setLimit() {
                            finalValue = parseInt(objReportDate[i].input, 10);
                            changeWidth(target)
                            changeWidth(limit)
                            setTarget()
                        }

                        function setTarget() {
                            finalValue = parseInt(objReportDate[i].inputProgress, 10);
                            changeWidth(progress)
                        }

                        function changeWidth(obj) {
                            obj.style.width = `${(finalValue / max) * 100}%`;
                            out()
                        }

                        function out() {
                            out2.innerHTML = `${objReportDate[i].nameCard}`;
                            if (objReportDate[i].input === objReportDate[i].inputProgress) {
                                out1.innerHTML = `${objReportDate[i].input}`;
                                out3.innerHTML = '✓';

                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }

                            } else {
                                out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;

                                if (objReportDate[i].inputProgress > objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = b - a;
                                    out3.innerHTML = `${c}`;
                                } else if (objReportDate[i].inputProgress < objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = a - b
                                    out3.innerHTML = `${c * (-1)}`;
                                }
                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }
                            }
                        }
                    }
                    $("#box-4").clone().appendTo(".modal-content-flex-4");
                }
            }

            if(sessionStorage.getItem("itemSatisfactionITemperatureCompany") !== null)
            {
                document.getElementById("satisfaction-company").getContext("2d").clearRect(0, 0, 810, 180);
                document.getElementById("satisfaction-company-modal").getContext("2d").clearRect(0, 0, 810, 180);

                var c = document.getElementById("satisfaction-company");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("satisfaction-company-modal");
                var ctxModal = cModal.getContext("2d");

                var satisfactionITemperatures = JSON.parse(sessionStorage.getItem("itemSatisfactionITemperatureCompany"));
                satisfactionITemperatures.forEach(elem => {

                    var c = document.getElementById("satisfaction-company");
                    var ctx = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "rgba(255, 255, 255)";
                    ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctx.fill();

                    var cModal = document.getElementById("satisfaction-company-modal");
                    var ctxModal = cModal.getContext("2d");
                    ctxModal.beginPath();
                    ctxModal.fillStyle = "rgba(255, 255, 255)";
                    ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctxModal.fill();
                })
            }
        @elseif(Auth::user()->chief === "yes")
            if(sessionStorage.getItem("storageGapReportDepartment") !== null)
            {
                $('#box-4').empty(); $(".modal-content-flex-4").empty();
                var objReportDate = JSON.parse(sessionStorage.getItem("storageGapReportDepartment"))
                function test4(id) {
                    $('#box-4').append(`
                                                                <div class="panel-report ${id}">
                                                                    <div class="progress-report">
                                                                        <div id="target" class="target"></div>
                                                                        <div id="limit" class="limit"></div>
                                                                        <div id="progress-done" class="progress-done"></div>
                                                                    </div>
                                                                    <div class="panel-report-1">
                                                                        <div class="panel-report-degrees">0</div>
                                                                        <div class="panel-report-info">
                                                                            <div class="panel-report-name"></div>
                                                                            <div class="panel-report-rates">0</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                `)
                }
                if (typeof (objReportDate[0]) !== 'undefined') {

                    objReportDate.sort((a, b) => b.input - a.input).sort((a, b) => (a.input - a.inputProgress) - (b.input - b.inputProgress))

                    for (let i = 0; i <= 10; i++) {
                        test4(i)
                        let formGapReport = $(`.${i}`)
                        let target = formGapReport.get(0).querySelector('.target')
                        let limit = formGapReport.get(0).querySelector('.limit')
                        let progress = formGapReport.get(0).querySelector('.progress-done')
                        let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
                        let out2 = formGapReport.get(0).querySelector(".panel-report-name");
                        let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
                        let finalValue = 0
                        let max = 0;

                        // console.log(`${i})`,'objReportDate: ',objReportDate[i]);

                        setMaxWidth();

                        function setMaxWidth() {
                            max = parseInt(objReportDate[i].maxInput, 10);
                            max = parseInt(objReportDate[i].maxInputProgress, 10);

                            setLimit()
                        }

                        function setLimit() {
                            finalValue = parseInt(objReportDate[i].input, 10);
                            changeWidth(target)
                            changeWidth(limit)
                            setTarget()
                        }

                        function setTarget() {
                            finalValue = parseInt(objReportDate[i].inputProgress, 10);
                            changeWidth(progress)
                        }

                        function changeWidth(obj) {
                            obj.style.width = `${(finalValue / max) * 100}%`;
                            out()
                        }

                        function out() {
                            out2.innerHTML = `${objReportDate[i].nameCard}`;
                            if (objReportDate[i].input === objReportDate[i].inputProgress) {
                                out1.innerHTML = `${objReportDate[i].input}`;
                                out3.innerHTML = '✓';

                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }

                            } else {
                                out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;

                                if (objReportDate[i].inputProgress > objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = b - a;
                                    out3.innerHTML = `${c}`;
                                } else if (objReportDate[i].inputProgress < objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = a - b
                                    out3.innerHTML = `${c * (-1)}`;
                                }
                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }
                            }
                        }
                    }
                    $("#box-4").clone().appendTo(".modal-content-flex-4");
                }
            }

            if(sessionStorage.getItem("itemSatisfactionITemperatureDepartment") !== null)
            {
                document.getElementById("satisfaction-depatment").getContext("2d").clearRect(0, 0, 810, 180);
                document.getElementById("satisfaction-depatment-modal").getContext("2d").clearRect(0, 0, 810, 180);

                var c = document.getElementById("satisfaction-depatment");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("satisfaction-depatment-modal");
                var ctxModal = cModal.getContext("2d");

                var satisfactionITemperatures = JSON.parse(sessionStorage.getItem("itemSatisfactionITemperatureDepartment"));
                satisfactionITemperatures.forEach(elem => {

                    var c = document.getElementById("satisfaction-depatment");
                    var ctx = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "rgba(255, 255, 255)";
                    ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctx.fill();

                    var cModal = document.getElementById("satisfaction-depatment-modal");
                    var ctxModal = cModal.getContext("2d");
                    ctxModal.beginPath();
                    ctxModal.fillStyle = "rgba(255, 255, 255)";
                    ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctxModal.fill();
                })
            }
        @elseif(Auth::user()->teamlead === "yes")
            if(sessionStorage.getItem("storageGapReportTeam") !== null)
            {
                $('#box-4').empty(); $(".modal-content-flex-4").empty();
                var objReportDate = JSON.parse(sessionStorage.getItem("storageGapReportTeam"))
                function test4(id) {
                    $('#box-4').append(`
                                                                    <div class="panel-report ${id}">
                                                                        <div class="progress-report">
                                                                            <div id="target" class="target"></div>
                                                                            <div id="limit" class="limit"></div>
                                                                            <div id="progress-done" class="progress-done"></div>
                                                                        </div>
                                                                        <div class="panel-report-1">
                                                                            <div class="panel-report-degrees">0</div>
                                                                            <div class="panel-report-info">
                                                                                <div class="panel-report-name"></div>
                                                                                <div class="panel-report-rates">0</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    `)
                }
                if (typeof (objReportDate[0]) !== 'undefined') {

                    objReportDate.sort((a, b) => b.input - a.input).sort((a, b) => (a.input - a.inputProgress) - (b.input - b.inputProgress))

                    for (let i = 0; i <= 10; i++) {
                        test4(i)
                        let formGapReport = $(`.${i}`)
                        let target = formGapReport.get(0).querySelector('.target')
                        let limit = formGapReport.get(0).querySelector('.limit')
                        let progress = formGapReport.get(0).querySelector('.progress-done')
                        let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
                        let out2 = formGapReport.get(0).querySelector(".panel-report-name");
                        let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
                        let finalValue = 0
                        let max = 0;

                        // console.log(`${i})`,'objReportDate: ',objReportDate[i]);

                        setMaxWidth();

                        function setMaxWidth() {
                            max = parseInt(objReportDate[i].maxInput, 10);
                            max = parseInt(objReportDate[i].maxInputProgress, 10);

                            setLimit()
                        }

                        function setLimit() {
                            finalValue = parseInt(objReportDate[i].input, 10);
                            changeWidth(target)
                            changeWidth(limit)
                            setTarget()
                        }

                        function setTarget() {
                            finalValue = parseInt(objReportDate[i].inputProgress, 10);
                            changeWidth(progress)
                        }

                        function changeWidth(obj) {
                            obj.style.width = `${(finalValue / max) * 100}%`;
                            out()
                        }

                        function out() {
                            out2.innerHTML = `${objReportDate[i].nameCard}`;
                            if (objReportDate[i].input === objReportDate[i].inputProgress) {
                                out1.innerHTML = `${objReportDate[i].input}`;
                                out3.innerHTML = '✓';

                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }

                            } else {
                                out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;

                                if (objReportDate[i].inputProgress > objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = b - a;
                                    out3.innerHTML = `${c}`;
                                } else if (objReportDate[i].inputProgress < objReportDate[i].input) {
                                    let a = objReportDate[i].input;
                                    let b = objReportDate[i].inputProgress;
                                    let c = a - b
                                    out3.innerHTML = `${c * (-1)}`;
                                }
                                if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#10582D";
                                    target.style.background = "rgba(0,255,100,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#55D98A 2.94%'
                                        + ", "
                                        + '#B6EDB1 61.71%'
                                        + ", "
                                        + 'rgba(213, 243, 189, 0.86) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#D88E20";
                                    target.style.background = "rgba(255,202,0,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + 'rgba(255, 148, 50, 0.97) -19.19%'
                                        + ", "
                                        + 'rgba(252, 182, 77, 0.97) 9.81%'
                                        + ", "
                                        + 'rgba(250, 209, 105, 0.36) 61.71%'
                                        + ", "
                                        + 'rgba(255, 246, 213, 0.19) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#5e5e5e";
                                    target.style.background = "rgba(187,187,187,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#BFBFBF -5.46%'
                                        + ", "
                                        + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                        + ", "
                                        + 'rgba(241, 241, 241, 0) 127.35%'
                                        + ")";
                                } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                    limit.style.borderRightWidth = "2px";
                                    limit.style.borderRightStyle = "solid";
                                    limit.style.borderRightColor = "#0A8899";
                                    target.style.background = "rgba(0,226,255,0.1)";
                                    progress.style.background =
                                        "linear-gradient(269.49deg, "
                                        + '#63E4F4 -19.19%'
                                        + ", "
                                        + '#7CDEEB 9.81%'
                                        + ", "
                                        + '#C5F7FC 61.71%'
                                        + ", "
                                        + '#F0FEFF 127.35%'
                                        + ")";
                                }
                            }
                        }
                    }
                    $("#box-4").clone().appendTo(".modal-content-flex-4");
                }
            }

            if(sessionStorage.getItem("itemSatisfactionITemperatureTeam") !== null)
            {
                document.getElementById("satisfaction-team").getContext("2d").clearRect(0, 0, 810, 180);
                document.getElementById("satisfaction-team-modal").getContext("2d").clearRect(0, 0, 810, 180);

                var c = document.getElementById("satisfaction-team");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("satisfaction-team-modal");
                var ctxModal = cModal.getContext("2d");

                var satisfactionITemperatures = JSON.parse(sessionStorage.getItem("itemSatisfactionITemperatureTeam"));
                satisfactionITemperatures.forEach(elem => {

                    var c = document.getElementById("satisfaction-team");
                    var ctx = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "rgba(255, 255, 255)";
                    ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctx.fill();

                    var cModal = document.getElementById("satisfaction-team-modal");
                    var ctxModal = cModal.getContext("2d");
                    ctxModal.beginPath();
                    ctxModal.fillStyle = "rgba(255, 255, 255)";
                    ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                    ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                    ctxModal.fill();
                })
            }
        @endif
        $(document).ready(function () {
            var myHeaders = new Headers();
            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "format": "json",
                "compress": false
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                .then(response => response.json())
                .then(first => {
                    setTimeout(function () {
                        var myHeaders = new Headers();
                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                        myHeaders.append("Content-Type", "application/json");

                        var requestOptions = {
                            method: 'GET',
                            headers: myHeaders,
                            redirect: 'follow'
                        };

                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                            .then(response => response.json())
                            .then(second => {
                                setTimeout(function () {
                                    var myHeaders = new Headers();
                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                    var requestOptions = {
                                        method: 'GET',
                                        headers: myHeaders,
                                        redirect: 'follow'
                                    };

                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            let responses = result["responses"];
                                            let reduced = (a, b) => a + b;

                                            let knoweledgeFirst = [];
                                            let knoweledgeSecond = [];
                                            let knoweledgeThird = [];

                                            let clientFirst = [];
                                            let clientSecond = [];
                                            let clientThird = [];

                                            let teamFirst = [];
                                            let teamSecond = [];
                                            let teamThird = [];

                                            let skillFirst = [];
                                            let skillSecond = [];
                                            let skillThird = [];

                                            let materialFirst = [];
                                            let materialSecond = [];
                                            let materialThird = [];

                                            let leadershipFirst = [];
                                            let leadershipSecond = [];
                                            let leadershipThird = [];

                                            let organizationFirst = [];
                                            let organizationSecond = [];
                                            let organizationThird = [];

                                            let societalFirst = [];
                                            let societalSecond = [];
                                            let societalThird = [];

                                            let projectFirst = [];
                                            let projectSecond = [];
                                            let projectThird = [];

                                            let organizationCultureFirst = [];
                                            let organizationCultureSecond = [];
                                            let organizationCultureThird = [];

                                            let characterFirst = [];
                                            let characterSecond = [];
                                            let characterThird = [];

                                            function test4(id) {
                                                $('#box-4').append(`
                                                            <div class="panel-report ${id}">
                                                                <div class="progress-report">
                                                                    <div id="target" class="target"></div>
                                                                    <div id="limit" class="limit"></div>
                                                                    <div id="progress-done" class="progress-done"></div>
                                                                </div>
                                                                <div class="panel-report-1">
                                                                    <div class="panel-report-degrees">0</div>
                                                                    <div class="panel-report-info">
                                                                        <div class="panel-report-name"></div>
                                                                        <div class="panel-report-rates">0</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            `)
                                            }

                                            let objReportDate = [];
                                            document.getElementById("box-4").innerHTML = "";
                                            responses.forEach(el => {
                                                let department = "{{$department}}";
                                                department = department.replace("&amp;", "&");
                                                    @if(Auth::user()->manager === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}") {
                                                        let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                        let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                        let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                        let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                        let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                        let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                        let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                        let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                        let pjFirst = el["values"]["QID30_1"];
                                                        let culFirst = el["values"]["QID31_1"];
                                                        let chFirst = el["values"]["QID32_1"];

                                                        let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                        let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                        let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                        let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                        let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                        let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                        let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                        let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                        let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                        let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                        let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                        let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                        let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                        let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                        let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                        let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                        let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                        let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                        let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                        let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                        let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                        let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                        knoweledgeFirst.push(knFirst);
                                                        knoweledgeSecond.push(knSecond);
                                                        knoweledgeThird.push(knThird);

                                                        skillFirst.push(skFirst);
                                                        skillSecond.push(skSecond);
                                                        skillThird.push(skThird);

                                                        clientFirst.push(clFirst);
                                                        clientSecond.push(clSecond);
                                                        clientThird.push(clThird);

                                                        teamFirst.push(tmFirst);
                                                        teamSecond.push(tmSecond);
                                                        teamThird.push(tmThird);

                                                        materialFirst.push(mtFirst);
                                                        materialSecond.push(mtSecond);
                                                        materialThird.push(mtThird);

                                                        leadershipFirst.push(ldFirst);
                                                        leadershipSecond.push(ldSecond);
                                                        leadershipThird.push(ldThird);

                                                        organizationFirst.push(orgFirst);
                                                        organizationSecond.push(orgSecond);
                                                        organizationThird.push(orgThird);

                                                        societalFirst.push(scFirst);
                                                        societalSecond.push(scSecond);
                                                        societalThird.push(scThird);

                                                        projectFirst.push(pjFirst);
                                                        projectSecond.push(pjSecond);
                                                        projectThird.push(pjThird);

                                                        organizationCultureFirst.push(culFirst);
                                                        organizationCultureSecond.push(culSecond);
                                                        organizationCultureThird.push(culThird);

                                                        characterFirst.push(chFirst);
                                                        characterSecond.push(chSecond);
                                                        characterThird.push(chThird);

                                                        /*GAP REPORT LOGIC CODE*/

                                                        /*GAP RAPORT*/
                                                        let arrayNameCard = [
                                                            'Knowledge Progress',
                                                            'Client Impact',
                                                            'Team Impact',
                                                            'Skill Progress',
                                                            'Material Progress - Pay & Benefits',
                                                            'Team & Leadership Ethics',
                                                            'Organization Impact',
                                                            'Societal Impact Size',
                                                            'Project Impact',
                                                            'Organization Culture',
                                                            'Character Culture',
                                                            'Role Progress',
                                                            'Task Impact',
                                                            'Social Progress',
                                                            'Social Positive Impact',
                                                            'Group/Team Culture'
                                                        ]

                                                        function letLimit(a) {
                                                            let b = 0;
                                                            if(a <= 10) {
                                                                b = 10;
                                                                return b;
                                                            } else if(a > 10 && a <= 20) {
                                                                b = 20;
                                                                return b;
                                                            } else if(a > 20 && a <= 30) {
                                                                b = 30;
                                                                return b;
                                                            } else if(a > 30 && a <= 40) {
                                                                b = 40;
                                                                return b;
                                                            } else if(a > 40 && a <= 50) {
                                                                b = 50;
                                                                return b;
                                                            } else if(a > 50 && a <= 60) {
                                                                b = 60;
                                                                return b;
                                                            } else if(a > 60 && a <= 70) {
                                                                b = 70;
                                                                return b;
                                                            } else if(a > 70 && a <= 80) {
                                                                b = 80;
                                                                return b;
                                                            } else if(a > 80 && a <= 90) {
                                                                b = 90;
                                                                return b;
                                                            } else {
                                                                b = 100;
                                                                return b;
                                                            }
                                                        }

                                                        //company
                                                        objReportDate = [
                                                            {
                                                                input: `${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`,
                                                                inputProgress: `${Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                nameCard: arrayNameCard[0]
                                                            },
                                                            {
                                                                input: `${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`,
                                                                inputProgress: `${Math.floor((clientSecond.reduce(reduced) / clientSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                nameCard: arrayNameCard[1]
                                                            },
                                                            {
                                                                input: `${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`,
                                                                inputProgress: `${Math.floor((teamSecond.reduce(reduced) / teamSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                nameCard: arrayNameCard[2]
                                                            },
                                                            {
                                                                input: `${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`,
                                                                inputProgress: `${Math.floor((skillSecond.reduce(reduced) / skillSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                nameCard: arrayNameCard[3]
                                                            },
                                                            {
                                                                input: `${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`,
                                                                inputProgress: `${Math.floor((materialSecond.reduce(reduced) / materialSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                nameCard: arrayNameCard[4]
                                                            },
                                                            {
                                                                input: `${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`,
                                                                inputProgress: `${Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                nameCard: arrayNameCard[5]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationSecond.reduce(reduced) / organizationSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                nameCard: arrayNameCard[6]
                                                            },
                                                            {
                                                                input: `${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`,
                                                                inputProgress: `${Math.floor((societalSecond.reduce(reduced) / societalSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                nameCard: arrayNameCard[7]
                                                            },
                                                            {
                                                                input: `${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`,
                                                                inputProgress: `${Math.floor((projectSecond.reduce(reduced) / projectSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                nameCard: arrayNameCard[8]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                nameCard: arrayNameCard[9]
                                                            },
                                                            {
                                                                input: `${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`,
                                                                inputProgress: `${Math.floor((characterSecond.reduce(reduced) / characterSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                nameCard: arrayNameCard[10]
                                                            }
                                                        ]
                                                        /*END GAP REPORT LOGIC CODE*/

                                                        var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                        var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                        var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                        var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                        var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                        var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                        var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                        var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                        var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                        var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                        var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                        var satisfactionITemperatures = [];
                                                        satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                            [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                            [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                        document.getElementById("satisfaction-company").getContext("2d").clearRect(0, 0, 810, 180);
                                                        document.getElementById("satisfaction-company-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                        satisfactionITemperatures.forEach(elem => {

                                                            var c = document.getElementById("satisfaction-company");
                                                            var ctx = c.getContext("2d");
                                                            ctx.beginPath();
                                                            ctx.fillStyle = "rgba(255, 255, 255)";
                                                            ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctx.fill();

                                                            var cModal = document.getElementById("satisfaction-company-modal");
                                                            var ctxModal = cModal.getContext("2d");
                                                            ctxModal.beginPath();
                                                            ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                            ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctxModal.fill();

                                                            let  itemSatisfactionITemperatureCompany = JSON.stringify(satisfactionITemperatures)
                                                            if(sessionStorage.getItem("itemSatisfactionITemperatureCompany") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemSatisfactionITemperatureCompany")
                                                            }
                                                            sessionStorage.setItem("itemSatisfactionITemperatureCompany", itemSatisfactionITemperatureCompany)
                                                        })
                                                    }
                                                }
                                                    @elseif(Auth::user()->chief === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID63_TEXT"] == department) {
                                                        let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                        let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                        let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                        let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                        let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                        let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                        let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                        let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                        let pjFirst = el["values"]["QID30_1"];
                                                        let culFirst = el["values"]["QID31_1"];
                                                        let chFirst = el["values"]["QID32_1"];

                                                        let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                        let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                        let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                        let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                        let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                        let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                        let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                        let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                        let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                        let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                        let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                        let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                        let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                        let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                        let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                        let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                        let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                        let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                        let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                        let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                        let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                        let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                        knoweledgeFirst.push(knFirst);
                                                        knoweledgeSecond.push(knSecond);
                                                        knoweledgeThird.push(knThird);

                                                        skillFirst.push(skFirst);
                                                        skillSecond.push(skSecond);
                                                        skillThird.push(skThird);

                                                        clientFirst.push(clFirst);
                                                        clientSecond.push(clSecond);
                                                        clientThird.push(clThird);

                                                        teamFirst.push(tmFirst);
                                                        teamSecond.push(tmSecond);
                                                        teamThird.push(tmThird);

                                                        materialFirst.push(mtFirst);
                                                        materialSecond.push(mtSecond);
                                                        materialThird.push(mtThird);

                                                        leadershipFirst.push(ldFirst);
                                                        leadershipSecond.push(ldSecond);
                                                        leadershipThird.push(ldThird);

                                                        organizationFirst.push(orgFirst);
                                                        organizationSecond.push(orgSecond);
                                                        organizationThird.push(orgThird);

                                                        societalFirst.push(scFirst);
                                                        societalSecond.push(scSecond);
                                                        societalThird.push(scThird);

                                                        projectFirst.push(pjFirst);
                                                        projectSecond.push(pjSecond);
                                                        projectThird.push(pjThird);

                                                        organizationCultureFirst.push(culFirst);
                                                        organizationCultureSecond.push(culSecond);
                                                        organizationCultureThird.push(culThird);

                                                        characterFirst.push(chFirst);
                                                        characterSecond.push(chSecond);
                                                        characterThird.push(chThird);

                                                        /*GAP REPORT LOGIC CODE*/

                                                        /*GAP RAPORT*/
                                                        let arrayNameCard = [
                                                            'Knowledge Progress',
                                                            'Client Impact',
                                                            'Team Impact',
                                                            'Skill Progress',
                                                            'Material Progress - Pay & Benefits',
                                                            'Team & Leadership Ethics',
                                                            'Organization Impact',
                                                            'Societal Impact Size',
                                                            'Project Impact',
                                                            'Organization Culture',
                                                            'Character Culture',
                                                            'Role Progress',
                                                            'Task Impact',
                                                            'Social Progress',
                                                            'Social Positive Impact',
                                                            'Group/Team Culture'
                                                        ]

                                                        objReportDate = [
                                                            {
                                                                input: `${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`,
                                                                inputProgress: `${Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                nameCard: arrayNameCard[0]
                                                            },
                                                            {
                                                                input: `${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`,
                                                                inputProgress: `${Math.floor((clientSecond.reduce(reduced) / clientSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                nameCard: arrayNameCard[1]
                                                            },
                                                            {
                                                                input: `${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`,
                                                                inputProgress: `${Math.floor((teamSecond.reduce(reduced) / teamSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                nameCard: arrayNameCard[2]
                                                            },
                                                            {
                                                                input: `${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`,
                                                                inputProgress: `${Math.floor((skillSecond.reduce(reduced) / skillSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                nameCard: arrayNameCard[3]
                                                            },
                                                            {
                                                                input: `${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`,
                                                                inputProgress: `${Math.floor((materialSecond.reduce(reduced) / materialSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                nameCard: arrayNameCard[4]
                                                            },
                                                            {
                                                                input: `${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`,
                                                                inputProgress: `${Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                nameCard: arrayNameCard[5]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationSecond.reduce(reduced) / organizationSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                nameCard: arrayNameCard[6]
                                                            },
                                                            {
                                                                input: `${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`,
                                                                inputProgress: `${Math.floor((societalSecond.reduce(reduced) / societalSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                nameCard: arrayNameCard[7]
                                                            },
                                                            {
                                                                input: `${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`,
                                                                inputProgress: `${Math.floor((projectSecond.reduce(reduced) / projectSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                nameCard: arrayNameCard[8]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                nameCard: arrayNameCard[9]
                                                            },
                                                            {
                                                                input: `${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`,
                                                                inputProgress: `${Math.floor((characterSecond.reduce(reduced) / characterSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                nameCard: arrayNameCard[10]
                                                            }
                                                        ]

                                                        sessionStorage.setItem("storageGapReportDepartment", JSON.stringify(objReportDate))
                                                    /*END GAP REPORT LOGIC CODE*/

                                                        var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                        var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                        var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                        var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                        var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                        var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                        var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                        var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                        var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                        var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                        var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                        var satisfactionITemperatures = [];
                                                        satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                            [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                            [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                        document.getElementById("satisfaction-depatment").getContext("2d").clearRect(0, 0, 810, 180);
                                                        document.getElementById("satisfaction-depatment-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                        satisfactionITemperatures.forEach(elem => {

                                                            var c = document.getElementById("satisfaction-depatment");
                                                            var ctx = c.getContext("2d");
                                                            ctx.beginPath();
                                                            ctx.fillStyle = "rgba(255, 255, 255)";
                                                            ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctx.fill();

                                                            var cModal = document.getElementById("satisfaction-depatment-modal");
                                                            var ctxModal = cModal.getContext("2d");
                                                            ctxModal.beginPath();
                                                            ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                            ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctxModal.fill();

                                                            let  itemSatisfactionITemperatureDepartment = JSON.stringify(satisfactionITemperatures)
                                                            if(sessionStorage.getItem("itemSatisfactionITemperatureCompany") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemSatisfactionITemperatureCompany")
                                                            }
                                                            sessionStorage.setItem("itemSatisfactionITemperatureDepartment", itemSatisfactionITemperatureDepartment)
                                                        })
                                                    }
                                                }
                                                    @elseif(Auth::user()->teamlead === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == "{{Auth::user()->name}}") {
                                                        let knFirst = (el["values"]["QID1_2"] - el["values"]["QID1_1"] < 0 || isNaN(el["values"]["QID1_2"] - el["values"]["QID1_1"])) ? 1 : el["values"]["QID1_2"] - el["values"]["QID1_1"];
                                                        let clFirst = (el["values"]["QID2_2"] - el["values"]["QID2_1"] < 0 || isNaN(el["values"]["QID2_2"] - el["values"]["QID2_1"])) ? 1 : el["values"]["QID2_2"] - el["values"]["QID2_1"];
                                                        let tmFirst = (el["values"]["QID3_2"] - el["values"]["QID3_1"] < 0 || isNaN(el["values"]["QID3_2"] - el["values"]["QID3_1"])) ? 1 : el["values"]["QID3_2"] - el["values"]["QID3_1"];
                                                        let skFirst = (el["values"]["QID7_2"] - el["values"]["QID7_1"] < 0 || isNaN(el["values"]["QID7_2"] - el["values"]["QID7_1"])) ? 1 : el["values"]["QID7_2"] - el["values"]["QID7_1"];
                                                        let mtFirst = (el["values"]["QID8_2"] - el["values"]["QID8_1"] < 0 || isNaN(el["values"]["QID8_2"] - el["values"]["QID8_1"])) ? 1 : el["values"]["QID8_2"] - el["values"]["QID8_1"];
                                                        let ldFirst = (el["values"]["QID9_2"] - el["values"]["QID9_1"] < 0 || isNaN(el["values"]["QID9_2"] - el["values"]["QID9_1"])) ? 1 : el["values"]["QID9_2"] - el["values"]["QID9_1"];
                                                        let orgFirst = (el["values"]["QID10_2"] - el["values"]["QID10_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID10_2"] - el["values"]["QID10_1"];
                                                        let scFirst = (el["values"]["QID11_2"] - el["values"]["QID11_1"] < 0 || isNaN(el["values"]["QID10_2"] - el["values"]["QID10_1"])) ? 1 : el["values"]["QID11_2"] - el["values"]["QID11_1"];
                                                        let pjFirst = el["values"]["QID30_1"];
                                                        let culFirst = el["values"]["QID31_1"];
                                                        let chFirst = el["values"]["QID32_1"];

                                                        let knSecond = (el["values"]["QID1_3"] - 4 < 0 || isNaN(el["values"]["QID1_3"] - 4)) ? 1 : el["values"]["QID1_3"] - 4;
                                                        let clSecond = (el["values"]["QID2_3"] - 4 < 0 || isNaN(el["values"]["QID2_3"] - 4)) ? 1 : el["values"]["QID2_3"] - 4;
                                                        let tmSecond = (el["values"]["QID3_3"] - 4 < 0 || isNaN(el["values"]["QID3_3"] - 4)) ? 1 : el["values"]["QID3_3"] - 4;
                                                        let skSecond = (el["values"]["QID7_3"] - 4 < 0 || isNaN(el["values"]["QID7_3"] - 4)) ? 1 : el["values"]["QID7_3"] - 4;
                                                        let mtSecond = (el["values"]["QID8_3"] - 4 < 0 || isNaN(el["values"]["QID8_3"] - 4)) ? 1 : el["values"]["QID8_3"] - 4;
                                                        let ldSecond = (el["values"]["QID9_3"] - 4 < 0 || isNaN(el["values"]["QID9_3"] - 4)) ? 1 : el["values"]["QID9_3"] - 4;
                                                        let orgSecond = (el["values"]["QID10_3"] - 4 < 0 || isNaN(el["values"]["QID10_3"] - 4)) ? 1 : el["values"]["QID10_3"] - 4;
                                                        let scSecond = (el["values"]["QID11_3"] - 4 < 0 || isNaN(el["values"]["QID11_3"] - 4)) ? 1 : el["values"]["QID11_3"] - 4;
                                                        let pjSecond = (el["values"]["QID30_3"] - 4 < 0 || isNaN(el["values"]["QID30_3"] - 4)) ? 1 : el["values"]["QID30_3"] - 4;
                                                        let culSecond = (el["values"]["QID31_3"] - 4 < 0 || isNaN(el["values"]["QID31_3"] - 4)) ? 1 : el["values"]["QID31_3"] - 4;
                                                        let chSecond = (el["values"]["QID32_3"] - 4 < 0 || isNaN(el["values"]["QID32_3"] - 4)) ? 1 : el["values"]["QID32_3"] - 4;

                                                        let knThird = (isNaN(knFirst * knSecond)) ? 1 : knFirst * knSecond;
                                                        let clThird = (isNaN(clFirst * clSecond)) ? 1 : clFirst * clSecond;
                                                        let tmThird = (isNaN(tmFirst * tmFirst)) ? 1 : tmFirst * tmFirst;
                                                        let skThird = (isNaN(skFirst * skFirst)) ? 1 : skFirst * skFirst;
                                                        let mtThird = (isNaN(mtFirst * mtSecond)) ? 1 : mtFirst * mtSecond;
                                                        let ldThird = (isNaN(ldFirst * ldSecond)) ? 1 : ldFirst * ldSecond;
                                                        let orgThird = (isNaN(orgFirst * orgSecond)) ? 1 : orgFirst * orgSecond;
                                                        let scThird = (isNaN(scFirst * scSecond)) ? 1 : scFirst * scSecond;
                                                        let pjThird = (isNaN(pjFirst * pjSecond)) ? 1 : pjFirst * pjSecond;
                                                        let culThird = (isNaN(culFirst * culSecond)) ? 1 : culFirst * culSecond;
                                                        let chThird = (isNaN(chFirst * chSecond)) ? 1 : chFirst * chSecond;

                                                        knoweledgeFirst.push(knFirst);
                                                        knoweledgeSecond.push(knSecond);
                                                        knoweledgeThird.push(knThird);

                                                        skillFirst.push(skFirst);
                                                        skillSecond.push(skSecond);
                                                        skillThird.push(skThird);

                                                        clientFirst.push(clFirst);
                                                        clientSecond.push(clSecond);
                                                        clientThird.push(clThird);

                                                        teamFirst.push(tmFirst);
                                                        teamSecond.push(tmSecond);
                                                        teamThird.push(tmThird);

                                                        materialFirst.push(mtFirst);
                                                        materialSecond.push(mtSecond);
                                                        materialThird.push(mtThird);

                                                        leadershipFirst.push(ldFirst);
                                                        leadershipSecond.push(ldSecond);
                                                        leadershipThird.push(ldThird);

                                                        organizationFirst.push(orgFirst);
                                                        organizationSecond.push(orgSecond);
                                                        organizationThird.push(orgThird);

                                                        societalFirst.push(scFirst);
                                                        societalSecond.push(scSecond);
                                                        societalThird.push(scThird);

                                                        projectFirst.push(pjFirst);
                                                        projectSecond.push(pjSecond);
                                                        projectThird.push(pjThird);

                                                        organizationCultureFirst.push(culFirst);
                                                        organizationCultureSecond.push(culSecond);
                                                        organizationCultureThird.push(culThird);

                                                        characterFirst.push(chFirst);
                                                        characterSecond.push(chSecond);
                                                        characterThird.push(chThird);

                                                        /*GAP REPORT LOGIC CODE*/

                                                        /*GAP RAPORT*/
                                                        let arrayNameCard = [
                                                            'Knowledge Progress',
                                                            'Client Impact',
                                                            'Team Impact',
                                                            'Skill Progress',
                                                            'Material Progress - Pay & Benefits',
                                                            'Team & Leadership Ethics',
                                                            'Organization Impact',
                                                            'Societal Impact Size',
                                                            'Project Impact',
                                                            'Organization Culture',
                                                            'Character Culture',
                                                            'Role Progress',
                                                            'Task Impact',
                                                            'Social Progress',
                                                            'Social Positive Impact',
                                                            'Group/Team Culture'
                                                        ]

                                                        objReportDate = [
                                                            {
                                                                input: `${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`,
                                                                inputProgress: `${Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((knoweledgeThird.reduce(reduced) / knoweledgeThird.length))}`),
                                                                nameCard: arrayNameCard[0]
                                                            },
                                                            {
                                                                input: `${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`,
                                                                inputProgress: `${Math.floor((clientSecond.reduce(reduced) / clientSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((clientThird.reduce(reduced) / clientThird.length))}`),
                                                                nameCard: arrayNameCard[1]
                                                            },
                                                            {
                                                                input: `${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`,
                                                                inputProgress: `${Math.floor((teamSecond.reduce(reduced) / teamSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((teamThird.reduce(reduced) / teamThird.length))}`),
                                                                nameCard: arrayNameCard[2]
                                                            },
                                                            {
                                                                input: `${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`,
                                                                inputProgress: `${Math.floor((skillSecond.reduce(reduced) / skillSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((skillThird.reduce(reduced) / skillThird.length))}`),
                                                                nameCard: arrayNameCard[3]
                                                            },
                                                            {
                                                                input: `${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`,
                                                                inputProgress: `${Math.floor((materialSecond.reduce(reduced) / materialSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((materialThird.reduce(reduced) / materialThird.length))}`),
                                                                nameCard: arrayNameCard[4]
                                                            },
                                                            {
                                                                input: `${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`,
                                                                inputProgress: `${Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((leadershipThird.reduce(reduced) / leadershipThird.length))}`),
                                                                nameCard: arrayNameCard[5]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationSecond.reduce(reduced) / organizationSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationThird.reduce(reduced) / organizationThird.length))}`),
                                                                nameCard: arrayNameCard[6]
                                                            },
                                                            {
                                                                input: `${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`,
                                                                inputProgress: `${Math.floor((societalSecond.reduce(reduced) / societalSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((societalThird.reduce(reduced) / societalThird.length))}`),
                                                                nameCard: arrayNameCard[7]
                                                            },
                                                            {
                                                                input: `${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`,
                                                                inputProgress: `${Math.floor((projectSecond.reduce(reduced) / projectSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((projectThird.reduce(reduced) / projectThird.length))}`),
                                                                nameCard: arrayNameCard[8]
                                                            },
                                                            {
                                                                input: `${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`,
                                                                inputProgress: `${Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((organizationCultureThird.reduce(reduced) / organizationCultureThird.length))}`),
                                                                nameCard: arrayNameCard[9]
                                                            },
                                                            {
                                                                input: `${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`,
                                                                inputProgress: `${Math.floor((characterSecond.reduce(reduced) / characterSecond.length))}`,
                                                                maxInput: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                maxInputProgress: letLimit(`${Math.floor((characterThird.reduce(reduced) / characterThird.length))}`),
                                                                nameCard: arrayNameCard[10]
                                                            }
                                                        ]
                                                        /*END GAP REPORT LOGIC CODE*/


                                                        var satisfactionITemperatureKnowledge = Math.floor((knoweledgeSecond.reduce(reduced) / knoweledgeSecond.length) - (knoweledgeThird.reduce(reduced) / knoweledgeThird.length));
                                                        var satisfactionITemperatureClient = Math.ceil((clientSecond.reduce(reduced) / clientSecond.length) - (clientThird.reduce(reduced) / clientThird.length))
                                                        var satisfactionITemperatureTeam = Math.ceil((teamSecond.reduce(reduced) / teamSecond.length) - (teamThird.reduce(reduced) / teamThird.length))
                                                        var satisfactionITemperatureSkill = Math.ceil((skillSecond.reduce(reduced) / skillSecond.length) - (skillThird.reduce(reduced) / skillThird.length))
                                                        var satisfactionITemperatureMaterial = Math.ceil((materialSecond.reduce(reduced) / materialSecond.length) - (materialThird.reduce(reduced) / materialThird.length))
                                                        var satisfactionITemperatureLeadership = Math.floor((leadershipSecond.reduce(reduced) / leadershipSecond.length) - (leadershipThird.reduce(reduced) / leadershipThird.length))
                                                        var satisfactionITemperatureOrganization = Math.ceil((organizationSecond.reduce(reduced) / organizationSecond.length) - (organizationThird.reduce(reduced) / organizationThird.length))
                                                        var satisfactionITemperatureSocietal = Math.floor((societalSecond.reduce(reduced) / societalSecond.length) - (societalThird.reduce(reduced) / societalThird.length))
                                                        var satisfactionITemperatureProject = Math.floor((projectSecond.reduce(reduced) / projectSecond.length) - (projectThird.reduce(reduced) / projectThird.length))
                                                        var satisfactionITemperatureOrganizationCulture = Math.floor((organizationCultureSecond.reduce(reduced) / organizationCultureSecond.length) - (organizationCultureThird.reduce(reduced) / organizationCultureThird.length))
                                                        var satisfactionITemperatureCharacter = Math.floor((characterSecond.reduce(reduced) / characterSecond.length) - (characterThird.reduce(reduced) / characterThird.length))

                                                        var satisfactionITemperatures = [];
                                                        satisfactionITemperatures.push([satisfactionITemperatureKnowledge, "Knoweledge", 8, 1], [satisfactionITemperatureClient, "Client", 8, 2], [satisfactionITemperatureTeam, "Team", 8, 3], [satisfactionITemperatureSkill, "Skill", 8, 4], [satisfactionITemperatureMaterial, "Material", 8, 5],
                                                            [satisfactionITemperatureLeadership, "Leadership", 8, 6], [satisfactionITemperatureOrganization, "Organization", 8, 7], [satisfactionITemperatureSocietal, "Societal", 8, 8], [satisfactionITemperatureProject, "Project", 8, 9], [satisfactionITemperatureOrganizationCulture, "Culture", 8, 10],
                                                            [satisfactionITemperatureCharacter, "Character", 8, 11]);

                                                        document.getElementById("satisfaction-team").getContext("2d").clearRect(0, 0, 810, 180);
                                                        document.getElementById("satisfaction-team-modal").getContext("2d").clearRect(0, 0, 810, 180);
                                                        satisfactionITemperatures.forEach(elem => {

                                                            var c = document.getElementById("satisfaction-team");
                                                            var ctx = c.getContext("2d");
                                                            ctx.beginPath();
                                                            ctx.fillStyle = "rgba(255, 255, 255)";
                                                            ctx.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctx.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctx.fill();

                                                            var cModal = document.getElementById("satisfaction-team-modal");
                                                            var ctxModal = cModal.getContext("2d");
                                                            ctxModal.beginPath();
                                                            ctxModal.fillStyle = "rgba(255, 255, 255)";
                                                            ctxModal.fillText(elem[1], (elem[0] === 0) ? 420 : 420 + (elem[0] * 43), (13 * elem[3]));
                                                            ctxModal.arc((elem[0] === 0) ? 410 : 410 + (elem[0] * 43), 13 * elem[3], 7, 0, 2 * Math.PI);
                                                            ctxModal.fill();

                                                            let  itemSatisfactionITemperatureTeam = JSON.stringify(satisfactionITemperatures)
                                                            if(sessionStorage.getItem("itemSatisfactionITemperatureCompany") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemSatisfactionITemperatureCompany")
                                                            }
                                                            sessionStorage.setItem("itemSatisfactionITemperatureTeam", itemSatisfactionITemperatureTeam)
                                                        })
                                                    }
                                                }
                                                @endif
                                            })
                                            if (typeof (objReportDate[0]) !== 'undefined') {

                                                objReportDate.sort((a, b) => b.input - a.input).sort((a, b) => (a.input - a.inputProgress) - (b.input - b.inputProgress))

                                                for (let i = 0; i <= objReportDate.length - 1; i++) {
                                                    test4(i)
                                                    let formGapReport = $(`.${i}`)
                                                    let target = formGapReport.get(0).querySelector('.target')
                                                    let limit = formGapReport.get(0).querySelector('.limit')
                                                    let progress = formGapReport.get(0).querySelector('.progress-done')
                                                    let out1 = formGapReport.get(0).querySelector(".panel-report-degrees");
                                                    let out2 = formGapReport.get(0).querySelector(".panel-report-name");
                                                    let out3 = formGapReport.get(0).querySelector(".panel-report-rates");
                                                    let finalValue = 0
                                                    let max = 0;

                                                    // console.log(`${i})`,'objReportDate: ',objReportDate[i]);

                                                    setMaxWidth();

                                                    function setMaxWidth() {
                                                        max = parseInt(objReportDate[i].maxInput, 10);
                                                        max = parseInt(objReportDate[i].maxInputProgress, 10);

                                                        setLimit()
                                                    }

                                                    function setLimit() {
                                                        finalValue = parseInt(objReportDate[i].input, 10);
                                                        changeWidth(target)
                                                        changeWidth(limit)
                                                        setTarget()
                                                    }

                                                    function setTarget() {
                                                        finalValue = parseInt(objReportDate[i].inputProgress, 10);
                                                        changeWidth(progress)
                                                    }

                                                    function changeWidth(obj) {
                                                        obj.style.width = `${(finalValue / max) * 100}%`;
                                                        out()
                                                    }

                                                    function out() {
                                                        out2.innerHTML = `${objReportDate[i].nameCard}`;
                                                        if (objReportDate[i].input === objReportDate[i].inputProgress) {
                                                            out1.innerHTML = `${objReportDate[i].input}`;
                                                            out3.innerHTML = '✓';

                                                            if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#10582D";
                                                                target.style.background = "rgba(0,255,100,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#55D98A 2.94%'
                                                                    + ", "
                                                                    + '#B6EDB1 61.71%'
                                                                    + ", "
                                                                    + 'rgba(213, 243, 189, 0.86) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#D88E20";
                                                                target.style.background = "rgba(255,202,0,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + 'rgba(255, 148, 50, 0.97) -19.19%'
                                                                    + ", "
                                                                    + 'rgba(252, 182, 77, 0.97) 9.81%'
                                                                    + ", "
                                                                    + 'rgba(250, 209, 105, 0.36) 61.71%'
                                                                    + ", "
                                                                    + 'rgba(255, 246, 213, 0.19) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#5e5e5e";
                                                                target.style.background = "rgba(187,187,187,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#BFBFBF -5.46%'
                                                                    + ", "
                                                                    + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                                                    + ", "
                                                                    + 'rgba(241, 241, 241, 0) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#0A8899";
                                                                target.style.background = "rgba(0,226,255,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#63E4F4 -19.19%'
                                                                    + ", "
                                                                    + '#7CDEEB 9.81%'
                                                                    + ", "
                                                                    + '#C5F7FC 61.71%'
                                                                    + ", "
                                                                    + '#F0FEFF 127.35%'
                                                                    + ")";
                                                            }

                                                        } else {
                                                            out1.innerHTML = `${objReportDate[i].inputProgress}` + '/' + `${objReportDate[i].input}`;

                                                            if (objReportDate[i].inputProgress > objReportDate[i].input) {
                                                                let a = objReportDate[i].input;
                                                                let b = objReportDate[i].inputProgress;
                                                                let c = b - a;
                                                                out3.innerHTML = `${c}`;
                                                            } else if (objReportDate[i].inputProgress < objReportDate[i].input) {
                                                                let a = objReportDate[i].input;
                                                                let b = objReportDate[i].inputProgress;
                                                                let c = a - b
                                                                out3.innerHTML = `${c * (-1)}`;
                                                            }
                                                            if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.7) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 1)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#10582D";
                                                                target.style.background = "rgba(0,255,100,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#55D98A 2.94%'
                                                                    + ", "
                                                                    + '#B6EDB1 61.71%'
                                                                    + ", "
                                                                    + 'rgba(213, 243, 189, 0.86) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress >= (objReportDate[i].maxInput * 0.4) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.7)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#D88E20";
                                                                target.style.background = "rgba(255,202,0,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + 'rgba(255, 148, 50, 0.97) -19.19%'
                                                                    + ", "
                                                                    + 'rgba(252, 182, 77, 0.97) 9.81%'
                                                                    + ", "
                                                                    + 'rgba(250, 209, 105, 0.36) 61.71%'
                                                                    + ", "
                                                                    + 'rgba(255, 246, 213, 0.19) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress > (objReportDate[i].maxInput * 0.2) && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.4)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#5e5e5e";
                                                                target.style.background = "rgba(187,187,187,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#BFBFBF -5.46%'
                                                                    + ", "
                                                                    + 'rgba(206, 206, 206, 0.373563) 77.74%'
                                                                    + ", "
                                                                    + 'rgba(241, 241, 241, 0) 127.35%'
                                                                    + ")";
                                                            } else if (objReportDate[i].inputProgress >= 0 && objReportDate[i].inputProgress <= (objReportDate[i].maxInput * 0.2)) {
                                                                limit.style.borderRightWidth = "2px";
                                                                limit.style.borderRightStyle = "solid";
                                                                limit.style.borderRightColor = "#0A8899";
                                                                target.style.background = "rgba(0,226,255,0.1)";
                                                                progress.style.background =
                                                                    "linear-gradient(269.49deg, "
                                                                    + '#63E4F4 -19.19%'
                                                                    + ", "
                                                                    + '#7CDEEB 9.81%'
                                                                    + ", "
                                                                    + '#C5F7FC 61.71%'
                                                                    + ", "
                                                                    + '#F0FEFF 127.35%'
                                                                    + ")";
                                                            }
                                                        }
                                                    }
                                                }
                                                $(".modal-content-flex-4").empty(); $("#box-4").clone().appendTo(".modal-content-flex-4");
                                            }
                                        })
                                        .catch(error => console.log('error', error));
                                }, 4000);
                            })
                            .catch(error => console.log('error', error));
                    }, 4000);
                })
                .catch(error => console.log('error', error));
        })
        // END GAP REPORT AND SATISFACTION ITEMPERATURA CHARTS

        // SATISFACTION INDICATOR CHART
        @if(Auth::user()->manager === "yes")
            if(sessionStorage.getItem("itemsSatisfactionIndicatorCompany") !== null)
            {
                document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);

                var c = document.getElementById("bubble-company");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("bubble-company-modal");
                var ctxModal = cModal.getContext("2d");

                var SatisfactionIndicatorArray = JSON.parse(sessionStorage.getItem("itemsSatisfactionIndicatorCompany"));
                SatisfactionIndicatorArray.forEach(xY => {
                    ctx.beginPath();
                    ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctx.fill();

                    ctxModal.beginPath();
                    ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctxModal.fill();
                })

                document.getElementById("bubble-company").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.font = "bold 8px verdana, sans-serif";
                        ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-company-modal").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.font = "bold 8px verdana, sans-serif";
                        ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctxModal.fill();
                    })
                })

                document.getElementById("bubble-company").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-company-modal").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.fill();
                    })
                })
            }
        @elseif(Auth::user()->chief === "yes")
            if(sessionStorage.getItem("itemsSatisfactionIndicatorDepartment") !== null)
            {
                document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);

                var c = document.getElementById("bubble-department");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("bubble-department-modal");
                var ctxModal = cModal.getContext("2d");

                var SatisfactionIndicatorArray = JSON.parse(sessionStorage.getItem("itemsSatisfactionIndicatorDepartment"));
                SatisfactionIndicatorArray.forEach(xY => {
                    ctx.beginPath();
                    ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctx.fill();

                    ctxModal.beginPath();
                    ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctxModal.fill();
                })

                document.getElementById("bubble-department").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.font = "bold 8px verdana, sans-serif";
                        ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-department-modal").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.font = "bold 8px verdana, sans-serif";
                        ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctxModal.fill();
                    })
                })

                document.getElementById("bubble-department").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-department-modal").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.fill();
                    })
                })
            }
        @elseif(Auth::user()->teamlead === "yes")
            if(sessionStorage.getItem("itemsSatisfactionIndicatorTeam") !== null)
            {
                document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);

                var c = document.getElementById("bubble-team");
                var ctx = c.getContext("2d");

                var cModal = document.getElementById("bubble-team-modal");
                var ctxModal = cModal.getContext("2d");

                var SatisfactionIndicatorArray = JSON.parse(sessionStorage.getItem("itemsSatisfactionIndicatorTeam"));
                SatisfactionIndicatorArray.forEach(xY => {
                    ctx.beginPath();
                    ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctx.fill();

                    ctxModal.beginPath();
                    ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                    ctxModal.fill();
                })

                document.getElementById("bubble-team").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.font = "bold 8px verdana, sans-serif";
                        ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-team-modal").addEventListener("mouseover", (e) =>
                {
                    document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.font = "bold 8px verdana, sans-serif";
                        ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                        ctxModal.fill();
                    })
                })

                document.getElementById("bubble-team").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctx.beginPath();
                        ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctx.fill();
                    })
                })

                document.getElementById("bubble-team-modal").addEventListener("mouseout", (e) =>
                {
                    document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);
                    SatisfactionIndicatorArray.forEach(xY => {
                        ctxModal.beginPath();
                        ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                        ctxModal.fill();
                    })
                })
            }
        @endif
        $(document).ready(function()
        {
            var myHeaders = new Headers();
            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "format": "json",
                "compress": false
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                .then(response => response.json())
                .then(first => {
                    setTimeout(function () {
                        var myHeaders = new Headers();
                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                        myHeaders.append("Content-Type", "application/json");

                        var requestOptions = {
                            method: 'GET',
                            headers: myHeaders,
                            redirect: 'follow'
                        };

                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                            .then(response => response.json())
                            .then(second => {
                                setTimeout(function () {
                                    var myHeaders = new Headers();
                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                    var requestOptions = {
                                        method: 'GET',
                                        headers: myHeaders,
                                        redirect: 'follow'
                                    };

                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            let responses = result["responses"];
                                            responses.forEach(el => {
                                                let department = "{{$department}}";
                                                department = department.replace("&amp;", "&");
                                                @if(Auth::user()->manager === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}") {

                                                        let societal = el["values"]["QID3_1"];
                                                        let client = el["values"]["QID4_1"];
                                                        let knowledge = el["values"]["QID12_1"];
                                                        let team = el["values"]["QID55_1"];
                                                        let organization = el["values"]["QID60_1"];
                                                        let leadership = el["values"]["QID54_1"];
                                                        let progress = el["values"]["QID50_1"];
                                                        let skill = el["values"]["QID4_1"];
                                                        let organizationCulture = el["values"]["QID15_1"];
                                                        let character = el["values"]["QID14_1"];
                                                        let project = el["values"]["QID7_6"];

                                                        let SatisfactionIndicatorArray = [
                                                            [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                            [client, "Client", 3], [team, "Team Impact", 4],
                                                            [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                            [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                            [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                        ]

                                                        document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                                                        document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                        var c = document.getElementById("bubble-company");
                                                        var ctx = c.getContext("2d");

                                                        var cModal = document.getElementById("bubble-company-modal");
                                                        var ctxModal = cModal.getContext("2d");

                                                        SatisfactionIndicatorArray.forEach(xY => {
                                                            ctx.beginPath();
                                                            ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctx.fill();

                                                            ctxModal.beginPath();
                                                            ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctxModal.fill();

                                                            var itemsSatisfactionIndicatorCompany = SatisfactionIndicatorArray;
                                                            if(sessionStorage.getItem("itemsSatisfactionIndicatorCompany") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemsSatisfactionIndicatorCompany")
                                                            }
                                                            sessionStorage.setItem("itemsSatisfactionIndicatorCompany", JSON.stringify(itemsSatisfactionIndicatorCompany));
                                                        })

                                                        document.getElementById("bubble-company").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.font = "bold 8px verdana, sans-serif";
                                                                ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-company-modal").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.font = "bold 8px verdana, sans-serif";
                                                                ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctxModal.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-company").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-company").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-company-modal").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-company-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.fill();
                                                            })
                                                        })
                                                    }
                                                }
                                                @elseif(Auth::user()->chief === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID63_TEXT"] == department) {
                                                        let societal = el["values"]["QID3_1"];
                                                        let client = el["values"]["QID4_1"];
                                                        let knowledge = el["values"]["QID12_1"];
                                                        let team = el["values"]["QID55_1"];
                                                        let organization = el["values"]["QID60_1"];
                                                        let leadership = el["values"]["QID54_1"];
                                                        let progress = el["values"]["QID50_1"];
                                                        let skill = el["values"]["QID4_1"];
                                                        let organizationCulture = el["values"]["QID15_1"];
                                                        let character = el["values"]["QID14_1"];
                                                        let project = el["values"]["QID7_6"];

                                                        let SatisfactionIndicatorArray = [
                                                            [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                            [client, "Client", 3], [team, "Team Impact", 4],
                                                            [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                            [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                            [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                        ]

                                                        document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                                                        document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                        var c = document.getElementById("bubble-department");
                                                        var ctx = c.getContext("2d");

                                                        var cModal = document.getElementById("bubble-department-modal");
                                                        var ctxModal = cModal.getContext("2d");

                                                        SatisfactionIndicatorArray.forEach(xY => {
                                                            ctx.beginPath();
                                                            ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctx.font = "bold 8px verdana, sans-serif";
                                                            ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                            ctx.fill();

                                                            ctxModal.beginPath();
                                                            ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctxModal.font = "bold 8px verdana, sans-serif";
                                                            ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                            ctxModal.fill();

                                                            var itemsSatisfactionIndicatorDepartment = SatisfactionIndicatorArray;
                                                            if(sessionStorage.getItem("itemsSatisfactionIndicatorDepartment") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemsSatisfactionIndicatorDepartment")
                                                            }
                                                            sessionStorage.setItem("itemsSatisfactionIndicatorDepartment", JSON.stringify(itemsSatisfactionIndicatorDepartment));
                                                        })

                                                        document.getElementById("bubble-department").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.font = "bold 8px verdana, sans-serif";
                                                                ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-department-modal").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.font = "bold 8px verdana, sans-serif";
                                                                ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctxModal.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-department").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-department").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-department-modal").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-department-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.fill();
                                                            })
                                                        })
                                                    }
                                                }
                                                    @elseif(Auth::user()->teamlead === "yes")
                                                {
                                                    if (el["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] == "{{Auth::user()->name}}") {
                                                        let societal = el["values"]["QID3_1"];
                                                        let client = el["values"]["QID4_1"];
                                                        let knowledge = el["values"]["QID12_1"];
                                                        let team = el["values"]["QID55_1"];
                                                        let organization = el["values"]["QID60_1"];
                                                        let leadership = el["values"]["QID54_1"];
                                                        let progress = el["values"]["QID50_1"];
                                                        let skill = el["values"]["QID4_1"];
                                                        let organizationCulture = el["values"]["QID15_1"];
                                                        let character = el["values"]["QID14_1"];
                                                        let project = el["values"]["QID7_6"];

                                                        let SatisfactionIndicatorArray = [
                                                            [knowledge, "Knowledge", 1], [societal, "Societal", 2],
                                                            [client, "Client", 3], [team, "Team Impact", 4],
                                                            [leadership, "Team & Leadership Ethics", 5], [organization, "Organization Impact", 6],
                                                            [progress, "Material Progress", 7], [skill, "Skill Progress", 8], [organizationCulture, "Organization Culture", 9],
                                                            [character, "Character Culture", 10], [project, "Project Impact", 11]
                                                        ]

                                                        document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                                                        document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);

                                                        var c = document.getElementById("bubble-team");
                                                        var ctx = c.getContext("2d");

                                                        var cModal = document.getElementById("bubble-team-modal");
                                                        var ctxModal = cModal.getContext("2d");

                                                        SatisfactionIndicatorArray.forEach(xY => {
                                                            ctx.beginPath();
                                                            ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctx.font = "bold 8px verdana, sans-serif";
                                                            ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                            ctx.fill();

                                                            ctxModal.beginPath();
                                                            ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                            ctxModal.font = "bold 8px verdana, sans-serif";
                                                            ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                            ctxModal.fill();

                                                            var itemsSatisfactionIndicatorTeam = SatisfactionIndicatorArray;
                                                            if(sessionStorage.getItem("itemsSatisfactionIndicatorTeam") !== null)
                                                            {
                                                                sessionStorage.removeItem("itemsSatisfactionIndicatorTeam")
                                                            }
                                                            sessionStorage.setItem("itemsSatisfactionIndicatorTeam", JSON.stringify(itemsSatisfactionIndicatorTeam))
                                                        })

                                                        document.getElementById("bubble-team").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.font = "bold 8px verdana, sans-serif";
                                                                ctx.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-team-modal").addEventListener("mouseover", (e) =>
                                                        {
                                                            document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.font = "bold 8px verdana, sans-serif";
                                                                ctxModal.fillText(xY[1], (xY[0] * xY[2] * 5 < 200) ? (xY[0] * xY[2] * 5) + 13 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 + 2 : -10);
                                                                ctxModal.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-team").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-team").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctx.beginPath();
                                                                ctx.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctx.fill();
                                                            })
                                                        })

                                                        document.getElementById("bubble-team-modal").addEventListener("mouseout", (e) =>
                                                        {
                                                            document.getElementById("bubble-team-modal").getContext("2d").clearRect(0, 0, 240, 240);
                                                            SatisfactionIndicatorArray.forEach(xY => {
                                                                ctxModal.beginPath();
                                                                ctxModal.arc((xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, (xY[0] * xY[2] * 5 < 200) ? xY[0] * xY[2] * 5 : -10, 10, 0, 2 * Math.PI)
                                                                ctxModal.fill();
                                                            })
                                                        })
                                                    }
                                                }
                                                @endif
                                            })
                                        })
                                        .catch(error => console.log('error', error));
                                }, 4000);
                            })
                            .catch(error => console.log('error', error));
                    }, 4000);
                })
                .catch(error => console.log('error', error));

        })
        // END SATISFACTION INDICATOR CHART

        // TEAMS CHART
        @if(Auth::user()->manager === "yes")
            if(sessionStorage.getItem("itemTeamChartCompany") !== null)
            {
                let sumTeamsCharts = JSON.parse(sessionStorage.getItem("itemTeamChartCompany"));
                sumTeamsCharts.forEach(sumTeamsChart =>
                {
                    let cTeamsChart = document.getElementById("teamsChart-modal");
                    let ctxTeamsChart = cTeamsChart.getContext("2d");
                    let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                    ctxTeamsChart.beginPath();
                    ctxTeamsChart.fillStyle = "white";
                    ctxTeamsChart.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctxTeamsChart.fill()
                    ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                    ctxTextTeamsChart.fillStyle = "black";
                    let str = sumTeamsChart[1];
                    let from = str.search('@');
                    let answer = str.substring(0,from);
                    ctxTextTeamsChart.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                    let c = document.getElementById("teamsChart");
                    let ctx = c.getContext("2d");
                    let ctxText = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "white";
                    ctx.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctx.fill()
                    ctxText.font = "bold 12px verdana, sans-serif ";
                    ctxText.fillStyle = "black";
                    ctxText.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                })
            }
        @elseif(Auth::user()->chief === "yes")
            if(sessionStorage.getItem("itemTeamChartDepartment") !== null)
            {
                let sumTeamsCharts = JSON.parse(sessionStorage.getItem("itemTeamChartDepartment"));
                sumTeamsCharts.forEach(sumTeamsChart =>
                {
                    let cTeamsChart = document.getElementById("teamsChart-modal");
                    let ctxTeamsChart = cTeamsChart.getContext("2d");
                    let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                    ctxTeamsChart.beginPath();
                    ctxTeamsChart.fillStyle = "white";
                    ctxTeamsChart.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctxTeamsChart.fill()
                    ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                    ctxTextTeamsChart.fillStyle = "black";
                    let str = sumTeamsChart[1];
                    let from = str.search('@');
                    let answer = str.substring(0,from);
                    ctxTextTeamsChart.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                    let c = document.getElementById("teamsChart");
                    let ctx = c.getContext("2d");
                    let ctxText = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "white";
                    ctx.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctx.fill()
                    ctxText.font = "bold 12px verdana, sans-serif ";
                    ctxText.fillStyle = "black";
                    ctxText.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                })
            }
        @elseif(Auth::user()->teamlead === "yes")
            if(sessionStorage.getItem("itemTeamChartTeam") !== null)
            {
                let sumTeamsCharts = JSON.parse(sessionStorage.getItem("itemTeamChartTeam"));
                sumTeamsCharts.forEach(sumTeamsChart =>
                {
                    let cTeamsChart = document.getElementById("teamsChart-modal");
                    let ctxTeamsChart = cTeamsChart.getContext("2d");
                    let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                    ctxTeamsChart.beginPath();
                    ctxTeamsChart.fillStyle = "white";
                    ctxTeamsChart.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctxTeamsChart.fill()
                    ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                    ctxTextTeamsChart.fillStyle = "black";
                    let str = sumTeamsChart[1];
                    let from = str.search('@');
                    let answer = str.substring(0,from);
                    ctxTextTeamsChart.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                    let c = document.getElementById("teamsChart");
                    let ctx = c.getContext("2d");
                    let ctxText = c.getContext("2d");
                    ctx.beginPath();
                    ctx.fillStyle = "white";
                    ctx.ellipse((sumTeamsChart[0]===0)?170:170 + sumTeamsChart[0], (sumTeamsChart[0]===0)?160:160 - sumTeamsChart[0], 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                    ctx.fill()
                    ctxText.font = "bold 12px verdana, sans-serif ";
                    ctxText.fillStyle = "black";
                    ctxText.fillText(answer, (sumTeamsChart[0]===0)?118:118 + sumTeamsChart[0], (sumTeamsChart[0]===0)?162:162 - sumTeamsChart[0])
                })
            }
        @endif
        $(document).ready(function()
        {
            var myHeaders = new Headers();
            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "format": "json",
                "compress": false
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                .then(response => response.json())
                .then(first =>
                {
                    setTimeout(function()
                    {
                        var myHeaders = new Headers();
                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                        myHeaders.append("Content-Type", "application/json");

                        var requestOptions = {
                            method: 'GET',
                            headers: myHeaders,
                            redirect: 'follow'
                        };

                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                            .then(response => response.json())
                            .then(second => {
                                setTimeout(function()
                                {
                                    var myHeaders = new Headers();
                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");

                                    var requestOptions = {
                                        method: 'GET',
                                        headers: myHeaders,
                                        redirect: 'follow'
                                    };

                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                        .then(response => response.json())
                                        .then(result => {
                                            var responses = result["responses"];
                                            var sumTeams = [];
                                            responses.forEach(el =>
                                            {
                                                let department = "{{$department}}";
                                                department = department.replace("&amp;", "&");
                                                @if(Auth::user()->manager === "yes")
                                                    if(el["values"]["QID101_TEXT"] === "{{Auth::user()->company_title}}")
                                                    {
                                                        let firstTeamsChart = isNaN((el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1))?0:(el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1);

                                                        let secondTeamsChart = isNaN(el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"])?0:el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"];

                                                        let thirdTeamsChart = isNaN((el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1))?0:(el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1);

                                                        let sumTeamsChart = firstTeamsChart + secondTeamsChart + thirdTeamsChart;

                                                        let cTeamsChart = document.getElementById("teamsChart-modal");
                                                        let ctxTeamsChart = cTeamsChart.getContext("2d");
                                                        let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                                                        ctxTeamsChart.beginPath();
                                                        ctxTeamsChart.fillStyle = "white";
                                                        ctxTeamsChart.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctxTeamsChart.fill()
                                                        ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                                                        ctxTextTeamsChart.fillStyle = "black";
                                                        let str = el["values"]["QID62_TEXT"];
                                                        let from = str.search('@');
                                                        let answer = str.substring(0,from);
                                                        ctxTextTeamsChart.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)
                                                        let c = document.getElementById("teamsChart");
                                                        let ctx = c.getContext("2d");
                                                        let ctxText = c.getContext("2d");
                                                        ctx.beginPath();
                                                        ctx.fillStyle = "white";
                                                        ctx.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctx.fill()
                                                        ctxText.font = "bold 12px verdana, sans-serif ";
                                                        ctxText.fillStyle = "black";
                                                        ctxText.fillText(answer, (sumTeamsChart===0)?125:125 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)

                                                        sumTeams.push([sumTeamsChart, el["values"]["QID62_TEXT"]])
                                                    }
                                                    if(sessionStorage.getItem("itemTeamChartCompany") !== null)
                                                    {
                                                        sessionStorage.removeItem("itemTeamChartCompany")
                                                    }
                                                sessionStorage.setItem("itemTeamChartCompany", JSON.stringify(sumTeams))
                                                @elseif(Auth::user()->chief === "yes")
                                                    if(el["values"]["QID101_TEXT"] === "{{Auth::user()->company_title}}" && el["values"]["QID63_TEXT"] === department)
                                                    {
                                                        let firstTeamsChart = isNaN((el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1))?0:(el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1);

                                                        let secondTeamsChart = isNaN(el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"])?0:el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"];

                                                        let thirdTeamsChart = isNaN((el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1))?0:(el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1);

                                                        let sumTeamsChart = firstTeamsChart + secondTeamsChart + thirdTeamsChart;

                                                        let cTeamsChart = document.getElementById("teamsChart-modal");
                                                        let ctxTeamsChart = cTeamsChart.getContext("2d");
                                                        let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                                                        ctxTeamsChart.beginPath();
                                                        ctxTeamsChart.fillStyle = "white";
                                                        ctxTeamsChart.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctxTeamsChart.fill()
                                                        ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                                                        ctxTextTeamsChart.fillStyle = "black";
                                                        let str = el["values"]["QID62_TEXT"];
                                                        let from = str.search('@');
                                                        let answer = str.substring(0,from);
                                                        ctxTextTeamsChart.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)
                                                        let c = document.getElementById("teamsChart");
                                                        let ctx = c.getContext("2d");
                                                        let ctxText = c.getContext("2d");
                                                        ctx.beginPath();
                                                        ctx.fillStyle = "white";
                                                        ctx.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctx.fill()
                                                        ctxText.font = "bold 12px verdana, sans-serif ";
                                                        ctxText.fillStyle = "black";
                                                        ctxText.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)

                                                        sumTeams.push([sumTeamsChart, el["values"]["QID62_TEXT"]])
                                                    }
                                                    if(sessionStorage.getItem("itemTeamChartDepartment") !== null)
                                                    {
                                                        sessionStorage.removeItem("itemTeamChartDepartment")
                                                    }
                                                sessionStorage.setItem("itemTeamChartDepartment", JSON.stringify(sumTeams))
                                                @elseif(Auth::user()->teamlead === "yes")
                                                    if(el["values"]["QID101_TEXT"] === "{{Auth::user()->company_title}}" && el["values"]["QID103_TEXT"] === "{{Auth::user()->name}}")
                                                    {
                                                        let firstTeamsChart = isNaN((el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1))?0:(el["values"]["QID1_2"] + el["values"]["QID2_2"] + el["values"]["QID3_2"] + el["values"]["QID7_2"] + el["values"]["QID8_2"] + el["values"]["QID9_2"] + el["values"]["QID10_2"] + el["values"]["QID11_2"]) * (-1);

                                                        let secondTeamsChart = isNaN(el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"])?0:el["values"]["QID1_3"] + el["values"]["QID2_3"] + el["values"]["QID3_3"] + el["values"]["QID7_3"] + el["values"]["QID8_3"] + el["values"]["QID10_3"] + el["values"]["QID11_3"];

                                                        let thirdTeamsChart = isNaN((el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1))?0:(el["values"]["QID2_4"] + el["values"]["QID3_4"]) * (-1);

                                                        let sumTeamsChart = firstTeamsChart + secondTeamsChart + thirdTeamsChart;

                                                        let cTeamsChart = document.getElementById("teamsChart-modal");
                                                        let ctxTeamsChart = cTeamsChart.getContext("2d");
                                                        let ctxTextTeamsChart = cTeamsChart.getContext("2d");
                                                        ctxTeamsChart.beginPath();
                                                        ctxTeamsChart.fillStyle = "white";
                                                        ctxTeamsChart.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctxTeamsChart.fill()
                                                        ctxTextTeamsChart.font = "bold 12px verdana, sans-serif ";
                                                        ctxTextTeamsChart.fillStyle = "black";
                                                        let str = el["values"]["QID62_TEXT"];
                                                        let from = str.search('@');
                                                        let answer = str.substring(0,from);
                                                        ctxTextTeamsChart.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)
                                                        let c = document.getElementById("teamsChart");
                                                        let ctx = c.getContext("2d");
                                                        let ctxText = c.getContext("2d");
                                                        ctx.beginPath();
                                                        ctx.fillStyle = "white";
                                                        ctx.ellipse((sumTeamsChart===0)?170:170 + sumTeamsChart, (sumTeamsChart===0)?160:160 - sumTeamsChart, 25, 65, Math.PI / 2, 0, 2 * Math.PI)
                                                        ctx.fill()
                                                        ctxText.font = "bold 12px verdana, sans-serif ";
                                                        ctxText.fillStyle = "black";
                                                        ctxText.fillText(answer, (sumTeamsChart===0)?118:118 + sumTeamsChart, (sumTeamsChart===0)?162:162 - sumTeamsChart)

                                                        sumTeams.push([sumTeamsChart, el["values"]["QID62_TEXT"]])
                                                    }
                                                    if(sessionStorage.getItem("itemTeamChartTeam") !== null)
                                                    {
                                                        sessionStorage.removeItem("itemTeamChartTeam")
                                                    }
                                                sessionStorage.setItem("itemTeamChartTeam", JSON.stringify(sumTeams))
                                                @endif
                                            })
                                        })
                                        .catch(error => console.log('error', error));
                                }, 4000);
                            })
                            .catch(error => console.log('error', error));
                    }, 4000);
                })
                .catch(error => console.log('error', error));
        })
        // END TEAMS CHART

        @endif

        $(".show-test-results").on("click", function (e) {
            e.preventDefault();
            alert("Please, checking some minutes, your request processed ....");
            var myHeaders = new Headers();
            myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
            myHeaders.append("Content-Type", "application/json");

            var raw = JSON.stringify({
                "format": "json",
                "compress": "false"
            });

            var requestOptions = {
                method: 'POST',
                headers: myHeaders,
                body: raw,
                redirect: 'follow'
            };

            fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses", requestOptions)
                .then(response => response.json())
                .then(first =>
                {
                    setTimeout(function()
                    {
                        var myHeaders = new Headers();
                        myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                        myHeaders.append("Content-Type", "application/json");

                        var requestOptions = {
                            method: 'GET',
                            headers: myHeaders,
                            redirect: 'follow'
                        };

                        fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + first["result"]["progressId"], requestOptions)
                            .then(response => response.json())
                            .then(second =>
                            {
                                setTimeout(function()
                                {
                                    var myHeaders = new Headers();
                                    myHeaders.append("X-API-TOKEN", "OOn8NGeHNOFUH4qMKrpDK9DIbxltIutVcRyS6eNy");
                                    myHeaders.append("Content-Type", "application/json");

                                    var requestOptions = {
                                        method: 'GET',
                                        headers: myHeaders,
                                        redirect: 'follow'
                                    };

                                    fetch("https://sjc1.qualtrics.com/API/v3/surveys/SV_9FtECtejcxTGgL4/export-responses/" + second["result"]["fileId"] + "/file", requestOptions)
                                        .then(response => response.json())
                                        .then(result =>
                                        {
                                            @if(Auth::user()->manager === "yes")
                                            let responses = result["responses"];
                                            let container = [];
                                            responses.forEach(e =>
                                            {
                                                if(e["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}")
                                                {
                                                    container.push(e);
                                                }
                                            })

                                            const link = document.createElement("a");
                                            const file = new Blob([JSON.stringify(container, null, ' ')], {type: 'application/json'});
                                            link.href = URL.createObjectURL(file);
                                            link.download = "results.json";
                                            link.click();
                                            URL.revokeObjectURL(link.href);
                                            @elseif(Auth::user()->chief === "yes")
                                            let responses = result["responses"];
                                            let container = [];
                                            responses.forEach(e =>
                                            {
                                                let department = "{{$department}}";
                                                department = department.replace("&amp;", "&");
                                                console.log(department);
                                                if(e["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && e["values"]["QID63_TEXT"] == department)
                                                {
                                                    container.push(e);
                                                }
                                            })

                                            const link = document.createElement("a");
                                            const file = new Blob([JSON.stringify(container, null, ' ')], {type: 'application/json'});
                                            link.href = URL.createObjectURL(file);
                                            link.download = "results.json";
                                            link.click();
                                            URL.revokeObjectURL(link.href);
                                            @elseif(Auth::user()->teamlead === "yes")
                                            let responses = result["responses"];
                                            let container = [];
                                            responses.forEach(e =>
                                            {
                                                if(e["values"]["QID101_TEXT"] == "{{Auth::user()->company_title}}" && e["values"]["QID103_TEXT"] == "{{Auth::user()->name}}")
                                                {
                                                    container.push(e);
                                                }
                                            })

                                            const link = document.createElement("a");
                                            const file = new Blob([JSON.stringify(container, null, ' ')], {type: 'application/json'});
                                            link.href = URL.createObjectURL(file);
                                            link.download = "results.json";
                                            link.click();
                                            URL.revokeObjectURL(link.href);
                                            @endif
                                        })
                                        .catch(error => console.log('error', error));
                                }, 5000);

                            })
                            .catch(error => console.log('error', error));
                    }, 5000)

                })
                .catch(error => console.log('error', error));
        })

        $(".btn-gapReport").on("click", (e) =>
        {
            e.preventDefault();
            $("body").css("overflow-y", "hidden")
            $(".modal-gapReport").show(300, function()
            {
                /* ... */
            })
        })

        $(".btn-satisfactionIndicatorReport").on("click", (e) =>
        {
            e.preventDefault();
            $("body").css("overflow-y", "hidden");
            $(".modal-satisfactionIndicatorReport").show(300, function()
            {
                /* ... */
            })
        })

        $(".btn-team").on("click", (e) =>
        {
            e.preventDefault();
            $("body").css("overflow-y", "hidden")
            $(".modal-team").show(300, function()
            {
                /* ... */
            })
        })

        $(".close").on("click", function()
        {
            $("body").css("overflow-y", "auto")
            $(".modal-gapReport").hide(300, function()
            {
                /* ... */
            })
            $(".modal-satisfactionIndicatorReport").hide(300, function()
            {
                /* ... */
            })
            $(".modal-team").hide(300, function()
            {
                /* ... */
            })
        })

        $(".btn-satisfactionITemperatureIndex").on("click", function(e)
        {
            e.preventDefault();
            $(".modal-satisfactionITemperatureIndex").show(300, function()
            {
                $("body").css("overflow-y", "hidden");
                $(".company-modal").on("click", e => {
                    e.preventDefault();

                    $(".company-modal").css({
                        "background-color": "blue",
                        "color": "white"
                    });
                    $(".department-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });
                    $(".team-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });

                    $(".satisfaction-depatment-modal").css("display", "none");
                    $(".satisfaction-company-modal").css("display", "block");
                    $(".satisfaction-team-modal").css("display", "none");
                })

                $(".department-modal").on("click", e => {
                    e.preventDefault();

                    $(".company-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });
                    $(".department-modal").css({
                        "background-color": "blue",
                        "color": "white"
                    });
                    $(".teams-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });

                    $(".satisfaction-depatment-modal").css("display", "block");
                    $(".satisfaction-company-modal").css("display", "none");
                    $(".satisfaction-team-modal").css("display", "none");
                })

                $(".teams-modal").on("click", e => {
                    e.preventDefault();

                    $(".company-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });
                    $(".department-modal").css({
                        "background-color": "#ECECEC",
                        "color": "black"
                    });
                    $(".teams-modal").css({
                        "background-color": "blue",
                        "color": "white"
                    });

                    $(".satisfaction-team-modal").css("display", "block");
                    $(".satisfaction-depatment-modal").css("display", "none");
                    $(".satisfaction-company-modal").css("display", "none");
                })
                $(".close").on("click", function(e)
                {
                    e.preventDefault();
                    $(".modal-satisfactionITemperatureIndex").hide(300, function()
                    {
                        $("body").css("overflow-y", "auto");
                    })
                })
            })
        })

        $(document).ready(function () {
            $(".companyBubble-modal").on("click", e => {
                e.preventDefault();

                $(".companyBubble-modal").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".departmentBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teamsBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".teams-dropdown").css({
                    "pointer-events": "none"
                })

                $(".departments-dropdown").css({
                    "pointer-events": "none"
                })

                $(".bubble-department-modal").css("display", "none");
                $(".bubble-company-modal").css("display", "block");
                $(".bubble-team-modal").css("display", "none");
            })

            $(".departmentBubble-modal").on("click", e => {
                e.preventDefault();

                $(".departments-dropdown").css({
                    "pointer-events": "auto"
                });

                $(".companyBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".departmentBubble-modal").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".teamsBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".bubble-department-modal").css("display", "block");
                $(".bubble-company-modal").css("display", "none");
                $(".bubble-team-modal").css("display", "none");
            })

            $(".teamsBubble-modal").on("click", e => {
                e.preventDefault();

                $(".teams-dropdown").css({
                    "pointer-events": "auto"
                });

                $(".companyBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".departmentBubble-modal").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teamsBubble-modal").css({
                    "background-color": "blue",
                    "color": "white"
                });

                $(".bubble-team-modal").css("display", "block");
                $(".bubble-department-modal").css("display", "none");
                $(".bubble-company-modal").css("display", "none");
            })

            $(".companyBubble").on("click", e => {
                e.preventDefault();

                $(".departments-dropdown").css({
                    "pointer-events": "none"
                });

                $(".teams-dropdown").css({
                    "pointer-events": "none"
                })

                $(".companyBubble").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".departmentBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teamsBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".bubble-department").css("display", "none");
                $(".bubble-company").css("display", "block");
                $(".bubble-team").css("display", "none");
            })

            $(".departmentBubble").on("click", e => {
                e.preventDefault();

                $(".departments-dropdown").css({
                    "pointer-events": "auto"
                });

                $(".teams-dropdown").css({
                    "pointer-events": "none"
                })

                $(".companyBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".departmentBubble").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".teamsBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".bubble-department").css("display", "block");
                $(".bubble-company").css("display", "none");
                $(".bubble-team").css("display", "none");
            })

            $(".teamsBubble").on("click", e => {
                e.preventDefault();

                $(".teams-dropdown").css({
                    "pointer-events": "auto"
                });

                $(".departments-dropdown").css({
                    "pointer-events": "none"
                });

                $(".companyBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".departments-dropdown").css({
                    "pointer-events": "none"
                });

                $(".departmentBubble").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teamsBubble").css({
                    "background-color": "blue",
                    "color": "white"
                });

                $(".bubble-team").css("display", "block");
                $(".bubble-department").css("display", "none");
                $(".bubble-company").css("display", "none");
            })
        })

        $(document).ready(function () {

            $(".company").on("click", e => {
                e.preventDefault();

                $(".company").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".department").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teams").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".departments-dropdown-iTemperature").css({
                    "pointer-events": "none"
                })

                $(".teams-dropdown-iTemperature").css({
                    "pointer-events": "none"
                })

                $(".satisfaction-depatment").css("display", "none");
                $(".satisfaction-company").css("display", "block");
                $(".satisfaction-team").css("display", "none");
            })

            $(".department").on("click", e => {
                e.preventDefault();

                $(".company").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".department").css({
                    "background-color": "blue",
                    "color": "white"
                });
                $(".teams").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });

                $(".departments-dropdown-iTemperature").css({
                    "pointer-events": "auto"
                })

                $(".teams-dropdown-iTemperature").css({
                    "pointer-events": "none"
                })

                $(".satisfaction-depatment").css("display", "block");
                $(".satisfaction-company").css("display", "none");
                $(".satisfaction-team").css("display", "none");
            })

            $(".teams").on("click", e => {
                e.preventDefault();

                $(".company").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".department").css({
                    "background-color": "#ECECEC",
                    "color": "black"
                });
                $(".teams").css({
                    "background-color": "blue",
                    "color": "white"
                });

                $(".departments-dropdown-iTemperature").css({
                    "pointer-events": "none"
                })

                $(".teams-dropdown-iTemperature").css({
                    "pointer-events": "auto"
                })

                $(".satisfaction-team").css("display", "block");
                $(".satisfaction-depatment").css("display", "none");
                $(".satisfaction-company").css("display", "none");
            })
        })
    </script>

@endsection
