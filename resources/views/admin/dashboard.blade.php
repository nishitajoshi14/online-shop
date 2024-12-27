@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.sidebar')

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="background-color: #f3f9fc;">
            
            @include('admin.header')

            
            <!-- Flexbox Container for Boxes and Graph -->
            
            <div class="d-flex">
                <!-- Boxes Section -->
                <div class="boxes-section">
                    <div class="row">
                        <!-- Total Orders -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Total Orders</h6>
                                        <p class="card-text"><strong>{{ $totalOrders }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Delivered Orders -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Delivered Orders</h6>
                                        <p class="card-text"><strong>{{ $deliveredOrders }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Pending Orders -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Pending Orders</h6>
                                        <p class="card-text"><strong>{{ $pendingOrders }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Canceled Orders -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Canceled Orders</h6>
                                        <p class="card-text"><strong>{{ $canceledOrders }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Pending Orders Amount -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-hourglass-end"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Pending Orders Amount</h6>
                                        <p class="card-text"><strong>₹{{ number_format($pendingAmount, 2) }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <!-- Canceled Orders Amount -->
                        <div class="col-md-6 mb-2">
                            <div class="card text-dark" style="background-color: white; width: 250px; height: 80px; border-radius: 8px;">
                                <div class="card-body d-flex align-items-center">
                                    <div class="icon" style="font-size: 24px; color: #ADD8E6; padding-right: 20px;">
                                        <i class="fas fa-ban"></i>
                                    </div>
                                    <div>
                                        <h6 class="card-title">Canceled Orders Amount</h6>
                                        <p class="card-text"><strong>₹{{ number_format($canceledAmount, 2) }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <!-- Graph Section -->
                <div class="graph-section ml-4 mt-4" style="flex-grow: 1;">
                    <div class="card text-dark" style="background-color: white; border-radius: 8px; height: 320px; width: 100%;">
                        <div class="card-body">
                            <h5 class="card-monthly">Earnings Revenue</h5>
                            <canvas id="monthlyGraph" style="height: 240px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Cart Section (Order Summary) -->
            <div class="cart-section mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Orders</h4>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->fullName }}</td>
                                    <td>{{ $order->phoneNumber }}</td>
                                    <td>₹{{ number_format($order->subtotal, 2) }}</td>
                                    <td>₹{{ number_format($order->vat, 2) }}</td>
                                    <td>₹{{ number_format($order->total, 2) }}</td>
                                    <td>{{ $order->paymentMethod }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
        



<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthlyLabels = @json(array_keys($monthlyRevenue->toArray()));
    const monthlyData = @json(array_values($monthlyRevenue->toArray()));

    const data = {
        labels: monthlyLabels,
        datasets: [{
            label: 'Monthly Revenue',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: monthlyData,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const monthlyGraph = new Chart(
        document.getElementById('monthlyGraph'),
        config
    );
</script>
@endsection
