<?php
	class Chatcontroller extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->model('Chatmodel');
			$this->load->helper('file');
			$this->load->helper('url');
		}
		public function index()
		{
			$this->load->view('chat/login');
		}
		public function formsubmit()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
	
			$this->form_validation->set_rules('username', 'username', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
	
			if ($this->form_validation->run() === FALSE)
			{
				//$data['msg']="Username and password field cannot be empty";
				$this->load->view('chat/login');	
			}
			else
			{	
				if($this->input->post('Input')=='Log in')
				{
					if($this->Chatmodel->login($this->input->post('username'),$this->input->post('password')))
					{
						$this->session->set_userdata('username',$this->input->post('username'));
						$data['username']=$this->session->userdata('username');
						$data['contacts']=$this->Chatmodel->contactlist($this->session->userdata('username'));
						$this->load->view('chat/success',$data);
					}
					else
					{$this->load->view('chat/fail');}
				}
				elseif($this->input->post('Input')=='Register')
				{
					if($this->Chatmodel->register($this->input->post('username'),$this->input->post('password')))
					{$this->load->view('chat/success');}
					else
					{$this->load->view('chat/fail');}
				}
			}
		}
		public function beginchat()
		{
			$this->load->helper('smiley');
			$this->load->library('table');

			$image_array = get_clickable_smileys('http://localhost/chitchat/images/smileys', 'comments');

			$col_array = $this->table->make_columns($image_array, 8);

			$data['smiley_table'] = $this->table->generate($col_array);
			if(strcmp($this->input->post('chat'),$this->session->userdata('username'))<0)
			{ 
				$this->session->set_userdata('chatwith',$this->input->post('chat'));
				$this->session->set_userdata('filename',$this->input->post('chat').$this->session->userdata('username').'.html');
			}
			else
			{
				$this->session->set_userdata('filename',$this->session->userdata('username').$this->input->post('chat').'.html');
			}
			if(!(read_file('chatlogs/'.$this->session->userdata('filename'))))
			{
				write_file('chatlogs/'.$this->session->userdata('filename'), '<h6>start</h6>','a');	
			}
			$data['username']=$this->session->userdata('username');
			$data['chatwith']=$this->input->post('chat');
			$data['filename']=$this->session->userdata('filename');
			$data['string']=read_file('chatlogs/'.$this->session->userdata('filename'));
			$this->load->view('chat/chatbox',$data);
			
			/*write_file('a.html','blahblah','a');
			$data['string']=read_file('a.html');
			$data['filename']=$this->session->userdata('filename');
			$this->load->view('chat/chatbox',$data);*/

			
		}
		public function fileupdate()
		{
			$this->load->helper('smiley');
			$this->load->library('table');

			$image_array = get_clickable_smileys('http://localhost/chitchat/images/smileys', 'comments');

			$col_array = $this->table->make_columns($image_array, 8);

			$data['smiley_table'] = $this->table->generate($col_array);
			write_file('chatlogs/'.$this->session->userdata('filename'),parse_smileys('<b>'.$this->session->userdata('username').'</b>:'.$this->input->post('text').'<br>','http://localhost/chitchat/images/smileys'),'a');
			//return;
			/*$data['username']=$this->session->userdata('username');
			$data['chatwith']=$this->session->userdata('chatwith');
			$data['filename']=$this->session->userdata('filename');
			$data['string']=read_file('application/views/chat/'.$this->session->userdata('filename'));
			$this->load->view('chat/chatbox',$data);*/
		}
		public function logout()
		{
			$this->session->sess_destroy();
			$this->load->view('chat/login');
		}
		
	}
?>