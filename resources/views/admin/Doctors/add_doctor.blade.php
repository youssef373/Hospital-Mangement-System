<!DOCTYPE html>
<html lang="en">
@include('admin.head')
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
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.navbar')
    <!-- partial -->
    <div class="main-panel" style="margin-top: 100px; margin-right: 500px;">
        @if(session()->has('message'))
            <div class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
        <form action="{{url('add_doctor')}}" enctype="multipart/form-data" method="post">

            @csrf

        <div class="input-group">
            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
            <input style="color: black; background-color: white" type="text" name="name" class="form-control" placeholder="Doctor name">
        </div>

        <div class="input-group mt-6">
            <label class="col-sm-2 col-form-label">Phone</label>
            <input style="color: black; background-color: white" type="number" name="phone" class="form-control" placeholder="Doctor number">
        </div>

        <div class="input-group mt-6">
            <label class="col-sm-2 col-form-label">Speciality</label>
            <select class="form-control" style="color: black; background-color: white" name="speciality">
                <option value="">--Select--</option>
                <option>Skin</option>
                <option>Brain</option>
                <option>Eyes</option>
                <option>Heart</option>
            </select>
        </div>

        <div class="input-group mt-6">
            <label class="col-sm-2 col-form-label">Room </label>
            <input style="color: black; background-color: white" type="number" name="room" class="form-control" placeholder="Room">
        </div>

            <div class="input-group mt-6">
                <label class="col-sm-2 col-form-label">Image</label>
                <input name="image" type="file">
            </div>

        <div class="input-group mt-6" style="margin-left: 200px">
            <input class="btn btn-success" style="" type="submit">
        </div>
        </form>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
