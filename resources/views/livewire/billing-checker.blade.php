<div class="overflow-x-auto" wire:poll.60s.keep-alive="fetchBillingAccounts">
    <table class="table whitespace-nowrap">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Balance</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($account_lists as $account_list)
            <tr class="hover">
                <th>{{ $loop->iteration }}</th>
                <td>
                    {{ $account_list['title'] }}
                    <div class="text-xs text-gray-500">
                        {{ $account_list['email'] }}
                    </div>
                </td>
                <td>{{ number_format($account_list['precalc_ongoing']) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No data available</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
