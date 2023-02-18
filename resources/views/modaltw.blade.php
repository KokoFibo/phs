<!-- component -->
<!-- Code block starts -->
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
    <div class="absolute top-0 bottom-0 left-0 right-0 z-10 py-12 transition duration-150 ease-in-out bg-gray-700"
        id="modal">
        <div role="alert" class="container w-11/12 max-w-lg mx-auto md:w-2/3">
            <div class="relative px-5 py-8 bg-white border border-gray-400 rounded shadow-md md:px-10">
                <div class="flex justify-start w-full mb-3 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="52"
                        height="52" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                        <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                    </svg>
                </div>
                <h1 class="mb-4 font-bold leading-tight tracking-normal text-gray-800 font-lg">
                    Enter Billing Details
                </h1>
                <label for="name" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Owner
                    Name</label>
                <input id="name"
                    class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700"
                    placeholder="James" />
                <label for="email2" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Card
                    Number</label>
                <div class="relative mt-2 mb-5">
                    <div class="absolute flex items-center h-full px-4 text-gray-600 border-r">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="3" y="5" width="18" height="14" rx="3" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                            <line x1="7" y1="15" x2="7.01" y2="15" />
                            <line x1="11" y1="15" x2="13" y2="15" />
                        </svg>
                    </div>
                    <input id="email2"
                        class="flex items-center w-full h-10 pl-16 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700"
                        placeholder="XXXX - XXXX - XXXX - XXXX" />
                </div>
                <label for="expiry" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Expiry
                    Date</label>
                <div class="relative mt-2 mb-5">
                    <div class="absolute right-0 flex items-center h-full pr-3 text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <rect x="8" y="15" width="2" height="2" />
                        </svg>
                    </div>
                    <input id="expiry"
                        class="flex items-center w-full h-10 pl-3 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700"
                        placeholder="MM/YY" />
                </div>
                <label for="cvc"
                    class="text-sm font-bold leading-tight tracking-normal text-gray-800">CVC</label>
                <div class="relative mt-2 mb-5">
                    <div class="absolute right-0 flex items-center h-full pr-3 text-gray-600 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                        </svg>
                    </div>
                    <input id="cvc"
                        class="flex items-center w-full h-10 pl-3 mb-8 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700"
                        placeholder="MM/YY" />
                </div>
                <div class="flex items-center justify-start w-full">
                    <button
                        class="px-8 py-2 text-sm text-white transition duration-150 ease-in-out bg-indigo-700 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hover:bg-indigo-600">
                        Submit
                    </button>
                    <button
                        class="px-8 py-2 ml-3 text-sm text-gray-600 transition duration-150 ease-in-out bg-gray-100 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 hover:border-gray-400 hover:bg-gray-300"
                        onclick="modalHandler()">
                        Cancel
                    </button>
                </div>
                <button
                    class="absolute top-0 right-0 mt-4 mr-5 text-gray-400 transition duration-150 ease-in-out rounded cursor-pointer hover:text-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600"
                    onclick="modalHandler()" aria-label="close modal" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    {{-- <div class="flex justify-center w-full py-12" id="button">
      <button
        class="px-4 py-2 mx-auto text-xs text-white transition duration-150 ease-in-out bg-indigo-700 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hover:bg-indigo-600 sm:px-8 sm:text-sm"
        onclick="modalHandler(true)"
      >
        Open Modal
      </button>
    </div> --}}
</body>
<script>
    let modal = document.getElementById("modal");

    function modalHandler(val) {
        if (val) {
            fadeIn(modal);
        } else {
            fadeOut(modal);
        }
    }

    function fadeOut(el) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }

    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "flex";
        (function fade() {
            let val = parseFloat(el.style.opacity);
            if (!((val += 0.2) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }
</script>
<!-- Code block ends -->

</html>
