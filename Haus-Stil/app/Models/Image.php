<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends Model
{
    public function StoreImage(Request $request, int $id){
        $request->validate([
            'image' => ['required' ,'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        $user = User::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'public/images/'.$user->name;
            $image->storeAs($imagePath, $imageName);
        } 

        return $imageName;
    }
}
