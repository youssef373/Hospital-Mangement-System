<!DOCTYPE html>
<html lang="en">
<?php echo $__env->make('admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
            <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                <div class="ps-lg-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                        <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
                    <button id="bannerClose" class="btn border-0 p-0">
                        <i class="mdi mdi-close text-white me-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <?php echo $__env->make('admin.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="main-panel" style="margin-top: 100px; margin-right: 500px;">
        <?php if(session()->has('message')): ?>
            <div class="alert alert-<?php echo e(session()->get('status')); ?>" role="alert">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>
        <form action="<?php echo e(url('update_doctor', $doctor->id)); ?>" enctype="multipart/form-data" method="post">

            <?php echo csrf_field(); ?>

            <div class="input-group">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <input style="color: black; background-color: white" type="text" name="name" class="form-control" value="<?php echo e($doctor->name); ?>">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Phone</label>
                <input style="color: black; background-color: white" type="number" name="phone" class="form-control" value="<?php echo e($doctor->phone); ?>">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Speciality</label>
                <select class="form-control" style="color: black; background-color: white" name="speciality">
                    <option value="<?php echo e($doctor->speciality); ?>"><?php echo e($doctor->speciality); ?></option>
                    <option>Skin</option>
                    <option>Brain</option>
                    <option>Eyes</option>
                    <option>Heart</option>
                </select>
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Room </label>
                <input style="color: black; background-color: white" type="number" name="room" class="form-control" value="<?php echo e($doctor->room); ?>">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Image</label>
                <input name="image" type="file">
            </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Current Image</label>
                <img style="height: 100px; width: 100px;" src="./doctorimage/<?php echo e($doctor->image); ?>" alt="">
            </div>

            <div class="input-group mt-6" style="margin-left: 200px">
                <input value="update" name="update" class="btn btn-success" style="" type="submit">
            </div>
        </form>
    </div>
    <!-- plugins:js -->
    <?php echo $__env->make('admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\hospital\resources\views/admin/Doctors/update_doctor.blade.php ENDPATH**/ ?>