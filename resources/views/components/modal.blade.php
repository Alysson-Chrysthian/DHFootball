<div class="
    flex flex-col
    items-center justify-center
    gap-small p-small
    shadow-default
    rounded-default
    w-full max-w-[330px]
    fixed top-0 left-1/2
    -translate-x-1/2
    z-1 modal
">
    <div class="
        w-[50px]
        self-end
        cursor-pointer
        close-button
    ">
        <x-ri-close-fill />
    </div>
    <div class="self-start">
        {{ $slot }}
    </div>
    <div class="self-end close-button">
        <x-button>
            Ok, eu entendo
        </x-button>
    </div>
</div>

@pushOnce('scripts')
    <script>
        closeButtons = document.querySelectorAll('.close-button');
        modals = document.querySelectorAll('.modal');

        closeButtons.forEach(closeButton => {
            closeButton.addEventListener('click', (e) => {
                modals.forEach(modal => {
                    modal.remove();
                });
            });
        });
    </script>
@endPushOnce