<?php
// app/Models/Document.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description', 'file_path', 'file_name',
        'file_extension', 'file_size_in_kilobytes', 'is_active', 'created_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'file_size_in_kilobytes' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}