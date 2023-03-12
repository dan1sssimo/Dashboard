@extends('layouts.app')
@section('title')
    Our offers
@endsection
@section('content')

    <?php

    require_once __DIR__.'/../../../vendor/autoload.php';

    $stripe = new \Stripe\StripeClient('sk_test_51LxWB4EUQY6PFC8sn89WkNaPnjUY4cWeYQxNb6lnWDgms0QArO6D0Gr6YvXMgGcWreNvD0OTXMfS3wz67x6CWNYL00x1tm0x4o');

    $checkout_session_management = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Management Subscription',
                ],
                'unit_amount' => 19900,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('payment-success'),
        'cancel_url' => route('home'),
    ]);

    $checkout_session_growth = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Growth Subscription',
                ],
                'unit_amount' => 89900,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('payment-success'),
        'cancel_url' => route('home'),
    ]);

    ?>



            <!-- content -->

    <div class="container py-3">
        
        <main>

            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Management Subscription</h4>
                            <h5 class="my-0 fw-normal">10 assessments/month</h5>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$199<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Up to 5 WorkFit DxR assessments per month (an 80% discount)</li>
                                <li>Additional assessments at only $10</li>
                                <li>3 comparison reports per month</li>
                                <li>Additional reports are only $10</li>
                                <li>1 Position-Fit Matrix per month</li>
                                <li>Additional PFM are only $45</li>
                                <li>Total Savings: $160 every month</li>
                            </ul>
                            @guest

                                @if(Route::has('login') && Route::has('register'))
                                    <button type="button" class="w-100 btn btn-lg btn-light checkout-management" disabled>Pay right now!</button>
                                @endif
                            @else
                                <button type="button" class="w-100 btn btn-lg btn-light checkout-management">Pay right now!</button>

                            @endguest
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Growth Subscription</h4>
                            <h5 class="my-0 fw-normal">100 assessments/month</h5>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$899<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Up to 100 WorkFit DxR assessments per month (a 95% discount)</li>
                                <li>Additional assessments at only $7</li>
                                <li>10 comparison reports per month</li>
                                <li>Additional reports are only $5</li>
                                <li>5 position-matrix reports / month</li>
                                <li>Additional PFM are only $30</li>
                                <li>Total savings: $3800 every month</li>
                            </ul>
                            @guest

                                @if(Route::has('login') && Route::has('register'))
                                    <button type="button" class="w-100 btn btn-lg btn-warning checkout-growth" disabled>Pay right now!</button>
                                @endif
                            @else
                                <button type="button" class="w-100 btn btn-lg btn-warning checkout-growth">Pay right now!</button>

                            @endguest
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Enterprise Subscription</h4>
                            <h5 class="my-0 fw-normal">100+ assessments/month</h5>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">Need more?</h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Contact us for even lower prices based on your needs</li>
                            </ul>
                            <a href="/contuctUs" type="button" class="w-100 btn btn-lg btn-light">Contuct us!</a>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- end content -->



    <!-- stripe -->

    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            const stripe = Stripe('pk_test_51LxWB4EUQY6PFC8sg2tZ5mGsqa8HHfIkZZ5FBzXsadOVKJyIPTLtaPlmwhiAdEb0UkAAGif9yhn45EuEE4wIDSSh00cARMNENm');
            $(".checkout-management").on("click", function(e) {
                e.preventDefault();
                stripe.redirectToCheckout({
                    sessionId: "<?php echo $checkout_session_management->id ?>"
                });
            });

            $(".checkout-growth").on("click", function(e) {
                e.preventDefault();
                stripe.redirectToCheckout({
                    sessionId: "<?php echo $checkout_session_growth->id ?>"
                });
            });

        });

    </script>

    <!-- end stripe -->

@endsection


