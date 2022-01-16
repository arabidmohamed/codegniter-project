<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class generic_model extends CI_Model 
	{
		public function __construct()
		{
			parent::__construct();

        //$this->online = $this->load->database('online', true);
		}
	 //  function insert_with_id_online($table,$data){
		//         $this->online->insert($table,$data);
		//         $insert_id = $this->online->insert_id();		        
		//         return $insert_id;
  //   }

  //   function save_online($data,$where,$table,$keywords){
		// 	$this->online->reset_query();
  //           //$this->online->where($where);
  //           $this->online->like($where, $keywords); 
		// 	$this->online->update($table,$data);
		// 	return $this->online->affected_rows();
			
		// }
		  function insert_with_id($table,$data){
		        $this->db->insert($table,$data);
		        $insert_id = $this->db->insert_id();		        
		        return $insert_id;
    }
    private function _prepare_where($where)
        {
            if (isset($where)){
                foreach ($where as $key=>$where_item)
                    if(stripos($where_item,'%')>-1)
                        $this->db->like($key,$where_item,'both',FALSE);
                    else
                        $this->db->where($key,$where_item,FALSE);
            }
        }
        private function _prepare_joins($joins)
        {
            if (isset($joins)){
                if(is_array($joins))
                    foreach ($joins as $join)
                        $this->db->join($join[0],$join[1]);
            }
        }
  //   		function get($limit,$start,$where,$fileds,$order_by,$table){

  //           $this->db->from($table);

  //           if (isset($where)){
		// 		$this->db->where($where,FALSE);
		// 	}

  //           if (isset($limit) && isset($start)){
		// 		$this->db->limit($limit,$start);
		// 	}
		// 	if (isset($fileds)){
		// 		$this->db->select($fileds);
		// 	}			
		// 	if (isset($order_by)){
		// 		$this->db->order_by($order_by[0],$order_by[1]);
		// 	}
			
		// 	$ret = $this->db->get()->result();

		// 	return $ret;
		// 	// return 	$ret;
		// }

    function get_country_name($country_id){

			  $sql="SELECT name,publish_flag FROM country WHERE country_id = $country_id ";
                            $query=$this->db->query($sql);
                            $res = $query->result_array();
			

			if (!empty($res[0])){
				return $res[0];
			}else{
				return NULL;
			}
	
    }

    function get_search_result($keyword, $table,$column,$fields){
    					    $search_term="%".$keyword."%";
                            $sql="SELECT $fields FROM $table WHERE $column LIKE ? ";
                            $query=$this->db->query($sql,array($search_term));
                            return $query->result_array();
    }

		function get($limit,$start,$where,$fileds,$order_by,$table){
			$this->db->from($table);
			if (isset($limit) && isset($start)){
				$this->db->limit($limit,$start);
			}
			if (isset($where)){
				$this->db->where($where,FALSE);
			}
			if (isset($fileds)){
				$this->db->select($fileds);
			}			
			if (isset($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}
			$ret = $this->db->get()->result();
			
			return $ret;
		}
		function get_count($where=NULL,$table){
			$this->db->from($table);
			if (isset($where)){
				$this->db->where($where);
			}
			$this->db->select('count(*) as COUNT');
			$ret = $this->db->get()->first_row();
			
			return $ret;
		}
		function get_all($where,$fileds,$order_by,$table){
            if (isset($fileds)){
                $this->db->select($fileds);
            }
            if (isset($where)){
                $this->db->where($where,FALSE);
            }
            if (isset($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
                
            }
            $this->db->from($table);
            $ret = $this->db->get()->result();           
            return $ret;
		}

			function get_all1($where,$fileds,$order_by,$table){
            if (isset($fileds)){
                $this->db->select($fileds);
            }
            if (isset($where)){
                $this->db->where($where,FALSE);
            }
            if (isset($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
                
            }
            $this->db->from($table);
            $this->db->limit(1);
			$ret = $this->db->get()->first_row();          
            return $ret;
		}

		function get_all_like($where,$keywords,$fileds,$table){
			
				$this->db->select($fileds);									
				$this->db->like($where, $keywords); 								
			    $this->db->from($table);
			    $ret =  $this->db->get();
			    
			if ($ret->num_rows>0){
				$ret = $ret->result_array();
				return $ret;
			}else{
				return NULL;
			}

		}
		function get_all_array($where,$fileds,$order_by,$table){
			if (isset($fileds)){
				$this->db->select($fileds);
			}
			if (isset($where)){
				$this->db->where($where,FALSE);
			}
			if (isset($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}
			$this->db->from($table);
			$ret = $this->db->get()->result_array();
			
			return $ret;

		}
		function search_all($where,$fileds,$order_by,$table){
			if (isset($fileds)){
				$this->db->select($fileds);
			}
			if (isset($where)){
				$this->db->where($where);
			}
			if (isset($order_by)){
				$this->db->order_by($order_by[0],$order_by[1]);
			}
			$this->db->from($table);
			$ret = $this->db->get()->result();
			return $ret;

		}
		function get_one($where,$fileds,$table){
			if (isset($fileds)){
				$this->db->select($fileds);
			}if (isset($where)){
				$this->db->where($where);
			}
			$this->db->from($table);
			$this->db->limit(1);
			$ret = $this->db->get()->first_row();
			
			return $ret;

		}
		function save($data,$where,$table){
			$this->db->reset_query();
            $this->db->where($where);
			$this->db->update($table,$data);
			return $this->db->affected_rows();
			
		}
		function incrementValue($field,$where,$table){
			$this->db->where($where);
			$this->db->set($field, 'cast('.$field.' as UNSIGNED)+ 1 ', FALSE);
			$this->db->update($table);
			
		}
		function insert($table,$data){
			$insert_id = $this->db->insert($table,$data);
			
			return $insert_id;
		}
		function delete($table,$id){
			$this->db->where($id);
			$this->db->delete($table); 
			
		}

function get_with_join_limit($join_table,$join_where,$where,$fileds,$order_by,$table,$limit){

        $this->db->from($table);
        
        if (isset($join_table) && isset($join_where)){
            $this->db->join($join_table,$join_where, 'right');
        }

        if (isset($where)){
            $this->db->where($where,FALSE);
        }
        if (isset($fileds)){
            $this->db->select($fileds);
        }

        if (isset($order_by)){
            $this->db->order_by($order_by[0],$order_by[1]);
        }
        if (isset($limit)){
       		 	$this->db->order_by('receipt_id', 'DESC');
				$this->db->limit($limit);
		}
		
        $ret = $this->db->get()->result();
        // var_dump($this->db->last_query());
        return $ret;
    }

	function get_with_join($join_table,$join_where,$where,$fileds,$order_by,$table){

        $this->db->from($table);
        
        if (isset($join_table) && isset($join_where)){
            $this->db->join($join_table,$join_where, 'right');
        }

        if (isset($where)){
            $this->db->where($where,FALSE);
        }
        if (isset($fileds)){
            $this->db->select($fileds);
        }

        if (isset($order_by)){
            $this->db->order_by($order_by[0],$order_by[1]);
        }
        $ret = $this->db->get()->result();
        // var_dump($this->db->last_query());
        return $ret;
    }

    	function get_with_join_left($join_table,$join_where,$where,$fileds,$order_by,$table){

        $this->db->from($table);
        
        if (isset($join_table) && isset($join_where)){
            $this->db->join($join_table,$join_where,'FULL OUTER JOIN');
        }

        if (isset($where)){
            $this->db->where($where,FALSE);
        }
        if (isset($fileds)){
            $this->db->select($fileds);
        }

        if (isset($order_by)){
            $this->db->order_by($order_by[0],$order_by[1]);
        }
        $ret = $this->db->get()->result();
        // var_dump($this->db->last_query());
        return $ret;
    }

    	function get_with_join1($join_table,$join_where,$where,$fileds,$order_by,$table,$group_by){

        $this->db->from($table);
        
        if (isset($join_table) && isset($join_where)){
            $this->db->join($join_table,$join_where, 'right');
        }

        if (isset($where)){
            $this->db->where($where,FALSE);
        }
        if (isset($fileds)){
            $this->db->select($fileds);
        }

        if (isset($order_by)){
            $this->db->order_by($order_by[0],$order_by[1]);
        }
        if (isset($group_by)){
        	$this->db->group_by($group_by); 
        }
        $ret = $this->db->get()->result();
        // var_dump($this->db->last_query());
        return $ret;
    }
}
?>