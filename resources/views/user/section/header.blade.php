	<!-- Header -->
	<header class="header-v2">
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
            			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						{{ (__('trans.Free shipping for standard order over $100')) }}
					</div>

					<div class="right-top-bar flex-w h-full">
						<a href="#" class="flex-c-m trans-04 p-lr-25">
							{{ (__('trans.Help & FAQs')) }}
						</a>

                     @auth
                        <a href="" class="flex-c-m trans-04 p-lr-25">
                            {{ auth()->user()->name }}
                        </a>

                        {{-- <a href="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25 text-white"> --}}
                            <form action="{{ route('logout') }}" method="post">
                            @csrf
                        <button class="flex-c-m trans-04 p-lr-25" type="submit">Logout</button>
                        </form>
                    @else

                        <a href="{{ route('register') }}" class="flex-c-m trans-04 p-lr-25">
                            {{ (__('trans.Register Account')) }}
                        </a>

                        <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
							{{ (__('trans.Login')) }}
                        </a>
                    @endauth
					@if(app()->getLocale() !== 'en')
                        <li><a href="{{ route('sub_front.home', ['locale' => 'en']) }}">English</a></li>
                        @endif

                        @if(app()->getLocale() !== 'np')
                        <li><a href="{{ route('sub_front.home', ['locale' => 'np']) }}">नेपाली</a></li>
                        @endif

					</div>
				</div>
			</div>
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">

					<!-- Logo desktop -->
					<a href="/" class="logo">
						<img src="{{ asset('images/icons/logo-01.png') }}" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{ url('/') }}">{{ (__('trans.Home')) }}</a>
							</li>

							<li>
								<a href="{{ route('front.shop.index') }}">{{ (__('trans.Shop')) }}</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="shoping-cart.html">{{ (__('trans.Featured')) }}</a>
							</li>

							<li>
								<a href="{{ route('front.blogs.index') }}">{{ (__('trans.blog')) }}</a>
							</li>

							<li>
								<a href="about.html">{{ (__('trans.About')) }}</a>
							</li>

							<li>
								<a href="contact.html">{{ (__('trans.Contact')) }}</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					 <div class="wrap-icon-header flex-w flex-r-m h-full">
						<!--<div class="flex-c-m h-full p-r-24">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
								<i class="zmdi zmdi-search"></i>
							</div>
						</div> -->

						<div class="flex-c-m h-full p-l-18 p-r-25 bor5">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart">
								<i class="zmdi zmdi-shopping-cart"></i>
							</div>
						</div>

						<!-- <div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
						</div> -->
					</div>
				</nav>
			</div>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>
