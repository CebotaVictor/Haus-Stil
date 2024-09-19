<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Storage;

class Image extends Model
{
    public function StoreUserImage(Request $request, $id){
        $request->validate([
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        if ($request->hasFile('image')) {
            $user = User::find($id);
            if($user){
                $folder = 'public/images/users/'.$user->name;
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
                    $imagePath = 'public/images/users/'.$user->name;
                    $image->storeAs($imagePath, $imageName);
                    return $imageName;
                }
            }
        else return null;   
        }
    }

    
    public function StoreCatImage(Request $request, $id){
        $request->validate([
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        if ($request->hasFile('image')) {
            $cat = Category::find($id);
            if($cat){
                $folder = 'public/images/categories/'.$cat->name;
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
                    $imagePath = 'public/images/categories/'.$cat->name;
                    $image->storeAs($imagePath, $imageName);
                    return $imageName;
                }
            }
        else return null;   
        }
    }


    public function StoreProdImage(Request $request, $id){
        $request->validate([
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        if ($request->hasFile('image')) {
            $product = Product::find($id);
            if($product){
                $folder = 'public/images/products/'.$product->name;
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
                    $imagePath = 'public/images/products/'.$product->name;
                    $image->storeAs($imagePath, $imageName);
                    return $imageName;
                }
            }
        else return null;   
        }
    }

    public function DeleteUserFolder($id){
        $user = User::find($id);
        if($user){
            $imagePath = 'public/images/users/'.$user->name;
            if(Storage::exists($imagePath)){
                Storage::deleteDirectory($imagePath);
            }    
        }    
        else return null;

    }    

    //deleting category folder if it exists

    public function DeleteCatFolder($id){
        $user = User::find($id);
        if($user){
            $imagePath = 'public/images/categories/'.$user->name;
            if(Storage::exists($imagePath)){
                Storage::deleteDirectory($imagePath);
            }    
        }    
        else return null;

    }    


    //deleting products folder if it exists
    public function DeleteProdFolder($id){
        $user = User::find($id);
        if($user){
            $imagePath = 'public/images/products/'.$user->name;
            if(Storage::exists($imagePath)){
                Storage::deleteDirectory($imagePath);
            }    
        }    
        else return null;

    }    

}
