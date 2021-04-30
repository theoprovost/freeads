@foreach ($ads as $a)
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