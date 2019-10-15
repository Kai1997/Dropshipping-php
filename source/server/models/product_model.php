<?php
class product_model extends vendor_pagination_model
{
	public $nopp = 10;
	public static $status = [
						0 => 'Exist',
                        1 => 'Running low',
                        2 => 'Out of'  
					];
	public function rules() {
		global $app;
	    return [
        	'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'quality' => ['required', 'string'],
        	'price' => ['required', 'int'],
	    ];
	}
	protected $relationships = [
		'hasMany'	=>	[
			['rate',	'key'=>'product_id', 'on_del'=>true],
			['gallery',	'key'=>'product_id', 'on_del'=>true],
			['comment',	'key'=>'product_id', 'on_del'=>true],
			['view',	'key'=>'product_id', 'on_del'=>true],
			['order_item',	'key'=>'product_id', 'on_del'=>true]
		],
		'belongTo' => [
			['category','key'=>'category_id'],
			['store','key'=>'store_id'],
			['brand','key'=>'brand_id']
		]
	];

}
?>