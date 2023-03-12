<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

<div class="container" style="width: 90%; margin-top: 60px;">
    <form method="POST">
        @csrf

        <label class="form-label">Name: </label>
        <input type="text" name="name" value="{{$data->name}}" class="form-control"><br />

        <label class="form-label">Email: </label>
        <input type="text" name="email" value="{{$data->email}}" class="form-control"><br />

        <label class="form-label">Manager status: </label>
        <input type="text" name="manager" value="{{$data->manager}}" class="form-control"><br />

        <label class="form-label">Chief status: </label>
        <input type="text" name="chief" value="{{$data->chief}}" class="form-control"><br />

        <label class="form-label">Teamlead status: </label>
        <input type="text" name="teamlead" value="{{$data->teamlead}}" class="form-control"><br />

        <button type="submit" class="btn btn-primary">UPDATE!</button>

    </form>
</div>
