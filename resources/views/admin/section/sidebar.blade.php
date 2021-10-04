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
                            <span class="nav-label">
                                {{ (__('trans.Dashboard')) }}
                        </a>
                    </li>
                    <li class="heading">{{ (__('trans.Featured')) }}</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                            <span class="nav-label">{{ (__('trans.slider')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                {{-- <a href="{{ route('slider.create') }}">{{ (__('trans.Add Slider')) }}</a> --}}
                            </li>
                            <li>
                                <a href="{{ route('slider.create') }}">{{ (__('trans.Add Slider')) }}</a>
                            </li>

                            <li>
                                <a href="{{ route('slider.index') }}">{{ (__('trans.Slider List')) }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">{{ (__('trans.Category')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('category.create') }}">{{ (__('trans.Add Category')) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('category.index') }}">{{ (__('trans.Category List')) }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.Product')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('product.create') }}">{{ (__('trans.Add Product')) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('product.index') }}">{{ (__('trans.Product List')) }}</a>
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
                                <a href="{{ route('blog.index') }}"> {{ (__('trans.Blog List')) }}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-table"></i>
                            <span class="nav-label">{{ (__('trans.Facility')) }}</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                            <a href="{{ route('facilities.create') }}">{{ (__('trans.Add Facility')) }}</a>
                            </li>
                            <li>
                                <a href="{{ route('facilities.index') }}"> {{ (__('trans.Facility List')) }}</a>
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
