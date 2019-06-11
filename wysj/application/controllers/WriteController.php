<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 // header("Content-type:text/html;charset=utf-8");
class WriteController extends CI_Controller {
	public function index()
		{
			$this->load->view('Write');
		}
	public function isLogin(){
		$isLogin=$this->session->has_userdata('username');
		echo $isLogin;
	}
	public function isFabiao(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenji');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function wenjilist(){
		$wenjiname=$this->input->post('wenjiname');
		$username=$this->session->userdata('username');
		$data = array(
			'wenjiname'=>$wenjiname,
			'username'=>$username
		);
		$this->db->insert('wenji', $data);
		echo '添加成功'.$wenjiname;
	}
	public function wenzhanglist(){
		$wenjiId=$this->input->post('wzindex');
		$username=$this->session->userdata('username');
		$title=$this->input->post('title');
		$content=$this->input->post('content');
		date_default_timezone_set('PRC');		
		$data = array(
			'wenjiId'=>$wenjiId,
			'username'=>$username,
			'title'=>$title,
			'content'=>$content,
			'time'=>date('Y-m-d H:i:s'),
			'ly_num'=>0,
			'dz_num'=>0,
			'redu'=>0,
			'll_num'=>0
		);
		$this->db->insert('wenzhang', $data);
		echo '添加成功'.$title;
	}
	public function wenji_view(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenji');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function wenzhang_view(){
		$wenjiId=$this->input->post('wenjiId');
		if ($wenjiId!='') {
			$this->db->where('wenjiId', $wenjiId);
		}else{
			$username=$this->session->userdata('username');
			 $this->db->where('username', $username);
		}		
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function delwenzhang(){
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('wenzhangId', $wenzhangId);
		if ($this->db->delete('wenzhang')) {
			echo "删除成功";
		}else{
			echo "删除失败";
		}
	}
}
