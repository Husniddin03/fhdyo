<x-user-app title="Login">
     <div class="w-full max-w-md">
         <div class="text-center">
             <div class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-white/50 shadow-xl shadow-black/5 backdrop-blur-xl dark:bg-slate-950/40">
                 <svg class="h-7 w-7 text-indigo-600 dark:text-indigo-200" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                     <path d="M12 3 4.5 6.75V12c0 6.075 3.6 9.75 7.5 9.75s7.5-3.675 7.5-9.75V6.75L12 3Z"
                         stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                 </svg>
             </div>
             <h1 class="mt-5 text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Sign in</h1>
             <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Welcome back. Please sign in to continue.</p>
         </div>
 
         <x-card class="mt-8 p-6 sm:p-8">
             <form action="{{ route('login') }}" method="POST" class="space-y-5" novalidate>
                 @csrf
 
                 <x-input name="email" type="email" label="Email" autocomplete="email" placeholder="you@example.com" />
 
                 <div>
                     <div class="flex items-center justify-between">
                         <label for="password" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
                             Password
                         </label>
                         <button type="button" id="togglePwd"
                             class="text-xs font-semibold text-indigo-700 transition hover:text-indigo-600 dark:text-indigo-200">
                             Show
                         </button>
                     </div>
 
                     <x-input name="password" type="password" autocomplete="current-password" placeholder="••••••••" />
                 </div>
 
                 <div class="flex items-center justify-between">
                     <label class="inline-flex items-center gap-2">
                         <input type="checkbox" name="remember"
                             class="h-4 w-4 rounded border-white/30 bg-white/60 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40" />
                         <span class="text-sm text-slate-700 dark:text-slate-300">Remember me</span>
                     </label>
                 </div>
 
                 <div class="pt-2">
                     <x-button type="submit" class="w-full">
                         Sign in
                         <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M15.75 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                             <path d="M12.75 9 15.75 12l-3 3" stroke="currentColor" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round" />
                         </svg>
                     </x-button>
                 </div>
             </form>
         </x-card>
     </div>
 
     <script>
         const toggle = document.getElementById('togglePwd');
         const pwd = document.getElementById('password');
         if (toggle && pwd) {
             toggle.addEventListener('click', () => {
                 const isText = pwd.type === 'text';
                 pwd.type = isText ? 'password' : 'text';
                 toggle.textContent = isText ? 'Show' : 'Hide';
             });
         }
     </script>
 </x-user-app>
