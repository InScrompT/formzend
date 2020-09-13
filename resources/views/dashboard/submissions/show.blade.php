@extends('layouts.app')

@section('title', 'Show Submission - Dashboard')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script>
        function stillDev() {
            swal(
                'Hold up chief!',
                'You discovered a feature that is still under development. Follow me on twitter to be on the know',
                'warning'
            );
        }
    </script>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-title">Form Data</div>
                        </div>
                        <div class="card-content">
                            <table class="table is-fullwidth is-hoverable">
                                <thead>
                                    <th>Field Name</th>
                                    <th>Field Value</th>
                                </thead>
                                <tbody>
                                    @foreach ($submission->data as $key => $value)
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="#" onclick="stillDev()" class="card-footer-item">
                                Archive
                            </a>
                            <a href="#" onclick="stillDev()" class="card-footer-item">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
