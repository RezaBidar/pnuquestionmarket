<?php

class Dashboard extends Admin_Controller{


	public function index(){


		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;

		$this->load->model('m_lesson');
		$this->load->model('m_question_page');
		$this->load->model('m_question');

		$select_count = array('COUNT(*) as count') ;

		$this->db->select($select_count) ;
		$this->data['my_question_count'] = $this->m_question->get_by(array(m_question::COLUMN_CREATOR => $this->data['user_id']),TRUE , FALSE)->count ;
		
		$this->db->select($select_count) ;
		$this->data['my_qpage_count'] = $this->m_question_page->get_by(array(m_question_page::COLUMN_CREATOR => $this->data['user_id']),TRUE , FALSE)->count;
		
		$this->db->select($select_count) ;
		$this->data['my_lesson_count'] = $this->m_lesson->get_by(array(m_lesson::COLUMN_CREATOR => $this->data['user_id']),TRUE , FALSE)->count ;
		

		$this->db->select($select_count) ;
		$this->data['question_count'] = $this->m_question->get(NULL , TRUE)->count ;
		
		$this->db->select($select_count) ;
		$this->data['qpage_count'] = $this->m_question_page->get(NULL , TRUE)->count ;
		
		$this->db->select($select_count) ;
		$this->data['lesson_count'] = $this->m_lesson->get(NULL , TRUE)->count ;

		//$this->data['user_fullname']
		$this->data['table'] = $this->m_question_page->getWritersTable();		


		$table = new My_Table; 
		$thead = array('نام فایل' , 'دانلود') ;
		$tbody = array('name' , 'link') ;
		$data = array(
			(object) array('name' => 'قسمت اول - پروفایل' , 'link' => '<a style="color:red" href="' . site_url('vids/vid1 intro.mp4').'" class="fa fa-download fa-2x"></a>'),
			(object) array('name' => 'قسمت دوم - درسها' , 'link' => '<a style="color:orange"  href="' . site_url('vids/vid2 lesson.mp4').'" class="fa fa-download fa-2x"></a>'),
			(object) array('name' => 'قسمت سوم - سوالات' , 'link' => '<a style="color:blue"  href="' . site_url('vids/vid3 question.mp4').'" class="fa fa-download fa-2x"></a>'),
		);
		$this->data['vids_table'] = $table->getView($thead , $tbody , '' , $data);

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/component/footer');
	}

	public function logout()
	{

		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;
		
		$this->m_user->logout();
		redirect('login');
	}

	public function test()
	{
		$this->load->model('m_lesson');
		$this->load->model('m_question_page');
		$this->load->model('m_question');

		$this->data['table'] = $this->m_question_page->getWritersTable();
		
		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}
}