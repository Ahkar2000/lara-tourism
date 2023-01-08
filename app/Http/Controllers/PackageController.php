<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Photo;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePackageRequest;
use App\Http\Requests\UpdatePackageRequest;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::when(request('search'),function($query){
            $search = request('search');
            $query->where('name','like',"%$search%")->orWhere('location','like',"%$search%")->orWhere('description','like',"%$search%");
        })
        ->latest('id')->paginate(10)->withQueryString();
        return view('admin.package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageRequest $request)
    {
        try {

            DB::beginTransaction();

            $package = new Package();
            $package->name = $request->name;
            $package->location = $request->location;
            $package->price = $request->price;
            $package->description = $request->description;
            $package->save();

            $savedPhotos = [];
            foreach($request->photos as $key=>$photo){
                $newName = uniqid().'.'.$photo->extension();
                $img = Image::make($photo);

                $img->resize(1000, null, fn ($constrain) => $constrain->aspectRatio());
                Storage::makeDirectory("public/1000");
                $img->save("storage/1000/$newName");

                $img->fit(500, 400);

                Storage::makeDirectory("public/500");
                $img->save("storage/500/$newName");
                //$photo->storeAs("public", $newName);
                //Storage::putFileAs("/",$photo,$newName,'public');
                $savedPhotos[$key] = [
                    "package_id" => $package->id,
                    "name" => $newName
                ];
            }
            Photo::insert($savedPhotos);

            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
        }

        return to_route('packages.index')->with('message','Package is added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.package.show',compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.package.edit',compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageRequest  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        try {

            DB::beginTransaction();

            $package->name = $request->name;
            $package->location = $request->location;
            $package->price = $request->price;
            $package->description = $request->description;
            $package->update();

            if(request()->hasFile('photos')){
                $savedPhotos = [];
                foreach($request->photos as $key=>$photo){
                    $newName = uniqid().'.'.$photo->extension();
                    $img = Image::make($photo);

                    $img->resize(1000, null, fn ($constrain) => $constrain->aspectRatio());
                    Storage::makeDirectory("public/1000");
                    $img->save("storage/1000/$newName");

                    $img->fit(500, 400);

                    Storage::makeDirectory("public/500");
                    $img->save("storage/500/$newName");
                    //$photo->storeAs("public", $newName);
                    //Storage::putFileAs("/",$photo,$newName,'public');
                    $savedPhotos[$key] = [
                        "package_id" => $package->id,
                        "name" => $newName
                    ];
                }
            Photo::insert($savedPhotos);
            }
            DB::commit();
        } catch (Exception $error) {
            DB::rollBack();
        }

        return to_route('packages.index')->with('message','Package is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        Storage::delete($package->photos->map(fn ($photo) => "public/500/" . $photo->name)->toArray());
        Storage::delete($package->photos->map(fn ($photo) => "public/1000/" . $photo->name)->toArray());
        $package->delete();
        return to_route('packages.index')->with('message','Package is deleted successfully');
    }
    public function userShow(Package $package){
        return view('package.show',compact('package'));
    }
}
