<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ContactApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="relative bg-white text-gray-800 dark:bg-gray-900 dark:text-white overflow-hidden">

    <div class="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem]"></div>
    
    <div class="absolute top-6 right-6">
        <a href="{{ route('login') }}"
           class="px-6 py-3 border-2 border-dashed font-semibold uppercase text-black  translate-x-[-10px] translate-y-[-4px] bg-indigo-500 hover:bg-indigo-600  font-bold border-black rounded-md shadow-[4px_4px_0px_black]">
            Login
        </a>
    </div>

    <!-- Main Section -->
    <div class="flex items-center justify-center h-screen">
        <div class="max-w-7xl w-full flex flex-col md:flex-row items-center justify-between px-6">

            <!-- Left Content -->
            <div class="flex-1 space-y-8">
                <h1 class="text-7xl font-extrabold leading-tight text-gray-900 dark:text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.25)]">Welcome to Contact-App</h1>                
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-xl">
                    Manage and organize your contacts easily with a secure, modern and user-friendly Laravel application.
                </p>

                <!-- Features -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="group p-6 rounded-2xl bg-emerald-200 border-2 border-black border-dashed cursor-pointer translate-x-[-20px] shadow-[13px_13px_0px_black]">
                        <div class="text-3xl mb-3 transition-transform duration-300 group-hover:rotate-6">📋</div>
                        <h3 class="text-lg font-bold mb-2">Full CRUD</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-200 leading-relaxed">
                            Create, Read, Update, and Delete contacts effortlessly.
                        </p>
                    </div>
                    
                
                    <div class="group p-6 rounded-2xl bg-purple-200 border-2 border-black border-dashed cursor-pointer translate-x-[-20px] shadow-[13px_13px_0px_black]">
                        <div class="text-3xl mb-3 transition-transform duration-300 group-hover:rotate-6">🔍</div>
                        <h3 class="text-lg font-bold mb-2">Advanced Filtering</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-200 leading-relaxed">
                            Filter by age, gender, city, or activity with precision.
                        </p>
                    </div>
                
                    <div class="group p-6 rounded-2xl bg-orange-200 border-2 border-black border-dashed cursor-pointer translate-x-[-20px] shadow-[13px_13px_0px_black]">
                        <div class="text-3xl mb-3 transition-transform duration-300 group-hover:rotate-6">📦</div>
                        <h3 class="text-lg font-bold mb-2">Export & Import</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-200 leading-relaxed">
                            Easily handle CSV files to import/export contact data.
                        </p>
                    </div>
                </div>
                
            </div>

            <!-- Right Content (Image) -->
            <div class="flex-1 text-center transform-gpu scale-95 hover:scale-100 transition-transform duration-500">
                <img src="{{ asset('images/welcome.png') }}"
                     alt="ContactApp Illustration"
                     class="w-4/5 mx-auto rounded-3xl shadow-2xl border-4 border-dashed border-white rotate-[2deg] hover:rotate-0 transition-all duration-500">
            </div>
        </div>

        <!-- Footer -->
        <footer class="absolute bottom-4 w-full text-center text-sm text-gray-500 dark:text-gray-400">
            Baked with 💙 by
            <a href="https://github.com/theonlyAmjad" target="_blank"
               class="ml-2 inline-flex items-center gap-2 px-3 py-1 rounded-full border border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all duration-300 shadow-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                <path
                  d="M12 .5C5.65.5.5 5.65.5 12c0 5.1 3.29 9.43 7.86 10.96.58.1.79-.25.79-.55v-2.1c-3.2.7-3.87-1.43-3.87-1.43-.52-1.3-1.26-1.65-1.26-1.65-1.03-.7.08-.69.08-.69 1.14.08 1.75 1.18 1.75 1.18 1.01 1.73 2.65 1.23 3.3.94.1-.73.4-1.23.72-1.51-2.55-.29-5.23-1.27-5.23-5.65 0-1.25.45-2.27 1.18-3.07-.12-.3-.52-1.51.1-3.14 0 0 .98-.31 3.2 1.17a11.1 11.1 0 012.92-.39c.99 0 1.99.13 2.92.39 2.2-1.48 3.2-1.17 3.2-1.17.62 1.63.23 2.84.1 3.14.74.8 1.17 1.82 1.17 3.07 0 4.39-2.69 5.36-5.25 5.64.41.35.77 1.04.77 2.1v3.12c0 .3.21.66.8.55A10.5 10.5 0 0023.5 12c0-6.35-5.15-11.5-11.5-11.5z" />
              </svg>
              @theonlyAmjad
            </a>
          </footer>                 
    </div>
</body>
</html>
