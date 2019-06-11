<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
	public function index()
		{
			$data['img']=$this->get_gr_img();
			$this->load->view('header',$data);
			$this->load->view('Main');
		}
	#个人主页查询
	public function gr_Main(){
		$data['img']=$this->get_gr_img();
		$this->load->view('header',$data);
		$this->load->view('gr_Main',$data);
	}
	#文章查询
	public function huifu(){
		$wenzhangId=$_GET['id'];
		$this->add_browse($wenzhangId);
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		$result['data'] = $query->result_array();
		// echo json_encode($result);
		$data['img']=$this->get_gr_img();
		$this->load->view('header',$data);
		$this->load->view('Main_huifu',$result);
	}
	//热度加一,浏览次数加一
	public function add_browse($wenzhangId){
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		foreach ($query->result_array() as $row)
		{
		    $ly_num=$row['ll_num'];
		    $redu=$row['redu'];
		}
		$ly_num=$ly_num+1;
		$redu=$redu+1;
		$data2 = array(
			'll_num'=>$ly_num,
			'redu'=>$redu
		);
		$this->db->where('wenzhangId', $wenzhangId);
		$this->db->update('wenzhang',$data2);
	}
	#添加评论留言
	public function liuyan(){
		$hf_content=$this->input->post('hf_content');
		$wenzhangId=$this->input->post('wenzhangId');
		$username=$this->session->userdata('username');
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		foreach ($query->result_array() as $row)
		{
		    $ly_num=$row['ly_num'];
		    $redu=$row['redu'];
		}
		$ly_num=$ly_num+1;
		$redu=$redu+1;
		#增加回复记录条数
		$data2 = array(
			'ly_num'=>$ly_num,
			'redu'=>$redu
		);
		$this->db->where('wenzhangId', $wenzhangId);
		$this->db->update('wenzhang',$data2);
		#添加回复
		date_default_timezone_set('PRC');
		$data = array(
			'username'=>$username,
			'wenzhangId'=>$wenzhangId,
			'hf_content'=>$hf_content,
			'hf_time'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('huifu', $data);
		echo "回复成功";
	}
	#检验是否登录
	public function isLogin(){
		$isLogin=$this->session->has_userdata('username');
		echo $isLogin;
	}
	#所有文章查询
	public function all_view(){
		// $query = $this->db->get('wenzhang');
		$sql = "select * from wenzhang order by redu desc";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		echo json_encode($result);
	}
	#个人文章查询
	public function gr_view(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		echo json_encode($result);
	}
	//个人粉丝查询
	public function gr_fs_view(){
		$username=$this->session->userdata('username');
		$this->db->where('bgz_username', $username);
		$query = $this->db->get('guanzhu');
		$result = $query->result_array();
		echo json_encode($result);
	}
	//私信查询
	public function hf_view(){
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('huifu');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function zhuxiao(){
		session_destroy();
		redirect('MainController');

	}
	public function zuozhe(){
		$username=$_GET['username'];
		$data['img']=$this->get_zz_img($username);
		$this->load->view('header',$data);
		$this->load->view('zuozhe_view');
	}
	public function zuozhe_View(){
		$username=$this->input->post('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function sixinList(){
		$fs_content=$this->input->post('fs_content');
		$fs_username=$this->input->post('fs_username');
		$sj_username=$this->input->post('sj_username');
		date_default_timezone_set('PRC');
		$data = array(
			'fs_username'=>$fs_username,
			'sj_username'=>$sj_username,
			'fs_content'=>$fs_content,
			'fs_time'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('sixin', $data);
		echo '发送成功';
	}
	public function wz_num(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function sj_num(){
		$username=$this->session->userdata('username');
		$this->db->where('sj_username', $username);
		$query = $this->db->get('sixin');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function pl_num(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('huifu');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function zuozhe_wz_num(){
		$username=$this->input->post('username');
		$this->db->where('username', $username);
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function zuozhe_pl_num(){
		$username=$this->input->post('username');
		$this->db->where('username', $username);
		$query = $this->db->get('huifu');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function fens_num(){
		$username=$this->session->userdata('username');
		$this->db->where('bgz_username', $username);
		$query = $this->db->get('guanzhu');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function get_pl_view(){
		$username=$this->session->userdata('username');
		$this->db->where('sj_username', $username);
		$query = $this->db->get('sixin');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function get_gr_img(){
		$username=$this->session->userdata('username');
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		foreach ($query->result_array() as $row)
		{
		    return $row['user_img'];
		}
	}
	public function get_zz_img($username){
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		foreach ($query->result_array() as $row)
		{
		    return $row['user_img'];
		}
	}
	public function guanzhu(){
		$gz_username=$this->session->userdata('username');
		$bgz_username=$this->input->post('bgz_username');	
		date_default_timezone_set('PRC');
		$data = array(
			'gz_username'=>$gz_username,
			'bgz_username'=>$bgz_username,
			'gz_time'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('guanzhu', $data);
		$this->db->where('username', $bgz_username);
		$query = $this->db->get('user');
		foreach ($query->result_array() as $row)
		{
		    $fens_num=$row['fens_num'];
		}
		$fens_num=$fens_num+1;
		$data2 = array(
			'fens_num'=>$fens_num
		);
		$this->db->where('username', $bgz_username);		
		$this->db->update('user', $data2);
		echo '关注成功';
	}
	public function qx_guanzhu(){
		$gz_username=$this->session->userdata('username');
		$bgz_username=$this->input->post('bgz_username');		
		$this->db->where('gz_username', $gz_username);
		$this->db->where('bgz_username', $bgz_username);
		$this->db->delete('guanzhu');//删除
		//人数减一
		$this->db->where('username', $bgz_username);
		$query = $this->db->get('user');
		foreach ($query->result_array() as $row)
		{
		    $fens_num=$row['fens_num'];
		}
		$fens_num=$fens_num-1;
		$data2 = array(
			'fens_num'=>$fens_num
		);
		$this->db->where('username', $bgz_username);		
		$this->db->update('user', $data2);
		echo '取消关注成功';
	}
	public function ifGuanzhu(){
		$gz_username=$this->session->userdata('username');
		$bgz_username=$this->input->post('bgz_username');
		$this->db->where('bgz_username', $bgz_username);
		$this->db->where('gz_username', $gz_username);
		$query = $this->db->get('guanzhu');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function redu_view(){
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		$result = $query->result_array();
		echo json_encode($result);
	}
	public function dianzan(){
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		foreach ($query->result_array() as $row)
		{
		    $dz_num=$row['dz_num'];
		    $redu=$row['redu'];
		}
		$dz_num=$dz_num+1;
		$redu=$redu+1;
		$data = array(
			'dz_num'=>$dz_num,
			'redu'=>$redu
		);
		$this->db->where('wenzhangId', $wenzhangId);
		$this->db->update('wenzhang',$data);
		date_default_timezone_set('PRC');
		$username=$this->session->userdata('username');
		$data2 = array(
			'dz_username'=>$username,
			'wenzhangId'=>$wenzhangId,
			'dz_time'=>date('Y-m-d H:i:s')
		);
		$this->db->insert('dianzan', $data2);
		echo "点赞成功";
	}
	public function qxdianzan(){
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('wenzhang');
		foreach ($query->result_array() as $row)
		{
		    $dz_num=$row['dz_num'];
		    $redu=$row['redu'];
		}
		$dz_num=$dz_num-1;
		$redu=$redu-1;
		$data = array(
			'dz_num'=>$dz_num,
			'redu'=>$redu
		);
		$this->db->where('wenzhangId', $wenzhangId);
		$this->db->update('wenzhang',$data);
		//删除
		$username=$this->session->userdata('username');
		$this->db->where('wenzhangId', $wenzhangId);
		$this->db->where('dz_username', $username);
		$this->db->delete('dianzan');
	}
	public function ifDianzan(){
		$dz_username=$this->session->userdata('username');
		$wenzhangId=$this->input->post('wenzhangId');
		$this->db->where('dz_username', $dz_username);
		$this->db->where('wenzhangId', $wenzhangId);
		$query = $this->db->get('dianzan');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
	public function get_dz_num(){
		$dz_username=$this->session->userdata('username');
	}
	public function zz_fens_num(){
		$username=$this->input->post('username');
		$this->db->where('bgz_username', $username);
		$query = $this->db->get('guanzhu');
		$result = $query->result_array();
		$num = count( $result );
		echo $num;
	}
}
