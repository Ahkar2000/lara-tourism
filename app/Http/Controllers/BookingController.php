<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::when(request('search'),function($query){
            $search = request('search');
            $query->orWhere('comment','like',"%$search%");
        })
        ->when(request('status') == 'pending',function($query){
            $query->where('status','0');
        })
        ->when(request('status') == 'confirm',function($query){
            $query->where('status','1');
        })
        ->when(request('status') == 'finish',function($query){
            $query->where('status','2');
        })
        ->when(request('status') == 'cancel',function($query){
            $query->where('status','3');
        })
        ->with('user','package')
        ->latest('id')->paginate(10)->withQueryString();
        return view('admin.booking.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return response()->json($booking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->status = $request->status;
        $booking->update();
        return back()->with('message','Booking is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('message','Booking is deleted successfully.');
    }
    public function userBook(StoreBookingRequest $request)
    {
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        if($request->quantity > $vehicle->seat){
            return abort(404);
        }
        $package = Package::findOrFail($request->package_id);
        $place = Place::findOrFail($request->place_id);
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->vehicle_id = $request->vehicle_id;
        $booking->package_id = $request->package_id;
        $booking->schedule = $request->schedule;
        $booking->place_id = $request->place_id;
        $booking->booking_code = floor(time()-999999999);
        $booking->quantity = $request->quantity;
        $booking->amount = $package->price + $vehicle->price;
        $booking->save();   

        return response()->json([$booking,$package,$place->name,$vehicle->model,$vehicle->price]);
    }
    public function bookUpdate(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (Gate::denies('update', $booking)) {
            return abort(403, "You are not allowed to update.");
        }
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'quantity' => 'required|numeric',
            'schedule' => 'required|date_format:Y-m-d|after_or_equal:'. date(DATE_ATOM),
            'place_id' => 'required|exists:places,id',
            'vehicle_id' => 'required|exists:vehicles,id'
        ]);
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $package = Package::findOrFail($booking->package_id);
        $booking->quantity = $request->quantity;
        $booking->amount = $vehicle->price + $package->price;
        $booking->schedule = $request->schedule;
        $booking->place_id = $request->place_id;
        $booking->vehicle_id = $request->vehicle_id;
        
        $booking->update();
        return back()->with('message','Your Booking is updated successfully.');
    }

    public function bookCancel($id){
        $booking = Booking::find($id);
        if (Gate::denies('update', $booking)) {
            return abort(403, "You are not allowed to update.");
        }
        $booking->status = '3';
        $check = $booking->update();
        If($check){
            return "success";
        }else{
            return "fail";
        }
    }
    public function bookDelete($id){
        $booking = Booking::find($id);
        if (Gate::denies('delete', $booking)) {
            return abort(403, "You are not allowed to delete.");
        }
        $booking->delete();
        return back()->with('message','Booking is deleted successfully.');
    }
    public function bookingShow($id){
        $booking = Booking::find($id);
        Gate::authorize('view', $booking);
        return response()->json($booking);
    }
}
