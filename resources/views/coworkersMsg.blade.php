<b>Hello, {{$name}}!</b>
You are an employee of the {{$company}}.
Your department: {{$department}}.
@if($supervisor !== null)Your supervisor: {{$supervisor}}.@endif
<br />

<p><i>Your personal link for testing: {{$link}}.</i></p><br />

<p><b>*** IMPORTANTLY!</b></p>
For correct identification, enter the following data in the first block of the survey:<br /><br />

the company name: {{$company}}<br />
department: {{$department}}
@if($supervisor !== null)<br />supervisor: {{$supervisor}}@endif
