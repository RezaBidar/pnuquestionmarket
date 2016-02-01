<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class test extends CI_Controller 
{
	
	function index2()
	{

		// gethostbyaddr('')
		// var_dump(gethostbyaddr('5.63.9.23'));
		// var_dump($_SERVER);
		$this->load->helper('captcha');
		$this->load->helper('path');

		$vals = array(
        'word'          => '',
        'img_path'      => './captcha/',
        'img_url'       => base_url() . 'captcha/',
        'font_path'     => './fonts/arial.ttf',
        'img_width'     => '255',
        'img_height'    => 80,
        'expiration'    => 20,
        'word_length'   => 4,
        'font_size'     => '34',
        'img_id'        => 'Imageid',
        'pool'          => array('گ','چ','پ','ژ'),

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
		);

		// echo set_realpath('./fonts/homa.ttf' , TRUE);
		$cap = create_captcha($vals);
		echo $cap['image'] ;
		var_dump($cap);
	}

        public function index()
        {
                if(isset($_POST['submit']))
                {
                        echo file_get_contents('http://localhost/fanavard/captcha/public_html/api/captcha/siteverify/?secret=c7b51d7f3d2b7c01dd085e2ed726d1cb&response='
                                . $_POST['cp-response'] . '&id=' . $_POST['cp-id'] );
                }
                $this->load->view('test');
        }
}