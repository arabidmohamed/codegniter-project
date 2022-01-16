<?PHP
	class Solution_model extends CI_Model
	{

		public function addSolution($data = array()){
			$query = $this->db->insert('solutions', $data);
			return  $query;
		}

		// #get services function
		public function getSolution(){
			$query = $this->db
							 ->select("ser.*")
							 ->from("solutions as ser")
							 ->order_by('Order_In_List', 'desc')
							 ->get();
			return $query->result();
		}

		// #get service By ID function
		public function getSolutionByID($data = null){
			$where = array('ID' => $data['solution_id']);
			$this->db->where($where);
			$query = $this->db->get('solutions');
			return $query->result();
		}

		// #update service function
		public function updateSolution($data = null){
			$where = array('ID' => $data['ID']);
			$this->db->where($where);
			$query = $this->db->update('solutions', $data);
			return $query;

		}

		// #delete service function
		public function deleteSolution($data = null){
			$where = array('ID' => $data['solution_id']);
			$this->db->where($where);
			$query = $this->db->delete('solutions');
			return $query;

		}

      public function getSolutionImages($data = array()){
          $where = array(
              'ID' => $data['ID']
          );
          return $this->db->select('Icon')->from('solutions')->where($where)->get()->result();
      }

			// ************************************
			// Note: solutions features
			// ************************************
			public function getAllPlansFeature()
			{
				$data = $this->db->select('*')
								 ->from('solutions_features')
								 ->order_by('Feature_ID', 'desc')
								 ->get();

					return $data->result();
			}
			public function insertPlanFeatureData($data = array()){
				return $this->db->insert('solutions_features', $data);
			}

			// to get plans by ID
			public function getPlansFeatureByID($feature_id = 0){
				return $this->db
						->where('Feature_ID', $feature_id)
						->get('solutions_features')
						->result();
			}

			public function updatePlansFeature($data = array()){
				return $this->db
						->where('Feature_ID', $data['Feature_ID'])
						->update('solutions_features', $data);
			}

			public function deletePlansFeature($feature_id = 0){
				return $this->db
						->where('Feature_ID', $feature_id)
						->delete('solutions_features');
			}

	}
?>
