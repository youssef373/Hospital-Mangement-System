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
    <div class="main-panel" style="margin-top: 100px; margin-right: 400px; text-align: center">
        <?php if(session()->has('message')): ?>
            <div class="alert alert-<?php echo e(session()->get('status')); ?>" role="alert">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>
            <table class="table-bordered" style="padding: 100px; width: 1000px;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Speciality</th>
                    <th>Room</th>
                    <th>Image</th>
                    <th style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($doctor->name); ?></td>
                        <td><?php echo e($doctor->phone); ?></td>
                        <td><?php echo e($doctor->speciality); ?></td>
                        <td><?php echo e($doctor->room); ?></td>
                        <td><img style="width: 140px; height: 100px; margin: auto" src="./doctorimage/<?php echo e($doctor->image); ?>" alt=""></td>
                        <td>
                            <a href="<?php echo e(url('update_doctor_view', $doctor->id)); ?>" class="btn btn-primary">Update</a>
                            <a onclick="return confirm('are you sure you want to delete this')" href="<?php echo e(url('delete_doctor', $doctor->id)); ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
    </div>
    <!-- plugins:js -->
    <?php echo $__env->make('admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\hospital\resources\views/admin/Doctors/show_doctors.blade.php ENDPATH**/ ?>