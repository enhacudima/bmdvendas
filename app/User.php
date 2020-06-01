<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sofa\Eloquence\Eloquence;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;
    use Eloquence;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $searchableColumns = ['name'];//find user by sofa

    public function contactForm()
    {

        $contactForm=ContactForm::where('read_or_not',1)->limit(20)->get();

        return $contactForm;
    }
    public function calendar()
    {
        $calendar=Calendario::where('concluido',null)->get();

        return $calendar;
    }
}
