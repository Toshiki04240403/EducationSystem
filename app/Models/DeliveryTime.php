<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    // Specify the table name explicitly
    protected $table = 'delivery_times';

    // Allow these fields to be mass-assigned
    protected $fillable = ['curriculums_id', 'alway_delivery_flg', 'delivery_from', 'delivery_to'];

    // Define the relationship to the Curriculum model
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }
}
