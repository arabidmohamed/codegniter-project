<?PHP

class Product_model extends CI_Model {

    // ***************************************
    public function getProductList() {
        $this->db->where('Status', 1);
        $q = $this->db->get('products');
        return $q->result();
    }

    public function getProduct($id) {
        $this->db->where('Status', 1);
        $this->db->where('products.Product_ID', $id);
        $this->db->join('product_prices', 'products.Product_ID=product_prices.Product_ID', 'left');
        $q = $this->db->get('products');
        return $q->row();
    }

    public function addSubscription($data) {
        $this->db->insert('product_subscriptions', $data);
        return $this->db->affected_rows();
    }

    public function addOrder($data) {
        $this->db->insert('product_orders', $data);
        return $this->db->insert_id();
    }

    public function updateOrder($data) {
        $this->db->where('Order_ID', $data['Order_ID']);
        $this->db->update('product_orders', $data);
    }

    public function updateSubscription($id, $orderId, $orderDetails = 0) {
        $this->db->where('Subscription_ID', $id);
        if ($orderDetails) {
            $this->db->set("Num_of_licenses ", "Num_of_licenses + $orderDetails", FALSE);
        }
        $this->db->set('Status', 'created');
        $this->db->update('product_subscriptions');

        $this->db->where('Order_ID', $orderId);
        $this->db->set('isCreated', 1);
        $this->db->set('Created_At', date('Y-m-d H:i:s'));

        $this->db->update('product_orders');
    }

    // Ends
    // ***************************************

    public function getSubscriptionDetails($rId,$user_id) {
        $this->db->where('product_subscriptions.Subscription_ID', $rId);
        $this->db->where('product_subscriptions.Customer_ID', $user_id);
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('product_prices', 'product_prices.Price_ID=product_subscriptions.Price_ID');
        $this->db->from('product_subscriptions');
        $q = $this->db->get();
        return $q->row();
    }

    public function getPriceDetails($Id) {
        $this->db->where('Price_ID', $Id);
        $q = $this->db->get('product_prices');
        return $q->row();
    }

    public function getProductPrices($pId) {
        $this->db->where('product_prices.Product_ID', $pId);
        $this->db->join('products', 'products.Product_ID=product_prices.Product_ID');
        $q = $this->db->get('product_prices');
        return $q->result();
    }

    public function getSubscriptions($customer_id) {
        $this->db->where('product_subscriptions.Customer_ID', $customer_id);
        $this->db->where('product_subscriptions.Status', 'created');
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');
        $this->db->join('product_orders', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $this->db->group_by('product_subscriptions.Subscription_ID');
        $q = $this->db->get('product_subscriptions');
        return $q->result();
    }

    public function addAPISLog($log = array()) {
        $this->db->insert('apis_log', $log);
    }

    public function getProductByDomain($domain,$product_id) {
        $this->db->where('product_subscriptions.Customer_ID', $this->session->userdata($this->site_session->userid()));
        $this->db->where('product_subscriptions.Status', 'created');
        $this->db->where('product_subscriptions.domain', $domain);
        $this->db->where('product_subscriptions.Product_ID', $product_id);
        $this->db->join('product_orders', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $q = $this->db->get('product_subscriptions');
        return $q->row();
    }

    public function getorderById($order_id) {
        $this->db->where('product_orders.Order_ID', $order_id);
        $this->db->join('product_subscriptions', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('product_prices', 'product_prices.Price_ID=product_subscriptions.Price_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');

        $q = $this->db->get('product_orders');
        return $q->row();
    }

    public function getorderByIdforAddition($order_id) {
        $this->db->where('product_orders.Order_ID', $order_id);
        $this->db->join('product_subscriptions', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('product_prices', 'product_prices.Price_ID=product_subscriptions.Price_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');
        $this->db->join('product_workspace w', 'w.Subscription_ID=product_subscriptions.Subscription_ID');
        $q = $this->db->get('product_orders');
        return $q->row();
    }

    public function checkPending_new_orders($product_ID) {
        $this->db->where('product_subscriptions.Status', 'pending');
        $this->db->where('product_orders.isCreated', 0);
        $this->db->where('product_orders.Order_Type', 'CONCAT(OrderType, "_new")', false);
        $this->db->where('product_subscriptions.Product_ID', $product_ID);
        $this->db->where('product_orders.payment_verified', 1);
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');
        $this->db->join('product_orders', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $q = $this->db->get('product_subscriptions');
        return $q->result();
    }

    public function checkPending_additional_orders($product_ID) {
        $this->db->where('product_subscriptions.Status', 'created');
        $this->db->where('product_orders.isCreated', 0);
        $this->db->where('product_orders.Order_Type', 'workspace_license_addition');
        $this->db->where('product_subscriptions.Product_ID', $product_ID);
        $this->db->where('product_orders.payment_verified', 1);
        $this->db->join('products', 'products.Product_ID=product_subscriptions.Product_ID');
        $this->db->join('customers', 'customers.Customer_ID=product_subscriptions.Customer_ID');
        $this->db->join('product_orders', 'product_orders.Subscription_ID=product_subscriptions.Subscription_ID');
        $q = $this->db->get('product_subscriptions');
        return $q->result();
    }

    public function getProductOrderByReferancePayment($payment_referance){
        return   $this->db
                        ->select('*')
                        ->from('product_orders'.' as o')
                        ->join('product_subscriptions'.' as ps', 'o.Subscription_ID = ps.Subscription_ID','right')
                        ->join(TBL_CUSTOMERS.' as c', 'c.Customer_ID = ps.Customer_ID','right')
                        ->where('o.payment_ref', $payment_referance)
                        ->where('o.payment_verified', 0)
                        ->get()
                        ->row();
    }

}

?>