<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
	protected $table = 'product';
	protected $fillable = ['order_id', 'product_id', 'user_id', 'rating', 'review'];
}