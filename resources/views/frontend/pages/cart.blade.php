@extends('frontend.layouts.master')

@section('content')
<!-- resources\views\frontend\pages\cart.blade.php -->
<!--===========================
    BREADCRUMB START
============================-->
<section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
    <div class="wsus__breadcrumb_overlay">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="wsus__breadcrumb_text">
                        <h1>Shopping Cart</h1>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--===========================
    BREADCRUMB END
============================-->


<!--===========================
    CART VIEW START
============================-->
<section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
    @if (count($cart) > 0)
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInUp">
                    <div class="cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="pro_img">Product</th>

                                        <th class="pro_name">Name</th>

                                        <th class="pro_tk">Price</th>

                                        <th class="pro_icon">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cart as $item)
                                    <tr>
                                        <td class="pro_img">
                                            <img src="{{ asset($item->course->thumbnail) }}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="pro_name">
                                            <a href="{{ route('courses.show', $item->course->slug) }}">{{ $item->course->title }}</a>
                                        </td>
                                        <td class="pro_tk">

                                                @if ($item->course->price == 0)
                                                    $free
                                                @elseif ($item->course->discount_price > 0)
                                                    <p><del>${{ $item->course->price }}</del></p>
                                                    ${{ $item->course->discount_price }}
                                                @else
                                                    ${{ $item->course->price }}
                                                @endif

                                        </td>
                                        <td class="pro_icon">
                                            <a href="{{ route('remove-from-cart', $item->id) }}"><i class="fas fa-times" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <p>No data found</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="continue_shopping">
                        <a href="#" class="common_btn">continue shopping</a>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-7 col-lg-6 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="total_price">
                        <div class="subtotal_area">
                            <h5>Total<span>{{ cartTotal() }}</span></h5>
                            <a href="checkout.html" class="common_btn">proceed checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container text-center">
            <img style="width: 300px !important" src="{{ asset('default-files/empty-cart.png') }}" alt="empty-cart">
            {{-- <a href="https://www.flaticon.com/free-icons/empty-cart" title="empty cart icons">Empty cart icons created by kerismaker - Flaticon</a> --}}
        </div>
    @endif
</section>
<!--===========================
    CART VIEW END
============================-->
@endsection
