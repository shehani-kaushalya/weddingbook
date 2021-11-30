<ul class="list">
    <li class="{{request()->routeIs('customer.dashboard.view') ? 'active' : ''}}"><a href="{{route('customer.dashboard.view')}}">Account Dashboard</a></li>
    <li class="{{request()->routeIs('customer.information.view') ? 'active' : ''}}"><a href="{{route('customer.information.view')}}">Account Information</a></li>
    <li class="{{request()->routeIs('customer.address.list.view') ? 'active' : ''}}"><a href="{{route('customer.address.list.view')}}">Address Book</a></li>
    <li><a href="#">My Orders</a></li>
    <li class="{{request()->routeIs('customer.account.dr.view') ? 'active' : ''}}"><a href="{{route('customer.account.dr.view')}}">My Delivery Requests</a></li>
    <li class="{{request()->routeIs('customer.account.pr.view') ? 'active' : ''}}"><a href="{{route('customer.account.pr.view')}}">My Purchase Requests</a></li>
    <li class="{{request()->routeIs('customer.account.get.all.tracking.view') ? 'active' : ''}}"><a href="{{route('customer.account.get.all.tracking.view')}}">Track My Items</a></li>
    <li><a href="#">My Product Reviews</a></li>
    <li><a href="#">My Wishlist</a></li>
    <li class="{{request()->routeIs('customer.account.get.all.tickets.view') ? 'active' : ''}}"><a href="{{route('customer.account.get.all.tickets.view')}}">My Support Tickets</a></li>
</ul>