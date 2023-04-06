@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('notification')}}" method="POST">
                        @csrf
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="title">
                        <label for="message">Message</label>
                        <textarea  id="message" name="message" class="form-control" placeholder="Message"></textarea>
                        <button type="submit" class="btn btn-primary mt-1">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
