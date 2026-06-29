<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Old Age Home Management System</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-[#F9F9F6] text-[#1E3E3F]">

    <!-- 1. NAVBAR SECTION -->
    <header class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="bg-[#1E3E3F] p-2 rounded-full text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </div>
            <div>
                <span class="font-bold text-lg block text-[#1E3E3F] leading-tight">Old Age Home</span>
                <span class="text-xs text-gray-500 block">Management System</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-8 font-medium text-gray-600">
            <a href="#" class="text-[#1E3E3F] font-semibold">Home</a>
            <a href="#features" class="hover:text-[#1E3E3F] transition">About Us</a> <a href="#features" class="hover:text-[#1E3E3F] transition">Features</a>
            <a href="#urgent-needs" class="hover:text-[#1E3E3F] transition">View Needs</a>
            <a href="#urgent-needs" class="hover:text-[#1E3E3F] transition">Donate</a>
            <a href="#volunteer" class="hover:text-[#1E3E3F] transition">Contact Us</a>
        </nav>

        <!-- Login Button -->
        <div>
            <a href="{{ route('login') }}" class="bg-[#1E3E3F] text-white px-6 py-2.5 rounded-full font-medium hover:bg-[#152C2D] transition">
                Login
            </a>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 pt-12 pb-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Side content -->
        <div class="space-y-6">
            <div class="inline-block bg-[#E8ECE9] text-[#1E3E3F] text-xs font-semibold px-3 py-1 rounded-full tracking-wider uppercase">
                • Caring Since 2018
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#1E3E3F] leading-[1.15]">
                A Structured, Loving, and Transparent <span class="underline decoration-[#A3B899] decoration-wavy">Management System</span> for Elderly Care
            </h1>
            <p class="text-gray-600 text-lg max-w-lg leading-relaxed">
                Bringing dignity, order, and compassion together — a unified platform connecting residents, families, staff, donors, and volunteers under one caring roof.
            </p>

            <!-- Buttons -->
            <div class="flex items-center space-x-4 pt-4">
                <a href="#features" class="bg-[#1E3E3F] text-white px-8 py-3.5 rounded-xl font-medium shadow-lg shadow-[#1E3E3F]/10 hover:bg-[#152C2D] transition flex items-center space-x-2">
                    <span>Learn More</span>
                    <span>→</span>
                </a>

                <a href="#urgent-needs" class="border-2 border-gray-300 text-[#1E3E3F] px-8 py-3.5 rounded-xl font-medium hover:bg-gray-100 transition flex items-center space-x-2">
                    <span>View Requirements</span>
                    <span>›</span>
                </a>
            </div>

            <!-- Trusted Badges -->
            <div class="flex items-center space-x-3 pt-6">
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100" alt="user">
                    <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100" alt="user">
                    <img class="w-10 h-10 rounded-full border-2 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100" alt="user">
                </div>
                <div>
                    <p class="text-sm font-bold text-[#1E3E3F]">Trusted by 50+ Residents</p>
                    <p class="text-xs text-gray-500">& their families across the region</p>
                </div>
            </div>
        </div>

        <!-- Right Side Image with Local Asset Path -->
        <div class="relative">
            <!-- Main Image Frame -->
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl">
                <!-- Aapki Local Image public/images/elderly-care.jpg se link kar di hai -->
                <img src="{{ asset('images/elderly-care.jpg') }}" alt="Elderly Care" class="w-full h-[500px] object-cover">
            </div>

            <!-- Floating Badge 1 (Top Right) -->
            <div class="absolute -top-6 -right-4 bg-white/95 backdrop-blur px-5 py-3 rounded-2xl shadow-xl flex items-center space-x-3 border border-gray-100">
                <div class="bg-orange-50 p-2 rounded-xl text-orange-600">❤️</div>
                <div>
                    <span class="block font-bold text-sm text-[#1E3E3F]">100+ Donations</span>
                    <span class="block text-xs text-gray-400">community-driven care</span>
                </div>
            </div>

            <!-- Floating Badge 2 (Bottom Left) -->
            <div class="absolute -bottom-6 -left-6 bg-white/95 backdrop-blur px-5 py-3 rounded-2xl shadow-xl flex items-center space-x-3 border border-gray-100">
                <div class="bg-blue-50 p-2 rounded-xl text-blue-600">🛡️</div>
                <div>
                    <span class="block font-bold text-sm text-[#1E3E3F]">Safe & Monitored</span>
                    <span class="block text-xs text-gray-400">24/7 staff presence</span>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#1E3E3F] text-white py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="space-y-2">
                <span class="text-4xl font-extrabold block text-[#A3B899]">50+</span>
                <span class="text-sm text-gray-300 font-medium tracking-wide uppercase">Happy Residents</span>
            </div>
            <div class="space-y-2">
                <span class="text-4xl font-extrabold block text-[#A3B899]">10+</span>
                <span class="text-sm text-gray-300 font-medium tracking-wide uppercase">Dedicated Staff</span>
            </div>
            <div class="space-y-2">
                <span class="text-4xl font-extrabold block text-[#A3B899]">100+</span>
                <span class="text-sm text-gray-300 font-medium tracking-wide uppercase">Total Donations</span>
            </div>
            <div class="space-y-2">
                <span class="text-4xl font-extrabold block text-[#A3B899]">Active</span>
                <span class="text-sm text-gray-300 font-medium tracking-wide uppercase">Volunteer Support</span>
            </div>
        </div>
    </section>

    <section id="features" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-[#1E3E3F] font-bold text-sm tracking-widest uppercase bg-[#E8ECE9] px-3 py-1 rounded-full">• Our Services</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E3E3F]">Everything Managed, Everyone Connected</h2>
            <p class="text-gray-500">A complete ecosystem designed around the wellbeing of our elderly residents — transparent, structured, and always compassionate.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-1.jpg') }}" alt="Dedicated Care" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 left-4 bg-[#1E3E3F] text-white p-2.5 rounded-xl text-lg shadow-md">👥</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E3E3F] mb-3">Dedicated Care & Staff Management</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Track daily resident activities, health vitals, and schedules. Our staff portal ensures every shift is documented, every need is noted.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Real-time health monitoring</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Daily activity logs</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Emergency alert system</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Shift management & attendance</span></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-2.jpg') }}" alt="Transparent Donations" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 left-4 bg-orange-600 text-white p-2.5 rounded-xl text-lg shadow-md">🎁</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E3E3F] mb-3">Transparent Donations Tracking</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Every contribution — whether food, clothes, medicine, or funds — is logged and visible. Donors can track exactly how their generosity makes an impact.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Food & grocery donations</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Clothing collections</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Medical supply tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Monetary fund management</span></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-3.jpg') }}" alt="Seamless Family Connection" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute top-4 left-4 bg-blue-600 text-white p-2.5 rounded-xl text-lg shadow-md">💬</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E3E3F] mb-3">Seamless Family Connection</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Families stay close through our portal — view your relative's daily health updates, communicate with the care team, and make contributions directly.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Live health & activity view</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Secure messaging with staff</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Family donation portal</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Visiting hour scheduling</span></li>
                    </ul>
                </div>
            </div>

        </div>
    </section>
    <section id="urgent-needs" class="bg-[#F3F4F0] py-20 px-6 border-t border-b border-gray-200">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
                <div class="space-y-3">
                    <span class="text-orange-600 font-bold text-sm tracking-widest uppercase bg-orange-50 px-3 py-1 rounded-full">• Urgent Requirements</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#1E3E3F]">Current Center Requirements</h2>
                    <p class="text-gray-500 max-w-xl">Directly support our residents by fulfilling these monthly or instant physical needs requested by the management.</p>
                </div>

                <div>
                    <a href="{{ route('register') }}" class="bg-[#1E3E3F] text-white px-7 py-3.5 rounded-xl font-semibold shadow-lg shadow-[#1E3E3F]/10 hover:bg-[#152C2D] transition duration-300 flex items-center space-x-2 border border-transparent group">
                        <span>Donate Now</span>
                        <span class="group-hover:translate-x-1 transition-transform duration-200">💝</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-yellow-50 text-yellow-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">🍴</div>
                    <div>
                        <h4 class="font-bold text-[#1E3E3F]">Food</h4>
                        <p class="text-xs text-gray-500">Rice, Oil, Groceries</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-purple-50 text-purple-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">👕</div>
                    <div>
                        <h4 class="font-bold text-[#1E3E3F]">Clothes</h4>
                        <p class="text-xs text-gray-500">Winter shawls, Warm wear</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-gray-100 text-gray-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-red-50 text-red-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">💊</div>
                    <div>
                        <h4 class="font-bold text-[#1E3E3F]">Medicine</h4>
                        <p class="text-xs text-gray-500">Panadol, Disprin, BP meds</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-green-50 text-green-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">💵</div>
                    <div>
                        <h4 class="font-bold text-[#1E3E3F]">Funds</h4>
                        <p class="text-xs text-gray-500">Monthly operational support</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>
            </div>
        </div>
    </section>

    <section id="volunteer" class="max-w-7xl mx-auto px-6 py-20">
        <div class="bg-[#1E3E3F] text-white rounded-[3rem] overflow-hidden grid grid-cols-1 lg:grid-cols-2 items-center shadow-xl">
            <div class="p-10 md:p-16 space-y-6">
                <div class="inline-block bg-white/10 text-white text-xs font-semibold px-3 py-1 rounded-full tracking-wider uppercase">• Volunteer With Us</div>
                <h2 class="text-3xl md:text-5xl font-bold leading-tight">Your Time Can Brighten Someone's Day</h2>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                    Our elderly residents don't just need care — they need companionship, laughter, and human connection. As a volunteer, you bring all of that and more.
                </p>

                <ul class="space-y-3 text-sm text-gray-200">
                    <li class="flex items-center space-x-3"><span class="text-[#A3B899]">✓</span> <span>Assist with daily activities like morning walks</span></li>
                    <li class="flex items-center space-x-3"><span class="text-[#A3B899]">✓</span> <span>Lead storytelling or prayer sessions</span></li>
                    <li class="flex items-center space-x-3"><span class="text-[#A3B899]">✓</span> <span>Provide companionship and emotional support</span></li>
                </ul>

                <div class="pt-4">
                    <a href="{{ route('register') }}" class="bg-white text-[#1E3E3F] px-8 py-3.5 rounded-xl font-bold hover:bg-gray-100 transition inline-block">
                        Become a Volunteer
                    </a>
                </div>
            </div>
            <div class="h-full min-h-[400px] lg:min-h-[550px] relative">
                <img src="{{ asset('images/volunteer-care.jpg') }}" alt="Volunteer Support" class="w-full h-full object-cover">
                <div class="absolute bottom-10 left-10 bg-white p-4 rounded-2xl shadow-lg border border-gray-100 flex items-center space-x-3 text-[#1E3E3F]">
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">⭐</div>
                    <div>
                        <p class="font-bold text-sm">Join Our Volunteer Family</p>
                        <p class="text-[10px] text-gray-500 italic">Every hour you give changes a life</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#152C2D] text-gray-400 pt-16 pb-8 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="space-y-4">
                <div class="flex items-center space-x-3 text-white font-bold text-lg">
                    <div class="bg-white/10 p-2 rounded-full text-white">❤️</div>
                    <span>Old Age Home</span>
                </div>
                <p class="text-xs leading-relaxed">
                    A compassionate platform dedicated to restoring order, dignity, and active transparency to elderly care management.
                </p>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">About System</a></li>
                    <li><a href="#" class="hover:text-white transition">Active Needs</a></li>
                    <li><a href="#" class="hover:text-white transition">Volunteer Program</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Admin Login</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact Support</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Contact Center</h4>
                <p class="text-sm">📍 Sector 5-H, Pakistan</p>
                <p class="text-sm mt-2">Have questions about the system? Reach out to our management desk anytime.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-8 border-t border-white/5 flex items-center justify-between text-[10px] uppercase tracking-widest text-gray-500">
            <p>© 2026 Old Age Home Management System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
</body>

</html>