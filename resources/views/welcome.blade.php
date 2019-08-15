@extends('layout')

@section('content')

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Want</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Have</a>
  </li>
</ul>

<div class="col-12">
    <input type="text" placeholder="Search..." class="form-control" id="search">
</div>

<div class="create__outfit">
    <div class="create__outfit__content">
        <h4>Create outfit</h4>

        <form method="POST" action="/store-outfit">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ csrf_field() }}
        
        <ul class="page__fixed__selected"></ul>

        <div class="form-group">
            <label>Name (optional)</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label for="type">Season</label>
            <select name="season" class="form-control">
                <option value="Black">Summer</option>
                <option value="White">Winter</option>
                <option value="Spring">Spring</option>
                <option value="Autumn">Autumn</option>
            </select>
        </div>

        <div class="form-group">
            <label for="occasion">Occasion (Optional)</label>
            <input list="item-occasion" id="occasion" name="occasion" class="form-control" />

            <datalist id="item-occasion">
                <option value="Beach">
                <option value="Party">
                <option value="Work">
                <option value="Home">
            </datalist>
            <div class="helper">E.g Work, Party, Beach, Work, Home</div>
        </div>

        <div id="outfit_image_ids"></div>

        <div class="form-group">
            <label>Schedule</label>
            <input type="text" class="form-control" name="schedule">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Add outfit">
        </div>

        </form>

    </div>
</div>

<aside class="sidebar">
    <h4>Filter</h4>

    <ul class="sidebar__categories">
        <li data-id="Type" class="sidebar__categories__item">
            <div class="sidebar__categories__item__selector">Colour</div>
            <ul class="sidebar__categories__item__options" id="filter-colours">
                <li data-id="Black" data-parent="Colour" class="sidebar__categories__item__options__item">Black</li>
                <li data-id="White" data-parent="Colour" class="sidebar__categories__item__options__item">White</li>
                <li data-id="Blue" data-parent="Colour" class="sidebar__categories__item__options__item">Blue</li>
                <li data-id="Brown" data-parent="Colour" class="sidebar__categories__item__options__item">Brown</li>
                <li data-id="Beige" data-parent="Colour" class="sidebar__categories__item__options__item">Beige</li>
                <li data-id="Green" data-parent="Colour" class="sidebar__categories__item__options__item">Green</li>
                <li data-id="Grey" data-parent="Colour" class="sidebar__categories__item__options__item">Grey</li>
                <li data-id="Navy" data-parent="Colour" class="sidebar__categories__item__options__item">Navy</li>
                <li data-id="Pink" data-parent="Colour" class="sidebar__categories__item__options__item">Pink</li>
                <li data-id="Red" data-parent="Colour" class="sidebar__categories__item__options__item">Red</li>
                <li data-id="Purple" data-parent="Colour" class="sidebar__categories__item__options__item">Purple</li>
                <li data-id="Yellow" data-parent="Colour" class="sidebar__categories__item__options__item">Yellow</li>
                <li data-id="Multi" data-parent="Colour" class="sidebar__categories__item__options__item">Multi</li>
            </ul>
        </li>
        <li data-id="Type" class="sidebar__categories__item">
            <div class="sidebar__categories__item__selector">Type</div>
            <ul class="sidebar__categories__item__options" id="filter-type">
                <li data-id="Clothing" data-parent="Type" class="sidebar__categories__item__options__item">Clothing</li>
                <li data-id="Shoes" data-parent="Type" class="sidebar__categories__item__options__item">Shoes</li>
                <li data-id="Accessories" data-parent="Type" class="sidebar__categories__item__options__item">Accessories</li>
                <li data-id="Activewear" data-parent="Type" class="sidebar__categories__item__options__item">Activewear</li>
            </ul>
        </li>
        <li data-id="Type" class="sidebar__categories__item">
            <div class="sidebar__categories__item__selector">Category</div>
            <ul class="sidebar__categories__item__options" id="filter-category">
                <li data-id="Coats-Jacket" data-parent="Category" class="sidebar__categories__item__options__item">Coats & Jacket</li>
                <li data-id="Dresses" data-parent="Category" class="sidebar__categories__item__options__item">Dresses</li>
                <li data-id="Hoodies-Sweatshirts" data-parent="Category" class="sidebar__categories__item__options__item">Hoodies & Sweatshirts</li>
                <li data-id="Jeans" data-parent="Category" class="sidebar__categories__item__options__item">Jeans</li>
                <li data-id="Jumpers-Cardigans" data-parent="Category" class="sidebar__categories__item__options__item">Jumpers & Cardigans</li>
                <li data-id="Jumpsuits-Playsuits" data-parent="Category" class="sidebar__categories__item__options__item">Jumpsuits & Playsuits</li>
                <li data-id="Lingerie-Nightwear" data-parent="Category" class="sidebar__categories__item__options__item">Lingerie & Nightwear</li>
                <li data-id="Loungewear" data-parent="Category" class="sidebar__categories__item__options__item">Loungewear</li>
                <li data-id="Pants-Leggings" data-parent="Category" class="sidebar__categories__item__options__item">Pants & Leggings</li>
                <li data-id="Shorts" data-parent="Category" class="sidebar__categories__item__options__item">Shorts</li>
                <li data-id="Skirts" data-parent="Category" class="sidebar__categories__item__options__item">Skirts</li>
                <li data-id="Swimsuits-Beachwear" data-parent="Category" class="sidebar__categories__item__options__item">Swimsuits & Beachwear</li>
                <li data-id="Tops" data-parent="Category" class="sidebar__categories__item__options__item">Tops</li>
                <li data-id="Tracksuits" data-parent="Category" class="sidebar__categories__item__options__item">Tracksuits</li>
                <li data-id="Twopiece-Outfits" data-parent="Category" class="sidebar__categories__item__options__item">Twopiece Outfits</li>

                <li data-id="Boots" data-parent="Category" class="sidebar__categories__item__options__item">Boots</li>
                <li data-id="Flats" data-parent="Category" class="sidebar__categories__item__options__item">Flats</li>
                <li data-id="Heels" data-parent="Category" class="sidebar__categories__item__options__item">Heels</li>
                <li data-id="Loafers" data-parent="Category" class="sidebar__categories__item__options__item">Loafers</li>
                <li data-id="Sandals" data-parent="Category" class="sidebar__categories__item__options__item">Sandals</li>
                <li data-id="Sneakers" data-parent="Category" class="sidebar__categories__item__options__item">Sneakers</li>
                <li data-id="Socks-Tights" data-parent="Category" class="sidebar__categories__item__options__item">Socks & Tights</li>

                <li data-id="Bags-Purses" data-parent="Category" class="sidebar__categories__item__options__item">Bags & Purses</li>
                <li data-id="Belts" data-parent="Category" class="sidebar__categories__item__options__item">Belts</li>
                <li data-id="Hair-Accessories" data-parent="Category" class="sidebar__categories__item__options__item">Hair Accessories</li>
                <li data-id="Hats" data-parent="Category" class="sidebar__categories__item__options__item">Hats</li>
                <li data-id="Jewellery" data-parent="Category" class="sidebar__categories__item__options__item">Jewellery</li>
                <li data-id="Scarves" data-parent="Category" class="sidebar__categories__item__options__item">Scarves</li>
                <li data-id="Sunglasses" data-parent="Category" class="sidebar__categories__item__options__item">Sunglasses</li>
                <li data-id="Watches" data-parent="Category" class="sidebar__categories__item__options__item">Watches</li>

                <li data-id="Sports-Bras" data-parent="Category" class="sidebar__categories__item__options__item">Sports Bras</li>
                <li data-id="Leggings" data-parent="Category" class="sidebar__categories__item__options__item">Leggings</li>
                <li data-id="Watches" data-parent="Category" class="sidebar__categories__item__options__item">Watches</li>

            </ul>
        </li>
        <li data-id="Season" class="sidebar__categories__item">
            <div class="sidebar__categories__item__selector">Season</div>
            <ul class="sidebar__categories__item__options" id="filter-season">
                <li data-id="Summer" data-parent="Season" class="sidebar__categories__item__options__item">Summer</li>
                <li data-id="Winter" data-parent="Season" class="sidebar__categories__item__options__item">Winter</li>
                <li data-id="Spring" data-parent="Season" class="sidebar__categories__item__options__item">Spring</li>
                <li data-id="Autumn" data-parent="Season" class="sidebar__categories__item__options__item">Autumn</li>
            </ul>
        </li>

        <li data-id="Season" class="sidebar__categories__item">
            <div class="sidebar__categories__item__selector">Occasion</div>
            <ul class="sidebar__categories__item__options" id="filter-occasion">
                <li data-id="Beach" data-parent="Occasion" class="sidebar__categories__item__options__item">Beach</li>
                <li data-id="Party" data-parent="Occasion" class="sidebar__categories__item__options__item">Party</li>
                <li data-id="Work" data-parent="Occasion" class="sidebar__categories__item__options__item">Work</li>
                <li data-id="Home" data-parent="Occasion" class="sidebar__categories__item__options__item">Home</li>
            </ul>
        </li>

    </ul>

    <button class="btn btn-info btn-block btn-large" id="reset-filters">Reset Filters</button>

</aside>

<div class="page">
<div class="container">

    <div class="row">

        <div class="col-6"> 
            <ul class="page__actions">
                <li><a href="">Sort</a></li>
                <li><a href="">Filter</a></li>
            </ul>
        </div>

        <div class="col-6 toggles text-right">   

            <button class="btn-tertiary active" id="stack">
                <svg width="19px" height="18px" viewBox="0 0 19 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Select" transform="translate(-300.000000, -137.000000)" fill="#000000" fill-rule="nonzero">
                            <path d="M318,147 L301,147 C300.45,147 300,147.45 300,148 L300,154 C300,154.55 300.45,155 301,155 L318,155 C318.55,155 319,154.55 319,154 L319,148 C319,147.45 318.55,147 318,147 Z M318,137 L301,137 C300.45,137 300,137.45 300,138 L300,144 C300,144.55 300.45,145 301,145 L318,145 C318.55,145 319,144.55 319,144 L319,138 C319,137.45 318.55,137 318,137 Z" id="Shape"></path>
                        </g>
                    </g>
                </svg> 
            </button>
            <button class="btn-tertiary" id="grid">
                <svg width="18px" height="18px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Select" transform="translate(-341.000000, -137.000000)" fill="#000000" fill-rule="nonzero">
                            <path d="M341,145.307692 L349.181818,145.307692 L349.181818,137 L341,137 L341,145.307692 Z M341,155 L349.181818,155 L349.181818,146.692308 L341,146.692308 L341,155 Z M350.818182,155 L359,155 L359,146.692308 L350.818182,146.692308 L350.818182,155 Z M350.818182,145.307692 L359,145.307692 L359,137 L350.818182,137 L350.818182,145.307692 Z" id="Shape"></path>
                        </g>
                    </g>
                </svg>
            </button>
            
        </div>
    </div>

    <div class="row">
        <div class="col-12">

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <ul class="page__items">
                    @foreach($want as $item)
                        <li class="item" 
                            data-id="{{$item->id}}"
                            data-status="{{$item->status}}"
                            data-type="{{$item->type}}"
                            data-category="{{$item->category}}"
                            data-colour="{{$item->colour}}"
                            data-season="{{$item->season}}"
                            data-occasion="{{$item->occasion}}"
                            data-fabric="{{$item->fabric}}"
                            data-quality="{{$item->quality}}"
                            data-brand="{{$item->brand}}"
                            data-year="{{$item->year}}"
                            data-price="{{$item->price}}"
                            data-image="{{$item->image}}"
                        >
                        <span class="d-none">{{$item->status}}</span>
                        <span class="d-none">{{$item->type}}</span>
                        <span class="d-none">{{$item->category}}</span>
                        <span class="d-none">{{$item->colour}}</span>
                        <span class="d-none">{{$item->season}}</span>
                        <span class="d-none">{{$item->occasion}}</span>
                        <span class="d-none">{{$item->fabric}}</span>
                        <span class="d-none">{{$item->quality}}</span>
                        <span class="d-none">{{$item->brand}}</span>
                        <span class="d-none">{{$item->year}}</span>
                        <span class="d-none">{{$item->price}}</span>
                            <img src="https://d3d4x44eptevwm.cloudfront.net/md/wardrobe/{{$item->image}}">
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <ul class="page__items">
                    @foreach($have as $item)
                        <li class="item" 
                            data-id="{{$item->id}}"
                            data-status="{{$item->status}}"
                            data-type="{{$item->type}}"
                            data-category="{{$item->category}}"
                            data-colour="{{$item->colour}}"
                            data-season="{{$item->season}}"
                            data-occasion="{{$item->occasion}}"
                            data-fabric="{{$item->fabric}}"
                            data-quality="{{$item->quality}}"
                            data-brand="{{$item->brand}}"
                            data-year="{{$item->year}}"
                            data-price="{{$item->price}}"
                            data-image="{{$item->image}}"
                        >
                        <span class="d-none">{{$item->status}}</span>
                        <span class="d-none">{{$item->type}}</span>
                        <span class="d-none">{{$item->category}}</span>
                        <span class="d-none">{{$item->colour}}</span>
                        <span class="d-none">{{$item->season}}</span>
                        <span class="d-none">{{$item->occasion}}</span>
                        <span class="d-none">{{$item->fabric}}</span>
                        <span class="d-none">{{$item->quality}}</span>
                        <span class="d-none">{{$item->brand}}</span>
                        <span class="d-none">{{$item->year}}</span>
                        <span class="d-none">{{$item->price}}</span>
                            <img src="https://d3d4x44eptevwm.cloudfront.net/md/wardrobe/{{$item->image}}">
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

            <div class="page__fixed">
                <ul class="page__fixed__selected"></ul>
                <p class="text-center"><span class="data--selected">0</span> items selected</p>
                <button class="btn btn-info btn-block btn-large">Add to existing outfit</button>
                <button class="btn btn-dark btn-block btn-large" id="create-outfit">Create outfit with selected</button>
            </div>

        </div>
    </div>

</div>
</div>

@endsection