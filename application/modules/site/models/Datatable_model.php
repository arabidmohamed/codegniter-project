<?PHP
class Datatable_model extends CI_Model {

	
	/**
	*------- Questions List *---------
	**/

	private function _get_questions_query()
    { 
	    $where_title = '';
	    $title_r = trim($_POST['search']['value']);
        if(!empty($title_r)){
	        $where_title = "(q.Title_en LIKE '%{$title_r}%' OR q.Title_ar LIKE '%{$title_r}%')  AND";
        }
	    
        $where = "$where_title q.Status = 1";
		$this->db
				->distinct()
				->select('q.*')
				->from(TBL_QUESTIONS.' as q')
				->where($where)
				->order_by('Order_In_List');
				
/*
				$this->db->get();
				echo $this->db->last_query();
*/
    }
 
    function getQuestionsList()
    {
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
		
		$this->_get_questions_query();		
        return $this->db->get()->result();
    }
 
    function questionsCount_filtered()
    {
        $this->_get_questions_query();	
        return $this->db->get()->num_rows();
        //echo $this->db->last_query();
    }
 
    public function questionsCount_all()
    {
        $this->_get_questions_query();	
        return $this->db->get()->num_rows();
    }

}
?>    