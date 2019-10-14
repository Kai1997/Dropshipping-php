<?php
// use function GuzzleHttp\json_encode;

class products_controller extends vendor_backend_controller { 
  public function index() {
    global $app;
    $conditions = "";

    if(isset($app['prs']['status'])){
      $status = $app['prs']['status']; 
      $conditions .= (($conditions)? " AND ":"")." products.status=".($status =='all'?'':($status=='exist'?0:($status=='runninglow'?1:2)));
    }
    
    if(isset($app['prs']['search'])){
      $conditions .= (($conditions)? " AND ":"").
      " products.name like '%".$app['prs']['search']."%' OR ".
      " products.sku like '%".$app['prs']['search']."%' OR".
      " products.description	like '%".$app['prs']['search']."%' OR ".
      " categories.name	like '%".$app['prs']['search']."%' OR ".
      " stores.name	like '%".$app['prs']['search']."%' OR ".
      " brands.name	like '%".$app['prs']['search']."%' OR ".
      " products.id like '%".$app['prs']['search']."%'";
    }

    $product = new product_model();
    $this->records = $product->allp('*',['conditions'=>$conditions, 'joins'=>['category', 'brand', 'store'], 'order'=>'id ASC']);
    $this->display();
  }
  public function edit($id) {
    $pm = new product_model();
    $this->record = $pm->getRecord($id);
    if(isset($_POST['btn_submit'])) {
      $productData = $_POST['product'];
      $valid = $pm->validator($productData, $id);
      if($valid['status']){
        if($pm->editRecord($id, $productData)) {
          header("Location: ".vendor_app_util::url(["ctl"=>"products"]));
        } else {
          $this->errors = ['database'=>'An error occurred when editing data!'];
          $this->record = $productData;
        }
      } else {
        $this->errors = $pm::convertErrorMessage($valid['message']);
        $this->record = $productData;
        $this->record['id'] = $id;
      }
    }
    $brands = new brand_model();
    $this->recordsBrands = $brands ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $stores = new store_model();
    $this->recordsStores = $stores ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $categories = new category_model();
    $this->recordsCategories = $categories ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $this->display();
  }

  public function add() {
    if(isset($_POST['btn_submit'])) {
      $um = new product_model();
      $productData = $_POST['product'];
      // $valid = $um->validator($productData);
      // if($valid['status']) {      
        if($um->addRecord($productData))
          header("Location: ".vendor_app_util::url(["ctl"=>"products"]));
        else {
          $this->errors = ['database'=>'An error occurred when inserting data!'];
          $this->record = $productData;
        }
      // } else {
        // $this->errors = $um::convertErrorMessage($valid['message']);
        // $this->record = $productData;
      // }
    }
    $brand = new brand_model();
    $this->recordsBrands = $brand ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $stores = new store_model();
    $this->recordsStores = $stores ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $categories = new category_model();
    $this->recordsCategories = $categories ->getAllRecords('*',['conditions'=>'', 'joins'=>'', 'order'=>'id ASC']);
    $this->display();
  }

  public function view($id) {
    $pm = new product_model();
    $this->record = $pm->getRecord($id);
    $brand = new brand_model();
    $this->recordsBrands = $brand ->getAllRecords('*',['conditions'=>'brands.id ='.$this->record['brand_id'], 'joins'=>'', 'order'=>'id ASC']);
    $stores = new store_model();
    $this->recordsStores = $stores ->getAllRecords('*',['conditions'=>'stores.id='.$this->record['store_id'], 'joins'=>'', 'order'=>'id ASC']);
    $categories = new category_model();
    $this->recordsCategories = $categories ->getAllRecords('*',['conditions'=>'categories.id='.$this->record['category_id'], 'joins'=>'', 'order'=>'id ASC']);
    $this->display();
  }

  public function changestatus() {
    global $app;
    $id = $app['prs'][1];
    $product = new product_model();
    $productData['status'] = $app['prs'][2]?0:1;
    if($product->editRecord($id, $productData)) echo "Change status successful";
    else echo "error";
  }

  public function del($id) {
    $product = new product_model();
    if($product->delRelativeRecord($id)) echo "Delete Successful";
    else echo "error";
  }

  public function delmany() {
    global $app;
    $ids = $app['prs']['ids'];
    $product = new product_model();
    if($product->delRelativeRecords($ids)) echo "Delete many successful";
    else echo "error";
  }
  //export data 
	public function exportdata() {
		$pm = new product_model();
    $record = $pm->getAllRecordsExport('products.id, products.sku, products.name, products.description, products.price, products.quantity, products.num_of_brought, products.best_selling, products.status',['conditions'=>'', 'joins'=>['category', 'brand', 'store'], 'order'=>'id ASC']);
		http_response_code(200);
		echo (($record));
	}
}
?>