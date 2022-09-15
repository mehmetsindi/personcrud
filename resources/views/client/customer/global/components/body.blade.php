<!doctype html>
<html class="no-js" lang="tr-TR">
@include('client.customer.global.components.head')

<body>
    <div class="container">
        <div class="table-wrapper">
            @include('client.customer.global.components.header')
            @yield('wrapper')
            @include('client.customer.global.components.footer')
        </div>
    </div>
    @include('client.customer.global.components.modal')
    @include('client.customer.global.components.foot')
</body>

</html>
