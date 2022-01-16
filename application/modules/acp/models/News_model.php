<?PHP
    class News_model extends CI_Model{
        
            /*-----------------------------------------------------------
        ---------------------- News CATEGORIES Section -----------------
        --------------------------------------------------------*/
    
        // #Add category function
            public function addCategory($data = array()){
                $this->db->insert(TBL_NEWS_CATEGORIES, $data);
                return  $this->db->insert_id();
            }
            
            // #get Category function
            public function getCategories($data = array()){
                $query = $this->db->order_by('Order_In_List', 'asc')->get(TBL_NEWS_CATEGORIES);
                return $query->result();
            }
            
            // #get Category By ID function
            public function getCategoryByID($data = array()){
                $where = array('Category_ID' => $data['category_id']);
                $this->db->where($where);
                $query = $this->db->get(TBL_NEWS_CATEGORIES);
                return $query->result();
            }
            
            // #update Category function 
            public function updateCategory($data = array()){
                $where = array('Category_ID' => $data['Category_ID']);
                $this->db->where($where);
                $query = $this->db->update(TBL_NEWS_CATEGORIES, $data);
                return $query;
    
            }
            
            // #delete Category function 
            public function deleteCategory($data = array()){
                $where = array('Category_ID' => $data['category_id']);
                $this->db->where($where);
                $query = $this->db->delete(TBL_NEWS_CATEGORIES);
                return $query;
    
            }
            
            /*-----------------------------------------------------------
        ---------------------- News Section -----------------
        --------------------------------------------------------*/
        
                //#Add News function
            public function addNews($data = array()){
                $query = $this->db->insert(TBL_NEWS, $data);
                return  $this->db->insert_id();
            }
            
            // #get News function
            public function getNews(){
                $query = $this->db->query("SELECT w.*, wc.Category_en,wc.Category_ar, s.SectionName_en, s.SectionName_ar, s.Section_BG_Clr, s.Section_Text_Clr FROM ".TBL_NEWS." as w JOIN ".TBL_NEWS_CATEGORIES." as wc on wc.Category_ID = w.Category_ID JOIN ".TBL_SECTIONS." as s ON s.Section_ID = w.Section_ID ORDER BY w.Order_In_List");
                return $query->result();
            }
            
            // #get project by id 
            public function getNewsByID($data = 0){
                $id = $data['news_id'];
                $query = $this->db->query("SELECT w.*, wc.Category_en,wc.Category_ar FROM ".TBL_NEWS." as w JOIN ".TBL_NEWS_CATEGORIES." as wc on wc.Category_ID = w.Category_ID WHERE News_ID = $id");
                return $query->result();
            }
            
            // #update News function 
            public function updateNews($data = array()){
                $where = array('News_ID' => $data['News_ID']);
                $this->db->where($where);
                $query = $this->db->update(TBL_NEWS, $data);
                return $query;
    
            }
            
            // #delete News function 
            public function deleteNews($data = array()){
                $where = array('News_ID' => $data['Id']);
                $this->db->where($where);
                $query = $this->db->delete(TBL_NEWS);
                return $query;
    
            }
            
            public function getProductImages($data = array()){
                $where = array(
                    'p.News_ID' => $data['News_ID']
                );
               return $this->db->where($where)->get(TBL_NEWS)->result();
            }
    }
    
?>