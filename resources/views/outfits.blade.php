@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <h1>Outfits</h1>
        </div>
            <ul class="page__items page__outfits">
                @foreach($outfits as $outfit)
                <a href="/o/{{$outfit->id}}">
                    <li class="page__outfits__item">
                        <h3 class="page__outfits__title">{{$outfit->name}}</h3>

                        <ul class="page__items page__outfits__items">
                            @foreach($outfit->items as $item)
                                <li><img src="https://test-lewis.s3-eu-west-1.amazonaws.com/wardrobe/{{$item->image}}" class="page__outfits__items__thumbnail"></li>
                            @endforeach
                        </ul>
                    </li>
                </a>
                @endforeach
            </ul>
    </div>

@endsection