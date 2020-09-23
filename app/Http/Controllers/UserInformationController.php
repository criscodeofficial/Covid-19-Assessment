<?php

namespace App\Http\Controllers;
use Image;
use Validator;
use App\Identity;
use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class UserInformationController extends Controller
{
    public function createInformation()
    {   
        // validation
        $data = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'unit' => 'required',
            'street' => 'required',
            'brgy' => 'required'
        ]);
        
        // stora data to the db
        $information = Information::create([
            'user_id' => auth()->user()->id,
            'firstname' => request()->firstname,
            'lastname' => request()->lastname,
            'age' => request()->age,
            'gender' => request()->gender,
            'date_of_birth' => request()->date_of_birth,
            'unit' => request()->unit,
            'street' => request()->street,
            'brgy' => request()->brgy
        ]);

        return $information;    
    }

    public function getInformation() {

        // fetch the latest information
        $information = auth()->user()->informations->last();

        return $information;
    }

    public function createIdentity(Request $request)
    {
        // validation
        $request->validate([
            'images' => 'required|mimes:jpg,png,jpeg'
        ]);
        
        // delete old image
        if (auth()->user()->identity) {

            $oldImage = Identity::where('user_id', auth()->user()->id)->firstOrFail();
            File::delete([
                public_path($oldImage->images)
            ]);
            $oldImage->delete();     
        };

        // save image to the public
        $image = $request->file('images');
        $imageName = $image->getClientOriginalName();
        $imageName = time().'_'.$imageName;
        Image::make($image)->fit(200, 200)
        ->save(public_path('images/').$imageName);
        //$image->move(public_path('images/'), $imageName);

        // save image to the db
        $img = new Identity;
        $img->user_id = auth()->user()->id;
        $img->images = 'images/'.$imageName;
        $img->save();
        
    }   
}
