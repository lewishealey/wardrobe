@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-12">

            <h1>{{$outfit->name}}</h1>
            <ul class="page__outfits">
                @foreach($outfit->items as $item)
                    <li data-order="{{$item->pivot->order}}" data-priority="{{$item->pivot->priority}}">
                        <img src="https://test-lewis.s3-eu-west-1.amazonaws.com/wardrobe/{{$item->image}}" width="100">
                    </li>
                @endforeach
            </ul> 
        </div>
    </div>

@endsection