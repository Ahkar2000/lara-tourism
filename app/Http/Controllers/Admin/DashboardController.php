<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for bar chart
        $bookings = Booking::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTH(created_at) as month_name")
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->get();
        
        $total = 0;
        $bookingArr = [];
        for($i=0; $i<12; $i++){
            $bookingArr[$i] = 0;
        }
        foreach($bookings as $booking){
            $total += $booking->count;
            $bookingArr[$booking->month_name-1] = $booking->count;
        }
        $data = json_encode($bookingArr);

        //package
        $packageArr = [];
        $packageTotal = 0;
        $packages = Package::select(
            DB::raw("name as package_name")
        )->get();

        foreach($packages as $package){
            $packageArr[$packageTotal] = $package->package_name;
            $packageTotal++;
        }
        $data2 = json_encode($packageArr);

         //for pie chart
        $perPackageArr = [];
        for($i=0; $i<$packageTotal; $i++){
            $perPackageArr[$i] = 0;
        }
         $perPackages = Booking::groupBy('package_id')
         ->selectRaw('count(*) as total, package_id')
         ->get();
         $i=0;
         foreach($perPackages as $p){
             $perPackageArr[$p->package_id-1] = $p->total;
         }
         $data3 = json_encode($perPackageArr);

        return view('admin.dashboard',compact('data','total','data2','packageTotal','data3'));
    }
    public function showUsers()
    {
        $users = User::when(request('search'),function($query){
            $search = request('search');
            $query->where('name','like',"%$search%")->orWhere('email','like',"%$search%");
        })
        ->latest('id')->paginate(10)->withQueryString();
        return view('admin.user.index',compact('users'));
    }
}