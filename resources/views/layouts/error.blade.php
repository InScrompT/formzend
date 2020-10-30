@if ($errors->any())
    <div class="card has-background-danger mb-6">
        <div class="card-header">
            <div class="card-header-title has-text-white">
                Oops, we've got some bad-news Chief!
            </div>
        </div>
        <div class="card-content has-text-white">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
