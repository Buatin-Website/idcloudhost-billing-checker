<x-layout>
    <div class="text-left max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold leading-9 tracking-tight">
            Billing Account List
        </h1>
        <p class="mt-2 text-gray-600">
            Below is the list of billing accounts.
        </p>
        <div class="flex flex-col my-4">
            <div class="overflow-x-auto">
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
        </div>
    </div>
</x-layout>
