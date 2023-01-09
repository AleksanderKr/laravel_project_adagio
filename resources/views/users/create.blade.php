@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">Create New User</div>
    <div class="card-body">
        
        <form action="{{ url('users') }}" method="post">
            {!! csrf_field() !!}
            <label>Username</label><br />
            <input type="text" name="username" id="username" class="form-control"><br />
            <label>First Name</label><br />
            <input type="text" name="first_name" id="first_name" class="form-control"><br />
            <label>Last Name</label><br />
            <input type="text" name="last_name" id="last_name" class="form-control"><br />
            <label>Telephone</label><br />
            <input type="text" name="telephone" id="telephone" class="form-control"><br />
            <label>NIP</label><br />
            <input type="text" name="NIP" id="NIP" class="form-control"><br />
            <label>Password</label><br />
            <input type="text" name="password" id="password" class="form-control"><br />
            <label>Email</label><br />
            <input type="text" name="email" id="email" class="form-control"><br />
            <label>Join Date</label><br />
            <input type="text" name="join_date" id="join_date" class="form-control"><br />

            <input type="submit" value="Save" class="btn btn-success"><br />
        </form>

    </div>
</div>

@endsection