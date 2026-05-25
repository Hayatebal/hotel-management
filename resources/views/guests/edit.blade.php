<x-app-layout>

<div class="container py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-warning">
            Edit Guest
        </div>

        <div class="card-body">

            <form action="{{ route('guests.update', $guest) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>First Name</label>

                    <input type="text"
                           name="first_name"
                           value="{{ $guest->first_name }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Last Name</label>

                    <input type="text"
                           name="last_name"
                           value="{{ $guest->last_name }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email"
                           name="email"
                           value="{{ $guest->email }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input type="text"
                           name="phone"
                           value="{{ $guest->phone }}"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Address</label>

                    <textarea name="address"
                              class="form-control"
                              rows="3">{{ $guest->address }}</textarea>

                </div>

                <button class="btn btn-warning">
                    Update Guest
                </button>

            </form>

        </div>

    </div>

</div>

</x-app-layout>