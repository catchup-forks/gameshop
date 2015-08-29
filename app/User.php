<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'address_id', 'code', 'activated'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	/**
	 * Activates the user
	 * @return User
	 */
	public function activate()
	{
		$this->activated = 1;
		$this->code = null;

		return $this;
	}

	/**
	 * Return Address Model instance
	 * @return \App\Models\Address
	 */
	public function address()
	{
		return $this->hasOne('\App\Models\Address', 'id', 'address_id');
	}

	public function orders()
	{
		return $this->hasMany('\App\Models\Order');
	}
}
