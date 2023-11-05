@extends('layouts.index')

@section('content')
<div class="container">
<img src="{{ asset('images/input-booking.png') }}" style="border-radius: 10px;">
<hr>
    <div class="row container">
        <div class="container1" style="display: inline-block;">
            <h4 style="font-weight: 700">Booking Details</h4> <br>
            <form method="POST" action="{{ route('processbookingreq') }}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col">
                        <b>Booking type</b>
                    </div>
                    <div class="col text-center">
                        <div class="row">
                            <input type="radio" id="type1" name="bookingType" value="Rent" checked="checked" onchange="toggleEndDate()">
                            <label for="type1">Rent Fleet</label>
                        </div>
                        <div class="row">
                            <input type="radio" id="type2" name="bookingType" value="Pickup/Dropoff" onchange="toggleEndDate()">
                            <label for="type2">Pickup/Dropoff</label>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <b>Vehicle Type</b>
                    </div>
                    <div class="col">
                        <b>Quantity</b>
                    </div>
                </div>
                @foreach($vehicleTypes as $vehicleType)
                <div class="row">
                    <div class="col" style="padding: 5px;">
                        {{ $vehicleType->vehicle_Type }}
                    </div>
                    <div class="col" style="padding: 5px;">
                        <input type="number" name="TypeQuantity[{{ $vehicleType->vehicle_Type_ID }}]" value="1" min="1">
                    </div>
                </div>
                @endforeach

                <div class="row">
                    <div class="col">
                        <i class="fas fa-map-marker-alt"></i> Location
                    </div>
                    <div class="col" >
                        <select id="location" name="location" style="width: 100%">
                            @foreach($tariffData as $t)
                            <option data-booking-types="{{ json_encode($t->booking_types) }}" data-rate-per-day="{{ $t->rate_Per_Day }}" data-do-pu="{{ $t->do_pu }}" value="{{ $t->location }}">{{ $t->location }}</option>
                            @endforeach
                        </select>                        
                    </div>
                </div> 
                                                        
                <input type="hidden" id="rate_Per_Day" value="{{ $tariffData->first()->rate_Per_Day }}" readonly>
                <input type="hidden" id="do_pu" value="{{ $tariffData->first()->do_pu }}" readonly>

                <br>
                <div class="row container1" style="background: none;box-shadow:none;">
                    <div class="col">
                        <i class="fas fa-calendar-alt"></i> Schedule Date  <hr>
                        <div class="row">
                        <div class="col">
                            Schedule Date <input type="date" name="StartDate" id="StartDate" required>
                        </div>
                        <div class="col" id="enddatecol">
                            Return Date <input type="date" name="EndDate" id="EndDate" required>
                        </div>
                        </div><hr>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col">
                        </i> Subtotal: <span id="subtotal">0.00</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        </i> Downpayment Fee (10%): <span id="downpayment">0.00</span>
                    </div>
                </div>
                <div class="row container1" style="background: none;box-shadow:none;">
                    <div class="col">
                        <i class="fas fa-user"></i> Full Name 
                        <div class="row">
                            <div class="col">
                                First Name <input type="text" name="FirstName" required>
                            </div>
                            <div class="col">
                                Last Name <input type="text" name="LastName" required>
                            </div>
                        </div> <hr>
                    </div> 
                </div>
                <br>

                <div class="row">
                    <div class="col">
                        <i class="fas fa-envelope"></i> Email Address
                    </div>
                    <div class="col">
                        <input name="Email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fas fa-phone"></i> Phone Number
                    </div>
                    <div class="col">
                        <input name="MobileNum" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <i class="fas fa-map-pin"></i> Pickup Address
                    </div>
                    <div class="col">
                        <input name="PickUpAddress" required>
                    </div>
                </div> 
                <div class="row">
                    <div class="col" style="margin-left:-12px">
                        <i class="fas fa-clock"></i> Pickup Time
                    </div>
                    <div class="col">
                        <input type="time" name="PickupTime" style="margin-left:8px;width: 173px" required>
                    </div>
                </div>
                 <br>
                <div class="col">
                    <div class="col">
                        <i class="fas fa-sticky-note"></i> Additional Notes
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="5" name='Note'></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-bookmark"></i> <strong>Book Now </strong></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <input type="checkbox">
                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#termsModal" style="color: #f96332;font-size:13px;">
                            <u>Terms and Conditions</u>
                        </button>
                    </div>
                </div>                
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@include('customers.termsModal')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Get references to the Start Date and End Date input elements
        var startDateInput = document.getElementById('StartDate');
        var endDateInput = document.getElementById('EndDate');

        // Get the current date in ISO format (YYYY-MM-DD)
        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 1); // Set currentDate to tomorrow

        // Convert currentDate to ISO format (YYYY-MM-DD)
        var isoDate = currentDate.toISOString().split('T')[0];

        // Set the minimum date for Start Date to tomorrow's date
        startDateInput.min = isoDate;

        // Get references to the checkbox and "Book Now" button
        var checkbox = document.querySelector('input[type="checkbox"]');
        var bookNowButton = document.querySelector('button[type="submit"]');

        // Disable the "Book Now" button initially
        bookNowButton.disabled = true;

        // Add an event listener to enable/disable the "Book Now" button based on the checkbox
        checkbox.addEventListener('change', function () {
            bookNowButton.disabled = !checkbox.checked;
        });

        // Add an event listener to disable dates before the selected Start Date in End Date
        startDateInput.addEventListener('change', function () {
            var selectedStartDate = new Date(startDateInput.value);
            selectedStartDate.setDate(selectedStartDate.getDate()); // Add one day
            var minEndDate = selectedStartDate.toISOString().split('T')[0];
            endDateInput.min = minEndDate;
            endDateInput.value = ''; // Reset End Date

            // Disable the "Book Now" button if the checkbox is not checked
            if (!checkbox.checked) {
                bookNowButton.disabled = true;
            }
        });

        // Add an event listener to update the tariff values when the location changes
        document.getElementById('location').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('rate_Per_Day').value = selectedOption.getAttribute('data-rate-per-day');
            document.getElementById('do_pu').value = selectedOption.getAttribute('data-do-pu');
            calculateSubtotal();
        });

        // Add event listeners to input elements that affect calculations
        const inputElements = document.querySelectorAll('input, select');
        inputElements.forEach((input) => {
            input.addEventListener('input', calculateSubtotal);
        });

        // Validation function to check if all required input fields have values
        function validateInputs() {
            const bookingType = document.querySelector('input[name="bookingType"]:checked');
            const bookingTypeValue = bookingType.value;
            const location = document.getElementById('location').value;
            const startDate = document.getElementById('StartDate').value;
            const endDate = document.getElementById('EndDate').value;

            // Additional input elements that need validation
            const vehicleTypeInputs = document.querySelectorAll('input[name^="TypeQuantity"]');
            
            if (bookingTypeValue === 'Rent') {
                // Check if any of the required fields is empty
                if (!bookingType || !location || !startDate || !endDate || vehicleTypeInputs.length === 0 || Array.from(vehicleTypeInputs).some(input => input.value === '')) {
                    return false; // Validation failed
                }
            }
            else if (bookingTypeValue === 'Pickup/Dropoff') {
                if (!bookingType || !location || !startDate || vehicleTypeInputs.length === 0 || Array.from(vehicleTypeInputs).some(input => input.value === '')) {
                return false; // Validation failed
            } 
            }
            return true;//Validation passed
        }
        // Function to calculate the subtotal
        function calculateSubtotal() {
            // Check if all required fields are filled
            if (validateInputs()) {
                var bookingType = document.querySelector('input[name="bookingType"]:checked').value;
                var location = document.getElementById('location').value;
                
                // Get the selected vehicle quantities
                var quantities = {};
                var vehicleTypeInputs = document.querySelectorAll('input[name^="TypeQuantity"]');
                vehicleTypeInputs.forEach((input) => {
                    quantities[input.name] = parseInt(input.value);
                });

                var startDate = new Date(document.getElementById('StartDate').value);
                var endDate, daysToRent;
                var tariff;
                if(bookingType === 'Rent'){    
                    endDate = new Date(document.getElementById('EndDate').value);

                    daysToRent = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;

                    tariff = parseFloat(document.getElementById('rate_Per_Day').value);
                } else if (bookingType === 'Pickup/Dropoff'){
                    daysToRent = 1;
                    tariff = parseFloat(document.getElementById('do_pu').value);
                }

                // Calculate subtotal
                var subtotal = tariff * daysToRent * Object.values(quantities).reduce((a, b) => a + b, 0);

                // Handle NaN case by replacing with 0
                if (isNaN(subtotal)) {
                    subtotal = 0;
                }

                // Ensure subtotal is not negative
                if (subtotal < 0) {
                    subtotal = 0;
                }

                var downpayment = subtotal * 0.10;

                // Display the subtotal
                document.getElementById('subtotal').textContent = subtotal.toFixed(2);
                document.getElementById('downpayment').textContent = downpayment.toFixed(2);
            }else {
                document.getElementById('subtotal').textContent = 0.00;
                console.log('calculation incomplete!');
            }
        }
    });

    var tariffData = @json($tariffData);

    function toggleEndDate() {
        const rentRadio = document.getElementById('type1');
        const pickupDropoffRadio = document.getElementById('type2');
        const endDateCol = document.getElementById('enddatecol');
        const endDateInput = document.getElementById('EndDate');
        const locationDropdown = document.getElementById('location');
        
        if (pickupDropoffRadio.checked) {
            // Hide the End Date input field and label column when "Pickup/Dropoff" is selected
            endDateCol.style.display = 'none';
            endDateInput.setAttribute('disabled', true);
            endDateInput.removeAttribute('required');

            // Filter and populate the location dropdown with Pickup/Dropoff category
            locationDropdown.innerHTML = '';
            tariffData.forEach(function(tariff) {
                if (tariff.do_pu) {
                    const option = document.createElement('option');
                    option.text = tariff.location;
                    option.value = tariff.location; // Set the option's value, if needed
                    option.setAttribute('data-booking-types', JSON.stringify(tariff.booking_types));
                    option.setAttribute('data-rate-per-day', tariff.rate_Per_Day);
                    option.setAttribute('data-do-pu', tariff.do_pu);
                    locationDropdown.add(option);
                }
            });
        } else {
            // Show the End Date input field and label column when "Rent" is selected
            endDateCol.style.display = 'block';
            endDateInput.removeAttribute('disabled');
            endDateInput.setAttribute('required', true);

            // Filter and populate the location dropdown with Rent category
            locationDropdown.innerHTML = '';
            tariffData.forEach(function(tariff) {
                if (tariff.rate_Per_Day) {
                    const option = document.createElement('option');
                    option.text = tariff.location;
                    option.value = tariff.location; // Set the option's value, if needed
                    option.setAttribute('data-booking-types', JSON.stringify(tariff.booking_types));
                    option.setAttribute('data-rate-per-day', tariff.rate_Per_Day);
                    option.setAttribute('data-do-pu', tariff.do_pu);
                    locationDropdown.add(option);
                }
            });
        }
    }
</script>





