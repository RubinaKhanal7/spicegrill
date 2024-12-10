@extends('layouts.master')

@section('content')
<style>
    .card {
        background-color: #1d2951;
        border: none;
        border-radius: 10px;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        color: white;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: #243b55;
        box-shadow: 0 0 0 0.2rem rgba(36, 59, 85, 0.25);
    }

    .form-label {
        color: white;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #243b55;
        border-color: #243b55;
        border-radius: 5px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1c2e44;
        border-color: #1c2e44;
    }

    #send-otp-btn {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .mb-3 {
        margin-bottom: 1.5rem !important;
    }

    .mt-4 {
        margin-top: 2rem !important;
    }

    .text-center {
        text-align: center;
    }

    #card-element {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 0.75rem;
        background-color: white;
    }

    #card-errors {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #ffffff;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .cart-item-name {
        flex-grow: 1;
        font-size: 1.1em;
        color: #333;
    }
    .input-group {
    position: relative;
}

.input-group-text {
    background-color: #e9ecef;
}

</style>

<div class="container mt-4 mb-4 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm" style="width: 35rem;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Payment</h2>
            <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="street_address" class="form-label">Street Address</label>
                        <input type="text" class="form-control" id="street_address" name="street_address" placeholder="Enter street address" required>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required>
                    </div>
                    
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Enter state" required>
                    </div>
                    <div class="col-md-6">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="number" class="form-control" id="postal_code" name="postal_code" min="1" placeholder="Enter postal code" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text">+1</span>
                            <input type="number" class="form-control" id="phone" name="phone" required  placeholder="Enter phone number" oninput="validatePhoneNumber()">
                        </div>
                        <small id="phoneError" class="form-text text-danger"></small>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="cart_items" class="form-label">Your Order</label>
                    <div id="cart_items" class="form-control" style="height: auto; min-height: 100px; overflow-y: auto;"></div>
                    <input type="hidden" name="cart_items" id="cart_items_input">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Total Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $total }}" readonly>
                </div>
                <div id="card-element" class="mb-3">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <div id="card-errors" role="alert"></div>
                <div id="otp-section" style="display: none;">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="button" id="send-otp-btn" class="btn btn-primary btn-sm w-100 mt-3">Send OTP</button>
                </div>
                <div class="text-center">
                    <button type="submit" id="pay-now-btn" class="btn btn-primary btn-sm w-50 mt-4" style="display: none;">Pay Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        function updateCartDisplay() {
            const cartItemsDiv = document.getElementById('cartItems');
            cartItemsDiv.innerHTML = '';
            let total = 0;

            for (const [itemName, details] of Object.entries(cart)) {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'cart-item';
                itemDiv.innerHTML = `
                    <span class="cart-item-name">${itemName}</span>
                    <span class="cart-item-quantity">${details.quantity}</span>
                `;
                cartItemsDiv.appendChild(itemDiv);
            }
        }

        updateCartDisplay();
    });
</script>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        function updateCartItems() {
    const cartItemsDiv = document.getElementById('cart_items');
    const cartItemsInput = document.getElementById('cart_items_input');
    cartItemsDiv.innerHTML = '';
    
    for (const [itemName, details] of Object.entries(cart)) {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'cart-item';
        itemDiv.innerHTML = `
            <span class="cart-item-name">${itemName}</span>
            <span class="cart-item-quantity">Quantity: ${details.quantity}</span>
        `;
        cartItemsDiv.appendChild(itemDiv);
    }
    
    cartItemsInput.value = JSON.stringify(cart);
}

        updateCartItems();

        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        cardElement.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }

        document.getElementById('send-otp-btn').addEventListener('click', function() {
    const email = document.getElementById('email').value;
    const sendOtpBtn = this;
    
    if (email) {
        // Change button text and disable it
        sendOtpBtn.textContent = 'Sending OTP...';
        sendOtpBtn.disabled = true;

        fetch('{{ route("payment.send-otp") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ email: email })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            document.getElementById('otp-section').style.display = 'block';
            document.getElementById('pay-now-btn').style.display = 'block';
            sendOtpBtn.style.display = 'none';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while sending OTP. Please try again.');
            // Reset button text and enable it
            sendOtpBtn.textContent = 'Send OTP';
            sendOtpBtn.disabled = false;
        });
    } else {
        alert('Please enter your email');
    }
});
    });

    function validatePhoneNumber() {
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phoneError');
    const maxLength = 10;

    if (phoneInput.value.length > maxLength) {
        phoneInput.value = phoneInput.value.slice(0, maxLength);
        phoneError.textContent = `Only ${maxLength} numbers are allowed.`;
    } else {
        phoneError.textContent = '';
    }
}
</script>

@endsection
