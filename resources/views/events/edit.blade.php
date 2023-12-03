<!-- resources/views/events/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Event</h2>

        <form action="{{ route('events.update', $event->event_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="event_name">Event Name</label>
                <input type="text" name="event_name" value="{{ $event->event_name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="event_description">Event Description</label>
                <textarea name="event_description" class="form-control" required>{{ $event->event_description }}</textarea>
            </div>

            <div class="form-group">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" value="{{ $event->event_date }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="event_time">Event Time</label>
                <input type="time" name="event_time" value="{{ $event->event_time }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="location">Amount</label>
                <input type="number" name="event_price" class="form-control" value="{{ $event->event_price }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" value="{{ $event->location }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="organizer">Organizer</label>
                <input type="text" name="organizer" value="{{ $event->organizer }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>
    </div>
@endsection
