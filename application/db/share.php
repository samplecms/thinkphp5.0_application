<?php
namespace app\db;
use app\common\Str;
class share{

	static $tb = 'share';

	static function save(){
		if(!is_ajax()){
				return;
		}
		$content = trim($_POST['content']);
		if(!$content){
			echo json_encode(['msg'=>['content'=>'分享内容是必填项']]);
			exit;
		}

		$num = Str::rand();
	    $one = db(self::$tb)->where(['num'=>$num])->find();
	    if($one){
	    	echo json_encode(['msg'=>['content'=>'生成链接出错,请联系管理员或重新尝试']]);
			exit;
	    }

	    db(self::$tb)->insert(['num'=>$num,'content'=>$content,'status'=>1]);


	    echo json_encode(['msg'=>'生成链接成功','page_goto'=>url('index/index/share',['id'=>$num])]);
		exit;


	}


	static function get_by_num($num){
		if(!$num){
			return;
		}
		$one = db(self::$tb)->where(['num'=>$num,'status'=>1])->find();
		$c = $one['content'];
		db(self::$tb)->where(['_id'=>$one['_id']])->update(['status'=>0]);
		
		return $c;
	}


}