<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | VERIDIAN Luxury Tech</title>
    <script src="<?php echo base_url('assets/js/tailwindcss.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/all.min.css'); ?>"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'main-bg': '#0B1D1B',
                        'sec-dark': '#12352F',
                        'acc-emerald': '#1F8A70',
                        'gold-accent': '#D4AF37',
                    }
                }
            }
        }
    </script>
    <style>
        .glass { background: rgba(18, 53, 47, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(31, 138, 112, 0.2); }
    </style>
</head>
<body class="bg-main-bg text-white min-h-screen p-6 md:p-12">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-black tracking-widest text-center mb-12 uppercase">Konfirmasi <span class="text-gold-accent">Checkout</span></h1>

        <form action="<?php echo base_url('landing/process_checkout'); ?>" method="POST">
            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass p-8 rounded-[2rem]">
                        <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-gold-accent"></i> Informasi Pengiriman
                        </h2>
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Penerima</label>
                                    <input type="text" name="recipient_name" value="<?php echo isset($user['fullname']) ? htmlspecialchars($user['fullname']) : $this->session->userdata('fullname'); ?>" class="w-full bg-main-bg/50 border border-sec-dark rounded-xl py-3 px-4 focus:border-gold-accent outline-none transition-all" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nomor Telepon</label>
                                    <input type="text" name="phone_number" value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : ''; ?>" placeholder="Contoh: 08123456789" class="w-full bg-main-bg/50 border border-sec-dark rounded-xl py-3 px-4 focus:border-gold-accent outline-none transition-all" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Alamat Lengkap</label>
                                <textarea name="address" class="w-full bg-main-bg/50 border border-sec-dark rounded-xl py-3 px-4 focus:border-gold-accent outline-none transition-all" rows="3" placeholder="Masukkan alamat lengkap pengiriman" required><?php echo isset($user['address']) ? htmlspecialchars($user['address']) : ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="glass p-8 rounded-[2rem]">
                        <h2 class="text-xl font-bold mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-credit-card text-gold-accent"></i> Metode Pembayaran
                        </h2>
                        <div class="grid md:grid-cols-3 gap-4">
                            <!-- Transfer Bank -->
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="payment_method" value="transfer" class="hidden peer" onchange="showPaymentDetails('transfer')" required>
                                <div class="h-full border border-sec-dark bg-sec-dark/20 p-5 rounded-2xl transition-all peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 hover:border-gold-accent/50">
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <i class="fa-solid fa-building-columns text-2xl text-gold-accent"></i>
                                        <div>
                                            <p class="font-bold text-sm">Transfer Bank</p>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-tighter">BCA, BNI, BRI, Mandiri</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- E-Wallet -->
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="payment_method" value="ewallet" class="hidden peer" onchange="showPaymentDetails('ewallet')">
                                <div class="h-full border border-sec-dark bg-sec-dark/20 p-5 rounded-2xl transition-all peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 hover:border-gold-accent/50">
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <i class="fa-solid fa-wallet text-2xl text-gold-accent"></i>
                                        <div>
                                            <p class="font-bold text-sm">E-Wallet</p>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-tighter">OVO, DANA, GOPAY</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!-- COD -->
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="payment_method" value="cod" class="hidden peer" onchange="showPaymentDetails('cod')">
                                <div class="h-full border border-sec-dark bg-sec-dark/20 p-5 rounded-2xl transition-all peer-checked:border-gold-accent peer-checked:bg-gold-accent/10 hover:border-gold-accent/50">
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <i class="fa-solid fa-hand-holding-dollar text-2xl text-gold-accent"></i>
                                        <div>
                                            <p class="font-bold text-sm">COD</p>
                                            <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Bayar di Tempat</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Sub Options Container -->
                        <div id="transfer-details" class="hidden mt-6 pt-6 border-t border-sec-dark animate-fade-in">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Pilih Bank</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <?php foreach(['BCA', 'BNI', 'BRI', 'MANDIRI'] as $bank): ?>
                                <label class="cursor-pointer">
                                    <input type="radio" name="bank_name" value="<?php echo $bank; ?>" class="hidden peer" onchange="updateBankAccountInfo(this.value)">
                                    <div class="py-3 px-4 bg-main-bg/50 border border-sec-dark rounded-xl text-center text-xs font-bold peer-checked:border-gold-accent peer-checked:text-gold-accent transition-all">
                                        <?php echo $bank; ?>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>

                            <!-- Bank Account Input Field -->
                            <div id="bank-account-info" class="hidden mt-6 space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Nomor Rekening Anda (<span id="info-bank-name">BCA</span>)</label>
                                <input type="text" name="sender_account" id="sender_account" placeholder="Masukkan nomor rekening pengirim Anda" class="w-full bg-main-bg/50 border border-sec-dark rounded-xl py-3 px-4 focus:border-gold-accent outline-none text-white transition-all">
                            </div>
                        </div>

                        <div id="ewallet-details" class="hidden mt-6 pt-6 border-t border-sec-dark animate-fade-in">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Pilih E-Wallet</label>
                            <div class="grid grid-cols-3 gap-3">
                                <?php foreach(['OVO', 'DANA', 'GOPAY'] as $wallet): ?>
                                <label class="cursor-pointer">
                                    <input type="radio" name="wallet_name" value="<?php echo $wallet; ?>" class="hidden peer" onchange="updateWalletInfo(this.value)">
                                    <div class="py-3 px-4 bg-main-bg/50 border border-sec-dark rounded-xl text-center text-xs font-bold peer-checked:border-gold-accent peer-checked:text-gold-accent transition-all">
                                        <?php echo $wallet; ?>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>

                            <!-- E-Wallet Input Field -->
                            <div id="wallet-info" class="hidden mt-6 space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Nomor E-Wallet / HP Anda (<span id="info-wallet-name">OVO</span>)</label>
                                <input type="text" name="sender_wallet" id="sender_wallet" placeholder="Masukkan nomor HP/e-wallet pengirim Anda" class="w-full bg-main-bg/50 border border-sec-dark rounded-xl py-3 px-4 focus:border-gold-accent outline-none text-white transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="glass p-8 rounded-[2rem] border-t-4 border-gold-accent">
                        <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                        <div class="space-y-4 mb-8">
                            <?php $total = 0; foreach($cart as $item): $total += ($item['price'] * $item['qty']); ?>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400"><?php echo $item['name']; ?> x<?php echo $item['qty']; ?></span>
                                <span class="font-bold">Rp <?php echo number_format($item['price'] * $item['qty'], 0, ',', '.'); ?></span>
                            </div>
                            <?php endforeach; ?>
                            <div class="border-t border-sec-dark pt-4 flex justify-between items-center">
                                <span class="text-gray-400">Biaya Pengiriman</span>
                                <span class="text-green-500 font-bold uppercase text-xs">Gratis</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-2xl font-black text-gold-accent">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                        <button type="submit" class="block w-full bg-gold-accent text-main-bg text-center py-4 rounded-xl font-black uppercase tracking-widest hover:shadow-glow-gold transition-all">
                            Buat Pesanan
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function showPaymentDetails(method) {
                const transferDetails = document.getElementById('transfer-details');
                const ewalletDetails = document.getElementById('ewallet-details');
                const bankInfoCard = document.getElementById('bank-account-info');
                const walletInfoCard = document.getElementById('wallet-info');
                
                transferDetails.classList.add('hidden');
                ewalletDetails.classList.add('hidden');
                bankInfoCard.classList.add('hidden');
                walletInfoCard.classList.add('hidden');

                // Reset radios & inputs
                document.querySelectorAll('input[name="bank_name"]').forEach(radio => radio.checked = false);
                document.querySelectorAll('input[name="wallet_name"]').forEach(radio => radio.checked = false);
                document.getElementById('sender_account').value = '';
                document.getElementById('sender_wallet').value = '';
                
                if (method === 'transfer') {
                    transferDetails.classList.remove('hidden');
                } else if (method === 'ewallet') {
                    ewalletDetails.classList.remove('hidden');
                }
            }

            function updateBankAccountInfo(bank) {
                const infoCard = document.getElementById('bank-account-info');
                const nameSpan = document.getElementById('info-bank-name');
                const inputField = document.getElementById('sender_account');
                
                nameSpan.innerText = bank;
                inputField.placeholder = "Masukkan nomor rekening " + bank + " Anda";
                infoCard.classList.remove('hidden');
                inputField.focus();
            }

            function updateWalletInfo(wallet) {
                const infoCard = document.getElementById('wallet-info');
                const nameSpan = document.getElementById('info-wallet-name');
                const inputField = document.getElementById('sender_wallet');
                
                nameSpan.innerText = wallet;
                inputField.placeholder = "Masukkan nomor HP / akun " + wallet + " Anda";
                infoCard.classList.remove('hidden');
                inputField.focus();
            }

            // Form Submit Validator
            document.querySelector('form').addEventListener('submit', function(e) {
                const methodActive = document.querySelector('input[name="payment_method"]:checked');
                if (!methodActive) {
                    alert('Silakan pilih salah satu metode pembayaran!');
                    e.preventDefault();
                    return false;
                }

                const method = methodActive.value;
                if (method === 'transfer') {
                    const bankSelected = document.querySelector('input[name="bank_name"]:checked');
                    if (!bankSelected) {
                        alert('Silakan pilih salah satu bank pengirim!');
                        e.preventDefault();
                        return false;
                    }
                    const accountInput = document.getElementById('sender_account').value.trim();
                    if (accountInput === '') {
                        alert('Silakan masukkan nomor rekening pengirim Anda!');
                        e.preventDefault();
                        return false;
                    }
                } else if (method === 'ewallet') {
                    const walletSelected = document.querySelector('input[name="wallet_name"]:checked');
                    if (!walletSelected) {
                        alert('Silakan pilih salah satu e-wallet pengirim!');
                        e.preventDefault();
                        return false;
                    }
                    const walletInput = document.getElementById('sender_wallet').value.trim();
                    if (walletInput === '') {
                        alert('Silakan masukkan nomor HP / e-wallet pengirim Anda!');
                        e.preventDefault();
                        return false;
                    }
                }
            });
        </script>
    </div>
</body>
</html>
