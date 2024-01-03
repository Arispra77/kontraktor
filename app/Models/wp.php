<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wp extends Model
{
    use HasFactory;
    protected $table = 'td_wp';
    
   
    protected $fillable = ['*'];
    public $timestamps = false;
    protected $primaryKey = 'Id_WP';
    // public function job(){
    //     return $this->belongsTo(job::class,'Id_Job','Id_Job');
    // }
}
