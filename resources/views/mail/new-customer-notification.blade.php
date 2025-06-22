@component('mail::message')
    # New Customer Created

    Name: {{ $customer->name }}
    Email: {{ $customer->email }}
    Phone: {{ $customer->phone }}
@endcomponent
