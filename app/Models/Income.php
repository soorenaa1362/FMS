<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = "incomes";

    protected $fillable = [
        'title',
        'date',
        'amount',
        'card_id',
        'description',
    ];


    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }


    public function getdateJalali()
    {
        if (!is_null($this->date))
            return Jalalian::fromDateTime($this->date)->format('Y/m/d');
        return null;
    }


    public function getdateTimestamp()
    {
        if (!is_null($this->date))
            return Jalalian::fromDateTime($this->date)->getTimestamp();
        return null;
    }
}
