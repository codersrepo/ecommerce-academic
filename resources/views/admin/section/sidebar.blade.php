        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <!-- <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"></div><small>Administrator</small></div>
                </div> -->
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="index.html"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">{{ (__('trans.Dashboard')) }}</span>
                        </a>
                    </li>
                    <li class="heading">{{ (__('trans.FEATURED')) }}</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">{{ (__('trans.slider')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                {{-- <a href="{{ route('slider.create') }}">Add Slider</a> --}}
                            </li>
                            <li>
                                <a href="{{ route('slider.create') }}">Add Slider</a>
                            </li>

                            <li>
                                <a href="{{ route('slider.index') }}">List Slider</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">Category</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('category.create') }}">Add Category</a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">List Category</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">Product</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('product.create') }}">Add Product</a>
                            </li>
                            <li>
                                <a href="{{ route('product.index') }}">List Product</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.blog')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('blog.create') }}">{{ (__('trans.Add Blog')) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('blog.index') }}"> {{ (__('trans.List blog')) }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.Orders')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.Subscribers')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                    </li>
                    <!-- <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">Seo</span><i class="fa fa-angle-left arrow"></i></a>
                    </li> -->
                    <!-- <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">FAQ</span><i class="fa fa-angle-left arrow"></i></a>
                    </li> -->
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.Privacy Policy')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
