<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table   = 'files';
    protected $guarded = [];

    /* relations */

    public function fileable()
    {
        return $this->morphTo();
    }

    /* methods */

    public function showUrl()
    {
        return url("storage/{$this->path}");
    }

}
