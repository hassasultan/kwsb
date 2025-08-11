<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\ComplaintAssignDepartment;


class User extends Authenticatable implements JWTSubject
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'department_id',
        'delete_status',
        'device_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function agent()
    {
        return $this->belongsTo(MobileAgent::class,'id','user_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'id','user_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function check_assignment($user_id,$comp_id)
    {
        $check_assignment = ComplaintAssignDepartment::where('complaint_id',$comp_id)->where('user_id',$user_id)->count();
        return $check_assignment;
    }
    public function assignedComplaints()
    {
        return $this->hasMany(ComplaintAssignDepartment::class,'user_id','id');
    }
}
