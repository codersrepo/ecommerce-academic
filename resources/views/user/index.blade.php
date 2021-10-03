@extends('layouts.app')
@section('content')
<!-- Slider -->
<!-- Slider -->
<section class="section-slide">
	<div class="wrap-slick1">
		<div class="slick1">
			@foreach ($slider as $slider_data )
			<div class="item-slick1" style="background-image: url({{ asset('images/sliders/'.$slider_data->image) }});">
				<div class="container h-full">
					<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
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
							{{ __('trans.Shopnow')}}
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
<div class="sec-banner bg0 p-t-80 p-b-50">
	<div class="container">
		<div class="row">
			@foreach ($category as $category_data)
			<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
				<!-- Block1 -->
				<div class="block1 wrap-pic-w">
					<img src="{{ asset('images/categories/'.$category_data->image) }}" style="height:300px; width:300px;width: 100%" alt="IMG-BANNER">
					<a href=" {{ url('/product') }} " class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
						<div class="block1-txt-child1 flex-col-l">
							<span class="block1-name ltext-102 trans-04 p-b-8">
								{{ $category_data->firstTranslation()->title }}
							</span>

							<span class="block1-info stext-102 trans-04">
								{{ $category_data->firstTranslation()->summary }}
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
</div>

<!-- Product -->
<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
	<div class="container">
		<div class="p-b-10">
			<h3 class="ltext-103 cl5">
				Product Overview
			</h3>
		</div>
		<div class="row isotope-grid">
			<!-- Nav tabs -->
			@if($product)
			@foreach ($product as $product_data)

			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
						<img src="{{ asset('images/product_images/icons/'.$product_data->image_icon) }}" alt="IMG-PRODUCT">
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="{{ route('front.shop.show', [ 'slug' => $product_data->slug]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
								{{ $product_data->firstTranslation()->title }}
							</a>

							<span class="stext-105 cl3">
								{{ $product_data->price }}
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
		<div class="flex-c-m flex-w w-full p-t-45">
				<a href="{{ url('/product')}}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		@endif
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
	$(function() {
		$(".js-select2").each(function() {
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
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
		$('.js-addwish-b2').on('click', function(e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function() {
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});


		$('.js-addcart-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to cart !", "success");
			});
		});
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	})
</script>
@endsection