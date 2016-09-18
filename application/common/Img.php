<?php
// +----------------------------------------------------------------------
// | File
// +----------------------------------------------------------------------
// | Copyright (c) 20016
// +----------------------------------------------------------------------
// | Author: sunkangchina <weichat>
// +----------------------------------------------------------------------
namespace app\common;
class Img{
 
	 

	/**
	* mime 
	*
	* @param string $name 　 
	* @param string $arr 　 
	* @return  string
	*/
	static function mime($name){
		return getimagesize($name)['mime'];
	}
 	 
 	/**
	* 本地的图片,如果存在返回图片的URL 
	*
	* @param string $str 　 
	* @return  string/null
	*/
	static function get_local_one($str,$return_img_tag = false){
		return static::local($str , false,$return_img_tag );
	} 
 	/**
	* 本地的所有图片,如果存在返回图片的URL 
	*
	* @param string $str 　 
	* @return  array/null
	*/
	static function get_local_all($str,$return_img_tag = false){
		return static::local($str , true,$return_img_tag);
	}
 
	/**
	* 不区别本地或线上图片,返回第一个图片的URL 
	*
	* @param string $str 　 
	* @return  string/null
	*/
	static function get_one($str,$return_img_tag = false){
		return static::get($str , false,$return_img_tag);
	}
	 
	/**
	* 不区别本地或线上图片,返回所有图片的URL 
	*
	* @param string $str 　 
	* @return  array/null
	*/
	static function get_all($str,$return_img_tag = false){
		return static::get($str , true,$return_img_tag );
	} 
	/**
	* 移除内容中的图片元素
	*
	* @param string $content 　 
	* @return  string
	*/
	static function remove($content){  
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
		$out = preg_replace($preg,"",$content);
		return $out;
	} 
 
	/**
	* 图片的宽高
	*
	* @param string $img 　 
	* @return  array [w,h]
	*/
	static function wh($img){
		$a = getimagesize($img);
		return array('w'=>$a[0],'h'=>$a[1]);
	}
 	/**
	*  内部函数
	*/
	static function get($content,$all=true,$return_img_tag = false){ 
		$preg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i'; 
		preg_match_all($preg,$content,$out);
		$i = 2;
		if($return_img_tag === true){
			$i = 0;
		}
		$img = $out[$i];  
		if($all === true){
			return $img;
		}else if($all === false){
			return $img[0]; 
		}
		return $out[0];
	} 
	/**
	*  内部函数
	*/
	static function local($content,$all=false,$return_img_tag = false){  
		$img = static::get($content, true,$return_img_tag);
		if($img) { 
			$num = count($img); 
			for($j=0;$j<$num;$j++){ 
				$i = $img[$j]; 
				if( (strpos($i,"http://")!==false || strpos($i,"https://")!==false ))
				{
					unset($img[$j]);
				}
			}
		}
		if($all === true){
			return $img;
		}
		return $img[0]; 
	} 







}