@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <section class="section">
                        <div class="columns">
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-header has-background-primary">
                                        <span class="card-header-title has-text-white">
                                            Credits Left
                                        </span>
                                    </div>
                                    <div class="card-content">
                                        <span class="is-size-4">
                                            {{ auth()->user()->allowed }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-header has-background-primary">
                                        <span class="card-header-title has-text-white">
                                            Credits Used
                                        </span>
                                    </div>
                                    <div class="card-content">
                                        <span class="is-size-4">
                                            {{ auth()->user()->recieved }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="card">
                            <div class="card-header has-background-grey-lighter">
                                <div class="card-header-title">
                                    Account Information
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-container">
                                    <table class="table is-fullwidth">
                                        <tbody>
                                            <tr>
                                                <td>Email:</td>
                                                <td>{{ auth()->user()->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created at:</td>
                                                <td>{{ auth()->user()->created_at->toFormattedDateString() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-header-title has-background-grey-lighter">
                                    Order History
                                </span>
                            </div>
                            <div class="card-content">
                                <div class="table-container">
                                    <table class="table is-fullwidth is-hoverable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Amount</th>
                                                <th>Made at</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(auth()->user()->orders as $order)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $order->code }}</td>
                                                    <td>{{ $order->amount }}$</td>
                                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                                    <td>
                                                        @if ($order->completed)
                                                            <span class="tag is-success">Successful</span>
                                                        @else
                                                            <span class="tag is-danger">Failed</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="has-text-centered">No order history</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
