<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['ip','user_agent'];
    public $incrementing = false;
    protected $keyType = 'string';


   public function setUpdatedAt($value)
   {
       return $this;
   }

    public function streamable()
    {
        return $this->morphTo();
   }


    public function uniqueIds()
    {
        return [
            'uuid'
        ];
    }
}
