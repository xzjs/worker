<?php

class UserController extends HomeController{

	public function add(){
		$name=Input::get('user_name');
		$phone=Input::get('phone');
		$center=Input::get('center');
		$roles=Input::get('role');

		$user=new User;
		$user->Name=$name;
		$user->Phone=$phone;
		$user->center_id=$center;
		$user->pwd= Hash::make('1');
		$user->save();

		foreach ($roles as $role ) {
			$role_user=new RoleUsers;
			$role_user->users_id=$user->id;
			$role_user->role_id=$role;
			$role_user->save();
		}

		return Redirect::to('userList');
	}

	public function tolist(){
		$users=User::all();
		return View::make('userList')->with('users',$users);
	}

	public function delete(){
		$user=User::find($id);
		$user->delete();
		return Redirect::to('userList');
	}

	public function login(){
		$name=Input::get('username');
		$pwd=Input::get('password');

		if (Auth::attempt(array('Name' => $name, 'password' => $pwd)))
		{
			return Redirect::intended('index');
		}
		else{
			return view::make("login")->with('error','登录失败');
		}
	}

	public function changePassword(){
		if (Hash::check(Input::get('p2'), Auth::user()->password)){
				$user=Auth::user();
				$user->password=Hash::make(Input::get('new'));
				$user->save();
				return Redirect::to('index');
		}else{
			return View::make('changePassword')->with('error','原密码错误');
		}
	}
}

?>