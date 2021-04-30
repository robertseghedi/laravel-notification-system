<?php

namespace RobertSeghedi\LNS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'notifications';

    protected $fillable = ['user', 'content', 'status', 'type'];
}
