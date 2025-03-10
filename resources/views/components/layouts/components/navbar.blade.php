@pushOnce('styles')
    @vite('resources/css/components/navbar.css')
@endPushOnce

<div class="navbar">
    {{ $slot }}
</div>

@pushOnce('scripts')
    <script>
        navLinks = document.querySelectorAll('div.navbar > a');
        pageUrl = location.href;

        navLinks.forEach(link => {
            if (link.href != pageUrl) 
                return;

            link.classList.add('selected-tab');
        });
    </script>
@endPushOnce