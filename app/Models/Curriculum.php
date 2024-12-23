<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    // テーブル名を明示
    protected $table = 'curriculums';

    // 一括代入可能な属性
    protected $fillable = [
        'title', 
        'thumbnail', 
        'description', 
        'video_url', 
        'alway_delivery_flg', 
        'grade_id'
    ];

    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id'); // 修正点: 外部キー名の見直し
    }
    
    
}
