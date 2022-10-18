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
    <div class="main-panel" style="margin-top: 100px; margin-right: 400px;">
        <?php if(session()->has('message')): ?>
            <div class="alert alert-<?php echo e(session()->get('status')); ?>" role="alert">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>
        <table class="table table-light">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date</th>
                <th scope="col">Doctor</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th style="text-align: center" scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($appointment->name); ?></td>
                    <td><?php echo e($appointment->email); ?></td>
                    <td><?php echo e($appointment->date); ?></td>
                    <td><?php echo e($appointment->doctor); ?></td>
                    <td><?php echo e($appointment->phone); ?></td>
                    <td><?php echo e($appointment->message); ?></td>
                    <td><?php echo e($appointment->status); ?></td>
                    <td>
                        <a class="btn btn-success" href="<?php echo e(url('approve_appointment', $appointment->id)); ?>">Approve</a>
                        <a class="btn btn-primary" href="<?php echo e(url('cancel_appointment', $appointment->id)); ?>">Cancel</a>
                        <a onclick="return confirm('are you sure you want to delete this')" class="btn btn-danger" href="<?php echo e(url('delete_appointment', $appointment->id)); ?>">Delete</a>
                        <a class="btn btn-primary" href="<?php echo e(url('email_view', $appointment->id)); ?>">Send Email</a>

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
<?php /**PATH C:\xampp\htdocs\hospital\resources\views/admin/appointments.blade.php ENDPATH**/ ?>