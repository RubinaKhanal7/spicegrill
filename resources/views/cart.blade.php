@extends('layouts.master')

@section('content')
@if (session('payment_success'))
<div class="alert alert-success">
    {{ session('payment_success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<style>
.cart-page {
    background-color: #f9f9f9;
    padding: 50px 0;
}

.cart-container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    background: #1d2951;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.cart-header {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2em;
    color: #ff6347;
}

.cart-item {
    display: flex;
    flex-wrap: wrap; /* Allows wrapping on small screens */
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.cart-item-name {
    flex: 1;
    font-size: 1.1em;
    color: #333;
}

.cart-item-price,
.cart-item-total {
    min-width: 80px;
    text-align: right;
    font-size: 1em;
    color: #333;
}

.quantity-control {
    display: flex;
    align-items: center;
}

.quantity-control button {
    background-color: #243b55;
    border: none;
    color: #fff;
    padding: 5px 10px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    margin: 0 5px;
}

.quantity-control span {
    font-size: 1em;
    color: #333;
}

#total-price {
    font-size: 1.5em;
    font-weight: bold;
    text-align: right;
    margin-top: 20px;
    color: #ff6347;
}

.pay-now {
    display: block;
    width: 50%; /* Adjusted width for better fit on mobile */
    padding: 15px;
    background-color: #ff6347;
    color: white;
    text-align: center;
    font-size: 1.2em;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    margin: 20px auto 0;
    cursor: pointer;
    text-decoration: none;
}

.pay-now:hover {
    background-color: #e5533d;
}

/* Responsive adjustments for mobile devices */
@media (max-width: 768px) {
    .cart-container {
        padding: 15px;
    }

    .cart-header {
        font-size: 1.5em;
    }

    .cart-item {
        flex-direction: column;
        align-items: stretch;
    }

    .cart-item-name,
    .cart-item-price,
    .cart-item-total {
        text-align: left;
    }

    .pay-now {
        width: 70%;
    }
}

@media (max-width: 480px) {
    .cart-container {
        padding: 10px;
    }

    .cart-header {
        font-size: 1.2em;
    }

    .cart-item {
        padding: 10px;
    }

    .cart-item-name,
    .cart-item-price,
    .cart-item-total {
        font-size: 0.9em;
    }

    .quantity-control button {
        padding: 4px 8px;
        font-size: 12px;
    }

    .pay-now {
        width: 80%; 
        padding: 12px;
        font-size: 1em;
    }
}

</style>

<section class="cart-page">
    <div class="cart-container">
        <h2 class="cart-header">{{ $page_title }}</h2>
        <div id="cartItems"></div>
        <div id="total-price"></div>
        <a href="{{ route('payment.form') }}" class="pay-now">Pay Now</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('payment_success'))
                localStorage.removeItem('cart');
            @endif

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
                        <span class="cart-item-price">${details.price}</span>
                        <div class="quantity-control">
                            <button class="decreaseQuantity">-</button>
                            <span class="quantity">${details.quantity}</span>
                            <button class="increaseQuantity">+</button>
                        </div>
                        <span class="cart-item-total">$${(parseFloat(details.price.replace('$', '')) * details.quantity).toFixed(2)}</span>
                    `;
                    cartItemsDiv.appendChild(itemDiv);

                    total += parseFloat(details.price.replace('$', '')) * details.quantity;
                }

                document.getElementById('total-price').textContent = `Total: $${total.toFixed(2)}`;

                const payNowLink = document.querySelector('.pay-now');
                payNowLink.href = `{{ route('payment.form') }}?total=${total.toFixed(2)}`;

                document.querySelectorAll('.decreaseQuantity').forEach(button => {
                    button.addEventListener('click', function () {
                        const itemName = this.closest('.cart-item').querySelector('.cart-item-name').textContent;
                        if (cart[itemName].quantity > 1) {
                            cart[itemName].quantity--;
                        } else {
                            delete cart[itemName];
                        }
                        localStorage.setItem('cart', JSON.stringify(cart));
                        updateCartDisplay();
                    });
                });

                document.querySelectorAll('.increaseQuantity').forEach(button => {
                    button.addEventListener('click', function () {
                        const itemName = this.closest('.cart-item').querySelector('.cart-item-name').textContent;
                        cart[itemName].quantity++;
                        localStorage.setItem('cart', JSON.stringify(cart));
                        updateCartDisplay();
                    });
                });
            }

            updateCartDisplay();
        });
    </script>
</section>
@endsection