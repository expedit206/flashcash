<x-app-layout>
    <h1>Mes Transactions</h1>
    <table>
        <thead>
            <tr>
                <th>Montant</th>
                <th>Type</th>
                <th>Statut</th>
                <th>ID de Transaction</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->amount }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->transaction_id }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>