<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Advertisements <small>management</small>', [
    [
      'title' =>  'Index Advertisements',
      'urlp'=>['ctl'=>$app['ctl']]
    ],
    ['urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/ads/_form.php';
	?>

</section>

</div>
  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
