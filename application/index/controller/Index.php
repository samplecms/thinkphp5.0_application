<?php
namespace app\index\controller;

class Index extends \app\common\FrontController
{
    public function index()
    {
    	\app\db\share::save();

        return  $this->make('/index');
    }

    public function prev($id)
    {
    	$content = \app\db\share::get_by_num($id);
    	if(!$content){
    		$content = "
    			<p><label class='label label-info'>阅后即焚温馨提示：</label></p>
    			<div class='alert alert-danger'>希望查看的内容，已经不存在了！</div>
    		";
    	}
        return  $this->make('/view',['content'=>$content]);
    }


    public function share($id)
    {
    	 
    	$link = 'http://'.get_domain()."/prev/$id";
        return  $this->make('/share_link',['link'=>$link]);
    }

}
