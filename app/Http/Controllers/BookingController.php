<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Package;
use App\Models\Place;
use Illuminate\Http\Request;

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
        $package = Package::findOrFail($request->package_id);
        $place = Place::findOrFail($request->place_id);
        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->package_id = $request->package_id;
        $booking->schedule = $request->schedule;
        $booking->place_id = $request->place_id;
        $booking->booking_code = floor(time()-999999999);
        $booking->quantity = $request->quantity;
        $booking->amount = $package->price * $request->quantity;
        $booking->save();   

        return response()->json([$booking,$package,$place]);
    }
    public function bookUpdate(Request $request, $id)
    {
        $booking = Booking::find($id);
        $package = Package::findOrFail($booking->package_id);
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'quantity' => 'nullable|numeric',
            'schedule' => 'nullable|date_format:Y-m-d|after_or_equal:'. date(DATE_ATOM),
            'place_id' => 'nullable|exists:places,id'
        ]);
        if($request->has('quantity')){
            $booking->quantity = $request->quantity;
            $booking->amount = $request->quantity * $package->price;
        }
        if($request->has('schedule')){
            $booking->schedule = $request->schedule;
        }
        if($request->has('place')){
            $booking->place_id = $request->place;
        }
        $booking->update();
        return back()->with('message','Your Booking is updated successfully.');
    }

    public function bookCancel($id){
        $booking = Booking::find($id);
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
        $booking->delete();
        return back()->with('message','Booking is deleted successfully.');
    }
    public function confirmation(Request $request)
    {
        //validate the form
        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
            'schedule' => 'required|date_format:Y-m-d|after_or_equal:'. date(DATE_ATOM),
            'package_id' => 'required|exists:packages,id',
            'place_id' => 'required|exists:places,id'
        ]);

        $data['myForm'] = $request->all();

        return response()->json($data);

    }
}
