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

			$this->login_template->show('admin/login', $data);
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
		$result = $this->admin_model->login($username, md5($password),'1');
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
			$data['activeMenu'] = "Dashboard";
			$data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			$data['places'] = $this->admin_model->get_table_details('places');
			$this->admin_template->show('admin/dashboard', $data);
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
			$data['activeMenu'] = "Viewinstitution";
			$data['institution'] = $this->admin_model->get_details_by_id($institution_id,'institution_id','institutions');
			$data['geos'] = $this->admin_model->get_geo_details($data['institution']['place_id'])->row_array();
			$data['institution_courses'] = $this->admin_model->get_institution_courses($data['institution']['institution_id'])->result();
			$this->admin_template->show('admin/viewinstitution', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function managecourses($institution_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions";
			$data['activeMenu'] = "Institutions";
			$data['institution_id'] = $institution_id;

			$this->form_validation->set_rules('institution_type_id', 'Institution Type', 'required|trim');
			$this->form_validation->set_rules('stream_id', 'Stream', 'required|trim');
			$this->form_validation->set_rules('program_id', 'Program', 'required|trim');
			
			$data['institution'] = $this->admin_model->get_details_by_id($institution_id,'institution_id','institutions');
			$data['geos'] = $this->admin_model->get_geo_details($data['institution']['place_id'])->row_array();

			$data['institution_types'] = $this->admin_model->getDetailsbySort('sort_order','DESC','institution_types')->result_array();
			$data['streams'] = $this->admin_model->getDetailsbySort('sort_order','DESC','streams')->result_array();
			$data['programs'] = $this->admin_model->getDetailsbySort('sort_order','DESC','programs')->result_array();

			$data['institution_courses'] = $this->admin_model->get_institution_courses($institution_id)->result();

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/managecourses',$data);
			} else {
				$data = array(
					'institution_id' => $institution_id,
					'institution_type_id' => $this->input->post('institution_type_id'),
					'stream_id' =>trim($this->input->post('stream_id')),
					'program_id' => $this->input->post('program_id'),
					'status' => 'ACTIVE',
				);
				$this->db->insert('institutional_courses', $data);
				redirect('admin/managecourses/'.$institution_id);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function deletecourses($institution_course_id, $institution_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Coruses";
			$data['activeMenu'] = "Coruses";
			$this->db->where('institution_course_id', $institution_course_id);
			$this->db->delete('institutional_courses');
			redirect('admin/managecourses/'.$institution_id);
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
			$data['activeMenu'] = "States";
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
			$data['activeMenu'] = "States";
			$this->form_validation->set_rules('state_name', 'State Name', 'required|trim|is_unique[states.state_name]');
			$this->form_validation->set_rules('state_name_vernacular', 'Vernacular State Name', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addstates',$data);
			} else {
				$data = array(
					'state_name' => $this->input->post('state_name'),
					'state_name_vernacular' => $this->input->post('state_name_vernacular'),
					'status' => "ACTIVE"
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
			$data['activeMenu'] = "States";
			$data['state'] = $this->admin_model->get_details_by_id($state_id,'state_id','states');

			if (empty($data['state'])) {
				show_404();
			}

			$this->form_validation->set_rules('state_name', 'State Name', 'required|trim');
			$this->form_validation->set_rules('state_name_vernacular', 'Vernacular State Name', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editstates', $data);
			} else {
				$data = array(
					'state_name' => $this->input->post('state_name'),
					'state_name_vernacular' => $this->input->post('state_name_vernacular')
					// 'status' => $this->input->post('status')
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
			$data['activeMenu'] = "States";
			$this->db->where('state_id', $state_id);
			$this->db->delete('states');
			redirect('admin/states');
		} else {
			redirect('admin', 'refresh');
		}
	}

	function districtsDropdown()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Districts";
			$data['activeMenu'] = "Districts";

			$districts = $this->admin_model->get_table_details('districts');

			$result = array();
			foreach($districts as $row) {
				$result[$row["district_id"]] = $row["district_name"];
			}
			return $result;

		} else {
			redirect('admin', 'refresh');
		}
	}

	function blocksDropdown($district_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Districts";
			$data['activeMenu'] = "Districts";

			$blocks = $this->admin_model->getDetailsbyfield($district_id,'district_id',"blocks")->result(); 
			
			$result = array();
			foreach($blocks as $row) {
				$result[$row->block_id] = $row->block_name;
			}
			return $result;

		} else {
			redirect('admin', 'refresh');
		}
	}

	function taluksDropdown($district_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "Taluks";

			$taluks = $this->admin_model->getDetailsbyfield($district_id,'district_id',"taluks")->result(); 
			
			$result = array();
			foreach($taluks as $row) {
				$result[$row->taluk_id] = $row->taluk_name;
			}
			return $result;

		} else {
			redirect('admin', 'refresh');
		}
	}

	function placesDropdown($block_id)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "Places";

			$places = $this->admin_model->getDetailsbyfield($block_id,'block_id',"places")->result(); 
			
			$result = array();
			foreach($places as $row) {
				$result[$row->place_id] = $row->place_name;
			}
			return $result;

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
			$data['activeMenu'] = "Districts";
			$data['districts'] = $this->admin_model->getDetailsbyfieldSort(0,0,'district_name','ASC','districts')->result_array();
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
			$data['activeMenu'] = "Districts";
			$this->form_validation->set_rules('lgd_code', 'LGD Code', 'required|trim');
			$this->form_validation->set_rules('district_name', 'District Name', 'required|trim|is_unique[districts.district_name]');
			$this->form_validation->set_rules('district_name_vernacular', 'Vernacular District Name', 'trim');
			$this->form_validation->set_rules('district_short_form', 'District Short Form', 'required|trim');
			// $this->form_validation->set_rules('district_headquarters', 'District Headquarters', 'required|trim');
			// $this->form_validation->set_rules('district_headquarters_vernacular', 'Vernacular District Headquarters', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

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
					'status' => "ACTIVE"
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
			$data['activeMenu'] = "Districts";
			$data['district'] = $this->admin_model->get_details_by_id($district_id,'district_id','districts');

		    $this->form_validation->set_rules('lgd_code', 'lgd Code', 'required|trim');
			$this->form_validation->set_rules('district_name', 'District Name', 'required|trim|strip_tags');
			$this->form_validation->set_rules('district_name_vernacular', 'Vernacular District Name', 'required|trim');
			$this->form_validation->set_rules('district_short_form', 'District Short Form', 'required|trim');
			// $this->form_validation->set_rules('district_headquarters', 'District Headquarters', 'required|trim');
			// $this->form_validation->set_rules('district_headquarters_vernacular', 'Vernacular District Headquarters', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editdistricts', $data);
			} else {
				$data = array(
				
					'lgd_code' => $this->input->post('lgd_code'),
					'district_name' => $this->input->post('district_name'),
					'district_name_vernacular' => $this->input->post('district_name_vernacular'),
					'district_short_form' => $this->input->post('district_short_form'),
					'district_headquarters' => $this->input->post('district_headquarters'),
					'district_headquarters_vernacular' => $this->input->post('district_headquarters_vernacular')
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
			$data['activeMenu'] = "Taluks";
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
			$data['activeMenu'] = "Taluks";
			$this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name', 'Taluk Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name_vernacular', 'Vernacular Taluk Name', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addtaluks',$data);
			} else {
				$data = array(
					'district_id' => $this->input->post('district_id'),
					'taluk_name' => $this->input->post('taluk_name'),
					'taluk_name_vernacular' => $this->input->post('taluk_name_vernacular'),
					'status' => 'ACTIVE'
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
			$data['activeMenu'] = "Taluks";
			$data['taluk'] = $this->admin_model->get_details_by_id($taluk_id,'taluk_id','taluks');

		    $this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name', 'Taluk Name', 'required|trim');
			$this->form_validation->set_rules('taluk_name_vernacular', 'Vernacular Taluk Name', 'trim');
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/edittaluks', $data);
			} else {
				$data = array(
					'district_id' => $this->input->post('district_id'),
					'taluk_name' => $this->input->post('taluk_name'),
					'taluk_name_vernacular' => $this->input->post('taluk_name_vernacular')
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
			$data['pageTitle'] = "Taluks";
			$data['activeMenu'] = "Taluks";
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
			$data['activeMenu'] = "Blocks";
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
			$data['activeMenu'] = "Blocks";
			$this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
			$this->form_validation->set_rules('block_name', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('block_name_vernacular', 'Vernacular Taluk Name', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addblocks',$data);
			} else {
				$data = array(
					'district_id' => $this->input->post('district_id'),
					'block_name' => $this->input->post('block_name'),
					'block_name_vernacular' => $this->input->post('block_name_vernacular'),
					'status' => 'ACTIVE'
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
			$data['activeMenu'] = "Blocks";
			$data['block'] = $this->admin_model->get_details_by_id($block_id,'block_id','blocks');

		    $this->form_validation->set_rules('district_id', 'District', 'required|trim');
			$this->form_validation->set_rules('block_name', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('block_name_vernacular', 'Vernacular Taluk Name', 'trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			$data['districts'] = $this->admin_model->get_table_details('districts');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editblocks', $data);
			} else {
				$data = array(
				
					'district_id' => $this->input->post('district_id'),
					'block_name' => $this->input->post('block_name'),
					'block_name_vernacular' => $this->input->post('block_name_vernacular')
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
			$data['pageTitle'] = "Blocks";
			$data['activeMenu'] = "Blocks";
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
			$data['activeMenu'] = "Places";
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
			$data['activeMenu'] = "Places";
			$this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
			$this->form_validation->set_rules('block_id', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('taluk_id', 'Taluk Name', 'trim');
			$this->form_validation->set_rules('place_type', 'Place Type', 'required|in_list[METRO,URBAN,SEMI-URBAN,RURAL]');
			$this->form_validation->set_rules('place_name', 'Place Name', 'required|trim');
			$this->form_validation->set_rules('place_name_vernacular', 'Vernacular Place Name', 'trim');
			$this->form_validation->set_rules('pincode', 'Pincode', 'trim');
			
			$data['districts'] = $this->admin_model->get_table_details('districts');
			
			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addplaces',$data);
			} else {
				$data = array(
					'block_id' => $this->input->post('block_id'),
					'taluk_id' => $this->input->post('taluk_id'),
					'place_type' => $this->input->post('place_type'),
					'place_name' => $this->input->post('place_name'),
					'place_name_vernacular' => $this->input->post('place_name_vernacular'),
					'pincode' => $this->input->post('pincode'),
					'status' => "ACTIVE"
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
			$data['activeMenu'] = "Places";
			$data['place'] = $this->admin_model->get_details_by_id($place_id,'place_id','places');
			$data['districts'] = $this->admin_model->get_table_details('districts');
			$data['blocks'] = $this->admin_model->get_table_details('blocks');
			

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
			$data['activeMenu'] = "Institutiontypes";
			$data['institutiontypes'] = $this->admin_model->getDetailsbySort('sort_order','DESC','institution_types')->result_array();
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
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutiontypes', $data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'institution_type' => $this->input->post('institution_type'),
					'institution_short_name' => $this->input->post('institution_short_name'),
					'status' => 'ACTIVE',
					'sort_order' => $sort_order,
					'created_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$data['username']
					
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
			$this->form_validation->set_rules('institution_short_name', 'Short Name', 'required|trim');
			// $this->form_validation->set_rules('sort_order', 'Sort Order', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitutiontypes',$data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'institution_type' => $this->input->post('institution_type'),
					'institution_short_name' => $this->input->post('institution_short_name'),
					'sort_order' => $sort_order,
					'updated_at'=>date('Y-m-d H:i:s'),
					'updated_by'=>$data['username']
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
			$data['activeMenu'] = "Institutions";
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
			$data['activeMenu'] = "Institutions";

			$this->form_validation->set_rules('institution_name', 'Institution Name', 'required|trim');
			$this->form_validation->set_rules('principal_name', 'Principal Name', 'trim');
			$this->form_validation->set_rules('principal_mobile', 'Principal Mobile', 'numeric|exact_length[10]');
			$this->form_validation->set_rules('principal_whatsapp_mobile', 'Principal Watsapp Mobile', 'numeric|exact_length[10]');
			$this->form_validation->set_rules('principal_email', 'Principal Email', 'valid_email');
			// $this->form_validation->set_rules('institution_name_vernacular', 'Vernacular Place Name', 'required|trim');
			$this->form_validation->set_rules('district_id', 'District Name', 'required|trim');
			// $this->form_validation->set_rules('block_id', 'Block Name', 'required|trim');
			$this->form_validation->set_rules('place_id', 'Place ID', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			// $data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			// $data['districts'] = $this->admin_model->get_table_details('districts');
			// $data['blocks'] = $this->admin_model->get_table_details('blocks');
			// $data['taluks'] = $this->admin_model->get_table_details('taluks');
			// $data['places'] = $this->admin_model->get_table_details('places');

			$data['districts'] = array(""=>"Select District")+$this->districtsDropdown();

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addinstitutions',$data);
			} else {
				
				$count = $this->admin_model->getMaxId()->row()->institution_id;
				$cnt_number = $count +1;
				$strlen = strlen(($cnt_number));
				if($strlen == 1){  $cnt_number = "000".$cnt_number; }
				if($strlen == 2){  $cnt_number = "00".$cnt_number; }
				if($strlen == 3){  $cnt_number = "0".$cnt_number; }
				
				$institution_code = "EDII".$cnt_number;
				
				$data = array(
					'institution_code' => $institution_code,
					'institution_name' => $this->input->post('institution_name'),
					'institution_name_vernacular' => $this->input->post('institution_name_vernacular'),
					'principal_name' => $this->input->post('principal_name'),
					'principal_mobile' => $this->input->post('principal_mobile'),
					'principal_whatsapp_mobile' => $this->input->post('principal_whatsapp_mobile'),
					'principal_email' => $this->input->post('principal_email'),
					'place_id' => $this->input->post('place_id'),
					'status' => 'ACTIVE',
					'created_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$data['username']
				);
				$this->db->insert('institutions', $data);
				$iid = $this->db->insert_id();
				redirect('admin/viewinstitution/'.$iid);
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
			$data['activeMenu'] = "Institutions";
			$data['institution'] = $this->admin_model->get_details_by_id($institution_id,'institution_id','institutions');
			$data['place_id'] = $data['institution']['place_id'];

			if($data['place_id']){
				$places = $this->admin_model->getDetailsbyfield($data['place_id'],'place_id',"places")->row(); 
				$data['block_id'] = $places->block_id;
				$data['taluk_id'] = $places->taluk_id;

				$blocks = $this->admin_model->getDetailsbyfield($data['block_id'],'block_id',"blocks")->row(); 
				$data['district_id'] = $blocks->district_id;

				$data['blocksArray'] = array(""=>"Select Block")+$this->blocksDropdown($data['district_id']);
				$data['taluksArray'] = array(""=>"Select Taluk")+$this->taluksDropdown($data['district_id']);
				$data['placesArray'] = array(""=>"Select Place")+$this->placesDropdown($data['block_id']);
				
			}else{
				$data['district_id'] = '';
				$data['block_id'] = '';
				$data['taluk_id'] = '';
				$data['blocksArray'] = array(""=>"Select Block");
				$data['taluksArray'] = array(""=>"Select Taluk");
				$data['placesArray'] = array(""=>"Select Place");
			}                                        

			$data['districts'] = array(""=>"Select District")+$this->districtsDropdown();
			
			// $this->form_validation->set_rules('institution_code', 'Institution Code', 'required|is_unique[institutions.institution_code]');
			$this->form_validation->set_rules('institution_name', 'Institution Name', 'required|trim');
			$this->form_validation->set_rules('principal_name', 'Principal Name', 'trim');
			$this->form_validation->set_rules('principal_mobile', 'Principal Mobile', 'numeric|exact_length[10]');
			$this->form_validation->set_rules('principal_whatsapp_mobile', 'Principal Watsapp Mobile', 'numeric|exact_length[10]');
			$this->form_validation->set_rules('principal_email', 'Principal Email', 'valid_email');
			$this->form_validation->set_rules('district_id', 'District', 'required|trim');
			// $this->form_validation->set_rules('block_id', 'Block Name', 'required|trim');
			// $this->form_validation->set_rules('taluk_id', 'Taluk Name', 'trim');
			$this->form_validation->set_rules('place_id', 'Place ID', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			
			// $data['institution_types'] = $this->admin_model->get_table_details('institution_types');
			// $data['districts'] = $this->admin_model->get_table_details('districts');
			// $data['blocks'] = $this->admin_model->get_table_details('blocks');
			// $data['taluks'] = $this->admin_model->get_table_details('taluks');
			// $data['places'] = $this->admin_model->get_table_details('places');
			
			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editinstitution', $data);
			} else {
				$data = array(
					// 'institution_code' => $this->input->post('institution_code'),
					'institution_name' => $this->input->post('institution_name'),
					'institution_name_vernacular' => $this->input->post('institution_name_vernacular'),
					'principal_name' => $this->input->post('principal_name'),
					'principal_mobile' => $this->input->post('principal_mobile'),
					'principal_whatsapp_mobile' => $this->input->post('principal_whatsapp_mobile'),
					'principal_email' => $this->input->post('principal_email'),
					'place_id' => $this->input->post('place_id'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'updated_by'=>$data['username']
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
			$data['pageTitle'] = "Institutions";
			$data['activeMenu'] = "Institutions";

			$this->db->where('institution_id', $institution_id);
			$this->db->delete('institutional_courses');


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
			$data['activeMenu'] = "Streams";
			$data['streams'] = $this->admin_model->getDetailsbySort('sort_order','DESC','streams')->result_array();
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
			$data['activeMenu'] = "Streams";
			$this->form_validation->set_rules('stream_name', 'Stream Name', 'required|trim');
			// $this->form_validation->set_rules('sort_order', 'Sort Order', 'required|trim');
			$this->form_validation->set_rules('stream_short_form', 'Stream Short Form', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addstreams',$data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'stream_name' => $this->input->post('stream_name'),
					'stream_short_form' => $this->input->post('stream_short_form'),
					'status' => 'ACTIVE',
					'sort_order' => $sort_order,
					'created_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$data['username']
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
			$data['activeMenu'] = "Streams";
			$data['stream'] = $this->admin_model->get_details_by_id($stream_id,'stream_id','streams');

			$this->form_validation->set_rules('stream_name', 'Stream Name', 'required|trim');
			// $this->form_validation->set_rules('sort_order', 'Sort Order', 'required|trim');
			$this->form_validation->set_rules('stream_short_form', 'Stream Short Form', 'required|trim');
			// $this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');
			
			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editstreams', $data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'stream_name' => $this->input->post('stream_name'),
					'stream_short_form' => $this->input->post('stream_short_form'),					
					'sort_order' => $sort_order,
					'updated_at'=>date('Y-m-d H:i:s'),
					'updated_by'=>$data['username']
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
			$data['activeMenu'] = "Themeproblems";
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
			$data['activeMenu'] = "Programs";
			$data['programs'] = $this->admin_model->getDetailsbySort('sort_order','DESC','programs')->result_array();
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
			$data['activeMenu'] = "Programs";
			$this->form_validation->set_rules('program_name', 'Program Name', 'required|trim');
			$this->form_validation->set_rules('program_short_name', 'Program Short Name', 'required|trim');
			$this->form_validation->set_rules('no_of_years', 'Number of Years', 'required|in_list[1,2,3,4,5,6]');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/addprograms',$data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'program_name' => $this->input->post('program_name'),
					'program_short_name' => $this->input->post('program_short_name'),
					'no_of_years' => $this->input->post('no_of_years'),
					'program_type' => $this->input->post('program_type'),
					'status' => $this->input->post('status'),
					'sort_order' => $sort_order,
					'created_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$data['username']
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
			$data['activeMenu'] = "Programs";
			$data['program'] = $this->admin_model->get_details_by_id($program_id,'program_id','programs');

		    $this->form_validation->set_rules('program_name', 'Program Name', 'required|trim');
			$this->form_validation->set_rules('program_short_name', 'Program Short Name', 'required|trim');
			$this->form_validation->set_rules('no_of_years', 'Number of years', 'required|in_list[1,2,3,4,5,6]');
			$this->form_validation->set_rules('program_type', 'Program Type', 'required|in_list[UG,PG,DIPLOMA]');
			$this->form_validation->set_rules('status', 'Status', 'required|in_list[ACTIVE,INACTIVE,DELETED]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/editprograms', $data);
			} else {
				$sort_order = ($this->input->post('sort_order')) ? $this->input->post('sort_order') : NULL;
				$data = array(
					'program_name' => $this->input->post('program_name'),
					'program_short_name' => $this->input->post('program_short_name'),
					'no_of_years' => $this->input->post('no_of_years'),
					'program_type' => $this->input->post('program_type'),
					'status' => $this->input->post('status'),
					'sort_order' => $sort_order,
					'updated_at'=>date('Y-m-d H:i:s'),
					'updated_by'=>$data['username']
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
			$flag=$this->input->post('flag');
			$list = $this->admin_model->getDetailsbyfield($district_id,'district_id','blocks')->result();
			if (count($list)) {
				$blocks = array();
				if($flag=="A"){
					$blocks[] = '<option value="all">All Blocks</option>';
				}else{
					$blocks[] = '<option value=" ">Select Block</option>';
				}
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
			$district_id=$this->input->post('district_id');
			$flag=$this->input->post('flag');
			$list = $this->admin_model->getDetailsbyfield($district_id,'district_id','taluks')->result();
			$taluks = array();
			if($flag=="A"){
				$taluks[] = '<option value="all">All Taluks</option>';
			}else{
				$taluks[] = '<option value=" ">Select Taluk</option>';
			}
			if (count($list)) {	
				foreach ($list as $res1) {
					$taluks[] = '<option value="' . $res1->taluk_id . '">' . $res1->taluk_name .  '</option>';
				}
			}
			print_r($taluks);
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
			$data['activeMenu'] = "Places";
			$block_id=$this->input->post('block_id');
			$flag=$this->input->post('flag');
			$list = $this->admin_model->getDetailsbyfield($block_id,'block_id','places')->result();
			if (count($list)) {
				$places = array();
				if($flag=="A"){
					$places[] = '<option value="all">All Places</option>';
				}else{
					$places[] = '<option value=" ">Select Place</option>';
				}
				foreach ($list as $res1) {
					$places[] = '<option value="' . $res1->place_id . '">' . $res1->place_name .  '</option>';
				}
				print_r($places);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	function DistrictPlacesList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "Places";
			$district_id=$this->input->post('district_id');
			$flag=$this->input->post('flag');
			$list = $this->admin_model->getDistrictPlacesList($district_id)->result();
			if (count($list)) {
				$places = array();
				if($flag=="A"){
					$places[] = '<option value="all">All Places</option>';
				}else{
					$places[] = '<option value=" ">Select Place</option>';
				}
				foreach ($list as $res1) {
					$places[] = '<option value="' . $res1->place_id . '">' . $res1->place_name .  '</option>';
				}
				print_r($places);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	function getBlockTaluk()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Places";
			$data['activeMenu'] = "Places";
			$place_id = $this->input->post('place_id');
			$geo = $this->admin_model->get_geo_details($place_id)->row();

			$block_name = ($geo->block_name) ? $geo->block_name : '--';
			$taluk_name = ($geo->taluk_name) ? $geo->taluk_name : '--';

			echo $res  = '<div class="row"><div class="form-group col-md"><label for="status">Block Name</label><h6>'.$block_name.'</h6></div><div class="form-group col-md"><label for="status">Taluk Name</label><h6>'.$taluk_name.'</h6></div></div>';
			
		} else {
			redirect('admin', 'refresh');
		}
	}

	function reports()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Reports";
			$data['activeMenu'] = "Reports";
			$this->admin_template->show('admin/reports', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}


	function institutionsDetails()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions List";
			$data['activeMenu'] = "Reports";
			
			$institutions = $this->admin_model->get_table_details('institutions');
			$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
			$this->table->set_template($table_setup);
    		$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'Institution Code','style'=>'width:15%;'),
    								array('data' =>'Institution Name','style'=>'width:60%;'),
									// array('data' =>'Institution Vernacular Name','style'=>'width:60%;'),
									array('data' =>'Institution Types','style'=>'width:60%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;'),
									array('data' =>'Principal Name','style'=>'width:20%;'),
									array('data' =>'Principal Mobile','style'=>'width:20%;'),
									array('data' =>'Principal Whatsapp','style'=>'width:20%;'),
									array('data' =>'Principal Email','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($institutions as $institutions1){
				
					$geos = $this->admin_model->get_geo_details($institutions1['place_id'])->row_array();
					$institutionTypes = $this->admin_model->get_institutionTypes($institutions1['institution_id'])->result();
					$finalIT = '';
					foreach($institutionTypes as $institutionTypes1){
						$finalIT = $finalIT.', '.$institutionTypes1->institution_type;
						// print_r($institutionTypes1->institution_type);
					}
					$finalIT = rtrim($finalIT, ", ");
					$finalIT = ltrim($finalIT, ", ");
					
    				$this->table->add_row($i++,
							$institutions1['institution_code'],
    						$institutions1['institution_name'],
							// $institutions1['institution_name_vernacular'],
							$finalIT,
							($geos['district_name']) ? $geos['district_name'] : "<span style='color:#FF0000;'>Missing</span>",
							($geos['block_name']) ? $geos['block_name'] : "<span style='color:#FF0000;'>Missing</span>",
							($geos['taluk_name']) ? $geos['taluk_name'] : "<span style='color:#FF0000;'>Missing</span>",
							($geos['place_name']) ? $geos['place_name'] : "<span style='color:#FF0000;'>Missing</span>",
							($institutions1['principal_name']) ? $institutions1['principal_name'] : "<span style='color:#FF0000;'>Missing</span>",
							($institutions1['principal_mobile']) ? $institutions1['principal_mobile'] : "<span style='color:#FF0000;'>Missing</span>",
							($institutions1['principal_whatsapp_mobile']) ? $institutions1['principal_whatsapp_mobile'] : "<span style='color:#FF0000;'>Missing</span>",
							($institutions1['principal_email']) ? $institutions1['principal_email'] : "<span style='color:#FF0000;'>Missing</span>"
    				);
					
    			}
				$detailsTable = $this->table->generate();
				$current_date = date("dmYhis");
				header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$data['pageTitle'].' '.$current_date.".xls");
                header("Pragma: no-cache");
                header("Expires: 0"); 
                echo $detailsTable;   
			// $this->admin_template->show('admin/institutions_list', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	function geographical_regions()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Tamil Nadu Geographical Regions";
			$data['activeMenu'] = "Reports";
			
			$data['districts'] = $this->admin_model->get_table_details('districts');

			$this->admin_template->show('admin/geographical_regions', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	function getGeographicalData()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions List";
			$data['activeMenu'] = "Reports";
			
			$district_id = $this->input->post('district_id');
			$block_id = $this->input->post('block_id');
			$taluk_id = $this->input->post('taluk_id');
			$place_id = $this->input->post('place_id');
			$download = $this->input->post('download');
			
			$details = $this->admin_model->getGeographicalData($district_id, $block_id, $taluk_id, $place_id)->result();
			
			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
				$this->table->set_template($table_setup);
    			$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($details as $details1){
    				$this->table->add_row($i++,
							$details1->district_name,
							$details1->block_name,
							$details1->taluk_name,
							$details1->place_name
    				);
					
    			}
				$detailsTable = $this->table->generate();
				$response =  array('op' => 'ok',
                        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($detailsTable)
                        );
                die(json_encode($response));    
			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
                $this->table->set_template($table_setup);
    			$this->table->set_heading(
									array('data' =>'S.No', 'style'=>'width:5%;'),
									array('data' =>'District','style'=>'width:15%;'),
									array('data' =>'Block','style'=>'width:20%;'),
									array('data' =>'Taluk','style'=>'width:20%;'),
									array('data' =>'Place','style'=>'width:20%;')
									);
				$i=1;
				foreach ($details as $details1){
					$this->table->add_row($i++,
							$details1->district_name,
							$details1->block_name,
							$details1->taluk_name,
							$details1->place_name
					);
					
				}
				echo $data['table']=$this->table->generate();
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	function overallGeoDownload($download = 1)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "TN - Geographical Data";
			$data['activeMenu'] = "Reports";
			
			$details = $this->admin_model->getOverallGeographicalData()->result();

			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
				$this->table->set_template($table_setup);
    			$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($details as $details1){
    				$this->table->add_row($i++,
							$details1->district_name,
							$details1->block_name,
							$details1->place_name
    				);
					
    			}
				$detailsTable = $this->table->generate();

				$current_date = date("dmYhis");
				header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$data['pageTitle'].' '.$current_date.".xls");
                header("Pragma: no-cache");
                header("Expires: 0"); 
                echo $detailsTable;   

			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
                $this->table->set_template($table_setup);
    			$this->table->set_heading(
									array('data' =>'S.No', 'style'=>'width:5%;'),
									array('data' =>'District','style'=>'width:15%;'),
									array('data' =>'Block','style'=>'width:20%;'),
									// array('data' =>'Taluk','style'=>'width:20%;'),
									array('data' =>'Place','style'=>'width:20%;')
									);
				$i=1;
				foreach ($details as $details1){
					$this->table->add_row($i++,
							$details1->district_name,
							$details1->block_name,
							$details1->place_name
					);
					
				}
				echo $data['table']=$this->table->generate();
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	function institutionsList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions List";
			$data['activeMenu'] = "Reports";
			
			$data['districts'] = $this->admin_model->get_table_details('districts');

			$this->admin_template->show('admin/institutions_list', $data);
		} else {
			redirect('admin', 'refresh');
		}
	}

	function getInstitutionsList()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Institutions List";
			$data['activeMenu'] = "Reports";
			
			$district_id = $this->input->post('district_id');
			$block_id = $this->input->post('block_id');
			$taluk_id = $this->input->post('taluk_id');
			$place_id = $this->input->post('place_id');
			$download = $this->input->post('download');
			
			$institutions = $this->admin_model->getInstitutionsList($district_id, $block_id, $taluk_id, $place_id)->result();
			
			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
				$this->table->set_template($table_setup);
    			$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'Institution Code','style'=>'width:15%;'),
    								array('data' =>'Institution Name','style'=>'width:60%;'),
									array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;'),
									array('data' =>'Principal Name','style'=>'width:20%;'),
									array('data' =>'Principal Mobile','style'=>'width:20%;'),
									array('data' =>'Principal Whatsapp','style'=>'width:20%;'),
									array('data' =>'Principal Email','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($institutions as $institutions1){
    				$this->table->add_row($i++,
							$institutions1->institution_code,
    						$institutions1->institution_name,
							$institutions1->district_name,
							$institutions1->block_name,
							$institutions1->taluk_name,
							$institutions1->place_name,
							$institutions1->principal_name,
							$institutions1->principal_mobile,
							$institutions1->principal_whatsapp_mobile,
							$institutions1->principal_email
    				);
					
    			}
				$detailsTable = $this->table->generate();
				$response =  array('op' => 'ok',
                        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($detailsTable)
                        );
                die(json_encode($response));    
			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
                $this->table->set_template($table_setup);
    			$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'Institution Code','style'=>'width:15%;'),
    								array('data' =>'Institution Name','style'=>'width:25%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($institutions as $institutions1){
    				$this->table->add_row($i++,
							$institutions1->institution_code,
    						$institutions1->institution_name,
							$institutions1->district_name,
							$institutions1->block_name,
							$institutions1->taluk_name,
							$institutions1->place_name
    				);
    			}
				echo $data['table']=$this->table->generate();
			}
		} else {
			redirect('admin', 'refresh');
		}
	}

	function report1($download = 0)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Courses Not Mapped - Institutions List";
			$data['activeMenu'] = "Reports";
			$data['download_btn'] = "admin/report1/1";
			
			$details = $this->admin_model->report1()->result();

			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
			}
			
			if($details){
				$this->table->set_template($table_setup);
    		$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'Institution Code','style'=>'width:15%;'),
    								array('data' =>'Institution Name','style'=>'width:60%;'),
									array('data' =>'Institution Vernacular Name','style'=>'width:60%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;'),
									array('data' =>'Principal Name','style'=>'width:20%;'),
									array('data' =>'Principal Mobile','style'=>'width:20%;'),
									array('data' =>'Principal Whatsapp','style'=>'width:20%;'),
									array('data' =>'Principal Email','style'=>'width:20%;')
    				                );
    			$i=1;
    			foreach ($details as $institutions1){
    				$this->table->add_row($i++,
							$institutions1->institution_code,
    						$institutions1->institution_name,
							$institutions1->institution_name_vernacular,
							$institutions1->district_name,
							$institutions1->block_name,
							$institutions1->taluk_name,
							$institutions1->place_name,
							$institutions1->principal_name,
							$institutions1->principal_mobile,
							$institutions1->principal_whatsapp_mobile,
							$institutions1->principal_email
    				);
					
    			}
				$detailsTable = $this->table->generate();
			}else{
				$detailsTable = "NO DETAILS FOUND..!";
			}
			

			if($download){
				$current_date = date("dmYhis");
				header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$data['pageTitle'].' '.$current_date.".xls");
                header("Pragma: no-cache");
                header("Expires: 0"); 
                echo $detailsTable;   
			}else{
				$data['detailsTable'] = $detailsTable;
				$this->admin_template->show('admin/report_details', $data);
			}			
			
		} else {
			redirect('admin', 'refresh');
		}
	}

	function report2($download = 0)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Address Missing - Institutions List";
			$data['activeMenu'] = "Reports";
			$data['download_btn'] = "admin/report2/1";
			
			$details = $this->admin_model->report2()->result();

			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
			}
			if($details){
				$this->table->set_template($table_setup);
				$this->table->set_heading(
										array('data' =>'S.No', 'style'=>'width:5%;'),
										array('data' =>'Institution Code','style'=>'width:15%;'),
										array('data' =>'Institution Name','style'=>'width:60%;'),
										array('data' =>'Institution Vernacular Name','style'=>'width:60%;')
										);
					$i=1;
					foreach ($details as $institutions1){
						$this->table->add_row($i++,
								$institutions1->institution_code,
								$institutions1->institution_name,
								$institutions1->institution_name_vernacular
						);
						
					}
					$detailsTable = $this->table->generate();
			}else{
				$detailsTable = "NO DETAILS FOUND..!";
			}
			

			if($download){
				$current_date = date("dmYhis");
				
				header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$data['pageTitle'].' '.$current_date.".xls");
                header("Pragma: no-cache");
                header("Expires: 0"); 
                echo $detailsTable;   
			}else{
				$data['detailsTable'] = $detailsTable;
				$this->admin_template->show('admin/report_details', $data);
			}			
			
		} else {
			redirect('admin', 'refresh');
		}
	}

	function report3($download = 0)
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Principal Details Not Updated - Institutions List";
			$data['activeMenu'] = "Reports";
			$data['download_btn'] = "admin/report3/1";
			
			$details = $this->admin_model->report3()->result();

			if($download){
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm"  border="1" id="js-dataTable-full">');    
			}else{
				$table_setup = array ('table_open'=> '<table class="table table-striped table-vcenter table-hover js-dataTable-full font-size-sm" id="js-dataTable-full">');
			}
			if($details){
				$this->table->set_template($table_setup);
				$this->table->set_heading(
    								array('data' =>'S.No', 'style'=>'width:5%;'),
    								array('data' =>'Institution Code','style'=>'width:15%;'),
    								array('data' =>'Institution Name','style'=>'width:25%;'),
    								array('data' =>'District','style'=>'width:15%;'),
    								array('data' =>'Block','style'=>'width:20%;'),
    								array('data' =>'Taluk','style'=>'width:20%;'),
    								array('data' =>'Place','style'=>'width:20%;')
    				                );
					$i=1;
					foreach ($details as $institutions1){
						$this->table->add_row($i++,
									$institutions1->institution_code,
									$institutions1->institution_name,
									$institutions1->district_name,
									$institutions1->block_name,
									$institutions1->taluk_name,
									$institutions1->place_name
						);
						
					}
					$detailsTable = $this->table->generate();
			}else{
				$detailsTable = "NO DETAILS FOUND..!";
			}
			

			if($download){
				$current_date = date("dmYhis");
				
				header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=".$data['pageTitle'].' '.$current_date.".xls");
                header("Pragma: no-cache");
                header("Expires: 0"); 
                echo $detailsTable;   
			}else{
				$data['detailsTable'] = $detailsTable;
				$this->admin_template->show('admin/report_details', $data);
			}			
			
		} else {
			redirect('admin', 'refresh');
		}
	}

	public function changePassword()
	{
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['id'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['pageTitle'] = "Change Password";
			$data['activeMenu'] = "changePassword";

		    $this->form_validation->set_rules('current_password', 'Current Password', 'required|min_length[6]');
		    $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]|callback_valid_password');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

			if ($this->form_validation->run() === FALSE) {
				$this->admin_template->show('admin/change_password', $data);
			} else {
				
				$current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password');
// echo strcmp($current_password, $new_password); die;

				if(strcmp($current_password, $new_password)){
					$params = array(
						'password' => md5($new_password),
						'last_updated' => date('Y-m-d H:i:s')
					);
					$resp = $this->admin_model->updateDetails($data['id'], $params,'logins');
					if($resp){
						$data['msg'] = "1";	// SUCCESS
					}else{
						$data['msg'] = "3";	// UPDATE ERROR	
					}
				}else{
					$data['msg'] = "2";	// SAME ERROR
				}

				$this->admin_template->show('admin/password_results', $data);
			}
		} else {
			redirect('admin', 'refresh');
		}
	}
	/**
	 * Validate the password
	 *
	 * @param string $password
	 *
	 * @return bool
	 */
	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}
}