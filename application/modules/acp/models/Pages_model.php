<?PHP
class Pages_model extends CI_Model
{
    /*
        * Pages CRUD
    */


    public function listall($id = '')
    {
        if(!empty($id))
        {
            $this->db->where('Id', $id);
        }

        $query = $this->db
            ->select("*")
            ->from(TBL_PAGES)
            ->order_by('Id', 'ASC')
            ->get();

        if(!empty($id))
        {
            return $query->row();
        }

        return $query->result();
    }

    public function contactus() {
        $query = $this->db
            ->select("*")
            ->from(TBL_WEBSITE_SETTINGS)
            ->get();
        return $query->row();
    }

    public function update($page = array())
    {
        return $this->db->where("Id", $page["Id"])->update(TBL_PAGES, $page);
    }

    public function delete($id = 0)
    {
        return $this->db->where("Id", $id)->delete(TBL_PAGES);
    }

}
?>