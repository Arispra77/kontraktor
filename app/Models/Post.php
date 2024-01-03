<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'td_wp_spk';
    protected $fillable = [
         '*'
    ];
    protected $primaryKey = 'Id_Job_SPK';
    public function real()
    {
        return $this->hasMany(real::class, 'Id_Job_SPK', 'Id_Job_SPK');
    }
    public function job(){
        return $this->belongsTo(job::class,'Id_Job','Id_Job');
    }
  
}
