<x-app-layout>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Payments</h2>

        <a href="{{ route('payments.create') }}" class="btn btn-primary">
            + Add Payment
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
                        <th>Guest</th>
                        <th>Room</th>
                        <th>Final Amount</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Reference</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($payments as $payment)

                        <tr>

                            <td>
                                {{ $payment->reservation->guest->name ?? 'N/A' }}
                            </td>

                            <td>
                                Room {{ $payment->reservation->room->room_number ?? 'N/A' }}
                            </td>

                            <td>
                                ₱{{ number_format($payment->reservation->final_amount ?? 0, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payment->amount_paid, 2) }}
                            </td>

                            <td>
                                ₱{{ number_format($payment->balance, 2) }}
                            </td>

                            <td>
                                {{ $payment->payment_method }}
                            </td>

                            <td>

                                @if($payment->payment_status == 'paid')

                                    <span class="badge bg-success">
                                        Paid
                                    </span>

                                @elseif($payment->payment_status == 'partial')

                                    <span class="badge bg-warning">
                                        Partial
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Unpaid
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $payment->reference_number ?? 'N/A' }}
                            </td>

                            <td>

                                @if($payment->status === 'paid')
                                    <a href="{{ route('payments.receipt', $payment->id) }}"
                                    class="btn btn-success btn-sm">
                                        Print
                                    </a>
                                @endif

                                <a href="{{ route('payments.edit', $payment) }}"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('payments.destroy', $payment) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete payment?')">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center">
                                No payments found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>