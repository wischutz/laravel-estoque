@extends('admin.dashboard')

@section('content')
    <h3>Orders Hystory</h3>

    @if(count($orders) > 0)
        <table>
            <tr>
                <th>Date</th>                        
                <th>Source</th>                        
                <th>Name</th>
                <th>SKU</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->created_at }}</td>
                <td>-</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->sku }}</td>
                <td>{{ $order->type }} ({{ ($order->type === 'sale')? '-' : '+' }})</td>
                <td>{{ $order->amount }}</td>
            </tr>
        @endforeach
        </table>
    @else
        <p>Without movements to show.</p>
    @endif   
@endsection