<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandDocument extends Model
{
    use HasFactory;

    protected $table = 'land_documents';

    protected $fillable = [
        'land_id',
        'document_name',
        'file_path'
    ];

    public function land()
    {
        return $this->belongsTo(Land::class, 'land_id', 'id');
    }
}
