<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'project_photo_path',
        'presentation_path',
        'rating',
        'team',
        'group',
    ];

    public $appends = ['image_url', 'pdf_url'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team');
    }

    public function getImageUrlAttribute()
    {
        if ($this->project_photo_path) {
            return asset('storage/projects/' . $this->project_photo_path);
        } else {
            return null;
        }
    }

    public function getPdfUrlAttribute()
    {
        if ($this->presentation_path) {
            return asset('storage/projects/' . $this->presentation_path);
        } else {
            return null;
        }
    }

//    public function scopeFilter($query, array $filters)
//    {
//        $query->when($filters['group'] ?? null, function ($query, $group) {
//            $query->where('group', $group);
//        });
//    }
}
