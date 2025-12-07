<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Tiket') }}
        </h2>
    </x-slot>

    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-QEPkpKexecwxEEVH"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-gray-500 mb-6">Selesaikan pembayaran untuk mendapatkan tiket Anda.</p>
                    
                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-6 mb-8 inline-block text-left min-w-[300px]">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Event:</span>
                            <span class="font-bold text-gray-800">{{ $event->nama_event }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-bold text-gray-800">1 Tiket</span>
                        </div>
                        <div class="border-t border-indigo-200 my-2"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-indigo-700">Total:</span>
                            <span class="text-2xl font-extrabold text-indigo-700">Rp 50.000</span>
                        </div>
                    </div>

                    <br>

                    <button id="pay-button" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 transition shadow-lg">
                        💳 Bayar Sekarang
                    </button>
                    
                    <p class="mt-4 text-xs text-gray-400">
                        Didukung oleh Midtrans Secure Payment
                    </p>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      
      payButton.addEventListener('click', function () {
        // Panggil Snap.pay menggunakan Token yang dikirim dari Controller
        window.snap.pay('{{ $snapToken }}', {
          
          // Jika Berhasil (Success)
          onSuccess: function(result){
            console.log(result);
            alert("Pembayaran Berhasil! Tiket Anda sudah aktif.");
            window.location.href = "{{ route('events.payment.success', $event->id) }}"; // Kembali ke halaman event
          },
          
          // Jika Menunggu (Pending)
          onPending: function(result){
            console.log(result);
            alert("Menunggu pembayaran! Silakan selesaikan via ATM/Gopay sesuai instruksi.");
            window.location.href = "{{ route('bookings.index') }}";
          },
          
          // Jika Gagal (Error)
          onError: function(result){
            console.log(result);
            alert("Pembayaran Gagal atau Dibatalkan.");
          },
          
          // Jika Popup Ditutup (Close)
          onClose: function(){
            console.log('Customer closed the popup without finishing the payment');
            alert('Anda menutup halaman pembayaran.');
          }
        });
      });
    </script>
</x-app-layout>