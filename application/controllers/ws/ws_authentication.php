<?php 
class ws_authentication extends CI_Controller{

	public function register(){
		$this->load->model('m_student');

		$name = $this->input->post('name') ;
		$major_id = $this->input->post('major_id');
		$uni_id = $this->input->post('uni_id') ;
		$ip = $this->m_student->getUserIp() ;
		$android_ver = $this->input->post('android_ver');
		$api_code = $this->m_student->makeApiCode();


		$data = array(
				m_student::COLUMN_NAME => $name ,
				m_student::COLUMN_MAJOR_ID => $major_id ,
				m_student::COLUMN_UNI_ID => $uni_id ,
				m_student::COLUMN_IP => $ip ,
				m_student::COLUMN_ANDROID_VER => $android_ver ,
				m_student::COLUMN_API_CODE => $api_code ,
			);

		$st_id = $this->m_student->save($data);
		if($st_id) echo $api_code ;
		else echo -1 ;
	}

	public function get_int(){
		echo time() ;
	}
}