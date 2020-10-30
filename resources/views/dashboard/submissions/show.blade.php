@extends('layouts.app')

@section('title', 'Show Submission - Dashboard')

@section('content')
    @include('layouts.navbar')

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-3">
                    <div class="card">
                        <div class="card-header has-background-primary">
                            <div class="card-header-title has-text-white">Form Data</div>
                        </div>
                        <div class="card-content">
                            <table class="table is-fullwidth is-hoverable">
                                <tbody>
                                    <th>Field Name</th>
                                    <th>Field Value</th>

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
                            <a href="{{ route('download.submission', [$submission->id]) }}"
                               class="card-footer-item" target="_blank">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
