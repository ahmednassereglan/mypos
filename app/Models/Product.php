<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    
    protected $guarded = [];

    public $translatedAttributes = ['name' ,'description'];

    
    protected $appends =['image_path','profit_percent'];


    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
        
    }
    
    public function getProfitPercentAttribute()
    {
        $sale = $this->sale_price ;
        $purchase = $this->purchase_price ;
        $profit =  $sale-$purchase;
        $profit_percent = ( $profit * 100 ) / $purchase ;
        return number_format($profit_percent,2);
    }
 
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}