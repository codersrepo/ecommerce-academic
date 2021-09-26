@extends('layouts.app')
@section('content')
    <!-- Slider -->
	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1 rs1-slick1">
			<div class="slick1">
                @foreach ($slider as $slider_data )
				<div class="item-slick1" style="background-image: url({{ asset('images/sliders/'.$slider_data->image) }});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									{{ $slider_data->title }}
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
                                    {{ $slider_data->summary }}

                                </h2>
							</div>
							<div class="layer-slick1 animated visible-false" da-appear="zoomIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
                @endforeach
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0">
		<div class="flex-w flex-c-m">

            @foreach ($category as $category_data)
			<div class="size-202 m-lr-auto respon4">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="{{ asset('images/categories/'.$category_data->image) }}" alt="IMG-BANNER">

					<a href="product.html" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								{{ $category_data->title }}
							</span>

							<span class="block1-info stext-102 trans-04">
								{{ $category_data->summary }}
							</span>
						</div>

						<div class="block1-txt-child2 p-b-4 trans-05">
							<div class="block1-link stext-101 cl0 trans-09">
								Shop Now
							</div>
						</div>
					</a>
				</div>
			</div>

            @endforeach

		</div>
	</div>


	<!-- Product -->
	<!-- Product -->
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1">
				{{ (__('trans.Store Overview')) }}
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				 <ul class="nav nav-tabs" role="tablist">
                    @foreach ($category as $category_data)
                    <li class="nav-item p-b-10">
						<a class="nav-link {{ $category_data->id == 1 ? 'active' : '' }}" data-toggle="tab" href="#home{{ $category_data->id }}" role="tab">{{ $category_data->title }}</a>
					</li>
                    @endforeach
				</ul>

                @if($category)
				<div class="tab-content p-t-50">
                    @foreach ($category as $category_data)
                        <div class="tab-pane fade show {{ $category_data->id == 1 ? 'active' : '' }}" id="home{{ $category_data->id }}" role="tabpanel">
                            <div class="wrap-slick2">
                                <div class="slick2">
                                        @foreach ($category_data->products as $category_item)
                                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                            <!-- Block2 -->
                                            <div class="block2">
                                                <div class="block2-pic hov-img0">
                                                    <img src="{{ asset('images/product_images/icons/'.$category_item->image_icon) }}" alt="IMG-PRODUCT">

                                                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                                        Quick View
                                                    </a>
                                                </div>

                                                <div class="block2-txt flex-w flex-t p-t-14">
                                                    <div class="block2-txt-child1 flex-col-l ">
                                                        <a href="{{ route('shop.index') }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                            {{ $category_item->title }}
                                                        </a>

                                                        <span class="stext-105 cl3">
                                                            {{ $category_item->price }}
                                                        </span>
                                                    </div>

                                                  <div class="block2-txt-child2 flex-r p-t-3">
                                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                                            <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                                            <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    @endforeach
				</div>
                @endif
			</div>
		</div>
	</section>


	<!-- Blog -->
	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Our Blogs
				</h3>
			</div>

			<div class="row">
                @foreach($blog as $blog_data)
				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="blog-detail.html">
								<img src="{{ asset('images/blogs/'.$blog_data->image) }}" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										Nancy Ward
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										{{ $blog_data->created_at }}
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="{{ route('blog.index') }}" class="mtext-101 cl2 hov-cl1 trans-04">
									{{ $blog_data->title }}
								</a>
							</h4>

							<p class="stext-108 cl6">
                                {{ $blog_data->summary }}
							</p>
						</div>
					</div>
				</div>
                @endforeach
			</div>
		</div>
	</section>

@endsection
@section('javascript')
    <script>
        $(function () {
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            });
            $('.parallax100').parallax100();
            $('.gallery-lb').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    },
                    mainClass: 'mfp-fade'
                });
            });
            $('.js-addwish-b2').on('click', function(e){
                e.preventDefault();
            });

            $('.js-addwish-b2').each(function(){
                var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-b2');
                    $(this).off('click');
                });
            });

            $('.js-addwish-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");

                    $(this).addClass('js-addedwish-detail');
                    $(this).off('click');
                });
            });


            $('.js-addcart-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to cart !", "success");
                });
            });
            $('.js-pscroll').each(function(){
                $(this).css('position','relative');
                $(this).css('overflow','hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1,
                    scrollingThreshold: 1000,
                    wheelPropagation: false,
                });

                $(window).on('resize', function(){
                    ps.update();
                })
            });
        })
    </script>
    @endsection
