@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p class="mx-4 my-4">{{$first_name}} you are logged in!</p>

                <div class="card-body">
                    <details>
                        <summary>Account</summary>
                        <form action="api/user/{{$id ?? ''}}?api_token={{$api_token ?? ''}}" method="PUT" class="d-flex flex-column" id="form_update_user">
                            @csrf

                            <input type="hidden" name="api_token" value="{{$api_token}}" id="api_token">

                            <label for="first_name" class="sr-only">First Name</label>
                            <input type="text" name="first_name" id="first_name" placeholder="First name" required value="{{$first_name ?? ''}}" class="my-2">

                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last name" required value="{{$last_name}}" class="my-2">

                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control" value="{{$email ?? ''}}" readonly class="my-2">

                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" autocomplete="new-password" placeholder="Password" required value="Fake_password" class="my-2">

                            <input type="submit" value="Update" class="my-2 btn-dark">
                        </form>
                        <p id="form_update_user_res" class="px-2 py-2 alert-success">Logs here</p>
                        <p id="form_update_user_err" class="px-2 py-2 alert-danger">Errors here</p>
                    </details>
                </div>

                <div class="card-body">
                    <details>
                        <summary>Create an Ads</summary>
                        <form action="api/ads?api_token={{$api_token}}" method="post" class="d-flex flex-column" id="form_ads">
                            <label for="title" class="sr-only">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title" required class="my-2">

                            <label for="description" class="sr-only">Description</label>
                            <input type="textarea" name="description" id="description" placeholder="Description" required class="my-2">

                            <label for="category_id" class="sr-only">Category</label>
                            <select name="category_id" id="category_id">
                                <option value="0" selected>--Please choose an option--</option>
                                <option value="1">Mode, feminin, jean</option>
                                <option value="2">Mode, feminin, pull</option>
                            </select>

                            <label for="price" class="sr-only">Price</label>
                            <input type="number" name="price" id="price" placeholder="Price" required class="my-2">

                            <label for="photograph" class="sr-only">Photograph</label>
                            <input type="file" name="photograph" id="photograph" class="my-2" multiple>

                            <input type="submit" value="Post ad" class="btn-dark my-2">
                        </form>
                        <p id="form_ads_res" class="px-2 py-2 alert-success">Logs here</p>
                        <p id="form_ads_err" class="px-2 py-2 alert-danger">Errors here</p>
                    </details>
                </div>

                <div class="card-body">
                    <details>
                        <summary>Last ads published</summary>
                        <div class="d-flex overflow-auto flex-column">

                            @foreach ($last_ads as $a)
                                <div class="card my-2">
                                    <div class="card-body">

                                        @if (!count($a->media) == 0)
                                            <img src="{{$a->media}}" alt="Picture of {{$a->first_name}}">
                                        @endif

                                        <h5 class="card-title">{{ $a->title }}</h5>
                                        <p class="card-text">{{$a->description}}</p>
                                        <div>
                                            <p class="btn btn-primary">{{$a->price}}€</p>
                                            <p>Published by {{$a->user->first_name}} | {{$a->created_at}}</p>
                                        </div>
                                    </div>
                                    </div>
                            @endforeach

                        </div>
                    </details>
                </div>

                <div class="card-body">
                    <details>
                        <summary>Search ads</summary>
                        <form action="api/ads/search?api_token={{$api_token}}" method="post" class="d-flex flex-column my-2" id="form_search">
                            <label for="search" class="sr-only">Search</label>
                            <input type="search" name="search" id="search" placeholder="Type your search" class="my-2">
                        </form>

                        <details id="form_search_res" class="px-2 py-2 alert-success">
                            <summary>Logs here</summary>
                        </details>
                        <div id="form_search_res_div" class="py-2">

                            </div>

                        <p id="form_search_err" class="mt-2 px-2 py-2 alert-danger">Errors here</p>
                    </details>
                </div>

                <div class="card-body">
                    <details>
                        <summary>Message</summary>

                        <form action="" method="post">

                        </form>
                    </details>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
