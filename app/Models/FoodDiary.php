<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodDiary extends Model
{
    protected $fillable = ['user_id', 'entries', 'submitted_at'];
}
