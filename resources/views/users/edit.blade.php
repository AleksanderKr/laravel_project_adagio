@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">Edit User</div>
    <div class="card-body">

        <form action="{{ url('users/' . $users->id) }}" method="post">
            {!! csrf_field() !!}
            @method("PATCH")
            <input type="hidden" name="id" id="id" value="{{ $users->id }}" />
            <label>Username</label><br />
            <input type="text" name="username" id="username" value="{{ $users->username }}" class="form-control"><br />
            <label>First Name</label><br />
            <input type="text" name="first_name" id="first_name" value="{{ $users->first_name }}" class="form-control"><br />
            <label>Last Name</label><br />
            <input type="text" name="last_name" id="last_name" value="{{ $users->last_name }}" class="form-control"><br />
            <label>Telephone</label><br />
            <input type="text" name="telephone" id="telephone" value="{{ $users->telephone }}" class="form-control"><br />
            <label>NIP</label><br />
            <input type="text" name="NIP" id="NIP" value="{{ $users->NIP }}" class="form-control"><br />
            <label>Password</label><br />
            <input type="text" name="password" id="password" value="{{ $users->password }}" class="form-control"><br />
            <label>Email</label><br />
            <input type="text" name="email" id="email" value="{{ $users->email }}" class="form-control"><br />
            <label>Join Date</label><br />
            <input type="text" name="join_date" id="join_date" value="{{ $users->join_date }}" class="form-control"><br />
            <input type="submit" value="Update" class="btn btn-success"><br />
        </form>


    </div>
</div>

@endsection