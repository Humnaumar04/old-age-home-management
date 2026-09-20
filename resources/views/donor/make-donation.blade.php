@extends('layouts.donor')

@section('title', 'Make Donation')

@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-3xl border border-gray-100 shadow-sm p-8 mb-12">

    <h2 class="text-xl font-bold text-[#1E4C56] mb-6">Donation Type</h2>

    <!-- Donation Type Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <button type="button" onclick="setDonationType('Money')" id="btn-Money" class="donation-btn border-2 border-[#C27803] bg-[#FAF3E0] p-4 rounded-2xl flex flex-col items-center justify-center transition shadow-sm">
            <span class="text-2xl mb-1">💰</span>
            <span class="font-semibold text-sm text-[#C27803]">Money</span>
        </button>
        <button type="button" onclick="setDonationType('Food')" id="btn-Food" class="donation-btn border border-gray-200 hover:border-gray-300 p-4 rounded-2xl flex flex-col items-center justify-center transition bg-white">
            <span class="text-2xl mb-1">🍲</span>
            <span class="font-medium text-sm text-gray-600">Food</span>
        </button>
        <button type="button" onclick="setDonationType('Clothes')" id="btn-Clothes" class="donation-btn border border-gray-200 hover:border-gray-300 p-4 rounded-2xl flex flex-col items-center justify-center transition bg-white">
            <span class="text-2xl mb-1">👕</span>
            <span class="font-medium text-sm text-gray-600">Clothes</span>
        </button>
        <button type="button" onclick="setDonationType('Medicine')" id="btn-Medicine" class="donation-btn border border-gray-200 hover:border-gray-300 p-4 rounded-2xl flex flex-col items-center justify-center transition bg-white">
            <span class="text-2xl mb-1">💊</span>
            <span class="font-medium text-sm text-gray-600">Medicine</span>
        </button>
    </div>
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl text-sm font-medium space-y-1">
        @foreach ($errors->all() as $error)
        <div class="flex items-center space-x-2">
            <span>⚠️</span>
            <span>{{ $error }}</span>
        </div>
        @endforeach
    </div>
    @endif

    <form action="{{ route('donor.donation.store') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="donation_type" id="selected_type" value="{{ old('donation_type', 'Money') }}">

        <!-- Dynamic Fields -->
        <div id="dynamic-fields">

            <!-- Money Fields -->
            <div id="fields-Money" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount (PKR) *</label>
                    <input type="number" name="amount" id="input_amount" placeholder="5000" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                    <select name="payment_method" id="payment_method_select" onchange="showPaymentDetails()" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50 text-gray-600">
                        <option value="">-- Select Payment Method --</option>
                        <option value="HBL Bank Transfer">HBL Bank Transfer</option>
                        <option value="JazzCash">JazzCash</option>
                        <option value="Easypaisa">Easypaisa</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transaction ID / Reference *</label>
                    <input type="text" name="transaction_id" placeholder="Paste your transaction reference here" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50">
                </div>

                <!-- Dynamic Account Details Box -->
                <div id="payment-details-box" class="hidden bg-[#FAF3E0]/60 border border-[#F3E5AB] rounded-2xl p-5 text-sm space-y-1">
                    <h4 class="font-bold text-[#C27803] mb-2">Account Details</h4>
                    <p class="text-gray-700" id="acc-title"><strong>Account Title:</strong> Old Age Home Welfare Trust</p>
                    <p class="text-gray-700" id="acc-number"><strong>Account/IBAN:</strong> -</p>
                </div>
            </div>

            <!-- Item Fields -->
            <div id="fields-Item" class="space-y-6 hidden">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" id="item-name-label">Item Name *</label>
                    <input type="text" name="item_name" id="input_item_name" placeholder="e.g. Rice, Jackets, Panadol" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity / Weight *</label>
                    <input type="text" name="quantity" id="input_quantity" placeholder="e.g. 10 kg, 5 boxes" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pickup / Delivery Method *</label>
                    <select name="delivery_method" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50 text-gray-500">
                        <option value="">-- Select --</option>
                        <option value="Self Drop-off">Self Drop-off at Old Age Home</option>
                        <option value="Home Pickup Required">Home Pickup Required</option>
                    </select>
                </div>
            </div>

        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Message for Residents (Optional)</label>
            <textarea name="message" rows="3" placeholder="A warm message for the elderly residents or staff..." class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Donation Visibility</label>
            <select name="visibility" class="w-full border-gray-200 rounded-xl p-3 focus:border-[#1E4C56] focus:ring-[#1E4C56] bg-gray-50/50 text-gray-500">
                <option value="Public">Public</option>
                <option value="Anonymous">Anonymous</option>
            </select>
        </div>

        <div class="flex items-center space-x-4 pt-4">
            <button type="submit" class="bg-[#C27803] hover:bg-[#a66502] text-white px-8 py-3 rounded-xl font-medium transition shadow-sm">
                Confirm Donation
            </button>
            <a href="{{ route('donor.dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-3 rounded-xl font-medium transition text-center">
                Cancel
            </a>
        </div>
    </form>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const categoryParam = urlParams.get('category');
        const itemParam = urlParams.get('item_name');
        const quantityParam = urlParams.get('quantity');
        const amountParam = urlParams.get('amount');

        let selectedType = "{{ old('donation_type', 'Money') }}";

        if (categoryParam) {
            // Money / Fund ko "Money" me treat karne ke liye:
            if (categoryParam.toLowerCase().includes('money')) {
                selectedType = 'Money';
            } else {
                selectedType = categoryParam.charAt(0).toUpperCase() + categoryParam.slice(1).toLowerCase();
            }
        }

        setDonationType(selectedType);

        // Money Donation ke liye Auto-fill (Amount parameters check)
        if (selectedType === 'Money') {
            const amountVal = amountParam || quantityParam;
            if (amountVal) {
                const amountInput = document.getElementById('input_amount');
                if (amountInput) amountInput.value = amountVal;
            }
        } else {
            // Food, Clothes, Medicine ke liye Auto-fill
            if (itemParam) {
                const itemInput = document.getElementById('input_item_name');
                if (itemInput) itemInput.value = itemParam;
            }

            if (quantityParam) {
                const qtyInput = document.getElementById('input_quantity');
                if (qtyInput) qtyInput.value = quantityParam;
            }
        }
    });

    function setDonationType(type) {
        document.getElementById('selected_type').value = type;

        const buttons = document.querySelectorAll('.donation-btn');
        buttons.forEach(btn => {
            btn.classList.remove('border-2', 'border-[#C27803]', 'bg-[#FAF3E0]', 'shadow-sm');
            btn.classList.add('border', 'border-gray-200', 'bg-white');
            const textSpan = btn.querySelector('span:last-child');
            textSpan.classList.remove('text-[#C27803]', 'font-semibold');
            textSpan.classList.add('text-gray-600', 'font-medium');
        });

        const activeBtn = document.getElementById('btn-' + type);
        if (activeBtn) {
            activeBtn.classList.remove('border', 'border-gray-200', 'bg-white');
            activeBtn.classList.add('border-2', 'border-[#C27803]', 'bg-[#FAF3E0]', 'shadow-sm');
            const activeText = activeBtn.querySelector('span:last-child');
            activeText.classList.remove('text-gray-600', 'font-medium');
            activeText.classList.add('text-[#C27803]', 'font-semibold');
        }

        const moneyFields = document.getElementById('fields-Money');
        const itemFields = document.getElementById('fields-Item');
        const labelName = document.getElementById('item-name-label');

        if (type === 'Money') {
            moneyFields.classList.remove('hidden');
            itemFields.classList.add('hidden');
        } else {
            moneyFields.classList.add('hidden');
            itemFields.classList.remove('hidden');
            if (labelName) {
                labelName.innerText = type + ' Item Name *';
            }
        }
    }

    function showPaymentDetails() {
        const method = document.getElementById('payment_method_select').value;
        const box = document.getElementById('payment-details-box');
        const accNumber = document.getElementById('acc-number');

        if (method === "") {
            box.classList.add('hidden');
            return;
        }

        box.classList.remove('hidden');

        if (method === 'HBL Bank Transfer') {
            accNumber.innerHTML = '<strong>Bank: HBL | Account:</strong> 0123-0123456789-01 <br><strong>IBAN:</strong> PK36 HABB 0000 0000 0000 0000';
        } else if (method === 'JazzCash') {
            accNumber.innerHTML = '<strong>JazzCash Account:</strong> 0300-1234567 <br><strong>Title:</strong> Old Age Home Trust';
        } else if (method === 'Easypaisa') {
            accNumber.innerHTML = '<strong>Easypaisa Account:</strong> 0300-7654321 <br><strong>Title:</strong> Old Age Home Trust';
        }
    }
</script>
@endpush