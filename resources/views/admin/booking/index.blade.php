@extends('admin_main')
@section('title', 'Home')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-5 w-full  px-4 py-3 vendor-title">
  <div class="d-flex justify-content-center align-items-center">
    <i class="bi bi-back h4 me-3 vendor-icon "></i>
    <h3>Booking</h3>
  </div>
</div>

@if ($bookings->isEmpty())
    <p>No Booking.</p>
@else
  <table class="table mt-5 table-borderless table-hover table_style">
    <thead class="thead-light header_color text-black">
      <tr>
          <th>No</th>
          <th>Booking ID</th>
          <th>Tour Name</th>
          <th class= "text-center">Customer</th>
          <th class="text-center">Quantity</th>
          <th class= "text-center">Approved</th>
          <th class= "text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bookings as $index => $booking_item)
                  <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $booking_item-> booking_number }}</td>
                      <td>{{ $booking_item-> tours -> first()-> name}}</td>
                      <td class="text-center">{{ $booking_item-> user -> email}}</td>
                      <td class="text-center">{{ $booking_item-> quantity}}</td>
                      <td class="text-center">
                        @if($booking_item -> approved)
                        <i class="bi bi-check-circle text-success"> Approved</i> <!-- Icon for tick -->
                        @else
                        <i class="bi bi-clock text-warning"> Pending</i> <!-- Icon for pending -->
                        @endif
                      </td>
                      <td class="text-center">
                          <a href="{{route ('booking.show', ['booking' => $booking_item ->id])}}" class="btn btn-sm btn-light"><i class="bi bi-eye text-primary font-weight-bold p-3">View</i></a>
                          <form action="{{route ('booking.destroy', ['booking' => $booking_item ->id])}}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-light" onclick="return confirm('Are you sure you want to delete this Booking?')">
                                  <i class="bi bi-trash text-danger">Delete</i>
                                  </button>
                          </form>
                      </td>
                  </tr>

        @endforeach
    </tbody>
  </table>

@endif

@if (session('success'))
<div id="success-alert" class="alert alert-success text-center">
    {{ session('success') }}
</div>
@endif

<script>
    // Hide the success message after 3 seconds
    setTimeout(function () {
        document.getElementById('success-alert').style.display = 'none';
    }, 3000);
</script>

<style>
    #success-alert {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        width: 300px;
    }
</style>

@endsection
