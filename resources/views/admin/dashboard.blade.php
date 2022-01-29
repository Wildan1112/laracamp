@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 pt-4">
                <div class="card">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($checkouts as $checkout)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $checkout->User->name }}</td>
                                        <td>{{ $checkout->Camp->title }}</td>
                                        <td>{{ $checkout->Camp->price }}k</td>
                                        <td>{{ $checkout->created_at->format('d-M-Y') }}</td>
                                        <td>
                                            @if ($checkout->is_paid)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- set button action --}}
                                            @if(!$checkout->is_paid)
                                                <form action="{{ route('admin.checkout.update', $checkout->id) }}" method="post">
                                                    @csrf
                                                    <button class="btn btn-primary btn-sm">Set to Paid</button>
                                                </form>
                                            @endif
                                        </td> 
                                    </tr>
                                    
                                @empty
                                    <tr>
                                        <td collspan="4">No Camps Registered</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection