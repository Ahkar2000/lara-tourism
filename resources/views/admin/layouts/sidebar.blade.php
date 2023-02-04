<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="{{ route('admin.dashboard') }}">
                        <!-- <img src="images/logo.png" alt="" /> --><span>Miki TSM</span>
                    </a></div>
                <li class="label">Main</li>
                <li><a href="{{ route('admin.dashboard') }}"><i class="ti-home"></i> Dashboard </a></li>

                <li class="label">Pages</li>
                <li class="{{ request()->is('admin/categories*') ? 'active' : '' }} mb-1">
                    <a href="{{ route('categories.index') }}"><i class="ti ti-list"></i> Categories </a>
                </li>
                <li class="{{ request()->is('admin/users*') ? 'active' : '' }} mb-1">
                    <a href="{{ route('admin.showUsers') }}"><i class="bi bi-people"></i> Users </a>
                </li>
                <li class="{{ request()->is('admin/inquiries*') ? 'active' : '' }} mb-1"><a
                        href="{{ route('inquiries.index') }}"><i class="ti-email"></i> Inquiries </a></li>
                <li class="{{ request()->is('admin/packages*') ? 'active' : '' }} mb-1"><a
                        href="{{ route('packages.index') }}"><i class="ti-package"></i> Packages </a></li>
                <li class="{{ request()->is('admin/comments*') ? 'active' : '' }} mb-1"><a
                        href="{{ route('comments.index') }}"><i class="bi bi-chat-left"></i> Comments </a></li>
                <li class="mb-3"><a class="sidebar-sub-toggle"><i class="bi bi-card-checklist"></i> Bookings <span
                            class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                        <li><a href="{{ route('bookings.index',['status' => 'pending']) }}">Pending Bookings</a></li>
                        <li><a href="{{ route('bookings.index',['status' => 'confirm']) }}">Confirmed Bookings</a></li>
                        <li><a href="{{ route('bookings.index',['status' => 'finish']) }}">Finished Bookings</a></li>
                        <li><a href="{{ route('bookings.index',['status' => 'cancel']) }}">Cancelled Bookings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
