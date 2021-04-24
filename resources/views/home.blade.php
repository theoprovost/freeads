@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    <details>
                        <summary>Account</summary>
                        <form action="/user/{{$id ?? ''}}" method="post" class="d-flex flex-column">
                            @csrf

                            <label for="first_name" class="sr-only">First Name</label>
                            <input type="text" name="first_name" id="first_name" placeholder="First name" required value="{{$first_name ?? ''}}">

                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last name" required value="{{$last_name}}">

                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{$email ?? ''}}" readonly>

                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" autocomplete="new-password" placeholder="Password" required value="Fake_password">

                            <input type="submit" value="Update" class="m-2">
                        </form>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
