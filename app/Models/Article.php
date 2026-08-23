<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'posted_date',
        'title',
        'article_contents'
    ];

    public function getFormattedPostedDateAttribute() {
        return Carbon::parse($this->posted_date)->format('Y年m月d日');
    }

}
