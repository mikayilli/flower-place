<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\CallRequests;
use App\Models\CallRequest;
use App\Services\CollectionService;
use Illuminate\Http\Request;
use App\Models\Collection;
class HomeController
{
    public function index(CollectionService $collectionService)
    {
        $results['collections_1'] = Collection::where("banner_name", Collection::BANNERS[0])
            ->orderBy("rank")
            ->with(["product"])
            ->get();

        $results['collections_2'] = Collection::where("banner_name", Collection::BANNERS[1])
            ->orderBy("rank")
            ->with(["product"])
            ->get();

        $results['collections_3'] = Collection::where("banner_name", Collection::BANNERS[2])
            ->orderBy("rank")
            ->get();

        $results['slider_1'] = $collectionService->getCollectionBySlider(Collection::SLIDER[0]);
        $results['slider_2'] = $collectionService->getCollectionBySlider(Collection::SLIDER[1]);
        $results['slider_3'] = $collectionService->getCollectionBySlider(Collection::SLIDER[2]);
        $results['insta_feed'] = $collectionService->getCollectionBySlider(Collection::SLIDER[3]);

        return view("front.home", compact('results'));
    }

    public function callRequest(CallRequests $request){
        $callRequest = CallRequest::updateOrCreate([
            'call_phone' => $request->call_phone,
            'date_at' => today()
        ],
        [
            'call_full_name' => $request->call_full_name,
            'call_phone' => $request->call_phone,
            'wp' => $request->wp ? 1 : 0,
        ]);

        $callRequest->increment('count');

        return redirect()->back()->with("call_req", "Successfully Done!");
    }
}
