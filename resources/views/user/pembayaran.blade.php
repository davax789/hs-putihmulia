<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    window.onload = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Redirect ke halaman sukses dengan kode_transaksi
                window.location.href = "/order/success/" + result.order_id;
            },
            onPending: function(result) {
                // Redirect ke halaman pending (opsional)
                window.location.href = "/order/pending/" + result.order_id;
            },
            onError: function(result) {
                // Redirect ke halaman gagal (opsional)
                window.location.href = "/order/failed/" + result.order_id;
            },
            onClose: function() {
                // Tidak melakukan apa-apa, popup ditutup
            }
        });
    };
</script>
