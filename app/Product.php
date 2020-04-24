<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'detail'
    ];

    public function scopeSearch($query, $search)
    {
        // return $query->where('name', 'like', '%'.$search.'%')
        //                 ->orWhere('detail', 'like', '%'.$search.'%');
    }

    public function scopeName($query, $request)
    {
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        return $query;
    }
    public function scopeDetail($query, $request)
    {
        if ($request->has('detail')) {
            $query->where('detail', 'LIKE', '%' . $request->detail . '%');
        }

        return $query;
    }

}
