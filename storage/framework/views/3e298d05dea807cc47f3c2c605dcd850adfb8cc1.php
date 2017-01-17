<?php $__env->startSection('title'); ?>
User Registration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Update my profile</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="<?php echo e(route('user.edit_profile')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name&nbsp;<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>">

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address&nbsp;<span class="required">*</span></label>

                            <div class="col-md-6">
                                <input  type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('user_role') ? ' has-error' : ''); ?>">
                            <label for="user_role" class="col-md-4 control-label">User Role</label>
                            <div class="col-md-6">
								<span class="label label-warning"><?php echo e(@$user_roles[0]->title); ?></span>
                                <?php if($errors->has('user_role')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('user_role')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="user_role" class="col-md-4 control-label">Avatar (Optional)</label>
                            <div class="col-md-6">
								<input type="file" name="avatar" class="form-control" id="fileupload"/>					
                            </div>
                            <div class="col-md-2">
                            	<div id="dvPreview">
                            		<?php if($user->avatar): ?>
                            			<img src="<?php echo e(asset('images/avatars/thumbnail/'.$user->avatar)); ?>" alt="" title="" class="img-responsive img-thumbnail" style="width:113px;height:150px;"/>
                            		<?php endif; ?>
                            	</div>	
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('sex') ? ' has-error' : ''); ?>">
                            <label for="sex" class="col-md-4 control-label">Sex&nbsp;<span class="required">*</span></label>
                            <div class="col-md-6">
								<select name="sex" class="form-control" id="sex">
									<option value="">--Select one--</option>
									<option value="Male" <?php echo $user->sex=='Male' || old('sex')=='Male' ?'selected':''?>>Male</option>
									<option value="Female" <?php echo $user->sex=='Female' || old('sex')=='Female'?'selected':''?>>Female</option>
								</select>
                                <?php if($errors->has('sex')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('sex')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('dob') ? ' has-error' : ''); ?>">
                            <label for="dob" class="col-md-4 control-label">Date of birth&nbsp;<span class="required">*</span></label>
                            <div class="col-md-6">
								<input type="text" id="datepicker" name="dob" class="form-control" value="<?php echo e($user->dob); ?>"/>
                                <?php if($errors->has('dob')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('dob')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                            <label for="phone" class="col-md-4 control-label">Phone&nbsp;<span class="required">*</span></label>
                            <div class="col-md-6">
                            	<div class="input-group phone-input">
									<span class="input-group-btn">
										<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">(+855)</button>
									</span>
									<input type="text" name="phone" class="form-control" value="<?php echo (old('phone'))?old('phone'):$user->phone;?>" placeholder="012345678" />
								</div>
                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                            <label for="address" class="col-md-4 control-label">Address&nbsp;<span class="required">*</span></label>
                            <div class="col-md-6">
								<textarea class="form-control" name="address" rows="5" cols="10"><?php echo e($user->address); ?></textarea>
                                <?php if($errors->has('address')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                         <div class="form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                            <label for="description" class="col-md-4 control-label">Description&nbsp;<span class="required">*</span></label>
                            <div class="col-md-6">
								<textarea class="form-control" name="description" rows="5" cols="10"><?php echo e($user->description); ?></textarea>
                                <?php if($errors->has('description')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                            	(<span class="required">*</span>) Fields are mandatory!
                                <button type="submit" name="btn-update" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-user"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function () {
    var fileUpload = document.getElementById("fileupload");
    fileUpload.onchange = function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = document.getElementById("dvPreview");
            dvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < fileUpload.files.length; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.width = "113";
                        img.height = "150";
                        img.setAttribute("class","img-responsive img-thumbnail");
                        img.src = e.target.result;
                        dvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
    
    $("#datepicker").datepicker({
    		format: "yyyy-mm-dd",
			//daysOfWeekDisabled: [0,6],
			todayBtn: true,
			clearBtn: true,
			orientation: "bottom auto",
			//daysOfWeekHighlighted: "0,6",
			//calendarWeeks: true,
			autoclose: true,
			todayHighlight: true,
			//datesDisabled: ['2016/10/29', '2016/11/11'],
			toggleActive: true
    	});
		//$("#datepicker").datepicker('setDate',new Date());
};
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>