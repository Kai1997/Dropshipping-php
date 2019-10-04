<section class="content" id="admin-import-page">
  <div class="box">      
    <div class="box-body">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
					<?php if($app['act'] != 'view') { ?>
						<form 
							id="form-addproduct" 
							action="<?php echo vendor_app_util::url(["ctl"=>"products", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" 
							method="post" enctype="multipart/form-data" class="form-horizontal"
						>
					<?php } ?>
						<?php if(isset(($this->errors['database']))) { ?>
							<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
								<h4>Oh snap! You got an error!</h4> 
								<p><?=$this->errors['database'];?></p> 
							</div>
					<?php } ?>
						<div class="form-group">
							<label for="status">Status</label>
								<?php if($app['act'] !='view'){ ?>
									<select name="product[status]" id="input-status" class="form-control">
										<?php foreach (product_model::$status as $k => $v) { ?>
											<option value="<?=$k;?>" <?=(isset($this->record['status']) && $this->record['status']==$k)? 'selected="selected"':'';?>><?=$v;?></option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<input disabled type="text" id="status" name="product[status]"  class="form-control" value="<?php if(isset($this->record['status'])) echo product_model::$status[$this->record['status']]; ?>">
								<?php } ?>
							<?php if( isset($this->errors['status'])) { ?>
								<p class="text-danger"><?=$this->errors['status']; ?></p>
							<?php } ?>
						</div>
						<div class="form-group">
							<label for="sku">SKU<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="sku" name="product[sku]" placeholder="" class="form-control" value="<?php if(isset($this->record['sku'])) echo $this->record['sku']; ?>">
								<?php if( isset($this->errors['sku'])) { ?>
									<p class="text-danger"><?=$this->errors['sku']; ?></p>
								<?php } ?>
						</div>
						<div class="form-group">
							<label for="name">Name<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="name" name="product[name]" placeholder="" class="form-control" value="<?php if(isset($this->record['name'])) echo $this->record['name']; ?>">
								<?php if( isset($this->errors['name'])) { ?>
									<p class="text-danger"><?=$this->errors['name']; ?></p>
								<?php } ?>
						</div>
						<div class="form-group">
							<label for="name">Slug<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="name" name="product[name]" placeholder="" class="form-control" value="<?php if(isset($this->record['name'])) echo $this->record['name']; ?>">
								<?php if( isset($this->errors['name'])) { ?>
									<p class="text-danger"><?=$this->errors['name']; ?></p>
								<?php } ?>
						</div>
						
						<div class="form-group">
							<label for="description">Description<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="description" name="product[description]" placeholder="" class="form-control" value="<?php if(isset($this->record['description'])) echo $this->record['description']; ?>">
								<?php if( isset($this->errors['description'])) { ?>
									<p class="text-danger"><?=$this->errors['description']; ?></p>
								<?php } ?>
						</div>
						<div class="form-group">
							<label for="price">price<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="price" name="product[price]" placeholder="" class="form-control" value="<?php if(isset($this->record['price'])) echo $this->record['price']; ?>">
								<?php if( isset($this->errors['price'])) { ?>
									<p class="text-danger"><?=$this->errors['price']; ?></p>
								<?php } ?>
						</div>
						<div class="form-group">
							<label for="quanlity">quanlity<span style="color:red;">*</span></label>
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="quanlity" name="product[quanlity]" placeholder="" class="form-control" value="<?php if(isset($this->record['quanlity'])) echo $this->record['quanlity']; ?>">
								<?php if( isset($this->errors['quanlity'])) { ?>
									<p class="text-danger"><?=$this->errors['quanlity']; ?></p>
								<?php } ?>
						</div>
						<?php if($app['act'] !='view'){ ?>
							<div class="text-center form-group">
								<input class="btn btn-success" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>">
							</div>
						<?php } ?>

						<?php if($app['act'] =='view'){ ?>
							<div class="form-group">
								<label for="created">Created at</label>
								<input disabled type="text" id="created" placeholder="" class="form-control" value="<?php if(isset($this->record['created'])) echo $this->record['created']; ?>">
							</div>

							<div class="form-group">
								<label for="updated">Updated at</label>
								<input disabled type="text" id="updated" placeholder="" class="form-control" value="<?php if(isset($this->record['updated'])) echo $this->record['updated']; ?>">
							</div>

							<div class="form-group text-center">
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"products", "act"=>"edit/".$this->record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" >
									<button data-placement="top" title="Edit product" type="button" class="btn btn-primary edit-record" alt="<?php echo $record['id']; ?>"><i class="fa fa-edit"></i></button>
								</a>
							</div>
						<?php } ?>
						<?php if($app['act'] != 'view') { ?>
							</form>
						<?php } ?>
							</div>
						</div>
      <table class="table">
        <tbody id="list-data">

        </tbody>
      </table>
      <div class="loading hide" id="loading" style="">
        <i class="fa fa-spinner fa-spin"></i>
      </div>
    </div>
  </div>
</section>
</div>
<script type="text/javascript" src="<?php echo RootREL; ?>media/admin/js/slugify.js"></script>
<script>
	$("#name").keyup(function(){
		$("#slug").val(slugify($(this).val()));
	});
</script>