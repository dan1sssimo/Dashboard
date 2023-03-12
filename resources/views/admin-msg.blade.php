@if($test == 0)
    Hello, {{$name}}! You are a {{$status}} of the {{$company}} company. <br />
    Now, you can get more control above your employees! <br />
    Data for login: <br />
    login: {{$email}} <br />
    password: {{$password}} <br /><br />
    Use this link in order to authorization: {{$link}} <br /> <br />
@else
    Hello, {{$name}}! You are a {{$status}} of the {{$company}} company. <br />
    Now, you can get more control above your employees as a {{$status}} of the {{$department}}! <br />
    Data for login: <br />
    login: {{$email}} <br />
    password: {{$password}} <br /><br />
    Use this link in order to authorization: {{$link}} <br /> <br />

    Also, you have to pass test in order to we can to improve our relationship due to your test results. <br />
    Link for testing: {{$test}}.<br /><br />

    <p><b>*** IMPORTANTLY!</b></p>
    For correct identification, enter the following data in the first block of the survey:<br /><br />

    email: {{$email}}<br />
    the company name: {{$company}}<br />
    department: {{$department}}

    <br /><br />

    Have a nice day!
@endif
