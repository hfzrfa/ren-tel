@extends('layouts.app')

@section('title', 'Rent-Tel')

@section('content')
    @include('partials.hero')
    @include('partials.benefits')
    @include('partials.cars')
    @include('partials.how')
    @include('partials.testimonials')
    @include('partials.cta')
@endsection

@section('scripts')
    <script>
        // Page-only enhancements (kept here to avoid affecting other pages)
        document.addEventListener('DOMContentLoaded', () => {
            // Footer year
            const y = document.getElementById('year');
            if (y) y.textContent = String(new Date().getFullYear());

            // Mobile nav toggle (header partial)
            const menuBtn = document.getElementById('menuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    const isHidden = mobileMenu.classList.toggle('hidden');
                    menuBtn.setAttribute('aria-expanded', String(!isHidden));
                });
            }

            // Set min date to today for booking inputs
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const min = `${yyyy}-${mm}-${dd}`;
            const pickupDate = document.getElementById('pickupDate');
            const returnDate = document.getElementById('returnDate');
            if (pickupDate) pickupDate.min = min;
            if (returnDate) returnDate.min = min;
        });
    </script>
@endsection
