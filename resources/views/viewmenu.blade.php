@extends('layouts.master')

@section('content')
@include('includes.page_header')

<style>
    :root {
        --primary-color: #1d2951;
        --secondary-color: #ff6b35;
        --text-color: #ffffff;
        --background-color: #ffffff;
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
        font-family: 'Roboto', sans-serif;
    }

    .services_page {
        padding: 50px 0;
    }

    .container {
        max-width: 1140px;
        margin: 0 auto;
    }

    .hot_menu {
        background: var(--primary-color);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 30px;
    }

    .menu_head {
        font-family: 'Playfair Display', serif;
        font-size: 2.5em;
        color: var(--secondary-color);
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        text-align: center;
        margin-bottom: 20px;
    }

    .itemWrap {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .itemWrap:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .itemNameWrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .itemName {
        font-size: 1.2em;
        font-weight: bold;
        color: var(--text-color);
        text-decoration: none;
    }

    .itemMiddle {
        flex-grow: 1;
        height: 1px;
        background-image: linear-gradient(to right, transparent, var(--text-color), transparent);
        margin: 0 10px;
    }

    .itemPrice {
        font-size: 1.2em;
        font-weight: bold;
        color: var(--secondary-color);
    }

    .itemDescription {
        font-size: 0.9em;
        font-style: italic;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 10px;
    }

    .quantityControl {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .addButton, .quantitySelector button {
        background-color: var(--secondary-color);
        color: var(--text-color);
        border: none;
        padding: 5px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: bold;
        margin-left: 10px;
    }

    .addButton:hover, .quantitySelector button:hover {
        background-color: #ff8c5a;
    }

    .quantitySelector {
        display: flex;
        align-items: center;
    }

    .quantitySelector .quantity {
        padding: 0 10px;
        font-weight: bold;
    }

    #checkoutButton {
        background-color: #4CAF50;
        margin-left: 150px;
        color: white;
        padding: 15px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 1.2em;
        font-weight: bold;
        border-radius: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    #checkoutButton:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .container {
            padding: 0 10px;
        }

        .menu_head {
            font-size: 2em;
        }

        .itemNameWrap {
            flex-direction: column;
            align-items: flex-start;
        }

        .itemMiddle {
            display: none;
        }

        .itemName, .itemPrice {
            margin-bottom: 5px;
        }

        .quantityControl {
            justify-content: flex-start;
        }

        #checkoutButton {
            display: block;
            width: 100%;
            text-align: center;
            margin-left: 0;
        }
    }
</style>

<section class="services_page">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="hot_menu">
                    <h2 class="menu_head">{{ $meatTitle }}</h2>
                    @foreach ($meat as $meatgallery)
                        <div class="itemWrap">
                            <div class="itemNameWrap">
                                <a href="{{ asset('uploads/viewmenu/' . $meatgallery->image) }}" data-lightbox="myimage" class="no-color">
                                    <span class="itemName">{{ $meatgallery->title }}</span>
                                </a>
                                <span class="itemMiddle"></span>
                                <span class="itemPrice">{{ $meatgallery->price }}</span>
                                <div class="quantityControl">
                                    <button class="addButton">Add</button>
                                    <div class="quantitySelector" style="display: none;">
                                        <button class="decreaseQuantity">-</button>
                                        <span class="quantity">1</span>
                                        <button class="increaseQuantity">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="itemDescription">{{ $meatgallery->description }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="hot_menu">
                    <h2 class="menu_head">{{ $fishTitle }}</h2>
                    @foreach ($fish as $fishgallery)
                        <div class="itemWrap">
                            <div class="itemNameWrap">
                                <a href="{{ asset('uploads/viewmenu/' . $fishgallery->image) }}" data-lightbox="myimage" class="no-color">
                                    <span class="itemName">{{ $fishgallery->title }}</span>
                                </a>
                                <span class="itemMiddle"></span>
                                <span class="itemPrice">{{ $fishgallery->price }}</span>
                                <div class="quantityControl">
                                    <button class="addButton">Add</button>
                                    <div class="quantitySelector" style="display: none;">
                                        <button class="decreaseQuantity">-</button>
                                        <span class="quantity">1</span>
                                        <button class="increaseQuantity">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="itemDescription">{{ $fishgallery->description }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="hot_menu">
                    <h2 class="menu_head">{{ $vegTitle }}</h2>
                    @foreach ($veg as $veggallery)
                        <div class="itemWrap">
                            <div class="itemNameWrap">
                                <a href="{{ asset('uploads/viewmenu/' . $veggallery->image) }}" data-lightbox="myimage" class="no-color">
                                    <span class="itemName">{{ $veggallery->title }}</span>
                                </a>
                                <span class="itemMiddle"></span>
                                <span class="itemPrice">{{ $veggallery->price }}</span>
                                <div class="quantityControl">
                                    <button class="addButton">Add</button>
                                    <div class="quantitySelector" style="display: none;">
                                        <button class="decreaseQuantity">-</button>
                                        <span class="quantity">1</span>
                                        <button class="increaseQuantity">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="itemDescription">{{ $veggallery->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-6">
                <div class="hot_menu">
                    <h2 class="menu_head">{{ $softdrinkTitle }}</h2>
                    @foreach ($softdrink as $softdrinkgallery)
                        <div class="itemWrap">
                            <div class="itemNameWrap">
                                <a href="{{ asset('uploads/viewmenu/' . $softdrinkgallery->image) }}" data-lightbox="myimage" class="no-color">
                                    <span class="itemName">{{ $softdrinkgallery->title }}</span>
                                </a>
                                <span class="itemMiddle"></span>
                                <span class="itemPrice">{{ $softdrinkgallery->price }}</span>
                                <div class="quantityControl">
                                    <button class="addButton">Add</button>
                                    <div class="quantitySelector" style="display: none;">
                                        <button class="decreaseQuantity">-</button>
                                        <span class="quantity">1</span>
                                        <button class="increaseQuantity">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="itemDescription">{{ $softdrinkgallery->description }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="hot_menu">
                    <h2 class="menu_head">{{ $alcoholTitle }}</h2>
                    @foreach ($alcohol as $alcoholgallery)
                        <div class="itemWrap">
                            <div class="itemNameWrap">
                                <a href="{{ asset('uploads/viewmenu/' . $alcoholgallery->image) }}" data-lightbox="myimage" class="no-color">
                                    <span class="itemName">{{ $alcoholgallery->title }}</span>
                                </a>
                                <span class="itemMiddle"></span>
                                <span class="itemPrice">{{ $alcoholgallery->price }}</span>
                                <div class="quantityControl">
                                    <button class="addButton">Add</button>
                                    <div class="quantitySelector" style="display: none;">
                                        <button class="decreaseQuantity">-</button>
                                        <span class="quantity">1</span>
                                        <button class="increaseQuantity">+</button>
                                    </div>
                                </div>
                            </div>
                            <span class="itemDescription">{{ $alcoholgallery->description }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    <a href="{{ route('cart') }}" id="checkoutButton">Checkout</a>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        function updateCart(itemName, price, quantity) {
            if (quantity > 0) {
                cart[itemName] = { price: price, quantity: quantity };
            } else {
                delete cart[itemName];
            }
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        document.querySelectorAll('.addButton').forEach(button => {
            button.addEventListener('click', function() {
                const quantityControl = this.closest('.quantityControl');
                this.style.display = 'none';
                quantityControl.querySelector('.quantitySelector').style.display = 'flex';
                
                const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                updateCart(itemName, price, 1);
            });
        });

        document.querySelectorAll('.decreaseQuantity').forEach(button => {
            button.addEventListener('click', function() {
                const quantitySpan = this.parentElement.querySelector('.quantity');
                let quantity = parseInt(quantitySpan.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantitySpan.textContent = quantity;
                } else {
                    const quantityControl = this.closest('.quantityControl');
                    quantityControl.querySelector('.quantitySelector').style.display = 'none';
                    quantityControl.querySelector('.addButton').style.display = 'inline-block';
                    quantity = 0;
                }
                
                const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                updateCart(itemName, price, quantity);
            });
        });

        document.querySelectorAll('.increaseQuantity').forEach(button => {
            button.addEventListener('click', function() {
                const quantitySpan = this.parentElement.querySelector('.quantity');
                let quantity = parseInt(quantitySpan.textContent);
                quantity++;
                quantitySpan.textContent = quantity;
                
                const itemName = this.closest('.itemWrap').querySelector('.itemName').textContent;
                const price = this.closest('.itemWrap').querySelector('.itemPrice').textContent;
                updateCart(itemName, price, quantity);
            });
        });
    });
    </script>
</section>

@endsection