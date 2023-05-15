<?php

namespace App\Models;

use App\Models\User;
use App\Models\Audit;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use Uuids;
    use HasFactory;

    protected $table = 'links';

    protected $fillable = [
        'title',
        'link',
        'shorted_link',
        'link_audit_id',
        'user_id',
    ];

    public function link_audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
