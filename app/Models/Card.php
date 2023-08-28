<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'title',
        'location',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    static function search($query){
    $results = Card::where('title', 'LIKE', "%$query%")
                          ->orWhere('location', 'LIKE', "%$query%")
                          ->get();
    return $results;
                        }

    


    /* Old version protected $table = 'Card'; 
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'title',
        'location',
        'image',
        'description'
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];*/

}
