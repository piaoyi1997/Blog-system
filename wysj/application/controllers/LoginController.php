<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	public function index()
		{
			$this->load->view('Login');
		}
	public function loginList(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$res = $this->db->get('user')->result_array();
		$num = count( $res );
		if ($num==1) {
			$newdata = array(
		    	'username'  => $username
			);
			$this->session->set_userdata($newdata);
		}
		echo $num;
	}
	public function Register(){
		$username=$this->input->post('username');
		$sex=$this->input->post('sex');
		$password=$this->input->post('password');
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		$rs=$query->result_array();
		$num = count( $rs );
		if ($num==1) {
			echo "该用户名已存在！！！";
			exit();
		}
		$user_img='user1';
		$data = array(
			'username'=>$username,
			'sex'=>$sex,
			'password'=>$password,
			'user_img'=>$user_img
		);
		$this->db->insert('User', $data);
		echo '注册成功'.$username;
	}
	public function change_MM(){
		$jiu_password=$this->input->post('jiu_password');
		$xin_password=$this->input->post('xin_password');
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		foreach ($query->result_array() as $row)
		{
		    $password=$row['password'];
		}
		if ($jiu_password!=$password) {
			echo "旧密码错误";
			exit();
		}
		$data = array(
			'password'=>$xin_password
		);
		$this->db->where('username', $username);
		$this->db->update('user',$data);
		echo "密码修改成功";
	}
}