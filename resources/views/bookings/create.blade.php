@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-semibold rounded-top-4">
                    Book Now
                </div>

                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->has('conflict'))
                        <div class="alert alert-danger">{{ $errors->first('conflict') }}</div>
                    @endif

                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Customer Name"  value="{{ old('customer_name') }}">
                            @if ($errors->has('customer_name'))
                                <span class="text-danger">{{ $errors->first('customer_name') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Customer Email</label>
                            <input type="email" name="customer_email" class="form-control" placeholder="Customer Email" value="{{ old('customer_email') }}">
                            @if ($errors->has('customer_email'))
                                <span class="text-danger">{{ $errors->first('customer_email') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Booking Date</label>
                            <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date') }}">
                            @if ($errors->has('booking_date'))
                                <span class="text-danger">{{ $errors->first('booking_date') }}</span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Booking Type</label>
                            <select name="booking_type" id="booking_type" class="form-select">
                                <option value="">--Select Type--</option>
                                <option value="full_day">Full Day</option>
                                <option value="half_day">Half Day</option>
                                <option value="custom">Custom</option>
                            </select>
                            @if ($errors->has('booking_type'))
                                <span class="text-danger">{{ $errors->first('booking_type') }}</span>
                            @endif
                        </div>

                        <div class="mb-3" id="booking_slot_wrapper" style="display: none;">
                            <label class="form-label">Select Slot</label>
                            <select name="booking_slot" id="booking_slot" class="form-select">
                                <option value="first_half">First Half</option>
                                <option value="second_half">Second Half</option>
                            </select>
                            @if ($errors->has('booking_slot'))
                                <span class="text-danger">{{ $errors->first('booking_slot') }}</span>
                            @endif
                        </div>

                        <div class="mb-3" id="time_fields" style="display: none;">
                            <label class="form-label">Custom Time</label>
                            <div class="d-flex gap-2">
                                <input type="time" name="booking_from" class="form-control" value="{{ old('booking_from') }}"> 
                                <span class="align-self-center">to</span>
                                <input type="time" name="booking_to" class="form-control" value="{{ old('booking_to') }}">
                            </div>
                            @if ($errors->has('booking_from'))
                                <span class="text-danger">{{ $errors->first('booking_from') }}</span>
                            @endif
                            @if ($errors->has('booking_to'))
                                <span class="text-danger">{{ $errors->first('booking_to') }}</span>
                            @endif
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Booking Type Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#booking_type').on('change', function () {
        const type = $(this).val();
        $('#booking_slot_wrapper').toggle(type === 'half_day');
        $('#time_fields').toggle(type === 'custom');
    });

</script>
@endsection
