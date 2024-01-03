<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    use HasFactory;

    protected $table = 'td_joborder';
    
   
    protected $fillable = ['*'];
    public $timestamps = false;
    protected $primaryKey = 'Id_Job';

    public function Post(){
        return $this->hasMany(Post::class, 'Id_Job', 'Id_Job');
    }
}
