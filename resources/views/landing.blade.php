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

        /* Halka color-grade filter — Unsplash images ko thora unique look dene ke liye */
        .img-tone {
            filter: brightness(1.04) contrast(1.08) saturate(1.15) hue-rotate(6deg);
        }
    </style>
</head>

<body class="bg-[#F8F6F0] text-[#1E4C56]">

    <!-- 1. NAVBAR SECTION -->
    <header class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="bg-[#D1884F] p-2 rounded-xl text-white">
                ❤️
            </div>
            <div>
                <span class="font-bold text-lg block text-[#1E4C56] leading-tight">Old Age Home</span>
                <span class="text-xs text-gray-500 block">Management System</span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex space-x-8 font-medium text-gray-600">
            <a href="#" class="text-[#1E4C56] font-semibold">Home</a>
            <a href="#features" class="hover:text-[#1E4C56] transition">Features</a>
            <a href="#urgent-needs" class="hover:text-[#1E4C56] transition">Donate</a>
            <a href="#volunteer" class="hover:text-[#1E4C56] transition">Volunteer</a>
            <a href="#contact" class="hover:text-[#1E4C56] transition">Contact Us</a>
        </nav>

        <!-- Login Button -->
        <div>
            <a href="{{ route('login') }}" class="bg-[#1E4C56] text-white px-6 py-2.5 rounded-full font-medium hover:bg-[#163C44] transition">
                Login
            </a>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 pt-12 pb-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <!-- Left Side content -->
        <div class="space-y-6">
            <div class="inline-block bg-[#E8ECE9] text-[#1E4C56] text-xs font-semibold px-3 py-1 rounded-full tracking-wider uppercase">
                • Caring Since 2026
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#1E4C56] leading-[1.15]">
                A Structured, Loving, and Transparent <span class="underline decoration-[#D1884F] decoration-wavy">Management System</span> for Elderly Care
            </h1>
            <p class="text-gray-600 text-lg max-w-lg leading-relaxed">
                Bringing dignity, order, and compassion together — a unified platform connecting residents, families, staff, donors, and volunteers under one caring roof.
            </p>

            <!-- Buttons -->
            <div class="flex items-center space-x-4 pt-4">
                <a href="#features" class="bg-[#1E4C56] text-white px-8 py-3.5 rounded-xl font-medium shadow-lg shadow-[#1E4C56]/10 hover:bg-[#163C44] transition flex items-center space-x-2">
                    <span>Learn More</span>
                    <span>→</span>
                </a>

                <a href="#urgent-needs" class="border-2 border-gray-300 text-[#1E4C56] px-8 py-3.5 rounded-xl font-medium hover:bg-gray-100 transition flex items-center space-x-2">
                    <span>View Requirements</span>
                    <span>›</span>
                </a>
            </div>

            <!-- Trusted Badge -->
            <div class="flex items-center space-x-3 pt-6">
                <div class="bg-[#E8ECE9] p-2.5 rounded-full text-[#1E4C56]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-[#1E4C56]">Caring for our residents</p>
                    <p class="text-xs text-gray-500">and connecting them with their families</p>
                </div>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="relative">
            <div class="rounded-[2.5rem] overflow-hidden shadow-2xl">
                <img src="{{ asset('images/elderly-care.jpg') }}" alt="Elderly Care" class="img-tone w-full h-[500px] object-cover">
            </div>

            <div class="absolute -top-6 -right-4 bg-white/95 backdrop-blur px-5 py-3 rounded-2xl shadow-xl flex items-center space-x-3 border border-gray-100">
                <div class="bg-orange-50 p-2 rounded-xl text-orange-600">❤️</div>
                <div>
                    <span class="block font-bold text-sm text-[#1E4C56]">Community Donations</span>
                    <span class="block text-xs text-gray-400">community-driven care</span>
                </div>
            </div>

            <div class="absolute -bottom-6 -left-6 bg-white/95 backdrop-blur px-5 py-3 rounded-2xl shadow-xl flex items-center space-x-3 border border-gray-100">
                <div class="bg-blue-50 p-2 rounded-xl text-blue-600">🛡️</div>
                <div>
                    <span class="block font-bold text-sm text-[#1E4C56]">Safe & Monitored</span>
                    <span class="block text-xs text-gray-400">Dedicated staff on-site</span>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
            <span class="text-[#1E4C56] font-bold text-sm tracking-widest uppercase bg-[#E8ECE9] px-3 py-1 rounded-full">• Our Services</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E4C56]">Everything Managed, Everyone Connected</h2>
            <p class="text-gray-500">A complete ecosystem designed around the wellbeing of our elderly residents — transparent, structured, and always compassionate.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-1.jpg') }}" alt="Dedicated Care" class="img-tone w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                        <div class="absolute top-4 left-4 bg-[#1E4C56] text-white p-2.5 rounded-xl text-lg shadow-md">👥</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E4C56] mb-3">Dedicated Care & Staff Management</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Track daily resident activities and health records. Our staff portal ensures every reading is logged and every emergency is reported to the admin right away.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Resident health record tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Daily activity logs</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Emergency reporting to admin</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Staff records management</span></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-2.jpg') }}" alt="Transparent Donations" class="img-tone w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                        <div class="absolute top-4 left-4 bg-orange-600 text-white p-2.5 rounded-xl text-lg shadow-md">🎁</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E4C56] mb-3">Transparent Donations Tracking</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Every contribution — whether food, clothes, medicine, or funds — is logged and reviewed by our team, with donors able to see the current needs before giving.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Food & grocery donations</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Clothing collections</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Medical supply tracking</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Monetary fund donations</span></li>
                    </ul>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl transition group duration-300 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="overflow-hidden h-52 w-full relative">
                        <img src="{{ asset('images/service-3.jpg') }}" alt="Seamless Family Connection" class="img-tone w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                        <div class="absolute top-4 left-4 bg-blue-600 text-white p-2.5 rounded-xl text-lg shadow-md">💬</div>
                    </div>
                    <div class="p-8 pb-4">
                        <h3 class="text-xl font-bold text-[#1E4C56] mb-3">Seamless Family Connection</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Families stay close through our portal — view your relative's room and health status, and message our admin team directly whenever you have a question.
                        </p>
                    </div>
                </div>
                <div class="px-8 pb-8 pt-2">
                    <ul class="space-y-2 text-xs font-medium text-gray-500">
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>View resident room & health status</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Direct messaging with the admin team</span></li>
                        <li class="flex items-center space-x-2"><span class="text-green-600">✓</span> <span>Simple, private family login</span></li>
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
                    <h2 class="text-3xl md:text-4xl font-bold text-[#1E4C56]">Current Center Requirements</h2>
                    <p class="text-gray-500 max-w-xl">Directly support our residents by fulfilling these monthly or instant physical needs requested by the management.</p>
                </div>

                <div>
                    <a href="{{ route('register') }}" class="bg-[#1E4C56] text-white px-7 py-3.5 rounded-xl font-semibold shadow-lg shadow-[#1E4C56]/10 hover:bg-[#163C44] transition duration-300 flex items-center space-x-2 border border-transparent group">
                        <span>Donate Now</span>
                        <span class="group-hover:translate-x-1 transition-transform duration-200">💝</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-yellow-50 text-yellow-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">🍴</div>
                    <div>
                        <h4 class="font-bold text-[#1E4C56]">Food</h4>
                        <p class="text-xs text-gray-500">Rice, Oil, Groceries</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-purple-50 text-purple-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">👕</div>
                    <div>
                        <h4 class="font-bold text-[#1E4C56]">Clothes</h4>
                        <p class="text-xs text-gray-500">Winter shawls, Warm wear</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-gray-100 text-gray-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-red-50 text-red-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">💊</div>
                    <div>
                        <h4 class="font-bold text-[#1E4C56]">Medicine</h4>
                        <p class="text-xs text-gray-500">Panadol, Disprin, BP meds</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-red-100 text-red-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col space-y-3">
                    <div class="bg-green-50 text-green-600 w-10 h-10 rounded-lg flex items-center justify-center text-xl">💵</div>
                    <div>
                        <h4 class="font-bold text-[#1E4C56]">Funds</h4>
                        <p class="text-xs text-gray-500">Monthly operational support</p>
                    </div>
                    <span class="inline-block w-fit text-[10px] bg-green-100 text-green-700 font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Urgent</span>
                </div>
            </div>
        </div>
    </section>

    <section id="volunteer" class="max-w-7xl mx-auto px-6 py-20">
        <div class="bg-[#1E4C56] text-white rounded-[3rem] overflow-hidden grid grid-cols-1 lg:grid-cols-2 items-center shadow-xl">
            <div class="p-10 md:p-16 space-y-6">
                <div class="inline-block bg-white/10 text-white text-xs font-semibold px-3 py-1 rounded-full tracking-wider uppercase">• Volunteer With Us</div>
                <h2 class="text-3xl md:text-5xl font-bold leading-tight">Your Time Can Brighten Someone's Day</h2>
                <p class="text-gray-300 text-sm md:text-base leading-relaxed">
                    Our elderly residents don't just need care — they need companionship, laughter, and human connection. As a volunteer, you bring all of that and more.
                </p>

                <ul class="space-y-3 text-sm text-gray-200">
                    <li class="flex items-center space-x-3"><span class="text-[#D1884F]">✓</span> <span>Assist with daily activities like morning walks</span></li>
                    <li class="flex items-center space-x-3"><span class="text-[#D1884F]">✓</span> <span>Lead storytelling or prayer sessions</span></li>
                    <li class="flex items-center space-x-3"><span class="text-[#D1884F]">✓</span> <span>Provide companionship and emotional support</span></li>
                </ul>

                <div class="pt-4">
                    <a href="{{ route('register') }}" class="bg-white text-[#1E4C56] px-8 py-3.5 rounded-xl font-bold hover:bg-gray-100 transition inline-block">
                        Become a Volunteer
                    </a>
                </div>
            </div>
            <div class="h-full min-h-[400px] lg:min-h-[550px] relative">
                <img src="{{ asset('images/volunteer-care.jpg') }}" alt="Volunteer Support" class="img-tone w-full h-full object-cover" loading="lazy">
                <div class="absolute bottom-10 left-10 bg-white p-4 rounded-2xl shadow-lg border border-gray-100 flex items-center space-x-3 text-[#1E4C56]">
                    <div class="bg-blue-50 p-2 rounded-lg text-blue-600">⭐</div>
                    <div>
                        <p class="font-bold text-sm">Join Our Volunteer Family</p>
                        <p class="text-[10px] text-gray-500 italic">Every hour you give changes a life</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT US SECTION -->
    <section id="contact" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
            <span class="text-[#1E4C56] font-bold text-sm tracking-widest uppercase bg-[#E8ECE9] px-3 py-1 rounded-full">• Get in Touch</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1E4C56]">Contact Us</h2>
            <p class="text-gray-500">Have a question about the system or want to know more about this project? Reach out anytime.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-[1.75rem] border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 p-8 flex flex-col items-center text-center space-y-4">
                <div class="bg-[#E8ECE9] text-[#1E4C56] w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">📧</div>
                <div>
                    <h4 class="font-bold text-[#1E4C56] mb-1">Email Us</h4>
                    <p class="text-sm text-gray-500"><a href="mailto:humnaumar04@gmail.com" class="hover:text-[#1E4C56] transition">humnaumar04@gmail.com</a></p>
                    <p class="text-sm text-gray-500"><a href="mailto:maryamtariqq2003@gmail.com" class="hover:text-[#1E4C56] transition">maryamtariqq2003@gmail.com</a></p>
                </div>
            </div>

            <div class="bg-white rounded-[1.75rem] border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 p-8 flex flex-col items-center text-center space-y-4">
                <div class="bg-orange-50 text-orange-600 w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">📍</div>
                <div>
                    <h4 class="font-bold text-[#1E4C56] mb-1">Our Institution</h4>
                    <p class="text-sm text-gray-500">Govt. Graduate College, Civil Lines, Sheikhupura</p>
                </div>
            </div>

            <div class="bg-white rounded-[1.75rem] border border-gray-100 shadow-sm hover:shadow-xl transition duration-300 p-8 flex flex-col items-center text-center space-y-4">
                <div class="bg-blue-50 text-blue-600 w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">🎓</div>
                <div>
                    <h4 class="font-bold text-[#1E4C56] mb-1">About This Project</h4>
                    <p class="text-sm text-gray-500">A Final Year Project built by BS(IT) students</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#163C44] text-gray-400 pt-16 pb-8 px-6">
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
                    <li><a href="#features" class="hover:text-white transition">About System</a></li>
                    <li><a href="#urgent-needs" class="hover:text-white transition">Active Needs</a></li>
                    <li><a href="#volunteer" class="hover:text-white transition">Volunteer Program</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Admin Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-white transition">Register</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-sm mb-4 tracking-wider uppercase">Contact</h4>
                <p class="text-sm">📍 Sector 5-H, Pakistan</p>
                <p class="text-sm mt-2">
                    <a href="mailto:humnaumar04@gmail.com" class="hover:text-white transition">humnaumar04@gmail.com</a>
                    <a href="mailto:maryamtariqq2003@gmail.com" class="hover:text-white transition">maryamtariqq2003@gmail.com</a>
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-8 border-t border-white/5 flex items-center justify-between text-[10px] uppercase tracking-widest text-gray-500">
            <p>© 2026 Old Age Home Management System. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>