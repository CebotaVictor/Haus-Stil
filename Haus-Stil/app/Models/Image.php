<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Storage;

class Image extends Model
{
    public function StoreImage(Request $request, $id){
        $request->validate([
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        if ($request->hasFile('image')) {
            $user = User::find($id);
            if($user){
                $folder = 'public/images/'.$user->name;
                if(Storage::exists($folder)){
                    if(!empty($folder)){
                        $image = $request->file('image');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $image->storeAs($folder, $imageName);
                        return $imageName;
                    }
                    else  return null;
                }
                else if(!Storage::exists($folder)){
                    $image = $request->file('image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'public/images/'.$user->name;
                    $image->storeAs($imagePath, $imageName);
                    return $imageName;
                }
            }
        else return null;   
        }
    }


    public function DeleteFile($id){
        $user = User::find($id);
        if($user){
            $imagePath = 'public/images/'.$user->name;
            if(Storage::exists($imagePath)){
                Storage::deleteDirectory($imagePath);
            }
        }
        else return null;

    }

}
