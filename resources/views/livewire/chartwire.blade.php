<div>
    @if ($open==0)

    <div class="flex items-center justify-center w-1/3 h-full min-h-screen mx-auto">
        <!-- component -->
        <div class="flex flex-col items-center justify-center px-8 pt-6 pb-8 mb-4 rounded shadow-md bg-pink-50">
            <h5 class="text-lg text-center">Hi, {{ Auth::user()->name }}</h5>
            <h5 class="text-lg text-center">Silakan masukkan password anda untuk masuk ke menu ini.</h5>

            <div class="w-full mt-6 mb-6">
                <input class="w-full px-3 py-2 mb-3 border rounded shadow appearance-none border-red text-grey-darker"
                    type="text" wire:model="pswd">
            </div>
            <button wire:click="checkPassword" class="w-full button button-purple">Masuk</button>

        </div>
    </div>
    @endif
    @if($open==1)
    <div>
        <p>teropen deh</p>

    </div>
    @endif
</div>
