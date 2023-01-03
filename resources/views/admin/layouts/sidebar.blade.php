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
                <li class="{{ request()->is('admin/packages*') ? 'active' : '' }} mb-1"><a href="{{ route('packages.index') }}"><i class="ti-package"></i> Packages </a></li>
                <li class="{{ request()->is('admin/comments*') ? 'active' : '' }} mb-1"><a href="{{ route('comments.index') }}"><i class="bi bi-chat-left"></i> Comments </a></li>
            </ul>
        </div>
    </div>
</div>