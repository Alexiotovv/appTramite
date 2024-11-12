<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use stdClass;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'type_doc',
        'number_doc',
        'status',
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
        'password' => 'hashed',
    ];

    /**
     *  VerifyStatus of user
     * @return \App\Models\User if the credententials are validate or int (1, user disabled), (2, password wrong)
    */
    public static function verifyCredentials(string $email, string $password): \App\Models\User|int
    {
        $user = self::where('email', $email)->first();
        if($user->status == 0){
            return 1; 
        }
        if(!Hash::check($password, $user->password)){
            return 2;
        }
        return $user;
    }

    public static function retriveUserFill(int|string $identifier, bool $isEmail = true): stdClass
    {
        $query = DB::table('user_rol AS ur')
            ->join('users AS u', 'u.id', '=', 'ur.user_id')
            ->join('rol AS r', 'r.id', '=', 'ur.rol_id')
            ->join('rol_permission AS rp', 'rp.rol_id', '=', 'r.id')
            ->join('permission AS p', 'p.id', '=', 'rp.permission_id')
            ->leftJoin('user_office AS uo', 'uo.user_id', '=', 'u.id')
            ->leftJoin('office AS o', 'uo.office_id', '=', 'o.id')
            ->select(
                'u.id',
                DB::raw("CONCAT(u.name, ' ', u.last_name) AS fullname"), 
                'u.status',
                'u.email',
                'o.name AS officeName',
                'o.id AS officeId',
                'o.level AS officeLevel',
                'o.group AS officeGroup',
                DB::raw('
                    GROUP_CONCAT(DISTINCT r.name ORDER BY r.name SEPARATOR "++") AS roles
                '),
                DB::raw('
                    GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR "++") AS permissions
                ')
            )
            ->where($isEmail ? 'u.email' : 'u.id', '=', $identifier)
            ->groupBy('u.id', 'o.name', 'o.id', 'o.level', 'o.group')
            ->first();
        return (object) [
            'userId' => $query->id,
            'fullname' => $query->fullname,
            'status' => $query->status, 
            'email' => $query->email,
            'officeName' => $query->officeName,
            'officeId' => $query->officeId,
            'officeLevel' => $query->officeLevel,
            'officeGroup' => $query->officeGroup,
            'roles' => explode('++', $query->roles),
            'permissions' => explode('++', $query->permissions)
        ];    
    }
}