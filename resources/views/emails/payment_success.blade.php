<!DOCTYPE html>
<html>
<head>
    <title>Order Notification</title>
</head>
<body>
    <h1>Order Notification</h1>
    <p>Dear Mowks Coffee,</p>
    <p>Here are the order details:</p>

    <h3>Customer Details:</h3>
    <ul>
        <li><strong>Customer Name :</strong> {{ $user->name }}</li>
        <li><strong>Customer Address :</strong> {{ $user->alamat_pengiriman ?? 'N/A' }}</li>
        <li><strong>No Hp :</strong> {{ $user->no_HP ?? 'N/A' }}</li>
        <li><strong>Email Address :</strong> {{ $user->email }}</li>
    </ul>

    <h3>Detail Orders:</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->nama_product }}</td>
                <td>{{ $transaction->jumlah_product }}</td>
                <td>{{ $transaction->total_price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if ($dtstock != null)
        <h3 class=" font-bold text-red-500 ">stock of goods that will run out:</h3>
        <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Remaining Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dtstock as $transaction)
            <tr>
                <td>{{ $transaction->nama_product }}</td>
                <td>{{ $transaction->stock }}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
        
    @else
        
    @endif    
</body>
</html>
