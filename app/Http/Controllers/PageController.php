<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Outfit;
use App\Schedule;

class PageController extends Controller
{

    /**
     * Homepage
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $want = Item::where('status','want')->get();
        $have = Item::where('status','have')->get();

        return view('welcome', [
            'want' => $want,
            'have' => $have,
        ]);
    }

    /**
     * Add item
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function outfits()
    {
        $outfits = Outfit::all();
        return view('outfits', [
            'outfits' => $outfits
        ]);
    }

    /**
     * Outift
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function outfit($id)
    {
        $outfit = Outfit::find($id);
        return view('outfit', [
            'outfit' => $outfit
        ]);
    }

    /**
     * Add item
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addItem()
    {
        return view('item.create');
    }

    /**
     * Add outfit
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addOutfit()
    {
        return view('outfit.create');
    }

    /**
     * Add schedule
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addSchedule()
    {
        return view('schedule.create');
    }
}
