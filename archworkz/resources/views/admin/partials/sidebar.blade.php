<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.index') }}">Aksamedia</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.index') }}">AM</a>
        </div>
        <ul class="sidebar-menu">
            @if (auth()->user()->hasAnyPermission(['users read']) or auth()->user()->hasRole('superadmin'))
                <li class="menu-header">Master</li>
            @endif

            @can('settings')
                <li class="nav-item nav-dropdown @if (@$menuActive === 'settings') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-cog"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="@if (@$subMenuActive === 'basic-info') active @endif">
                            <a class="nav-link" href="{{ route('admin.settings.basic-info.edit') }}">
                                Basic Info
                            </a>
                        </li>
                        <li class="@if (@$subMenuActive === 'logo') active @endif">
                            <a class="nav-link" href="{{ route('admin.settings.logo.edit') }}">
                                Logo
                            </a>
                        </li>
                        <li class="@if (@$subMenuActive === 'breadcrumb') active @endif">
                            <a class="nav-link" href="{{ route('admin.settings.breadcrumb.edit') }}">
                                Breadcrumb
                            </a>
                        </li>

                        <li class="@if (@$subMenuActive === 'popup') active @endif">
                            <a class="nav-link" href="{{ route('admin.settings.popup.index') }}">
                                Pop Up
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan


            @if (auth()->user()->hasAnyPermission(['sliders read', 'services read', 'abouts read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'landing-page') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-map"></i>
                        <span>Landing Page</span>
                    </a>
                    <ul class="dropdown-menu">




                        @can('services read')
                            <li class="@if (@$subMenuActive === 'services') active @endif">
                                <a class="nav-link" href="{{ route('admin.services.edit') }}">
                                    Our Service
                                </a>
                            </li>
                        @endcan


                        @can('abouts read')
                            <li class="@if (@$subMenuActive === 'abouts') active @endif">
                                <a class="nav-link" href="{{ route('admin.about.edit') }}">
                                    AboutUs
                                </a>
                            </li>
                        @endcan


                    </ul>
                </li>
            @endif
            @if (auth()->user()->hasAnyPermission(['teams read', 'info read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'team') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-file-alt"></i>
                        <span>Team</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('teams read')
                            <li class="@if (@$subMenuActive === 'teams') active @endif">
                                <a class="nav-link" href="{{ route('admin.teams.index') }}">
                                    Teams
                                </a>
                            </li>
                        @endcan
                        @can('info read')
                            <li class="@if (@$subMenuActive === 'info') active @endif">
                                <a class="nav-link" href="{{ route('admin.info.edit') }}">
                                    Team Info
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            {{-- @if (auth()->user()->hasAnyPermission(['portofolio categories read', 'portofolio posts read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'portofolio') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-image"></i>
                        <span>Portofolio</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('portofolio categories read')
                            <li class="@if (@$subMenuActive === 'portofolio-categories') active @endif">
                                <a class="nav-link" href="{{ route('admin.portofolio.categories.index') }}">
                                    Category
                                </a>
                            </li>
                        @endcan
                        @can('portofolio posts read')
                            <li class="@if (@$subMenuActive === 'portofolio-post') active @endif">
                                <a class="nav-link" href="{{ route('admin.portofolio.posts.index') }}">
                                    Portofolio
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif --}}
            @if (auth()->user()->hasAnyPermission(['product categories read', 'product posts read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'product') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-file-alt"></i>
                        <span>Our Works</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('product posts read')
                            <li class="@if (@$subMenuActive === 'product-posts') active @endif">
                                <a class="nav-link" href="{{ route('admin.Our-Works.posts.index') }}">
                                    Project
                                </a>
                            </li>
                        @endcan
                        @can('sliders read')
                            <li class="@if (@$subMenuActive === 'sliders') active @endif">
                                <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                                    Slider
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            {{-- @if (auth()->user()->hasAnyPermission(['blog categories read', 'blog posts read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'blog') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-clone"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('blog categories read')
                            <li class="@if (@$subMenuActive === 'blog-categories') active @endif">
                                <a class="nav-link" href="{{ route('admin.blog.categories.index') }}">
                                    Category
                                </a>
                            </li>
                        @endcan
                        @can('blog posts read')
                            <li class="@if (@$subMenuActive === 'blog-posts') active @endif">
                                <a class="nav-link" href="{{ route('admin.blog.posts.index') }}">
                                    Posts
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif --}}
            {{-- @if (auth()->user()->hasAnyPermission(['gallery images read', 'gallery videos read', 'gallery file manager access']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'galleries') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-images"></i>
                        <span>Galleries</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('gallery images read')
                            <li class="@if (@$subMenuActive === 'images') active @endif">
                                <a class="nav-link" href="{{ route('admin.gallery.index') }}">
                                    Image
                                </a>
                            </li>
                        @endcan
                        @can('gallery videos read')
                            <li class="@if (@$subMenuActive === 'videos') active @endif">
                                <a class="nav-link" href="{{ route('admin.gallery_video.index') }}">
                                    Video
                                </a>
                            </li>
                        @endcan
                        @can('gallery file manager access')
                            <li class="@if (@$subMenuActive === 'file-manager') active @endif">
                                <a class="nav-link" href="{{ route('admin.gallery.file-manager.index') }}">
                                    File Manager
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif --}}

            @if (auth()->user()->hasAnyPermission(['social-media read', 'footer_info read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'footer') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-file-alt"></i>
                        <span>Footer</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('social-media read')
                            <li class="@if (@$subMenuActive === 'social-media') active @endif">
                                <a class="nav-link" href="{{ route('admin.social.edit') }}">
                                    Social Media
                                </a>
                            </li>
                        @endcan
                        @can('footer_info read')
                            <li class="@if (@$subMenuActive === 'footer_info') active @endif">
                                <a class="nav-link" href="{{ route('admin.footer.edit') }}">
                                    About Company
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif
            @if (auth()->user()->hasAnyPermission(['contactUs read', 'inboxes read']) or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'contact-us') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="far fa-file-alt"></i>
                        <span>ContactUs</span>
                    </a>
                    <ul class="dropdown-menu">
                        @can('contactUs read')
                            <li class="@if (@$subMenuActive === 'contactUs') active @endif">
                                <a class="nav-link" href="{{ route('admin.contactUs.edit') }}">
                                    Company Contact
                                </a>
                            </li>
                        @endcan
                        @can('inboxes read')
                        <li class="nav-item @if (@$subMenuActive === 'inboxes') active @endif">
                            <a class="nav-link" href="{{ route('admin.inboxes.index') }}">
                                <span>Inbox</span>
                            </a>
                        </li>
                    @endcan
                    </ul>
                </li>
            @endif

            <li class="menu-header">Others</li>

            @if (auth()->user()->hasAnyPermission('inboxes read', 'subscribes read') or auth()->user()->hasRole('superadmin'))
                <li class="nav-item dropdown @if (@$menuActive === 'inboxes') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-envelope"></i>
                        <span>Inbox</span>
                    </a>
                    <ul class="dropdown-menu">
                       
                        @can('subscribes read')
                            <li class="nav-item @if (@$subMenuActive === 'subscribes') active @endif">
                                <a class="nav-link" href="{{ route('admin.subscribes.index') }}">
                                    <span>Subscribe</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @can('users read')
                <li class="nav-item dropdown @if (@$menuActive === 'users') active @endif">
                    <a class="nav-link has-dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="@if (@$subMenuActive === 'users') active @endif">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Users Data</a>
                        </li>
                        @if (auth()->user()->hasRole('superadmin'))
                            <li class="@if (@$subMenuActive === 'roleAndPermissions') active @endif">
                                <a class="nav-link" href="{{ route('admin.roles.index') }}">Role & Permissions</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.auth.logout') }}">
                    <i class="fas fa-arrow-left"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
