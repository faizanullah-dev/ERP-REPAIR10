

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/jasny-bootstrap/css/jasny-bootstrap.css')); ?>" rel="stylesheet">

    <style>
        .profile_submit_btn{padding: 12px;}
        #lead-profile-tabs button:not(.active) h5 { color: var(--green_74C911); background: transparent; }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="user_profile_section cost_of_lead pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <?php echo csrf_field(); ?>
                    <div class="card border-0 box-shadow-card px-3 py-3 borderRadius20">

                        <div class="card-headerr align-items-start">
                            <ul class="nav nav-tabs border-0" id="lead-profile-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="border-0 nav-link active" id="user-profile-tab" data-bs-toggle="tab" data-bs-target="#user-profile" type="button" role="tab" aria-controls="user-profile" aria-selected="true">
                                        <h5 class="lead_heading w-100">User Profile</h5>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="border-0 nav-link" id="company-profile-tab" data-bs-toggle="tab" data-bs-target="#company-profile" type="button" role="tab" aria-controls="company-profile" aria-selected="false">
                                        <h5 class="lead_heading w-100">Company Profile</h5>
                                    </button>
                                </li>
                            </ul>
                            <hr>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane active" id="user-profile" role="tabpanel" aria-labelledby="user-profile-tab">
                                    <form id="" action="<?php echo e(route('profile_update')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="profile_img_box">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail imageContainer">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->profile->pic != null): ?>
                                                                <img src="<?php echo e(asset('storage/uploads/users/' . auth()->user()->profile->pic)); ?>" alt="profile pic">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('storage/uploads/users/no_avatar.jpg')); ?>" alt="profile pic">
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                                             style="max-width: 200px; max-height: 200px;"></div>
                                                        <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Upload Photo</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input id="pic" name="pic_file" type="file" accept="image/*" class="form-control" onchange="displaySelectedImage(this)">                                                </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="profile_details_box">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="heading mt-5 mb-5">
                                                                <h5>Customer Information</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="first-name" class="form-label input_labels p-18">First Name</label>
                                                                <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="first_name" value="<?php echo e(auth()->user()->first_name??""); ?>" id="first-name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="last-name" class="form-label input_labels p-18">Last Name</label>
                                                                <input type="text" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="last_name"  value="<?php echo e(auth()->user()->last_name??""); ?>" id="last-name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email" class="form-label input_labels p-18">Email</label>
                                                                <input type="email" placeholder="abc@company.com" class="form-control clr_input_fields borderRadius" name="email" value="<?php echo e(auth()->user()->email??""); ?>" id="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="date-of-birth" class="form-label input_labels p-18">Date Of Birth</label>
                                                                <input type="date" placeholder="Mr.Khan" class="form-control clr_input_fields borderRadius" name="dob"  value="<?php echo e(auth()->user()->profile->dob??""); ?>" id="date-of-birth">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone" class="form-label input_labels p-18">Phone</label>
                                                                <input type="tel" placeholder="+61 123 4567 890" class="form-control clr_input_fields borderRadius" name="phone" value="<?php echo e(auth()->user()->profile->phone??""); ?>" id="phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="address" class="form-label input_labels p-18">Address</label>
                                                                <input type="text" placeholder="Abc address" class="form-control clr_input_fields borderRadius address" name="address" value="<?php echo e(auth()->user()->profile->address??""); ?>" id="address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="submit"  class="btn btn_green borderRadius profile_submit_btn" onclick="this.disabled = true; this.form.submit();"  value="Submit" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="company-profile" role="tabpanel" aria-labelledby="company-profile-tab">
                                    <form id="" action="<?php echo e(route('profile_update')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="profile_img_box">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail imageContainer">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->profile->pic != null): ?>
                                                                <img src="<?php echo e(asset('storage/uploads/company/' . auth()->user()->profile->company_logo)); ?>" alt="profile pic">
                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('storage/uploads/users/no_avatar.jpg')); ?>" alt="profile pic">
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                        <div>
                                                            <span class="btn btn-default btn-file">
                                                            <span class="fileinput-new">Upload Photo</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input id="company_pic" name="company_logo" type="file" accept="image/*" class="form-control" onchange="displaySelectedImage(this)">                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile_details_box">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="heading mt-5 mb-5">
                                                                <h5>Company Information</h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="company-name" class="form-label input_labels p-18">Company Name</label>
                                                                <input type="text" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_name" value="<?php echo e(auth()->user()->profile->company_name??""); ?>" id="company-name">
                                                            </div>
                                                        </div>






                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="company-address" class="form-label input_labels p-18">Company Address<span class="text-danger">*</span></label>
                                                                <textarea class="form-control clr_textarea_fields borderRadius" row="2" name="company_address" type="text" id="company_address" required><?php echo e(auth()->user()->profile->company_address??''); ?></textarea>
                                                                <input type="hidden" name="company_latitude" value="<?php echo e(old('latitude',  auth()->user()->profile->company_latitude ??'')); ?>" class="form-control clr_input_fields borderRadius" id="company_latitude">
                                                                <input type="hidden" name="company_longitude" value="<?php echo e(old('longitude', auth()->user()->profile->company_longitude ??'')); ?>" class="form-control clr_input_fields borderRadius" id="company_longitude">
                                                                <input type="hidden" name="company_city" value="<?php echo e(old('city',auth()->user()->profile->company_city ??'')); ?>" id="company_city">
                                                                <input type="hidden" name="company_state" value="<?php echo e(old('state', auth()->user()->profile->company_state ??'')); ?>" id="company_state">
                                                                <input type="hidden" name="company_postal_code" value="<?php echo e(old('postal_code', auth()->user()->profile->company_postal_code ??'')); ?>" id="company_postal_code">
                                                                <input type="hidden" name="company_country" value="<?php echo e(old('country', auth()->user()->profile->company_country ??'')); ?>" id="company_country">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="company-email" class="form-label input_labels p-18">Company Email</label>
                                                                <input type="email" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_email" value="<?php echo e(auth()->user()->profile->company_email??""); ?>" id="company-email">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="company-phone" class="form-label input_labels p-18">Phone</label>
                                                                <input type="tel" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_phone" value="<?php echo e(auth()->user()->profile->company_phone??""); ?>" id="company-phone">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="company-website" class="form-label input_labels p-18">Website</label>
                                                                <input type="text" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_website" value="<?php echo e(auth()->user()->profile->company_website??""); ?>" id="company-website">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="license-number" class="form-label input_labels p-18"> License Numbers</label>
                                                                <input type="text" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_license_number" value="<?php echo e(auth()->user()->profile->company_license_number??""); ?>" id="license-number">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="company-license" class="form-label input_labels p-18">Company License</label>
                                                                <input type="text" placeholder="Type here..." class="form-control clr_input_fields borderRadius" name="company_license" value="<?php echo e(auth()->user()->profile->company_license??""); ?>" id="company-license">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="submit"  class="btn btn_green borderRadius profile_submit_btn" onclick="this.disabled = true; this.form.submit();"  value="Submit" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo e(env('googleAPI')); ?>"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var latlng = new google.maps.LatLng(latitude, longitude);
                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var address = results[0].formatted_address;
                        }
                    }
                });
            });
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('company_address'));
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var lat = place.geometry.location.lat(), lng = place.geometry.location.lng();
                var geocoder = new google.maps.Geocoder();
                document.getElementById('company_latitude').value = lat;
                document.getElementById('company_longitude').value = lng;
                // Reverse geocode to get address components
                geocoder.geocode({ 'latLng': new google.maps.LatLng(lat, lng) }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK && results[0]) {
                        results[0].address_components.forEach(function(component) {
                            var types = component.types;
                            if (types.includes('locality')) document.getElementById('company_city').value = component.long_name;
                            if (types.includes('administrative_area_level_1')) document.getElementById('company_state').value = component.long_name;
                            if (types.includes('postal_code')) document.getElementById('company_postal_code').value = component.long_name;
                            if (types.includes('country')) document.getElementById('company_country').value = component.long_name;
                        });
                    }
                });
            });
        });

    </script>
    <script>
        function displaySelectedImage(input) {
            var container = $(input).closest('.fileinput').find('.imageContainer');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    container.html('<img src="' + e.target.result + '">');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\FaizanProjects\leadupupdated\leadup_thebackendprojects\resources\views/admin/profile.blade.php ENDPATH**/ ?>