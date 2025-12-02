<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class FoodDiary extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'food_diaries';

    protected $fillable = ['user_id', 'entries', 'submitted_at'];

}
