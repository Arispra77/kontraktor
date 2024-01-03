<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class real extends Model
{
    use HasFactory;
    protected $table = 'td_wp_bkl_real';
    
   
    protected $fillable = ['*'];
    public $timestamps = false;
    protected $primaryKey = 'Id_WP_Bkl_Real';
    public function Post2(){
        return $this->belongsTo(Post::class,'Id_Job_SPK','Id_Job_SPK');
    }
}
