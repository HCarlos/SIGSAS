<?php

namespace App\Models;

use App\Filters\User\UserFilter;
use App\Models\SIGSAS\Estructura\Dependencia;
use App\Models\SIGSAS\Domicilios\Ubicacion;
use App\Models\SIGSAS\Denuncias\Imagene;
use App\Models\SIGSAS\Denuncias\Respuesta;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\UserAdress;
use App\Models\User\UserDataExtend;
use App\Models\User\UserSocial;
use App\Notifications\MyResetPassword;
use App\Traits\User\UserAttributes;
use App\Traits\User\UserImport;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable;
    use HasRoles;
    use UserImport, UserAttributes;

    protected $guard_name = 'web';
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username', 'email', 'password',
        'nombre','ap_paterno','ap_materno',
        'admin','alumno','delegado',
        'curp','emails','celulares','telefonos',
        'fecha_nacimiento','genero', 'lugar_nacimiento',
        'root','filename','filename_png','filename_thumb',
        'empresa_id','status_user','ip','host','searchtext',
        'logged','logged_at','logout_at', 'user_mig_id','email_verified_at',
        'creadopor_id','created_at','modipor_id','updated_at',
        'ubicacion_id','imagen_id',
        'uuid',
    ];

    protected $hidden = ['password', 'remember_token','deleted_at'];
    protected $casts = ['admin'=>'boolean','alumno'=>'boolean','delegado'=>'boolean',];
    protected $dates = ['fecha_nacimiento' => 'datetime:d-m-Y'];
//    protected $dateFormat = [''];

    public function scopeSearch($query, $search){
        if (!$search || $search == "" || $search == null) return $query;
        return $query->whereRaw("searchtext @@ to_tsquery('spanish', ?)", [$search])
            ->orderByRaw("ts_rank(searchtext, to_tsquery('spanish', ?)) DESC", [$search]);
    }

//->orderByRaw("ap_paterno, ap_materno, nombre, curp, username ASC");



    //->orHas('user_adress', function ($q) use ($search) {     return $q->whereRaw("UPPER(calle) like ?", "%{$search}%")
//->orWhereRaw("UPPER(colonia) like ?", "%{$search}%")
//    ->orWhereRaw("UPPER(localidad) like ?", "%{$search}%");
//})

    public function scopeFilterBySearch($query, $filters){
        return (new UserFilter())->applyTo($query, $filters);
    }

    public function scopeFilterBy($query, $filters){
        return (new UserFilter())->applyTo($query, $filters);
    }

    public function permisos() {
        return $this->belongsToMany(Permission::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    public function user_adress(){
        return $this->hasOne(UserAdress::class);
    }

    public function user_data_extend(){
        return $this->hasOne(UserDataExtend::class);
    }

    public function user_data_social(){
        return $this->hasOne(UserSocial::class);
    }

    public function dependencias(){
        return $this->belongsToMany(Dependencia::class);
    }

    public function Imagen(){
        return $this->hasOne(Imagene::class,'id','imagene_id');
    }

    public function imagenes(){
        return $this->belongsToMany(Imagene::class,'imagene_user','imagene_id','user_id');
    }

    public function respuestas(){
        return $this->belongsToMany(Respuesta::class);
    }

    public function Ubicacion(){
        return $this->belongsTo(Ubicacion::class,'ubicacion_id','id');
    }

    public function ubicaciones(){
        return $this->belongsToMany(Ubicacion::class);
    }

    public function isAdmin(){
        return $this->admin;
    }

    public function isLogged(){
        return $this->logged;
    }

    public function isDelegado(){
        return $this->delegado;
    }

    public function isRole($role): bool{
        return $this->hasRole($role);
    }

    public function IsEmptyPhoto(){
        return $this->filename == '';
    }

    public function IsFemale(){
        return $this->genero == 0;
    }

    public function scopeMyID(){
        return $this->id;
    }

    public function scopeRole(){
        return $this->roles()->first();
    }

//    public function Empresa(){
//        return $this->hasOne(Empresa::class,'id','empresa_id');
//    }

    public function Creado_Por(){
        return $this->hasOne(User::class,'id','creado_por_id');
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MyResetPassword($token));
    }


    public static function agregarConSeeder(
        $nombre='', $ap_paterno='', $ap_materno='', $username='',
        $curp='',$emails='',$celulares='',$telefonos='',$fecha_nacimiento=null,
        $genero=1,
        $empresa_id=1,
        $creado_por_id=1,
        $user_id_anterior=0,
        $role_id=0,
        $dataAdress=[],
        $dataExtend=[]
    ){
        $user = static::where('username', trim($username))->first();
        if (!$user) {
            app()['cache']->forget('spatie.permission.cache');

            $F = new GeneralFunctios();
            $ip = 'root_agregarConSeeder';
            $host = 'root_agregarConSeeder';

            $user = new User();
            $user->nombre = $nombre;
            $user->ap_paterno = $ap_paterno;
            $user->ap_materno = $ap_materno;
            $user->username = $username;

            $user->curp = $curp;
            $user->emails = $emails;
            $user->celulares = $celulares;
            $user->telefonos = $telefonos;
            $user->fecha_nacimiento = $fecha_nacimiento == "" ? null : $fecha_nacimiento;
            $user->genero = $genero;

            $user->email = $username . '@example.com';
            $user->password = bcrypt($username);
            $user->admin = 0;
            $user->empresa_id = $empresa_id;
            $user->creado_por_id = $creado_por_id;
            $user->user_id_anterior = $user_id_anterior;
            $user->ip = $ip;
            $user->host = $host;
            $user->email_verified_at = now();
            $user->save();
            $user->roles()->attach(3);
            if ($role_id > 0) $user->roles()->attach($role_id);
            $user->permissions()->attach(7);
            $user->user_adress()->create($dataAdress);
            $user->user_data_extend()->create($dataExtend);
            $user->user_data_social()->create();
            $F->validImage($user, 'profile', 'profile/');
        }else{
            if ($role_id > 0) {
                $user->curp = $curp;
                $user->save();
                $user->roles()->detach($role_id);
                $user->roles()->attach($role_id);
            }
        }

        return $user;

    }






}

