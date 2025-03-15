@if (session()->has('alert'))
    <div class="
            flex justify-center items-center
            fixed top-0 
            w-full
        " 
        id="alert"
    >
        <p class="
            bg-error text-light text-center
            w-10/12 p-small
            rounded-default    
        ">{{ session('alert') }}</p>
    </div>

    @pushOnce('scripts')
        <script>
            const alert = document.querySelector('#alert');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 6000);
        </script>
    @endpushonce

    @php
        session()->forget('alert');
    @endphp
@endif
