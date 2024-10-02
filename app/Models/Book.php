<?php

namespace App\Models;

use App\Models\Rack;
use App\Models\Category;
use App\Models\Cupboard;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    use Sluggable;
    // use SoftDeletes;

    protected $fillable = [
        'id','title','category_id', 'cover','slug' , 'author','publisher','publication_year','book_condition', 'edition', 'rack_id', 'cupboard_id'
    ];
    protected $casts = [
        'id' => 'string',
    ];
    

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The roles that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    //Relasi Many to one
    public function categories():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cupboard()
    {
        return $this->belongsTo(Cupboard::class, 'cupboard_id', 'id');
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
