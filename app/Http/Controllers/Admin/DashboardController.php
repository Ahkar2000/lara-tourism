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
        $bookingArr = array_fill(0,12,0);
        foreach($bookings as $booking){
            $total += $booking->count;
            $bookingArr[$booking->month_name-1] = $booking->count;
        }
        $data = json_encode($bookingArr);

        //for pie chart
        $perPackageArr = [];
        $pIndex = [];
         $perPackages = Booking::groupBy('package_id')
         ->selectRaw('count(*) as total, package_id')
         ->get();
         foreach($perPackages as $k=>$p){
             $perPackageArr[$k] = $p->total;
             $pIndex[$k] = $p->package_id;
         }
         $data3 = json_encode($perPackageArr);

        //package
        $packageArr = [];
        $packageIndex = 0;
        $packages = Package::select(
            DB::raw("name as package_name"),
            DB::raw("id as package_id")
        )->get();

        $packageTotal = $packages->count();

        foreach($packages as $package){
            for($i=0; $i<count($pIndex); $i++){
                if($package->package_id == $pIndex[$i]){
                    $packageArr[$packageIndex] = $package->package_name;
                    $packageIndex++;
                }
            }
        }

        $data2 = json_encode($packageArr);

        
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
