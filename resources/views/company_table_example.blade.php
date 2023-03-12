@if(Auth::user()->manager === "yes")
    <table>
        <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>company_manager</th>
            <th>department_chief</th>
            <th>department</th>
        </tr>
        </thead>
        <tbody>
            @foreach($user as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->manager}}</td>
                    <td>{{$row->chief}}</td>
                    <td>{{$row->department}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@elseif(Auth::user()->chief === "yes")
        <table>
            <thead>
            <tr>
                <th>name</th>
                <th>email</th>
                <th>teamlead</th>
                <th>employee</th>
                <th>department</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $row)
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->teamlead}}</td>
                    <td>{{$row->employee}}</td>
                    <td>{{$row->department}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
@elseif(Auth::user()->teamlead === "yes")
    <table>
        <thead>
        <tr>
            <th>name</th>
            <th>email</th>
            <th>employee</th>
            <th>department</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->employee}}</td>
                <td>{{$row->department}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
