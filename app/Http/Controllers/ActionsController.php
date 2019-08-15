<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Item;
use App\Outfit;
use App\ItemOutfit;
use App\Schedule;


class ActionsController extends Controller
{
    //
    public function storeItem(Request $request)
    {
        $item = new Item;
        $item->image = $request->image;
        $item->name = $request->name;
        $item->status = $request->status;
        $item->type = Str::slug($request->type);
        $item->category = Str::slug($request->category,'-');
        $item->season = Str::slug($request->season);
        $item->occasion = Str::slug($request->occasion);
        $item->colour = Str::slug($request->colour);
        $item->link = $request->link;
        $item->fabric = $request->fabric;
        $item->quality = $request->quality;
        $item->price = $request->price;
        $item->brand = Str::slug($request->brand);
        $item->year = $request->year;
        $item->save();
        
        $request->session()->flash('alert-success', 'Item added!');

        return redirect()->back();
    }

    //
    public function storeOutfit(Request $request)
    {
        $outfit = new Outfit;
        $outfit->name = $request->name;
        $outfit->season = $request->season;
        $outfit->category = $request->occasion; // category is occasion
        $outfit->save();

        $i = 0;
        foreach($request->items as $item) {
            var_dump($item);
            $itm = new ItemOutfit;
            $itm->item_id = (int)$item;
            $itm->outfit_id = $outfit->id;
            $itm->order = $i;
            $itm->save();
            $i++;
        }
        
        $request->session()->flash('alert-success', 'Outfit added!');

        return redirect()->back();
    }

    public function getImages()
    {
        $html = file_get_contents('https://www.wittner.com.au/havier-ecru-sliced-snake-leather-snib-toe-block-heel-00.html');
        preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
        var_dump($matches);
    }

    /**
       * Sign auth
       *
       * @param  int  $id
       * @return Response
       */
      public function signAuth(Request $request)
      {

        $to_sign = $request->input('to_sign');
        $secret = 'puXh2Tken2S21MlgdlotuouytPoicdU8xaRivrW4';

        $hmac_sha1 = hash_hmac('sha1',$to_sign,$secret,true);
        $signature = base64_encode($hmac_sha1);

        // $response = Response::make($signature, 200);
        // $response->header('Content-Type', 'text/html');
        // return $response;

        return response($signature, 200)
            ->header('Content-Type', 'text/html');
      }
}
