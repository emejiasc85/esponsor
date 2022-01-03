<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'products';
    protected $guarded = [];

    /* relations */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('title', 'LIKE', '%'.request()->search.'%')
                ->orWhere('description', 'LIKE', '%'.request()->search.'%')
                ->orWhereHas('category', function($query){
                    $query->where('name', 'LIKE', '%'.request()->search.'%');
                });
        });
    }


    /* methods */

    public function addFile()
    {

        if(request()->hasFile('file')){
            $file = request()->file('file');

            $path = $file->store('products/'.$this->id, 'public');

            $this->file()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
                'name'     => $file->getClientOriginalName(),
            ]);
        }

        return $this;
    }


}
