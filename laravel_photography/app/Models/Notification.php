<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';

    protected $fillable = ['client_id', 'message', 'is_read'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
