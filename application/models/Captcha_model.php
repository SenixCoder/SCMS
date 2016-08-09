<?php

class Captcha_model extends CI_Model 
{
	public function __construct() {
    	// Call the CI_Model constructor
    	parent::__construct();
    }

    public function init_pic() {
        
        /*$this->load->helper('captcha');
        
        $vals = array(
            'word'          => '',
            'img_path'      => './captcha/',
            'img_url'       =>  base_url() .'/captcha/',
            'font_path'     =>  base_url() . 'system/fonts/texb.ttf',
            'img_width'     => '115',
            'img_height'    => 30,
            'expiration'    => 120,
            'word_length'   => 4,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    
            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );

        $cap = create_captcha($vals);
        $_SESSION['captcha'] = $cap['word'];
        return $cap['image'];*/
        unset($captch_code);
        $image = imagecreatetruecolor(100,40);
        $bground = imagecolorallocate($image,255,255,255);
        imagefill($image,0,0,$bground);
        $captch_code = '';
        for($i=0;$i<4;$i++){
            $fontsize = 6;
            $fontcolor = imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
            $data = 'ABCDEFGHIJKLMNPQRSTUVWXYabcdefghijklmnpqrstuvwxy23456789234567892345678923456789';
            $fontcontent = substr($data,rand(0,strlen($data)),1);
            $captch_code .= $fontcontent;
            $x = ($i*100/4)+rand(5,10);
            $y = rand(15,20);
            imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
        }

        $_SESSION['captcha'] = $captch_code;
        for($i=0;$i<200;$i++){
            $pointcolor = imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
            imagesetpixel($image,rand(0,99),rand(0,40),$pointcolor);
        }
        for($i=0;$i<4;$i++){
            $linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
            imageline($image,rand(1,99),rand(1,39),rand(1,99),rand(1,39),$linecolor);
        }
        $date['image'] = $image;
        $date['captcha'] = $captch_code;
        return $date;
    }
}