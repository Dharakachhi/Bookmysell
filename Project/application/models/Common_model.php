<?php



/**

 * Common_model

 */

class Common_model extends CI_Model {



	/**

	 * construct

	 */

	public function __construct() {

		$sql1 = "SET SQL_BIG_SELECTS=1";

		$this->db->query($sql1);

	}



	/**

	 * insert

	 * @param  $data

	 * @param  $tableName

	 * @return int

	 */

	public function insert($data, $tableName) {

		$query = $this->db->insert_string($tableName, $data);

		$query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $query);

		$this->db->query($query);

		return $this->db->insert_id();

	}



	/**

	 * getDatabyId

	 * @param $id

	 * @param $tableName

	 * @param $id_name

	 * @return array

	 */

	public function getDatabyId($id, $tableName, $id_name) {

		$sql = "SELECT * FROM $tableName WHERE $id_name = '" . $id . "'";

		$query = $this->db->query($sql);

		if ($query->num_rows($query) > 0) {

			return $query->row();

		}

	}



	/**

	 * getAllData

	 * @param  $tableName

	 * @return array

	 */

	public function getAllData($tableName) {

		$sql = "SELECT * FROM $tableName";

		$query = $this->db->query($sql);

		return $query->result();

	}



	/**

	 * getAllDatabyId

	 * @param $tableName

	 * @param $table_field

	 * @param $get_id

	 * @return array

	 */

	public function getAllDatabyId($tableName, $table_field, $get_id) {

		$sql = "SELECT * FROM $tableName WHERE $table_field = " . $get_id;

		$query = $this->db->query($sql);

		return $query->result();

	}



	/**

	 * update

	 * @param  $id

	 * @param  $data

	 * @param  $tableName

	 * @param  $id_name

	 * @return result

	 */

	public function update($id, $data, $tableName, $id_name) {

		$this->db->where($id_name, $id);

		return $this->db->update($tableName, $data);

	}



	public function update_in($id, $data, $tableName, $id_name) {

		$this->db->where_in($id_name, str_replace("'", "", $id));

		return $this->db->update($tableName, $data);



	}



	/**

	 * delete

	 * @param $id

	 * @param $id_name

	 * @param $tableName

	 * @return

	 */

	public function delete($id, $id_name, $tableName) {

		$this->db->where($id_name, $id);

		return $this->db->delete($tableName);

	}



	/**

	 * check Duplicate

	 * @param  $tableName

	 * @param  $filedvalue

	 * @param  $id

	 * @param  $filedname

	 * @return boolean

	 */

	public function checkDuplicate($tableName, $filedvalue, $id = '', $filedname, $idname) {

		if (isset($id) && $id > 0) {

			$sql = 'SELECT ' . $idname . ' FROM ' . $tableName . ' WHERE ' . $filedname . '="' . trim($filedvalue) . '" AND ' . $idname . ' != "' . $id . '"';

		} else {

			$sql = 'SELECT ' . $idname . ' FROM ' . $tableName . ' WHERE ' . $filedname . '="' . trim($filedvalue) . '"';

		}



		$query = $this->db->query($sql);

		if ($query->num_rows($query) > 0) {

			return 'false';

		} else {

			return 'true';

		}

	}



	/**

	 * getWhere

	 * @param $where array

	 * @param $fields array

	 * @param $tableName array

	 * @return array

	 */

	public function getWhere($where, $fields, $tableName) {

		$this->db->select($fields);

		$this->db->from($tableName);

		$this->db->where($where);

		$query = $this->db->get();

		$query->num_rows($query);

		if ($query->num_rows($query) == 1) {

			return $query->row_array();

		} elseif ($query->num_rows($query) > 1) {

			return $query->result_array();

		}

	}



	/**

	 * getdata

	 * @return result array

	 */

	public function getResultArray($where, $fields, $tableName) {

		$this->db->select($fields);

		$this->db->from($tableName);

		$this->db->where($where);

		$query = $this->db->get();

		return $query->result_array();

	}



	/**

	 * getResult

	 * @return array with sub object data

	 */

	public function getResult($where, $fields, $tableName){

        $this->db->select($fields);

        $this->db->from($tableName);

        if (!empty($where)) {

            $this->db->where($where);

        }

        $query = $this->db->get();

        return $query->result();

    }



	/**

	 * getdata

	 * @return row array

	 */

	public function getRowArray($where, $fields, $tableName) {

		$this->db->select($fields);

		$this->db->from($tableName);

		$this->db->where($where);

		$query = $this->db->get();

		return $query->result_array();

	}

	/**

	 * getRow

	 * @return row object

	 */

	public function getRow($where, $fields, $tableName){

        $this->db->select($fields);

        $this->db->from($tableName);

        $this->db->where($where);

        $query = $this->db->get();

        return $query->row();

    }



	 public function distinct($id) {

    	$this->db->distinct();

    	$this->db->select('item_location');

    	$this->db->from('order_item');

        $this->db->where('order_id',$id);

    	$info = $this->db->get();

    	return $info->result_array();

    }



     public function group_contact($id) {

     	 // $itemids = $this->db->query("SELECT order_item.item_location, GROUP_CONCAT(DISTINCT order_item.item_id SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = " . $id . " GROUP BY order_item.item_location")->result_array();

     	// SELECT order_item.item_location, GROUP_CONCAT(DISTINCT CONCAT(order_item.`item_category`,':',order_item.`item_location_type`) SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = 105 GROUP BY order_item.item_location


     	// SELECT order_item.item_location_type,order_item.item_category, GROUP_CONCAT(DISTINCT CONCAT(order_item.item_id) SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = 105 GROUP BY order_item.item_location

    	$this->db->select('order_item.item_name,order_item.item_id, order_item.item_price, order_item.item_description, order_item.item_quantity,order_item.item_category, GROUP_CONCAT(DISTINCT order_item.item_id SEPARATOR ",") as location');

	    $this->db->from('order_item');

	    $this->db->where('order_id', $id);

	    $this->db->group_by('item_location');

	    // $this->db->join('product_type', 'product_type.tCategory = product.type', 'LEFT OUTER');

	    $query = $this->db->get();

	    return $query->result_array();

    }



    public function wherein ($array) {

    	$loc = explode(",", $array);

		$this->db->select('item_id,item_name,item_quantity,item_description,item_price,item_location,item_category,item_location_type');

		$this->db->from('order_item');

		// $this->$db->join('genre_map','genre_map.bookid = books.bookid');

		$this->db->where_in('item_id', $loc);

		$query = $this->db->get();

		// echo $this->db->last_query();exit;

		return $query->result_array();

    }



     public function wherein_img ($array) {

    	$loc = explode(",", $array);

		$this->db->select('img_name,img_id,product_id');

		$this->db->from('orderitem_image');

		// $this->$db->join('genre_map','genre_map.bookid = books.bookid');

		$this->db->where_in('product_id', $loc);

		$query = $this->db->get();

		// echo $this->db->last_query();exit;

		return $query->result_array();

    }

    public function getyear(){
    	$this->db->select('year(created_date) as year');
    	$this->db->from('order_master');
    	$this->db->group_by('year');
    	$query = $this->db->get();
    	return $query->result_array();

    }

    public function getsign() {
    	$this->db->select('signature_contact');
    	$this->db->from('order_master');
    	// $this->db->where('created_by <>', 1); // <> check not equal to means (!=)
    	$this->db->where('signature_contact IS NOT NULL');
    	$this->db->where('signature_contact !=', '');
    	$query = $this->db->get();
    	return $query->result_array();
    }

    public function editorder($id){
    	$this->db->select('*');
		$this->db->from('order_master');
		$this->db->join('order_item', 'order_master.ord_id = order_item.order_id','left');
		$this->db->join('orderitem_image', 'order_item.item_id = orderitem_image.product_id','left');
		$this->db->where('order_master.ord_id',$id);
		$query = $this->db->get();
		return $query->result_array();
    }

     public function group_contact_location($id) {

     	 // $itemids = $this->db->query("SELECT order_item.item_location, GROUP_CONCAT(DISTINCT order_item.item_id SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = " . $id . " GROUP BY order_item.item_location")->result_array();

     	// SELECT order_item.item_location, GROUP_CONCAT(DISTINCT CONCAT(order_item.`item_category`,':',order_item.`item_location_type`) SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = 105 GROUP BY order_item.item_location


     	// SELECT order_item.item_location_type,order_item.item_category, GROUP_CONCAT(DISTINCT CONCAT(order_item.item_id) SEPARATOR ', ') as ids FROM order_item WHERE order_item.order_id = 105 GROUP BY order_item.item_location

    	$this->db->select('order_item.item_name,order_item.item_id, order_item.item_price, order_item.item_description, order_item.item_quantity,order_item.item_category, GROUP_CONCAT(DISTINCT CONCAT(order_item.`item_category`,":",order_item.`item_location_type`) SEPARATOR ",") as location');

	    $this->db->from('order_item');

	    $this->db->where('order_id', $id);

	    $this->db->group_by('item_location');

	    // $this->db->join('product_type', 'product_type.tCategory = product.type', 'LEFT OUTER');

	    $query = $this->db->get();

	    return $query->result_array();

    }


     public function item_address($id) {

     	// SELECT GROUP_CONCAT( DISTINCT order_item.item_category) FROM order_item WHERE order_item.order_id = 105 GROUP BY item_category;

     	// SELECT GROUP_CONCAT( DISTINCT order_item.item_category)AS address, GROUP_CONCAT(DISTINCT order_item.item_location_type) AS location_type FROM order_item WHERE order_item.order_id = 105 GROUP BY item_category;

/*old query*/
    	$this->db->select('GROUP_CONCAT( DISTINCT order_item.item_category)AS address, GROUP_CONCAT(DISTINCT order_item.item_location_type) AS location_type');
/*new query*/
    	//$this->db->select('order_item.item_category AS address, order_item.item_location_type AS location_type');

	    $this->db->from('order_item');

	    $this->db->where('order_id', $id);

	    $this->db->group_by('item_category');

	    // $this->db->join('product_type', 'product_type.tCategory = product.type', 'LEFT OUTER');

	    $query = $this->db->get();

	    return $query->result_array();

    }

     public function wherein_item_location ($array,$location,$id) {
     	//SELECT `item_id`, `item_name`, `item_quantity`, `item_description`, `item_price`, `item_location`, `item_category`, `item_location_type` FROM `order_item` WHERE `item_category` IN('12', '121', '122') AND `order_id` = '105'
     	// echo "<pre>";
     	// print_r ($array);
     	// echo "</pre>";exit;
    	$address = explode(",", $array);
    	$location_type = explode(",", $location);
     	// print_r($address);exit;

		$this->db->select('item_id,item_name,item_quantity,item_description,item_price,item_location,item_category,item_location_type,disable-location');

		$this->db->from('order_item');

		// $this->$db->join('genre_map','genre_map.bookid = books.bookid');

		// $this->db->where_in('item_category', $array[0]);
		$this->db->where_in('item_category', $array);
		$this->db->where_in('item_location_type', $location_type);
		$this->db->where('order_id', $id);

		$query = $this->db->get();

		// echo $this->db->last_query();exit;

		return $query->result_array();

    }

    public function check_address_location_exists($id,$location_type,$address) {
    	$this->db->select("*");
    	$this->db->from('order_item');
    	$this->db->where('item_location_type',$location_type);
    	$this->db->where('item_category',$address);
    	$this->db->where('order_id',$id);
    	$query = $this->db->get();
    	return  $query->num_rows();
    }
}