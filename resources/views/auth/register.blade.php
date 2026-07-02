<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Old Age Home Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Custom styling to match Figma fonts and minor tweaks */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-[#F8F6F0] min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-2xl w-full mx-auto">
        
        <div class="mb-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-gray-600 transition flex items-center gap-1">
                ← Back to Login
            </a>
            <h2 class="text-3xl font-bold text-[#1E4C56] mt-3">Create Account</h2>
            <p class="text-sm text-gray-400 mt-1">Register as a Donor, Family Member, or Volunteer</p>
        </div>

        <div class="mb-6">
            <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Register As</label>
            <div class="grid grid-cols-3 gap-2 bg-gray-100 p-1.5 rounded-xl">
                <button type="button" onclick="selectRole('Donor')" id="btn-Donor" class="py-2.5 rounded-lg text-sm font-semibold transition bg-[#1E4C56] text-white shadow-sm flex items-center justify-center gap-1">
                    ✓ Donor
                </button>
                <button type="button" onclick="selectRole('Family')" id="btn-Family" class="py-2.5 rounded-lg text-sm font-semibold transition text-gray-500 hover:text-gray-700 flex items-center justify-center gap-1">
                    Family
                </button>
                <button type="button" onclick="selectRole('Volunteer')" id="btn-Volunteer" class="py-2.5 rounded-lg text-sm font-semibold transition text-gray-500 hover:text-gray-700 flex items-center justify-center gap-1">
                    Volunteer
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 text-red-600 text-sm rounded-xl space-y-1">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <input type="hidden" name="type" id="selected-type" value="Donor">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" placeholder="Ahmad" value="{{ old('first_name') }}" required 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" placeholder="Raza" value="{{ old('last_name') }}" required 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" placeholder="ahmad@example.com" value="{{ old('email') }}" required 
                    class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500">Phone Number</label>
                    <input type="text" name="phone" placeholder="0300-1234567" value="{{ old('phone') }}" 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500">CNIC</label>
                    <input type="text" name="cnic" placeholder="42201-1234567-1" value="{{ old('cnic') }}" 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500">Home Address</label>
                <textarea name="address" rows="3" placeholder="Full residential address..." 
                    class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm resize-none transition">{{ old('address') }}</textarea>
            </div>

            <div id="relative-field" class="hidden">
                <label class="block text-xs font-semibold text-gray-500">Your Relative (Resident Name) <span class="text-red-500">*</span></label>
                <input type="text" name="relative_name" id="relative_name" placeholder="Name of elderly person at this home..." value="{{ old('relative_name') }}" 
                    class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" placeholder="Min. 8 characters" required 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500">Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" placeholder="Repeat password" required 
                        class="w-full mt-1 p-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#1E4C56] focus:bg-white text-sm transition">
                </div>
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full py-3.5 bg-[#1E4C56] hover:bg-[#163a42] text-white font-semibold rounded-xl transition shadow-md text-sm cursor-pointer">
                    Submit Registration
                </button>
                <p class="text-center text-xs text-gray-400 mt-4 tracking-wide">
                    Your request will be reviewed and approved by the Admin within 24 hours.
                </p>
            </div>
        </form>

    </div>

    <script>
        function selectRole(role) {
            // Update hidden input field value for backend form processing
            document.getElementById('selected-type').value = role;

            // Reset styles for all three tab buttons
            ['Donor', 'Family', 'Volunteer'].forEach(r => {
                const btn = document.getElementById('btn-' + r);
                // Apply inactive gray colors
                btn.className = "py-2.5 rounded-lg text-sm font-semibold transition text-gray-500 hover:text-gray-700 flex items-center justify-center gap-1";
                
                // Clean checkmark character if existing
                if(btn.innerText.includes('✓')) {
                    btn.innerText = btn.innerText.replace('✓ ', '');
                }
            });

            // Set styling and checkmark for the selected active tab button
            const activeBtn = document.getElementById('btn-' + role);
            activeBtn.className = "py-2.5 rounded-lg text-sm font-semibold transition bg-[#1E4C56] text-white shadow-sm flex items-center justify-center gap-1";
            if(!activeBtn.innerText.includes('✓')) {
                activeBtn.innerText = '✓ ' + activeBtn.innerText;
            }

            // Dynamic view handling for the Family relative field
            const relativeField = document.getElementById('relative-field');
            const relativeInput = document.getElementById('relative_name');
            
            if (role === 'Family') {
                relativeField.classList.remove('hidden');
                relativeInput.setAttribute('required', 'required');
            } else {
                relativeField.classList.add('hidden');
                relativeInput.removeAttribute('required');
                relativeInput.value = ''; // Reset input to avoid faulty submissions
            }
        }

        // Maintain role state if page validates with redirect back and old inputs
        window.onload = function() {
            const oldType = "{{ old('type', 'Donor') }}";
            if(oldType !== 'Donor') {
                selectRole(oldType);
            }
        };
    </script>
</body>
</html>