<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia
{
    use HasFactory,

        InteractsWithMedia, SoftDeletes;

        public $incrementing = false;


    protected $fillable = [
        'code',
        'title',
        'price',
        'description',
        'collection_id',
        'sub_category_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'products', 'length' => 10, 'prefix' =>mt_rand()]);
            $model->code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 10, 'prefix' =>'Z-'.mt_rand()]);
        });
    }

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function subcategorie()
    {
        return $this->belongsTo(Collection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tailles()
    {
        return $this->hasMany('App\Models\Taille');
    }

    public function pointures()
    {
        return $this->hasMany('App\Models\Pointure');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity', 'unit_price', 'total','options'])
            ->withTimestamps();
    }

    /*******resize image */

    //     public function registerMediaConversions(Media $media = null)
    // {
    //     $this->addMediaConversion('thumb')
    //         ->width(150)
    //         ->height(100);
    //     $this->addMediaConversion('bigthumb')
    //         ->width(300)
    //         ->height(100);
    // }

}
