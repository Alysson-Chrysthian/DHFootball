@if (session()->has('success'))
    <div class="
            flex justify-center items-center
            fixed top-0 
            w-full
        " 
        id="success"
    >
        <p class="
            bg-primary text-light text-center
            w-10/12 p-small
            rounded-default    
        ">{{ session('success') }}</p>
    </div>

    @pushOnce('scripts')
        <script>
            const success = document.querySelector('#success');
            setTimeout(() => {
                success.style.display = 'none';
            }, 6000);
        </script>
    @endpushonce

    @php
        session()->forget('success');
    @endphp
@endif
