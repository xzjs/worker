<?php

class WorkerController extends HomeController{

	public function workerget($view,$action,$id1=0,$id2=0){
		if($this->is_access($view)){
			switch ($view) {
				case 'center':
					switch ($action) {
						case 'list':
							$centers=Center::all();
							return View::make('center.list')->with('centers',$centers);
							break;
						case 'delete':
							$center=Center::find($id1);
							$center->delete();
							return Redirect::to('center/list');
							break;
						case 'add':
							$companies=Company::all();
							if($companies->count()==0){
								return Redirect::to('company/add');
							}
							return View::make('center.add')->with('companies',$companies);
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'company':
					switch ($action) {
						case 'list':
							$company=Company::all();
							return View::make('company.list')->with('companies',$company);
							break;
						case 'delete':
							$company=Company::find($id1);
							$company->delete();
							return Redirect::to('company/list');
							break;
						case 'add':
							return View::make('company.add');
							break;
						default:
							App::abort(404);
							break;
					}
				case 'user':
					switch ($action) {
						case 'add':
							$centers=Center::all();
							if($centers->count()==0){
								return Redirect::to('center/add');
							}
							return View::make('user.add')->with('error');
							break;
						case 'list':
							$users=User::all();
							return View::make('user.list')->with('users',$users);
							break;
						case 'delete':
							$user=User::find($id1);
							$user->delete();
							return Redirect::to('user.list');
							break;
						case 'edit':
							$user=User::find($id1);
							return View::make('user.edit')->with('user',$user);
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'activity':
					switch ($action) {
						case 'arrange':
							return View::make('activity.arrange')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
							break;
						case 'add':
							$activity=new Activity;
							$center_date=explode('a',$id1);
							$center_id=$center_date[1];
							$date=$center_date[0];
							$activity->center_id=$center_id;
							$activity->Date=$date;
							$activity->save();
							$activity_id=$activity->id;
							$chair=new Chair;
							$chair->teacher_id=$id2;
							$chair->activity_id=$activity_id;
							$chair->save();
							break;
						case 'delete':
							$center_date=explode('a',$id1);
							$center_id=$center_date[1];
							$date=$center_date[0];
							$activity=Activity::where('center_id','=',$center_id)->where('Date','=',$date)->first();
							$chair=$activity->chair;
							$activity->delete();
							$chair->delete();
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'content':
					switch ($action) {
						case 'add':
							return View::make('content.add');
							break;
						case 'arrange':
							return View::make('content.arrange')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
							break;
						case 'addToChair':
							$chair=Chair::find($id1);
							$chair->content_id=$id2;
							$chair->save();
							break;
						case 'delToChair':
							$chair=Chair::find($id1);
							$chair->content_id=null;
							$chair->save();
							break;
						case 'delete':
							$content=Content::find($id1);
							$chairs=$content->chairs;
							foreach ($chairs as $chair) {
								$chair->content_id=null;
								$chair->save();
							}
							$content->delete();
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'share':
					switch ($action) {
						case 'add':
							return View::make('share.add');
							break;
						case 'arrange':
							return View::make('share.arrange')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
							break;
						case 'addToChair':
							$chair=Chair::find($id1);
							$chair->share_id=$id2;
							$chair->save();
							break;
						case 'delToChair':
							$chair=Chair::find($id1);
							$chair->share_id=null;
							$chair->save();
							break;
						case 'delete':
							$content=Share::find($id1);
							$chairs=$content->chairs;
							foreach ($chairs as $chair) {
								$chair->share_id=null;
								$chair->save();
							}
							$content->delete();
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'host':
					switch ($action) {
						case 'arrange':
							return View::make('host.arrange')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
							break;
						case 'addToChair':
							$chair=Chair::find($id1);
							$chair->host_id=$id2;
							$chair->save();
							break;
						case 'delToChair':
							$chair=Chair::find($id1);
							$chair->host_id=null;
							$chair->save();
							break;
						
						default:
							# code...
							break;
					}
					break;
				case 'song':
					switch ($action) {
						case 'add':
							return View::make('song.add');
							break;
						case 'arrange':
							return View::make('song.arrange')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
							break;
						case 'addToChair':
							$chair=Chair::find($id1);
							$chair->song_id=$id2;
							$chair->save();
							break;
						case 'delToChair':
							$chair=Chair::find($id1);
							$chair->song_id=null;
							$chair->save();
							break;
						case 'delete':
							$content=Share::find($id1);
							$chairs=$content->chairs;
							foreach ($chairs as $chair) {
								$chair->song_id=null;
								$chair->save();
							}
							$content->delete();
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				default:
				App::abort(404);
					break;
			}
		}
	}
	
	public function workerpost($view,$action,$id=0){
		if($this->is_access($view)){
			switch ($view) {
				case 'center':
					switch ($action) {
						case 'list':
							$name=Input::get('center_name');
							$company_id=Input::get('company_id');
							$center=new Center;
							$center->CompanyID=$company_id;
							$center->CenterName=$name;
							$center->save();
							return Redirect::to('center/list');
							//return View::make('center.list');
							break;
						
						default:
							App::abort(404);
							break;
					}
					break;
				case 'company':
					switch ($action) {
						case 'list':
							$name=Input::get('company_name');
							$company=new Company;
							$company->CompanyName=$name;
							$company->save();
							return Redirect::to('company/list');
							break;
						
						default:
							App::abort(404);
							break;
					}
					break;
				case 'user':
					switch ($action) {
						case 'list':
							$name=Input::get('user_name');
							$phone=Input::get('phone');
							$center=Input::get('center');
							$roles=Input::get('role');
							$reset=Input::get('reset');
							$id=Input::get('id');
							$rules = array(
								'phone'=>'regex:/^[1][358]\d{9}$/'
								);
							$data=array(
								'phone'=>$phone,
							);
							$validator=Validator::make($data,$rules);
							if($validator->fails()){
								//号码验证失败
								return Redirect::to('user/add')->withErrors($validator);
							}
							$user=null;
							if($id==null){
								$user=new User;
								$user->password= Hash::make('1');
								
							}else{
								$user=User::find($id);
								if($reset=='reset'){
									$user->password= Hash::make('1');
								}
							}
							$user->Name=$name;
							$user->Phone=$phone;
							$user->center_id=$center;
							$user->save();

							$affectedRows = RoleUser::where('user_id', '=', $user->id)->delete();

							foreach ($roles as $role ){
								$role_user=new RoleUser;
								$role_user->user_id=$user->id;
								$role_user->role_id=$role;
								$role_user->save();
							}

							return Redirect::to('user/list');
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'activity':
					switch ($action) {
						case 'arrange':
							//$this->getSunday();
						$month=Input::get('user_date');
						$date_month=strtotime($month);
						//throw new Exception($returnView, 1);
						return View::make('activity.arrange')->with('sundays',$this->returnSunday($date_month));
							break;
						
						default:
							App::abort(404);
							break;
					}
					break;
				case 'content':
					switch ($action) {
						case 'add':
							$content=new Content;
							$content->user_id=Auth::id();
							$content->text=Input::get('chaircontent');
							$content->save();
							return Redirect::to('content/arrange');
							break;
						case 'arrange':
							$month=Input::get('user_date');
							$date_month=strtotime($month);
							//throw new Exception($returnView, 1);
							return View::make('content.arrange')->with('sundays',$this->returnSunday($date_month));
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'share':
					switch ($action) {
						case 'add':
							$share=new Share;
							if(Auth::user()->roles->id==5){
								$share->content=Input::get('sharecontent');
							}else{
								$share->content2=Input::get('sharecontent');
							}
							$share->user_id=Auth::id();
							$share->time=date("Y-m-d", strtotime('next Sunday'));
							$share->save();
							return Redirect::to('share/arrange');
							break;
						case 'arrange':
							$month=Input::get('user_date');
							$date_month=strtotime($month);
							//throw new Exception($returnView, 1);
							return View::make('share.arrange')->with('sundays',$this->returnSunday($date_month));
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				case 'host':
					switch ($action) {
						case 'arrange':
							$month=Input::get('user_date');
							$date_month=strtotime($month);
							//throw new Exception($returnView, 1);
							return View::make('host.arrange')->with('sundays',$this->returnSunday($date_month));
							break;
						
						default:
							App::abort(404);
							break;
					}
					break;
				case 'song':
					switch ($action) {
						case 'add':
							$share=new Song;
							$share->content=Input::get('songcontent');
							$share->user_id=Auth::id();
							$share->save();
							return Redirect::to('song/arrange');
							break;
						case 'arrange':
							$month=Input::get('user_date');
							$date_month=strtotime($month);
							//throw new Exception($returnView, 1);
							return View::make('song.arrange')->with('sundays',$this->returnSunday($date_month));
							break;
						default:
							App::abort(404);
							break;
					}
					break;
				default:
					App::abort(404);
					break;
			}
		}
	}

	//检测权限
	public function is_access($view){
		$roles=Auth::user()->roles;
		foreach ($roles as $role) {
			$powers=$role->powers;
			foreach ($powers as $power) {
				if($power->name==$view){
					return true;
				}
			}
		}
		App::abort(403);
	}

	//得到星期日
	public function getSunday(){
		$month=Input::get('user_date');
		$returnView=Input::get('return_view');
		$date_month=strtotime($month);
		//throw new Exception($returnView, 1);
		return View::make($returnView)->with('sundays',$this->returnSunday($date_month));
	}

	//返回该日期坐在月的周日
	public function returnSunday($time){
		$sunday_array=array();
		$sunday=strtotime('next Sunday',$time);
		
		while ($sunday<strtotime('next Month',$time)){
			array_push($sunday_array, $sunday);
			$sunday=strtotime('next Sunday',$sunday);
		}
		//throw new Exception("haha", 1);
		return $sunday_array;
	}

	public function index(){
		return View::make('index')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
	}
}

?>