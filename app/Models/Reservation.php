<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    protected $fillable=['guest_name','room_id','check_in','check_out','status'];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}