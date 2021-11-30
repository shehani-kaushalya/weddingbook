@extends('layouts.customer_app')


@section('contents')


    <style>

        ul.attributes li {
            display: inline-block;
            border: 2px solid #08c;
            border-radius: 5px;
            padding: 5px;
        }

        .variant_wrap {
            display: inline-flex;
        }

        .variant_wrap input {
            margin-top: 15px;
            margin-right: 15px;
        }

        a.btn-cart-remove {
            background: #d1484d;
            padding: 5px 10px;
        }

        a.btn-cart-remove i {
            color: #fff;
        }

        tr.product-row {
            border-bottom: 1px solid #00000017;
        }

        h2.product-title {
            max-width: 100px;
            overflow-wrap: break-word;
        }



    </style>







    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('user.home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                            <tr>
                                <th class="">Product</th>
                                <th class=""></th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Qty</th>
                                <th>Subtotal</th>
                                <th>Delivery</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>





                            @foreach(\App\Services\CartService::getCart() as $product)

                            <tr class="product-row">
                                <td class="product-col">

                                        <a href="#" class="">

                                            @php
                                                $img = \App\Services\UtilService::getProductImageById($product->id);
                                            @endphp

                                            @if($img)

                                                <img src="{{config('amax.s3_bucket_url')}}/{{$img}}" alt="product" width="80px">
                                            @else

                                                <img src="{{asset('img/default-pro.jpg')}}" width="80px"/>

                                            @endif
                                        </a>

                                </td>
                                <td class="">
                                    <h2 class="product-title">
                                        <a href="">{{$product->name}}</a>
                                    </h2>
                                </td>
                                <td>{{number_format($product->price, 2 )}}</td>
                                <td>
                                    <div class="product-single-qty">

                                        <form class="update_QTY" action="{{route('user.update.cart')}}" method="post" style="margin: 0;">
                                            @csrf
                                        <input class="horizontal-quantity form-control newQTY" type="text" name="qty" value="{{$product->quantity}}">

                                            <input type="hidden" name="id" value="{{$product->id}}">



                                        </form>

                                    </div>

                                </td>
                                <td>{{number_format($product->price * $product->quantity, 2 )}}</td>

                                <td>
                                    @php  $delivery_cost = \App\Services\CartService::getDeliveryCost($product->id); @endphp

                                    <div class="delivery-options">
                                        <select class="form-control delivery-option" name="delivery_option" product_id="{{$product->id}}">
                                            <option value="1" {{($product->attributes->delivery_option==1)?"selected='selected'":""}}>Standard Delivery (Rs.{{$delivery_cost[0]}})</option>
                                            <option value="2" {{($product->attributes->delivery_option==2)?"selected='selected'":""}}>Fast Delivery (Rs.{{$delivery_cost[1]}})</option>
                                            <option value="3" {{($product->attributes->delivery_option==3)?"selected='selected'":""}}>Express Delivery (Rs.{{$delivery_cost[2]}})</option>
                                        </select>
                                    </div>
                                </td>

                                <td>  <a href="{{route('user.cart.remove', ['id' => $product->id])}}" title="Remove product" class="btn-cart-remove"><i class="fa fa-trash-alt"></i></a></td>
                            </tr>


                            

                            @endforeach



                            </tbody>

                        </table>
                    </div>



                </div>

                <div class="col-lg-3">
                    <div class="cart-summary">
                        <h3>Summary</h3>


                        @php $total_delivery_cost = \App\Services\CartService::getTotalDeliveryCost();  @endphp
                        <table class="table table-totals">
                            <tbody>
                            <tr>
                                <td>Delivery Cost</td>
                                <td>{{number_format((float)$total_delivery_cost, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <td>Item Cost</td>
                                <td>{{\App\Services\CartService::getTotal(0)}}</td>
                            </tr>

                            <tr>
                                <td>Tax</td>
                                <td>0.00</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Order Total</td>
                                <td>{{\App\Services\CartService::getTotal($total_delivery_cost)}}</td>
                            </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="{{route('user.checkout')}}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                        </div><!-- End .checkout-methods -->
                    </div><!-- End .cart-summary -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-6"></div><!-- margin -->
    </main>




@endsection

@section('custom_js')
    <script>
        window.close();
        window.onunload = refreshParent;
        function refreshParent() {
            window.opener.test();
        }


        $(document).on('change', '.newQTY' , function () {

            $(this).closest(".update_QTY").submit();

        });

        var link = '{{asset('/')}}';

        $(document).ready(function(){
            $(".delivery-option").change(function(){
                var product_id = $(this).attr("product_id");
                window.location.href=link+"/update/cart/"+product_id+"/"+$("option:selected",this).val();
            });
        });



    </script>
@endsection

