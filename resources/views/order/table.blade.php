<table class="table table-bordered table-striped">
    <tr>
        <th>Order Id</th>
        <th>Woocommerce Order Ref</th>
        <th>Prefered Date Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    
    @foreach ($orders as $order)
        <tr>
            <td><a href={{ route('order.show', $order->id) }}>{{ $order->id }}</td>
            <td>
                {{ $order->woocommerce_order_id }}
            </td>
            <td>
                {{ $order->prefered_pickup_datetime }}
            </td>
            <td>
                {{ humaniseOrderState($order->state) }}
            </td>
            <td>
                <div class="d-flex">
                    <div>
                        <a href="{{ route('order.show', $order->id) }}" class='btn btn-primary mr-2'>View</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

</table>
