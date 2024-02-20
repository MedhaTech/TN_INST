<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->CI = &get_instance();
		$this->load->model('admin_model', '', TRUE);
		$this->load->library(array('table', 'form_validation'));
		$this->load->helper(array('form', 'form_helper'));
		date_default_timezone_set('Asia/Kolkata');
		ini_set('upload_max_filesize', '20M');
	}

	function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
		if ($this->form_validation->run() == FALSE) {
			$data['pageTitle'] = "Admin Login";
			$data['action'] = 'admin';

			$this->login_template->show('admin/Login', $data);
		} else {
			$username = $this->input->post('username');
			redirect('admin/dashboard', 'refresh');
		}
	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->admin_model->login($username, md5($password));
		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

	function dashboard()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Dashboard";
			$data['activeMenu'] = "dashboard";
			$data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			$data['places'] = $this->admin_model->get_table_details('places');
			$this->admin_template->show('admin/Dashboard', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	function viewinstitution($institution_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Viewinstitution";
			$data['activeMenu'] = "viewinstitution";
			$data['institution'] = $this->admin_model->get_table_details('institutions');
			$data['institution'] = $this->admin_model->get_details_by_id($institution_id,'institution_id','institutions');
			$data['taluk'] = $this->admin_model->get_table_details('taluks');
			$data['block'] = $this->admin_model->get_table_details('blocks');
			// $this->form_validation->set_rules('taluk_id', 'Taluk ID', 'required|trim');
			// $this->form_validation->set_rules('block_id', 'Block ID', 'required|trim');
			$this->admin_template->show('admin/viewinstitution', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	function states()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "States";
			$data['activeMenu'] = "states";
			$data['states'] = $this->admin_model->get_table_details('states');
			$this->admin_template->show('admin/states', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}



	public function addstates()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "States";
			$data['activeMenu'] = "states";
			$this->form_validation->set_rules('state_name', 'State Name', 'required|trim|is_unique[states.state_name]');
			$this->form_validation->set_rules('state_name_vernacular', 'Vernacular State Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addstates',$data);
			} else {
				$data = array(
					'state_name' => $this->input->post('state_name'),
					'state_name_vernacular' => $this->input->post('state_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('states', $data);
				redirect('admin/states');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function editstates($state_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "States";
			$data['activeMenu'] = "states";
			$data['state'] = $this->admin_model->get_details_by_id($state_id,'state_id','states');

			if (empty($data['state'])) {
				show_404();
			}

			$this->form_validation->set_rules('state_name', 'State Name', 'required|trim');
			$this->form_validation->set_rules('state_name_vernacular', 'Vernacular State Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editstates', $data);
			} else {
				$data = array(
					'state_name' => $this->input->post('state_name'),
					'state_name_vernacular' => $this->input->post('state_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->where('state_id', $state_id);
				$this->db->update('states', $data);
				redirect('admin/states');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function deletestates($state_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "States";
			$data['activeMenu'] = "states";
			$this->db->where('state_id', $state_id);
			$this->db->delete('states');
			redirect('admin/states');
		} else {
			redirect('admin', 'refresh');
		}
	}





	function districts()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Districts";
			$data['activeMenu'] = "districts";
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$this->admin_template->show('admin/districts', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function adddistricts()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Districts";
			$data['activeMenu'] = "districts";
			$this->form_validation->set_rules('lgd_code', 'lgd Code', 'required|trim');
			$this->form_validation->set_rules('district_name', 'District Name', 'required|trim|is_unique[districts.district_name]');
			$this->form_validation->set_rules('district_name_vernacular', 'Vernacular District Name', 'required|trim');
			$this->form_validation->set_rules('district_short_form', 'District Short Form', 'required|trim');
			$this->form_validation->set_rules('district_headquarters', 'District Headquarters', 'required|trim');
			$this->form_validation->set_rules('district_headquarters_vernacular', 'Vernacular District Headquarters', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/adddistricts', $data);
			} else {
				$data = array(
					'state_id' => '1',
					'lgd_code' => $this->input->post('lgd_code'),
					'district_name' => $this->input->post('district_name'),
					'district_name_vernacular' => $this->input->post('district_name_vernacular'),
					'district_short_form' => $this->input->post('district_short_form'),
					'district_headquarters' => $this->input->post('district_headquarters'),
					'district_headquarters_vernacular' => $this->input->post('district_headquarters_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('districts', $data);
				redirect('admin/districts');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function editdistrict($district_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Districts";
			$data['activeMenu'] = "districts";
			$data['district'] = $this->admin_model->get_details_by_id($district_id,'district_id','districts');

			

		    $this->form_validation->set_rules('lgd_code', 'lgd Code', 'required|trim');
			$this->form_validation->set_rules('district_name', 'District Name', 'required|trim');
			$this->form_validation->set_rules('district_name_vernacular', 'Vernacular District Name', 'required|trim');
			$this->form_validation->set_rules('district_short_form', 'District Short Form', 'required|trim');
			$this->form_validation->set_rules('district_headquarters', 'District Headquarters', 'required|trim');
			$this->form_validation->set_rules('district_headquarters_vernacular', 'Vernacular District Headquarters', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editdistricts', $data);
			} else {
				$data = array(
				
					'lgd_code' => $this->input->post('lgd_code'),
					'district_name' => $this->input->post('district_name'),
					'district_name_vernacular' => $this->input->post('district_name_vernacular'),
					'district_short_form' => $this->input->post('district_short_form'),
					'district_headquarters' => $this->input->post('district_headquarters'),
					'district_headquarters_vernacular' => $this->input->post('district_headquarters_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->where('district_id', $district_id);
				$this->db->update('districts', $data);
				redirect('admin/districts');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}


	public function deletedistrict($district_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "districts";
			$data['activeMenu'] = "districts";
			$this->db->where('district_id', $district_id);
			$this->db->delete('districts');
			redirect('admin/districts');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function taluks()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "taluks";
			$data['taluks'] = $this->admin_model->get_table_details('taluks');
			$this->admin_template->show('admin/taluks', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addtaluks()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "taluks";
			$this->form_validation->set_rules('block_id', 'Block ID', 'required|trim');
			$this->form_validation->set_rules('taluk_name', 'Taluk Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name_vernacular', 'Vernacular Taluk Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addtaluks',$data);
			} else {
				$data = array(
				
					'block_id' => $this->input->post('block_id'),
					'taluk_name' => $this->input->post('taluk_name'),
					'taluk_name_vernacular' => $this->input->post('taluk_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('taluks', $data);
				redirect('admin/taluks');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function edittaluks($taluk_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "taluks";
			$data['taluk'] = $this->admin_model->get_details_by_id($taluk_id,'taluk_id','taluks');

			

		    $this->form_validation->set_rules('district_id', 'District ID', 'required|trim');
			$this->form_validation->set_rules('taluk_name', 'Taluk Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name_vernacular', 'Vernacular Taluk Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/edittaluks', $data);
			} else {
				$data = array(
				
					'block_id' => $this->input->post('block_id'),
					'taluk_name' => $this->input->post('taluk_name'),
					'taluk_name_vernacular' => $this->input->post('taluk_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->where('taluk_id', $taluk_id);
				$this->db->update('taluks', $data);
				redirect('admin/taluks');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
    public function deletetaluks($taluk_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "taluks";
			$data['activeMenu'] = "taluks";
			$this->db->where('taluk_id', $taluk_id);
			$this->db->delete('taluks');
			redirect('admin/taluks');
		} else {
			redirect('admin', 'refresh');
		}
	}

    function blocks()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Blocks";
			$data['activeMenu'] = "blocks";
			$data['blocks'] = $this->admin_model->get_table_details('blocks');
			$this->admin_template->show('admin/blocks', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addblocks()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Blocks";
			$data['activeMenu'] = "blocks";
			$this->form_validation->set_rules('district_id', 'District ID', 'required|trim');
			
			$this->form_validation->set_rules('block_name', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('block_name_vernacular', 'Vernacular Taluk Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addblocks',$data);
			} else {
				$data = array(
					'district_id' => $this->input->post('district_id'),
					'block_name' => $this->input->post('block_name'),
					'block_name_vernacular' => $this->input->post('block_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('blocks', $data);
				redirect('admin/blocks');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editblocks($block_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Blocks";
			$data['activeMenu'] = "blocks";
			$data['block'] = $this->admin_model->get_details_by_id($block_id,'block_id','blocks');

			

		    $this->form_validation->set_rules('taluk_id', 'Taluk ID', 'required|trim');
			$this->form_validation->set_rules('block_name', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('block_name_vernacular', 'Vernacular Taluk Name', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editblocks', $data);
			} else {
				$data = array(
				
					'district_id' => $this->input->post('district_id'),
					'block_name' => $this->input->post('block_name'),
					'block_name_vernacular' => $this->input->post('block_name_vernacular'),
					'status' => $this->input->post('status')
				);
				$this->db->where('block_id', $block_id);
				$this->db->update('blocks', $data);
				redirect('admin/blocks');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteblocks($block_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "blocks";
			$data['activeMenu'] = "blocks";
			$this->db->where('block_id', $block_id);
			$this->db->delete('blocks');
			redirect('admin/blocks');
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function places()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "places";
			$data['places'] = $this->admin_model->get_table_details('places');
			$this->admin_template->show('admin/places', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addplaces()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "places";
			$this->form_validation->set_rules('taluk_id', 'Taluk ID', 'required|trim');
			$this->form_validation->set_rules('place_type', 'Place Type', 'required|in_list[METRO,URBAN,SEMI-URBAN,RURAL]');
			$this->form_validation->set_rules('place_name', 'Place Name', 'required|trim');
			$this->form_validation->set_rules('place_name_vernacular', 'Vernacular Place Name', 'required|trim');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['taluks'] = $this->admin_model->get_table_details('taluks');
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');
			
			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addplaces',$data);
			} else {
				$data = array(
					'taluk_id' => $this->input->post('taluk_id'),
					'place_type' => $this->input->post('place_type'),
					'place_name' => $this->input->post('place_name'),
					'place_name_vernacular' => $this->input->post('place_name_vernacular'),
					'pincode' => $this->input->post('pincode'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('places', $data);
				redirect('admin/places');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editplaces($place_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "places";
			$data['place'] = $this->admin_model->get_details_by_id($place_id,'place_id','places');

			

		    $this->form_validation->set_rules('block_id', 'Block ID', 'required|trim');
			$this->form_validation->set_rules('place_type', 'Place Type', 'required|in_list[METRO,URBAN,SEMI-URBAN,RURAL]');
			$this->form_validation->set_rules('place_name', 'Place Name', 'required|trim');
			$this->form_validation->set_rules('place_name_vernacular', 'Vernacular Place Name', 'required|trim');
			$this->form_validation->set_rules('pincode', 'Pincode', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['taluks'] = $this->admin_model->get_table_details('taluks');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editplaces', $data);
			} else {
				$data = array(
				
					'taluk_id' => $this->input->post('taluk_id'),
					'place_type' => $this->input->post('place_type'),
					'place_name' => $this->input->post('place_name'),
					'place_name_vernacular' => $this->input->post('place_name_vernacular'),
					'pincode' => $this->input->post('pincode'),
					'status' => $this->input->post('status')
				);
				$this->db->where('place_id', $place_id);
				$this->db->update('places', $data);
				redirect('admin/places');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteplaces($place_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "places";
			$data['activeMenu'] = "places";
			$this->db->where('place_id', $place_id);
			$this->db->delete('places');
			redirect('admin/places');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function institution_types()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutiontypes";
			$data['activeMenu'] = "institutiontypes";
			$data['institutiontypes'] = $this->admin_model->get_table_details('institution_types');
			$this->admin_template->show('admin/institution_types', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addinstitutiontypes()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutiontypes";
			$data['activeMenu'] = "institutiontypes";
			$this->form_validation->set_rules('institution_type', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('institution_short_name', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutiontypes', $data);
			} else {
				$data = array(
					'institution_type' => $this->input->post('institution_type'),
					'institution_short_name' => $this->input->post('institution_short_name'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('institution_types', $data);
				redirect('admin/institution_types');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editinstitutiontypes($institution_type_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutiontypes";
			$data['activeMenu'] = "institutiontypes";
			$data['institutiontype'] = $this->admin_model->get_details_by_id($institution_type_id,'institution_type_id','institution_types');

			// var_dump($data['institutiontype']);

		    $this->form_validation->set_rules('institution_type', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitutiontypes',$data);
			} else {
				$data = array(
				
					'institution_type' => $this->input->post('institution_type'),
					'status' => $this->input->post('status')
				);
				$this->db->where('institution_type_id', $institution_type_id);
				$this->db->update('institution_types', $data);
				redirect('admin/institution_types');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteinstitutiontypes($institution_type_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "institutiontypes";
			$data['activeMenu'] = "institutiontypes";
			$this->db->where('institution_type_id', $institution_type_id);
			$this->db->delete('institution_types');
			redirect('admin/institution_types');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function institutions()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions";
			$data['activeMenu'] = "institutions";
			$data['institutions'] = $this->admin_model->get_table_details('institutions');
			$this->admin_template->show('admin/institutions', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addinstitutions()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions";
			$data['activeMenu'] = "institutions";
			$this->form_validation->set_rules('institution_code', 'Institution Code', 'required|is_unique[institutions.institution_code]');
			$this->form_validation->set_rules('institution_name', 'Institution Name', 'required|trim');
			$this->form_validation->set_rules('institution_name_vernacular', 'Vernacular Place Name', 'required|trim');
			$this->form_validation->set_rules('institution_type_id', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('place_id', 'Place ID', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');
			$data['taluks'] = $this->admin_model->get_table_details('taluks');
			$data['places'] = $this->admin_model->get_table_details('places');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutions',$data);
			} else {
				$data = array(
					'institution_code' => $this->input->post('institution_code'),
					'institution_name' => $this->input->post('institution_name'),
					'institution_name_vernacular' => $this->input->post('institution_name_vernacular'),
					'institution_type_id' => $this->input->post('institution_type_id'),
					'place_id' => $this->input->post('place_id'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('institutions', $data);
				redirect('admin/institutions');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editinstitution($institution_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions";
			$data['activeMenu'] = "institutions";
			$data['institution'] = $this->admin_model->get_details_by_id($institution_id,'institution_id','institutions');

			

			$this->form_validation->set_rules('institution_code', 'Institution Code', 'required|is_unique[institutions.institution_code]');
			$this->form_validation->set_rules('institution_name', 'Institution Name', 'required|trim');
			$this->form_validation->set_rules('institution_name_vernacular', 'Vernacular Place Name', 'required|trim');
			$this->form_validation->set_rules('institution_type_id', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('place_id', 'Place ID', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			$data['places'] = $this->admin_model->get_table_details('places');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitution', $data);
			} else {
				$data = array(
				
					'institution_code' => $this->input->post('institution_code'),
					'institution_name' => $this->input->post('institution_name'),
					'institution_name_vernacular' => $this->input->post('institution_name_vernacular'),
					'institution_type_id' => $this->input->post('institution_type_id'),
					'place_id' => $this->input->post('place_id'),
					'status' => $this->input->post('status')
				);
				$this->db->where('institution_id', $institution_id);
				$this->db->update('institutions', $data);
				redirect('admin/institutions');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteinstitution($institution_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "institutions";
			$data['activeMenu'] = "institutions";
			$this->db->where('institution_id', $institution_id);
			$this->db->delete('institutions');
			redirect('admin/institutions');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function institutionprincipals()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutionprincipals";
			$data['activeMenu'] = "institutionPrincipals";
			$data['institutionprincipals'] = $this->admin_model->get_table_details('institutionprincipals');
			$this->admin_template->show('admin/institutionprincipals', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addinstitutionprincipals()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutionprincipals";
			$data['activeMenu'] = "institutionprincipals";
			$this->form_validation->set_rules('institution_id', 'Institution ID', 'required|trim');
			$this->form_validation->set_rules('principal_name', 'Principal Name', 'required|trim');
			$this->form_validation->set_rules('principal_name_vernacular', 'Vernacular Principal Name', 'required|trim');
			$this->form_validation->set_rules('principal_email', 'Principal Email', 'required|trim');
			$this->form_validation->set_rules('principal_mobile', 'Principal Mobile', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutions'] = $this->admin_model->get_table_details('institutions');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutionprincipals',$data);
			} else {
				$data = array(
					'institution_id' => $this->input->post('institution_id'),
					'principal_name' => $this->input->post('principal_name'),
					'principal_name_vernacular' => $this->input->post('principal_name_vernacular'),
					'principal_email' => $this->input->post('principal_email'),
					'principal_mobile' => $this->input->post('principal_mobile'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('institutionprincipals', $data);
				redirect('admin/institutionprincipals');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editinstitutionprincipals($institution_principal_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutionprincipals";
			$data['activeMenu'] = "institutionprincipals";
			$data['institutionprincipal'] = $this->admin_model->get_details_by_id($institution_principal_id,'institution_principal_id','institutionprincipals');

			

		    $this->form_validation->set_rules('institution_id', 'Institution ID', 'required|trim');
			$this->form_validation->set_rules('principal_name', 'Principal Name', 'required|trim');
			$this->form_validation->set_rules('principal_name_vernacular', 'Vernacular Principal Name', 'required|trim');
			$this->form_validation->set_rules('principal_email', 'Principal Email', 'required|trim');
			$this->form_validation->set_rules('principal_mobile', 'Principal Mobile', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutions'] = $this->admin_model->get_table_details('institutions');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitutionprincipals', $data);
			} else {
				$data = array(
				
					'institution_id' => $this->input->post('institution_id'),
					'principal_name' => $this->input->post('principal_name'),
					'principal_name_vernacular' => $this->input->post('principal_name_vernacular'),
					'principal_email' => $this->input->post('principal_email'),
					'principal_mobile' => $this->input->post('principal_mobile'),
					'status' => $this->input->post('status')
				);
				$this->db->where('institution_principal_id', $institution_principal_id);
				$this->db->update('institutionprincipals', $data);
				redirect('admin/institutionprincipals');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteinstitutionprincipals($institution_principal_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "institutionprincipals";
			$data['activeMenu'] = "institutionprincipals";
			$this->db->where('institution_principal_id', $institution_principal_id);
			$this->db->delete('institutionprincipals');
			redirect('admin/institutionprincipals');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function streams()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Streams";
			$data['activeMenu'] = "streams";
			$data['streams'] = $this->admin_model->get_table_details('streams');
			$this->admin_template->show('admin/streams', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addstreams()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Streams";
			$data['activeMenu'] = "streams";
			$this->form_validation->set_rules('stream_name', 'Stream Name', 'required|trim');
			$this->form_validation->set_rules('stream_short_form', 'Stream Short Form', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutiontypes'] = $this->admin_model->get_table_details('institution_types');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addstreams',$data);
			} else {
				$data = array(
				
					'stream_name' => $this->input->post('stream_name'),
					'stream_short_form' => $this->input->post('stream_short_form'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('streams', $data);
				redirect('admin/streams');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editstreams($stream_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Streams";
			$data['activeMenu'] = "streams";
			$data['stream'] = $this->admin_model->get_details_by_id($stream_id,'stream_id','streams');

			

		    $this->form_validation->set_rules('institution_type_id', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('stream_name', 'Stream Name', 'required|trim');
			$this->form_validation->set_rules('stream_short_form', 'Stream Short Form', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutiontypes'] = $this->admin_model->get_table_details('institution_types');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editstreams', $data);
			} else {
				$data = array(
				
					'institution_type_id' => $this->input->post('institution_type_id'),
					'stream_name' => $this->input->post('stream_name'),
					'stream_short_form' => $this->input->post('stream_short_form'),
					'status' => $this->input->post('status')
				);
				$this->db->where('stream_id', $stream_id);
				$this->db->update('streams', $data);
				redirect('admin/streams');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deletestreams($stream_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "streams";
			$data['activeMenu'] = "streams";
			$this->db->where('stream_id', $stream_id);
			$this->db->delete('streams');
			redirect('admin/streams');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function institutioncourses()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutioncourses";
			$data['activeMenu'] = "institutioncourses";
			$data['institutioncourses'] = $this->admin_model->get_table_details('institutionalcourses');
			$this->admin_template->show('admin/institutioncourses', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addinstitutioncourses()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutioncourses";
			$data['activeMenu'] = "institutioncourses";
			$this->form_validation->set_rules('institution_id', 'Institution ID', 'required|trim');
			$this->form_validation->set_rules('stream_id', 'Stream ID', 'required|trim');
			$this->form_validation->set_rules('course_duration', 'Course Duration', 'required|in_list[2,3,4,5]');
			$this->form_validation->set_rules('course_category', 'Course Category', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('special_category', '	Special Category', 'required|in_list[0,1]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutions'] = $this->admin_model->get_table_details('institutions');
			$data['streams'] = $this->admin_model->get_table_details('streams');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutioncourses',$data);
			} else {
				$data = array(

					'institution_id' => $this->input->post('institution_id'),
					'stream_id' => $this->input->post('stream_id'),
					'course_duration' => $this->input->post('course_duration'),
					'course_category' => $this->input->post('course_category'),
					'special_category' => $this->input->post('special_category'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('institutionalcourses', $data);
				redirect('admin/institutioncourses');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editinstitutioncourses($institution_course_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutioncourses";
			$data['activeMenu'] = "institutioncourses";
			$data['institutioncourse'] = $this->admin_model->get_details_by_id($institution_course_id,'institution_course_id','institutionalcourses');

			

		    $this->form_validation->set_rules('institution_id', 'Institution ID', 'required|trim');
			$this->form_validation->set_rules('stream_id', 'Stream ID', 'required|trim');
			$this->form_validation->set_rules('course_duration', 'Course Duration', 'required|in_list[2,3,4,5]');
			$this->form_validation->set_rules('course_category', 'Course Category', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('special_category', '	Special Category', 'required|in_list[0,1]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['institutions'] = $this->admin_model->get_table_details('institutions');
			$data['streams'] = $this->admin_model->get_table_details('streams');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitutioncourses', $data);
			} else {
				$data = array(
				
					'institution_id' => $this->input->post('institution_id'),
					'stream_id' => $this->input->post('stream_id'),
					'course_duration' => $this->input->post('course_duration'),
					'course_category' => $this->input->post('course_category'),
					'special_category' => $this->input->post('special_category'),
					'status' => $this->input->post('status')
				);
				$this->db->where('institution_course_id', $institution_course_id);
				$this->db->update('institutionalcourses', $data);
				redirect('admin/institutioncourses');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteinstitutioncourses($institution_course_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "institutioncourses";
			$data['activeMenu'] = "institutioncourses";
			$this->db->where('institution_course_id', $institution_course_id);
			$this->db->delete('institutionalcourses');
			redirect('admin/institutioncourses');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function themesproblems()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Themeproblems";
			$data['activeMenu'] = "themesproblems";
			$data['themes_problems'] = $this->admin_model->get_table_details('themes_problems');
			$this->admin_template->show('admin/themesproblems', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function addthemesproblems()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Themeproblems";
			$data['activeMenu'] = "themeproblems";
			$this->form_validation->set_rules('theme_name', 'Theme Name', 'required|trim');
			$this->form_validation->set_rules('problem_statement', 'Problem Statement', 'required|trim');
			$this->form_validation->set_rules('problem_statement_description', 'Problem Statement Description', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addthemesproblems',$data);
			} else {
				$data = array(
					'theme_name' => $this->input->post('theme_name'),
					'problem_statement' => $this->input->post('problem_statement'),
					'problem_statement_description' => $this->input->post('problem_statement_description'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('themes_problems', $data);
				redirect('admin/themesproblems');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function editthemesproblems($theme_problem_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Themeproblems";
			$data['activeMenu'] = "themeproblemsates";
			$data['themesproblem'] = $this->admin_model->get_details_by_id($theme_problem_id,'theme_problem_id','themes_problems');

		
			$this->form_validation->set_rules('theme_name', 'Theme Name', 'required|trim');
			$this->form_validation->set_rules('problem_statement', 'Problem Statement', 'required|trim');
			$this->form_validation->set_rules('problem_statement_description', 'Problem Statement Description', 'required|trim');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editthemesproblems', $data);
			} else {
				$data = array(

					'theme_name' => $this->input->post('theme_name'),
					'problem_statement' => $this->input->post('problem_statement'),
					'problem_statement_description' => $this->input->post('problem_statement_description'),
					'status' => $this->input->post('status')
				);
				$this->db->where('theme_problem_id', $theme_problem_id);
				$this->db->update('themes_problems', $data);
				redirect('admin/themesproblems');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function deletethemesproblems($theme_problem_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "themeproblems";
			$data['activeMenu'] = "themeproblems";
			$this->db->where('theme_problem_id', $theme_problem_id);
			$this->db->delete('themes_problems');
			redirect('admin/themesproblems');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function programs()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Programs";
			$data['activeMenu'] = "programs";
			$data['programs'] = $this->admin_model->get_table_details('programs');
			$this->admin_template->show('admin/programs', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function addprograms()
	{

		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Programs";
			$data['activeMenu'] = "programs";
			$this->form_validation->set_rules('program_name', 'Program Name', 'required|trim');
			$this->form_validation->set_rules('program_short_name', 'Program Short Name', 'required|trim');
			$this->form_validation->set_rules('no_of_years', 'Number of Years', 'required|in_list[1,2,3,4,5,6]');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addprograms',$data);
			} else {
				$data = array(
				
					'program_name' => $this->input->post('program_name'),
					'program_short_name' => $this->input->post('program_short_name'),
					'no_of_years' => $this->input->post('no_of_years'),
					'program_type' => $this->input->post('program_type'),
					'status' => $this->input->post('status')
				);
				$this->db->insert('programs', $data);
				redirect('admin/programs');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function editprograms($program_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Programs";
			$data['activeMenu'] = "programs";
			$data['program'] = $this->admin_model->get_details_by_id($program_id,'program_id','programs');

			

		    $this->form_validation->set_rules('program_name', 'Program Name', 'required|trim');
			$this->form_validation->set_rules('program_short_name', 'Program Short Name', 'required|trim');
			$this->form_validation->set_rules('no_of_years', 'Number of years', 'required|in_list[1,2,3,4,5,6]');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editprograms', $data);
			} else {
				$data = array(
				
					'program_name' => $this->input->post('program_name'),
					'program_short_name' => $this->input->post('program_short_name'),
					'no_of_years' => $this->input->post('no_of_years'),
					'program_type' => $this->input->post('program_type'),
					'status' => $this->input->post('status')
				);
				$this->db->where('program_id', $program_id);
				$this->db->update('programs', $data);
				redirect('admin/programs');
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	public function deleteprograms($program_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "programs";
			$data['activeMenu'] = "programs";
			$this->db->where('program_id', $program_id);
			$this->db->delete('programs');
			redirect('admin/programs');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('admin', 'refresh');
	}



	function BlockList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Blocks";
			$data['activeMenu'] = "blocks";
			$district_id=$this->input->post('district_id');
			$list = $this->admin_model->getDetailsbyfield($district_id,'district_id','blocks')->result();
			if (count($list)) {
				$blocks = array();
				foreach ($list as $res1) {
					$blocks[] = '<option value="' . $res1->block_id . '">' . $res1->block_name .  '</option>';
				}
				print_r($blocks);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	function TalukList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "taluks";
			$block_id=$this->input->post('block_id');
			$list = $this->admin_model->getDetailsbyfield($block_id,'block_id','taluks')->result();
			if (count($list)) {
				$taluks = array();
				foreach ($list as $res1) {
					$taluks[] = '<option value="' . $res1->taluk_id . '">' . $res1->taluk_name .  '</option>';
				}
				print_r($taluks);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	function PlaceList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "places";
			$taluk_id=$this->input->post('taluk_id');
			$list = $this->admin_model->getDetailsbyfield($taluk_id,'taluk_id','places')->result();
			if (count($list)) {
				$places = array();
				foreach ($list as $res1) {
					$places[] = '<option value="' . $res1->place_id . '">' . $res1->place_name .  '</option>';
				}
				print_r($places);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
}