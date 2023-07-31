<?php

namespace App\Models;

use App\Models\Scopes\MediaDeletedScope;
use App\Models\Scopes\UserMediaScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Media extends Model
{
    use HasFactory;

    private static string $disk = 'uploads';
    protected $table = 'media';

    protected $fillable = ['title', 'description', 'file', 'user_id', 'code'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function uploadFile($file)
    {
        return $file->store('', self::$disk);
    }

    public static function deleteFile($file)
    {
        if($file && Storage::disk(static::$disk)->exists($file)){
            Storage::disk(static::$disk)->delete($file);
        }
    }

    public function scopeFindByCode(Builder $builder)
    {
        $builder->where('code', request()->route('code'));
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserMediaScope());
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });

    }

    public function getDownloadLinkAttribute()
    {
        return URL::temporarySignedRoute('medias.downloadForm', now()->addMinutes(2), ['media' => $this->code]);
    }



}
