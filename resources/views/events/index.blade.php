<!-- resources/views/events/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md">
            <h2>Event List</h2>
        </div>


        <div id="events-container">
            <!-- Data events akan ditampilkan di sini -->
        </div>
        <hr>
        <table id="Events" class="">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Description</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Organizer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ $event->event_description }}</td>
                        <td>{{ $event->event_date }}</td>
                        <td>{{ $event->event_time }}</td>
                        <td>Rp.{{ $event->event_price }},-</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->organizer }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('events.destroy', $event->event_id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('events.create') }}" class="btn btn-success">Create</a>

        <script>
            $(document).ready(function() {  
                new DataTable("#Events");
                // $.ajax({
                //     url: '/api/events',
                //     type: 'GET',
                //     dataType: 'json',
                //     success: function(response) {
                //         // Tampilkan data events dalam div events-container
                //         var eventsArray = JSON.parse(JSON.stringify(response));
                //         console.log(eventsArray);
                //         new DataTable("#Events", {
                //             ajax: eventsArray,
                //         });
                //     },
                //     error: function(error) {
                //         console.error('Error fetching events:', error);
                //     }
                // });

                // function displayEvents(events) {
                //     var eventsContainer = $('#events-container');
                //     eventsContainer.empty(); // Bersihkan konten sebelum menambahkan yang baru

                //     // Loop melalui setiap event dan tambahkan ke dalam div
                //     $.each(events, function(index, event) {
                //         eventsContainer.append('<p>' + event.event_name + '</p>');
                //     });
                // }
            });
        </script>
    </div>
@endsection
