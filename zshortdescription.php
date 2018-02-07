<?php
/*
Plugin Name: zShortDescription
Plugin URI:
Description: Shot Description [All in one SEO Pack Used Only]
Version: 0.1
Author: zinntikumugai
Author URI: http://www.zinntikumugai.com
License: GPLv3
*/
// zshotdescription
function zSD_stringFomatter($str = '') {
    $str = str_replace("\n\r\n","\n", $str);
    $str = str_replace("\n",' ', $str);
    $str = str_replace("\r",'', $str);
    //$str = str_replace("  ",' ', $str);
    $str = preg_replace('/\s(?=\s)/', '', $str);
    $str = strip_tags($str);
    $str = strip_shortcodes($str);

    return $str;
}

function zSD_aioseop_replace_description($v = '') {
	global $post;
	$more = '<!--more-->';
	$size = 60;
	$delmit = '。';
	$description = $v;

	if(!is_home()) {
		if($v !='') {
			//setted
			$content = $v;
		}else {
			//image only?
			$content = $post->post_content;
		}

		//if(zSD_stringFomatter($content) == zSD_stringFomatter($post->post_content)) {
			$pos = mb_strrpos($content, $more);
			if($pos!==false) {
				$content = mb_substr($content, 0, $pos+1);
			}else {
				$content = mb_substr($content, 0, $size);
				$pos = mb_strrpos($content, $delmit);
				if($pos!==false)
					$content = mb_substr($content, 0, $pos+1);
				$content .= ' ...';
			}
		//}
		$description = $content;
	}

    $description = ZSD_stringFomatter($description);

	return $description;
}
add_filter('aioseop_description', 'zSD_aioseop_replace_description');
