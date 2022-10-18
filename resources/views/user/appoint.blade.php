
<div class="page-section">
    <div class="container">
        <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

        <form class="main-form" action="{{url('create_appoint')}}" method="post">
            @csrf
            <div class="row mt-5 ">
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input name="name" type="text" class="form-control" placeholder="Full name">
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input name="email" type="text" class="form-control" placeholder="Email address..">
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
                    @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input name="date" type="date" class="form-control">
                </div>
                <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
                    @error('doctor')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <select name="doctor" class="custom-select">
                        <option value="">General health</option>
                       @foreach($doctors as $doctor)
                           <option value="{{$doctor->speciality}}">{{$doctor->name}}( {{$doctor->speciality}} )</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    @error('phone')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <input name="phone" type="text" class="form-control" placeholder="Number..">
                </div>
                <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
                    @error('message')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
                </div>

            </div>
            <input name="submit" type="submit" class="btn btn-primary mt-3">
        </form>
    </div>
</div>
