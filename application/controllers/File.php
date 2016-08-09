<?php

class File extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form','url','download', 'file'));

		$this->load->library('upload');
		$this->load->library('ftp');
		$this->load->model('file_model');
		$this->load->model('display_file_model');
	}

	public function show_term()
	{
		$data['course_data'] = $this->file_model->get_courses();
		$data['url'] = 'file/index';
		$data['title'] = '课程';

		$this->load->view('main', $data);
	}

	public function add_file_page()
	{
		$data['error'] = ' ';
		$data['title'] = '添加资料';
		$data['url']   = 'file/add_file';
		$data['courses'] = $this->file_model->get_courses();
		$data['grades'] = $this->display_file_model->get_grade();
		// var_dump($this->file_model->get_courses());
		// die();

		$this->load->view('main', $data);
	}

	public function display_files($id)
	{
		$data['error'] = ' ';
		$data['title'] = '课程资料一览';
		$data['url']   = 'file/display';
		$data['file_data'] = $this->file_model->list_files_by_course($id);

		$this->load->view('main', $data);
	}

	public function initialize_upload()
	{
		$data['upload_path'] 	= './uploads';
		$data['allowed_types'] 	= 'git|jpg|png|doc|docx|zip|rar|xlsx|ppt|xls|pdf';
		$data['max_size'] 		= 0;
		$data['max_width']		= 0;
		$data['max_height']		= 0;
		$data['max_filename']	= 80;

		if( ! $this->upload->initialize($data))
		{
			return "fail to initialize upload library";
		}
		else
		{
			return "";
		}
	}

	public function do_upload()
	{
		$error = $this->initialize_upload();
		if( ! $this->upload->do_upload('userfile'))
		{
			$res['error']	= $this->upload->display_errors();
			$res['url']		= 'file/add_file';
			$res['title']	= "添加资料";
			$res['courses']	= $this->file_model->get_courses();
			$res['grades'] = $this->display_file_model->get_grade();
			$this->load->view('main', $res);
		}
		else
		{

			$file_data = $this->upload->data();
			$res['error'] 	= $this->file_model->insert_file_data($file_data);
			$res['url'] 	= 'file/add_file';
			$res['title']	= "添加资料";
			$res['courses'] = $this->file_model->get_courses();
        	$res['grades'] = $this->display_file_model->get_grade();

			$this->load->view('main', $res);
		}
	}

	public function list_files_by_course_id($course_id)
	{
		$course_files = $this->file_model->list_files_by_course($course_id);
		
		$res['title'] = $this->file_model->get_course_name_by_id($course_id);
		$res['url']	  = 'file/file_information';
		$res['course_data'] = $course_files;

		$this->load->view('main', $res);
	}

	public function download_file($id)
	{
		$res = $this->file_model->get_file_path_by_id($id);
		$result = array(
            'level' => 5,
            'time' => date("Y-m-d H:i:s"),
            'detail' => $this->session->userdata('front_id')
        );
        $this->db->insert('system_log',$result);
		force_download("./uploads/".$res[0]->name, NULL);
		
	}

	public function delete_file($file_path)
	{//删除文件的当前用户必须要有写权限
		$data = $this->file_model->get_file_data_by_path($file_path);

		if($data == NULL)
		{
			$res['error'] = "不存在该文件";
			$res['url']	  = 'index/welcome';
			$res['title'] = $this->file_model->get_course_name_by_id($data['course_id']);
			$res['course_data'] = $this->file_model->list_files_by_course($data['course_id']);

			$this->load->view('main', $res);
		}
		else
		{
			if( ! delete_files($file_path))
			{	
				$res['error'] = "文件删除失败！请联系管理员！";
				$res['url']	  = 'file/file_information';
				$res['title'] = $this->file_model->get_course_name_by_id(1);
				$res['course_data'] = $this->file_model->list_files_by_course(1);

				$this->load->view('main', $res);
			}
			else
			{
				$res['error'] = $this->file_model->delete_file_by_path($file_path);
				$res['url']   = 'file/file_information';
				$res['title'] = $this->file_model->get_course_name_by_id($data['course_id']);
				$res['course_data'] = $this->file_model->list_files_by_course($data['course_id']);

				$this->load->view('main', $res);
			}
		}
	}


	public function connect_ftp() 
	{
		$config['hostname'] = 'localhost';
		$config['username'] = 'test';
		$config['password'] = 'q';
		$config['debug']	= TRUE;
		$config['port']		= 21;
		$config['passive']	= FALSE;

		if(!$this->ftp->connect($config))
		{
			die('Cannot connect to the FTP server!');
		}
	}

	public function file_operate()
	{
		$this->load->view('example_operate', array('error' => ' '));
	}

	public function upload() 
	{//What differences between CI_upload and CI_ftp?
		connect_ftp();

		if(!$this->ftp->upload('userfile','/home/senix/ftp/upload','ascii','0775')) 
		{
			$this->load->view('example_fail', array('error' => 'fail to upload'));
		}
		else
		{
			$this->load->view('example_success', array('data' => 'upload success'));
		}

		$this->ftp->close();
	}

	public function download()
	{
		connect_ftp();

		if( ! $this->ftp->download('/home/senix/ftp/download','userpath'))
		{
			$this->load->view('example_fail', array('error' => 'fail to download'));
		}
		else
		{
			$this->load->view('example_success', array('data' => 'upload success'));
		}

		$this->ftp->close();
	}

	public function delete_file_by_admin()
	{
		if(check_user_authority)
		{
			//return error;
		}
		connect_ftp();

		$this->ftp->delete_file('/choose/file/to/delete.doc');

		$this->ftp->close();
	}

	public function delete_dir_by_admin()
	{
		if(check_user_authority)
		{
			//return error;
		}

		connect_ftp();
		$this->ftp->delete_dir('/choose/dir/to/delete');
		$this->ftp->close();
	}

	public function get_file_lists()
	{
		connect_ftp();

		$lists = $this->ftp->list_files('/home/senix/ftp/senix');

		$this->ftp->close();

		return $lists;
	}

	public function make_directory()
	{
		connect_ftp();

		$this->ftp->mkdir('/home/senix/ftp/example/', 0755);

		$this->ftp->close();
	}

	public function change_directory()
	{
		connect_ftp();

		$this->ftp->changedir('/home/senix/ftp/example/');

		$this->ftp->close();
	}
}

