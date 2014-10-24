<?php

class ArrangeController extends HomeController{

	public function returnSunday($time){
		$sunday_array=array();
		$sunday=strtotime('next Sunday',$time);
		while ($sunday<strtotime('next Month',$time)){
			array_push($sunday_array, $sunday);
			$sunday=strtotime('next Sunday',$sunday);
		}
		return $sunday_array;
	}

	public function train(){
		return View::make('train')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
		
	}

	public function getSunday(){
		$month=Input::get('user_date');
		$returnView=Input::get('return_view');
		$date_month=strtotime($month);
		return View::make($returnView)->with('sundays',$this->returnSunday($date_month));
	}

	public function addActivity($centerdate,$people){
		$activity=new Activity;
		$center_date=explode('a',$centerdate);
		$center_id=$center_date[1];
		$date=$center_date[0];
		$activity->center_id=$center_id;
		$activity->Date=$date;
		$activity->save();
		$activity_id=$activity->id;
		$chair=new Chair;
		$chair->teacher_id=$people;
		$chair->activity_id=$activity_id;
		$chair->save();
	}

	public function delActivity($enterdatepeople){
		$center_date=explode('a',$enterdatepeople);
		$center_id=$center_date[1];
		$date=$center_date[0];
		$activity=Activity::where('center_id','=',$center_id)->where('Date','=',$date)->first();
		$chair=$activity->chair;
		$activity->delete();
		$chair->delete();
	}

	public function contentArrage(){
		return View::make('contentArrage')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
	}

	public function contentAdd(){
		$content=new Content;
		$content->user_id=Auth::id();
		$content->text=Input::get('chaircontent');
		$content->save();
		return Redirect::to('contentArrage');
	}

	public function chairAddContent($chairid,$contentid){
		$chair=Chair::find($chairid);
		$chair->content_id=$contentid;
		$chair->save();
	}

	public function chairDelContent($chairid){
		$chair=Chair::find($chairid);
		$chair->content_id=null;
		$chair->save();
	}

	public function contentDel($contentid){
		$content=Content::find($contentid);
		$content->delete();
	}

	public function shareAdd(){
		$share=new Share;
		$share->content=Input::get('sharecontent');
		$share->user_id=Auth::id();
		$share->center_id=Auth::user()->center_id;
		$share->save();
		return Redirect::to('shareArrage');
	}

	public function shareArrage(){
		return View::make('shareArrage')->with('sundays',$this->returnSunday(strtotime(date("Y-m"))));
	}

	public function chairAddShare($chairid,$contentid){
		$chair=Chair::find($chairid);
		$chair->share_id=$contentid;
		$chair->save();
	}

	public function chairDelShare($chairid){
		$chair=Chair::find($chairid);
		$chair->share_id=null;
		$chair->save();
	}

	public function shareDel($contentid){
		$content=Share::find($contentid);
		$content->delete();
	}
}

?>