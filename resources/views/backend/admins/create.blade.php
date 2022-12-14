@extends('backend.layouts.app')

@section('title')
    Admin Create
@endsection

@push('css')
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 col-md-12 col-lg-12 d-flex justify-content-end">
                    <span class="badge bg-success"><a href="{{ route('admins.index') }}"> Admin Lists </a></span>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row  py-5">
                <div class="col-12 col-sm-6 col-md-12 mx-auto">
                    <div class=" p-3">
                        <form action="{{ route('admins.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="post_code">Post Code: <i
                                                class="get_success d-none lni lni-heart-filled float-end"></i> </label>
                                        <input type="text" name="post_code" class="form-control"
                                            value="{{ old('post_code') }}" id="post_code">

                                    </div>
                                    {{-- <div class="get_success d-none">
                                        <i class="get_success d-none lni lni-heart-filled"></i>
                                    </div> --}}
                                    <ul class="list-group getAllData p-2"></ul>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location/City/Address</label>
                                        <input type="text" name="location" id="autocomplete" class="form-control"
                                            placeholder="Choose Location" value="{{ old('autocomplete') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="latitudeArea">
                                        <label>Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control" value="{{ old('latitude') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" id="longtitudeArea">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="name">Name: </label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" id="name">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="email"> Email: </label>
                                        <input type="text" name="email" class="form-control"
                                            value="{{ old('email') }}" id="email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="phone"> Phone: </label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone') }}" id="phone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password"> Password: </label>
                                        <input type="text" name="password" class="form-control"
                                            value="{{ old('password') }}" id="password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password_confirmation"> Confirm Password: </label>
                                        <input type="text" name="password_confirmation" class="form-control"
                                            value="{{ old('password_confirmation') }}" id="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="password_confirmation"> Role: </label>
                                        <select class="multiple-select select2-hidden-accessible" multiple=""
                                            tabindex="-1" aria-hidden="true" name="roles[]">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <button type="submit" class="btn btn-success px-5"><i
                                                class="fa ">Submit</i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjR14OREWodXlFSAi-S78TwQG5XhGILdg&libraries=places">
    </script>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#post_code').on('keyup', function() {

                var postCode = $('#post_code').val();

                // if (postCode.length > 7) {
                //     alert('Sorry Post code not found')
                // }


                $.ajax({
                    type: "GET",
                    url: "/postCode/" + postCode,
                    // dataType: 'json',
                    success: function(response) {
                        // if(response == null){
                        // console.log('Data not found');
                        // }
                        // console.log(response.data);


                        var html = '';
                        $.each(response.data, function(key, item) {
                            // console.log(item.postcode)
                            html += '<li class="list-group-item">' + item.postcode +
                                ' </li>'

                            if (item.postcode === postCode) {
                                // alert('Sorry Post code not found')
                                $(".getAllData").addClass("d-none");
                                $(".get_success").removeClass("d-none");

                                $('#latitude').val(item.latitude);
                                $('#longitude').val(item.longitude);

                                $("#latitudeArea").removeClass("d-none");
                                $("#longtitudeArea").removeClass("d-none");
                                calculateDistance();
                            }
                        })
                        $('.getAllData').html(html);
                    }
                });
            });

            function calculateDistance() {
                var to = "Dhaka, Bangladesh";
                var from =  $('#autocomplete').val();;
                var distance = new google.maps.DistanceMatrixService();
                distance.getDistanceMatrix({
                    origins: [to],
                    destinations: [from],
                    travelMode: google.maps.travelMode.DRIVING,
                    unitSystem: google.maps.unitSystem.metric,
                    avoidHighways: false,
                    avoidTolls: false
                }, callback);
            }

            function callback(respanse, status) {
                if (status != google.maps.DistanceMatrixStatus.ok) {
                    console.log('Somthing went wrong');
                } else {
                    if (respanse.rows[0].elements[0].status == "ZERO_RESULTS") {
                        console.log("NO RODES")
                    } else {
                        var ddddddd = respanse.rows[0].elements[0].distance;
                        console.log(ddddddd);
                    }
                }
            }

            // function calculateDistance() {
            //     // try {
            //     //     var glatlng1 = new GLatLng(51.449904, 0.308232);
            //     //     var glatlng2 = new GLatLng(51.448392, 0.30784);
            //     //     var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
            //     //     var kmdistance = (miledistance * 1.609344).toFixed(1);
            //     //     console.log(kmdistance);
            //     //     //Write the value wherever you want!
            //     //     // $('#mile_distance').html(miledistance);
            //     // } catch (error) {
            //     //     alert(error);
            //     // }

            //     $.gproximity('Flagpole Plaza NY 10004', [40.6892282, -74.1145403], function(res) {
            //         console.log(res)
            //         // $('.map').html(res + "meter");
            //     });
            // }

        });
    </script>




    <script>
        $(document).ready(function() {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
@endpush
{{-- <li class="list-group-item">An item</li> --}}
