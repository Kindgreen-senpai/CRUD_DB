<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Worker extends Model
{
    use Sortable;
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'job',
        'salary',
        'hire_date',
        'phone',
    ];
    public $sortable = ['id', 'first_name', 'last_name', 'email','job','salary','hire_date','phone'];

    public function scopeFilter($query, array $filters) {
        // if($filters['tag'] ?? false) {
        //     $query->where('tags', 'like', '%' . request('tag') . '%');
        // }
        // dd(request('category'));
        if($filters['search'] ?? false) {
            $query->where(request('category'), 'like', '%' . request('search') . '%');
        }
    }
}
