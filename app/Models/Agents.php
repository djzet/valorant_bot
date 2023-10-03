<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    use HasFactory;

    protected $table = 'agents';
    protected $fillable = ['id', 'name', 'image', 'active'];

    public $timestamps = null;

    public function getAgents(){
        return Agents::all();
    }
}
