<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class BookDetail extends Model
{
    use HasFactory, Searchable;
    public $fillable = [
        'title',
        'author',
        'phone',
        'genre',
        'description',
        'isbn',
        'image',
        'published',
        'publisher'
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'publisher' => $this->publisher,
            'isbn' => $this->isbn,
            'genre' => $this->genre,
            'published' => $this->published
        ];
    }
}
