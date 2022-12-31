<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo"><a href="{{ route('admin.dashboard') }}">
                        <!-- <img src="images/logo.png" alt="" /> --><span>Focus</span></a></div>
                <li class="label">Main</li>
                <li><a href="{{ route('admin.dashboard') }}"><i class="ti-home"></i> Dashboard </a></li>

                <li class="label">Pages</li>
                <li class="{{ request()->is('admin/inquiries*') ? 'active' : '' }} mb-1"><a href="{{ route('inquiries.index') }}"><i class="ti-email"></i> Inquiries </a></li>
                <li><a href="{{ route('admin.dashboard') }}"><i class="ti-user"></i> Admins & Users </a></li>
            </ul>
        </div>
    </div>
</div>