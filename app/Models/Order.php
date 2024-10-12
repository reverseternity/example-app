<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //Hasfactoru - класс, который даст модели работоать с фабриками
    //SoftDeletes даст работу с мягким удалением))
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'title',
        'demand',
        'date',
        'time',
        'contact'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
