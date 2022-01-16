<?PHP
class Pages_model extends CI_Model
{

    public function pageByPrefix($prefix = '')
    {
        $query = $this->db
            ->select("*")
            ->from(TBL_PAGES)
            ->where('Status', 1)
            ->group_start()
            ->where('Id', $prefix)
            // ->or_where('Prefix_ar', urldecode($prefix))
            ->group_end()
            ->get();

        return $query->row();
    }

    public function pageById($id = 0)
    {
        $query = $this->db
            ->select("*")
            ->from(TBL_PAGES)
            ->where('Status', 1)
            ->group_start()
            ->where('Id', $id)
            ->group_end()
            ->get();

        return $query->row();
    }

    public function contactus() {
        $query = $this->db
            ->select("p.*, wc.*")
            ->from(TBL_PAGES. ' as p')
            ->join('website_contacts as wc', 'wc.Page_ID = 20')
            ->get();
        return $query->row();
    }

}
?>
