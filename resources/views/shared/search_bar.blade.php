<div class="card">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('dashboard') }}" method="GET">
            <input value="{{ request('search', '') }}" placeholder="..." class="form-control w-100" type="text"
                name="search">
            <div>
                <button class="btn btn-dark mt-2"> Search</button>
                <a href="{{ request()->url() }}" class="btn btn-dark mt-2">Clear</a>

            </div>
        </form>


    </div>
</div>
