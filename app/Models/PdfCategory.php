<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfCategory extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['title','description'];

    // Optional: Consider using plural for relationship methods that return multiple items
    public function pdfBooks() // Changed from pdfbook to pdfBooks (plural convention)
    {
        return $this->hasMany(PdfBook::class, 'pdf_category_id', 'id');
    }
}
