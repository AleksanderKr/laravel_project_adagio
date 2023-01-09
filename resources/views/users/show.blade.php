@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">User data</div>
    <div class="card-body">
        <h5 class="card-title">Username : {{ $users->username }}</h5><br />
        <p class="card-text">First Name: {{ $users->first_name }}</p>
        <p class="card-text">Last Name: {{ $users->last_name }}</p>
        <p class="card-text">Telephone: {{ $users->telephone }}</p>
        <p class="card-text">NIP: {{ $users->NIP }}</p>
        <p class="card-text">Password: {{ $users->password }}</p>
        <p class="card-text">Email: {{ $users->email }}</p>
    </div>
</div>