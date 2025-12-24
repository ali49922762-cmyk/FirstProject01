<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;



class HotelController extends Controller
{
    // public function index(){
    //     $hotels = Hotel::get();
    //     return response()->json($hotels);  
    // }

    public function index(){
        $hotels=Hotel::all();

        return response()->json([
            'status'=>true,
            'message'=>'succesfull',
            'data'=>HotelResource::collection($hotels)
        ]);
    }    

    // public function show(Hotel $id){
    //     return response()->json($id);
    // }

    public function show($id){
        $hotel=Hotel::findOrFail($id);

        return response()->json([
            'status'=>true,
            'message'=>'succesfull',
            'data'=>new HotelResource($hotel)
        ]);
    }

    /////////////////////////////////////////////////

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            // 'cover'=>['required','image','mimes:jpg,png,jpeg,gif','max:2024']
        ]);

        $hotel = Hotel::create($validate);

        // $hotel->addMediaFromRequest('cover')->toMediaCollection('cover');
        
        return response()->json([
            'status' => true,
            'message' => 'Hotel Created Successfully',
            'data' => $hotel
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $hotel = Hotel::findOrFail($id);

        $hotel->update([
            'name' => $validate['name'],
            'address' => $validate['address'],
            'city' => $validate['city'],
            'description' => $validate['description'],
            'category_id' => $validate['category_id'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Hotel Updated Successfully',
            'data' => $hotel
        ]);
    }

    public function delete($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return response()->json([
            'status' => true,
            'message' => 'Hotel Deleted Successfully'
        ]);
    }

}
