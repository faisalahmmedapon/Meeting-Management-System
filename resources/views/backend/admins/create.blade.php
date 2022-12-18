@extends('backend.layouts.app')

@section('title')
    Admin Create
@endsection

@push('css')
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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
                                                class="get_success d-none  lni lni-checkmark-circle float-end bg-success"></i>
                                        </label>
                                        <input type="text" name="post_code" class="form-control"
                                            value="{{ old('post_code') }}" id="post_code">

                                    </div>
                                    {{-- <div class="get_success d-none">
                                        <i class="get_success d-none lni lni-heart-filled"></i>
                                    </div> --}}
                                    <ul class="list-group getAllData p-2"></ul>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group autocompleteArea ">
                                        <label>Location/City/Address</label>
                                        <input type="text" name="location" id="autocomplete" class="form-control"
                                            placeholder="Choose Location" value="{{ old('autocomplete') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="latitudeArea">
                                        <label>Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control"
                                            value="{{ old('latitude') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group" id="longtitudeArea">
                                        <label>Longitude</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control"
                                            value="{{ old('longitude') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="distanceArea">
                                        <label>Distance</label>
                                        <input type="text" name="distance" id="distance" class="form-control"
                                            value="{{ old('distance') }}">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
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
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="phone"> Phone: </label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="+17975777666||+447975777666" id="phone">

                                        <span class="phone_valid d-none text-success"> Phone is valid </span> <span
                                            class="phone_not_valid d-none text-danger"> Phone is
                                            not valid </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group p-2">
                                        <label for="landline"> Land Line: </label>
                                        <input type="text" name="landline" class="form-control"
                                            placeholder="01992 252141" id="landline">
                                        <span class="landline_valid d-none text-success"> Landline is valid </span> <span
                                            class="landline_not_valid d-none text-danger"> Landline is
                                            not valid </span>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
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
                                </div> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
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
                        // console.log(response.status);

                        if (response.status == 200) {
                            // alert('post code match our database');


                            var html = '';
                            $.each(response.data, function(key, item) {
                                // console.log(item.postcode)
                                html += '<li class="list-group-item">' + item.postcode +
                                    ' </li>'
                                const string = item.postcode.replace(/\s/g, '')
                                    .toLowerCase();
                                // console.log(string);
                                if (string === postCode) {
                                    // alert('Sorry Post code not found')
                                    // $(".getAllData").addClass("d-none");
                                    $(".get_success").removeClass("d-none");
                                    $('#latitude').val(item.latitude);
                                    $('#longitude').val(item.longitude);
                                    $("#latitudeArea").removeClass("d-none");
                                    $("#longtitudeArea").removeClass("d-none");
                                    $(".autocompleteArea").removeClass("d-none");
                                    $(".getAllData").addClass("d-none");
                                    GetAddress(item.latitude, item.longitude);
                                    getDistanceFromLatLonInKm(item.latitude, item
                                        .longitude);
                                } else if (item.postcode === postCode) {
                                    $(".get_success").removeClass("d-none");
                                    $('#latitude').val(item.latitude);
                                    $('#longitude').val(item.longitude);
                                    $("#latitudeArea").removeClass("d-none");
                                    $("#longtitudeArea").removeClass("d-none");
                                    $(".autocompleteArea").removeClass("d-none");
                                    $(".getAllData").addClass("d-none");
                                    GetAddress(item.latitude, item.longitude);
                                    getDistanceFromLatLonInKm(item.latitude, item
                                        .longitude);
                                } else {
                                    // console.log('Nothing')
                                }
                            });
                            $('.getAllData').html(html);


                            // $('#latitude').val(item.latitude);
                            // $('#longitude').val(item.longitude);

                            // $("#latitudeArea").removeClass("d-none");
                            // $("#longtitudeArea").removeClass("d-none");

                        } else {
                            Swal.fire({
                                title: 'Opps!',
                                text: "The post code dose not valid",
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonColor: '#880808',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Try Again!'
                            }).then((result) => {
                                if (result) {
                                    $('#latitude').val("");
                                    $('#longitude').val("");
                                    $('#autocomplete').val("");
                                    $('#distance').val("");

                                    // $(".getAllData").addClass("d-none");
                                }
                            })
                        }
                    }
                });

            });
        });


        // const dddd = $('#post_code').val();

        // if (dddd == "") {
        //     Swal.fire({
        //         title: 'Opps!',
        //         text: "The post code dose not valid",
        //         icon: 'error',
        //         showCancelButton: false,
        //         confirmButtonColor: '#880808',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Try Again!'
        //     }).then((result) => {
        //         if (result) {
        //             $('#latitude').val("");
        //             $('#longitude').val("");
        //             $('#autocomplete').val("");

        //             // $(".getAllData").addClass("d-none");
        //         }
        //     })
        // }


        function GetAddress(lat, lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        // var input = document.getElementById('autocomplete');
                        $('#autocomplete').val(results[1].formatted_address);
                    }
                }
            });
        }



        function getDistanceFromLatLonInKm(lat, lon) {
            const EARTH_RADIUS = 6371; // Radius of the earth in km
            // Here's where you would add the value dynamically from the DB.
            // I'm using classic ASP here just as an example. You'll have to
            // amend for your particular server side web framework, be it
            // JSP, MVC, etc.
            const LAT1 = "51.531331";
            const LON1 = "0.00322";
            // console.log(LAT1, LON1, lat, lon);

            var dLat = deg2rad(lat - LAT1);
            var dLon = deg2rad(lon - LON1);
            var a = Math.pow(Math.sin(dLat / 2), 2) + Math.cos(deg2rad(LAT1)) * Math.cos(deg2rad(LON1)) * Math.pow(Math.sin(
                dLon / 2), 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = EARTH_RADIUS * c; // Distance in km

            const kilometers = d;
            const factor = 0.621371
            const miles = kilometers * factor


            $('#distance').val(Math.floor(miles));

            console.log(Math.floor(miles));
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180);
        }
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

    <script>
        var phone = $('#phone').val();

        // function phonenumber(phone) {
        //     var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        //     if (phone.match(phoneno)) {
        //         return true;
        //     } else {
        //         alert("message");
        //         return false;
        //     }
        // }

        // $(document).ready(function() {
        //     $('#phone').blur(function(e) {
        //         if (validatePhone('phone')) {
        //             $('#spnPhoneStatus').html('Valid');
        //             $('#spnPhoneStatus').css('color', 'green');
        //         } else {
        //             $('#spnPhoneStatus').html('Invalid');
        //             $('#spnPhoneStatus').css('color', 'red');
        //         }
        //     });
        // });

        // function validatePhone(phone) {
        //     var a = document.getElementById(phone).value;
        //     var filter = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        //     if (filter.test(a)) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }



        // validMobileNumber("123"); //.to.equal(false);
        // validMobileNumber("0750617250638"); //.to.equal(false);
        // validMobileNumber("+447712368768724988"); //.to.equal(false);

        // validMobileNumber("07506172506"); //.to.equal(true);

        // validMobileNumber("+447506172506"); //.to.equal(true);

        // validMobileNumber("00447506172506"); //.to.equal(true);

        // validMobileNumber("07506189foo"); //.to.equal(false);
        // validMobileNumber("00447555123456"); //.to.equal(true);
        // validMobileNumber("+447676111222"); //.to.equal(true);
        // validMobileNumber("07898888643"); //.to.equal(true);
        // validMobileNumber("07766555432"); //.to.equal(true);
        // validMobileNumber("07989765490"); //.to.equal(true);

        // validMobileNumber("004475551&&&23456"); //.to.equal(false);
        // validMobileNumber("-447676111222"); //.to.equal(false);
        // validMobileNumber("09898888643"); //.to.equal(false);
        // validMobileNumber("+449166555432"); //.to.equal(false);
        // validMobileNumber("cats"); //.to.equal(false);

        // validMobileNumber(phone);
        // $(document).ready(function(e) {
        //     e.preventDefault();
        //.to.equal(false);

        // $('#phone').keypress(function(event) {
        //     var keycode = $('#phone').val();
        //     console.log(keycode)
        // });

        $(document).click(function() {
            var keycode = $('#phone').val();
            // console.log(keycode)
            keycode = keycode.replace(/\s/g, '');
            var mobileRegEx = /^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/;
            var mobileRegEx2 = /^(\+1\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/;
            var result = mobileRegEx.test(keycode) || mobileRegEx2.test(keycode);
            if (result == true) {
                $('.phone_valid').removeClass("d-none");
                $('.phone_not_valid').addClass("d-none");
                // console.log(result);
            } else {
                $('.phone_valid').addClass("d-none");
                $('.phone_not_valid').removeClass("d-none");
                // console.log(result);
            }
        });

        $(document).click(function() {
            var keycode = $('#landline').val();
            // console.log(keycode)
            keycode = keycode.replace(/\s/g, '');
            // var landlineRegEx = /\s*\(?(0[1-6]{1}[0-9]{3}\)?[0-9]{6})\s*/;
            var landlineRegEx = /^0(\d ?){10}$/;
            var result = landlineRegEx.test(keycode);
            if (result == true) {
                $('.landline_valid').removeClass("d-none");
                $('.landline_not_valid').addClass("d-none");
                // console.log(result);
            } else {
                $('.landline_valid').addClass("d-none");
                $('.landline_not_valid').removeClass("d-none");
                // console.log(result);
            }
        });



        // });
    </script>
@endpush
{{-- <li class="list-group-item">An item</li> --}}
