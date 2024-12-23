<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades'; // テーブル名
    protected $fillable = ['grade', 'title', 'thumbnail', 'delivery_from', 'delivery_to'];

    public function grade()
{
    return $this->belongsTo(Grade::class);
}

}
