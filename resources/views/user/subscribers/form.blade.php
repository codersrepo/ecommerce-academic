<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					{{ (__('trans.Newsletter')) }}
				</h4>

					<div class="wrap-input1 w-full p-b-4">
                    <form action="{{ route('front.subscribers.store') }}" method="post">
                    @csrf
                    <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
						<div class="focus-input1 trans-04"></div>
					</div>
					<div class="p-t-18">
						<button type="submit" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
							{{ (__('trans.Subscribe')) }}
						</button>
                        @if(Session::has('success'))
            <div class="text-success">
            {{ Session::get('success') }}
            </div>
            @else
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            @endif
            </div>
            </form>

					</div>
			</div>