<?PHP
class Localization_model extends CI_Model{

    /*-----------------------------------------------------------
---------------------- News Section -----------------
--------------------------------------------------------*/

    //#Add News function
    public function addString($data = array()){
        $query = $this->db->insert('localization', $data);
        return  $this->db->insert_id();
    }


    // #get strings data
	
    public function getAllString(){
        
        $query = $this->db
            ->select("Key, String_en, String_ar")
            ->from('localization')
            ->order_by('Created_at', 'desc')
            ->get();

        return $query->result();
    }
    
    public function getString(){
        
        $query = $this->db
            ->select("*")
            ->from('localization')
            ->order_by('ID', 'desc')
            ->get();

        return $query->result();
    }

	public function getStringByKey($string){
        
        $query = $this->db
            ->select("Key, String_en, String_ar")
            ->from('localization')
            ->where('Key LIKE',$string) // to be key
            ->order_by('Created_at', 'desc')
            ->get();

        return $query->result();
    }


    //#Add string function
    public function insertStringByKey($data = array()){
        $query = $this->db->insert('localization', $data);
        return  $this->db->insert_id();
    }

    
    // #update localization function
    public function updateString($data = array())
    {	
	    $where = array('ID' => $data['ID']);
        $this->db->where($where);
        $query = $this->db->update('localization', $data);
        return $query;
    }

    // #delete localization function
    public function deleteString($data = array()){
        $where = array('ID' => $data['id']);
        $this->db->where($where);
        $query = $this->db->delete('localization');
        return $query;

    }

	function excelSelect()
	{
		$this->db->order_by('ID', 'desc');
		$query = $this->db->get('localization');
		return $query;
	}
	
	function excelInsert($data)
	{
		$this->db->insert_batch('localization', $data);
	}
    
    // used to get pagination 
    public function get_count() {
        return $this->db->count_all('localization');
    }

    
    function get_strings($limit, $start, $key = '', $string_en = '', $string_ar = '')
	{
		if(!empty($key))
		{
			$this->db->like('Key', $key);
		}
		
		if(!empty($string_en))
		{
			$this->db->like('String_en', $string_en);
		}
		
		if(!empty($string_ar))
		{
			$this->db->like('String_ar', $string_ar);
		}
		
    
		$query = $this->db
				->select('*')
				->order_by('ID', 'desc')
				->limit($limit, $start)
				->get('localization');
		return $query->result();		
	}

    // *****************************************
    // to get all strings
    // *****************************************

    var $order_ticket_columns_2 = array('ID', 'Created_at', 'Key', 'String_en', 'String_en');

    private function _get_localization_query() {
        $where_string_en = '';
        $where_string_ar = '';
        $where_key = '';

        if (!empty($_POST['string_en'])) {
            $string_en = $_POST['string_en'];
            $where_string_en = "String_en LIKE '%$string_en%' AND";
        }

        if (!empty($_POST['string_ar'])) {
            $string_ar = $_POST['string_ar'];
            $where_string_ar = "String_ar LIKE '%$string_ar%' AND";
        }

        if (!empty($_POST['key'])) {
            $key = $_POST['key'];
            $where_key = "Key LIKE '%$key%' AND";
        }

        $where = "$where_string_en $where_string_ar $where_key ID > 0";
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('localization');
        $this->db->where($where);
        $this->db->order_by("ID", "desc");

        if (isset($_POST['order'])) {
            $ind = $_POST['order'][0]['column'];
            $oColumn = $this->order_ticket_columns_2[$ind];
            $direction = $_POST['order'][0]['dir'];
            $where_order = "$oColumn $direction";
            $this->db->order_by($where_order);
        } else {
            $this->db->order_by("ID", "desc");
        }
    }

    function getDataList() {
        $this->_get_localization_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();

        return $query->result();
    }

    function localizationCount_filtered() {
        $this->_get_localization_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function localizationCount_all() {
        $this->db->from('localization');

        return $this->db->count_all_results();
    }


}

?>