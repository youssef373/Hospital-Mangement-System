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
    <div class="main-panel" style="margin-top: 100px; margin-right: 400px;">
        @if(session()->has('message'))
            <div class="alert alert-{{session()->get('status')}}" role="alert">
                {{session()->get('message')}}
            </div>
        @endif
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
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{$appointment->name}}</td>
                    <td>{{$appointment->email}}</td>
                    <td>{{$appointment->date}}</td>
                    <td>{{$appointment->doctor}}</td>
                    <td>{{$appointment->phone}}</td>
                    <td>{{$appointment->message}}</td>
                    <td>{{$appointment->status}}</td>
                    <td>
                        <a class="btn btn-success" href="{{url('approve_appointment', $appointment->id)}}">Approve</a>
                        <a class="btn btn-primary" href="{{url('cancel_appointment', $appointment->id)}}">Cancel</a>
                        <a onclick="return confirm('are you sure you want to delete this')" class="btn btn-danger" href="{{url('delete_appointment', $appointment->id)}}">Delete</a>
                        <a class="btn btn-primary" href="{{url('email_view', $appointment->id)}}">Send Email</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- plugins:js -->
    @include('admin.script')
</div>
</body>
</html>
