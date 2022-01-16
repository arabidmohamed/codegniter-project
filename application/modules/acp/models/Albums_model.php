<?PHP
	class Albums_model extends CI_Model
	{
		
		/*
			------ Album CATEGRORIES --------
		*/
		public function addCategory($data = array())
		{
			$this->db->insert(TBL_ALBUMS_CATEGORIES, $data);
			return  $this->db->insert_id();
		}
			
		public function getcategories($data = array())
		{
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_ALBUMS_CATEGORIES);
			return $query->result();
		}
		
		public function getActivecategories($data = array())
		{
			$this->db->where(array('Status' => 1));
			$query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_ALBUMS_CATEGORIES);
			return $query->result();
		}
		
		public function getCategoryByID($data = array())
		{
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_ALBUMS_CATEGORIES);
			return $query->result();
		}
		
		public function updateCategory($data = array())
		{
			$where = array('Category_ID' => $data['Category_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_ALBUMS_CATEGORIES, $data);
			return $query;

		}
		
		public function deleteCategory($data = array())
		{
			$where = array('Category_ID' => $data['category_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_ALBUMS_CATEGORIES);
			return $query;

		}
		
		/*
			------ Albums --------
		*/

		public function add($data = array())
		{
			$query = $this->db->insert(TBL_ALBUMS, $data);
			return  $this->db->insert_id();
		}
		
		public function getAll()
		{
			$query = $this->db
							->select('al.*, alc.Category_en, alc.Category_ar, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr')
							->from(TBL_ALBUMS.' as al')
							->join(TBL_ALBUMS_CATEGORIES.' alc', 'alc.Category_ID = al.Category_ID')
							->join(TBL_SECTIONS.' as s', 's.Section_ID = al.Section_ID')
							->get();
							
			return $query->result();
		}
		
		public function getByID($data = '')
		{
			$where = array('Album_ID' => $data['album_id']);
			$this->db->where($where);
			$query = $this->db->get(TBL_ALBUMS);
			return $query->result();
		}
		
		public function update($data = '')
		{
			$where = array('Album_ID' => $data['Album_ID']);
			$this->db->where($where);
			$query = $this->db->update(TBL_ALBUMS, $data);
			return $query;

		}
		
		public function delete($data = array())
		{
			$where = array('Album_ID' => $data['album_id']);
			$this->db->where($where);
			$query = $this->db->delete(TBL_ALBUMS);
			return $query;

		}

        public function addAlbum($data = null)
        {
            $query = $this->db->insert(TBL_ALBUMS, $data);
            return $this->db->insert_id();
        }

        public function addAlbumDetails($data = array())
        {
            $query = $this->db->insert(TBL_ALBUMS, $data);
            return $this->db->insert_id();
        }


        public function getPDImageName($id){
            return $this->db->where('Album_ID', $id)->get(TBL_ALBUMS)->result()[0]->Original_Img;
        }

        public function deletePDImage($id){
            return $this->db->where('Album_ID', $id)->delete(TBL_ALBUMS);
        }
	}
	
?>