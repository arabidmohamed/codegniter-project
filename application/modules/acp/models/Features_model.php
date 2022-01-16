<?PHP
class Features_model extends CI_Model
{
    /*
        * Menu CRUD
    */
    public function add($feature = array())
    {
        $this->db->insert('website_features', $feature);
        return $this->db->insert_id();
    }

    public function listall($fid = '', $is_sidebar = false)
    {

        if(!empty($fid))
        {
            $this->db->where('FID', $fid);
        }

        $query = $this->db
            ->select("*")
            ->from("website_features")
            ->order_by('Order_In_List', 'asc')
            ->get();

        if(!empty($fid))
        {
            return $query->row();
        }

        return $query->result();
    }

    public function update($feature = array())
    {
        return $this->db->where("FID", $feature["FID"])->update("website_features", $feature);
    }

    public function delete($id = 0)
    {

        // Added by Yasir on 14 Oct 2019
        $result = $this->db->where('FID', $id)->get('website_features')->row();
        $table_name = $result->Table_Name;
        if ($table_name) {
            $this->load->dbforge();
            $this->dbforge->drop_table($table_name);
        }

        return $this->db->where("FID", $id)->delete("website_features");
    }

    public function rbac_menus() {
        return $this->db->select("*")
            ->from("rbac_menus")
            ->get()
            ->result();

    }

}
?>