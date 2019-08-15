@extends('layout')

@section('content')

<div class="row">
<div class="col-md-12">

    <h1>Add Item</h1>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Want</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Have</a>
        </li>
    </ul>

    <form method="POST" action="/store-item">
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

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-group">
                    <input type="text" class="form-control" name="link" id="want-link" placeholder="Enter a your link and watch magic happen!">
                    <a href="#add-images">Add your own images too</a>
                </div>

                <div class="form-group" id="images">
                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <label>Upload your images below</label>
                <div class="upload__state-upload">
                    <input type="file" id="files" name="image" class="inputfile form-control" accept="image/*;capture=camera" multiple/>
                    <label for="files" id="inputFile">Click to upload example jpegs<i class="material-icons">add</i></label>
                </div>

                <div id="results"></div>
            </div>

        </div>
    

        <input type="hidden" name="status" value="want">

    <div class="form-group">
        <input list="item-type" id="type" name="type" class="form-control" placeholder="Type e.g clothing, shoes, accessories" required/>

        <datalist id="item-type">
            <option value="Clothing">
            <option value="Shoes">
            <option value="Accessories">
            <option value="Activewear">
        </datalist>
    </div>

    <div class="form-group">
        <input list="item-category" id="category" name="category" class="form-control" placeholder="Category e.g Jacket, Heels, Sneakers" required/>

        <datalist id="item-category">
            <option value="Coats & Jacket">
            <option value="Dresses">
            <option value="Hoodies & Sweatshirts">
            <option value="Jeans">
            <option value="Jumpers & Cardigans">
            <option value="Jumpsuits & Playsuits">
            <option value="Lingerie & Nightwear">
            <option value="Loungewear">
            <option value="Pants & Leggings">
            <option value="Shorts">
            <option value="Skirts">
            <option value="Swimsuits & Beachwear">
            <option value="Tops">
            <option value="Tracksuits">
            <option value="Twopiece Outfits">

            <option value="Boots">
            <option value="Flats">
            <option value="Heels">
            <option value="Loafers">
            <option value="Sandals">
            <option value="Sneakers">
            <option value="Socks & Tights">

            <option value="Bags & Purses">
            <option value="Belts">
            <option value="Hair Accessories">
            <option value="Hats">
            <option value="Jewellery">
            <option value="Scarves">
            <option value="Sunglasses">
            <option value="Watches">

            <option value="Sports Bras">
            <option value="Leggings">
            <option value="Watches">

        </datalist>
    
    </div>

    <div class="form-group">
        <input type="text" name="brand" class="form-control" placeholder="Brand">
    </div>

    <div class="form-group">
        <select name="colour" class="form-control" placeholder="Colour" required>
            <option value="Black">Black</option>
            <option value="White">White</option>
            <option value="Blue">Blue</option>
            <option value="Brown">Brown</option>
            <option value="Beige">Beige</option>
            <option value="Green">Green</option>
            <option value="Grey">Grey</option>
            <option value="Navy">Navy</option>
            <option value="Pink">Pink</option>
            <option value="Pink">Red</option>
            <option value="Purple">Purple</option>
            <option value="Yellow">Yellow</option>
            <option value="Multi">Multi</option>
        </select>
    </div>

    <div class="form-group">
        <select name="season" class="form-control" placeholder="Season" required>
            <option value="Black">Summer</option>
            <option value="White">Winter</option>
            <option value="Spring">Spring</option>
            <option value="Autumn">Autumn</option>
        </select>
    </div>

    <div class="form-group">
        <input list="item-occasion" id="occasion" name="occasion" class="form-control" placeholder="Occasion E.g Work, Party, Beach, Work, Home"/>

        <datalist id="item-occasion">
            <option value="Beach">
            <option value="Party">
            <option value="Work">
            <option value="Home">
        </datalist>
    </div>

    <div class="form-group">
        <input type="text" name="price" class="form-control" placeholder="Price">
    </div>

    <hr>

    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-block" value="Add item">
    </div>

    <!-- <input type="hidden" id="image" name="image"> -->

    <div id="image"></div>

    </form>
</div>
</div>

@endsection