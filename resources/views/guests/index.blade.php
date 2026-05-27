<x-app-layout>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Guests</h2>

        <a href="{{ route('guests.create') }}"
           class="btn btn-primary">

            + Add Guest

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card shadow border-0">

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th width="180">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($guests as $guest)

                        <tr>

                            <td>
                                {{ $guest->first_name }}
                                {{ $guest->last_name }}
                            </td>

                            <td>
                                {{ $guest->email ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $guest->phone ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $guest->address ?? 'N/A' }}
                            </td>

                            <td>

                                <a href="{{ route('guests.edit', $guest) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('guests.destroy', $guest) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete guest?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">
                                No guests found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>